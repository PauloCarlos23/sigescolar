<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PessoaMOdel
 *
 * @author Kasoft Development
 */
require_once 'Models/Pessoa.php';

class PessoaMOdel extends Conexao {
    //put your code here
    
    public function __construct() {
        parent::__construct();
    }
    
    
    public function cadastrar($pessoa,$idMorada) {
        $stmt = $this->db->prepare("insert into pessoa"
                . " (nome,sobrenome,nome_pai,nome_mae,data_nascim,genero,naturalidade,bi_cp,telefone,foto,idMorada) "
                . "values "
                . "(:nome,:sobrenome,:nome_pai,:nome_mae,:data_nascim,:genero,:naturalidade,:bi_cp,:telefone,:foto,:idMorada)");
         $stmt->bindValue(":nome",  $pessoa->getNome());
        $stmt->bindValue(":sobrenome",  $pessoa->getSobrenome());
        $stmt->bindValue(":genero",  $pessoa->getGenero());
        $stmt->bindValue(":telefone",  $pessoa->getTelefone());
        $stmt->bindValue(":nome_pai",  $pessoa->getNome_pai());
        $stmt->bindValue(":nome_mae",  $pessoa->getNome_mae());
        $stmt->bindValue(":data_nascim",  $pessoa->getData_nascim());
        $stmt->bindValue(":naturalidade",  $pessoa->getNaturalidade());
        $stmt->bindValue(":bi_cp",  $pessoa->getBi_cp());
        $stmt->bindValue(":foto",  $pessoa->getFoto());
        $stmt->bindValue(":idMorada",  $idMorada);
        
        //        Verificando se existe ja um registo com estes dados
        $verifica = $this->db->prepare("select * from pessoa where bi_cp=?");
        $verifica->bindValue(1, $pessoa->getBi_cp());
        $verifica->execute();
            
             
        if ($verifica->rowCount() == 1) {
            $pessoa->setId(0);
        }  else {
            $stmt->execute();
            
        //        Buscando idMorada do registo ora efectuado
        $buscaId = $this->db->prepare("select idPessoa from pessoa where bi_cp=?");
        $buscaId->bindValue(1, $pessoa->getBi_cp());
        $buscaId->execute();
            
             $resultado = $buscaId->fetchobject();

            $pessoa = new Pessoa();

            $pessoa->setId($resultado->idPessoa); 
//            
//            
        }
        
        

        
        return $pessoa;
        
    }
    
    
    public function consultar($idPessoa) {
        
         $stmt = $this->db->prepare("select * from pessoa where idPessoa=?");
        $stmt->bindValue(1, $idPessoa);
        $stmt->execute();
        
            
             $resultado = $stmt->fetchobject();

            $pessoa= new Pessoa();
            
            
            $pessoa->setId($resultado->idPessoa); 
            $pessoa->setNome($resultado->nome);
            $pessoa->setSobrenome($resultado->sobrenome);
            $pessoa->setNome_pai($resultado->nome_pai);
            $pessoa->setNome_mae($resultado->nome_mae);
            $pessoa->setTelefone($resultado->telefone);
            $pessoa->setBi_cp($resultado->bi_cp);
            $pessoa->setData_nascim($resultado->data_nascim);
            $pessoa->setFoto($resultado->foto);
            $pessoa->setGenero($resultado->genero);
            $pessoa->setNaturalidade($resultado->naturalidade);
            $pessoa->setIdMorada($resultado->idMorada);
            
            
    return $pessoa;
    
    }
    
    
    public function alterar($pessoa) {
        $stmt = $this->db->prepare("update pessoa set nome=?,sobrenome=?,nome_pai=?,nome_mae=?,"
                . "data_nascim=?,genero=?,naturalidade=?,bi_cp=?,telefone=?,foto=? where idPessoa=?");
         $stmt->bindValue(1,  $pessoa->getNome());
        $stmt->bindValue(2,  $pessoa->getSobrenome());
        $stmt->bindValue(3,  $pessoa->getNome_pai());
        $stmt->bindValue(4,  $pessoa->getNome_mae());
        $stmt->bindValue(5,  $pessoa->getData_nascim());
        $stmt->bindValue(6,  $pessoa->getGenero());
        $stmt->bindValue(7,  $pessoa->getNaturalidade());
        $stmt->bindValue(8,  $pessoa->getBi_cp());
        $stmt->bindValue(9,  $pessoa->getTelefone());
        $stmt->bindValue(10,  $pessoa->getFoto());
        $stmt->bindValue(11,  $pessoa->getId());
        $stmt->execute();
            
       
         if (isset($stmt)) {
            $confirmacao = TRUE;
        }  else {
            $confirmacao = FALSE;
        }
        
        
        return $confirmacao;
    
    }
}
