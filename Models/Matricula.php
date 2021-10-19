<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Matricula
 *
 * @author Kasoft Development
 */
class Matricula {
    //put your code here
    
    private $id;
    private $num_processo;
    private $ano_lectivo;
    private $tipo_matricula;
    private $valor;
    private $data_registo;
    private $idAluno;
    
    
    function getId() {
        return $this->id;
    }

    function getNum_processo() {
        return $this->num_processo;
    }

    function getAno_lectivo() {
        return $this->ano_lectivo;
    }

    function getTipo_matricula() {
        return $this->tipo_matricula;
    }

    function getValor() {
        return $this->valor;
    }

    function getData_registo() {
        return $this->data_registo;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setNum_processo($num_processo) {
        $this->num_processo = $num_processo;
    }

    function setAno_lectivo($ano_lectivo) {
        $this->ano_lectivo = $ano_lectivo;
    }

    function setTipo_matricula($tipo_matricula) {
        $this->tipo_matricula = $tipo_matricula;
    }

    function setValor($valor) {
        $this->valor = $valor;
    }

    function setData_registo($data_registo) {
        $this->data_registo = $data_registo;
    }


    function getIdAluno() {
        return $this->idAluno;
    }

    function setIdAluno($idAluno) {
        $this->idAluno = $idAluno;
    }


    
    
}
