<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Pessoa
 *
 * @author Kasoft Development
 */
class Pessoa {
    //put your code here
    
    private $id;
    private $nome;
    private $sobrenome;
    private $nome_pai;
    private $nome_mae;
    private $data_nascim;
    private $genero;
    private $naturalidade;
    private $bi_cp;
    private $telefone;
    private $foto;
    private $idMorada;
    
   
    function getId() {
        return $this->id;
    }

    function getNome() {
        return $this->nome;
    }

    function getSobrenome() {
        return $this->sobrenome;
    }

    function getNome_pai() {
        return $this->nome_pai;
    }

    function getNome_mae() {
        return $this->nome_mae;
    }

    function getData_nascim() {
        return $this->data_nascim;
    }

    function getGenero() {
        return $this->genero;
    }

    function getNaturalidade() {
        return $this->naturalidade;
    }

    function getBi_cp() {
        return $this->bi_cp;
    }

    function getTelefone() {
        return $this->telefone;
    }

    function getFoto() {
        return $this->foto;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setNome($nome) {
        $this->nome = $nome;
    }

    function setSobrenome($sobrenome) {
        $this->sobrenome = $sobrenome;
    }

    function setNome_pai($nome_pai) {
        $this->nome_pai = $nome_pai;
    }

    function setNome_mae($nome_mae) {
        $this->nome_mae = $nome_mae;
    }

    function setData_nascim($data_nascim) {
        $this->data_nascim = $data_nascim;
    }

    function setGenero($genero) {
        $this->genero = $genero;
    }

    function setNaturalidade($naturalidade) {
        $this->naturalidade = $naturalidade;
    }

    function setBi_cp($bi_cp) {
        $this->bi_cp = $bi_cp;
    }

    function setTelefone($telefone) {
        $this->telefone = $telefone;
    }

    function setFoto($foto) {
        $this->foto = $foto;
    }

    function getIdMorada() {
        return $this->idMorada;
    }

    function setIdMorada($idMorada) {
        $this->idMorada = $idMorada;
    }




}
