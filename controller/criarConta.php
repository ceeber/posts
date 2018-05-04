<?php
namespace controller;
use controller\controleDados;
session_start();
include_once 'controleDados.php';


if (empty ($_POST['inputEmailCad'])):    
    header("location:../view/index.php?error=1");
endif;
if (empty ($_POST['inputNomeCad'])):    
    header("location:../view/index.php?error=1");
endif;
if (empty ($_POST['inputSenhaCad'])):    
    header("location:../view/index.php?error=1");
endif;

$pesqAcesso = new controleDados();

$pesqAcesso->setEmail($_POST['inputEmailCad']);
$pesqAcesso->setNome($_POST['inputNomeCad']);
$pesqAcesso->setSenha($_POST['inputSenhaCad']);

$arq = $pesqAcesso->pesquisarUsuario();

if ($arq == true):
 
  header("location:../view/index.php?error=3");  
else: 
  
  $pesqAcesso->criarUsuario();  
    
  $arq = $pesqAcesso->pesquisarUsuario();
  
  $_SESSION['nomeUsuario'] = $arq['usuario_nome']; 
  $_SESSION['acessoUsuario'] = $arq['usuario_email']; 
  $_SESSION['codigoUsuario'] = $arq['usuario_id']; 
  
   header("location:../view/postMain.php");  
endif;
