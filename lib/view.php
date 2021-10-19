<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of view
 *
 * @author Scientist Yokaliye
 */
class view {
    //put your code here
    
    private $st_contents;
    private $st_view;
    private $st_params;
    
    function __construct($st_view=null,$st_params=null) {
      if($st_view != null)
        $this->setView($st_view);
    
    $this->st_params=$st_params;
    
    }
    
public function setView($st_view){
    if(file_exists($st_view))
        $this->st_view=$st_view;
    else
    throw new Exception("A view'$st_view'Não existe");
    
}

public function getView() {
    return $this->st_view;
}

public function setParams(Array $st_params){
    $this->st_params=$st_params;
}

public function getParams() {
    return $this->st_params;
}

public function getContents() {
    ob_start();
    if(isset($this->st_view))
        require_once $this->st_view;
    
    $this->st_contents = ob_get_contents();
    ob_end_clean();
    
    return $this->st_contents;
}

public function showContents() {
   echo $this->getContents();
   exit;
}
}
