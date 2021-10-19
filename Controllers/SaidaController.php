<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SaidaController
 *
 * @author KASOFT DEVELOPMENT
 */


require_once 'Models/Saida.php';
require_once 'Models/SaidaModel.php';
require_once 'Models/Folha_CaixaModel.php';
require_once 'Models/PagamentoModel.php';
require_once 'Models/Pagamento.php';

class SaidaController {
    //put your code here
    
    
    public function registarAction() {

        //   Criando os objectos
        $saida = new Saida();
        $modelo = new SaidaModel();
        

        $registar = filter_input(INPUT_POST, 'registar');
        $descricao = filter_input(INPUT_POST, 'descricao');

        //   Verificando se o botão foi clicado
        if (isset($registar)) {
            
            if (empty($descricao)) {
                 Application::redirect("?controller=Saida&action=formRegisto&u=" . md5(3));
            }  else {
                
            $saida->setDescricao(filter_input(INPUT_POST, 'descricao'));
            $saida->setExtenso(filter_input(INPUT_POST, 'extenso'));
            $saida->setValor(filter_input(INPUT_POST, 'valor'));
            $saida->setData_registo(date("Y-m-d"));
            

            
            
            //    chamada da função (no model) que permite registar a reclamação 
            $dados1 = $modelo->registar($saida);
            
            if ($dados1 === 1) {
                 Application::redirect("?controller=Saida&action=formRegisto&u=" . md5(1));
                
            }else {
                 Application::redirect("?controller=Saida&action=formRegisto&u=" . md5(2));
                
            }
            }


        }
    }
    
    public function actualizarAction() {

        //   Criando os objectos
        $saida = new Saida();
        $modelo = new SaidaModel();
        

        $actualizar = filter_input(INPUT_POST, 'alterar');

        //   Verificando se o botão foi clicado
        if (isset($actualizar)) {
            $saida->setId(filter_input(INPUT_POST, 'idsaida'));
            $saida->setDescricao(filter_input(INPUT_POST, 'descricao'));
            $saida->setExtenso(filter_input(INPUT_POST, 'extenso'));
            $saida->setValor(filter_input(INPUT_POST, 'valor'));
            $saida->setData_registo(date("Y-m-d"));
            
            
//            print_r($saida);
//            die();
            //    chamada da função (no model) que permite registar a reclamação 
            $dados1 = $modelo->alterar($saida);
            
//            if ($dados1 === 1) {
                 Application::redirect("?controller=Saida&action=formRegisto&u=" . md5(4));
                
//            }else {
//                 Application::redirect("?controller=Saida&action=formRegisto&c=" . md5(2));
//                
//            }


        }
    }
    
    public function formRegistoAction() {
        
        //            Buscando valor de entrada
             $modelo = new pagamentoModel();

        $hoje = date("Y-m-d");
//        session_start();
//        $side = $_SESSION['side'];
//        $linha = $_SESSION['linha'];
        $dados = $modelo->consultarEntrada($hoje);
        $view = new view("Views/registoSaida.phtml");
        $view->setParams(array("dados" => $dados));
        $view->showContents();
        
    }
    
    public function listarAction() {
        
        $modelo = new SaidaModel();
        $view = new view("Views/listaSaida.phtml");
         
        $data = date("Y-m-d");
        $dados = $modelo->listar($data);
        
        $view->setParams(array("dados" => $dados));
        $view->showContents();
    }
    public function listarGeralAction() {
        
        $modelo = new SaidaModel();
        $view = new view("Views/listaSaida.phtml");
        $dados = $modelo->listarGeral();
        
        $view->setParams(array("dados" => $dados));
        $view->showContents();
    }
    public function listarPorDataAction() {
        
        $modelo = new SaidaModel();
        $view = new view("Views/listaSaida.phtml");
         
//        $d = explode("/", filter_input(INPUT_POST, 'data')) ;
        
        $data = date("Y-m-d",strtotime(filter_input(INPUT_POST, 'data')));
        
        $dados = $modelo->listar($data);
        
        $view->setParams(array("dados" => $dados));
        $view->showContents();
    }
    public function imprimirAction() {
        
        $modelo = new SaidaModel();
        
        $id = base64_decode($_GET['id']);
        $view = new view("Views/listaSaidaPorId.phtml");
         
//        $data = date("Y-m-d");
        $dados = $modelo->listarPorId($id);
        
        $view->setParams(array("dados" => $dados));
        $view->showContents();
    }
    
