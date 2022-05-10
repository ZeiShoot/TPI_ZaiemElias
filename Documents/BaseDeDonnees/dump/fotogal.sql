-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : lun. 09 mai 2022 à 20:00
-- Version du serveur :  5.7.33
-- Version de PHP : 7.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `fotogal`
--

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

CREATE TABLE `categories` (
  `idCategorie` int(11) NOT NULL,
  `nom` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `categories`
--

INSERT INTO `categories` (`idCategorie`, `nom`) VALUES
(1, 'Moto'),
(2, 'Voiture'),
(3, 'Animé');

-- --------------------------------------------------------

--
-- Structure de la table `like_unlike`
--

CREATE TABLE `like_unlike` (
  `idLikeUnlike` int(11) NOT NULL,
  `like` tinyint(4) NOT NULL,
  `date` datetime NOT NULL,
  `utilisateurs_idUser` int(11) NOT NULL,
  `production_idProduction` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `like_unlike`
--

INSERT INTO `like_unlike` (`idLikeUnlike`, `like`, `date`, `utilisateurs_idUser`, `production_idProduction`) VALUES
(10, 1, '2022-05-09 19:58:54', 2, 3);

-- --------------------------------------------------------

--
-- Structure de la table `productions`
--

CREATE TABLE `productions` (
  `idProduction` int(11) NOT NULL,
  `titre` varchar(45) NOT NULL,
  `description` varchar(255) NOT NULL,
  `date_soumission` datetime NOT NULL,
  `date_modification` datetime NOT NULL,
  `filename` varchar(255) NOT NULL,
  `categories_idCategorie` int(11) NOT NULL,
  `utilisateurs_idUser` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `productions`
--

INSERT INTO `productions` (`idProduction`, `titre`, `description`, `date_soumission`, `date_modification`, `filename`, `categories_idCategorie`, `utilisateurs_idUser`) VALUES
(3, 'hoho', 'hehe', '2022-05-09 18:56:01', '2022-05-09 18:56:01', 'xgpxdgkaonvpbhjzbhdrrhhnxm.png', 1, 2);

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

CREATE TABLE `utilisateurs` (
  `idUser` int(11) NOT NULL,
  `UserName` varchar(45) NOT NULL,
  `FirstName` varchar(100) NOT NULL,
  `LastName` varchar(100) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `PasswordChiffrer` varchar(255) NOT NULL,
  `isAdmin` tinyint(1) DEFAULT NULL COMMENT '1 = utilisateur, 2 = admin'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`idUser`, `UserName`, `FirstName`, `LastName`, `Email`, `PasswordChiffrer`, `isAdmin`) VALUES
(1, 'Leo Sama', 'Leo', 'Montagna', 'leo.mntgn@eduge.ch', '8185c8ac4656219f4aa5541915079f7b3743e1b5f48bacfcc3386af016b55320', 1),
(2, 'ZeiShoot', 'Elias', 'Zaiem', 'elias.zaiem16@gmail.com', '8185c8ac4656219f4aa5541915079f7b3743e1b5f48bacfcc3386af016b55320', 2);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`idCategorie`);

--
-- Index pour la table `like_unlike`
--
ALTER TABLE `like_unlike`
  ADD PRIMARY KEY (`idLikeUnlike`),
  ADD KEY `like_unlike_FK` (`utilisateurs_idUser`),
  ADD KEY `like_unlike_FK_1` (`production_idProduction`);

--
-- Index pour la table `productions`
--
ALTER TABLE `productions`
  ADD PRIMARY KEY (`idProduction`),
  ADD KEY `productions_FK` (`categories_idCategorie`),
  ADD KEY `productions_FK_1` (`utilisateurs_idUser`);

--
-- Index pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  ADD PRIMARY KEY (`idUser`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `categories`
--
ALTER TABLE `categories`
  MODIFY `idCategorie` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `like_unlike`
--
ALTER TABLE `like_unlike`
  MODIFY `idLikeUnlike` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `productions`
--
ALTER TABLE `productions`
  MODIFY `idProduction` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  MODIFY `idUser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `like_unlike`
--
ALTER TABLE `like_unlike`
  ADD CONSTRAINT `like_unlike_FK` FOREIGN KEY (`utilisateurs_idUser`) REFERENCES `utilisateurs` (`idUser`),
  ADD CONSTRAINT `like_unlike_FK_1` FOREIGN KEY (`production_idProduction`) REFERENCES `productions` (`idProduction`);

--
-- Contraintes pour la table `productions`
--
ALTER TABLE `productions`
  ADD CONSTRAINT `productions_FK` FOREIGN KEY (`categories_idCategorie`) REFERENCES `categories` (`idCategorie`),
  ADD CONSTRAINT `productions_FK_1` FOREIGN KEY (`utilisateurs_idUser`) REFERENCES `utilisateurs` (`idUser`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
