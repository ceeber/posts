<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">    
    <meta name="description" content="">
    <meta name="author" content="">
    
    <title>Acesso Portal</title>

    <link href="./bootstrap/css/bootstrap.min.css" rel="stylesheet">    
    <link href="./css/padraoCss.css" rel="stylesheet">
    <style>
        body{
         background-color: #fff;
        }
        
        .alerta{
            font-family: arial;
            font-size: 15px;
            color: #FF0000;
            text-align: center;            
        }
    </style>
    
  </head>
  <body>
         
   <div class="jumbotron">   
    <div class="container-fluid">
        <div class="col-md-4 col-lg-5">
      <form class="form-signin" action="../controller/validaAcesso.php" method="POST">
        <h2 class="form-signin-heading">Acesso Conta</h2>
        <label for="email" class="sr-only">E-mail</label>
        <input type="email" id="inputUsuario" name="inputEmail" class="form-control" placeholder="E-mail" required autofocus> <br>
        <label for="senha" class="sr-only">Senha</label>
        <input type="password" id="inputSenha" name="inputSenha" class="form-control" placeholder="Senha" required><br>
        
        <button class="btn btn-lg btn-primary btn-block" type="submit">Entrar</button>
      </form>

        </div> 
        <div class="col-md-4 col-lg-5">
            <form class="form-signin" action="../controller/criarConta.php" method="POST">
            <h2 class="form-signin-heading">Criar uma Conta</h2>
            
        <label for="nome" class="sr-only">Nome</label>
        <input type="nome" id="inputUsuarioCad" name="inputNomeCad" class="form-control" placeholder="Nome" required autofocus> <br>   
        <label for="email" class="sr-only">E-mail</label>
        <input type="email" id="inputUsuarioCad" name="inputEmailCad" class="form-control" placeholder="E-mail" required><br>
        <label for="senha" class="sr-only">Senha</label>
        <input type="password" id="inputSenhaCad" name="inputSenhaCad" class="form-control" placeholder="Senha" required><br>
        
        <button class="btn btn-lg btn-primary btn-block" type="submit">Cadastrar</button>
      </form>

        </div>
   
    </div>
    <?php
     if(!empty($_GET['error'])):
        
        if($_GET['error']== 1):
           print "<div class='alerta'Preencher todos os campos</div>";
        elseif($_GET['error']== 2):
           print "<div class='alerta'>E-mail ou senha inválido</div>";
        elseif($_GET['error']== 3):
           print "<div class='alerta'>E-mail já cadastrado,<br> escolha outro</div>";
        else:
           print "<div class='alerta'>Error 404</div>"; 
        endif;
        
     endif;
    
    ?>
   </div>   
      
  </body>
</html>
 

