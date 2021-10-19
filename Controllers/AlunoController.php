<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AlunoController
 *
 * @author Kasoft Development
 */


require_once 'Models/Classe_.php';
require_once 'Models/Classe_Model.php';
require_once 'Models/PessoaModel.php';
require_once 'Models/Pessoa.php';
require_once 'Models/Aluno.php';
require_once 'Models/AlunoModel.php';
require_once 'Models/Matricula.php';
require_once 'Models/MatriculaModel.php';
require_once 'Models/Morada.php';
require_once 'Models/MoradaModel.php';



class AlunoController {
    //put your code here
    
    
    public function consultarDadosAction() {
       $view = new view('Views/consultarAluno.phtml');
       $view->showContents();
    }
    public function alterarDadosAction() {
       $view = new view('Views/alterarAluno.phtml');
       $view->showContents();
    }
    
    
     public function pesquisarAction() {
        
//        $modelo = new MatriculaModel();
        $modelo1 = new AlunoModel();
        $modelo2 = new Classe_Model();
        $modelo3 = new PessoaMOdel();
//        $modelo4 = new MoradaModel();
        
//        $matricula = new Matricula();
//        $morada = new Morada();
        $aluno = new Aluno();
        $classe = new Classe_();
        $pessoa = new Pessoa();
        
        
        
        
        $cod_Aluno = addslashes(htmlspecialchars($_POST['bi_cp']));
        
        
//        var_dump($cod_Aluno);
//        die();
        
        $view = new view('Views/confirmarMatricula.phtml');
        
        
//        $dados = $modelo->consultarMatricula($matricula);
//        $idAluno = $dados->getIdAluno();
        
        $dados1 = $modelo1->consultar($cod_Aluno);
//        $idClasse = $dados1->getIdClasse();
        $idPessoa = $dados1->getIdPessoa();
        
        $dados2 = $modelo2->listar();
        $dados3  = $modelo3->consultar($idPessoa);
//        $idMorada = $dados3->getIdMorada();
        
//        $dados4 = $modelo4->consultar($idMorada);
//        .'<br>'.$dados1.'<br>'.$dados2.'<br>'.$dados3.'<br>'.$dados4
        
       $view->setParams(array("dados1" => $dados1,"dados2" => $dados2,"dados3" => $dados3));
       $view->showContents();
    }
    
     public function pesquisarDadosAction() {
        
        $modelo = new MatriculaModel();
        $modelo1 = new AlunoModel();
        $modelo2 = new Classe_Model();
        $modelo3 = new PessoaMOdel();
        $modelo4 = new MoradaModel();
        
        $matricula = new Matricula();
        $morada = new Morada();
        $aluno = new Aluno();
        $classe = new Classe_();
        $pessoa = new Pessoa();
        
        
        
        
        $cod_Aluno = addslashes(htmlspecialchars($_POST['bi_cp']));
        
        
//        var_dump($cod_Aluno);
//        die();
        
        $view = new view('Views/consultarAluno.phtml');
//        $view = new view('Views/alterarAluno.phtml');
        
        
       
        
        $dados1 = $modelo1->consultar($cod_Aluno);
        $idAluno = $dados1->getId();
        
//         $dados = $modelo->consultarMatricula($matricula);
//        $idAluno = $dados->getIdAluno();
        
        $idClasse = $dados1->getIdClasse();
        $idPessoa = $dados1->getIdPessoa();
        
        $dados2 = $modelo2->consultar($idClasse);
        $dados3  = $modelo3->consultar($idPessoa);
        $idMorada = $dados3->getIdMorada();
        
        $dados4 = $modelo4->consultar($idMorada);
//        .'<br>'.$dados1.'<br>'.$dados2.'<br>'.$dados3.'<br>'.$dados4
        
       $view->setParams(array("dados1" => $dados1,"dados2" => $dados2,"dados3" => $dados3,"dados4" => $dados4));
       $view->showContents();
    }
    
