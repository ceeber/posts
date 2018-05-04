<?php
namespace controller;

session_start();
session_unset();

if (empty($_SESSION['nomeUsuario'])):    
    header("location:../view/index.php");
endif;
