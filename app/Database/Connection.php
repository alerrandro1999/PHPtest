<?php

namespace App\Database;

use PDO;
use PDOException;



class Connection{

    //Local de conexão
    const HOST = 'localhost';

    //Usuário
    const USER = 'root';

    //Nome do banco
    const DATABASE = 'viacep';

    //Senha do banco
    const PASS = '';

    
  //Função para a conexão com o banco
  function Conn(){

        try {
            $pdo = new PDO('mysql:host='.self::HOST.';dbname='.self::DATABASE, self::USER, self::PASS);
            $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            return $pdo;
        } catch (PDOException $e) {
            throw new PDOException("Erro na conexão com o banco");
        }

    }

}