<?php
require_once './classe/tarefa.php';

class PostForm
{
    private $html;
    private $dados;
    
    public function __construct(){
    //carrega O HTML 
    //lendo um HTML COM FILEGETCONTENTs
    // $this->html = file_get_contents("./html/forms/form_Tarefa.html");
    $this->html = file_get_contents("./html/forms/form_Blog.html");
    $this->dados['id'] = "";
    $this->dados['post'] = "";
    $this->dados['data'] = "";
    $this->dados['hora'] = "";
    $this->dados['RA'] = "";


    }
    public function show()
    {
        //mostra o formulário na tela
        //carregasndo so componentes
        // $header = file_get_contents("./html/Componentes/header.html");
        // $footer = file_get_contents("./html/Componentes/footer.html");
        //trocando a marcação no html
        // $this->html = str_replace('{header}', $header, $this->html);
        // $this->html = str_replace('{footer}', $footer, $this->html);
        //variaveis de marcacao
        $this->html = str_replace('{id}', $this->dados['id'], $this->html);
        $this->html = str_replace('{post}', $this->dados['post'], $this->html);
        $this->html = str_replace('{data}', $this->dados['data'], $this->html);
        $this->html = str_replace('{hora}', $this->dados['hora'], $this->html);
        $this->html = str_replace('{RA}', $this->dados['RA'], $this->html);
        print $this->html;
        

    }

    public function edit($param)
    {
        //recebe parametros para editar
        try{
            $id = (int) $param['id'];
            //usando a classe criada em PDF anterior 
            //retorna um vetor e que passa os dados
            $this->dados = Tarefa::find($id);
            print "Tarefa Localizada com Sucesso.....";
        } catch (Exception $error) {

            echo "<pre>";
            print_r($error);
            exit();
        }
        
    }

    public function save($param)
    {
        //recebe parametros para salvar no banco
        //recebe parametros para editar
        try {
            //usando a classe criada em PDF anterior 
            //salva  os dados vindo do Form
            Tarefa::save($param);
            //atualiza os dados com o registro inserido
            $this->dados = $param;
            print "Tarefa Salva Com Sucesso....";
        } catch (Exception $error) {

            echo "<pre>";
            print_r($error);
            exit();
        }

    }

   
}