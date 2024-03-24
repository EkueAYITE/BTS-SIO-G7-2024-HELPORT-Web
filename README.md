composer require symfony/mailer
composer require symfonycasts/dynamic-forms
composer require fakerphp/faker
composer require lexik/jwt-authentication-bundle
Ajouter au path openssl 

ajouter au .env si il n'y est pas
                ###> lexik/jwt-authentication-bundle ###
                JWT_SECRET_KEY=%kernel.project_dir%/config/jwt/private.pem
                JWT_PUBLIC_KEY=%kernel.project_dir%/config/jwt/public.pem
                JWT_PASSPHRASE=9f5eca58f3cfc72d6fd2faf1eae9dcda611e241ea58e5884afd4f53298817ac0
                ###< lexik/jwt-authentication-bundle ###

Base de données

-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- HÃ´te : database:3306
-- GÃ©nÃ©rÃ© le : dim. 24 mars 2024 Ã  20:43
-- Version du serveur : 10.5.8-MariaDB-1:10.5.8+maria~focal
-- Version de PHP : 8.2.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de donnÃ©es : `app_db`
--

-- --------------------------------------------------------

--
-- Structure de la table `competence`
--

CREATE TABLE `competence` (
`id` int(11) NOT NULL,
`id_matiere_id` int(11) DEFAULT NULL,
`statut` int(11) NOT NULL,
`sous_matiere` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- DÃ©chargement des donnÃ©es de la table `competence`
--

INSERT INTO `competence` (`id`, `id_matiere_id`, `statut`, `sous_matiere`) VALUES
(1, 2, 0, '#matiere1ss2#matiere1ss5#matiere1ss6');

-- --------------------------------------------------------

--
-- Structure de la table `competence_user`
--

CREATE TABLE `competence_user` (
`competence_id` int(11) NOT NULL,
`user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- DÃ©chargement des donnÃ©es de la table `competence_user`
--

INSERT INTO `competence_user` (`competence_id`, `user_id`) VALUES
(1, 221);

-- --------------------------------------------------------

--
-- Structure de la table `demande`
--

CREATE TABLE `demande` (
`id` int(11) NOT NULL,
`id_matiere_id` int(11) DEFAULT NULL,
`user_id` int(11) NOT NULL,
`date_uptaded` date NOT NULL,
`date_fin_demande` date NOT NULL,
`statut` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
`sous_matiere` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- DÃ©chargement des donnÃ©es de la table `demande`
--

INSERT INTO `demande` (`id`, `id_matiere_id`, `user_id`, `date_uptaded`, `date_fin_demande`, `statut`, `sous_matiere`) VALUES
(18, 4, 223, '2024-03-23', '2026-01-01', '0', '#matiere3ss3#matiere3ss4#matiere3ss0'),
(19, 4, 221, '2024-03-23', '2019-01-01', '0', '#matiere3ss3');

-- --------------------------------------------------------

--
-- Structure de la table `doctrine_migration_versions`
--

CREATE TABLE `doctrine_migration_versions` (
`version` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
`executed_at` datetime DEFAULT NULL,
`execution_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- DÃ©chargement des donnÃ©es de la table `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20240322230122', '2024-03-23 00:01:33', 923);

-- --------------------------------------------------------

--
-- Structure de la table `matiere`
--

CREATE TABLE `matiere` (
`id` int(11) NOT NULL,
`designation` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
`code` int(11) NOT NULL,
`sous_matiere` longtext COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- DÃ©chargement des donnÃ©es de la table `matiere`
--

INSERT INTO `matiere` (`id`, `designation`, `code`, `sous_matiere`) VALUES
(1, 'matiere0', 0, '#matiere0ss0#matiere0ss1#matiere0ss2#matiere0ss3#matiere0ss4#matiere0ss5#matiere0ss6#matiere0ss7#matiere0ss8#matiere0ss9'),
(2, 'matiere1', 1, '#matiere1ss0#matiere1ss1#matiere1ss2#matiere1ss3#matiere1ss4#matiere1ss5#matiere1ss6#matiere1ss7#matiere1ss8#matiere1ss9'),
(3, 'matiere2', 2, '#matiere2ss0#matiere2ss1#matiere2ss2#matiere2ss3#matiere2ss4#matiere2ss5#matiere2ss6#matiere2ss7#matiere2ss8#matiere2ss9'),
(4, 'matiere3', 3, '#matiere3ss0#matiere3ss1#matiere3ss2#matiere3ss3#matiere3ss4#matiere3ss5#matiere3ss6#matiere3ss7#matiere3ss8#matiere3ss9'),
(5, 'matiere4', 4, '#matiere4ss0#matiere4ss1#matiere4ss2#matiere4ss3#matiere4ss4#matiere4ss5#matiere4ss6#matiere4ss7#matiere4ss8#matiere4ss9'),
(6, 'matiere5', 5, '#matiere5ss0#matiere5ss1#matiere5ss2#matiere5ss3#matiere5ss4#matiere5ss5#matiere5ss6#matiere5ss7#matiere5ss8#matiere5ss9'),
(7, 'matiere6', 6, '#matiere6ss0#matiere6ss1#matiere6ss2#matiere6ss3#matiere6ss4#matiere6ss5#matiere6ss6#matiere6ss7#matiere6ss8#matiere6ss9'),
(8, 'matiere7', 7, '#matiere7ss0#matiere7ss1#matiere7ss2#matiere7ss3#matiere7ss4#matiere7ss5#matiere7ss6#matiere7ss7#matiere7ss8#matiere7ss9'),
(9, 'matiere8', 8, '#matiere8ss0#matiere8ss1#matiere8ss2#matiere8ss3#matiere8ss4#matiere8ss5#matiere8ss6#matiere8ss7#matiere8ss8#matiere8ss9'),
(10, 'matiere9', 9, '#matiere9ss0#matiere9ss1#matiere9ss2#matiere9ss3#matiere9ss4#matiere9ss5#matiere9ss6#matiere9ss7#matiere9ss8#matiere9ss9');

-- --------------------------------------------------------

--
-- Structure de la table `messenger_messages`
--

CREATE TABLE `messenger_messages` (
`id` bigint(20) NOT NULL,
`body` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
`headers` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
`queue_name` varchar(190) COLLATE utf8mb4_unicode_ci NOT NULL,
`created_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
`available_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
`delivered_at` datetime DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `niveau`
--

CREATE TABLE `niveau` (
`id` int(11) NOT NULL,
`libelle` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
`code` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `salle`
--

CREATE TABLE `salle` (
`id` int(11) NOT NULL,
`code_salle` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
`etage` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `soutien`
--

CREATE TABLE `soutien` (
`id` int(11) NOT NULL,
`demande_id` int(11) NOT NULL,
`date_du_soutien` date NOT NULL,
`date_update` date NOT NULL,
`description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
`status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- DÃ©chargement des donnÃ©es de la table `soutien`
--

INSERT INTO `soutien` (`id`, `demande_id`, `date_du_soutien`, `date_update`, `description`, `status`) VALUES
(1, 18, '2022-01-03', '2024-03-23', 'Avec les livres', 0);

-- --------------------------------------------------------

--
-- Structure de la table `soutien_competence`
--

CREATE TABLE `soutien_competence` (
`soutien_id` int(11) NOT NULL,
`competence_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
`id` int(11) NOT NULL,
`demande_id` int(11) DEFAULT NULL,
`email` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
`roles` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL COMMENT '(DC2Type:json)' CHECK (json_valid(`roles`)),
`password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
`nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
`prenom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
`niveau` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
`sexe` int(11) NOT NULL,
`telephone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- DÃ©chargement des donnÃ©es de la table `user`
--

INSERT INTO `user` (`id`, `demande_id`, `email`, `roles`, `password`, `nom`, `prenom`, `niveau`, `sexe`, `telephone`) VALUES
(221, NULL, 'fp@test.com', '[\"ROLE_USER\"]', '$2y$13$YocZFTqzpeVM5cAuiZqI1e3mjGDErztJGJYJdqgjUqPcJflobrbZe', 'Peltier', 'Flore', '2TS SIO SLAM', 1, '07 23 45 23 89'),
(223, NULL, 'pt@test.com', '[\"ROLE_USER\"]', '$2y$13$DuoYbA8LIXDyAUWEX9A.HOnjkZrzyJwdaKSw9Eux.wfkc5iBQWb4S', 'Torre', 'Paul', '1 TS SIO A', 2, '06 33 45 33 89');

--
-- Index pour les tables dÃ©chargÃ©es
--

--
-- Index pour la table `competence`
--
ALTER TABLE `competence`
ADD PRIMARY KEY (`id`),
ADD KEY `IDX_94D4687F51E6528F` (`id_matiere_id`);

--
-- Index pour la table `competence_user`
--
ALTER TABLE `competence_user`
ADD PRIMARY KEY (`competence_id`,`user_id`),
ADD KEY `IDX_CA0BDC5215761DAB` (`competence_id`),
ADD KEY `IDX_CA0BDC52A76ED395` (`user_id`);

--
-- Index pour la table `demande`
--
ALTER TABLE `demande`
ADD PRIMARY KEY (`id`),
ADD KEY `IDX_2694D7A551E6528F` (`id_matiere_id`),
ADD KEY `IDX_2694D7A5A76ED395` (`user_id`);

--
-- Index pour la table `doctrine_migration_versions`
--
ALTER TABLE `doctrine_migration_versions`
ADD PRIMARY KEY (`version`);

--
-- Index pour la table `matiere`
--
ALTER TABLE `matiere`
ADD PRIMARY KEY (`id`);

--
-- Index pour la table `messenger_messages`
--
ALTER TABLE `messenger_messages`
ADD PRIMARY KEY (`id`),
ADD KEY `IDX_75EA56E0FB7336F0` (`queue_name`),
ADD KEY `IDX_75EA56E0E3BD61CE` (`available_at`),
ADD KEY `IDX_75EA56E016BA31DB` (`delivered_at`);

--
-- Index pour la table `niveau`
--
ALTER TABLE `niveau`
ADD PRIMARY KEY (`id`);

--
-- Index pour la table `salle`
--
ALTER TABLE `salle`
ADD PRIMARY KEY (`id`);

--
-- Index pour la table `soutien`
--
ALTER TABLE `soutien`
ADD PRIMARY KEY (`id`),
ADD UNIQUE KEY `UNIQ_99A7D32180E95E18` (`demande_id`);

--
-- Index pour la table `soutien_competence`
--
ALTER TABLE `soutien_competence`
ADD PRIMARY KEY (`soutien_id`,`competence_id`),
ADD KEY `IDX_B4A1BCA5BD6949E9` (`soutien_id`),
ADD KEY `IDX_B4A1BCA515761DAB` (`competence_id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
ADD PRIMARY KEY (`id`),
ADD UNIQUE KEY `UNIQ_8D93D649E7927C74` (`email`),
ADD KEY `IDX_8D93D64980E95E18` (`demande_id`);

--
-- AUTO_INCREMENT pour les tables dÃ©chargÃ©es
--

--
-- AUTO_INCREMENT pour la table `competence`
--
ALTER TABLE `competence`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `demande`
--
ALTER TABLE `demande`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT pour la table `matiere`
--
ALTER TABLE `matiere`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `messenger_messages`
--
ALTER TABLE `messenger_messages`
MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `niveau`
--
ALTER TABLE `niveau`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `salle`
--
ALTER TABLE `salle`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `soutien`
--
ALTER TABLE `soutien`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=224;

--
-- Contraintes pour les tables dÃ©chargÃ©es
--

--
-- Contraintes pour la table `competence`
--
ALTER TABLE `competence`
ADD CONSTRAINT `FK_94D4687F51E6528F` FOREIGN KEY (`id_matiere_id`) REFERENCES `matiere` (`id`);

--
-- Contraintes pour la table `competence_user`
--
ALTER TABLE `competence_user`
ADD CONSTRAINT `FK_CA0BDC5215761DAB` FOREIGN KEY (`competence_id`) REFERENCES `competence` (`id`) ON DELETE CASCADE,
ADD CONSTRAINT `FK_CA0BDC52A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `demande`
--
ALTER TABLE `demande`
ADD CONSTRAINT `FK_2694D7A551E6528F` FOREIGN KEY (`id_matiere_id`) REFERENCES `matiere` (`id`),
ADD CONSTRAINT `FK_2694D7A5A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `soutien_competence`
--
ALTER TABLE `soutien_competence`
ADD CONSTRAINT `FK_B4A1BCA515761DAB` FOREIGN KEY (`competence_id`) REFERENCES `competence` (`id`) ON DELETE CASCADE,
ADD CONSTRAINT `FK_B4A1BCA5BD6949E9` FOREIGN KEY (`soutien_id`) REFERENCES `soutien` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `user`
--
ALTER TABLE `user`
ADD CONSTRAINT `FK_8D93D64980E95E18` FOREIGN KEY (`demande_id`) REFERENCES `demande` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
