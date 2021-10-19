<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Pauta
 *
 * @author Kasoft Development
 */
class Pauta {
    //put your code here
    
    private $id;
    private $titulo;
    private $corpo;
    private $rodape;
    private $ano_lectivo;
    private $data_actualizacao;
    
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

    function getAno_lectivo() {
        return $this->ano_lectivo;
    }

    function getData_actualizacao() {
        return $this->data_actualizacao;
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

    function setAno_lectivo($ano_lectivo) {
        $this->ano_lectivo = $ano_lectivo;
    }

    function setData_actualizacao($data_actualizacao) {
        $this->data_actualizacao = $data_actualizacao;
    }


    
}