    public function imprimirSaidasAction() {
        


 session_start();
 
  print '<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Factura do cliente</title>';
        
        include 'Views/include/cabecalho.phtml';
       
    print '</head>
    <body style="background-color: white;">';
        

$i=0;

$valor = array();
$extenso = array();
$descricao = array();
//$data = array();


$extenso = $_POST['extenso'];
$descricao = $_POST['descricao'];
$valor = $_POST['valor'];
$data = $_POST['data'];
$pre = $_POST['pre'];
 
if (isset($_POST['enviar'])) {
    
  print '<br><br><h4 align=center>
         <b>B.M.E.A - COM&Eacute;RCIO GERAL</b><br>
         <b>KIKOLO - BOA ESPERAN&Ccedil;A I</b>
         <br>
         <b>NIF 2411030096</b></h4>
<br><br><br>';
   

if (isset($data)) {
    print  '<h4 align=center><u>DESCRIÇÃO DE TODAS AS SAIDAS DO DIA '.date("d/m/Y", strtotime($data)).'</u></h4>';
}  else {
    print  '<h4 align=center><u>DESCRIÇÃO DE TODAS AS SAIDAS</u></h4>';
    
}//    $data
    
//    print '</b></h4>';
 print '<table border=1 align=center>';
 print '<tdead>';
 print '<tr>';
 /*print '<td colspan=5>';
 print '========================================================================================';
 print '</td>';
 print '</tr>';*/
 print '<tr>';
 print '<td align=center>';
 print '<b>#</b>';
 print '</td>';
 print '<td  align=center>';
 print '<b>Valor (Kz)</b>';
 print '</td>';
 print '<td  align=center>';
 print '<b>Por Extenso</b>';
 print '</td>';
 print '<td  align=center>';
 print '<b>Designação</b>';
 print '</td>';
// print '<td  align=center>';
// print 'Data';
// print '</td>';
 print '</tr>';
 print '<tr>';
 /*print '<td colspan=5>';
 print '========================================================================================';
 print '</td>';
 print '</tr>';*/
// Implementando a impressao dos dados
 for ($i=0; $i < $pre;$i++  ){
 print '<tr>';
 print '<td align=center>';
 print  $i+1;
 print '</td>';
 print '<td align=center>';
 print  $valor[$i];
 print '</td>';
 print '<td align=center>';  
 print   $extenso[$i];
 print '</td>';
 print '<td align=center>';
  print  $descricao[$i];
 print '</td>';
// print '<td align=center>';
//  print  $data[$i];
// print '</td>';
 print '</tr>';
 
 }
     
 
//}
 print '<tr><td colspan=4><h5><b> &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;'
 . '&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;'
 .'&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;'
         .'&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;'
 . '&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;'
         . '&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;'
         .'</b></h5></td></tr>  </table>'
         . '<br><br><br>'
         . '
         &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;'
         . '&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;'
         . 'Data: '. date("d/m/Y").'<br>'
         . '
         &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;'
         . '&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;'
         . 'Hora: '.  date("H:i:s")
         . '&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;'
         . '&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;'
         . '&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;'
         . '&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;'
         . '&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;'
         . '&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;'
         . '&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;'
         . '&nbsp;&nbsp;'
         . 'FUNCIONÁRIO: '.$_SESSION['username'];
 
    
     PRINT '<p align=center><BR><BR><BR>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <a href="#" class="" onclick="window.print()" title="">
             IMPRIMIR
         </a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <a href="?controller=Saida&action=listar" class="" title="">
             <i class="fa fa-arrow-left"></i>
             VOLTAR 
         </a></p>';
                            
                            print '</body></html>';
    
    
    
} 

    }
    
