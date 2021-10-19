<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Classe_
 *
 * @author Kasoft Development
 */
class Classe_ {
    //put your code here
    
     private $id;
    private $designacao;
    private $valor_propina;
    private $valor_matricula;
    private $valor_confirmacao;
    
    
    function getId() {
        return $this->id;
    }

    function getDesignacao() {
        return $this->designacao;
    }

    function getValor_propina() {
        return $this->valor_propina;
    }

    function getValor_matricula() {
        return $this->valor_matricula;
    }

    function getValor_confirmacao() {
        return $this->valor_confirmacao;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setDesignacao($designacao) {
        $this->designacao = $designacao;
    }

    function setValor_propina($valor_propina) {
        $this->valor_propina = $valor_propina;
    }

    function setValor_matricula($valor_matricula) {
        $this->valor_matricula = $valor_matricula;
    }

    function setValor_confirmacao($valor_confirmacao) {
        $this->valor_confirmacao = $valor_confirmacao;
    }


}
