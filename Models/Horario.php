<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Horario
 *
 * @author Kasoft Development
 */
class Horario {
    //put your code here
    private $id;
    private $titulo;
    private $corpo;
    private $rodape;
    
    function getId() {
        return $this->id;
    }

    function getTitulo() {
        return $this->titulo;
    }

    function getCorpo() {
        return $this->corpo;
    }

    function getRodape() {
        return $this->rodape;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setTitulo($titulo) {
        $this->titulo = $titulo;
    }

    function setCorpo($corpo) {
        $this->corpo = $corpo;
    }

    function setRodape($rodape) {
        $this->rodape = $rodape;
    }


    
}
