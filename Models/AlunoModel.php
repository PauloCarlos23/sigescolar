<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AlunoModel
 *
 * @author Kasoft Development
 */

require_once 'Models/Aluno.php';

class AlunoModel extends Conexao {
    //put your code here
    
    public function __construct() {
        parent::__construct();
    }
    
    
    public function cadastrar($aluno,$idClasse,$idpessoa) {
        $stmt = $this->db->prepare("insert into aluno(cod_aluno,idClasse,idPessoa) values (:cod_aluno,:idClasse,:idPessoa)");
        $stmt->bindValue(":cod_aluno",  $aluno->getCod_aluno());
        $stmt->bindValue(":idClasse",  $idClasse);
        $stmt->bindValue(":idPessoa", $idpessoa);

           
//        Verificando se existe ja um registo com estes dados
        $verifica = $this->db->prepare("select * from aluno where cod_aluno=? and idClasse=?");
        $verifica->bindValue(1, $aluno->getCod_aluno());
        $verifica->bindValue(2, $idClasse);
        $verifica->execute();
            
        
        
        if ($verifica->rowCount() == 1) {
            $aluno->setId(0);
        }  else {
            $stmt->execute();
            
             
//        Buscando idAluno do registo ora efectuado
        $buscaId = $this->db->prepare("select * from aluno where cod_aluno=? and idClasse=?");
        $buscaId->bindValue(1, $aluno->getCod_aluno());
        $buscaId->bindValue(2, $idClasse);
        $buscaId->execute();
            
             $resultado = $buscaId->fetchobject();

            $aluno = new aluno();

            $aluno->setId($resultado->idAluno); 
//            
        }
        
        return $aluno;
        
    }
    
    
    public function alterar($aluno,$idClasse) {
        $stmt = $this->db->prepare("update aluno set idClasse=? where idAluno=?");
        $stmt->bindValue(1,  $idClasse);
        $stmt->bindValue(2,  $aluno->getId());
        $stmt->execute();

      
        if ($stmt->execute()) {
            $t = true;
        }  else {
            $t = false;
        }
        
        return $t;
      
    }
//    
    public function consultar($cod_aluno) {
        
         $stmt = $this->db->prepare("select * from aluno where cod_aluno=?");
        $stmt->bindValue(1, $cod_aluno);
        $stmt->execute();
        
            
             $resultado = $stmt->fetchobject();

            $aluno = new Aluno();
            
            
            $aluno->setId($resultado->idAluno); 
            $aluno->setCod_aluno($resultado->cod_aluno);
            $aluno->setIdClasse($resultado->idClasse);
            $aluno->setIdPessoa($resultado->idPessoa);
            
//            
    return $aluno;
    
    }
    public function pesquisar($idAluno) {
        
         $stmt = $this->db->prepare("select * from aluno where idAluno=?");
        $stmt->bindValue(1, $idAluno);
        $stmt->execute();
        
            
             $resultado = $stmt->fetchobject();

            $aluno = new Aluno();
            
            
            $aluno->setId($resultado->idAluno); 
            $aluno->setCod_aluno($resultado->cod_aluno);
            $aluno->setIdClasse($resultado->idClasse);
            $aluno->setIdPessoa($resultado->idPessoa);
            
//            
    return $aluno;
    
    }
    
    
    public function eliminar($idAluno) {
         $stmt = $this->db->prepare("delete from aluno where idAluno=?");
        $stmt->bindValue(1, $idAluno);
    }
    
    public function alterarDados($aluno,$idPessoa) {
        $stmt = $this->db->prepare("update aluno set cod_aluno=? where idPessoa=?");
        $stmt->bindValue(1,  $aluno->getCod_aluno());
        $stmt->bindValue(2,  $idPessoa);
//        $stmt->bindValue(2,  $aluno->getId());
        $stmt->execute();
        
        
        if (isset($stmt)) {
            $confirmacao = TRUE;
        }  else {
            $confirmacao = FALSE;
        }
        
        
        return $confirmacao;
    
        
    }
    
}
