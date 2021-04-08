-- use avII_desenvweb; -- Banco de dados utilizado na disciplina CIT7598
-- Sanvando estados das variáveis do sistema antes da criação das tabelas
/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='-03:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- DUMP TABELAS DO BANCO

-- Excluí as tabelas caso já existam
DROP TABLE IF EXISTS `LINKS`;
DROP TABLE IF EXISTS `USER`;
DROP TABLE IF EXISTS `WEBSITE_SERVICES`;

-- Define o charset padrão para UTF-8 de 4 bytes
/*!40101 SET character_set_client = utf8mb4 */;

-- Criação das tabelas

CREATE TABLE IF NOT EXISTS `LINKS` (
	`idLinks` INT NOT NULL AUTO_INCREMENT,
    `order` INT UNIQUE, -- NOT NULL,
	`name` VARCHAR(64) NOT NULL,
	`url` VARCHAR(2048) NOT NULL,
	`status` BOOLEAN NOT NULL,
	`permanentLink` BOOLEAN NOT NULL,
	`expirationDatetime` DATETIME DEFAULT NULL,
	PRIMARY KEY (`idLinks`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `LINKS` WRITE;
/*!40000 ALTER TABLE `LINKS` DISABLE KEYS */;
INSERT INTO LINKS VALUES (1, 1, 'YouTube', 'https://www.youtube.com/channel/UC6rD7xpvC-YvUtkrP6KhyNA', 1, 1, NULL);
INSERT INTO LINKS VALUES (2, 2, 'Instagram', 'https://www.instagram.com/cursinhopes', 1, 1, NULL);
INSERT INTO LINKS VALUES (3, 3, 'Facebook', 'https://www.facebook.com/cursinhopes', 1, 1, NULL);
INSERT INTO LINKS VALUES (4, 4, 'Twitter', 'https://www.twitter.com/cursinhopes', 1, 1, NULL);
INSERT INTO LINKS VALUES (5, 5, 'LinkedIn', 'https://www.linkedin.com/company/cursinhopes', 1, 1, NULL);
INSERT INTO LINKS VALUES (6, 6, 'Formulário de contato (e-mail)', 'https://pes.ufsc.br/contato', 1, 1, NULL);
INSERT INTO LINKS VALUES (7, 7, 'Desativado', 'https://pes.ufsc.br/desativado', 0, 0, NULL);
INSERT INTO LINKS VALUES (8, 8, 'expirado', 'https://pes.ufsc.br/expirado', 1, 0, '2021/02/21 20:00:00');
INSERT INTO LINKS VALUES (9, 9, 'nao-expirado', 'https://pes.ufsc.br/nao-expirado', 1, 0, '2021/05/01 20:00:00');
/*!40000 ALTER TABLE `LINKS` ENABLE KEYS */;
UNLOCK TABLES;

CREATE TABLE IF NOT EXISTS `USER` (
  `idUser` INT NOT NULL AUTO_INCREMENT,
  `cpf` VARCHAR(11) NOT NULL,
  `email` VARCHAR(128) NOT NULL,
  `username` VARCHAR(32) DEFAULT NULL,
  `passwordHash` VARCHAR(256) NOT NULL,
  `type` ENUM('A', 'G', 'P', 'GP', 'CA', 'CG', 'CP', 'MH', 'ADMIN') NOT NULL,
  `status` BOOLEAN NOT NULL,
  PRIMARY KEY (`idUser`),
  UNIQUE INDEX `IDX_CPF` (`cpf` ASC) VISIBLE,
  UNIQUE INDEX `IDX_EMAIL` (`email` ASC) VISIBLE,
  UNIQUE INDEX `IDX_USERNAME` (`username` ASC) INVISIBLE
  ) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `USER` WRITE;
/*!40000 ALTER TABLE `USER` DISABLE KEYS */;
-- Números de CPFs gerados aleatóriamente para teste no site: https://www.4devs.com.br/gerador_de_cpf
-- Senha padrão utilizada para os testes do sistema: desenv
INSERT INTO `USER` VALUES(1, '73585326943', 'rogerec@pes.ufsc.com.br', 'rogerec', '$2y$10$w8aZ5RCZmg27mbZjedMNee0L3YQTbQDtwLJB/alIlI25cyC1FnyKW', 'ADMIN', 1);
INSERT INTO `USER` VALUES(2, '22273817959', 'aluno@pes.ufsc.com.br', 'aluno', '$2y$10$18ba/nOPOdJNOUyjOF6cRuDiFcowdyuGZbyAnZDY.1qMfBXbBaCti', 'A', 1);
INSERT INTO `USER` VALUES(3, '06854823919', 'gestor@pes.ufsc.com.br', 'gestor', '$2y$10$7uU5kRQjONNPG5MeCMgVwe0pgqQrspKVx2uhhgmvgUB5Fj7vzWSv6', 'G', 1);
INSERT INTO `USER` VALUES(4, '63007954975', 'professor@pes.ufsc.com.br', 'professor', '$2y$10$fPyXxOXe6J1jBi6yULlS0uQJsNzCfV8i.8g0/5fINfumcutGTv.Za', 'P', 1);
INSERT INTO `USER` VALUES(5, '39143316905', 'gestor.professor@pes.ufsc.com.br', 'gestor.professor', '$2y$10$TpYXPRHct8m8iHD/FNusU..hCCRnocwdNa4K/TSt1ydJcDDSYfj/S', 'GP', 1);
INSERT INTO `USER` VALUES(6, '67102128908', 'candidato.aluno@pes.ufsc.com.br', 'candidato.aluno', '$2y$10$vmzzW0AQnmE/3HsE/RvBV.kB/SAulR0ebdZ0T5jPcgKVIdS3Y0xfW', 'CA', 1);
INSERT INTO `USER` VALUES(7, '10261221981', 'candidato.gestor@pes.ufsc.com.br', 'candidato.gestor', '$2y$10$Z9fCb8nDl/CNsvuvbeF2NOe56J7mhPpxShQz1sS4a0gCcRZKPKA8O', 'CG', 1);
INSERT INTO `USER` VALUES(8, '34337198962', 'candidato.professor@pes.ufsc.com.br', 'candidato.professor', '$2y$10$vebVkAHfpjIwEh51cSXa2uYpLQRnD7IUM3HSnvKTtc44zAdBih3FG', 'CP', 1);
INSERT INTO `USER` VALUES(9, '57953543923', 'user@pes.ufsc.com.br', 'user', '$2y$10$G4M/HKuYuqim9cyvrscieea4869o8QmKqtM62vcd6VMkn1DCSzWGu', 'A', 1);
INSERT INTO `USER` VALUES(10, '77065100936', 'admin@pes.ufsc.com.br', 'admin', '$2y$10$NJn5b9sFWUQpV1rAn3KgzOjTROhJi3NiMU4TvsxiPdjtuN02mUDjS', 'ADMIN', 1);
INSERT INTO `USER` VALUES(11, '50802678017', 'membro.honorario@pes.ufsc.com.br', 'membro.honorario', '$2y$10$7uU5kRQjONNPG5MeCMgVwe0pgqQrspKVx2uhhgmvgUB5Fj7vzWSv6', 'MH', 1);
/*!40000 ALTER TABLE `USER` ENABLE KEYS */;
UNLOCK TABLES;

CREATE TABLE IF NOT EXISTS `WEBSITE_SERVICES` (
	`idWebsiteServices` INT NOT NULL AUTO_INCREMENT,
    `order` INT UNIQUE NOT NULL,
	`name` VARCHAR(64) NOT NULL,
	`url` VARCHAR(2048) NOT NULL,
	`status` BOOLEAN NOT NULL,
    `ADMIN` ENUM('all', 'none', 'read', 'write') NOT NULL DEFAULT 'all',
    `G` ENUM('all', 'none', 'read', 'write') NOT NULL,
    `GP` ENUM('all', 'none', 'read', 'write') NOT NULL,
    `P` ENUM('all', 'none', 'read', 'write') NOT NULL,
    `A` ENUM('all', 'none', 'read', 'write') NOT NULL,
    `CA` ENUM('all', 'none', 'read', 'write') NOT NULL,
    `CG` ENUM('all', 'none', 'read', 'write') NOT NULL,
    `CP` ENUM('all', 'none', 'read', 'write') NOT NULL,
    `MH` ENUM('all', 'none', 'read', 'write') NOT NULL,
	PRIMARY KEY (`idWebsiteServices`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `WEBSITE_SERVICES` WRITE;
/*!40000 ALTER TABLE `WEBSITE_SERVICES` DISABLE KEYS */;
-- INSERT INTO WEBSITE_SERVICES VALUES (1, 1, 'Editar Serviços', '/area-51/administrador/servicos', 'all', 'none', 'none', 'none', 'none', 'none', 'none', 'none',  'none');
-- INSERT INTO WEBSITE_SERVICES VALUES (2, 2, 'Editar Links', '/usuario/gestor/links', 'all', 'all', 'all', 'none', 'none', 'none', 'none', 'none',  'none');
/*!40000 ALTER TABLE `WEBSITE_SERVICES` ENABLE KEYS */;
UNLOCK TABLES;

-- Restaura as variáveis originais do sistema
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;