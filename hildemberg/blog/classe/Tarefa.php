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
                // echo "conectado";
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
            $sql = "SELECT * FROM posts WHERE id = {$id}";
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
            $sql = "DELETE FROM posts WHERE id = {$id_int}";
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
            $sql = "SELECT * FROM `posts`  ORDER BY post ASC";
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
    public static function like($post){
        try {
            // $id = (int) $post['id'];
            // $like = (int) $post['likePost'];
            if (!empty($post['id'])) {
                $conn = self::getConnection();
                //pegando o ID via get
                $id = intval($post['id']);
                $likePost = intval(($post['likePost']));
                $likePost ++ ;
                // var_dump($id);
                // var_dump($likePost);
                // exit();
                $sql = "UPDATE posts SET likePost = :likePost  WHERE id = :id";
                $stmt = $conn->prepare($sql);
                $stmt->bindValue(':likePost', $likePost, PDO::PARAM_INT);
                $stmt->bindValue(':id', $id,PDO::PARAM_INT);
                $stmt->execute();
                $conn = null;
                header('Location: http://localhost/202404/blog/index.php?class=Blog_form&method=listar');
                
            }else{
                $conn = self::getConnection();
                //pegando as variaveis de id deslike
                $id = intval($post['id']);
                $DesLike = intval(($post['DesLike']));
                $DesLike ++ ;
                // var_dump($id);
                // var_dump($DesLike);
                // exit();  
                $sql = "UPDATE posts SET DesLike = :DesLike WHERE id = :id";
                $stmt = $conn->prepare($sql);
                $stmt->bindValue(':DesLike', $DesLike, PDO::PARAM_INT);
                $stmt->bindValue(':id', $id,PDO::PARAM_INT);
                $stmt->execute();
                $conn = null;
                // header('Location: http://http://localhost/202404/blog/index.php?class=Blog_form&method=listar');
            }
        } catch (Exception $error) {
            echo $error->getMessage();
            $conn = null;
            echo "**Deu erro";
        }
    }

}

