<?php

// use FTP\Connection;
class Teste
{
    // require_once "./config/Connection.php";
    // include './config/Connection.php';
    
    public static $conn;
    
        public static function teste_1(){
        if (empty(self::$conn)){
             static $name;
             
                //Pegando os paramentros de inicializacao do sistema
                $ini = parse_ini_file('./config/config.ini');
                $banco = $ini['banco'];
                $servidor = $ini['servidor'];
                $usuario = $ini['usuario'];
                $senha = $ini['senha'];
                

                Connection::open($name);
        }
    }
}