<?php
class Tarefa
{
    private static $conn;
    public static function getConnection(){
        if (empty(self::$conn)) {
            try {
                //Pegando os paramentros de inicializacao do sistema
                $ini = parse_ini_file('./config/config.ini');
                $banco = $ini['banco'];
                $servidor = $ini['servidor'];
                $usuario = $ini['usuario'];
                $senha = $ini['senha'];
                //gerar o proximo ID - Método Theylon
                self::$conn = new PDO("mysql:dbname={$banco};host={$servidor};charset=utf8", $usuario, $senha);
                self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                echo "conectado";
                return self::$conn;
            } catch (Exception $error) {

                echo "<pre>";
                print_r($error);
                exit();
            }
        }
    }

    public static function find($id) // GET TAREFA
    { 
        try {
            $conn = self::getConnection();
            $sql = "SELECT * FROM posts  WHERE id = {$id}";
            //utilizaçao do método QUERY do objeto $conn tipo PDO
            $result = $conn->query($sql);
            $linha = $result->fetch(PDO::FETCH_ASSOC);
            //FECHANDO A Conexao
            $conn = null;
            return $linha;
        } catch (Exception $error) {
            echo "<pre>";
            print_r($error);
            exit();
        }
    }
    public static function delete($id)
    {
        try {
            //Listar tarefas

            $conn = self::getConnection();
            $id_int = (int) $id;
            $sql = "DELETE FROM tarefas WHERE id = {$id_int}";
            //utilizaçao do método QUERY do objeto $conn tipo PDO
            //retorna TRUE ou FALSE se conseguiu fazer a exclusão
            $result = $conn->exec($sql);
            if ($result) {
                $resultado = true;
            } else {
                $resultado = false;
            }
            //FECHANDO A Conexao
            $conn = null;
            return $resultado;
        } catch (Exception $error) {

            echo "<pre>";
            print_r($error);
            exit();
        }
    }
    public static function all() //LISTAR TAREFA
    {
        try {

            //Listar tarefas
            $conn = self::getConnection();
            $sql = "SELECT * FROM `posts` WHERE RA = 822729 ORDER BY post ASC";
            //utilizaçao do método QUERY do objeto $conn tipo PDO
            $result = $conn->query($sql);
            $registros = $result->fetchAll(PDO::FETCH_ASSOC);
            //FECHANDO A Conexao
            //$conn = null;
            return $registros;
        } catch (Exception $error) {

            echo "<pre>";
            print_r($error);
            exit();
        }
    }

    public static function save($tarefa)
    {
        try {
            if (!empty($tarefa['id'])) {
                $conn = self::getConnection();
                //PEGANDO O ID via GET
                $id = intval($tarefa['id']);
                //utilização do método prepare
                $sql = "UPDATE tarefas SET descricao = :descricao, data = :data, hora =  :hora, raAluno=:raAluno  WHERE id = :id";
                $prepare = $conn->prepare($sql);
                //bindParam("campo",  $variavel ,Tipo_da_Variavel);  - PDO::PARAM_STR para STRINGS;
                $prepare->bindValue(":id", $id, PDO::PARAM_INT);
                $prepare->bindValue(":descricao", $tarefa['tarefa'], PDO::PARAM_STR);
                $prepare->bindValue(":data", $tarefa['data'], PDO::PARAM_STR);
                $prepare->bindValue(":hora", $tarefa['hora'], PDO::PARAM_STR);
                $prepare->bindValue(":raAluno", $tarefa['raAluno'], PDO::PARAM_STR);
                $count =  $prepare->execute();
                echo $count;
                $conn = null;
                header("location: http://localhost/04/classeLVL7/index.php?class=Lista_tarefa&method=listar");
            } else {
                $conn = self::getConnection();
                //PEGANDO O PRÓXIMO ID VIA FUNCAO
                $sql = "SELECT max(id) as next  FROM tarefas";
                //utilizaçao do método QUERY do objeto $conn tipo PDO
                $result = $conn->query($sql);
                $linha = $result->fetch(PDO::FETCH_ASSOC);
                //Adiciona +1 no maior ID na tabela 
                $nextid = (int) $linha['next'] + 1;

                //utilização do método prepare
                $prepare = $conn->prepare("INSERT INTO tarefas (id,descricao, data, hora, raAluno) VALUES (:id, :descricao, :data, :hora, :raAluno)");
                //bindParam("campo",  $variavel ,Tipo_da_Variavel);  - PDO::PARAM_STR para STRINGS;
                $prepare->bindValue(":id", $nextid, PDO::PARAM_INT);
                $prepare->bindValue(":descricao", $tarefa['tarefa'], PDO::PARAM_STR);
                $prepare->bindValue(":data", $tarefa['data'], PDO::PARAM_STR);
                $prepare->bindValue(":hora", $tarefa['hora'], PDO::PARAM_STR);
                $prepare->bindValue(":raAluno", $tarefa['raAluno'], PDO::PARAM_STR);
                $count = $prepare->execute();
                echo  "<br> {$count} linhas foram inseridas <br>";
                $conn = null;
                header("location: http://localhost/04/classeLVL7/index.php?class=Lista_tarefa&method=listar");
                // header("location: http://localhost/04/Classe_Tarefa/lista_tarefa.php");
            }
        } catch (Exception $error) {

            echo "<pre>";
            print_r($error);
        }
    }
}
