<?php
namespace controller;
use controller\controleDados;
session_start();
include_once '../controller/controleDados.php';

if (empty ($_POST['inputEmail'])):    
    header("location:../view/index.php?error=1");
endif;
if (empty ($_POST['inputSenha'])):    
    header("location:../view/index.php?error=1");
endif;

$pesqAcesso = new controleDados();

$pesqAcesso->setEmail($_POST['inputEmail']);
$pesqAcesso->setSenha($_POST['inputSenha']);

$arq = $pesqAcesso->acessoAplicacao();
 
if (count($arq) == 1):
  
  header("location:../view/index.php?error=2");  
else:  
  $_SESSION['nomeUsuario'] = $arq['usuario_nome']; 
  $_SESSION['acessoUsuario'] = $arq['usuario_email']; 
  $_SESSION['codigoUsuario'] = $arq['usuario_id']; 
  
  header("location:../view/postMain.php");  
endif;