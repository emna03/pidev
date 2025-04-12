-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : dim. 06 avr. 2025 à 16:53
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `siwar`
--

-- --------------------------------------------------------

--
-- Structure de la table `assistantdocumentaire`
--

CREATE TABLE `assistantdocumentaire` (
  `id` int(11) NOT NULL,
  `id_utilisateur` int(11) DEFAULT NULL,
  `id_document` int(11) DEFAULT NULL,
  `type_assistance` varchar(255) NOT NULL,
  `date_demande` datetime NOT NULL,
  `status` varchar(255) NOT NULL,
  `remarque` longtext NOT NULL,
  `rappel_automatique` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `assistantdocumentaire`
--

INSERT INTO `assistantdocumentaire` (`id`, `id_utilisateur`, `id_document`, `type_assistance`, `date_demande`, `status`, `remarque`, `rappel_automatique`) VALUES
(10, 1, 1, 'Traduction', '2025-03-15 00:00:00', 'Approved', 'yallahhh', 1),
(11, 1, 1, 'Correction', '2025-04-03 00:00:00', 'Approved', 'azdazdazdazfazazfafad', 1);

-- --------------------------------------------------------

--
-- Structure de la table `declarationrevenus`
--

CREATE TABLE `declarationrevenus` (
  `id` int(11) NOT NULL,
  `id_dossier` int(11) DEFAULT NULL,
  `montant_revenu` double NOT NULL,
  `source_revenu` varchar(255) NOT NULL,
  `date_declaration` varchar(255) NOT NULL,
  `preuve_revenu` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `doctrine_migration_versions`
--

CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20250331231414', '2025-04-01 02:26:42', 408),
('DoctrineMigrations\\Version20250331235414', '2025-04-01 02:26:42', 70),
('DoctrineMigrations\\Version20250331235629', '2025-04-01 02:26:42', 48),
('DoctrineMigrations\\Version20250401011848', '2025-04-01 03:18:59', 172);

-- --------------------------------------------------------

--
-- Structure de la table `documentadministratif`
--

CREATE TABLE `documentadministratif` (
  `id` int(11) NOT NULL,
  `nom_document` varchar(255) NOT NULL,
  `chemin_fichier` varchar(255) NOT NULL,
  `date_emission` date NOT NULL DEFAULT curdate(),
  `status` varchar(255) NOT NULL,
  `remarque` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `documentadministratif`
--

INSERT INTO `documentadministratif` (`id`, `nom_document`, `chemin_fichier`, `date_emission`, `status`, `remarque`) VALUES
(1, 'Wajdi', '67eb33badb4e5.pdf', '2025-04-01', 'Validé', 'yallha'),
(3, 'malek', '67f2638e2f5bd.pdf', '2025-04-06', 'Validé', 'hththththththt');

-- --------------------------------------------------------

--
-- Structure de la table `dossierfiscale`
--

CREATE TABLE `dossierfiscale` (
  `id` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `annee_fiscale` int(11) NOT NULL,
  `total_impot` double NOT NULL,
  `total_impot_paye` double NOT NULL,
  `status` varchar(255) NOT NULL,
  `date_creation` varchar(255) NOT NULL,
  `moyen_paiement` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `incident`
--

CREATE TABLE `incident` (
  `id` int(11) NOT NULL,
  `service_affecte` int(11) DEFAULT NULL,
  `type_incident` varchar(255) NOT NULL,
  `description` longtext NOT NULL,
  `localisation` varchar(255) NOT NULL,
  `statut` varchar(255) NOT NULL,
  `date_signalement` datetime NOT NULL,
  `latitude` double NOT NULL,
  `longitude` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `messenger_messages`
--

CREATE TABLE `messenger_messages` (
  `id` bigint(20) NOT NULL,
  `body` longtext NOT NULL,
  `headers` longtext NOT NULL,
  `queue_name` varchar(190) NOT NULL,
  `created_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `available_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `delivered_at` datetime DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `serviceintervention`
--

CREATE TABLE `serviceintervention` (
  `id` int(11) NOT NULL,
  `nom_service` varchar(255) NOT NULL,
  `type_intervention` varchar(255) NOT NULL,
  `zone_intervention` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL,
  `date_inscription` date NOT NULL,
  `mot_de_passe` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`id`, `nom`, `prenom`, `email`, `role`, `date_inscription`, `mot_de_passe`) VALUES
(1, 'Siwar', 'Slimi', 'siwar.slimi@gmail.com', 'Admin', '2025-04-01', 'Siwar123');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `assistantdocumentaire`
--
ALTER TABLE `assistantdocumentaire`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_C366EB3250EAE44` (`id_utilisateur`),
  ADD KEY `IDX_C366EB3288B266E3` (`id_document`);

--
-- Index pour la table `declarationrevenus`
--
ALTER TABLE `declarationrevenus`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_C6E7CD81E3D54947` (`id_dossier`);

--
-- Index pour la table `doctrine_migration_versions`
--
ALTER TABLE `doctrine_migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Index pour la table `documentadministratif`
--
ALTER TABLE `documentadministratif`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `dossierfiscale`
--
ALTER TABLE `dossierfiscale`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_61D799006B3CA4B` (`id_user`);

--
-- Index pour la table `incident`
--
ALTER TABLE `incident`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_3D03A11A8714FF74` (`service_affecte`);

--
-- Index pour la table `messenger_messages`
--
ALTER TABLE `messenger_messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_75EA56E0FB7336F0` (`queue_name`),
  ADD KEY `IDX_75EA56E0E3BD61CE` (`available_at`),
  ADD KEY `IDX_75EA56E016BA31DB` (`delivered_at`);

--
-- Index pour la table `serviceintervention`
--
ALTER TABLE `serviceintervention`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `assistantdocumentaire`
--
ALTER TABLE `assistantdocumentaire`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT pour la table `documentadministratif`
--
ALTER TABLE `documentadministratif`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `messenger_messages`
--
ALTER TABLE `messenger_messages`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `assistantdocumentaire`
--
ALTER TABLE `assistantdocumentaire`
  ADD CONSTRAINT `FK_C366EB3250EAE44` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateur` (`id`),
  ADD CONSTRAINT `FK_C366EB3288B266E3` FOREIGN KEY (`id_document`) REFERENCES `documentadministratif` (`id`);

--
-- Contraintes pour la table `declarationrevenus`
--
ALTER TABLE `declarationrevenus`
  ADD CONSTRAINT `FK_C6E7CD81E3D54947` FOREIGN KEY (`id_dossier`) REFERENCES `dossierfiscale` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `dossierfiscale`
--
ALTER TABLE `dossierfiscale`
  ADD CONSTRAINT `FK_61D799006B3CA4B` FOREIGN KEY (`id_user`) REFERENCES `utilisateur` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `incident`
--
ALTER TABLE `incident`
  ADD CONSTRAINT `FK_3D03A11A8714FF74` FOREIGN KEY (`service_affecte`) REFERENCES `serviceintervention` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
