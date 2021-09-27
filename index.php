<?php 
require __DIR__.'/includes/header.php'; 

require __DIR__.'/vendor/autoload.php';

use \App\WebService\ViaCEP;
use \App\Classes\Functions;
$func = new Functions;

?>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6 text-white p-4 " style="margin: 150px 0 0 0;">
            <form method="POST">
                <div class="md-3 mb-3">
                    <input type="text" class="form-control" id="CEP" name="cep" onkeypress="mascara(this, '#####-###')"
                        maxlength="9" required>
                    <div class="form-text">Insira  o CEP desejado! <a href="ceps.php">Banco de CEPs</a></div>
                </div>
                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary ">Buscar</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php
$mensagem = '';

$resultado = '';

//Tratamento das mensagens
if (isset($_GET['status'])) {
  switch ($_GET['status']) {
    case 'erro':
        $mensagem = '<div class="alert alert-danger" role="alert">
        O CEP inserido não é válido, Verifique e insira novamente!
        </div>';
      break;
    case 'errordata':
        $mensagem = '<div class="alert alert-danger" role="alert">
        O CEP inserido está registrado na nossa base de dados, Porém o acesso ao banco foi recusado!
        </div>';
      break;
  }
}

//Se existir na base de dados via acontecer o select
if (!empty($_POST['cep'])) {
  $u = $func->BuscEndereco($_POST['cep']);
    if ($u == true) {
      for ($i=0; $i <count($u) ; $i++) { 
       
        $resultado .= '<tr>
                          <td>'.$u[$i]['CEP'].'</td>
                          <td>'.$u[$i]['LOGRADOURO'].'</td>
                          <td>'.$u[$i]['COMPLEMENTO'].'</td>
                          <td>'.$u[$i]['BAIRRO'].'</td>
                          <td>'.$u[$i]['LOCALIDADE'].'</td>
                          <td>'.$u[$i]['UF'].'</td>
                          <td>'.$u[$i]['IBGE'].'</td>
                          <td>'.$u[$i]['GIA'].'</td>
                          <td>'.$u[$i]['DDD'].'</td>
                          <td>'.$u[$i]['SIAFI'].'</td>
                       </tr>';
      }
   
    }else {
//Caso contrario a chamada via API, e seu cadastro no banco
      $dadosCEP = ViaCep::consultaCEP($_POST['cep']);
      $array = $func->XML2Array($dadosCEP);
      $func->CadEndereco($array);
      
        $resultado .= '<tr>
                          <td>'.$array['cep'].'</td>
                          <td>'.$array['logradouro'].'</td>
                          <td>'.$array['complemento'].'</td>
                          <td>'.$array['bairro'].'</td>
                          <td>'.$array['localidade'].'</td>
                          <td>'.$array['uf'].'</td>
                          <td>'.$array['ibge'].'</td>
                          <td>'.$array['gia'].'</td>
                          <td>'.$array['ddd'].'</td>
                          <td>'.$array['siafi'].'</td>
                        </tr>';
     }
  }
?>

</div>
<div class="container">
    <div class="row justify-content-center align-items-center">
        <div class="col-md-12">
          <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">CEP</th>
                        <th scope="col">LOGRADOURO</th>
                        <th scope="col">COMPLEMENTO</th>
                        <th scope="col">BAIRRO</th>
                        <th scope="col">LOCALIDADE</th>
                        <th scope="col">UF</th>
                        <th scope="col">IBGE</th>
                        <th scope="col">GIA</th>
                        <th scope="col">DDD</th>
                        <th scope="col">SIAFI</th>
                    </tr>
                </thead>
                <tbody>
                    <?=$resultado; ?>
                </tbody>
            </table>
          </div>
        </div>
        <?=$mensagem ?>
    </div>
</div>
<?php require __DIR__.'/includes/footer.php'; ?>