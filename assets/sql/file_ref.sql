-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 20, 2020 at 10:12 PM
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
  MODIFY `idcommit` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

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
