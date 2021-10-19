<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Funcionario
 *
 * @author Kasoft Development
 */
class Funcionario {
    //put your code here
    
    private $id;
    private $num_identif;
    private $salario;
    private $inicio_funcao;
    private $data_registo;
    
    
    function getId() {
        return $this->id;
    }

    function getNum_identif() {
        return $this->num_identif;
    }

    function getSalario() {
        return $this->salario;
    }

    function getInicio_funcao() {
        return $this->inicio_funcao;
    }

    function getData_registo() {
        return $this->data_registo;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setNum_identif($num_identif) {
        $this->num_identif = $num_identif;
    }

    function setSalario($salario) {
        $this->salario = $salario;
    }

    function setInicio_funcao($inicio_funcao) {
        $this->inicio_funcao = $inicio_funcao;
    }

    function setData_registo($data_registo) {
        $this->data_registo = $data_registo;
    }


    
    
}
