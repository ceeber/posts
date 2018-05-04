<?php
namespace controller;
use model\sistemaControle;

include_once '../model/sistemaControle.php';

  abstract class dadosPosts {
  
  public $conexao; 
  public $email;
  public $senha;
  public $codigoUsuario;
  public $titulo;
  public $codImagem;
  public $informacao;
  public $nome;
  public $data;
  
  public function getData() {
      return $this->data;
  }

  public function setData($data) {
      $this->data = $data;
  }
    
  public function getNome() {
      return $this->nome;
  }

  public function setNome($nome) {
      $this->nome = $nome;
  }
    
  public function getTitulo() {
      return $this->titulo;
  }

  public function getCodImagem() {
      return $this->codImagem;
  }

  public function getInformacao() {
      return $this->informacao;
  }

  public function setTitulo($titulo) { 
      $this->titulo = $titulo;
  }

  public function setCodImagem($codImagem) {
      $this->codImagem = $codImagem;
  }

  public function setInformacao($informacao) {
      $this->informacao = $informacao;
  }

  public function getCodigoUsuario() {
      return $this->codigoUsuario;
  }

  public function setCodigoUsuario($codigoUsuario) {
      $this->codigoUsuario = $codigoUsuario;
  }

  public function getEmail() {
      return $this->email;
  }

  public function getSenha() {
      return $this->senha;
  }

  public function setEmail($email) {
      $this->email = $email;
  }

  public function setSenha($senha) {
      $this->senha = $senha;
  }
     
  abstract protected function acessoAplicacao();
  abstract protected function pesquisaPosts();
  abstract protected function inserirPostagem();
  abstract protected function pesquisaDadosUsuario();
  abstract protected function atualizaSenha();
  abstract protected function pesquisarUsuario();
  abstract protected function criarUsuario();
  }
  
 class controleDados extends dadosPosts { 
  
     
   public function __construct(){
    
    $this->conexao = new sistemaControle();
   
   }
    
  
   public function acessoAplicacao(){
   
      return $this->conexao->pesquisaAcesso($this);
   }
   
   public function pesquisaPosts(){
       
      return $this->conexao->pesquisarPublicacao($this);       
   }
   
   public function inserirPostagem(){
       
      return $this->conexao->registrarPost($this);       
   }
   
   public function pesquisaDadosUsuario(){
       
      return $this->conexao->dadosUsuario($this);       
   }
   
   
   public function atualizaSenha(){
       
      return $this->conexao->criarNovaSenha($this);       
   }
   
   public function pesquisarUsuario(){
       
      return $this->conexao->pesquisarCadastro($this);       
   }
   
   public function criarUsuario(){
       
      return $this->conexao->novoUsuario($this);       
   }
   
   public function pesquisaPostagem(){
       
      return $this->conexao->pesquisaDataPost($this);       
   }
   
  
  }
