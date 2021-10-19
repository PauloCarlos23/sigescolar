<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Pagamento_PropinaController
 *
 * @author Kasoft Development
 */

require_once 'Models/Matricula.php';
require_once 'Models/MatriculaModel.php';
require_once 'Models/AlunoModel.php';
require_once 'Models/PessoaModel.php';
require_once 'Models/Classe_Model.php';
require_once 'Models/Pagamento_PropinaModel.php';

class Pagamento_PropinaController {
    //put your code here
    
    public function registarAction() {
        $view = new view('Views/registar-pagamento.phtml');
        $view->showContents();
    }
    
    public function efectuarPagamentoAction() {
        $view = new view('Views/formPagamento.phtml');
        $view->showContents();
    }
    
    public function cadastrarAction() {

        $pagamento = new Pagamento_Propina();
        $modelo = new Pagamento_PropinaModel();
        $modelo_ = new MatriculaModel();
        
        $meses = $_POST['mes'];
        $ano = $_POST['ano'];
        $observacao = $_POST['observacao'];
//        print $ano;
//        die();
        
//        $data_registo = $_POST['data'];
        //$idMatricula = base64_decode($_POST['idMatricula']);
//        $nomeCl = base64_decode($_POST['nome']);

        /*
        if ($data_registo == date("Y-m-d")){
            if (!empty($meses)) {

                $contador = count($meses);

                for ($i = 0; $i < $contador; $i++):
                    $mesesPagos = $modelo->obterPorIdMesesPagos($idMatricula);
                    $teste = array();

                    foreach ($mesesPagos as $v) {
//                         $teste = $v->getMes();
                        array_push($teste, $v->getMes());
                    }

                    if (in_array($meses[$i], $teste)) {
                        Application::redirect("?controller=Cliente&action=listarClientes&n=" . base64_encode($nomeCl) . "&mes=" . base64_encode($meses[$i]) . "&u=" . md5(2) . "-" . base64_encode($nomeCl));
//                        die();
                    } else {
                        $pagamento->setMes($meses[$i]);
                        $pagamento->setAno(date('Y'));
                        $pagamento->setData(date('Y-m-d'));
                        $pagamento->setValor('2000');
                        $idMatriculaiente = base64_decode($_POST['idMatriculaiente']);
                        $idUtilizador = $_POST['idUtilizador'];
                        $resultado = $modelo_->obterPorId($idMatriculaiente);
                        $pagamento->setValor($resultado->getMensalidade());
                        $retorno = $modelo->cadastrar($pagamento, $idMatriculaiente, $idUtilizador);
                    }

                endfor;

                if ($retorno == 1) {
                    Application::redirect("?controller=Cliente&action=listarClientes&u=" . md5(1));
                } else {
                    Application::redirect("?controller=Cliente&action=listarClientes&mes=" . base64_encode($_POST['mes']) . "&u=" . md5(2));
                }
//            $pagamento->setValor($resultado->getMensalidade());
//             $contador= count($meses);
//            
//            echo $contador;
//            
//            $meses = implode(", ", $meses);
//            echo $meses;
            } else {
                Application::redirect("?controller=Cliente&action=listarClientes&mes=" . base64_encode($_POST['mes']) . "&u=" . md5(3));
            }
        } 
        */
       // else {
            
            $idMatricula = base64_decode($_POST['idMatricula']);

            if (!empty($meses)) {
                $contador = count($meses);

                for ($i = 0; $i < $contador; $i++):

                    $ultimoMes = $modelo->obterPorIdUltimoPagamento($idMatricula);
                
//                    print_r($ultimoMes);
//                    die();
                

                $mesesPagos = $modelo->obterPagamentos($idMatricula,$ano);
                        $teste = array();

                        foreach ($mesesPagos as $v) {
                            array_push($teste, $v->getMes());
                        }
                        if (in_array($meses[$i], $teste)) {
                        Application::redirect("?controller=Pagamento_Propina&action=efectuarPagamento&name=" . base64_encode($_POST['name']) . "&mes=" . base64_encode($meses[$i]) . "&u=" . md5(2));
//                          
                        }
                        elseif ($ultimoMes->getMes() == $meses[$i] || $ultimoMes->getMes() == $meses[$i + 1]) {
                            Application::redirect("?controller=Cliente&action=listarClientes&mes=" . base64_encode($meses[$i]) . "&u=" . md5(2));
//                    
                        } 
                        elseif ($ultimoMes->getMes() == 'NULL' && $meses[$i] == 'JANEIRO') {
                        
                        
                        $pagamento->setMes($meses[$i]);
                        $pagamento->setObs($observacao);
                        $pagamento->setAno($ano);
                        $idMatricula = base64_decode($_POST['idMatricula']);
                        $idUtilizador = $_POST['idUtilizador'];
                        
                        $retorno = $modelo->cadastrar($pagamento, $idMatricula, $idUtilizador);

                    } elseif ($ultimoMes->getMes() == 'JANEIRO' && $meses[$i] == 'FEVEREIRO'){
                        
                        
                        $pagamento->setMes($meses[$i]);
                        $pagamento->setObs($observacao);
                        $pagamento->setAno($ano);
                        $idMatricula = base64_decode($_POST['idMatricula']);
                        $idUtilizador = $_POST['idUtilizador'];
                        
                        $retorno = $modelo->cadastrar($pagamento, $idMatricula, $idUtilizador);

                        } 
                        elseif ($ultimoMes->getMes() == 'FEVEREIRO' && $meses[$i] == 'MARCO') {
               
                        $pagamento->setMes($meses[$i]);
                        $pagamento->setObs($observacao);
                        $pagamento->setAno($ano);
                        $idMatricula = base64_decode($_POST['idMatricula']);
                        $idUtilizador = $_POST['idUtilizador'];
                        
                        $retorno = $modelo->cadastrar($pagamento, $idMatricula, $idUtilizador);
                        
                        } elseif ($ultimoMes->getMes() == 'MARCO' && $meses[$i] == 'ABRIL') {

                        $pagamento->setMes($meses[$i]);

                        $pagamento->setAno($ano);
                        $idMatriculaiente = base64_decode($_POST['idMatricula']);
                        $idUtilizador = $_POST['idUtilizador'];
                        $retorno = $modelo->cadastrar($pagamento, $idMatricula, $idUtilizador);
                            
                        } elseif ($ultimoMes->getMes() == 'ABRIL' && $meses[$i] == 'MAIO') {
//                        
                        $pagamento->setMes($meses[$i]);
                        $pagamento->setObs($observacao);
                        $pagamento->setAno($ano);
                        $idMatricula = base64_decode($_POST['idMatricula']);
                        $idUtilizador = $_POST['idUtilizador'];
                        
                        $retorno = $modelo->cadastrar($pagamento, $idMatricula, $idUtilizador);
                        } elseif ($ultimoMes->getMes() == 'MAIO' && $meses[$i] == 'JUNHO') {
//                        
                        $pagamento->setMes($meses[$i]);
                        $pagamento->setObs($observacao);
                        $pagamento->setAno($ano);
                        $idMatricula = base64_decode($_POST['idMatricula']);
                        $idUtilizador = $_POST['idUtilizador'];
                        
                        $retorno = $modelo->cadastrar($pagamento, $idMatricula, $idUtilizador);
                        
                        } elseif ($ultimoMes->getMes() == 'JUNHO' && $meses[$i] == 'JULHO') {
//                        
                        $pagamento->setMes($meses[$i]);
                        $pagamento->setObs($observacao);
                        $pagamento->setAno($ano);
                        $idMatricula = base64_decode($_POST['idMatricula']);
                        $idUtilizador = $_POST['idUtilizador'];
                        
                        $retorno = $modelo->cadastrar($pagamento, $idMatricula, $idUtilizador);
                        
                        } elseif ($ultimoMes->getMes() == 'JULHO' && $meses[$i] == 'AGOSTO') {
//                            
                        $pagamento->setMes($meses[$i]);
                        $pagamento->setObs($observacao);
                        $pagamento->setAno($ano);
                        $idMatricula = base64_decode($_POST['idMatricula']);
                        $idUtilizador = $_POST['idUtilizador'];
                        
                        $retorno = $modelo->cadastrar($pagamento, $idMatricula, $idUtilizador);
                            
                        } elseif ($ultimoMes->getMes() == 'AGOSTO' && $meses[$i] == 'SETEMBRO') {
//                        
                        $pagamento->setMes($meses[$i]);
                        $pagamento->setObs($observacao);
                        $pagamento->setAno($ano);
                        $idMatricula = base64_decode($_POST['idMatricula']);
                        $idUtilizador = $_POST['idUtilizador'];
                        
                        $retorno = $modelo->cadastrar($pagamento, $idMatricula, $idUtilizador);

                        } elseif ($ultimoMes->getMes() == 'SETEMBRO' && $meses[$i] == 'OUTUBRO') {
//                        
                        $pagamento->setMes($meses[$i]);
                        $pagamento->setObs($observacao);
                        $pagamento->setAno($ano);
                        $idMatricula = base64_decode($_POST['idMatricula']);
                        $idUtilizador = $_POST['idUtilizador'];
                        
                        $retorno = $modelo->cadastrar($pagamento, $idMatricula, $idUtilizador);
                        
                        } elseif ($ultimoMes->getMes() == 'OUTUBRO' && $meses[$i] == 'NOVEMBRO') {
//                        
                        $pagamento->setMes($meses[$i]);
                        $pagamento->setObs($observacao);
                        $pagamento->setAno($ano);
                        $idMatricula = base64_decode($_POST['idMatricula']);
                        $idUtilizador = $_POST['idUtilizador'];
                        
                        $retorno = $modelo->cadastrar($pagamento, $idMatricula, $idUtilizador);
                        
                        } elseif ($ultimoMes->getMes() == 'NOVEMBRO' && $meses[$i] == 'DEZEMBRO') {
//                        
                        $pagamento->setMes($meses[$i]);
                        $pagamento->setObs($observacao);
                        $pagamento->setAno($ano);
                        $idMatricula = base64_decode($_POST['idMatricula']);
                        $idUtilizador = $_POST['idUtilizador'];
                        
                        $retorno = $modelo->cadastrar($pagamento, $idMatricula, $idUtilizador);
                        
                        }elseif ($ultimoMes->getMes() == 'DEZEMBRO' && $meses[$i] == 'JANEIRO') {
//                        
                        $pagamento->setMes($meses[$i]);
                        $pagamento->setObs($observacao);
                        $pagamento->setAno($ano);
                        $idMatricula = base64_decode($_POST['idMatricula']);
                        $idUtilizador = $_POST['idUtilizador'];
                        
                        $retorno = $modelo->cadastrar($pagamento, $idMatricula, $idUtilizador);
                        
                        } else {
                            Application::redirect("?controller=Pagamento_Propina&action=efectuarPagamento&&name=" . base64_encode($_POST['name']) . "&u=" . md5(5));
                        }
                    
//                print_r($ultimoMes);
//                    die();


                endfor;
            }
      //  }
        

        if ($retorno == 1) {
            Application::redirect("?controller=Pagamento_Propina&action=efectuarPagamento&name=" . base64_encode($_POST['name']) . "&mes=" . base64_encode($meses[$i]) . "&u=" . md5(1));
//                      
        }
    }
    
