<?php 
class Connection 
{
    private static $conn;
    private function __construct()
    {
        // EM BRANCO 
    }
    // ABRINDO 
    public static function open($name){
        // VERIFICANDO SE EXISTE O ARQUIVO CONFIG.ION
        if(file_exists("config/{$name}.ini")){
            $db = parse_ini_file("config/{$name}.ini");
        }else {
            throw new Exception("Arquivo {$name} não encontrado");
        }
        // verificando as variaveis no config.in e vericando se existem
        $user = isset($db['user']) ? $db['user'] : null;
        $pass = isset($db['pass']) ? $db['pass'] : null;
        $name = isset($db['name']) ? $db['name'] : null;
        $host = isset($db['host']) ? $db['host'] : null;
        $type = isset($db['type']) ? $db['type'] : null;
        $port = isset($db['port']) ? $db['port'] : null;

        //qual será o tipo de banco de dados usado no sistema?
        try{
            switch ($type) {
            case 'pgsql':
                //$port = isset();
                break;
            case 'mysql':
                $port = isset($db['port']) ? $db['port'] : '3306';
                self::$conn = new PDO("mysql:dbname={$port};host={$host};charset=utf8", $user, $pass);
                break;
            case 'sqlite':
                self::$conn = new PDO("sqlite:{$name}");
                //echo '<br>';
                echo " classe conncetion diz: conectado ao banco SQLite {$name} com Sucesso! </br>";
                break;
        }
        
        self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return self::$conn;

        }catch(PDOException $e){
            echo $e->getMessage();
            exit;
        }

    }
}