     public function pesquisarDadoAction() {
        
        $modelo = new MatriculaModel();
        $modelo1 = new AlunoModel();
        $modelo2 = new Classe_Model();
        $modelo3 = new PessoaMOdel();
        $modelo4 = new MoradaModel();
        
        $matricula = new Matricula();
        $morada = new Morada();
        $aluno = new Aluno();
        $classe = new Classe_();
        $pessoa = new Pessoa();
        
        
        
        
        $cod_Aluno = addslashes(htmlspecialchars($_POST['bi_cp']));
        
        
//        var_dump($cod_Aluno);
//        die();
        
//        $view = new view('Views/consultarAluno.phtml');
        $view = new view('Views/alterarAluno.phtml');
        
        
       
        
        $dados1 = $modelo1->consultar($cod_Aluno);
        $idAluno = $dados1->getId();
        
//         $dados = $modelo->consultarMatricula($matricula);
//        $idAluno = $dados->getIdAluno();
        
        $idClasse = $dados1->getIdClasse();
        $idPessoa = $dados1->getIdPessoa();
        
        $dados2 = $modelo2->consultar($idClasse);
        $dados3  = $modelo3->consultar($idPessoa);
        
        
//        print_r($dados3);
//        die();
        
        $idMorada = $dados3->getIdMorada();
        
        $dados4 = $modelo4->consultar($idMorada);
//        .'<br>'.$dados1.'<br>'.$dados2.'<br>'.$dados3.'<br>'.$dados4
        
       $view->setParams(array("dados1" => $dados1,"dados2" => $dados2,"dados3" => $dados3,"dados4" => $dados4));
       $view->showContents();
    }
    
    
    public function alterarAction() {

        $pessoa = new Pessoa();
        $aluno = new Aluno();
        $morada = new Morada();
        $matricula = new Matricula();
        
        $modelo = new MatriculaModel();
        $modelo1 = new PessoaMOdel();
        $modelo2 = new MoradaModel();
        $modelo3 = new AlunoModel();
//
        //Inicio da secção para registo do aluno
//        $ano_letivo=  date("Y");
        
        
        $cod_aluno = $_POST['cod_aluno'];
//        $aluno->setId($_POST['idAluno']);
        $aluno->setCod_aluno(addslashes(trim(htmlentities(strtoupper($_POST['bi_cp'])))));
        $bi_cp = addslashes(trim(htmlentities(strtoupper($_POST['bi_cp']))));
      
        
        $idPessoa = $_POST['idPessoa'];
        $pessoa->setId($idPessoa);
        $pessoa->setNome(addslashes(trim(htmlentities(strtoupper($_POST['nome'])))));
        $pessoa->setSobrenome(addslashes(trim(htmlentities(strtoupper($_POST['sobrenome'])))));
        $pessoa->setGenero($_POST['genero']);
        $pessoa->setTelefone($_POST['telefone']);
        $pessoa->setNome_pai(addslashes(trim(htmlentities(strtoupper($_POST['nome_pai'])))));
        $pessoa->setNome_mae(addslashes(trim(htmlentities(strtoupper($_POST['nome_mae'])))));
        $pessoa->setData_nascim(date("Y-m-d", strtotime($_POST['data_nascim'])));
        $pessoa->setNaturalidade(addslashes(trim(htmlentities(strtoupper($_POST['naturalidade'])))));
        $pessoa->setBi_cp(addslashes(trim(htmlentities(strtoupper($_POST['bi_cp'])))));
        
        $idMorada = $_POST['idMorada'];
        $morada->setId($idMorada);
        $morada->setMunicipio(strtoupper($_POST['municipio']));
        $morada->setBairro(strtoupper($_POST['bairro']));
        $morada->setRua(strtoupper($_POST['rua']));
        $morada->setNum_casa($_POST['num_casa']);
 
        $confirmacao = $modelo2->alterar($morada);
        
                
        if ($confirmacao = 'true') {
            
            $confirmacao1 = $modelo1->alterar($pessoa);
            
            if ($confirmacao1 = 'true') {
                
                $confirmacao2 = $modelo3->alterarDados($aluno,$idPessoa);
                
//                var_dump($confirmacao2);
//                die();
                
                
                if ($confirmacao2 = 'true') {
                    
                    $dadoMatricula = $modelo->consultarPorCod_aluno($cod_aluno);
                    
                    $num_processo_antigo = $dadoMatricula->getNum_processo();
                    
                    $ano_letivo = substr($dadoMatricula->getNum_processo(), -4);
                    $matricula->setNum_processo($pessoa->getBi_cp());
//                    $matricula->set($idAluno);
                    
                    
                    $confirmacao3 = $modelo->alterarNum_processo($matricula,$num_processo_antigo);
                    
                    
                if ($confirmacao3 = 'true') {
                        Application::redirect("?controller=Aluno&action=AlterarDados&u=" . md5(1));
                    }  else {
                         Application::redirect("?controller=Aluno&action=AlterarDados&u=" . md5(2));
                    }
                }  else {
                    Application::redirect("?controller=Aluno&action=AlterarDados&u=" . md5(2));
                }
                
            }  else {
                Application::redirect("?controller=Aluno&action=AlterarDados&u=" . md5(2));
            }
            
        }  else {
            Application::redirect("?controller=Aluno&action=AlterarDados&u=" . md5(2));
        }
        
        
    }
}
