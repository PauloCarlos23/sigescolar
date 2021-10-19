<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of UtilizadorController
 *
 * @author Kasoft Development
 */

require_once 'Models/utilizadorModel.php';
require_once 'Models/utilizador.php';
require_once 'Models/funcionario.php';
require_once 'Models/funcionarioModel.php';

class UtilizadorController {
    //put your code here
    
    public function logarAction() {

        $utilizador = new utilizador();
        $modelo = new utilizadorModel();

      
        if(isset($_POST['enviar'])){
        $utilizador->setUsername(addslashes(trim(htmlentities(htmlspecialchars($_POST['username'])))));
        $utilizador->setPassword(hash("sha256", addslashes(trim(htmlentities(htmlspecialchars($_POST['password']))))));
        
        $ut = $modelo->logar($utilizador);
        }
        
//       print_r($ut);
//       die();
        
        if ($ut) {
            session_start();

            $_SESSION['username'] = $ut->username;
            $_SESSION['idUtilizador'] = $ut->idUtilizador;
            $_SESSION['funcao'] = $ut->func;
            $_SESSION['genero'] = $ut->genero;
            $_SESSION['logado'] = true;
            Application::redirect("?controller=Inicio&action=inicio");
        } else {

            Application::redirect("?controller=Index&action=index&u=" . md5(1));
        }
    }
}
