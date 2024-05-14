-- --------------------------------------------------------
-- Servidor:                     127.0.0.1
-- Versão do servidor:           10.4.32-MariaDB - mariadb.org binary distribution
-- OS do Servidor:               Win64
-- HeidiSQL Versão:              12.6.0.6765
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Copiando estrutura do banco de dados para devpablotetsuosato
DROP DATABASE IF EXISTS `devpablotetsuosato`;
CREATE DATABASE IF NOT EXISTS `devpablotetsuosato` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci */;
USE `devpablotetsuosato`;

-- Copiando estrutura para tabela devpablotetsuosato.users
DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Id do Usuário',
  `nome` text NOT NULL COMMENT 'Nome do Usuário',
  `sobrenome` text NOT NULL COMMENT 'Sobrenome do Usuário',
  `login` text NOT NULL COMMENT 'Login para acessar o sistema',
  `password` text NOT NULL COMMENT 'Senha para acessar o sistema',
  `email` text NOT NULL COMMENT 'Email do usuário',
  `token` text NOT NULL COMMENT 'Token para Autenticar o seu Acesso',
  `token_expiry` datetime NOT NULL COMMENT 'Data e hora que o token irá expirar',
  `data_criacao` datetime NOT NULL COMMENT 'Data e hora que o usuário foi criado',
  `data_login` datetime NOT NULL COMMENT 'Data e hora que o usuário acessou o sistema',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Copiando dados para a tabela devpablotetsuosato.users: ~3 rows (aproximadamente)
DELETE FROM `users`;
INSERT INTO `users` (`id`, `nome`, `sobrenome`, `login`, `password`, `email`, `token`, `token_expiry`, `data_criacao`, `data_login`) VALUES
	(1, 'Nome do Admin', 'Sobrenome do Admin', 'admin', '$2y$10$uHBDOh5fvDw70FxatDC.yuxBTQ194.1XD3cCzeJ8ZKd8saszzoXRG', 'pablosato@ymail.com', '349dc110cd7e7200cc8fd1b0cab69144008359582fbb172e641730dd5d4755df', '2024-05-08 23:53:06', '2024-04-27 12:00:00', '2024-05-07 23:53:06'),
	(2, 'Teste Nome', 'Teste Sobrenome', 'teste', '$2y$10$uHBDOh5fvDw70FxatDC.yuxBTQ194.1XD3cCzeJ8ZKd8saszzoXRG', 'pablosato@ymail.com', '', '0000-00-00 00:00:00', '2024-04-27 12:01:00', '0000-00-00 00:00:00'),
	(3, 'pablo tetsuo', 'sato', 'pablo', '$2y$10$uHBDOh5fvDw70FxatDC.yuxBTQ194.1XD3cCzeJ8ZKd8saszzoXRG', 'pablosato@ymail.com', '218e7f35b71e5cad0245ef485be77b45a540ace7ace8173f61389771b38d783c', '2024-05-14 22:20:23', '2024-04-27 12:02:00', '2024-05-13 22:20:23');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
