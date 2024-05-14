
```
-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mer. 29 nov. 2023 à 14:22
-- Version du serveur : 10.4.25-MariaDB
-- Version de PHP : 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `pome`
--

-- --------------------------------------------------------

--
-- Structure de la table `abonnements`
--

CREATE TABLE `abonnements` (
  `AbonnementID` int(11) NOT NULL,
  `NomAbonnement` varchar(255) DEFAULT NULL,
  `Description` text DEFAULT NULL,
  `Tarif` decimal(10,2) DEFAULT NULL,
  `DureeEnMois` int(11) DEFAULT NULL,
  `Avantages` text DEFAULT NULL,
  `Remises` text DEFAULT NULL,
  `SupportPrioritaire` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `abonnements_utilisateurs`
--

CREATE TABLE `abonnements_utilisateurs` (
  `AbonnementUtilisateurID` int(11) NOT NULL,
  `UserID` int(11) DEFAULT NULL,
  `AbonnementID` int(11) DEFAULT NULL,
  `DateDebut` date DEFAULT NULL,
  `DateFin` date DEFAULT NULL,
  `Statut` enum('actif','expire') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `calendrier_prestataires`
--

CREATE TABLE `calendrier_prestataires` (
  `CalendrierID` int(11) NOT NULL,
  `PrestataireID` int(11) DEFAULT NULL,
  `DateDisponibilite` date DEFAULT NULL,
  `Statut` enum('Disponible','Indisponible') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `demandes`
--

CREATE TABLE `demandes` (
  `DemandeID` int(11) NOT NULL,
  `EvenementID` int(11) DEFAULT NULL,
  `DateDemande` datetime DEFAULT NULL,
  `Preferences` varchar(255) DEFAULT NULL,
  `Budget` decimal(10,2) DEFAULT NULL,
  `Documents` varchar(255) DEFAULT NULL,
  `DescriptionDetaillee` text DEFAULT NULL,
  `PhotosVideos` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `devis`
--

CREATE TABLE `devis` (
  `DevisID` int(11) NOT NULL,
  `DemandeID` int(11) DEFAULT NULL,
  `PrestataireID` int(11) DEFAULT NULL,
  `Cout` decimal(10,2) DEFAULT NULL,
  `ServicesInclus` varchar(255) DEFAULT NULL,
  `Etat` enum('Accepte','Decline','En attente') DEFAULT NULL,
  `DateDevis` datetime DEFAULT NULL,
  `DateValiditeDevis` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `evenements`
--

CREATE TABLE `evenements` (
  `EvenementID` int(11) NOT NULL,
  `Titre` varchar(255) DEFAULT NULL,
  `DateDebut` datetime DEFAULT NULL,
  `DateFin` datetime DEFAULT NULL,
  `Lieu` varchar(255) DEFAULT NULL,
  `Description` text DEFAULT NULL,
  `OrganisateurID` int(11) DEFAULT NULL,
  `Type` enum('mariage','fete d''entreprise','anniversaire','conference','soiree caritative','reunion','festival','salon professionnel','remise de diplomes','Autre') DEFAULT NULL,
  `Statut` enum('planifie','en cours','termine','annule') DEFAULT NULL,
  `NombreParticipants` int(11) DEFAULT NULL,
  `BudgetTotal` decimal(10,2) DEFAULT NULL,
  `LieuReception` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `messages`
--

CREATE TABLE `messages` (
  `MessageID` int(11) NOT NULL,
  `ExpediteurID` int(11) DEFAULT NULL,
  `DestinataireID` int(11) DEFAULT NULL,
  `Contenu` text DEFAULT NULL,
  `DateEnvoi` datetime DEFAULT NULL,
  `Statut` enum('Non lu','Lu') DEFAULT NULL,
  `FichierJoint` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `prestataires`
--

CREATE TABLE `prestataires` (
  `PrestataireID` int(11) NOT NULL,
  `NomEntreprise` varchar(255) DEFAULT NULL,
  `NomPrestataire` varchar(255) DEFAULT NULL,
  `AdresseEntreprise` varchar(255) DEFAULT NULL,
  `EmailPrestataire` varchar(255) DEFAULT NULL,
  `TypeService` enum('photographe','maquilleur','organisateur de mariage','serveurs','DJ','traiteur','fleuriste','vidéaste','animateur','transport','décorateur','fournisseur de lieu','sécurité','coiffeur','chef personnel','coordinateur d''événements','barman','services audiovisuels','graphiste','designer d''invitations','pâtissier','location de voiture','fournisseur de feux d''artifice','voiturier','guide touristique') DEFAULT NULL,
  `Competences` varchar(255) DEFAULT NULL,
  `Portfolio` varchar(255) DEFAULT NULL,
  `Description` text DEFAULT NULL,
  `NumeroTelephone` varchar(20) DEFAULT NULL,
  `SiteWeb` varchar(255) DEFAULT NULL,
  `Notes` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `reservations`
--

CREATE TABLE `reservations` (
  `ReservationID` int(11) NOT NULL,
  `DemandeID` int(11) DEFAULT NULL,
  `PrestataireID` int(11) DEFAULT NULL,
  `DateReservation` datetime DEFAULT NULL,
  `CoutTotal` decimal(10,2) DEFAULT NULL,
  `Statut` enum('En attente','Confirme','Annule') DEFAULT NULL,
  `PaiementEffectue` tinyint(1) DEFAULT NULL,
  `DateDebutEvenement` datetime DEFAULT NULL,
  `DateFinEvenement` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

CREATE TABLE `utilisateurs` (
  `UserID` int(11) NOT NULL,
  `Nom` varchar(255) DEFAULT NULL,
  `Prenom` varchar(255) DEFAULT NULL,
  `Adresse` varchar(255) DEFAULT NULL,
  `Email` varchar(255) DEFAULT NULL,
  `MotDePasse` varchar(255) DEFAULT NULL,
  `TypeUtilisateur` enum('Particulier','Entreprise') DEFAULT NULL,
  `DateNaissance` date DEFAULT NULL,
  `PhotoProfil` varchar(255) DEFAULT NULL,
  `LanguesParlees` enum('Francais','Anglais','Espagnol','Arabe','Autre') DEFAULT NULL,
  `Username` varchar(100) DEFAULT NULL,
  `Téléphone` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `abonnements`
--
ALTER TABLE `abonnements`
  ADD PRIMARY KEY (`AbonnementID`);

--
-- Index pour la table `abonnements_utilisateurs`
--
ALTER TABLE `abonnements_utilisateurs`
  ADD PRIMARY KEY (`AbonnementUtilisateurID`),
  ADD KEY `UserID` (`UserID`),
  ADD KEY `AbonnementID` (`AbonnementID`);

--
-- Index pour la table `calendrier_prestataires`
--
ALTER TABLE `calendrier_prestataires`
  ADD PRIMARY KEY (`CalendrierID`),
  ADD KEY `PrestataireID` (`PrestataireID`);

--
-- Index pour la table `demandes`
--
ALTER TABLE `demandes`
  ADD PRIMARY KEY (`DemandeID`),
  ADD KEY `EvenementID` (`EvenementID`);

--
-- Index pour la table `devis`
--
ALTER TABLE `devis`
  ADD PRIMARY KEY (`DevisID`),
  ADD KEY `DemandeID` (`DemandeID`),
  ADD KEY `PrestataireID` (`PrestataireID`);

--
-- Index pour la table `evenements`
--
ALTER TABLE `evenements`
  ADD PRIMARY KEY (`EvenementID`),
  ADD KEY `OrganisateurID` (`OrganisateurID`);

--
-- Index pour la table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`MessageID`),
  ADD KEY `ExpediteurID` (`ExpediteurID`),
  ADD KEY `DestinataireID` (`DestinataireID`);

--
-- Index pour la table `prestataires`
--
ALTER TABLE `prestataires`
  ADD PRIMARY KEY (`PrestataireID`);

--
-- Index pour la table `reservations`
--
ALTER TABLE `reservations`
  ADD PRIMARY KEY (`ReservationID`),
  ADD KEY `DemandeID` (`DemandeID`),
  ADD KEY `PrestataireID` (`PrestataireID`);

--
-- Index pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  ADD PRIMARY KEY (`UserID`);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `abonnements_utilisateurs`
--
ALTER TABLE `abonnements_utilisateurs`
  ADD CONSTRAINT `abonnements_utilisateurs_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `utilisateurs` (`UserID`),
  ADD CONSTRAINT `abonnements_utilisateurs_ibfk_2` FOREIGN KEY (`AbonnementID`) REFERENCES `abonnements` (`AbonnementID`);

