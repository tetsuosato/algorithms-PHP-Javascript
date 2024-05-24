<?php
class LoginAuthentication {
    public static function authenticate($login, $password, $captcha) {
        // date_default_timezone_set('America/Sao_Paulo'); Padrão do fuso horário

        // Verificar se o CAPTCHA está correto
        // Check if the CAPTCHA is correct
        if ($captcha != $_SESSION['captcha']) {
            // CAPTCHA incorreto
            // Incorrect captcha
            return false;
        }

        try {
            // Conectar ao banco de dados usando PDO
            // Connect to database using PDO
            $connection = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASSWORD);

            // Configurar PDO para lançar exceções em caso de erros
            // Configure PDO to throw exceptions in case of errors
            $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Obter o login do formulário e escapar para prevenir injeção de SQL
            // Get form login and escape to prevent SQL injection
            $loginForm = $connection->quote($login);

            // Consultar o banco de dados para obter a password criptografada
            // Query the database to obtain the encrypted password
            $query = "SELECT `id`, `login`, `password`, `name`, `lastname`, `email` FROM users WHERE `login`= $loginForm";
            $result = $connection->query($query);

            // Verificar se houve resultados
            // Check if there were results
            if ($result->rowCount() == 1) {
                $row = $result->fetch(PDO::FETCH_ASSOC);
                $passwordHash = $row['password'];
                $user = $row['login'];
                $name = $row['name'];
                $lastname = $row['lastname'];
                $email = $row['email'];

                // Verificar se a password fornecida corresponde à password armazenada
                // Check if the password provided matches the stored password
                if (password_verify($password, $passwordHash)) {
                    // Login bem-sucedido! Gerar e armazenar o token
                    // Login successful! Generate and store the token
                    $userId = $row['id'];

                    // Gerar um token aleatório
                    // Generate a random token
                    $token = bin2hex(random_bytes(32)); 

                    // Obtém a data e hora atual
                    // Gets the current date and time

                    // Formato: Ano-Mês-Dia Hora:Minuto:Segundo
                    // Format: Year-Month-Day Hour:Minute:Second
                    $dateCurrentTime = date("Y-m-d H:i:s"); 

                    // Acrescenta um dia
                    // Add a day
                    $dataTimeTomorrow = date("Y-m-d H:i:s", strtotime("+1 day", strtotime($dateCurrentTime)));

                    // Armazenar o token e seu tempo de expiração no banco de dados
                    // Store the token and its expiration time in the database
                    $updateQuery = "UPDATE users SET 
                                        token='$token', 
                                        token_expiry='$dataTimeTomorrow', 
                                        data_login = '$dateCurrentTime'
                                    WHERE id='$userId'
                    ";
                    $connection->exec($updateQuery);

                    // Definir o token na sessão
                    // Set the token in the session
                    session_start();
                    $_SESSION['token'] = $token;
                    $_SESSION['user'] = $user;
                    $_SESSION['id_user'] = $userId;
                    $_SESSION['name'] = $name;
                    $_SESSION['lastname'] = $lastname;
                    $_SESSION['email'] = $email;

                    return true;
                }
            }
        } catch (PDOException $e) {
            // Em caso de erro, exibir mensagem de erro e encerrar a conexão
            // In case of error, display error message and close connection
            echo "Error connecting to database: " . $e->getMessage();
        }

        // Dados inválidos ou erro de conexão
        // Invalid data or connection error
        return false;
    }

    public static function validateToken($token) {
        try {
            // Conectar ao banco de dados usando PDO
            // Connect to database using PDO
            $connection = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASSWORD);

            // Configurar PDO para lançar exceções em caso de erros
            // Configure PDO to throw exceptions in case of errors
            $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Obter o token do formulário e escapar para prevenir injeção de SQL
            // Get form token and escape to prevent SQL injection
            $tokenForm = $connection->quote($token);

            // Consultar o banco de dados para verificar o token
            // Query the database to verify the token
            $query = "SELECT id FROM users WHERE token=$tokenForm AND token_expiry > NOW()";
            $result = $connection->query($query);

            // Verificar se houve resultados
            // Check if there were results
            if ($result->rowCount() == 1) {
                return true;
            }
        } catch (PDOException $e) {
            // Em caso de erro, exibir mensagem de erro e encerrar a conexão
            // In case of error, display error message and close connection
            echo "Error connecting to database: " . $e->getMessage();
        }

        // Token inválido, expirado ou erro de conexão
        // Invalid, expired token or connection error
        return false;
    }
}
?>
