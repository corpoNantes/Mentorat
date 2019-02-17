-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  Dim 17 fév. 2019 à 22:29
-- Version du serveur :  5.7.23
-- Version de PHP :  7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `mentorat`
--

-- --------------------------------------------------------

--
-- Structure de la table `externes`
--

DROP TABLE IF EXISTS `externes`;
CREATE TABLE IF NOT EXISTS `externes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varbinary(255) NOT NULL,
  `prenom` varbinary(255) NOT NULL,
  `email` varbinary(255) NOT NULL,
  `tel` char(10) NOT NULL,
  `numeroEtudiant` char(8) NOT NULL,
  `spe` tinyint(4) NOT NULL,
  `ID_interne` tinyint(4) DEFAULT NULL,
  `dispoNantes` tinyint(1) NOT NULL,
  `tempsMentorat` tinyint(4) NOT NULL,
  `typeContactRencontre` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `internes`
--

DROP TABLE IF EXISTS `internes`;
CREATE TABLE IF NOT EXISTS `internes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varbinary(255) NOT NULL,
  `prenom` varbinary(255) NOT NULL,
  `email` varbinary(255) NOT NULL,
  `tel` char(10) NOT NULL,
  `numeroEtudiant` char(8) NOT NULL,
  `spe` tinyint(4) NOT NULL,
  `nbrFilleuls` tinyint(4) NOT NULL,
  `commentaire` text,
  `Filleul` int(11) NOT NULL DEFAULT '0',
  `tempsMentorat` int(11) NOT NULL,
  `dispoNantes` tinyint(1) NOT NULL,
  `typeContactRencontre` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `specialites`
--

DROP TABLE IF EXISTS `specialites`;
CREATE TABLE IF NOT EXISTS `specialites` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `spe` text COLLATE utf8_unicode_ci NOT NULL,
  `InternesP` tinyint(1) NOT NULL DEFAULT '0',
  `InternesD` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=46 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `specialites`
--

INSERT INTO `specialites` (`id`, `spe`, `InternesP`, `InternesD`) VALUES
(1, 'Allergologie', 0, 0),
(2, 'Anesthésie-Réanimation', 0, 0),
(3, 'Anatomie et Cytologie pathologiques', 0, 0),
(4, 'Biologie médicale', 0, 0),
(5, 'Chirurgie Maxillo-Faciale', 0, 0),
(6, 'Chirurgie Orale', 0, 0),
(7, 'Chirurgie Orthopédique et traumatologique', 0, 0),
(8, 'Chirurgie Pédiatrique', 0, 0),
(9, 'Chirurgie plastique, reconstructrice et esthétique', 0, 0),
(10, 'Chirurgie Thoracique et Cardio-Vasculaire', 0, 0),
(11, 'Chirurgie Vasculaire', 0, 0),
(12, 'Chirurgie Viscérale et Digestive', 0, 0),
(13, 'Dermatologie – Vénérologie', 0, 0),
(14, 'Endocrinologie, diabétologie et nutrition', 0, 0),
(15, 'Génétique médicale', 0, 0),
(16, 'Gériatrie', 0, 0),
(17, 'Gynécologie médicale', 0, 0),
(18, 'Gynécologie – Obstétrique', 0, 0),
(19, 'Hématologie', 0, 0),
(20, 'Hépato-gastro-entérologie', 0, 0),
(21, 'Maladies Infectieuses et Tropicales', 0, 0),
(22, 'Médecine Cardiovasculaire', 0, 0),
(23, 'Médecine Générale', 0, 0),
(24, 'Médecine Intensive-Réanimation', 0, 0),
(25, 'Médecine Interne et Immunologie clinique', 0, 0),
(26, 'Médecine Légale et expertise médicale', 0, 0),
(27, 'Médecine Nucléaire', 0, 0),
(28, 'Médecine Physique et Réadaptation', 0, 0),
(29, 'Médecine et Santé au Travail', 0, 0),
(30, 'Médecine Vasculaire', 0, 0),
(31, 'Médecine d’Urgence', 0, 0),
(32, 'Néphrologie', 0, 0),
(33, 'Neurochirurgie', 0, 0),
(34, 'Neurologie', 0, 0),
(35, 'Oncologie : Option précoce – Oncologie Médicale', 0, 0),
(36, 'Oncologie : Option précoce – Radiothérapie', 0, 0),
(37, 'Ophtalmologie', 0, 0),
(38, 'Oto-rhino-laryngologie et chirurgie cervico-faciale', 0, 0),
(39, 'Pédiatrie', 0, 0),
(40, 'Pneumologie', 0, 0),
(41, 'Psychiatrie', 0, 0),
(42, 'Radiologie et Imagerie Médicale', 0, 0),
(43, 'Rhumatologie', 0, 0),
(44, 'Santé publique', 0, 0),
(45, 'Urologie', 0, 0);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
