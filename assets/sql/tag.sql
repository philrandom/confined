-- phpMyAdmin SQL Dump
-- version 4.5.4.1
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Mar 23 Juin 2020 à 12:23
-- Version du serveur :  5.7.11
-- Version de PHP :  7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `confined`
--

-- --------------------------------------------------------

--
-- Structure de la table `tag`
--

CREATE TABLE `tag` (
  `h_code` char(32) CHARACTER SET latin1 NOT NULL,
  `tag` char(20) CHARACTER SET latin1 NOT NULL,
  `weight` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Contenu de la table `tag`
--

INSERT INTO `tag` (`h_code`, `tag`, `weight`) VALUES
('baf53749130be4462e28ea1c44ff50a4', 'mammifere', 0),
('baf53749130be4462e28ea1c44ff50a4', 'rongeur', 1),
('baf53749130be4462e28ea1c44ff50a4', 'rat', 2),
('8ed51d75d939230a36e6807a99ced311', 'mammifere', 0),
('8ed51d75d939230a36e6807a99ced311', 'rongeur', 1),
('8ed51d75d939230a36e6807a99ced311', 'lapin', 2),
('dc26841699637b8f24918c6704631a64', 'mammifere', 0),
('dc26841699637b8f24918c6704631a64', 'rongeur', 1),
('dc26841699637b8f24918c6704631a64', 'ecureuil', 2),
('04afca4b44ab63a0c59f70d9688c5fd4', 'mammifere', 0),
('04afca4b44ab63a0c59f70d9688c5fd4', 'rongeur', 1),
('04afca4b44ab63a0c59f70d9688c5fd4', 'octodon', 2),
('8827d30c10753ada421855122c1867b0', 'mammifere', 0),
('8827d30c10753ada421855122c1867b0', 'rongeur', 1),
('8827d30c10753ada421855122c1867b0', 'campagnol', 2),
('e36acadcc3d6998646f895d435d7c8f0', 'mammifere', 0),
('e36acadcc3d6998646f895d435d7c8f0', 'rongeur', 1),
('e36acadcc3d6998646f895d435d7c8f0', 'lievre', 2),
('2ba3b5351e03d420ba8af716cc20a6e2', 'mammifere', 0),
('2ba3b5351e03d420ba8af716cc20a6e2', 'rongeur', 1),
('282c6b88c417597f3a868b9b1d05b9ce', 'OS', 0),
('282c6b88c417597f3a868b9b1d05b9ce', 'bsd', 1),
('5fc988d646d659571fcd145f21f7fe7d', 'OS', 0),
('5fc988d646d659571fcd145f21f7fe7d', 'bsd', 1),
('5fc988d646d659571fcd145f21f7fe7d', 'macOS', 2),
('44ea542321a6489aebd9418208f4ce1f', 'java', 0),
('44ea542321a6489aebd9418208f4ce1f', 'memory', 1),
('44ea542321a6489aebd9418208f4ce1f', 'file', 2),
('d5801ff2e0b45a541979c548425dd5fa', 'java', 0),
('d5801ff2e0b45a541979c548425dd5fa', 'class', 1),
('65988e4dff155fc2422f67dc957f8ee4', 'OS', 0),
('65988e4dff155fc2422f67dc957f8ee4', 'linux', 1),
('65988e4dff155fc2422f67dc957f8ee4', 'file', 2),
('1e2fbac95cfe853af27fe0356b9883e1', 'maths', 0),
('1e2fbac95cfe853af27fe0356b9883e1', 'analyse', 1),
('02957a4d4493c35e49c6886674285db8', 'OS', 0),
('02957a4d4493c35e49c6886674285db8', 'linux', 1),
('02957a4d4493c35e49c6886674285db8', 'sudo', 2),
('5f9d17bce71e1700308178fbee529d8d', 'OS', 0),
('5f9d17bce71e1700308178fbee529d8d', 'linux', 1),
('b0f7312f1039c527f5194926b56b4456', 'maths', 0),
('5b51f0917b6b643962f7fb34df323a76', 'mammifere', 0),
('c5cd6baf98d0b79787264cf81112835b', 'OS', 0),
('2437d2db30a64f562789eed288ab483f', 'java', 0),
('405cc806525d338557852b69e86a3d82', 'java', 0),
('405cc806525d338557852b69e86a3d82', 'memory', 1),
('686f0a2a19da5ea94eb374217f91c0ef', 'painting', 0);

--
-- Index pour les tables exportées
--

--
-- Index pour la table `tag`
--
ALTER TABLE `tag`
  ADD KEY `h_code` (`h_code`);

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `tag`
--
ALTER TABLE `tag`
  ADD CONSTRAINT `tag_ibfk_1` FOREIGN KEY (`h_code`) REFERENCES `file_ref` (`h_code`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
