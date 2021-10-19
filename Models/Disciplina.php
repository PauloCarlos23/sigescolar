<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Disciplina
 *
 * @author Kasoft Development
 */
class Disciplina {
    //put your code here
    
    private $id;
    private $designacao;
    
    function getId() {
        return $this->id;
    }

    function getDesignacao() {
        return $this->designacao;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setDesignacao($designacao) {
        $this->designacao = $designacao;
    }


}
