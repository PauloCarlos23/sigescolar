<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of MatriculaModel
 *
 * @author Kasoft Development
 */
class MatriculaModel extends Conexao {
    //put your code here
    
    public function __construct() {
        parent::__construct();
    }
    
    public function cadastrar($matricula,$idAluno) {
        $stmt = $this->db->prepare("insert into matricula (num_processo,ano_lectivo,tipo,valor,idAluno) "
                . "values "
                . "(:num_processo,:ano_lectivo,:tipo,:valor,:idAluno)");
        $stmt->bindValue(":num_processo",  $matricula->getNum_processo());
        $stmt->bindValue(":ano_lectivo",  $matricula->getAno_lectivo());
        $stmt->bindValue(":tipo",  $matricula->getTipo_matricula());
        $stmt->bindValue(":valor",  $matricula->getValor());
        $stmt->bindValue(":idAluno",  $idAluno);

           
//        Verificando se existe ja um registo com estes dados
        $verifica = $this->db->prepare("select * from matricula where num_processo=? and ano_lectivo=? and idAluno=?");
        $verifica->bindValue(1, $matricula->getNum_processo());
        $verifica->bindValue(2, $matricula->getAno_lectivo());
        $verifica->bindValue(3, $idAluno);
        $verifica->execute();
            
        
        
        if ($verifica->rowCount() == 1) {
            $matricula->setId(0);
        }  else {
            $stmt->execute();
            
             
//        Buscando idMatricula do registo ora efectuado
        $buscaId = $this->db->prepare("select * from matricula where num_processo=? and ano_lectivo=?");
        $buscaId->bindValue(1, $matricula->getNum_processo());
        $buscaId->bindValue(2, $matricula->getAno_lectivo());
        $buscaId->execute();
            
             $resultado = $buscaId->fetchobject();

            $matricula = new matricula();

            $matricula->setId($resultado->idMatricula); 
//            
            
        }
        
        return $matricula;
        
    }
    
    
    public function alterar($matricula) {
        $stmt = $this->db->prepare("update matricula set num_processo=?,ano_lectivo=?,tipo=? where idMatricula=?");
        $stmt->bindValue(1,  $matricula->getNum_processo());
        $stmt->bindValue(2,  $matricula->getAno_lectivo());
        $stmt->bindValue(3,  $matricula->getTipo_matricula());
        $stmt->bindValue(4,  $matricula->getId());
        $stmt->execute();
            
        
        if ($stmt->execute()) {
            $t = true;
        }  else {
            $t = false;
        }
        
        return $t;
        
    }
    
    
     public function alterarNum_processo($matricula,$num_processo_antigo) {
        $stmt = $this->db->prepare("update matricula set num_processo=? where num_processo=?");
        $stmt->bindValue(1,  $matricula->getNum_processo());
//        $stmt->bindValue(2,  $matricula->getIdAluno());
        $stmt->bindValue(2,  $num_processo_antigo);
        $stmt->execute();
            
        
        if ($stmt->execute()) {
            $t = true;
        }  else {
            $t = false;
        }
        
        return $t;
        
    }
    
    public function consultarMatricula($matricula) {
        
        
         $stmt = $this->db->prepare("select * from matricula where num_processo=? and ano_lectivo=?");
        $stmt->bindValue(1, $matricula->getNum_processo());
        $stmt->bindValue(2, $matricula->getAno_lectivo());
        $stmt->execute();
        
            
             $resultado = $stmt->fetchobject();

            $matricula = new matricula();
            
          
            if (isset($resultado)) {
                $matricula->setId($resultado->idMatricula); 
            $matricula->setNum_processo($resultado->num_processo); 
            $matricula->setAno_lectivo($resultado->ano_lectivo);
            $matricula->setData_registo($resultado->data_registo);
            $matricula->setIdAluno($resultado->idAluno);
            return $matricula;
            }  else {
                return false;
            }
            
    
    }
    
    
    public function consultarPorCod_aluno($num_processo) {
        
         $stmt = $this->db->prepare("select * from matricula where num_processo=?");
        $stmt->bindValue(1, $num_processo);
        $stmt->execute();
        
            
             $resultado = $stmt->fetchobject();

            $matricula = new matricula();
            
            
            $matricula->setId($resultado->idMatricula); 
            $matricula->setNum_processo($resultado->num_processo); 
//            $matricula->setAno_lectivo($resultado->ano_lectivo);
            $matricula->setData_registo($resultado->data_registo);
            $matricula->setIdAluno($resultado->idAluno);
            
            
    return $matricula;
    
    }
  
    
    
}
