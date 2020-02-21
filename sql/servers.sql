-- phpMyAdmin SQL Dump
-- version 4.9.2deb1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le :  mer. 12 fév. 2020 à 10:14
-- Version du serveur :  10.3.22-MariaDB-1
-- Version de PHP :  7.3.12-1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `urtservers`
--

-- --------------------------------------------------------

--
-- Structure de la table `servers`
--

CREATE TABLE `servers` (
  `adresse` varchar(32) NOT NULL,
  `name` varchar(256) NOT NULL,
  `cleanname` varchar(256) NOT NULL,
  `version` varchar(11) NOT NULL,
  `gametype` int(11) NOT NULL,
  `map` varchar(256) NOT NULL,
  `nplayers` int(11) NOT NULL,
  `nbots` int(11) NOT NULL,
  `slots` int(11) NOT NULL,
  `privateslots` int(11) NOT NULL,
  `lplayers` text NOT NULL,
  `cleanlplayers` text NOT NULL,
  `lscores` text NOT NULL,
  `date` int(11) NOT NULL,
  `pays` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `servers`
--
ALTER TABLE `servers`
  ADD UNIQUE KEY `adresse` (`adresse`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
