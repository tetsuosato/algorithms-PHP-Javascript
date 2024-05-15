<?php
// Inicia a sessão
// Start the session
session_start();

// Remove a variável de sessão específica
unset($_SESSION['login']);

// Destrói completamente a sessão
// Remove specific session variable
session_destroy();

// Redireciona para a página de login
// Redirects to login page
header("Location: ../index");
exit;