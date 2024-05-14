<?php
class AutenticacaoLogin {
    public static function autenticar($login, $senha, $captcha) {
        // date_default_timezone_set('America/Sao_Paulo'); Padrão do fuso horário

        // Verificar se o CAPTCHA está correto
        if ($captcha != $_SESSION['captcha']) {
            // CAPTCHA incorreto
            return false;
        }

        try {
            // Conectar ao banco de dados usando PDO
            $conexao = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASSWORD);

            // Configurar PDO para lançar exceções em caso de erros
            $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Obter o login do formulário e escapar para prevenir injeção de SQL
            $loginForm = $conexao->quote($login);

            // Consultar o banco de dados para obter a senha criptografada
            $query = "SELECT `id`, `login`, `password`, `nome`, `sobrenome`, `email` FROM users WHERE `login`= $loginForm";
            $resultado = $conexao->query($query);

            // Verificar se houve resultados
            if ($resultado->rowCount() == 1) {
                $row = $resultado->fetch(PDO::FETCH_ASSOC);
                $senhaHash = $row['password'];
                $usuario = $row['login'];
                $nome = $row['nome'];
                $sobrenome = $row['sobrenome'];
                $email = $row['email'];

                // Verificar se a senha fornecida corresponde à senha armazenada
                if (password_verify($senha, $senhaHash)) {
                    // Login bem-sucedido! Gerar e armazenar o token
                    $userId = $row['id'];
                    $token = bin2hex(random_bytes(32)); // Gerar um token aleatório

                    // Obtém a data e hora atual
                    $dataHoraAtual = date("Y-m-d H:i:s"); // Formato: Ano-Mês-Dia Hora:Minuto:Segundo

                    // Acrescenta um dia
                    $dataHoraAmanha = date("Y-m-d H:i:s", strtotime("+1 day", strtotime($dataHoraAtual)));

                    // Armazenar o token e seu tempo de expiração no banco de dados
                    $updateQuery = "UPDATE users SET 
                                        token='$token', 
                                        token_expiry='$dataHoraAmanha', 
                                        data_login = '$dataHoraAtual'
                                    WHERE id='$userId'
                    ";
                    $conexao->exec($updateQuery);

                    // Definir o token na sessão
                    session_start();
                    $_SESSION['token'] = $token;
                    $_SESSION['usuario'] = $usuario;
                    $_SESSION['id_usuario'] = $userId;
                    $_SESSION['nome'] = $nome;
                    $_SESSION['sobrenome'] = $sobrenome;
                    $_SESSION['email'] = $email;

                    return true;
                }
            }
        } catch (PDOException $e) {
            // Em caso de erro, exibir mensagem de erro e encerrar a conexão
            echo "Erro ao conectar ao banco de dados: " . $e->getMessage();
        }

        // Dados inválidos ou erro de conexão
        return false;
    }

    public static function validarToken($token) {
        try {
            // Conectar ao banco de dados usando PDO
            $conexao = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASSWORD);

            // Configurar PDO para lançar exceções em caso de erros
            $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Obter o token do formulário e escapar para prevenir injeção de SQL
            $tokenForm = $conexao->quote($token);

            // Consultar o banco de dados para verificar o token
            $query = "SELECT id FROM users WHERE token=$tokenForm AND token_expiry > NOW()";
            $resultado = $conexao->query($query);

            // Verificar se houve resultados
            if ($resultado->rowCount() == 1) {
                return true;
            }
        } catch (PDOException $e) {
            // Em caso de erro, exibir mensagem de erro e encerrar a conexão
            echo "Erro ao conectar ao banco de dados: " . $e->getMessage();
        }

        // Token inválido, expirado ou erro de conexão
        return false;
    }
}
?>
