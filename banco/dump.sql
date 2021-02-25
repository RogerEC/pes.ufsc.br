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

-- Define o charset padrão para UTF-8 de 4 bytes
/*!40101 SET character_set_client = utf8mb4 */;

-- Criação das tabelas

CREATE TABLE IF NOT EXISTS `LINKS` (
	`ID_LINKS` INT NOT NULL AUTO_INCREMENT,
    `ORDER` INT UNIQUE NOT NULL,
	`NAME` VARCHAR(64) NOT NULL,
	`URL` VARCHAR(2048) NOT NULL,
	`STATUS` BOOLEAN NOT NULL,
	`PERMANENT_LINK` BOOLEAN NOT NULL,
	`EXPIRATION_DATETIME` DATETIME DEFAULT NULL,
	PRIMARY KEY (`ID_LINKS`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `LINKS` WRITE;
/*!40000 ALTER TABLE `LINKS` DISABLE KEYS */;
-- Incluir inserts aqui
/*!40000 ALTER TABLE `LINKS` ENABLE KEYS */;
UNLOCK TABLES;

CREATE TABLE IF NOT EXISTS `USER` (
  `ID_USER` INT NOT NULL AUTO_INCREMENT,
  `CPF` VARCHAR(11) NOT NULL,
  `EMAIL` VARCHAR(128) NOT NULL,
  `USERNAME` VARCHAR(32) DEFAULT NULL,
  `PASSWORD_HASH` VARCHAR(256) NOT NULL,
  `TYPE` ENUM('A', 'G', 'P', 'GP', 'CA', 'CV') NOT NULL,
  `STATUS` BOOLEAN NOT NULL,
  PRIMARY KEY (`ID_USER`),
  UNIQUE INDEX `IDX_CPF` (`CPF` ASC) VISIBLE,
  UNIQUE INDEX `IDX_EMAIL` (`EMAIL` ASC) VISIBLE,
  UNIQUE INDEX `IDX_USERNAME` (`USERNAME` ASC) INVISIBLE
  ) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `USER` WRITE;
/*!40000 ALTER TABLE `USER` DISABLE KEYS */;
-- INSERT INTO `USER`(`ID_USER`, `CPF`, `EMAIL`, `PASSWORD_HASH`, `TYPE`, `STATUS`) VALUES(3, '11122243334', 'roger4@roger.com', 'hash', 'G', 9);
/*!40000 ALTER TABLE `USER` ENABLE KEYS */;
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