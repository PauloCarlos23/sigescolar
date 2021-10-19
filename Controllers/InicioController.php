<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of InicioController
 *
 * @author Kasoft Development
 */
class InicioController {
    //put your code here
    
     public function InicioAction() {
        $view = new view('Views/inicio.phtml');
        $view->showContents();
    }
}
