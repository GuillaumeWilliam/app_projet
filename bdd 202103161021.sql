-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 16, 2021 at 10:21 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bdd`
--

-- --------------------------------------------------------

--
-- Table structure for table `langues`
--

CREATE TABLE `langues` (
  `id` int(11) NOT NULL,
  `libelle` varchar(50) NOT NULL,
  `drapeau` varchar(50) NOT NULL,
  `created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `langues`
--

INSERT INTO `langues` (`id`, `libelle`, `drapeau`, `created`) VALUES
(1, 'français', 'fr.png', '2021-03-10 13:26:33'),
(2, 'anglais', 'en.png', '2021-03-10 13:26:33'),
(3, 'espagnol', 'es.png', '2021-03-15 14:56:13');

-- --------------------------------------------------------

--
-- Table structure for table `personne`
--

CREATE TABLE `personne` (
  `id_p` int(11) NOT NULL,
  `nom` varchar(20) NOT NULL,
  `prenom` varchar(20) NOT NULL,
  `age` int(11) NOT NULL,
  `telephone` varchar(15) NOT NULL,
  `email` varchar(50) NOT NULL,
  `image` varchar(50) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `created` timestamp NOT NULL DEFAULT current_timestamp(),
  `id_langue` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `personne`
--

INSERT INTO `personne` (`id_p`, `nom`, `prenom`, `age`, `telephone`, `email`, `image`, `description`, `created`, `id_langue`) VALUES
(13, 'Dupond', 'Jean', 42, '00 00 00 00 00', 'dupond.jean@gmail.com', 'dupond.jpg', 'sjjhb fds', '2021-03-15 08:14:13', 2),
(14, 'Peter', 'Jean', 42, '00 00 00 00 00', 'peter.donald@gmail.com', 'peter.jpg', 'lkjhdhvfed', '2021-03-15 08:30:28', 2),
(16, 'Thomas', 'Simon', 42, '00 00 00 00 00', 'thomsasimon@gmail.com', 'thomas.jpg', 'frf reg e elkk r r', '2021-03-15 15:05:43', 1),
(17, 'Fichiers', 'Jean', 55, '00 00 00 00 00', 'jeanfichiers@live.fr', 'jeanf.jpg', 'dew wefwe fwef wef', '2021-03-15 15:06:44', 2);

-- --------------------------------------------------------

--
-- Table structure for table `utilisateurs`
--

CREATE TABLE `utilisateurs` (
  `id` int(11) NOT NULL,
  `login` varchar(50) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `role` int(11) NOT NULL,
  `created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `utilisateurs`
--

INSERT INTO `utilisateurs` (`id`, `login`, `pass`, `role`, `created`) VALUES
(1, 'admin', '202cb962ac59075b964b07152d234b70', 1, '2021-03-10 13:30:41'),
(2, 'user', 'ee11cbb19052e40b07aac0ca060c23ee', 2, '2021-03-10 13:32:15'),
(3, 'admin', '202cb962ac59075b964b07152d234b70', 2, '2021-03-15 13:51:13');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `langues`
--
ALTER TABLE `langues`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personne`
--
ALTER TABLE `personne`
  ADD PRIMARY KEY (`id_p`),
  ADD KEY `fk` (`id_langue`);

--
-- Indexes for table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `langues`
--
ALTER TABLE `langues`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `personne`
--
ALTER TABLE `personne`
  MODIFY `id_p` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `personne`
--
ALTER TABLE `personne`
  ADD CONSTRAINT `fk` FOREIGN KEY (`id_langue`) REFERENCES `langues` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
