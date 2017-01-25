-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Mer 25 Janvier 2017 à 03:03
-- Version du serveur :  5.6.17
-- Version de PHP :  5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `guestbook`
--

-- --------------------------------------------------------

--
-- Structure de la table `entries`
--

CREATE TABLE IF NOT EXISTS `entries` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `surname` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `date` date NOT NULL,
  `ip` varchar(40) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=148 ;

--
-- Contenu de la table `entries`
--

INSERT INTO `entries` (`id`, `surname`, `name`, `email`, `message`, `date`, `ip`) VALUES
(142, 'azer', 'azer', '', 'azer', '2017-01-25', '::1'),
(143, 'azer', 'azer', '', 'azer', '2017-01-25', '::1'),
(144, 'azer', 'azer', '', 'azer', '2017-01-25', '::1'),
(145, 'azer', 'azer', '', 'azer', '2017-01-25', '::1'),
(146, 'azer', 'azer', '', 'azer', '2017-01-25', '::1'),
(147, 'azer', 'azer', '', 'azer', '2017-01-25', '::1');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
