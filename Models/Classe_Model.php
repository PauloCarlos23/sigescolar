<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Classe_Model
 *
 * @author Kasoft Development
 */
require_once 'Models/Classe_.php';

class Classe_Model extends Conexao{
    //put your code here
    
    public function __construct() {
        parent::__construct();
    }
    
    
    
    public function listar() {
         $stmt = $this->db->prepare("SELECT * FROM classe");
         $stmt->execute();
         
         
         $listas=array();
         
         while ($resultado=$stmt->fetchobject()){
             
             $classe = new Classe_();
             
             $classe->setId($resultado->idClasse);
             $classe->setDesignacao($resultado->designacao);
             $classe->setValor_confirmacao($resultado->valor_confirmacao);
             $classe->setValor_matricula($resultado->valor_matricula);
             $classe->setValor_propina($resultado->valor_propina);
      
             
             array_push($listas, $classe);
             
             
         }
        
         return $listas;
    }
    
    
    public function consultar($idClasse) {
        
         $stmt = $this->db->prepare("select * from classe where idClasse=?");
        $stmt->bindValue(1, $idClasse);
        $stmt->execute();
        
            
             $resultado = $stmt->fetchobject();

            $classe = new Classe_();
            
            
            $classe->setId($resultado->idClasse); 
            $classe->setDesignacao($resultado->designacao);
            $classe->setValor_propina($resultado->valor_propina);
            $classe->setValor_confirmacao($resultado->valor_confirmacao);
            
            
    return $classe;
    
    }
}
