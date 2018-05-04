<?php
namespace model;
use model\conexao;

include_once 'conexao.php';

   class sistemaControle extends conexao{
   
     public $conn;
     
     public function __construct(){
     
      $this->conn = new conexao();
     
     }
   
     
     public function pesquisaAcesso($arq){

       $emailUser = $arq->getEmail();
       $senha = $arq->getSenha();
                      
       $sql = "SELECT usuario_nome, usuario_email, usuario_id FROM usuario WHERE usuario_email = ? AND usuario_senha = ?";       
       
       $query = $this->conn->pdo->prepare($sql);
       $query->bindParam(1, $emailUser);
       $query->bindParam(2, $senha);
       
       $query->execute();
       
         return $query->fetch();
          
     }
     
     public function pesquisarCadastro($arq){

       $emailUser = $arq->getEmail();
                             
       $sql = "SELECT usuario_email, usuario_nome, usuario_id FROM usuario WHERE usuario_email = ?";       
       
       $query = $this->conn->pdo->prepare($sql);
       $query->bindParam(1, $emailUser);
              
       $query->execute();
       
         return $query->fetch();
          
     }
     
     public function pesquisarPublicacao($arq){
        
        $codigo = $arq->getCodigoUsuario();
         
        $sql = "SELECT pos.post_titulo, pos.post_cod_imagem, pos.post_informacao, DATE_FORMAT (pos.post_data, '%d/%m/%Y') AS datapostagem FROM post pos INNER JOIN
                 usuario usu ON usu.usuario_id = pos.post_codigo_usuario WHERE usu.usuario_email = ? ORDER BY post_id desc";
        
        $query = $this->conn->pdo->prepare($sql);        
        $query->bindParam(1,$codigo);
        
        $query->execute();
        
        return $query->fetchAll();  
                  
     }
     
     public function dadosUsuario($arq){
        
        $email = $arq->getEmail();
        $sql = "SELECT usuario_nome, usuario_email, usuario_senha, DATE_FORMAT (usuario_data, '%d/%m/%Y') as datacad FROM usuario
                WHERE usuario_email = ?";
        
        $query = $this->conn->pdo->prepare($sql);        
        $query->bindParam(1,$email);
        
        $query->execute();
        
        return $query->fetch();  
                  
     }
     
     public function registrarPost($arq){
               
       
        $titulo = $arq->getTitulo();
        $idImagem = $arq->getCodImagem();
        $info = $arq->getInformacao();
        $usuarioCod = $arq->getCodigoUsuario();         
        
         $sql = "INSERT INTO post (post_codigo_usuario,post_titulo,post_cod_imagem,post_informacao,post_data) VALUES (?,?,?,?,NOW())";
                  
         $query = $this->conn->pdo->prepare($sql);        
                  
         $query->bindParam(1,$usuarioCod);
         $query->bindParam(2,$titulo);
         $query->bindParam(3,$idImagem);         
         $query->bindParam(4,$info);
         
         $query->execute();
              
     }
     
      public function pesquisaDataPost($arq){

        $codigo = $arq->getCodigoUsuario();
        $data = $arq->getData(); 
         
        $sql = "SELECT pos.post_titulo, pos.post_cod_imagem, pos.post_informacao, DATE_FORMAT (pos.post_data, '%d/%m/%Y') AS datapostagem FROM post pos INNER JOIN
                usuario usu ON usu.usuario_id = pos.post_codigo_usuario WHERE pos.post_data = ? AND usu.usuario_email = ? ORDER BY post_id desc";
        
        $query = $this->conn->pdo->prepare($sql);        
        $query->bindParam(1,$data);
        $query->bindParam(2,$codigo);
        
        $query->execute();
        
        return $query->fetchAll(); 
     
     }
     
     public function novoUsuario($arq){               
       
        $email = $arq->getEmail();
        $nome = $arq->getNome();
        $senha = $arq->getSenha();
         
         $sql = "INSERT INTO usuario (usuario_nome, usuario_email,usuario_senha,usuario_data) VALUES (?,?,?,NOW())";
                  
         $query = $this->conn->pdo->prepare($sql);        
                  
         $query->bindParam(1,$nome);
         $query->bindParam(2,$email);
         $query->bindParam(3,$senha);         
                  
         $query->execute();
            
     }
     
     
     public function criarNovaSenha($arq){
        
        $codSeq = $arq->getSenha();
        $status = $arq->getEmail();
                
         $sql = "UPDATE usuario SET usuario_senha = ? WHERE usuario_email = ?";
                  
         $query = $this->conn->pdo->prepare($sql);        
                  
         $query->bindParam(1,$codSeq);
         $query->bindParam(2,$status);
                  
         $query->execute();         
                          
     }
     
   
   }

