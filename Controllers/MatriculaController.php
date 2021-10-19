<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of MatriculaController
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

class MatriculaController {
    //put your code here
    
    public function registarAction() {
        
        $modelo = new Classe_Model();
        
        $view = new view('Views/registarMatricula.phtml');
        $dados = $modelo->listar();
        $view->setParams(array("dados" => $dados));
       $view->showContents();
    }
    
    
    public function pesquisarMatriculaAction() {
        $view = new view('Views/pesquisarMatricula.phtml');
       $view->showContents();
    }
    public function confirmarMatriculaAction() {
        $view = new view('Views/confirmarMatricula.phtml');
       $view->showContents();
    }
    public function alterarMatriculaAction() {
        $view = new view('Views/alterarMatricula.phtml');
       $view->showContents();
    }
    
    public function confirmarAction() {

        $matricula = new Matricula();
        $aluno = new Aluno();
        $classe = new Classe_();
        $pessoa = new Pessoa();
//        $modeloP = new pessoaModel();
//        $modeloM = new moradaModel();
        $modelo = new MatriculaModel();
        $modelo1 = new Classe_Model();
        $modelo3 = new AlunoModel();
//
        //Inicio da secção para registo do aluno
        $aluno->setCod_aluno($_POST['cod_aluno']);
        $matricula->setNum_processo($_POST['cod_aluno']);
        $matricula->setAno_lectivo($_POST['ano_lectivo']);
        $matricula->setTipo_matricula("ANTIGA");
        $idpessoa=  $_POST['idPessoa'];
        $idClasse = $_POST['idClasse'];
        //Fim da secção
        
        //Inicio da secção para registo da matricula
        //$matricula->setData_registo(date()['valor_matricula']);
        //Fim da secção
      
        
                $dado_classe = $modelo1->consultar($idClasse);
                
                $matricula->setValor($dado_classe->getValor_confirmacao());
                
                $dadoAluno = $modelo3->cadastrar($aluno,$idClasse,$idpessoa);
                
                
//                bugando
//                var_dump($dadoAluno->getId());
//                die();
                
                $idAluno = $dadoAluno->getId();
                
               
                if (isset($dadoAluno) && $idAluno !== 0) {
                    
                    $dadoMatricula = $modelo->cadastrar($matricula,$idAluno);
                    
                    $idMatricula = $dadoMatricula->getId();
                    
//                var_dump($idMatricula);
//                die();
                    if (isset($dadoMatricula) && $idMatricula !== 0) {
                        Application::redirect("?controller=Matricula&action=confirmarMatricula&u=" . md5(1));
                    }  else {
//                        $modelo3->eliminar($idAluno);
                         Application::redirect("?controller=Matricula&action=confirmarMatricula&u=" . md5(2));
                    }
                } else {
                         Application::redirect("?controller=Matricula&action=confirmarMatricula&u=" . md5(2));
                }
        
        
    }
    
