<?php
session_start(); 
include('config/config.php');
require_once('class/AutenticacaoLogin.php');

if(!isset($_SESSION['token'])){
    unset($_SESSION['login']);
    session_destroy();
    header('Location: index');
    exit();
}else{
    unset($_SESSION['login']);
    session_destroy();
}

if(isset($_GET['logoff'])){
    unset($_SESSION['login']);
    session_destroy();
    header('Location: index');
    exit();
}
?>
<h1>Sua sessão expirou faça o login novamente</h1>
<br>
<a href="?logoff">ir para login</a>