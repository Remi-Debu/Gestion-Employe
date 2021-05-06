-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : jeu. 06 mai 2021 à 15:52
-- Version du serveur :  10.4.17-MariaDB
-- Version de PHP : 7.4.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `emp_serv`
--

-- --------------------------------------------------------

--
-- Structure de la table `employes`
--

CREATE TABLE `employes` (
  `noemp` int(4) NOT NULL,
  `nom` varchar(20) DEFAULT NULL,
  `prenom` varchar(20) DEFAULT NULL,
  `emploi` varchar(20) DEFAULT NULL,
  `sup` int(4) DEFAULT NULL,
  `embauche` date DEFAULT NULL,
  `sal` decimal(9,2) DEFAULT NULL,
  `comm` decimal(9,2) DEFAULT NULL,
  `noserv` int(2) NOT NULL,
  `ajout` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `employes`
--

INSERT INTO `employes` (`noemp`, `nom`, `prenom`, `emploi`, `sup`, `embauche`, `sal`, `comm`, `noserv`, `ajout`) VALUES
(1000, 'LEROY', 'PAUL', 'PRESIDENT', NULL, '1987-10-25', '55005.50', NULL, 1, NULL),
(1100, 'DELPIERRE', 'DOROTHEE', 'SECRETAIRE', 1000, '1987-10-25', '12351.24', NULL, 1, NULL),
(1101, 'DUMONT', 'LOUIS', 'VENDEUR', 1300, '1987-10-25', '9047.90', '0.00', 1, NULL),
(1102, 'MINET', 'MARC', 'VENDEUR', 1300, '1987-10-25', '8085.81', '17230.00', 1, NULL),
(1104, 'NYS', 'ETIENNE', 'TECHNICIEN', 1200, '1987-10-25', '12342.23', NULL, 1, NULL),
(1105, 'DENIMAL', 'JEROME', 'COMPTABLE', 1600, '1987-10-25', '15746.57', NULL, 1, NULL),
(1200, 'LEMAIRE', 'GUY', 'DIRECTEUR', 1000, '1987-03-11', '36303.63', NULL, 2, NULL),
(1201, 'MARTIN', 'JEAN', 'TECHNICIEN', 1200, '1987-06-25', '11235.12', NULL, 2, NULL),
(1202, 'DUPONT', 'JACQUES', 'TECHNICIEN', 1200, '1988-10-30', '10313.03', NULL, 2, NULL),
(1300, 'LENOIR', 'GERARD', 'DIRECTEUR', 1000, '1987-04-02', '31353.14', '13071.00', 3, NULL),
(1301, 'GERARD', 'ROBERT', 'VENDEUR', 1300, '1999-04-16', '7694.77', '12430.00', 3, NULL),
(1303, 'MASURE', 'EMILE', 'TECHNICIEN', 1200, '1988-06-17', '10451.05', NULL, 3, NULL),
(1500, 'DUPONT', 'JEAN', 'DIRECTEUR', 1000, '1987-10-23', '28434.84', NULL, 5, NULL),
(1501, 'DUPIRE', 'PIERRE', 'ANALYSTE', 1500, '1984-10-24', '23102.31', NULL, 5, NULL),
(1502, 'DURAND', 'BERNARD', 'PROGRAMMEUR', 1500, '1987-07-30', '13201.32', NULL, 5, NULL),
(1503, 'DELNATTE', 'LUC', 'PUPITREUR', 1500, '1999-01-15', '8801.01', NULL, 5, NULL),
(1600, 'LAVARE', 'PAUL', 'DIRECTEUR', 1000, '1991-12-13', '31238.12', NULL, 5, NULL),
(1601, 'CARON', 'ALAIN', 'COMPTABLE', 1600, '1985-09-16', '33003.30', NULL, 5, NULL),
(1602, 'DUBOIS', 'JULES', 'VENDEUR', 1300, '1990-12-20', '9520.95', '35535.00', 5, NULL),
(1603, 'MOREL', 'ROBERT', 'COMPTABLE', 1600, '1985-07-18', '33003.30', NULL, 5, NULL),
(1604, 'HAVET', 'ALAIN', 'VENDEUR', 1300, '1991-01-01', '9388.94', '33415.00', 5, NULL),
(1605, 'RICHARD', 'JULES', 'COMPTABLE', 1600, '1985-10-22', '33503.35', NULL, 6, NULL),
(1615, 'DUPREZ', 'JEAN', 'BALAYEUR', 1000, '1998-10-22', '6000.60', NULL, 6, NULL),
(2000, 'DEBU', 'REMI', 'DEV', NULL, '2021-05-02', '2500.99', '1354.99', 4, '2021-04-29');

-- --------------------------------------------------------

--
-- Structure de la table `employes2`
--

CREATE TABLE `employes2` (
  `noemp` int(4) NOT NULL,
  `nom` varchar(20) DEFAULT NULL,
  `prenom` varchar(20) DEFAULT NULL,
  `emploi` varchar(20) DEFAULT NULL,
  `sup` int(4) DEFAULT NULL,
  `embauche` date DEFAULT NULL,
  `sal` decimal(9,2) DEFAULT NULL,
  `comm` decimal(9,2) DEFAULT NULL,
  `noserv` int(2) NOT NULL,
  `noproj` int(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `employes2`
--

INSERT INTO `employes2` (`noemp`, `nom`, `prenom`, `emploi`, `sup`, `embauche`, `sal`, `comm`, `noserv`, `noproj`) VALUES
(1000, 'LEROY', 'PAUL', 'PRESIDENT', NULL, '1987-10-25', '55005.50', NULL, 1, 103),
(1101, 'DUMONT', 'LOUIS', 'VENDEUR', 1300, '1987-10-25', '9952.69', '0.00', 1, 103),
(1102, 'MINET', 'MARC', 'VENDEUR', 1300, '1987-10-25', '8894.39', '17230.00', 1, 103),
(1104, 'NYS', 'ETIENNE', 'TECHNICIEN', 1200, '1987-10-25', '13576.45', NULL, 1, 103),
(1105, 'DENIMAL', 'JEROME', 'COMPTABLE', 1600, '1987-10-25', '17321.23', NULL, 1, 103),
(1200, 'LEMAIRE', 'GUY', 'DIRECTEUR', 1000, '1987-03-11', '36303.63', NULL, 2, 103),
(1201, 'MARTIN', 'JEAN', 'TECHNICIEN', 1200, '1987-06-25', '12358.63', NULL, 2, 103),
(1202, 'DUPONT', 'JACQUES', 'TECHNICIEN', 1200, '1988-10-30', '11344.33', NULL, 2, 103),
(1300, 'LENOIR', 'GERARD', 'DIRECTEUR', 1000, '1987-04-02', '31353.14', '13071.00', 3, 103),
(1301, 'GERARD', 'ROBERT', 'VENDEUR', 1300, '1999-04-16', '8464.25', '12430.00', 3, 103),
(1303, 'MASURE', 'EMILE', 'TECHNICIEN', 1200, '1988-06-17', '11496.16', NULL, 3, 103),
(1400, 'DEBU', 'REMI', 'DIRECTEUR', 1000, '2021-04-07', '61000.00', '0.01', 4, 102),
(1500, 'DUPONT', 'JEAN', 'DIRECTEUR', 1000, '1987-10-23', '28434.84', NULL, 5, 102),
(1501, 'DUPIRE', 'PIERRE', 'ANALYSTE', 1500, '1984-10-24', '23102.31', NULL, 5, 102),
(1502, 'DURAND', 'BERNARD', 'PROGRAMMEUR', 1500, '1987-07-30', '14521.45', NULL, 5, 102),
(1503, 'DELNATTE', 'LUC', 'PUPITREUR', 1500, '1999-01-15', '9681.11', NULL, 5, 102),
(1600, 'LAVARE', 'PAUL', 'DIRECTEUR', 1000, '1991-12-13', '31238.12', NULL, 5, 102),
(1601, 'CARON', 'ALAIN', 'COMPTABLE', 1600, '1985-09-16', '33003.30', NULL, 5, 102),
(1602, 'DUBOIS', 'JULES', 'VENDEUR', 1300, '1990-12-20', '10473.05', '35535.00', 5, 102),
(1603, 'MOREL', 'ROBERT', 'COMPTABLE', 1600, '1985-07-18', '33003.30', NULL, 5, 102),
(1604, 'HAVET', 'ALAIN', 'VENDEUR', 1300, '1991-01-01', '10327.83', '33415.00', 5, 102),
(1605, 'RICHARD', 'JULES', 'COMPTABLE', 1600, '1985-10-22', '33503.35', NULL, 6, 102),
(1615, 'DUPREZ', 'JEAN', 'BALAYEUR', 1000, '1998-10-22', '6600.66', NULL, 6, 102);

-- --------------------------------------------------------

--
-- Structure de la table `proj`
--

CREATE TABLE `proj` (
  `noproj` int(3) NOT NULL,
  `nomproj` varchar(10) DEFAULT NULL,
  `budget` decimal(11,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `proj`
--

INSERT INTO `proj` (`noproj`, `nomproj`, `budget`) VALUES
(101, 'alpha', '250000.00'),
(102, 'beta', '175000.00'),
(103, 'gamma', '1500000.00');

-- --------------------------------------------------------

--
-- Structure de la table `services`
--

CREATE TABLE `services` (
  `noserv` int(2) NOT NULL,
  `service` varchar(20) DEFAULT NULL,
  `ville` varchar(20) DEFAULT NULL,
  `ajout` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `services`
--

INSERT INTO `services` (`noserv`, `service`, `ville`, `ajout`) VALUES
(1, 'DIRECTION', 'PARIS', NULL),
(2, 'LOGISTIQUE', 'SECLIN', NULL),
(3, 'VENTES', 'ROUBAIX', NULL),
(4, 'FORMATION', 'VILLENEUVE D ASCQ', NULL),
(5, 'INFORMATIQUE', 'LILLE', NULL),
(6, 'COMPTABILITE', 'LILLE', NULL),
(7, 'TECHNIQUE', 'ROUBAIX', NULL),
(8, 'FORMATIONS', 'PARIS', '2021-05-03');

-- --------------------------------------------------------

--
-- Structure de la table `services2`
--

CREATE TABLE `services2` (
  `noserv` int(2) NOT NULL,
  `service` varchar(20) DEFAULT NULL,
  `ville` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `services2`
--

INSERT INTO `services2` (`noserv`, `service`, `ville`) VALUES
(1, 'DIRECTION', 'PARIS'),
(2, 'LOGISTIQUE', 'SECLIN'),
(3, 'VENTES', 'ROUBAIX'),
(4, 'FORMATION', 'VILLENEUVE D\'ASCQ'),
(5, 'INFORMATIQUE', 'LILLE'),
(6, 'COMPTABILITE', 'LILLE'),
(7, 'TECHNIQUE', 'ROUBAIX');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

CREATE TABLE `utilisateurs` (
  `id` int(4) NOT NULL,
  `nom` varchar(20) DEFAULT NULL,
  `mdp` varchar(255) DEFAULT NULL,
  `admin` varchar(1) NOT NULL DEFAULT 'N'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`id`, `nom`, `mdp`, `admin`) VALUES
(1, 'Remi', '$2y$10$SVOEBsUA3xKGzz3JWJCoZedlINccFYkv1N9dQa7WrSGafXnc5lf3i', 'Y'),
(2, 'Jean', '$2y$10$VEb7FP.P7Kd/BQ8ZQIT1yO5q5e4Fv55Th78Y8DV3CG3jOjPsDTVl6', 'N'),
(3, 'Paul', '$2y$10$HxLxABAmzem3pIVzVA4wUu.19yeNxLVAlUx3GDe.vSd6/X3u6C4gW', 'N'),
(4, 'Dorothee', '$2y$10$xD/h4sErRjZPZffFsfmEPeX.5Yd8aJvLopS0F3omw3Pr2K5SLZ.FO', 'N'),
(5, 'Bernard', '$2y$10$izxdooLm7F0hLPsRa8GsS.PMFhw.OsCINFvPx15GfniG4bSyHStJu', 'N'),
(6, 'Pierre', '$2y$10$i7GqN5bYHsLFRkhQmJM9wOuL532alsCCPGqMwDECdDIuRsoxc39qG', 'N');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `employes`
--
ALTER TABLE `employes`
  ADD PRIMARY KEY (`noemp`),
  ADD KEY `noserv` (`noserv`),
  ADD KEY `sup` (`sup`);

--
-- Index pour la table `employes2`
--
ALTER TABLE `employes2`
  ADD PRIMARY KEY (`noemp`),
  ADD KEY `sup` (`sup`),
  ADD KEY `noserv` (`noserv`);

--
-- Index pour la table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`noserv`);

--
-- Index pour la table `services2`
--
ALTER TABLE `services2`
  ADD PRIMARY KEY (`noserv`);

--
-- Index pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `employes`
--
ALTER TABLE `employes`
  ADD CONSTRAINT `employes_ibfk_1` FOREIGN KEY (`noserv`) REFERENCES `services` (`noserv`),
  ADD CONSTRAINT `employes_ibfk_2` FOREIGN KEY (`sup`) REFERENCES `employes` (`noemp`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