    public function obterPagamentosAction() {

        
        $modelo = new Pagamento_PropinaModel();
        $matricula = new Matricula();
        $modelo_ = new MatriculaModel();
        $modelo1 = new AlunoModel();
        $modelo2 = new PessoaModel();
        $modelo3 = new Classe_Model();
        
        $num_processo = filter_input(INPUT_POST, "num_processo");
        
        
        $explode = explode("/", $num_processo);
        $bi_cp = $explode[0]; 
        $ano_lectivo = $explode[1];
        
        $matricula->setNum_processo($bi_cp);
        $matricula->setAno_lectivo($ano_lectivo);
        
        
        $dadosMatricula = $modelo_->consultarMatricula($matricula);
        
        $dadosAluno = $modelo1->pesquisar($dadosMatricula->getIdAluno());
        
        $dadosClasse = $modelo3->consultar($dadosAluno->getIdClasse());
  
        $dadosPessoa = $modelo2->consultar($dadosAluno->getIdPessoa());
        
        $dadosPagamentos = $modelo->obterPagamentos($dadosMatricula->getId(),$matricula->getAno_lectivo());
        
        

        $view = new view('Views/pagamento-actual-aluno.phtml');
        $view->setParams(array("dadosPagamento" => $dadosPagamentos, "dadosMatricula" => $dadosMatricula, "dadosPessoa" => $dadosPessoa, "dadosAluno" => $dadosAluno, "dadosClasse" => $dadosClasse));
        $view->showContents();
    }
    
    public function listarAction() {

        
        $modelo = new Pagamento_PropinaModel();
        
        $dadosPagamentos = $modelo->listar();

        $view = new view('Views/pagamento-geral.phtml');
        $view->setParams(array("dadosPagamento" => $dadosPagamentos));
        $view->showContents();
    }
    

    
    
}
