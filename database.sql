-- ============================================================
-- StockControl - Script de criação do banco de dados
-- ============================================================
-- Como usar:
-- 1. Abra o phpMyAdmin (http://localhost/phpmyadmin)
-- 2. Clique em "SQL" no menu superior (sem selecionar nenhum banco)
-- 3. Cole todo o conteúdo deste arquivo e clique em "Executar"
--
-- Alternativa: use o instalador automático em public/instalar.php
-- ============================================================

CREATE DATABASE IF NOT EXISTS `stockcontrol`
    CHARACTER SET utf8mb4
    COLLATE utf8mb4_unicode_ci;

USE `stockcontrol`;

-- ------------------------------------------------------------
-- Tabela: categorias
-- ------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `categorias` (
    `id` BIGINT NOT NULL AUTO_INCREMENT,
    `nome` VARCHAR(30) NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ------------------------------------------------------------
-- Tabela: fornecedores
-- ------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `fornecedores` (
    `id` BIGINT NOT NULL AUTO_INCREMENT,
    `cnpj` CHAR(14) NOT NULL,
    `empresa` VARCHAR(50) NOT NULL,
    `email` VARCHAR(255) NULL,
    `telefone` VARCHAR(14) NULL,
    `endereco` VARCHAR(512) NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ------------------------------------------------------------
-- Tabela: produtos
-- ------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `produtos` (
    `id` BIGINT NOT NULL AUTO_INCREMENT,
    `cod_barras` BIGINT NULL,
    `descricao` VARCHAR(255) NOT NULL,
    `qtd` INT NOT NULL DEFAULT 0,
    `estoque_minimo` INT NOT NULL DEFAULT 0,
    `preco` DECIMAL(12,2) NOT NULL DEFAULT 0.00,
    `id_categoria` BIGINT NULL,
    `id_fornecedor` BIGINT NULL,
    `img_url` VARCHAR(512) NULL,
    PRIMARY KEY (`id`),
    INDEX `idx_produtos_categoria` (`id_categoria`),
    INDEX `idx_produtos_fornecedor` (`id_fornecedor`),
    CONSTRAINT `fk_produtos_categoria` FOREIGN KEY (`id_categoria`) REFERENCES `categorias`(`id`),
    CONSTRAINT `fk_produtos_fornecedor` FOREIGN KEY (`id_fornecedor`) REFERENCES `fornecedores`(`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ------------------------------------------------------------
-- Tabela: usuarios
-- ------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `usuarios` (
    `id` BIGINT NOT NULL AUTO_INCREMENT,
    `cpf` CHAR(11) NOT NULL,
    `nome` VARCHAR(60) NOT NULL,
    `email` VARCHAR(255) NOT NULL,
    `senha` VARCHAR(512) NOT NULL,
    `perfil` ENUM('admin','user') NOT NULL DEFAULT 'user',
    `dt_criacao` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    UNIQUE KEY `uq_usuarios_cpf` (`cpf`),
    UNIQUE KEY `uq_usuarios_email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ------------------------------------------------------------
-- Usuário administrador padrão
-- Email: admin@administrativo.com
-- Senha: Adm1n%26
-- ------------------------------------------------------------
INSERT INTO `usuarios` (`nome`, `cpf`, `email`, `senha`, `perfil`)
SELECT 'Admin', '10000000000', 'admin@administrativo.com',
       '$argon2id$v=19$m=65536,t=4,p=1$UUFTTmkvNEJtT0IwYmI2MA$1DPAnzrVtQiKinv8zm4GYEKRB9MiRHV0XOHT2s+8uoo',
       'admin'
WHERE NOT EXISTS (
    SELECT 1 FROM `usuarios` WHERE `email` = 'admin@administrativo.com'
);