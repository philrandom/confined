-- phpMyAdmin SQL Dump
-- version 4.5.4.1
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Sam 02 Mai 2020 à 18:57
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
-- Structure de la table `file_ref`
--

CREATE TABLE `file_ref` (
  `idcommit` int(11) NOT NULL,
  `h_code` char(32) COLLATE utf8mb4_unicode_ci NOT NULL,
  `author` int(11) NOT NULL,
  `last_colab` int(11) NOT NULL,
  `v` int(11) DEFAULT NULL,
  `date` int(11) NOT NULL,
  `active` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Contenu de la table `file_ref`
--

INSERT INTO `file_ref` (`idcommit`, `h_code`, `author`, `last_colab`, `v`, `date`, `active`) VALUES
(373, 'baf53749130be4462e28ea1c44ff50a4', 1, 1, 0, 1587654555, 0),
(374, '8ed51d75d939230a36e6807a99ced311', 1, 1, 0, 1587654963, 0),
(375, 'dc26841699637b8f24918c6704631a64', 1, 1, 0, 1587655465, 0),
(376, '04afca4b44ab63a0c59f70d9688c5fd4', 1, 1, 0, 1587655618, 0),
(377, '8827d30c10753ada421855122c1867b0', 1, 1, 0, 1587655722, 0),
(378, 'e36acadcc3d6998646f895d435d7c8f0', 1, 1, 0, 1587655980, 0),
(379, 'e36acadcc3d6998646f895d435d7c8f0', 1, 1, 1, 1587657847, 0),
(380, 'e36acadcc3d6998646f895d435d7c8f0', 1, 1, 2, 1587658394, 1),
(381, 'baf53749130be4462e28ea1c44ff50a4', 1, 1, 1, 1587658483, 0),
(382, 'baf53749130be4462e28ea1c44ff50a4', 1, 1, 2, 1587658569, 0),
(383, 'baf53749130be4462e28ea1c44ff50a4', 1, 1, 3, 1587658741, 0),
(384, 'baf53749130be4462e28ea1c44ff50a4', 1, 1, 4, 1587658778, 1),
(385, '8827d30c10753ada421855122c1867b0', 1, 1, 1, 1587666940, 1),
(386, 'dc26841699637b8f24918c6704631a64', 1, 1, 1, 1587672980, 1),
(387, '8ed51d75d939230a36e6807a99ced311', 1, 1, 1, 1587673253, 0),
(388, '04afca4b44ab63a0c59f70d9688c5fd4', 1, 1, 1, 1587673324, 1),
(393, '8ed51d75d939230a36e6807a99ced311', 1, 1, 2, 1587674066, 0),
(400, '2ba3b5351e03d420ba8af716cc20a6e2', 1, 1, 0, 1587676166, 0),
(401, '2ba3b5351e03d420ba8af716cc20a6e2', 1, 1, 1, 1587676167, 0),
(402, '2ba3b5351e03d420ba8af716cc20a6e2', 1, 1, 2, 1587826665, 0),
(403, '8ed51d75d939230a36e6807a99ced311', 1, 1, 3, 1587976858, 1),
(412, '2ba3b5351e03d420ba8af716cc20a6e2', 1, 1, 3, 1587989257, 1),
(419, '5fc988d646d659571fcd145f21f7fe7d', 1, 1, 0, 1587989424, 0),
(420, '5fc988d646d659571fcd145f21f7fe7d', 1, 1, 1, 1587989424, 0),
(423, '5f9d17bce71e1700308178fbee529d8d', 1, 1, 0, 1587990068, 0),
(424, '5f9d17bce71e1700308178fbee529d8d', 1, 1, 1, 1587990068, 0),
(425, '282c6b88c417597f3a868b9b1d05b9ce', 1, 1, 0, 1587990105, 0),
(426, '282c6b88c417597f3a868b9b1d05b9ce', 1, 1, 1, 1587990105, 0),
(427, '5fc988d646d659571fcd145f21f7fe7d', 1, 1, 0, 1587990131, 0),
(428, '5fc988d646d659571fcd145f21f7fe7d', 1, 1, 2, 1587990131, 1),
(429, '282c6b88c417597f3a868b9b1d05b9ce', 1, 1, 2, 1587993454, 1),
(430, '5f9d17bce71e1700308178fbee529d8d', 1, 1, 2, 1587993537, 0),
(431, '44ea542321a6489aebd9418208f4ce1f', 1, 1, 0, 1588174788, 0),
(432, '44ea542321a6489aebd9418208f4ce1f', 1, 1, 1, 1588174788, 0),
(433, '44ea542321a6489aebd9418208f4ce1f', 1, 1, 2, 1588174824, 0),
(434, '44ea542321a6489aebd9418208f4ce1f', 1, 1, 3, 1588174875, 0),
(435, '44ea542321a6489aebd9418208f4ce1f', 1, 1, 4, 1588174935, 0),
(436, '44ea542321a6489aebd9418208f4ce1f', 1, 1, 5, 1588175013, 0),
(437, '44ea542321a6489aebd9418208f4ce1f', 1, 1, 6, 1588175069, 0),
(438, '44ea542321a6489aebd9418208f4ce1f', 1, 1, 7, 1588175136, 0),
(439, '44ea542321a6489aebd9418208f4ce1f', 1, 1, 8, 1588175328, 0),
(440, '44ea542321a6489aebd9418208f4ce1f', 1, 1, 9, 1588175409, 0),
(441, '44ea542321a6489aebd9418208f4ce1f', 1, 1, 10, 1588175456, 0),
(442, '44ea542321a6489aebd9418208f4ce1f', 1, 1, 11, 1588175489, 0),
(443, '44ea542321a6489aebd9418208f4ce1f', 1, 1, 12, 1588175541, 0),
(444, '44ea542321a6489aebd9418208f4ce1f', 1, 1, 13, 1588175769, 0),
(445, '44ea542321a6489aebd9418208f4ce1f', 1, 1, 14, 1588175977, 0),
(446, '44ea542321a6489aebd9418208f4ce1f', 1, 1, 15, 1588176015, 0),
(447, '44ea542321a6489aebd9418208f4ce1f', 1, 1, 16, 1588176054, 0),
(448, '44ea542321a6489aebd9418208f4ce1f', 1, 1, 17, 1588176192, 0),
(449, '44ea542321a6489aebd9418208f4ce1f', 1, 1, 18, 1588176221, 0),
(450, '44ea542321a6489aebd9418208f4ce1f', 1, 1, 19, 1588176300, 0),
(451, '44ea542321a6489aebd9418208f4ce1f', 1, 1, 20, 1588176490, 0),
(452, '44ea542321a6489aebd9418208f4ce1f', 1, 1, 21, 1588176656, 0),
(453, '44ea542321a6489aebd9418208f4ce1f', 1, 1, 22, 1588176707, 0),
(454, '44ea542321a6489aebd9418208f4ce1f', 1, 1, 23, 1588176735, 0),
(455, 'd5801ff2e0b45a541979c548425dd5fa', 1, 1, 0, 1588176858, 0),
(456, 'd5801ff2e0b45a541979c548425dd5fa', 1, 1, 1, 1588176858, 0),
(457, 'd5801ff2e0b45a541979c548425dd5fa', 1, 1, 2, 1588176888, 0),
(458, '44ea542321a6489aebd9418208f4ce1f', 1, 1, 24, 1588176908, 0),
(459, '44ea542321a6489aebd9418208f4ce1f', 1, 1, 25, 1588183161, 1),
(460, 'd5801ff2e0b45a541979c548425dd5fa', 1, 1, 3, 1588183243, 1),
(461, '5f9d17bce71e1700308178fbee529d8d', 1, 1, 3, 1588185466, 0),
(462, '5f9d17bce71e1700308178fbee529d8d', 1, 1, 4, 1588185514, 0),
(463, '5f9d17bce71e1700308178fbee529d8d', 1, 1, 5, 1588185673, 0),
(464, '5f9d17bce71e1700308178fbee529d8d', 1, 1, 6, 1588185692, 0),
(465, '5f9d17bce71e1700308178fbee529d8d', 1, 1, 7, 1588185712, 0),
(466, '5f9d17bce71e1700308178fbee529d8d', 1, 1, 8, 1588185723, 0),
(467, '5f9d17bce71e1700308178fbee529d8d', 1, 1, 9, 1588185861, 0),
(468, '5f9d17bce71e1700308178fbee529d8d', 1, 1, 10, 1588185892, 0),
(469, '5f9d17bce71e1700308178fbee529d8d', 1, 1, 11, 1588186059, 0),
(470, '5f9d17bce71e1700308178fbee529d8d', 1, 1, 12, 1588186095, 1);

-- --------------------------------------------------------

--
-- Structure de la table `tag`
--

CREATE TABLE `tag` (
  `h_code` char(32) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tag` char(20) COLLATE utf8mb4_unicode_ci NOT NULL,
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
('5f9d17bce71e1700308178fbee529d8d', 'OS', 0),
('5f9d17bce71e1700308178fbee529d8d', 'linux', 1),
('282c6b88c417597f3a868b9b1d05b9ce', 'OS', 0),
('282c6b88c417597f3a868b9b1d05b9ce', 'bsd', 1),
('5fc988d646d659571fcd145f21f7fe7d', 'OS', 0),
('5fc988d646d659571fcd145f21f7fe7d', 'bsd', 1),
('5fc988d646d659571fcd145f21f7fe7d', 'macOS', 2),
('44ea542321a6489aebd9418208f4ce1f', 'java', 0),
('44ea542321a6489aebd9418208f4ce1f', 'memory', 1),
('44ea542321a6489aebd9418208f4ce1f', 'file', 2),
('d5801ff2e0b45a541979c548425dd5fa', 'java', 0),
('d5801ff2e0b45a541979c548425dd5fa', 'class', 1);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `iduser` int(11) NOT NULL,
  `user` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `mail` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `pass` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo` text COLLATE utf8mb4_unicode_ci,
  `type` char(10) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Contenu de la table `user`
--

INSERT INTO `user` (`iduser`, `user`, `mail`, `pass`, `photo`, `type`) VALUES
(1, 'phil', 'kphil@pm.me', 'pass', NULL, 'prof'),
(2, 'tom', 'tom.boumba7@gmail.com', 'pass', 'NULL', 'eleve'),
(3, 'tomprof', 'boumbatom76@gmail.com', 'pass', NULL, 'prof'),
(4, 'test', 'reza@gmail.com', 'pass', NULL, 'eleve'),
(5, 'test2', 'azer@gmail.com', 'pass', NULL, 'eleve'),
(6, 'test2', 'azer@gmail.com', 'pass', NULL, 'eleve'),
(7, 'test2', 'azer@gmail.com', 'pass', NULL, 'eleve'),
(8, 'test', 'geza', 'pass', NULL, 'eleve'),
(9, 'test', 'geza', 'pass', NULL, 'eleve'),
(10, 'test', 'geza', 'pass', NULL, 'eleve'),
(11, 'qsdf', 'heza', 'pass', NULL, 'eleve'),
(12, 'geza', 'geza', 'pass', NULL, 'eleve');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `file_ref`
--
ALTER TABLE `file_ref`
  ADD PRIMARY KEY (`idcommit`),
  ADD KEY `author` (`author`),
  ADD KEY `last_colab` (`last_colab`),
  ADD KEY `h_code` (`h_code`);

--
-- Index pour la table `tag`
--
ALTER TABLE `tag`
  ADD KEY `h_code` (`h_code`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`iduser`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `file_ref`
--
ALTER TABLE `file_ref`
  MODIFY `idcommit` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=471;
--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `iduser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `file_ref`
--
ALTER TABLE `file_ref`
  ADD CONSTRAINT `file_ref_ibfk_1` FOREIGN KEY (`author`) REFERENCES `user` (`iduser`),
  ADD CONSTRAINT `file_ref_ibfk_2` FOREIGN KEY (`last_colab`) REFERENCES `user` (`iduser`);

--
-- Contraintes pour la table `tag`
--
ALTER TABLE `tag`
  ADD CONSTRAINT `tag_ibfk_1` FOREIGN KEY (`h_code`) REFERENCES `file_ref` (`h_code`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
