<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Turma
 *
 * @author Kasoft Development
 */
class Turma {
    //put your code here
    
    private $id;
    private $designacao;
    private $director_turma;
    private $turno;
    
    function getId() {
        return $this->id;
    }

    function getDesignacao() {
        return $this->designacao;
    }

    function getDirector_turma() {
        return $this->director_turma;
    }

    function getTurno() {
        return $this->turno;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setDesignacao($designacao) {
        $this->designacao = $designacao;
    }

    function setDirector_turma($director_turma) {
        $this->director_turma = $director_turma;
    }

    function setTurno($turno) {
        $this->turno = $turno;
    }


    
    
}
