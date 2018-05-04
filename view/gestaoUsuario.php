<?php
namespace view;
use controller\controleDados;
session_start();

if (empty($_SESSION['nomeUsuario'])):    
   header("location:index.php");
   die();
endif;

include_once '../controller/controleDados.php';

date_default_timezone_set('America/Sao_Paulo');
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
  <title>Posts</title>    
  <link href="./bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <style>

   body{
    background-color: #ccc;
   }

   .container-fluid{
   background-color: #fff;
   }

   .publicacao{
    background-color:#fff;
    width:500px;
    height:auto; 
    border-radius: 5px;  
    overflow:auto;
    }
   
  </style>
 
</head>
<body>

    <div class="container-fluid">
        <div class="row">
            Seja bem vindo(a): <?=$_SESSION['nomeUsuario']?>        </div>
    </div>
    <div class="jumbotron">
          <div class="container"> 
            <div class="col-md-3">
             <div class="btn-group-vertical">             
             <a class="btn btn-primary " href="postMain.php" role="button">Página inicial &raquo;</a>                 
             <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalPesquisaPost"> Pesquisar Posts &raquo;</button>              
             <a class="btn btn-primary " href="gestaoUsuario.php" role="button"> Configuração &raquo;</a> 
             <a class="btn btn-primary " href="../controller/fecharAplicacao.php" role="button">Sair [x]</a>
             </div>
            </div>
            
              <div class="col-md-5">
               <?php
                $postPublicados = new controleDados();
                
                
                if (!empty($_POST['novaSenha'])):

                  $postPublicados->setSenha($_POST['novaSenha']);
                  $postPublicados->setEmail($_SESSION['acessoUsuario']);
                  $postPublicados->atualizaSenha();     
                  print "<script>alert('Registro atualizado');</script>";
                endif;  
     
                
                $postPublicados->setEmail($_SESSION['acessoUsuario']);
                $publ = $postPublicados->pesquisaDadosUsuario(); 
                                  
                ?>                 
                     <div class="publicacao">                      
                         <h3> Configuração da conta </h3>
                         <table class="table table-striped">
                         
                             <tr><th>Nome</th>                       
                             <td><?=$publ['usuario_nome']?></td>
                             <tr><th>Data Cadastro</th>                       
                             <td><?=$publ['datacad']?></td>
                             <tr><th>E-mail</th>                       
                             <td><?=$publ['usuario_email']?></td>
                             <tr><th>Senha</th>                              
                             <td>
                                 <form action="#" method="POST">
                                 <input type="text" value="<?=$publ['usuario_senha']?>" name="novaSenha">
                                 <input type="submit" class="btn btn-primary" id="Atualizar" value="Atualizar">
                             </form>        
                         </td></tr>
                         </table>
                    </div> <br>
                          
               </div>     
              
          </div>

    </div>    
    
      
<!-- Modal pesquisa post -->
<div class="modal fade" id="modalPesquisaPost" tabindex="-1" role="dialog" aria-labelledby="modalPesquisaPost" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="ModalLabel">PESQUISA PUBLICAÇÃO </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="container">  
        <form action="pesquisaPostagem.php" method="POST">
                                
            <div class="input-group">
            <label class="col-sm-2 control-label">DATA&nbsp;PESQUISA:</label>
            <div class="col-sm-12">
                <input type='text' name='dataPesq' size='20' maxlength='20' id='datepicker'>
            </div>
            </div>
                               
                    
          </div>
         </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary" id="infoPost">Pesquisar</button>  
      </form>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>        
      </div>
    </div>
  </div>
</div>
   
    
    
    <script src="./js/jquery.js"></script>
    <script src="./bootstrap/js/bootstrap.min.js"></script> 
    <script src="./js/jquery-ui.js"></script>
    <script src="./js/Chart.min.js"></script>
    <script type="text/javascript" src="./js/jquery.maskedinput-1.1.1.js" ></script>
    <link href="./css/jquery-ui.css" rel="stylesheet">    
    <script type="text/javascript" src="./js/padrao.js" ></script>