    public function cadastrarAction() {

        $pessoa = new Pessoa();
        $aluno = new Aluno();
        $morada = new Morada();
        $matricula = new Matricula();
        $classe = new Classe_();
//        $modeloP = new pessoaModel();
//        $modeloM = new moradaModel();
        $modelo = new MatriculaModel();
        $modelo1 = new PessoaMOdel();
        $modelo2 = new MoradaModel();
        $modelo3 = new AlunoModel();
//
        //Inicio da secção para registo do aluno
        $ano_letivo=  date("Y");
        $aluno->setCod_aluno(addslashes(trim(htmlentities(strtoupper($_POST['bi_cp'])))));
        //Fim da secção
        
        $idClasse=$_POST['idClasse'];
        
        
        //Inicio da secção para registo da matricula
        $matricula->setNum_processo($_POST['bi_cp']);
        $matricula->setAno_lectivo($ano_letivo);
        $matricula->setTipo_matricula("NOVA");
        $matricula->setValor($_POST['valor_matricula']);
        //$matricula->setData_registo(date()['valor_matricula']);
        //Fim da secção
       
        
        $pessoa->setNome(addslashes(trim(htmlentities(strtoupper($_POST['nome'])))));
        $pessoa->setSobrenome(addslashes(trim(htmlentities(strtoupper($_POST['sobrenome'])))));
        $pessoa->setGenero($_POST['genero']);
        $pessoa->setTelefone($_POST['telefone']);
        $pessoa->setNome_pai(addslashes(trim(htmlentities(strtoupper($_POST['nome_pai'])))));
        $pessoa->setNome_mae(addslashes(trim(htmlentities(strtoupper($_POST['nome_mae'])))));
        $pessoa->setData_nascim(date("Y-m-d", strtotime($_POST['data_nascim'])));
        $pessoa->setNaturalidade(addslashes(trim(htmlentities(strtoupper($_POST['naturalidade'])))));
        $pessoa->setBi_cp($_POST['bi_cp']);
        
        $morada->setMunicipio(strtoupper($_POST['municipio']));
        $morada->setBairro(strtoupper($_POST['bairro']));
        $morada->setRua(strtoupper($_POST['rua']));
        $morada->setNum_casa($_POST['num_casa']);
 
        $dadoMorada = $modelo2->cadastrar($morada);
            $idMorada = $dadoMorada->getId();
            
//             print $idMorada;
//            
//            die();
        
        if (isset($idMorada) && $idMorada !== 0) {
            
            $dadopessoa = $modelo1->cadastrar($pessoa, $idMorada);
            
            $idpessoa = $dadopessoa->getId();
            
            if (isset($idpessoa) && $idpessoa !== 0) {
                
                $dadoAluno = $modelo3->cadastrar($aluno,$idClasse,$idpessoa);
                
                $idAluno = $dadoAluno->getId();
                
               
                if (isset($idAluno) && $idAluno !== 0) {
                    
                    $dadoMatricula = $modelo->cadastrar($matricula,$idAluno);
                    
                    $idMatricula = $dadoMatricula->getId();
                    
                    if (isset($idMatricula) && $idMatricula !== 0) {
                        Application::redirect("?controller=Matricula&action=registar&u=" . md5(1));
                    }  else {
                         Application::redirect("?controller=Matricula&action=registar&u=" . md5(2));
                    }
                }  else {
                    Application::redirect("?controller=Matricula&action=registar&u=" . md5(2));
                }
                
            }  else {
                Application::redirect("?controller=Matricula&action=registar&u=" . md5(2));
            }
            
        }  else {
            Application::redirect("?controller=Matricula&action=registar&u=" . md5(2));
        }
        
        
    }
    
    public function alterarAction() {

        $matricula = new Matricula();
        $aluno = new Aluno();
        $classe = new Classe_();
        $pessoa = new Pessoa();
//        $modeloP = new pessoaModel();
//        $modeloM = new moradaModel();
        $modelo = new MatriculaModel();
        $modelo1 = new Classe_Model();
        $modelo3 = new AlunoModel();
//
        //Inicio da secção para registo do aluno
        //
        //
//        var_dump("aqui");
//        die();
//        $aluno->setCod_aluno($_POST['cod_aluno']);
        $aluno->setId($_POST['idAluno']);
        $idClasse = $_POST['idClasse'];
        $matricula->setId($_POST['idMatricula']);
//        $num_processo = ($_POST['cod_aluno'].$_POST['ano_lectivo']);
        $matricula->setNum_processo($_POST['cod_aluno']);
        $matricula->setAno_lectivo($_POST['ano_lectivo']);
        $matricula->setTipo_matricula("ANTIGA");
        
//        
//        var_dump($matricula->getNum_processo());
//        die();
        //Inicio da secção para registo da matricula
        //$matricula->setData_registo(date()['valor_matricula']);
        //Fim da secção
      
        
                
                $confirmacao = $modelo3->alterar($aluno,$idClasse);
                
//                $idAluno = $dadoAluno->getId();
                
//                var_dump($idAluno);
//                die();
               
                if ($confirmacao = TRUE) {
                    
//                    var_dump($matricula);
//                    die();
                    
                    $confirmacao2 = $modelo->alterar($matricula);
                    
                    if ($confirmacao2 = TRUE) {
                        Application::redirect("?controller=Matricula&action=alterarMatricula&u=" . md5(1));
                    }  else {
//                        $modelo3->eliminar($idAluno);
                         Application::redirect("?controller=Matricula&action=alterarMatricula&u=" . md5(2));
                    }
                } else {
                         Application::redirect("?controller=Matricula&action=alterarMatricula&u=" . md5(2));
                }
        
        
    }
    
