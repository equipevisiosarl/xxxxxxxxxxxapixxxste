-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : sam. 21 sep. 2024 à 14:40
-- Version du serveur : 8.4.2
-- Version de PHP : 8.2.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `saas_ste`
--

-- --------------------------------------------------------

--
-- Structure de la table `agences`
--

DROP TABLE IF EXISTS `agences`;
CREATE TABLE IF NOT EXISTS `agences` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `agence` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `localisation_agence` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `telephone_agence` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `agences_telephone_unique` (`telephone_agence`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `agences`
--

INSERT INTO `agences` (`id`, `agence`, `localisation_agence`, `telephone_agence`, `created_at`, `updated_at`) VALUES
(1, 'CNPS Abidjan Plateau', 'Av. Lamblin Plateau, 01 BP 317 Abidjan 01', '+225 20 20 20 20', NULL, NULL),
(2, 'CNPS Abidjan Yopougon', 'Quartier Maroc, non loin de la Mairie, 16 BP 740 Abidjan 16', '+225 21 21 21 21', NULL, NULL),
(3, 'CNPS Abidjan Treichville', 'Rue des Forgerons, Treichville', '+225 22 22 22 22', NULL, NULL),
(4, 'CNPS Bouaké', 'Avenue de la Liberté, BP 1040 Bouaké', '+225 23 23 23 23', NULL, NULL),
(5, 'CNPS Daloa', 'Quartier Commerce, BP 368 Daloa', '+225 24 24 24 24', NULL, NULL),
(6, 'CNPS San Pedro', 'Boulevard de Marseille, BP 318 San Pedro', '+225 25 25 25 25', NULL, NULL),
(7, 'CNPS Korhogo', 'Quartier SICOGI, BP 350 Korhogo', '+225 26 26 26 26', NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `cache`
--

DROP TABLE IF EXISTS `cache`;
CREATE TABLE IF NOT EXISTS `cache` (
  `key` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `cache_locks`
--

DROP TABLE IF EXISTS `cache_locks`;
CREATE TABLE IF NOT EXISTS `cache_locks` (
  `key` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `categories_independants`
--

DROP TABLE IF EXISTS `categories_independants`;
CREATE TABLE IF NOT EXISTS `categories_independants` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `categorie` varchar(256) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `revenue_planche` int NOT NULL,
  `cotisation_minimum` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `categories_independants`
--

INSERT INTO `categories_independants` (`id`, `categorie`, `revenue_planche`, `cotisation_minimum`, `created_at`, `updated_at`) VALUES
(5, 'Artisans', 45000, 5400, '2024-08-24 16:29:55', '2024-08-24 16:29:55'),
(8, 'Artistes et professionnels des médias et de l\'évènementiel', 45000, 5400, '2024-08-24 16:29:55', '2024-08-24 16:29:55'),
(6, 'Sportifs', 30000, 3600, '2024-08-24 16:29:55', '2024-08-24 16:29:55'),
(7, 'Réligieux et assimilés', 50000, 6000, '2024-08-24 16:29:55', '2024-08-24 16:29:55'),
(9, 'Exploitants agricoles', 45000, 5400, '2024-08-24 16:29:55', '2024-08-24 16:29:55'),
(10, 'Transporteurs', 75000, 9000, '2024-08-24 16:29:55', '2024-08-24 16:29:55'),
(11, 'Commercants', 30000, 3600, '2024-08-24 16:29:55', '2024-08-24 16:29:55'),
(12, 'Exploitants miniers', 50000, 6000, '2024-08-24 16:29:55', '2024-08-24 16:29:55'),
(13, 'Professions libérales et mandataires sociaux', 150000, 18000, '2024-08-24 16:29:55', '2024-08-24 16:29:55'),
(14, 'Consultants', 100000, 12000, '2024-08-24 16:29:55', '2024-08-24 16:29:55'),
(15, 'Ivoiiens travaillant à l\'étranger', 150000, 13500, '2024-08-24 16:29:55', '2024-08-24 16:29:55');

-- --------------------------------------------------------

--
-- Structure de la table `communes`
--

DROP TABLE IF EXISTS `communes`;
CREATE TABLE IF NOT EXISTS `communes` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_agence` int NOT NULL,
  `commune` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `communes`
--

INSERT INTO `communes` (`id`, `id_agence`, `commune`, `created_at`, `updated_at`) VALUES
(1, 1, 'Abidjan Plateau', NULL, NULL),
(2, 2, 'Abidjan Yopougon', NULL, NULL),
(3, 3, 'Abidjan Treichville', NULL, NULL),
(4, 4, 'Bouaké', NULL, NULL),
(5, 5, 'Daloa', NULL, NULL),
(6, 6, 'San Pedro', NULL, NULL),
(7, 7, 'Korhogo', NULL, NULL),
(10, 2, 'Songon', '2024-09-06 02:22:43', '2024-09-06 02:28:37');

-- --------------------------------------------------------

--
-- Structure de la table `contrats_packages`
--

DROP TABLE IF EXISTS `contrats_packages`;
CREATE TABLE IF NOT EXISTS `contrats_packages` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_demande_package` int NOT NULL,
  `etat` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'En cours',
  `date_debut` timestamp NOT NULL,
  `date_fin` timestamp NOT NULL,
  `a_payer` int NOT NULL,
  `contrat` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `contrats_packages`
--

INSERT INTO `contrats_packages` (`id`, `id_demande_package`, `etat`, `date_debut`, `date_fin`, `a_payer`, `contrat`, `created_at`, `updated_at`) VALUES
(1, 3, 'En cours', '2024-09-21 00:00:00', '2024-09-30 00:00:00', 1000000, 'http://127.0.0.1:8080/storage/documents/contrats_package/employeurs/contrat_user_9_66eed4783bb73.png', '2024-09-21 14:10:26', '2024-09-21 14:13:12');

-- --------------------------------------------------------

--
-- Structure de la table `contrats_services`
--

DROP TABLE IF EXISTS `contrats_services`;
CREATE TABLE IF NOT EXISTS `contrats_services` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_demande` int NOT NULL,
  `a_payer` int NOT NULL,
  `status` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT 'sur service',
  `contrat` varchar(256) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `contrats_services`
--

INSERT INTO `contrats_services` (`id`, `id_demande`, `a_payer`, `status`, `contrat`, `created_at`, `updated_at`) VALUES
(2, 14, 70000, 'sur service', 'http://127.0.0.1:8080/storage/documents/demandes/salaries/contrat_user_14_66ecf14b154de.pdf', '2024-09-20 03:51:39', '2024-09-20 03:51:39'),
(3, 13, 100000, 'sur service', 'http://127.0.0.1:8080/storage/documents/demandes/employeurs/contrat_user_9_66eec2396c1f5.gif', '2024-09-20 14:38:51', '2024-09-21 12:55:21');

-- --------------------------------------------------------

--
-- Structure de la table `coursiers`
--

DROP TABLE IF EXISTS `coursiers`;
CREATE TABLE IF NOT EXISTS `coursiers` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_commune` int NOT NULL,
  `telephone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `coursiers_telephone_unique` (`telephone`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `coursiers`
--

INSERT INTO `coursiers` (`id`, `name`, `id_commune`, `telephone`, `photo`, `created_at`, `updated_at`) VALUES
(1, 'Yeo olivia', 1, '0768356487', NULL, '2024-09-06 03:03:50', '2024-09-06 03:03:50');

-- --------------------------------------------------------

--
-- Structure de la table `demandes`
--

DROP TABLE IF EXISTS `demandes`;
CREATE TABLE IF NOT EXISTS `demandes` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_user` int NOT NULL,
  `id_service` int NOT NULL,
  `date_demande` datetime NOT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `demandes`
--

INSERT INTO `demandes` (`id`, `id_user`, `id_service`, `date_demande`, `status`, `created_at`, `updated_at`) VALUES
(13, 9, 3, '2024-09-10 00:50:29', 'dossier cnps', '2024-09-09 13:01:10', '2024-09-21 12:58:08'),
(14, 14, 2, '2024-09-10 01:31:43', 'dossier cnps', '2024-09-09 13:12:49', '2024-09-20 03:53:27');

-- --------------------------------------------------------

--
-- Structure de la table `documents_demandes`
--

DROP TABLE IF EXISTS `documents_demandes`;
CREATE TABLE IF NOT EXISTS `documents_demandes` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_user` int NOT NULL,
  `id_demande` int NOT NULL,
  `id_document_service` int NOT NULL,
  `document` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `documents_demandes`
--

INSERT INTO `documents_demandes` (`id`, `id_user`, `id_demande`, `id_document_service`, `document`, `created_at`, `updated_at`) VALUES
(5, 9, 14, 3, 'http://127.0.0.1:8000/storage/documents/demandes/employeurs/certificat_user_9_66df1169efe00.pdf', '2024-09-10 00:06:21', '2024-09-09 15:16:58'),
(6, 9, 14, 4, 'http://127.0.0.1:8000/storage/documents/demandes/employeurs/livre-de-compte_user_9_66df9c9f190a2.pdf', '2024-09-10 01:10:55', '2024-09-10 01:10:55'),
(8, 9, 14, 2, 'http://127.0.0.1:8000/storage/documents/demandes/employeurs/passport_user_9_66dfa0ba336e3.pdf', '2024-09-10 01:28:26', '2024-09-10 01:28:26');

-- --------------------------------------------------------

--
-- Structure de la table `documents_services`
--

DROP TABLE IF EXISTS `documents_services`;
CREATE TABLE IF NOT EXISTS `documents_services` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_service` int NOT NULL,
  `nom_document` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prefix` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `documents_services`
--

INSERT INTO `documents_services` (`id`, `id_service`, `nom_document`, `status`, `prefix`, `created_at`, `updated_at`) VALUES
(1, 1, 'cni', 'obligatoire', 'cni', NULL, NULL),
(2, 2, 'passport', 'non obligatoire', 'passport', NULL, NULL),
(3, 2, 'certificat', 'obligatoire', 'certificat', NULL, NULL),
(4, 2, 'livre de compte', 'obligatoire', 'livre-de-compte', NULL, NULL),
(5, 1, 'conjointe', 'obligatoire', 'conjointe', NULL, NULL),
(6, 5, 'carte d\'identite', 'obligatoire', 'carte-d\'identite', '2024-09-11 23:50:16', '2024-09-11 23:50:16'),
(7, 5, 'extrait', 'non obligatoire', 'extrait', '2024-09-11 23:50:16', '2024-09-11 23:50:16'),
(10, 9, 'carte d\'identite boreen', 'non obligatoire', 'carte-d-identite-boreen', '2024-09-18 22:57:42', '2024-09-18 22:57:42');

-- --------------------------------------------------------

--
-- Structure de la table `domaines_activites`
--

DROP TABLE IF EXISTS `domaines_activites`;
CREATE TABLE IF NOT EXISTS `domaines_activites` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `domaine_activite` varchar(256) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `domaines_activites`
--

INSERT INTO `domaines_activites` (`id`, `domaine_activite`, `created_at`, `updated_at`) VALUES
(1, 'Telecommunications', NULL, NULL),
(2, 'Assurance', NULL, NULL),
(3, 'Securite', NULL, NULL),
(4, 'Developpement informatique', NULL, NULL),
(5, 'Finance', NULL, NULL),
(6, 'Animation', NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `dossiers_cnps`
--

DROP TABLE IF EXISTS `dossiers_cnps`;
CREATE TABLE IF NOT EXISTS `dossiers_cnps` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_demande` int NOT NULL,
  `numero_dossier` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `etat` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `motif` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `dossiers_cnps`
--

INSERT INTO `dossiers_cnps` (`id`, `id_demande`, `numero_dossier`, `etat`, `motif`, `created_at`, `updated_at`) VALUES
(3, 14, 'D-CNPS-66ecf1b72eebe', 'en attente', NULL, '2024-09-20 03:53:27', '2024-09-20 03:53:27'),
(4, 13, 'D-CNPS-66eec2e02bd8d', 'en attente', NULL, '2024-09-20 14:39:10', '2024-09-21 12:58:08');

-- --------------------------------------------------------

--
-- Structure de la table `employeurs`
--

DROP TABLE IF EXISTS `employeurs`;
CREATE TABLE IF NOT EXISTS `employeurs` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_user` int NOT NULL,
  `raison_social` varchar(256) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `num_registre_commerce` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nom_responsable` varchar(256) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `matricule_cnps` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_domaine_activite` int DEFAULT NULL,
  `effectifs` int NOT NULL DEFAULT '0',
  `pays` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Côte d''ivoire',
  `id_commune` int DEFAULT NULL,
  `situation_geographique` varchar(256) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_user` (`id_user`),
  UNIQUE KEY `num_registre_commerce` (`num_registre_commerce`),
  UNIQUE KEY `matricule_cnps` (`matricule_cnps`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `employeurs`
--

INSERT INTO `employeurs` (`id`, `id_user`, `raison_social`, `num_registre_commerce`, `nom_responsable`, `matricule_cnps`, `id_domaine_activite`, `effectifs`, `pays`, `id_commune`, `situation_geographique`, `photo`, `created_at`, `updated_at`) VALUES
(1, 8, 'Visiotech sarl', 'visio78596', 'Thionon konate', 'cnps85858', 4, 3, 'Côte d\'ivoire', 1, 'cocody, istc polytechnique', 'http://127.0.0.1:8080/storage/images/photos-profil/employeurs/pp_user_8_66de7a7640594.png\r\n', NULL, '2024-09-08 04:50:35'),
(2, 9, 'socoprix', 'registre1202222bc', 'soco Maho', 'cnps542ghnj2024', 2, 51, 'Côte d\'ivoire', 4, 'bouké, au petit marché', NULL, NULL, '2024-09-08 02:43:36'),
(3, 11, 'istc polytechnique', NULL, 'zagba le requin', 'cfb77777', 4, 50, 'Côte d\'ivoire', 5, NULL, 'http://127.0.0.1:8080/storage/images/photo-profil/employeurs/pp_user_11_66e007bfaf375.png', NULL, '2024-09-10 08:47:59');

-- --------------------------------------------------------

--
-- Structure de la table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `gestionnaires`
--

DROP TABLE IF EXISTS `gestionnaires`;
CREATE TABLE IF NOT EXISTS `gestionnaires` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `fullname` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_role` int NOT NULL,
  `id_regime` int NOT NULL,
  `photo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ban` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `gestionnaires`
--

INSERT INTO `gestionnaires` (`id`, `fullname`, `email`, `password`, `id_role`, `id_regime`, `photo`, `ban`, `created_at`, `updated_at`) VALUES
(1, 'Mael konaté', 'admin@admin.com', '$2y$12$7a1xIKBqhlRos6Yljui2IeUQPm2b9a1oSxGoL5p3a3UC8T.aQU5cq', 1, 0, NULL, 0, NULL, NULL),
(2, 'Barry codja', 'supp@supp.com', '$2y$12$7a1xIKBqhlRos6Yljui2IeUQPm2b9a1oSxGoL5p3a3UC8T.aQU5cq', 2, 1, NULL, 0, NULL, NULL),
(3, 'Gojo nipo', 'gest@gest.com', '$2y$12$7a1xIKBqhlRos6Yljui2IeUQPm2b9a1oSxGoL5p3a3UC8T.aQU5cq', 3, 1, NULL, 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `groupes_services`
--

DROP TABLE IF EXISTS `groupes_services`;
CREATE TABLE IF NOT EXISTS `groupes_services` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `groupe_service` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `nombre_tranche` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `groupes_services`
--

INSERT INTO `groupes_services` (`id`, `groupe_service`, `nombre_tranche`, `created_at`, `updated_at`) VALUES
(1, 'ASSISTANCE CONSEIL EN SECURITE SOCIALE CNPS AUX ENTREPRISES', 3, NULL, '2024-09-11 19:37:40'),
(2, 'REGULARISATION DE CARRIERE', 2, NULL, '2024-09-11 19:37:52'),
(8, 'aloocution familliale', 4, '2024-09-11 19:08:46', '2024-09-11 20:01:02');

-- --------------------------------------------------------

--
-- Structure de la table `independants`
--

DROP TABLE IF EXISTS `independants`;
CREATE TABLE IF NOT EXISTS `independants` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_user` int NOT NULL,
  `full_name` varchar(256) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_naissance` date DEFAULT NULL,
  `sexe` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `matricule_cnps` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `activite` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_categorie` int DEFAULT NULL,
  `revenue_soumis` int NOT NULL DEFAULT '0',
  `pays` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Côte d''ivoire',
  `id_commune` int DEFAULT NULL,
  `lieux_activite` varchar(256) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lieux_residence` varchar(256) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_user` (`id_user`),
  UNIQUE KEY `matricule_cnps` (`matricule_cnps`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `independants`
--

INSERT INTO `independants` (`id`, `id_user`, `full_name`, `date_naissance`, `sexe`, `matricule_cnps`, `activite`, `id_categorie`, `revenue_soumis`, `pays`, `id_commune`, `lieux_activite`, `lieux_residence`, `photo`, `created_at`, `updated_at`) VALUES
(1, 7, 'india zola fabioli', '2024-09-08', 'Homme', 'ind7877775gh45', 'chabonnier de bois', 12, 50000, 'Côte d\'ivoire', 6, 'san pedro , route des grumiers', 'hotel pensyvanie', NULL, NULL, '2024-09-08 04:17:30'),
(2, 12, 'etran', NULL, 'Femme', 'ind44vh', 'menusierie', 5, 190000, 'Côte d\'ivoire', 1, NULL, NULL, NULL, NULL, '2024-09-08 04:53:20');

-- --------------------------------------------------------

--
-- Structure de la table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
CREATE TABLE IF NOT EXISTS `jobs` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `queue` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `job_batches`
--

DROP TABLE IF EXISTS `job_batches`;
CREATE TABLE IF NOT EXISTS `job_batches` (
  `id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `localisations`
--

DROP TABLE IF EXISTS `localisations`;
CREATE TABLE IF NOT EXISTS `localisations` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_user` int NOT NULL,
  `pays` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_commune` int NOT NULL,
  `lieux_travail` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `lieux_residence` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `localisations`
--

INSERT INTO `localisations` (`id`, `id_user`, `pays`, `id_commune`, `lieux_travail`, `lieux_residence`, `created_at`, `updated_at`) VALUES
(1, 1, 'Côte d\'ivoire', 2, 'bureau', 'maison', NULL, NULL),
(2, 2, 'Côte d\'ivoire', 5, 'bureau 1', 'residence ', NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=34 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2024_08_16_082131_agences', 1),
(5, '2024_08_16_082154_communes', 1),
(6, '2024_08_16_082246_coursiers', 1),
(7, '2024_08_16_082303_regimes', 1),
(8, '2024_08_18_010658_localisation', 2),
(9, '2024_08_19_000613_retraite', 3),
(12, '2024_08_19_000601_independant', 6),
(11, '2024_08_19_000628_employeur', 5),
(13, '2024_08_24_123742_salarie', 7),
(14, '2024_08_24_161634_categorie_independants', 8),
(15, '2024_08_24_231444_situation_matrimonials', 9),
(16, '2024_08_29_175819_groupes_service', 10),
(17, '2024_08_29_175533_service', 11),
(18, '2024_08_30_031322_document_service', 12),
(20, '2024_08_31_232943_demande', 13),
(21, '2024_09_01_012801_documents_demandes', 14),
(22, '2024_09_01_140659_rdv', 15),
(23, '2024_09_01_150259_domaine_activite', 16),
(24, '2024_09_10_143851_modes_paiement', 17),
(25, '2024_09_12_040412_notifications', 18),
(26, '2024_09_12_132411_role', 19),
(27, '2024_09_12_132120_supperviseur_gestionnaires', 20),
(29, '2024_09_19_143627_contrat', 21),
(30, '2024_09_19_145831_contrat_service', 22),
(31, '2024_09_20_010822_dossier_cnps', 23),
(32, '2024_09_21_090742_packages', 24),
(33, '2024_09_21_094418_souscrire_packages', 25);

-- --------------------------------------------------------

--
-- Structure de la table `modes_paiements`
--

DROP TABLE IF EXISTS `modes_paiements`;
CREATE TABLE IF NOT EXISTS `modes_paiements` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_groupe_service` int NOT NULL,
  `tranche` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pourcentage` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `modes_paiements`
--

INSERT INTO `modes_paiements` (`id`, `id_groupe_service`, `tranche`, `pourcentage`, `created_at`, `updated_at`) VALUES
(1, 1, 'tranche 1', 40, '2024-09-11 19:37:40', '2024-09-11 19:37:40'),
(2, 1, 'tranche 2', 30, '2024-09-11 19:37:40', '2024-09-11 19:37:40'),
(3, 1, 'tranche 3', 30, '2024-09-11 19:37:40', '2024-09-11 19:37:40'),
(4, 2, 'tranche 1', 50, '2024-09-11 19:37:52', '2024-09-11 19:37:52'),
(5, 2, 'tranche 2', 50, '2024-09-11 19:37:52', '2024-09-11 19:37:52'),
(18, 8, 'tranche 4', 10, '2024-09-11 20:01:02', '2024-09-11 20:01:02'),
(17, 8, 'tranche 3', 15, '2024-09-11 20:01:02', '2024-09-11 20:01:02'),
(16, 8, 'tranche 2', 35, '2024-09-11 20:01:02', '2024-09-11 20:01:02'),
(15, 8, 'tranche 1', 40, '2024-09-11 20:01:02', '2024-09-11 20:01:02');

-- --------------------------------------------------------

--
-- Structure de la table `notifications`
--

DROP TABLE IF EXISTS `notifications`;
CREATE TABLE IF NOT EXISTS `notifications` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_user` int NOT NULL,
  `notification` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `vue` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_gestionnaire` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `notifications`
--

INSERT INTO `notifications` (`id`, `id_user`, `notification`, `vue`, `id_gestionnaire`, `created_at`, `updated_at`) VALUES
(1, 3, 'votre demande a bien été apprové', 'non', 1, '2024-09-12 04:09:59', '2024-09-12 04:09:59'),
(2, 3, 'passé une bonne journé de la part de ste', 'oui', 1, '2024-09-12 04:09:59', '2024-09-12 04:38:01'),
(3, 4, 'danse avec les star du monde', 'non', 1, '2024-09-12 04:09:59', '2024-09-12 04:09:59'),
(4, 5, 'tout laisse', 'oui', 1, '2024-09-12 04:09:59', '2024-09-12 04:40:43');

-- --------------------------------------------------------

--
-- Structure de la table `packages`
--

DROP TABLE IF EXISTS `packages`;
CREATE TABLE IF NOT EXISTS `packages` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_regime` int NOT NULL,
  `id_groupe_service` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `packages`
--

INSERT INTO `packages` (`id`, `id_regime`, `id_groupe_service`, `created_at`, `updated_at`) VALUES
(1, 1, 1, NULL, NULL),
(2, 2, 2, NULL, NULL),
(3, 4, 2, NULL, NULL),
(4, 2, 3, NULL, NULL),
(5, 3, 3, NULL, NULL),
(6, 4, 3, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
CREATE TABLE IF NOT EXISTS `password_reset_tokens` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `regimes`
--

DROP TABLE IF EXISTS `regimes`;
CREATE TABLE IF NOT EXISTS `regimes` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `regime` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `regimes`
--

INSERT INTO `regimes` (`id`, `regime`, `created_at`, `updated_at`) VALUES
(1, 'employeur', NULL, NULL),
(2, 'salarié', NULL, NULL),
(3, 'indépendant', NULL, NULL),
(4, 'retraité', NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `rendez_vous`
--

DROP TABLE IF EXISTS `rendez_vous`;
CREATE TABLE IF NOT EXISTS `rendez_vous` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_user` int NOT NULL,
  `id_demande` int NOT NULL,
  `date_rdv` datetime NOT NULL,
  `id_commune` int NOT NULL,
  `lieu` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `etat` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'non effectuer',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `rendez_vous`
--

INSERT INTO `rendez_vous` (`id`, `id_user`, `id_demande`, `date_rdv`, `id_commune`, `lieu`, `etat`, `created_at`, `updated_at`) VALUES
(1, 4, 9, '2024-09-02 15:37:14', 5, 'derriere raiil devantle marche de cocovico', 'non effectuer', NULL, NULL),
(2, 4, 10, '2024-09-01 14:37:10', 2, 'derriere raiil devantle marche de cocovico fnbfjbzqfjzezbvfvnnbvjhdfdz', 'effectuer', NULL, NULL),
(4, 14, 14, '2024-09-20 03:50:00', 2, 'patson hotel', 'effectuer', '2024-09-20 03:50:40', '2024-09-21 10:58:14'),
(5, 9, 13, '2024-09-21 12:27:00', 2, 'abobo doumé', 'effectuer', '2024-09-20 14:23:15', '2024-09-21 12:45:15'),
(6, 9, 13, '2024-09-21 12:40:00', 1, 'leroy merlin', 'effectuer', '2024-09-21 12:43:38', '2024-09-21 12:45:15');

-- --------------------------------------------------------

--
-- Structure de la table `retraites`
--

DROP TABLE IF EXISTS `retraites`;
CREATE TABLE IF NOT EXISTS `retraites` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_user` int NOT NULL,
  `full_name` varchar(256) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_naissance` date DEFAULT NULL,
  `sexe` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `matricule_cnps` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pays` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Côte d''ivoire',
  `id_commune` int DEFAULT NULL,
  `lieux_residence` varchar(256) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_user` (`id_user`),
  UNIQUE KEY `matricule_cnps` (`matricule_cnps`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `retraites`
--

INSERT INTO `retraites` (`id`, `id_user`, `full_name`, `date_naissance`, `sexe`, `matricule_cnps`, `pays`, `id_commune`, `lieux_residence`, `photo`, `created_at`, `updated_at`) VALUES
(1, 10, 'paulin nene', '1969-06-11', 'Homme', 'gfhjgu4654655vfzq', 'Côte d\'ivoire', 10, 'songon, rue menusier', NULL, NULL, '2024-09-08 04:26:37');

-- --------------------------------------------------------

--
-- Structure de la table `roles`
--

DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `roles`
--

INSERT INTO `roles` (`id`, `role`) VALUES
(1, 'admin'),
(2, 'supperviseur'),
(3, 'gestionnaire');

-- --------------------------------------------------------

--
-- Structure de la table `salaries`
--

DROP TABLE IF EXISTS `salaries`;
CREATE TABLE IF NOT EXISTS `salaries` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_user` int NOT NULL,
  `full_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_naissance` date DEFAULT NULL,
  `sexe` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `matricule_cnps` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `employeur` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_employeur` int DEFAULT NULL,
  `date_embauche` date DEFAULT NULL,
  `date_immatriculation` date DEFAULT NULL,
  `poste` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `salaire` int DEFAULT NULL,
  `pays` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT 'Côte d''ivoire',
  `id_commune` int DEFAULT NULL,
  `lieux_residence` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `salaries`
--

INSERT INTO `salaries` (`id`, `id_user`, `full_name`, `date_naissance`, `sexe`, `matricule_cnps`, `employeur`, `id_employeur`, `date_embauche`, `date_immatriculation`, `poste`, `salaire`, `pays`, `id_commune`, `lieux_residence`, `photo`, `created_at`, `updated_at`) VALUES
(1, 14, 'ange debordo', '2024-09-14', 'Homme', 'salarie4586936', NULL, 2, '2024-09-04', '2024-09-04', 'comptable', 250000, 'Côte d\'ivoire', 3, 'gangstone', 'http://127.0.0.1:8080/storage/images/photo-profil/salaries/pp_user_14_66e02fea89dfd.png', NULL, '2024-09-10 11:39:22');

-- --------------------------------------------------------

--
-- Structure de la table `services`
--

DROP TABLE IF EXISTS `services`;
CREATE TABLE IF NOT EXISTS `services` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `titre` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_regime` int NOT NULL,
  `id_groupe_service` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `services`
--

INSERT INTO `services` (`id`, `titre`, `description`, `id_regime`, `id_groupe_service`, `created_at`, `updated_at`) VALUES
(1, 'service independant', 'Résolvez les vulnérabilités :\r\n\r\nExécutez npm audit pour voir les détails des vulnérabilités.\r\nUtilisez npm audit fix pour résoudre automatiquement les problèmes non critiques.\r\nVérifiez les dépendances obsolètes :\r\n\r\nConsultez la documentation des packages obsolètes pour trouver des alternatives ou des mises à jour recommandées.', 3, 3, NULL, NULL),
(2, 'service employeur', '1102\r\nExécutez npm audit pour voir les détails des vulnérabilités.\r\nUtilisez npm audit fix pour résoudre automatiquement les problèmes non critiques.\r\nVérifiez les dépendances obsolètes :\r\n\r\nConsultez la documentation des packages obsolètes pour trouver des alternatives ou des mises à jour recommandées.', 1, 1, NULL, NULL),
(3, 'service employeur 77', 'automatiquement les problèmes non critiques.\r\nVérifiez les dépendances obsolètes :\r\n\r\nConsultez la documentation des packages obsolètes pour trouver des alternatives ou des mises à jour recommandées.', 1, 1, NULL, NULL),
(5, 'service test', 'rtnghjemhsohs', 2, 2, '2024-09-11 23:50:16', '2024-09-11 23:50:16'),
(7, 'a suprimer et à modifie \'gt de slug', 'bdtjnfhjfhjuykrfjut', 4, 3, '2024-09-12 00:11:51', '2024-09-12 00:11:51'),
(9, 'SERVCE DETEST PRIMAIRE', 'azertyuiopmlkjhgfsqwxvbn', 4, 2, '2024-09-18 22:57:42', '2024-09-18 22:57:42');

-- --------------------------------------------------------

--
-- Structure de la table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
CREATE TABLE IF NOT EXISTS `sessions` (
  `id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('nQMgQ5xGakbe5kajMjSEiklBr0mox5jVYdwYwP7u', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/128.0.0.0 Safari/537.36 Avast/128.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiS1JZODdvUXlGeksxeENaSFB5YVR1bVlQb2N3c1lEY3NGMmFRRGh3USI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NTI6Imh0dHA6Ly8xMjcuMC4wLjE6ODA4MC9kb3NzaWVycy1jbnBzL2VtcGxveWV1cnMtMS1kc3IiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1726928940);

-- --------------------------------------------------------

--
-- Structure de la table `situation_matrimonials`
--

DROP TABLE IF EXISTS `situation_matrimonials`;
CREATE TABLE IF NOT EXISTS `situation_matrimonials` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_user` int NOT NULL,
  `situation` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lieu_mariage` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_mariage` date DEFAULT NULL,
  `nombre_enfant` int DEFAULT NULL,
  `nom_conjoint` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_user` (`id_user`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `situation_matrimonials`
--

INSERT INTO `situation_matrimonials` (`id`, `id_user`, `situation`, `lieu_mariage`, `date_mariage`, `nombre_enfant`, `nom_conjoint`, `created_at`, `updated_at`) VALUES
(1, 14, 'Marié(e)', 'Paris', '2022-06-15', 2, 'Jean Dupont', NULL, NULL),
(2, 10, 'Marié(e)', 'allocodrome de cocody', '2021-08-22', 3, 'sandrine mobio', NULL, '2024-09-08 17:53:46'),
(4, 12, 'Marié(e)', 'babi', '2024-01-22', 0, 'jacqueline', NULL, NULL),
(5, 22, 'Marié(e)', NULL, NULL, NULL, NULL, NULL, NULL),
(6, 7, 'Célibataire', 'aucun', NULL, 1, 'aucun', '2024-09-08 17:42:36', '2024-09-08 17:50:15');

-- --------------------------------------------------------

--
-- Structure de la table `souscrire_packages`
--

DROP TABLE IF EXISTS `souscrire_packages`;
CREATE TABLE IF NOT EXISTS `souscrire_packages` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_user` int NOT NULL,
  `id_groupe_service` int NOT NULL,
  `status` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `souscrire_packages`
--

INSERT INTO `souscrire_packages` (`id`, `id_user`, `id_groupe_service`, `status`, `created_at`, `updated_at`) VALUES
(1, 14, 2, 'demande', '2024-09-21 10:20:21', '2024-09-21 10:20:21'),
(2, 12, 3, 'demande', '2024-09-21 10:20:42', '2024-09-21 10:20:42'),
(3, 9, 1, 'sous contrat', '2024-09-21 10:20:55', '2024-09-21 14:13:12'),
(4, 10, 3, 'demande', '2024-09-21 10:21:07', '2024-09-21 10:21:07');

-- --------------------------------------------------------

--
-- Structure de la table `status_matrimonials`
--

DROP TABLE IF EXISTS `status_matrimonials`;
CREATE TABLE IF NOT EXISTS `status_matrimonials` (
  `id` int NOT NULL AUTO_INCREMENT,
  `status_matrimonial` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `status_matrimonials`
--

INSERT INTO `status_matrimonials` (`id`, `status_matrimonial`) VALUES
(1, 'Célibataire'),
(2, 'Marié(e)'),
(3, 'Divorcé(e)'),
(4, 'Veuf/Veuve');

-- --------------------------------------------------------

--
-- Structure de la table `supperviseurs_gestionnaires`
--

DROP TABLE IF EXISTS `supperviseurs_gestionnaires`;
CREATE TABLE IF NOT EXISTS `supperviseurs_gestionnaires` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_supperviseur` int NOT NULL,
  `id_gestionnaire` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `supperviseurs_gestionnaires_id_gestionnaire_unique` (`id_gestionnaire`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_regime` int NOT NULL,
  `telephone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_telephone_unique` (`telephone`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `id_regime`, `telephone`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 2, '0768356482', 'mael@gmail.com', NULL, '$2y$12$tSZHf6rjzB/Z5Ro5tXxQf.AszCmwNZ6fORvzvCfXE3PRxEBLqVJPK', NULL, '2024-08-17 14:12:34', '2024-08-17 14:12:34'),
(2, 1, '0768356480', 'maeln@gmail.com', NULL, '$2y$12$n3q40lx5PC7YuWU4rhrZB.slLS1xiP2HIJOA.qbBQZYvspBsQWd8q', NULL, '2024-08-17 14:52:37', '2024-08-17 14:52:37'),
(7, 3, '0105050504', 'indzola778@gmail.com', NULL, '$2y$12$IlkYF69Y1YFD8elt4sXLNeY3h4hSUc8WILXVXI.Gtabi4YqFMUqym', NULL, '2024-08-19 02:42:43', '2024-09-08 04:17:30'),
(8, 1, '0102030506', 'visiotech@gmail.com', NULL, '$2y$12$SmBXdKh3BJ3kQjk8zzvUnOz4VpXfnFkYsniV5nzm5pviABN2moSzG', NULL, '2024-08-19 02:43:55', '2024-09-08 04:50:35'),
(9, 1, '0201020103', 'socoprix01@gmail.com', NULL, '$2y$12$IdyGuyJyNVCl4QjyW.eqVudSzkcrUt2Kz0FzPPavkh11AjwSdPmQK', NULL, '2024-08-19 02:44:44', '2024-09-08 02:43:36'),
(10, 4, '0789632185', 'paulinnene@gmail.com', NULL, '$2y$12$voEVsm3JC5E3QRfQJkOGEunjcSamGXJLs2So1nnF1hMxdu8y9v8Ae', NULL, '2024-08-19 10:41:02', '2024-09-08 04:26:37'),
(11, 1, '0101010203', 'ytr@gmail.com', NULL, '$2y$12$gWVYnJewGh799/lQz3WKGOLZJUi8cgmJ9YWegSLyHvt2RZzRMolIG', NULL, '2024-08-24 13:05:04', '2024-08-24 13:05:04'),
(12, 3, '0101010273', 'ygtr@gmail.com', NULL, '$2y$12$wJWUX6TOwVRg/y6DgzSrLeKBVcxRs6mtdKSlnwlZro4u709I3n9SC', NULL, '2024-08-24 13:05:58', '2024-09-08 04:53:20'),
(14, 2, '0707070805', 'angedebordo@gmail.com', NULL, '$2y$12$v0.bEtAaDa1hGIUZrxI7KOUGkCcUZRp2Nf8/AjTozOL5r9AjMnmCu', NULL, '2024-08-24 13:25:08', '2024-09-08 13:24:11');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