--
-- Contraintes pour la table `calendrier_prestataires`
--
ALTER TABLE `calendrier_prestataires`
  ADD CONSTRAINT `calendrier_prestataires_ibfk_1` FOREIGN KEY (`PrestataireID`) REFERENCES `prestataires` (`PrestataireID`);

--
-- Contraintes pour la table `demandes`
--
ALTER TABLE `demandes`
  ADD CONSTRAINT `demandes_ibfk_1` FOREIGN KEY (`EvenementID`) REFERENCES `evenements` (`EvenementID`);

--
-- Contraintes pour la table `devis`
--
ALTER TABLE `devis`
  ADD CONSTRAINT `devis_ibfk_1` FOREIGN KEY (`DemandeID`) REFERENCES `demandes` (`DemandeID`),
  ADD CONSTRAINT `devis_ibfk_2` FOREIGN KEY (`PrestataireID`) REFERENCES `prestataires` (`PrestataireID`);

--
-- Contraintes pour la table `evenements`
--
ALTER TABLE `evenements`
  ADD CONSTRAINT `evenements_ibfk_1` FOREIGN KEY (`OrganisateurID`) REFERENCES `utilisateurs` (`UserID`);

--
-- Contraintes pour la table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_ibfk_1` FOREIGN KEY (`ExpediteurID`) REFERENCES `utilisateurs` (`UserID`),
  ADD CONSTRAINT `messages_ibfk_2` FOREIGN KEY (`DestinataireID`) REFERENCES `utilisateurs` (`UserID`);

--
-- Contraintes pour la table `prestataires`
--
ALTER TABLE `prestataires`
  ADD CONSTRAINT `prestataires_ibfk_1` FOREIGN KEY (`PrestataireID`) REFERENCES `utilisateurs` (`UserID`);

--
-- Contraintes pour la table `reservations`
--
ALTER TABLE `reservations`
  ADD CONSTRAINT `reservations_ibfk_1` FOREIGN KEY (`DemandeID`) REFERENCES `demandes` (`DemandeID`),
  ADD CONSTRAINT `reservations_ibfk_2` FOREIGN KEY (`PrestataireID`) REFERENCES `prestataires` (`PrestataireID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
```

