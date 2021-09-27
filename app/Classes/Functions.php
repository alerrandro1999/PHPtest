<?php

namespace App\Classes;

use \App\Database\Connection;
use PDOException;

class Functions extends Connection{

        
    //Função para cadastrar o endereço
    public function CadEndereco($values){
       try {
        //DADOS DA QUERY
        $fields = array_keys($values);
        $binds  = array_pad([],count($fields),'?');
    
        //MONTA A QUERY
        $query = $this->Conn()->prepare('INSERT INTO endereco ('.implode(',',$fields).') VALUES ('.implode(',',$binds).')');

        //EXECUTA 
        $query->execute(array_values($values));
    
       } catch (\PDOException $e) {
           header('Location: http://localhost/PHPtest/index.php?status=erro');
           exit;
       }
    
    }


    //Função para buscar o endereço caso já tenha sido cadastrado 
    public function BuscEndereco($value){
        try {
         $sql = $this->Conn()->prepare('SELECT CEP, LOGRADOURO, COMPLEMENTO, BAIRRO, LOCALIDADE, UF, IBGE, GIA, DDD, SIAFI 
                                        FROM ENDERECO WHERE CEP = '.$value.' ');
         $sql->execute();
         
         if ($sql->rowCount() > 0) {
        return $sql->fetchAll(\PDO::FETCH_ASSOC);
         }
        } catch (PDOException $e) {
            header('Location: http://localhost/PHPtest/index.php?status=errordata');
            exit;
        }
    }

    //Buscas todos os endereços
    public function BuscCompleto(){
        try {
         $sql = $this->Conn()->prepare('SELECT CEP, LOGRADOURO, COMPLEMENTO, BAIRRO, LOCALIDADE, UF, IBGE, GIA, DDD, SIAFI 
                                        FROM ENDERECO');
         $sql->execute();
         
         if ($sql->rowCount() > 0) {
        return $sql->fetchAll(\PDO::FETCH_ASSOC);
         }
        } catch (PDOException $e) {
         echo 'Erro com o acesso ao banco de dados';
        }
    }
    
    //Transforma XML em array
    public function XML2Array(\SimpleXMLElement $dadosCEP)
    {
        $array = array();

        foreach ($dadosCEP as $name => $element) {
            ($node = & $array[$name])
                && (1 === count($node) ? $node = array($node) : 1)
                && $node =  $node;

            $node = $element->count() ? $this->XML2Array($element) : trim($element);
        }

        return $array;
    }
    
    
}
