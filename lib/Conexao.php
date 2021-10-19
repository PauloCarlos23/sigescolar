<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Conexao
 *
 * @author Scientist Yokaliye
 */
class Conexao {
    //put your code here
    
    protected $db;
    
    function __construct() {
        $this->db = new PDO("mysql:host=localhost;dbname=sge_escolar","root","");
        $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
}
