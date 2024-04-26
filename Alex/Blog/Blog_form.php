<?php
require_once('./classe/Tarefa.php');

class Blog_form {
  private $html;
  private $dados;
  private $items = "";
  ////////////////////CONSTRUTOR////////////////////
  public function __construct(){
    $this->html = file_get_contents('./html/index.html');
  }
  public function show(){
    //mostrando o formulario na tela 
    //carregando os componentes
    $header = file_get_contents("./html/Componentes/header.html");
    $footer = file_get_contents("./html/Componentes/footer.html");
    //trocando a marcação no HTML
    $this->html = str_replace('{header}', $header, $this->html);
    $this->html = str_replace('{footer}', $footer, $this->html);
    //variaveis de marcação
    $this->html = str_replace('{registros}' ,$this->items, $this-> html);
    print $this->html;
  }
  ////////////////////LISTAR//////////////////////
  public function listar(){
    //recebe os parametros para salvar
    //recebe os parametros para editar
    try {
      //usando a classe criada em PDF anterio
      //salvcar os dados vuindo form
      $this->dados = Tarefa::all();
      //atualizando os dados com registro inserido
      foreach ($this->dados as $postar) {

        $item =  file_get_contents("./html/Componentes/rowTable.html");
        $item = str_replace('{id}', $postar['id'], $item);
        $item = str_replace('{POST}', $postar['post'], $item);
        $item = str_replace('{data}', $postar['data'], $item);
        $item = str_replace('{hora}', $postar['hora'], $item);
        $item = str_replace('{RA}', $postar['RA'], $item);
        $this->items .= $item;
      }
    } catch (Exception $e) {
      echo "<pre>";
      print_r($e);
      exit();
    }
  }
 ////////////////////DELETAR//////////////////////
  public function delete($param){
    //recebe parametros para deletar
    try {
      $id = (int) $param['id'];
      //retorna um vetor que passa para os dados
      $this->dados = Tarefa::delete($id);
      print "Post deletado com sucesso . . .";
      header("location: http://localhost/202404/blog/index.php?class=Blog_form&method=listar");

    }catch (Exception $e) {
      echo "<pre>";
      print_r($e);
      exit();
    }
  }
}
