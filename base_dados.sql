CREATE DATABASE IF NOT EXISTS `prova_web` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `prova_web`;

-- 1. Tabela para o conteúdo dinâmico da Homepage (Artigos)
CREATE TABLE IF NOT EXISTS `artigos` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `titulo` VARCHAR(150) NOT NULL,
  `descricao` TEXT NOT NULL,
  `data_criacao` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- Inserção de dados demo (3 artigos)
INSERT INTO `artigos` (`titulo`, `descricao`) VALUES
('Novidades do Desenvolvimento Web 2026', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.'),
('Como dominar o PHP PDO', 'Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.'),
('Segurança em Formulários HTML', 'Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.');

-- 2. Tabela para registar os dados do Formulário
CREATE TABLE IF NOT EXISTS `contactos` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `nome` VARCHAR(100) NOT NULL,
  `email` VARCHAR(100) NOT NULL,
  `assunto` VARCHAR(150) NOT NULL,
  `mensagem` TEXT NOT NULL,
  `data_registo` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;