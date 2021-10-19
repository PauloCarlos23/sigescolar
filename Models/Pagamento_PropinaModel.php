<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Pagamento_PropinaModel
 *
 * @author Kasoft Development
 */

require_once 'Models/Pagamento_Propina.php';

class Pagamento_PropinaModel extends Conexao{
    //put your code here
    
    public function __construct() {
        parent::__construct();
    }
    
     public function cadastrar($pagamento,$idMatricula,$idUtilizador) {
        $stmt = $this->db->prepare("insert into pagamento_propina(mes,ano,observacao,idMatricula,idUtilizador) values(:mes,:ano,:observacao,:idMatricula,:idUtilizador)");
        $stmt->bindValue(":mes", $pagamento->getMes());
        $stmt->bindValue(":ano", $pagamento->getAno());
        $stmt->bindValue(":observacao", $pagamento->getObs());
        $stmt->bindValue(":idMatricula", $idMatricula);
        $stmt->bindValue(":idUtilizador", $idUtilizador);
        
//        Verificando se ja existe  um registo com os mesmos dados
        $verifica = $this->db->prepare("select * from pagamento_propina where ano=? and mes=? and idMatricula=?");
        $verifica->bindValue(1, $pagamento->getAno());
        $verifica->bindValue(2, $pagamento->getMes());
        $verifica->bindValue(3, $idMatricula);
        $verifica->execute();
        
            
        if ($verifica->rowCount() == 1) {
            $retorno = 0;
        }  else {
            $stmt->execute();
             $retorno = 1;
        }
        
        return $retorno;

    }
    
    public function obterPagamentos($idMatricula,$ano_lectivo) {
        $stmt = $this->db->prepare("select * from pagamento_propina where idMatricula=? and ano=?");
        $stmt->bindValue(1, $idMatricula);
        $stmt->bindValue(2, $ano_lectivo);
        $stmt->execute();
        
        
        
        $listas = array();
        
         while ($resultado = $stmt->fetchobject()){
             
             $pagamento_propina = new Pagamento_Propina();
        
//        if (isset($resultado)) {
            $pagamento_propina->setId($resultado->idPagamento_Propina); 
            $pagamento_propina->setMes($resultado->mes); 
            $pagamento_propina->setAno($resultado->ano); 
            $pagamento_propina->setObs($resultado->observacao);
            $pagamento_propina->setData_pagamento($resultado->data_pagamento);
            
//        }  else {
               array_push($listas, $pagamento_propina);
        }
        
        return $listas;
    }
    
    public function listar() {
        $stmt = $this->db->prepare("select prop.*,p.nome,p.sobrenome,c.designacao, c.valor_propina from pagamento_propina prop,matricula m,aluno a,classe c,pessoa p "
                . "WHERE "
                . "a.idPessoa=p.idPessoa "
                . "AND m.idAluno=a.idAluno "
                . "AND a.idClasse=c.idClasse "
                . "AND prop.idMatricula=m.idMatricula "
                . "order by data_pagamento DESC");
        $stmt->execute();
        
        
        
        $listas = array();
        
        
         while ($resultado = $stmt->fetchobject()){
             
             $pagamento_propina = new Pagamento_Propina();
        
        //if (isset($resultado)) {
            $pagamento_propina->setId($resultado->idPagamento_Propina); 
            $pagamento_propina->setMes($resultado->mes); 
            $pagamento_propina->setAno($resultado->ano); 
            $pagamento_propina->setObs($resultado->observacao);
            $pagamento_propina->setData_pagamento($resultado->data_pagamento);
            $pagamento_propina->setNome_aluno($resultado->nome.' '.$resultado->sobrenome);
            $pagamento_propina->setClasse_aluno($resultado->designacao);
            $pagamento_propina->setValor_propina($resultado->valor_propina);
            
            array_push($listas, $pagamento_propina);
            
           
            
//        }  else {
//             return NULL;  
//        }
        
        
        }

     return $listas;
     
    }
    
     public function obterPorIdUltimoPagamento($id) {

        $stmt = $this->db->prepare("SELECT * FROM pagamento_propina WHERE idMatricula=:id ORDER BY mes DESC Limit 1");
        $stmt->bindValue(":id", $id);
        $stmt->execute();
        
            $resultado = $stmt->fetchobject();
            
            
              $pagamento = new Pagamento_Propina();

            if(isset($resultado) && !empty($resultado)){
                
            $pagamento->setId($resultado->idPagamento_Propina);
            $pagamento->setMes($resultado->mes);
            $pagamento->setAno($resultado->ano);
                
                $retorno = $pagamento;
            }  else {
                $pagamento->setMes('NULL');
                $retorno = $pagamento;
            }

        return $retorno;
        
        
    }
    
    
}
