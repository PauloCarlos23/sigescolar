<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Morada
 *
 * @author Kasoft Development
 */
class Morada {
    //put your code here
    
    
    private $id;
    private $municipio;
    private $bairro;
    private $rua;
    private $num_casa;
    
    
    function getId() {
        return $this->id;
    }

    function getMunicipio() {
        return $this->municipio;
    }

    function getBairro() {
        return $this->bairro;
    }

    function getRua() {
        return $this->rua;
    }

    function getNum_casa() {
        return $this->num_casa;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setMunicipio($municipio) {
        $this->municipio = $municipio;
    }

    function setBairro($bairro) {
        $this->bairro = $bairro;
    }

    function setRua($rua) {
        $this->rua = $rua;
    }

    function setNum_casa($num_casa) {
        $this->num_casa = $num_casa;
    }


}
