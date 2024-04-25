<?php
// require_once('./classe/Tarefa.php');

class Blog_form {
  private $html;
  private $dados;
  private$items = "";
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
}
