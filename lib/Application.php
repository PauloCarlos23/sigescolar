<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Application
 *
 * @author Scientist Yokaliye
 */
function my_autoloader($st_file) {
    if(file_exists('lib/'.$st_file.'.php'))
        require_once 'lib/'.$st_file.'.php';
}

spl_autoload_register('my_autoloader');


class Application {
    //put your code here
    
    protected $st_controller;
    protected $st_action;
    
    private function loadRoute(){
        
        $this->st_controller = isset($_REQUEST["controller"]) ? $_REQUEST["controller"] : 'Index';
        $this->st_action = isset($_REQUEST["action"]) ? $_REQUEST["action"] : 'index';
        
    }
    
    public function dispatch(){
        
        $this->loadRoute();
        
        $st_controller_file='Controllers/'.$this->st_controller.'Controller.php';
        
        if(file_exists($st_controller_file))
            require_once $st_controller_file;
        else
        throw new Exception("O arquivo'$st_controller_file'Não existe");
        
        
        $st_class = $this->st_controller."Controller";
        
        if(class_exists($st_class))
            $c_class = new $st_class;
        else
        throw new Exception("O arquivo'$st_class'Não existe");
        
        $st_method = $this->st_action."Action";
        if(method_exists($st_class,$st_method))
                $c_class->$st_method();
        else
            throw new Exception("O método'$st_method'Não existe");
        
            
        
        
    }
    
    static function redirect($url){
        
        
        header("Location: $url");
    }
}
