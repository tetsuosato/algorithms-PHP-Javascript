<?php
// Inicia a sessão
session_start();

// Remove a variável de sessão específica
unset($_SESSION['login']);

// Destrói completamente a sessão
session_destroy();

// Redireciona para a página de login
header("Location: ../index");
exit;