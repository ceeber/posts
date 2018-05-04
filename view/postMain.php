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
      
   .image {
     align: center;
     height: 230px;
     width: 450px;
     margin: 5px 5px 0px 20px
   }
   
   .descricao{
     text-align:center;
     font-family: verdana;
     font-size: 14px;
     color: #1c94c4;       
   }   
   
   .postagem{
     text-align:center;
     font-family: verdana;
     font-size: 10px;
     color: #ccc;       
   }
  </style>
 
</head>
<body>

    <div class="container-fluid">
        <div class="row">
            Seja bem vindo(a): <?=$_SESSION['nomeUsuario']?> 
        </div>
    </div>
    <div class="jumbotron">
          <div class="container"> 
            <div class="col-md-3">
             <div class="btn-group-vertical">
             <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalPost"> Criar Post &raquo;</button>
             <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalPesquisaPost"> Pesquisar Posts &raquo;</button>                        
             <a class="btn btn-primary " href="gestaoUsuario.php" role="button"> Configuração &raquo;</a> 
             <a class="btn btn-primary " href="../controller/fecharAplicacao.php" role="button">Sair [x]</a>
             </div>
            </div>
            
              <div class="col-md-5">
               <?php
                $postPublicados = new controleDados();
                
                $postPublicados->setCodigoUsuario($_SESSION['acessoUsuario']);
                $publ = $postPublicados->pesquisaPosts(); 
                                
                  foreach ($publ as $dadosPost){
                    ?>                 
                     <div class="publicacao">  <div class="descricao">                    
                    <?=$dadosPost['post_titulo']?><br></div><div class="postagem">Postagem: 
                    <?=$dadosPost['datapostagem']?></div> <br>
                         
                        
                    <?php
                     print $dadosPost['post_informacao']."<br>";
                     
                      if (file_exists("./imagemPost/".$dadosPost['post_cod_imagem'].".jpg")):
                    ?>                      
                         <img class="image" src="./imagemPost/<?=$dadosPost['post_cod_imagem']?>.jpg">                                              
                    <?php 
                      endif;
                    ?> 
                    <br><br></div> <br>
                    <?php
                  }              
                            
               ?>   
                             
               </div>     
              
          </div>

    </div>
    
    
<!-- Modal Criar Post -->
<div class="modal fade" id="modalPost" tabindex="-1" role="dialog" aria-labelledby="modalPost" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="ModalLabel">CRIAR POST</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="container">  
        <form action="gravarNovaPostagem.php" method="POST" enctype="multipart/form-data">
                                
            <div class="input-group">
            <label class="col-sm-2 control-label">TÍTULO&nbsp;PUBLICAÇÃO:</label>
            <div class="col-sm-12">
            <input id="publicacao" type="text" class="form-control" name="publicacao" placeholder="Título Publicação" required autofocus>
            </div>
            </div>
            
            <div class="input-group">
                <label class="col-sm-2 control-label">IMAGEM:</label>
            <div class="col-sm-12">
                <input id="imagem" type="file" name="imagem" placeholder="Imagem">
            </div>
            </div>
                                    
            <div class="input-group">
            <label class="col-sm-2 control-label">INFORMAÇÕES:</label>
            <div class="col-sm-12">
            <textarea name="descricaoMsn" placeholder="Sua Mensagem..." required></textarea>
            </div>
            </div>
                    
                    
          </div>
         </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary" id="infoPost">Postar</button>  
      </form>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>        
      </div>
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