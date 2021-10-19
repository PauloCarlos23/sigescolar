<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Aluno
 *
 * @author Kasoft Development
 */
class Aluno {
    //put your code here
    
    private $id;
    private $cod_aluno;
    private $idClasse;
    private $idPessoa;
    
    
    function getId() {
        return $this->id;
    }

    function getCod_aluno() {
        return $this->cod_aluno;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setCod_aluno($cod_aluno) {
        $this->cod_aluno = $cod_aluno;
    }

    function getIdClasse() {
        return $this->idClasse;
    }

    function getIdPessoa() {
        return $this->idPessoa;
    }

    function setIdClasse($idClasse) {
        $this->idClasse = $idClasse;
    }

    function setIdPessoa($idPessoa) {
        $this->idPessoa = $idPessoa;
    }


    
}
