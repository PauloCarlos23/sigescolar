<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of UtilizadorModel
 *
 * @author Kasoft Development
 */
class UtilizadorModel extends Conexao {
    //put your code here
    
    public function __construct() {
        parent::__construct();
    }
    
    
    //Definição da toda a regra de negocio
    public function logar($utilizador) {
        $stmt = $this->db->prepare("select utilizador.username,utilizador.idUtilizador, funcao.designacao as func,pessoa.genero from utilizador,funcao,funcionario,pessoa "
                . "where "
                . "username=:username "
                . "and password=:password "
                . "and funcao.idFuncao=funcionario.idFuncao "
                . "and funcionario.idFuncionario=utilizador.idFuncionario "
                . "and funcionario.idPessoa=pessoa.idPessoa");
        $stmt->bindValue(":username",  $utilizador->getUsername());
        $stmt->bindValue(":password", $utilizador->getPassword());
        $stmt->execute();
       
        
        return $stmt->fetchobject();
        
        
        
    }

    public function cadastrar($utilizador,$idFuncionario) {
        $stmt = $this->db->prepare("insert into utilizador(username,password,backup,idFuncionario) values (:username,:password,:idFuncionario)");
        $stmt->bindValue(":username",  $utilizador->getUsername());
        $stmt->bindValue(":password", $utilizador->getPassword());
        $stmt->bindValue(":backup", $utilizador->getBackup());
        $stmt->bindValue(":idFuncionario", $idFuncionario);
//        $stmt->execute();
        
        
        
//        Verificando se ja existe  um registo com os mesmos dados
        $verifica = $this->db->prepare("select * from utilizador where idFuncionario=?");
        $verifica->bindValue(1, $idFuncionario);
        $verifica->execute();
        
//        echo $verifica->rowCount();
//        die();
//            
        if ($verifica->rowCount() == 1) {
            $retorno = 0;
        }  else {
            $stmt->execute();
             $retorno = 1;
        }
        
        return $retorno;
        
    }
    
    
    public function actualizar($utilizador) {
         $stmt = $this->db->prepare("UPDATE utilizador SET idFuncionario=:idFunc,username=:username, password=:password,backup=:backup WHERE idUtilizador=:idUtilizador");
        $stmt->bindValue(":username",$utilizador->getUsername());
        $stmt->bindValue(":password",$utilizador->getPassword());
        $stmt->bindValue(":backup",$utilizador->getPassbackup());
        $stmt->bindValue(":idFunc",$utilizador->getIdFuncionario());
        $stmt->bindValue(":idUtilizador",$utilizador->getIdUtilizador());
        $stmt->execute();
        
    }
    
    public function actualizarPassword($utilizador) {
         $stmt = $this->db->prepare("UPDATE utilizador SET password=:password, backup=:backup WHERE idUtilizador=:idUtilizador");
        $stmt->bindValue(":password",$utilizador->getPassword());
        $stmt->bindValue(":passback_up",  base64_encode($utilizador->getPassback_up()));
        $stmt->bindValue(":idUtilizador",$utilizador->getIdUtilizador());
        $stmt->execute();
        
    }
    
    public function remover($id) {
         $stmt = $this->db->prepare("DELETE FROM utilizador WHERE idUtilizador=:id");
         $stmt->bindValue(":id",$id);
         $stmt->execute();
        
    }
    
    public function listar() {
         $stmt = $this->db->prepare("SELECT * FROM utilizador");
         $stmt->execute();
         
         
         $listas=array();
         
         while ($resultado=$stmt->fetchobject()){
             
             $utilizador = new utilizador();
             
             $utilizador->setIdUtilizador($resultado->idUtilizador);
             $utilizador->setUsername($resultado->username);
             $utilizador->setEstado($resultado->estado);
      
             
             array_push($listas, $utilizador);
             
             
         }
        
         return $listas;
    }
}
