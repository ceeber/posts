<?php
namespace model;
use \PDO;

class conexao {

 public $pdo;

 public function __construct() {
 
  try{
    $this->pdo = new PDO('mysql:host=localhost;dbname=portal', 'root','123456');
  } catch (PDOException $e) {
  
   return "Falha conexao";
  }

 }

}

