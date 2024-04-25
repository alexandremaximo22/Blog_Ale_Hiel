<?php
//Classe Tarefa
// 1 Declarar propriedades ou métodos de uma classe como estáticos STATIC faz deles acessíveis sem a necessidade de instanciar a classe. Um membro declarado como estático não pode ser acessado através de uma
//instância da classe, e assim podemos chamar os métodos com ao inves de instanciar o objeto.
//2 Propriedades estáticas são acessíveis utilizando o Operador de Resolução de Escopo (::) e não podem ser acessados através do operador de objeto (->).
//Tarefa::all() ou Tarefa::find(25)
//3 SELF é usado para acessar membros estáticos. 0 $this aponta para o objeto e o self aponta para a classe 
// em si. Tarefa::teste(); Mas geralmente o self será usado para acessar dados estáticos da classe.

class Tarefa
{
    private static $conn;
    public static function getConnection()
    {
        if (empty(self::$conn)) {
            try {
                //pegando os parametros de inicialização do sistema
                $ini = parse_ini_file('./config/config.ini');
                $banco = $ini['banco'];
                $servidor = $ini['servidor'];
                $usuario = $ini['usuario'];
                $senha = $ini['senha'];
                //gerar o proximo ID - método Theylon
                self::$conn = new PDO("mysql:dbname={$banco};host={$servidor};charset=utf8", $usuario, $senha);
                self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                return self::$conn;
            } catch (Exception $error) {

                echo "<pre>";
                print_r($error);
                exit();
            }
        }
    }
    public static function find($id)
    {
        try {
            $conn = self::getConnection();
            $sql = "SELECT * FROM tarefas WHERE id = {$id}";
            //ultilização do método QUERY do objeto $conn tipo PDO
            $result = $conn->query($sql);
            $linha = $result->fetch(PDO::FETCH_ASSOC);
            //FECHANDO a conexao
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
            //lista tarefas

            $conn = self::getConnection();
            $id_int = (int) $id;
            $sql = "DELETE FROM tarefas WHERE  id = {$id_int}";
            //ultilização do método query do objeto $conn tipo PDO
            //retorna TRUE ou FALSE se conseguiu fazer a exclusão
            $result = $conn->exec($sql);
            if ($result) {
                $resultado = true;
            } else {
                $resultado = false;
            }
            //fechadno a conexão 
            $conn = null;
            return $resultado;
        } catch (Exception $error) {
            echo "<pre>";
            print_r($error);
            exit();
        }
    }
    public static function all()
    {
        try {
            //listar tarefas
            $conn = self::getConnection();
            $sql = "SELECT * FROM tarefas WHERE raAluno = 979675 ORDER BY descricao and id";
            //ultilização do método QUERY do objeto $conn tipo PDO
            $result = $conn->query($sql);
            $registros = $result->fetchall(PDO::FETCH_ASSOC);
            //FECHANDO a Conexao
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
                //pegando o ID via get
                $id = intval($tarefa['id']);
                //ultilização do método prepare
                $sql = "UPDATE posts SET post = :post, data = :data, hora = :hora, RA = :RA WHERE id = :id";
                $prepare = $conn->prepare($sql);
                //bindParam("campo", $variavel ,Tipo_da_Variavel); -PDO::PARAM_STR para STRINGS;
                $prepare->bindValue(":id", $id, PDO::PARAM_INT);
                $prepare->bindValue(":post", $tarefa['post'], PDO::PARAM_STR);
                $prepare->bindValue(":data", $tarefa['data'], PDO::PARAM_INT);
                $prepare->bindValue(":hora", $tarefa['hora'], PDO::PARAM_INT);
                $prepare->bindValue(":RA", $tarefa['RA'], PDO::PARAM_STR);
                $prepare->execute();
                $conn = null;
                print "Salvo com sucesso!";
                header("location: https://localhost/Blog/lista_tarefa.php");
            } else {
                $conn = self::getConnection();
                //pegando o PROXIMO ID VIA FUNCAO
                $sql = "SELECT max(id) as next FROM posts";
                //ultilização do método QUERY  do objeto $conn tipo PDO
                $result = $conn->query($sql);
                $linha = $result->fetch(PDO::FETCH_ASSOC);
                //adiciona +1 no maior ID na tabela
                $nextid = (int) $linha['next'] + 1;

                //ultilização do método prepare
                $prepare = $conn->prepare("INSERT INTO posts (id, post, data, hora, RA) VALUES (:id, :post, :data, :hora, :RA)");
                //bindParam("campo", $variavel , tipo_da_variavel); -PDO::PARAM_STR para STRINGS;
                $prepare->bindValue(":id", $nextid, PDO::PARAM_INT);
                $prepare->bindValue(":post", $tarefa['post'], PDO::PARAM_STR);
                $prepare->bindValue(":data", $tarefa['data'], PDO::PARAM_STR);
                $prepare->bindValue(":hora", $tarefa['hora'], PDO::PARAM_STR);
                $prepare->bindValue(":RA", $tarefa['RA'], PDO::PARAM_STR);
                $prepare->execute();
                $count = $prepare->execute();
                echo $count;
                $conn = null;
                header("location: htpps://localhost/Blog/lista_tarefa.php");
            }
        } catch (Exception $error) {

            echo "<pre>";
            print_r($error);
            exit();
        }
    }

    public function show()
    {
        // //mostrar o formulario na tela
        // //carregando os componentes
        // $header = file_get_contents("./html/Componentes/header.html");
        // $footer = file_get_contents("./html/Componentes/footer.html");
        // //trocando a marcação no HTML
        // $this->html = str_replace('{header}', $header, $this->html);
        // $this->html = str_replace('{footer}', $header, $this->html);
        // //variaveis de marcacao
        // $this->html = str_replace('{registros}', $this->items, $this->html);
        // print $this->html;

    }
}
