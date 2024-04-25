<?php 
//rodando classes automaticamnete 
spl_autoload_register(function ($class){
    if(file_exists($class . '.php')){
        require_once $class . '.php';
    }
});
//verificando se existe parametro class na URL
$classe = $_REQUEST ['class'];
//verificando se existe a passagem de métado na URL
$metodo = isset($_REQUEST['method']) ? $_REQUEST ['method'] : null;
//verificando se existe a classe 
if (class_exists($classe)) {

    $pagina = new $classe($_REQUEST);
    //verificando se existe o métado
    if (!empty($metodo) and method_exists($classe, $metodo)){
        $pagina->$metodo($_REQUEST);
    }
    //posso abrir a tela caso não seja informado classe
    //basta alterar a posição do method abaixo
    $pagina->show();
}