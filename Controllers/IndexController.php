<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of IndexController
 *
 * @author Kasoft Development
 */
class IndexController {
    //put your code here
    public function indexAction() {
        $view = new view('Views/login.phtml');
        $view->showContents();
    }
}
