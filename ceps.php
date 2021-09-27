<?php 
require __DIR__.'/includes/header.php'; 
require __DIR__.'/vendor/autoload.php';
use \App\WebService\ViaCEP;
use \App\Classes\Functions;
$func = new Functions;
$resultado = '';
$u = $func->BuscCompleto();
     
?>

<div class="container">
<h3 class="mt-4">Todos os CEPs pesquisados até o momento</h3>
<a class="btn btn-primary" href="index.php">Inicio</a>
<hr>
    <div class="row">
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
                        
                        <?php
                        for ($i=0; $i <count($u) ; $i++) { 
                        echo'<tr>';  
                        echo'<td>'.$u[$i]['CEP'].'</td>';
                        echo'<td>'.$u[$i]['LOGRADOURO'].'</td>';
                        echo'<td>'.$u[$i]['COMPLEMENTO'].'</td>';
                        echo'<td>'.$u[$i]['BAIRRO'].'</td>';
                        echo'<td>'.$u[$i]['LOCALIDADE'].'</td>';
                        echo'<td>'.$u[$i]['UF'].'</td>';
                        echo'<td>'.$u[$i]['IBGE'].'</td>';
                        echo'<td>'.$u[$i]['GIA'].'</td>';
                        echo'<td>'.$u[$i]['DDD'].'</td>';
                        echo'<td>'.$u[$i]['SIAFI'].'</td>';
                        echo'</tr>';  

                        }
                    
                        ?>
                    </tbody>
                </table>
            </div>      
        </div>
    </div>
</div>
   

<?php 
   
require __DIR__.'/includes/footer.php'; ?>