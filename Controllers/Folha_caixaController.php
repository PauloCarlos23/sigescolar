<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Folha_caixaController
 *
 * @author KASOFT DEVELOPMENT
 */

require_once 'Models/Pagamento.php';
require_once 'Models/PagamentoModel.php';
require_once 'Models/Saida.php';
require_once 'Models/SaidaModel.php';
require_once 'Models/Folha_caixa.php';
require_once 'Models/Folha_caixaModel.php';

class Folha_caixaController {
    //put your code here
    
    
    
    public function registarAction() {

        //   Criando os objectos
        $folhaCaixa = new Folha_Caixa();
        $modelo = new Folha_CaixaModel();


        session_start();
        
        $registar = filter_input(INPUT_POST, 'registar');

        //   Verificando se o botão foi clicado
        if (isset($registar)) {


//            echo $_POST['entrada'];
//            die();


            $folhaCaixa->setEntrada($_POST['valor_entrada']);
            $folhaCaixa->setSaida($_POST['saida']);
            $folhaCaixa->setSaldo($_POST['saldo']);
            $folhaCaixa->setData(date("Y-m-d"));


//            print_r($folhaCaixa);
//            die();
            //    chamada da função (no model) que permite registar a reclamação 
            $dados1 = $modelo->registar($folhaCaixa);


            //print $dados1;
            //die();

            if ($dados1 == 1) {
               
//            gerar ficheiro doc
                $saldoAnt = $_POST['saldoAnt'];
                $entrada = $_POST['valor_entrada'];
                $saida = $_POST['saida'];
                $saldo = $_POST['saldo'];
                $data = date("Y-m-d");
                
print '<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Folha de caixa</title>';
        include 'Views/includes/cabecalho.phtml';
    print '</head>
    <body style="background-color: white;">';

                 print '<br><br><h4 align=center>
                     <img src="public/img/logo.jpg" width=100 heigth=100>
                     <br>
         <b>B.M.E.A - COM&Eacute;RCIO GERAL</b><br>
         <b>KIKOLO - BOA ESPERAN&Ccedil;A I</b>
         <br>
         <b>NIF 2411030096</b></h4>
<br><h4 align=center><i class="fa fa-file-text"></i><u> <b>  FOLHA DE CAIXA DO DIA '.  date("d/m/Y").'</b></u></h4><br>';
    
//                $ficheiro = '';
                print  '<h3 >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'
                        . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'
                        . 'SALDO ANTERIOR: ';
                print  $saldoAnt . ' KZ';
                print  '</h3>';
                print  '<h3 >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'
                        . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'
                        . 'ENTRADA: ';
                print  $entrada . ' KZ';
                print  '</h3>';
                print  '<h3>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'
                        . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'
                        . 'SAÍDA: ';
                print  $saida . ' KZ';
                print  '</h3>';
                print  '<h3 >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'
                        . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'
                        . 'SALDO DISPONÍVEL: ';
                print  $saldo . ' KZ</h3 ><br><br>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'
                        . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'
         . 'Data: '. date("d/m/Y").'<br>'
         . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'
                        . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'
         . 'Hora: '.  date("H:i:s").'<br>'
         . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'
                        . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'
                        . 'FUNCIONÁRIO: '.$_SESSION['username'];
         
print '<p align=center><BR><BR><BR>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <a href="#" class="" onclick="window.print()" title="">
             <i class="fa fa-print"></i>
             IMPRIMIR
         </a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <a href="?controller=Folha_caixa&action=formRegisto" class="" title="">
             <i class="fa fa-arrow-left"></i>
             VOLTAR 
         </a></p>
    </body>
</html>';               
            } else {
                Application::redirect("?controller=Folha_caixa&action=formRegisto&c=" . md5(2));
            }
        }
    }

    public function formRegistoAction() {

        $modelo = new pagamentoModel();
        $modelo1 = new SaidaModel();
        $modelo2 = new Folha_CaixaModel();
        $view = new view("Views/registoFolha_caixa.phtml");

        $hoje = date("Y-m-d");
        //    Chamada da função (no model) que permite listar 
        //    Listagem por parte do funcionário da faculdade
        session_start();
        $side = $_SESSION['side'];
//        $linha = $_SESSION['linha'];
        $dados = $modelo->listarMovimentoGeral($hoje);
        
        //print_r($dados);
        //die(); 

        $dados1 = $modelo1->listarDiario($hoje);

        $ontem = date("Y-m-d", strtotime(date("Y-m-d") . '-1day'));
        
//        print $ontem;
//        die();
        
        $dados2 = $modelo2->listarSaldoAnterior($ontem);

        $view->setParams(array("dados" => $dados, "dados1" => $dados1, "dados2" => $dados2));
        $view->showContents();
    }
    
}
