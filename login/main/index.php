<?php
session_start(); 
include('../config/config.php');
require_once('../class/LoginAuthentication.php');

$token = $_SESSION['token'];
if(!LoginAuthentication::validateToken($token)) {
    header('Location: ../session-expired');
}
?>
<!doctype html>
<html lang="pt-br">
    <head>
        <title>Home - Login PHP, MYSQL, JavaScript e Boostrap 5</title>
        <!-- Required meta tags -->
        <meta charset="utf-8" />
        <meta
            name="viewport"
            content="width=device-width, initial-scale=1, shrink-to-fit=no"
        />

        <!-- Bootstrap CSS v5.2.1 -->
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
            crossorigin="anonymous"
        />

        <!-- Bootstrap Icons -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    </head>

    <body>
        <header>
            <!-- place navbar here -->
        </header>
        <main></main>
        <div class="container bg-light">
            <h1>WELCOME TO THE SYSTEM!</h1>
            <h2>Instagram: @pablo_sato</h2>
            <h3><a href="https://github.com/tetsuosato" target="_blank" rel="Siga-me no Github">Follow me on GitHub</a></h3>
            <p>Hello <?= $_SESSION['name'].' '.$_SESSION['lastname'] ?></p>
            <br><br>
            <a href="#" id="logout">Exit</a>
        </div>
        
        <!-- Função Sair do sistema -->
        <?php include('../modals/exit.html'); ?>
        <script src="../js/exit.js"></script>

        <footer>
        <!-- place footer here -->
        </footer>

        <!-- Bootstrap JavaScript Libraries -->
        <script
            src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
            integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
            crossorigin="anonymous"
        ></script>

        <script
            src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
            integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
            crossorigin="anonymous"
        ></script>
    </body>
</html>








