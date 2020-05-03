-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 03, 2020 at 08:04 PM
-- Server version: 10.4.12-MariaDB
-- PHP Version: 7.4.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `confined`
--

-- --------------------------------------------------------

--
-- Table structure for table `file_ref`
--

CREATE TABLE `file_ref` (
  `idcommit` int(11) NOT NULL,
  `h_code` char(32) COLLATE utf8mb4_unicode_ci NOT NULL,
  `author` int(11) NOT NULL,
  `last_colab` int(11) NOT NULL,
  `v` int(11) DEFAULT NULL,
  `date` int(11) NOT NULL DEFAULT current_timestamp(),
  `active` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `file_ref`
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
(384, 'baf53749130be4462e28ea1c44ff50a4', 1, 1, 4, 1587658778, 0),
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
(460, 'd5801ff2e0b45a541979c548425dd5fa', 1, 1, 3, 1588183243, 0),
(461, '5f9d17bce71e1700308178fbee529d8d', 1, 1, 3, 1588185466, 0),
(462, '5f9d17bce71e1700308178fbee529d8d', 1, 1, 4, 1588185514, 0),
(463, '5f9d17bce71e1700308178fbee529d8d', 1, 1, 5, 1588185673, 0),
(464, '5f9d17bce71e1700308178fbee529d8d', 1, 1, 6, 1588185692, 0),
(465, '5f9d17bce71e1700308178fbee529d8d', 1, 1, 7, 1588185712, 0),
(466, '5f9d17bce71e1700308178fbee529d8d', 1, 1, 8, 1588185723, 0),
(467, '5f9d17bce71e1700308178fbee529d8d', 1, 1, 9, 1588185861, 0),
(468, '5f9d17bce71e1700308178fbee529d8d', 1, 1, 10, 1588185892, 0),
(469, '5f9d17bce71e1700308178fbee529d8d', 1, 1, 11, 1588186059, 0),
(470, '5f9d17bce71e1700308178fbee529d8d', 1, 1, 12, 1588186095, 0),
(471, '65988e4dff155fc2422f67dc957f8ee4', 1, 1, 0, 1588240362, 0),
(472, '65988e4dff155fc2422f67dc957f8ee4', 1, 1, 1, 1588240363, 0),
(473, '5f9d17bce71e1700308178fbee529d8d', 1, 1, 0, 1588444497, 0),
(474, '5f9d17bce71e1700308178fbee529d8d', 1, 1, 13, 1588444497, 1),
(475, '65988e4dff155fc2422f67dc957f8ee4', 1, 1, 2, 1588444836, 0),
(476, '1d7a6da480296ac06ceae768d2b53727', 1, 1, 0, 1588445600, 0),
(477, '1d7a6da480296ac06ceae768d2b53727', 1, 1, 1, 1588445600, 1),
(478, 'b0111fb7e79e29994e595b820e1ce691', 1, 1, 0, 1588450021, 0),
(479, 'b0111fb7e79e29994e595b820e1ce691', 1, 1, 1, 1588450021, 0),
(480, 'b0111fb7e79e29994e595b820e1ce691', 1, 1, 2, 1588450097, 0),
(481, 'b0111fb7e79e29994e595b820e1ce691', 1, 1, 3, 1588450239, 0),
(482, 'b0111fb7e79e29994e595b820e1ce691', 1, 1, 4, 1588450255, 0),
(483, 'b0111fb7e79e29994e595b820e1ce691', 1, 1, 5, 1588450304, 0),
(484, 'b0111fb7e79e29994e595b820e1ce691', 1, 1, 6, 1588450362, 0),
(485, 'b0111fb7e79e29994e595b820e1ce691', 1, 1, 7, 1588450681, 0),
(486, 'b0111fb7e79e29994e595b820e1ce691', 1, 1, 8, 1588450907, 0),
(487, 'b0111fb7e79e29994e595b820e1ce691', 1, 1, 9, 1588450962, 0),
(488, 'b0111fb7e79e29994e595b820e1ce691', 1, 1, 10, 1588451132, 0),
(489, 'b0111fb7e79e29994e595b820e1ce691', 1, 1, 11, 1588451275, 0),
(490, 'b0111fb7e79e29994e595b820e1ce691', 1, 1, 12, 1588451377, 0),
(491, 'b0111fb7e79e29994e595b820e1ce691', 1, 1, 13, 1588451423, 0),
(492, 'b0111fb7e79e29994e595b820e1ce691', 1, 1, 14, 1588451667, 0),
(493, 'b0111fb7e79e29994e595b820e1ce691', 1, 1, 15, 1588451689, 0),
(494, 'b0111fb7e79e29994e595b820e1ce691', 1, 1, 16, 1588451738, 0),
(495, 'b0111fb7e79e29994e595b820e1ce691', 1, 1, 17, 1588451905, 0),
(496, 'b0111fb7e79e29994e595b820e1ce691', 1, 1, 18, 1588451995, 0),
(497, 'b0111fb7e79e29994e595b820e1ce691', 1, 1, 19, 1588452166, 0),
(498, 'b0111fb7e79e29994e595b820e1ce691', 1, 1, 20, 1588452244, 0),
(499, 'b0111fb7e79e29994e595b820e1ce691', 1, 1, 21, 1588452403, 0),
(500, 'b0111fb7e79e29994e595b820e1ce691', 1, 1, 22, 1588452929, 1),
(501, '39afa928ffecc62034ee6b04e6db813f', 1, 1, 0, 1588457631, 0),
(502, '39afa928ffecc62034ee6b04e6db813f', 1, 1, 1, 1588457631, 0),
(503, '39afa928ffecc62034ee6b04e6db813f', 1, 1, 2, 1588457650, 0),
(504, '39afa928ffecc62034ee6b04e6db813f', 1, 1, 3, 1588457663, 0),
(505, '39afa928ffecc62034ee6b04e6db813f', 1, 1, 4, 1588457673, 0),
(506, '39afa928ffecc62034ee6b04e6db813f', 1, 1, 5, 1588457680, 0),
(507, '39afa928ffecc62034ee6b04e6db813f', 1, 1, 6, 1588457704, 0),
(508, '39afa928ffecc62034ee6b04e6db813f', 1, 1, 7, 1588457713, 1),
(509, 'd5801ff2e0b45a541979c548425dd5fa', 1, 1, 4, 1588506197, 0),
(510, 'd5801ff2e0b45a541979c548425dd5fa', 1, 1, 5, 1588506225, 1),
(511, '65988e4dff155fc2422f67dc957f8ee4', 1, 1, 3, 1588506334, 1),
(512, 'baf53749130be4462e28ea1c44ff50a4', 1, 1, 5, 1588516135, 1),
(513, '1e2fbac95cfe853af27fe0356b9883e1', 1, 1, 0, 1588533609, 0),
(514, '1e2fbac95cfe853af27fe0356b9883e1', 1, 1, 1, 1588533609, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `file_ref`
--
ALTER TABLE `file_ref`
  ADD PRIMARY KEY (`idcommit`),
  ADD KEY `author` (`author`),
  ADD KEY `last_colab` (`last_colab`),
  ADD KEY `h_code` (`h_code`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `file_ref`
--
ALTER TABLE `file_ref`
  MODIFY `idcommit` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=515;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `file_ref`
--
ALTER TABLE `file_ref`
  ADD CONSTRAINT `file_ref_ibfk_1` FOREIGN KEY (`author`) REFERENCES `user` (`iduser`),
  ADD CONSTRAINT `file_ref_ibfk_2` FOREIGN KEY (`last_colab`) REFERENCES `user` (`iduser`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;