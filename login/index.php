<?php
session_start(); 
include('config/config.php');
require_once('class/AutenticacaoLogin.php');

// Verificar se o login
if(isset($_POST['acao'])) {
    $login = $_POST['login'];
    $senha = $_POST['senha'];
    $captcha = $_POST['captcha'];

    if(AutenticacaoLogin::autenticar($login, $senha, $captcha)) {
        // Login bem-sucedido, redirecionar para a página inicial (index.php)
        header('Location: main/');
        exit();
    } else {
        // Dados inválidos
        echo '<script src="js/password-invalid.js"></script>';
    }
}

// Se não estiver logado, exibir o formulário de login
if(isset($_SESSION['token'])){
    $token = $_SESSION['token'];

    if(!AutenticacaoLogin::validarToken($token)) {
        // Token inválido ou expirado, redirecionar para de aviso de expiração
        include('sessao-expirada');
        unset($_SESSION['login']);
        session_destroy();
        exit();
    }else{
        header('Location: main/');
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <title>Login PHP, MYSQL, JavaScript e Boostrap 5</title>

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
<body class="bg-light text-dark">
    <header>
        <!-- place navbar here -->
    </header>
    <main></main>

    <div class="container col-sm-4 border border-2 border-secondary rounded p-3 mx-auto mt-5 bg-light text-dark">
        <!-- Alerta de Dados Inválidos -->
        <div id="alertaDadosInvalidos" class="alert alert-danger alert-dismissible fade show d-none" role="alert">
            Dados inválidos. Por favor, verifique suas credenciais e tente novamente.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>

        <form method="post">
            <div class="mb-3">
                <label for="login" class="form-label">Login</label>
                <input type="text" class="form-control" id="login" name="login" alt="Login" placeholder="Digite seu login">
            </div>
            <div class="mb-3">
                <label for="senha" class="form-label">Senha</label>
                <div class="input-group">
                    <input type="password" class="form-control" id="senha" name="senha" alt="Senha" placeholder="Digite sua senha">
                    <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                        <i class="bi bi-eye"></i>
                    </button>
                </div>
            </div>
            <div class="row mb-3">
                <label for="captcha" class="form-label">Digite o conteúdo da imagem</label>
                <div class="col">
                    <img src="functions/captcha.php" alt="CAPTCHA">
                </div>
                <div class="col">
                    <input type="text" class="form-control" id="captcha" name="captcha">
                </div>
            </div>
            <div class="d-grid col-6 mx-auto">
                <button type="submit" class="btn btn-primary btn-block" name="acao" value="Entrar">Entrar</button>
            </div>
        </form>

        <hr>

    </div><!-- container -->

    
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

    <!-- Scripts -->
    <script src="js/password-visible.js"></script>
</body>
</html>