    public function imprimirPorIdAction() {
        
$modelo = new SaidaModel();
        
        $id = base64_decode($_GET['id']);
//        $view = new view("Views/listaSaidaPorId.phtml");
         
//        $data = date("Y-m-d");
        $dados = $modelo->listarPorId($id);

        
//        echo $dados->getDescricao();
//        die();
        
        
 session_start();
 
  print '<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Factura do cliente</title>';
        
        include 'Views/includes/cabecalho.phtml';
       
    print '</head>
    <body style="background-color: white;">';
        

$i=0;
//
//$valor = array();
//$extenso = array();
//$descricao = array();
//$data = array();


$extenso = $dados->getExtenso();
$descricao = $dados->getDescricao();
$valor = $dados->getValor();
$data = $dados->getData_registo();
//$pre = $_POST['pre'];
 
//if (isset($_POST['enviar'])) {
    
 print '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
         &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
         &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
         &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
         &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
         &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
         &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
         &nbsp;&nbsp;&nbsp;&nbsp;
         <img src="public/img/login-body-bg.jpg" width="85" height="85"><br>
         &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
         &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
         &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
         &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
         &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
         &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
         &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
         <b>EDSON VALTEC</b><br>';
?>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <b>SERVIÇOS DE TELEVISÃO - TV CABO</b>
        <br>
        <br>
   
<?php
if (isset($data)) {
    print  '<h4 align=center><u>DESCRIÇÃO DA SAIDA DO DIA '.date("d/m/Y", strtotime($data)).'</u></h4>';
}  else {
    print  '<h4 align=center><u>DESCRIÇÃO DE TODAS AS SAIDAS</u></h4>';
    
}//    $data
    
//    print '</b></h4>';
// print '<h4 align=center>========================================================================================</h4>';
 print '<h4>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;VALOR: '.$valor.' kz'
         . '</h4>';
 print '<h4>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;POR EXTENSO: '.$extenso
         . '</h4>';
 print '<h4>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;DESIGNA&Ccedil;&Atilde;O: '.$descricao
         . '</h4><br><br>';
         print ''
         . '<h4>'
                        . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'
                 . 'Data: '. date("d/m/Y").'</h4><br><br><br>'
         . '<h4>    &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;'
         . '&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; '
                 . 'RECEBI &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;
                 &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;'
         . '&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; O (A) RESPONS&Aacute;VEL</h4>'
         . '&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;'
         . '&nbsp;&nbsp;';
         print '<h4>&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;'
                 . '----------------------------------------------&nbsp;&nbsp;&nbsp;'
         . '&nbsp;&nbsp;&nbsp; '
         . '&nbsp;&nbsp;&nbsp; &nbsp;&nbsp; ----------------------------------------------</h4>'
         . '&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;'
         . '&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;'
         . '&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;'
         . '&nbsp;&nbsp;<br>';
 
    
     PRINT '<p align=center><BR><BR><BR>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <a href="#" class="" onclick="window.print()" title="">
            <i class="fa fa-print"></i>
             IMPRIMIR
         </a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <a href="?controller=Saida&action=listar" class="" title="">
             <i class="fa fa-arrow-left"></i>
             VOLTAR 
         </a></p>';
                            
                            print '</body></html>';
    
    
    
//} 

    }
    
    public function editarAction() {

        $modelo = new SaidaModel();
        $view = new view("Views/editaSaida.phtml"); //listagemUtilizador
        $dados = $modelo->obterPorId(base64_decode($_GET['id']));
        $view->setParams(array("dados" => $dados));
        $view->showContents();
    }
    
    public function eliminarAction() {
        $saida = new SaidaModel();
        $saida->remover(base64_decode($_GET["id"]));
        Application::redirect("?controller=Saida&action=listar");
    }
}
