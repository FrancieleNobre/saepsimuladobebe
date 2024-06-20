-- MySQL Administrator dump 1.4
--
-- ------------------------------------------------------
-- Server version	5.5.5-10.4.32-MariaDB


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


--
-- Create schema saep
--

CREATE DATABASE IF NOT EXISTS saep;
USE saep;

--
-- Definition of table `atividade`
--

DROP TABLE IF EXISTS `atividade`;
CREATE TABLE `atividade` (
  `idatividade` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `idturma` int(10) unsigned NOT NULL,
  `nome` varchar(30) NOT NULL,
  `cadastro` datetime DEFAULT current_timestamp(),
  `ativo` char(1) DEFAULT 'A',
  `alteracao` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`idatividade`,`idturma`),
  KEY `fk_idatividade_idturma` (`idturma`),
  CONSTRAINT `fk_idatividade_idturma` FOREIGN KEY (`idturma`) REFERENCES `turma` (`idturma`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `atividade`
--

/*!40000 ALTER TABLE `atividade` DISABLE KEYS */;
/*!40000 ALTER TABLE `atividade` ENABLE KEYS */;


--
-- Definition of table `aula`
--

DROP TABLE IF EXISTS `aula`;
CREATE TABLE `aula` (
  `idaula` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `idprofessor` int(10) unsigned NOT NULL,
  `idturma` int(10) unsigned NOT NULL,
  `cadastro` datetime DEFAULT current_timestamp(),
  `ativo` char(1) DEFAULT 'A',
  `alteracao` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`idaula`),
  KEY `fk_aula_professor` (`idprofessor`),
  KEY `fk_aula_turma` (`idturma`),
  CONSTRAINT `fk_aula_professor` FOREIGN KEY (`idprofessor`) REFERENCES `professor` (`idprofessor`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_aula_turma` FOREIGN KEY (`idturma`) REFERENCES `turma` (`idturma`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `aula`
--

/*!40000 ALTER TABLE `aula` DISABLE KEYS */;
/*!40000 ALTER TABLE `aula` ENABLE KEYS */;


--
-- Definition of table `professor`
--

DROP TABLE IF EXISTS `professor`;
CREATE TABLE `professor` (
  `idprofessor` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) NOT NULL,
  `email` varchar(255) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `cadastro` datetime DEFAULT current_timestamp(),
  `ativo` char(1) DEFAULT 'A',
  `alteracao` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`idprofessor`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `professor`
--

/*!40000 ALTER TABLE `professor` DISABLE KEYS */;
INSERT INTO `professor` (`idprofessor`,`nome`,`email`,`senha`,`cadastro`,`ativo`,`alteracao`) VALUES 
 (1,'Franciele','franciele@gmail.com','$2y$12$/TxLXKPiHyHuNRWTvdANceQ7/TaCtzeaFjRkhml/lE7ohTyqTVbme','2024-06-19 20:57:52','A','2024-06-19 20:58:18');
/*!40000 ALTER TABLE `professor` ENABLE KEYS */;


--
-- Definition of table `turma`
--

DROP TABLE IF EXISTS `turma`;
CREATE TABLE `turma` (
  `idturma` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(30) NOT NULL,
  `cadastro` datetime DEFAULT current_timestamp(),
  `ativo` char(1) DEFAULT 'A',
  `alteracao` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`idturma`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `turma`
--

/*!40000 ALTER TABLE `turma` DISABLE KEYS */;
INSERT INTO `turma` (`idturma`,`nome`,`cadastro`,`ativo`,`alteracao`) VALUES 
 (2,' 1002 Segurança do trabalho','2024-06-19 21:15:21','A','2024-06-19 21:16:15'),
 (3,'1003 Eletrotécnica','2024-06-19 21:15:27','A','2024-06-19 21:16:15'),
 (4,'2001-Investigador Forense','2024-06-19 21:22:35','A','2024-06-19 21:22:35');
/*!40000 ALTER TABLE `turma` ENABLE KEYS */;




/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
