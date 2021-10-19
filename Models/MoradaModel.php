<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of MoradaModel
 *
 * @author Kasoft Development
 */
class MoradaModel extends Conexao{
    //put your code here
    
    public function __construct() {
        parent::__construct();
    }
    
    public function cadastrar($morada) {
        $stmt = $this->db->prepare("insert into morada(municipio,bairro,rua,casa_num) values (:municipio,:bairro,:rua,:casa_num)");
        $stmt->bindValue(":municipio",  $morada->getMunicipio());
        $stmt->bindValue(":bairro",  $morada->getBairro());
        $stmt->bindValue(":rua",  $morada->getRua());
        $stmt->bindValue(":casa_num",  $morada->getNum_casa());
        $stmt->execute();
            
             
//        Buscando idMorada do registo ora efectuado
        $buscaId = $this->db->prepare("select idMorada from morada where municipio=? and bairro=? and rua=? and casa_num=?");
        $buscaId->bindValue(1, $morada->getMunicipio());
        $buscaId->bindValue(2, $morada->getBairro());
        $buscaId->bindValue(3, $morada->getRua());
        $buscaId->bindValue(4, $morada->getNum_casa());
        $buscaId->execute();
            
             $resultado = $buscaId->fetchobject();

            $morada = new Morada();

            $morada->setId($resultado->idMorada); 
//            
        
        return $morada;
        
    }
    
    public function consultar($idMorada) {
        
         $stmt = $this->db->prepare("select * from morada where idMorada=?");
        $stmt->bindValue(1, $idMorada);
        $stmt->execute();
        
            
             $resultado = $stmt->fetchobject();

            $morada = new Morada();
            
            
            $morada->setId($resultado->idMorada); 
            $morada->setMunicipio($resultado->municipio);
            $morada->setBairro($resultado->bairro);
            $morada->setRua($resultado->rua);
            $morada->setNum_casa($resultado->casa_num);
            
            
    return $morada;
    
    }
    
     public function alterar($morada) {
        $stmt = $this->db->prepare("update morada set  municipio=?,bairro=?,rua=?,casa_num=? where idMorada=?");
        $stmt->bindValue(1,  $morada->getMunicipio());
        $stmt->bindValue(2,  $morada->getBairro());
        $stmt->bindValue(3,  $morada->getRua());
        $stmt->bindValue(4,  $morada->getNum_casa());
        $stmt->bindValue(5,  $morada->getId());
        $stmt->execute();
            
        if (isset($stmt)) {
            $confirmacao = TRUE;
        }  else {
            $confirmacao = FALSE;
        }
        
        
        return $confirmacao;
    }
}