    public function obterMatriculaProcessoAction() {
        
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
        
        
//        var_dump($_POST['num_processo']);
//        die();
       
                
        $dados = explode('/', $_POST['num_processo']);
        $bi_cp = $dados[0];
        $ano_lectivo = $dados[1];
        
        
        
        
        $matricula->setNum_processo($bi_cp);
        $matricula->setAno_lectivo($ano_lectivo);
        
//        print_r($matricula);
//        die();
        
        
//         $ano_lectivo = substr($_POST['num_processo'],-4);
        
        
        $dados = $modelo->consultarMatricula($matricula);
        
        
//        
//        print_r($dados);
//        die("segundo");
//        
//              
        
        if(!empty($dados) || $dados !== FALSE){
            
        $idAluno = $dados->getIdAluno();
        
        $dados1 = $modelo1->pesquisar($idAluno);
        
        $idClasse = $dados1->getIdClasse();
        $idPessoa = $dados1->getIdPessoa();
        
        $dados2 = $modelo2->consultar($idClasse);
        $dados3  = $modelo3->consultar($idPessoa);
        $idMorada = $dados3->getIdMorada();
        
        $dados4 = $modelo4->consultar($idMorada);
//        .'<br>'.$dados1.'<br>'.$dados2.'<br>'.$dados3.'<br>'.$dados4
        
       $view = new view('Views/pesquisarMatricula.phtml');
       $view->setParams(array("dados" => $dados,"dados1" => $dados1,"dados2" => $dados2,"dados3" => $dados3,"dados4" => $dados4));
       $view->showContents();
    }  else {
        Application::redirect("?controller=Matricula&action=pesquisarMatricula&u=" . md5(1));
    }
    }
    
    public function obterMatriculaAction() {
        
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
        
        
//        $matricula->setNum_processo($_POST['num_processo']);
//        $ano_lectivo = substr($_POST['num_processo'],-4);
//        $matricula->setAno_lectivo($ano_lectivo);
         $dados = explode('/', $_POST['num_processo']);
        $bi_cp = $dados[0];
        $ano_lectivo = $dados[1];
        
        $matricula->setNum_processo($bi_cp);
        $matricula->setAno_lectivo($ano_lectivo);
        
//         $ano_lectivo = substr($_POST['num_processo'],-4);
        
//        var_dump($ano_lectivo);
//        die();
        
        $view = new view('Views/alterarMatricula.phtml');
        
        
        $dados = $modelo->consultarMatricula($matricula);
        $idAluno = $dados->getIdAluno();
        
        $dados1 = $modelo1->pesquisar($idAluno);
        
        $idClasse = $dados1->getIdClasse();
        $idPessoa = $dados1->getIdPessoa();
        
        $dados5 = $modelo2->listar();
        $dados2 = $modelo2->consultar($idClasse);
        
      
        
            $dados3  = $modelo3->consultar($idPessoa);
            $idMorada = $dados3->getIdMorada();
        
        $dados4 = $modelo4->consultar($idMorada);
//        .'<br>'.$dados1.'<br>'.$dados2.'<br>'.$dados3.'<br>'.$dados4
        
       $view->setParams(array("dados" => $dados,"dados1" => $dados1,"dados2" => $dados2,"dados3" => $dados3,"dados4" => $dados4,"dados5" => $dados5));
       $view->showContents();
    }
    
   
}
