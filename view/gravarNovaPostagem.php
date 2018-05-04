<?php
namespace view;
use controller\controleDados;
session_start();
include_once '../controller/controleDados.php';

$gravarPost = new controleDados();

if (empty($_POST['publicacao'])):
   
   return 0; 
endif;

if (empty($_POST['descricaoMsn'])):
    
   return 0; 
endif;


if (!empty($_FILES['imagem']['name'])){
$_UP['pasta'] = 'C:/alex/Posts/view/imagemPost/';
$_UP['extensoes'] = array('jpg');

$extensao = strtolower(end(explode('.', $_FILES['imagem']['name'])));

if (array_search($extensao, $_UP['extensoes']) === false) {     
    print "<script>alert('Extensao permitida para imagem e jpg'); </script>;";
    die();
}    
    
$codBase = base64_encode($_SESSION['codigoUsuario'].$dataAtual = date('Y-m-d H:i'));
move_uploaded_file($_FILES['imagem']['tmp_name'], $_UP['pasta'] . $codBase.'.jpg');
$gravarPost->setCodImagem($codBase);

}

$gravarPost->setTitulo($_POST['publicacao']);
$gravarPost->setInformacao($_POST['descricaoMsn']);
$gravarPost->setCodigoUsuario($_SESSION['codigoUsuario']);

$retornoInfo = $gravarPost->inserirPostagem();

header("location:postMain.php");

