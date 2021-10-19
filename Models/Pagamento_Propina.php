<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Pagamento_Propina
 *
 * @author Kasoft Development
 */
class Pagamento_Propina {
    //put your code here
    
    private $id;
    private $mes;
    private $ano;
    private $obs;
    private $data_pagamento;
    private $nome_aluno;
    private $classe_aluno;
    private $valor_propina;


    function getValor_propina()
    {
        return $this->valor_propina;
    }
    
    
    function getId() {
        return $this->id;
    }

    function getMes() {
        return $this->mes;
    }

    function getObs() {
        return $this->obs;
    }

    function getData_pagamento() {
        return $this->data_pagamento;
    }

    function setValor_propina($valor_propina) {
        $this->valor_propina = $valor_propina;
    }


    function setId($id) {
        $this->id = $id;
    }

    function setMes($mes) {
        $this->mes = $mes;
    }

    function setObs($obs) {
        $this->obs = $obs;
    }

    function setData_pagamento($data_pagamento) {
        $this->data_pagamento = $data_pagamento;
    }

    function getAno() {
        return $this->ano;
    }

    function setAno($ano) {
        $this->ano = $ano;
    }


    function getNome_aluno() {
        return $this->nome_aluno;
    }

    function getClasse_aluno() {
        return $this->classe_aluno;
    }

    function setNome_aluno($nome_aluno) {
        $this->nome_aluno = $nome_aluno;
    }

    function setClasse_aluno($classe_aluno) {
        $this->classe_aluno = $classe_aluno;
    }


    
}
