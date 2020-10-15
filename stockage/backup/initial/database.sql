-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : jeu. 15 oct. 2020 à 15:10
-- Version du serveur :  5.7.19
-- Version de PHP : 7.1.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `chantier`
--

-- --------------------------------------------------------

--
-- Structure de la table `acces_agence`
--

CREATE TABLE `acces_agence` (
  `id` int(11) NOT NULL,
  `agence_id` int(11) NOT NULL,
  `employe_id` int(11) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `protected` int(11) NOT NULL DEFAULT '0',
  `valide` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Structure de la table `acces_chantier`
--

CREATE TABLE `acces_chantier` (
  `id` int(11) NOT NULL,
  `chantier_id` int(11) NOT NULL,
  `employe_id` int(11) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `protected` int(11) NOT NULL DEFAULT '0',
  `valide` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Structure de la table `achatstock`
--

CREATE TABLE `achatstock` (
  `id` int(11) NOT NULL,
  `reference` varchar(50) COLLATE utf8_bin NOT NULL,
  `agence_id` int(11) DEFAULT NULL,
  `montant` int(11) NOT NULL,
  `avance` int(11) DEFAULT NULL,
  `transport` int(11) DEFAULT NULL,
  `fournisseur_id` int(11) NOT NULL,
  `etat_id` int(11) NOT NULL,
  `datelivraison` datetime DEFAULT NULL,
  `comment` text COLLATE utf8_bin,
  `acompteFournisseur` int(11) DEFAULT NULL,
  `detteFournisseur` int(11) DEFAULT NULL,
  `employe_id` int(11) NOT NULL,
  `employe_id_reception` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `protected` int(11) NOT NULL DEFAULT '0',
  `valide` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Structure de la table `agence`
--

CREATE TABLE `agence` (
  `id` int(11) NOT NULL,
  `name` varchar(200) COLLATE utf8_bin NOT NULL,
  `lieu` varchar(200) COLLATE utf8_bin DEFAULT NULL,
  `comptebanque_id` int(11) DEFAULT '0',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `protected` int(11) NOT NULL DEFAULT '0',
  `valide` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Structure de la table `approchantiermateriel`
--

CREATE TABLE `approchantiermateriel` (
  `id` int(11) NOT NULL,
  `reference` varchar(20) COLLATE utf8_bin NOT NULL,
  `chantier_id` int(11) DEFAULT NULL,
  `montant` int(11) NOT NULL,
  `avance` int(11) NOT NULL,
  `transport` int(11) NOT NULL,
  `fournisseurchantier_id` int(11) NOT NULL,
  `etat_id` int(11) NOT NULL,
  `datelivraison` datetime DEFAULT NULL,
  `comment` text COLLATE utf8_bin,
  `acompteFournisseur` int(11) DEFAULT NULL,
  `detteFournisseur` int(11) DEFAULT NULL,
  `employe_id` int(11) NOT NULL,
  `employe_id_reception` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `protected` int(11) NOT NULL DEFAULT '0',
  `valide` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Structure de la table `approchantierproduit`
--

CREATE TABLE `approchantierproduit` (
  `id` int(11) NOT NULL,
  `reference` varchar(20) COLLATE utf8_bin NOT NULL,
  `chantier_id` int(11) DEFAULT NULL,
  `montant` int(11) NOT NULL,
  `avance` int(11) NOT NULL,
  `transport` int(11) NOT NULL,
  `fournisseurchantier_id` int(11) NOT NULL,
  `etat_id` int(11) NOT NULL,
  `datelivraison` datetime DEFAULT NULL,
  `comment` text COLLATE utf8_bin,
  `acompteFournisseur` int(11) DEFAULT NULL,
  `detteFournisseur` int(11) DEFAULT NULL,
  `employe_id` int(11) NOT NULL,
  `employe_id_reception` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `protected` int(11) NOT NULL DEFAULT '0',
  `valide` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Structure de la table `approchantierressource`
--

CREATE TABLE `approchantierressource` (
  `id` int(11) NOT NULL,
  `reference` varchar(20) COLLATE utf8_bin NOT NULL,
  `chantier_id` int(11) DEFAULT NULL,
  `montant` int(11) NOT NULL,
  `avance` int(11) NOT NULL,
  `transport` int(11) NOT NULL,
  `fournisseurchantier_id` int(11) NOT NULL,
  `etat_id` int(11) NOT NULL,
  `datelivraison` datetime DEFAULT NULL,
  `comment` text COLLATE utf8_bin,
  `acompteFournisseur` int(11) DEFAULT NULL,
  `detteFournisseur` int(11) DEFAULT NULL,
  `employe_id` int(11) NOT NULL,
  `employe_id_reception` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `protected` int(11) NOT NULL DEFAULT '0',
  `valide` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Structure de la table `approvisionnement`
--

CREATE TABLE `approvisionnement` (
  `id` int(11) NOT NULL,
  `reference` varchar(20) COLLATE utf8_bin NOT NULL,
  `agence_id` int(11) DEFAULT NULL,
  `montant` int(11) NOT NULL,
  `avance` int(11) NOT NULL,
  `transport` int(11) NOT NULL,
  `fournisseur_id` int(11) NOT NULL,
  `etat_id` int(11) NOT NULL,
  `datelivraison` datetime DEFAULT NULL,
  `comment` text COLLATE utf8_bin,
  `acompteFournisseur` int(11) DEFAULT NULL,
  `detteFournisseur` int(11) DEFAULT NULL,
  `employe_id` int(11) NOT NULL,
  `employe_id_reception` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `protected` int(11) NOT NULL DEFAULT '0',
  `valide` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Structure de la table `budgetchantier`
--

CREATE TABLE `budgetchantier` (
  `id` int(11) NOT NULL,
  `name` varchar(200) COLLATE utf8_bin NOT NULL,
  `solde` int(11) NOT NULL DEFAULT '0',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `protected` int(11) NOT NULL DEFAULT '0',
  `valide` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Structure de la table `categorieoperation`
--

CREATE TABLE `categorieoperation` (
  `id` int(11) NOT NULL,
  `typeoperationcaisse_id` int(11) NOT NULL,
  `name` varchar(200) COLLATE utf8_bin NOT NULL,
  `color` varchar(10) COLLATE utf8_bin DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `protected` int(11) NOT NULL DEFAULT '0',
  `valide` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Structure de la table `categorieoperationchantier`
--

CREATE TABLE `categorieoperationchantier` (
  `id` int(11) NOT NULL,
  `typeoperationcaisse_id` int(11) NOT NULL,
  `name` varchar(200) COLLATE utf8_bin NOT NULL,
  `color` varchar(10) COLLATE utf8_bin DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `protected` int(11) NOT NULL DEFAULT '0',
  `valide` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Structure de la table `chantier`
--

CREATE TABLE `chantier` (
  `id` int(11) NOT NULL,
  `name` varchar(200) COLLATE utf8_bin NOT NULL,
  `lieu` varchar(200) COLLATE utf8_bin DEFAULT NULL,
  `autorisation` varchar(200) COLLATE utf8_bin DEFAULT NULL,
  `started` date DEFAULT NULL,
  `finished` date DEFAULT NULL,
  `previsionnel` int(11) NOT NULL DEFAULT '0',
  `budgetchantier_id` int(11) DEFAULT '0',
  `comment` longtext COLLATE utf8_bin,
  `etatchantier_id` int(11) NOT NULL DEFAULT '0',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `protected` int(11) NOT NULL DEFAULT '0',
  `valide` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Structure de la table `chauffeur`
--

CREATE TABLE `chauffeur` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `adresse` varchar(150) DEFAULT NULL,
  `contact` varchar(200) DEFAULT NULL,
  `image` varchar(50) DEFAULT NULL,
  `disponibilite_id` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `protected` int(11) NOT NULL DEFAULT '0',
  `valide` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `client`
--

CREATE TABLE `client` (
  `id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8_bin NOT NULL,
  `typeclient_id` int(2) NOT NULL,
  `agence_id` int(2) NOT NULL,
  `adresse` varchar(150) COLLATE utf8_bin DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `contact` varchar(200) COLLATE utf8_bin DEFAULT NULL,
  `acompte` int(11) DEFAULT NULL,
  `dette` int(11) NOT NULL,
  `seuilCredit` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `protected` int(11) NOT NULL DEFAULT '0',
  `valide` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Structure de la table `clientchantier`
--

CREATE TABLE `clientchantier` (
  `id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8_bin NOT NULL,
  `email` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `contact` varchar(200) COLLATE utf8_bin DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `protected` int(11) NOT NULL DEFAULT '0',
  `valide` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Structure de la table `commande`
--

CREATE TABLE `commande` (
  `id` int(11) NOT NULL,
  `reference` varchar(20) COLLATE utf8_bin NOT NULL,
  `agence_id` int(11) NOT NULL,
  `groupecommande_id` int(20) NOT NULL,
  `montant` int(11) NOT NULL,
  `avance` int(11) NOT NULL,
  `zonelivraison_id` int(11) NOT NULL,
  `lieu` varchar(200) COLLATE utf8_bin NOT NULL,
  `taux_tva` int(11) DEFAULT NULL,
  `tva` int(11) DEFAULT NULL,
  `datelivraison` date NOT NULL,
  `employe_id` int(11) NOT NULL,
  `etat_id` int(11) NOT NULL,
  `comment` text COLLATE utf8_bin,
  `acompteClient` int(11) NOT NULL,
  `detteClient` int(11) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `protected` int(11) NOT NULL DEFAULT '0',
  `valide` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Structure de la table `comptebanque`
--

CREATE TABLE `comptebanque` (
  `id` int(11) NOT NULL,
  `name` varchar(200) COLLATE utf8_bin NOT NULL,
  `initial` int(11) NOT NULL DEFAULT '0',
  `numero` varchar(50) COLLATE utf8_bin DEFAULT '0',
  `etablissement` varchar(100) COLLATE utf8_bin DEFAULT '0',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `protected` int(11) NOT NULL DEFAULT '0',
  `valide` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Structure de la table `connexion`
--

CREATE TABLE `connexion` (
  `id` int(11) NOT NULL,
  `date_connexion` datetime DEFAULT NULL,
  `date_deconnexion` timestamp NULL DEFAULT NULL,
  `employe_id` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `protected` int(11) NOT NULL DEFAULT '1',
  `valide` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Structure de la table `depotproduit`
--

CREATE TABLE `depotproduit` (
  `id` int(11) NOT NULL,
  `agence_id` int(11) DEFAULT NULL,
  `reference` varchar(40) COLLATE utf8_bin DEFAULT NULL,
  `chantier_id` int(11) DEFAULT NULL,
  `lieu` varchar(200) COLLATE utf8_bin DEFAULT NULL,
  `vehicule_id` int(11) DEFAULT NULL,
  `chauffeur_id` int(11) DEFAULT NULL,
  `etat_id` int(11) NOT NULL,
  `employe_id` int(11) DEFAULT NULL,
  `datelivraison` datetime DEFAULT NULL,
  `comment` text COLLATE utf8_bin,
  `nom_receptionniste` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `contact_receptionniste` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `protected` int(11) NOT NULL DEFAULT '0',
  `valide` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Structure de la table `depotressource`
--

CREATE TABLE `depotressource` (
  `id` int(11) NOT NULL,
  `agence_id` int(11) DEFAULT NULL,
  `reference` varchar(40) COLLATE utf8_bin DEFAULT NULL,
  `chantier_id` int(11) DEFAULT NULL,
  `lieu` varchar(200) COLLATE utf8_bin DEFAULT NULL,
  `vehicule_id` int(11) DEFAULT NULL,
  `chauffeur_id` int(11) DEFAULT NULL,
  `etat_id` int(11) NOT NULL,
  `employe_id` int(11) DEFAULT NULL,
  `datelivraison` datetime DEFAULT NULL,
  `comment` text COLLATE utf8_bin,
  `chargement` varchar(5) COLLATE utf8_bin DEFAULT NULL,
  `dechargement` varchar(5) COLLATE utf8_bin DEFAULT NULL,
  `nom_receptionniste` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `contact_receptionniste` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `protected` int(11) NOT NULL DEFAULT '0',
  `valide` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Structure de la table `disponibilite`
--

CREATE TABLE `disponibilite` (
  `id` int(11) NOT NULL,
  `name` varchar(200) COLLATE utf8_bin NOT NULL,
  `class` varchar(50) COLLATE utf8_bin NOT NULL,
  `protected` int(11) NOT NULL DEFAULT '1',
  `valide` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Structure de la table `documentchantier`
--

CREATE TABLE `documentchantier` (
  `id` int(11) NOT NULL,
  `chantier_id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8_bin NOT NULL,
  `image` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `protected` int(11) NOT NULL DEFAULT '0',
  `valide` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Structure de la table `employe`
--

CREATE TABLE `employe` (
  `id` int(11) NOT NULL,
  `agence_id` int(11) DEFAULT '0',
  `name` varchar(50) COLLATE utf8_bin NOT NULL,
  `adresse` varchar(150) COLLATE utf8_bin DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `contact` varchar(200) COLLATE utf8_bin DEFAULT NULL,
  `login` varchar(50) COLLATE utf8_bin NOT NULL,
  `password` text COLLATE utf8_bin NOT NULL,
  `image` varchar(50) COLLATE utf8_bin NOT NULL,
  `is_new` int(11) NOT NULL DEFAULT '0',
  `is_allowed` int(11) NOT NULL DEFAULT '1',
  `pass` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `protected` int(11) NOT NULL DEFAULT '0',
  `valide` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Structure de la table `etat`
--

CREATE TABLE `etat` (
  `id` int(11) NOT NULL,
  `name` varchar(200) COLLATE utf8_bin NOT NULL,
  `class` varchar(50) COLLATE utf8_bin NOT NULL,
  `protected` int(11) NOT NULL DEFAULT '1',
  `valide` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Structure de la table `etatchantier`
--

CREATE TABLE `etatchantier` (
  `id` int(11) NOT NULL,
  `name` varchar(200) COLLATE utf8_bin NOT NULL,
  `class` varchar(50) COLLATE utf8_bin NOT NULL,
  `protected` int(11) NOT NULL DEFAULT '1',
  `valide` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Structure de la table `etatchauffeur`
--

CREATE TABLE `etatchauffeur` (
  `id` int(11) NOT NULL,
  `name` varchar(200) COLLATE utf8_bin NOT NULL,
  `class` varchar(50) COLLATE utf8_bin NOT NULL,
  `protected` int(11) NOT NULL DEFAULT '1',
  `valide` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Structure de la table `etatvehicule`
--

CREATE TABLE `etatvehicule` (
  `id` int(11) NOT NULL,
  `name` varchar(200) COLLATE utf8_bin NOT NULL,
  `class` varchar(50) COLLATE utf8_bin NOT NULL,
  `protected` int(11) NOT NULL DEFAULT '1',
  `valide` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Structure de la table `exercicecomptable`
--

CREATE TABLE `exercicecomptable` (
  `id` int(11) NOT NULL,
  `datefin` datetime DEFAULT NULL,
  `etat_id` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `protected` int(11) NOT NULL DEFAULT '0',
  `valide` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Structure de la table `exigenceproduction`
--

CREATE TABLE `exigenceproduction` (
  `id` int(11) NOT NULL,
  `produit_id` int(20) NOT NULL,
  `quantite` float NOT NULL DEFAULT '0',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `protected` int(11) NOT NULL DEFAULT '0',
  `valide` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Structure de la table `fournisseur`
--

CREATE TABLE `fournisseur` (
  `id` int(11) NOT NULL,
  `agence_id` int(11) NOT NULL,
  `name` varchar(200) COLLATE utf8_bin NOT NULL,
  `contact` varchar(150) COLLATE utf8_bin NOT NULL,
  `email` text COLLATE utf8_bin,
  `adresse` text COLLATE utf8_bin NOT NULL,
  `image` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `description` text COLLATE utf8_bin,
  `acompte` int(11) NOT NULL,
  `dette` int(11) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `protected` int(11) NOT NULL DEFAULT '0',
  `valide` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Structure de la table `fournisseurchantier`
--

CREATE TABLE `fournisseurchantier` (
  `id` int(11) NOT NULL,
  `chantier_id` int(11) NOT NULL,
  `name` varchar(200) COLLATE utf8_bin NOT NULL,
  `contact` varchar(150) COLLATE utf8_bin NOT NULL,
  `email` text COLLATE utf8_bin,
  `adresse` text COLLATE utf8_bin NOT NULL,
  `image` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `description` text COLLATE utf8_bin,
  `acompte` int(11) NOT NULL,
  `dette` int(11) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `protected` int(11) NOT NULL DEFAULT '0',
  `valide` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Structure de la table `groupecommande`
--

CREATE TABLE `groupecommande` (
  `id` int(11) NOT NULL,
  `client_id` int(20) NOT NULL,
  `agence_id` int(20) NOT NULL,
  `etat_id` int(11) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `protected` int(11) NOT NULL DEFAULT '0',
  `valide` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Structure de la table `history`
--

CREATE TABLE `history` (
  `id` int(11) NOT NULL,
  `sentense` text COLLATE utf8_bin NOT NULL,
  `typeSave` varchar(50) COLLATE utf8_bin NOT NULL,
  `record` varchar(200) COLLATE utf8_bin NOT NULL,
  `employe_id` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `protected` int(11) NOT NULL DEFAULT '1',
  `valide` int(11) NOT NULL DEFAULT '1',
  `recordId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Structure de la table `imagechantier`
--

CREATE TABLE `imagechantier` (
  `id` int(11) NOT NULL,
  `chantier_id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8_bin NOT NULL,
  `image` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `protected` int(11) NOT NULL DEFAULT '0',
  `valide` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Structure de la table `initialmaterielchantier`
--

CREATE TABLE `initialmaterielchantier` (
  `id` int(11) NOT NULL,
  `chantier_id` int(11) NOT NULL,
  `materiel_id` int(11) NOT NULL,
  `quantite` int(11) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `protected` int(11) NOT NULL DEFAULT '0',
  `valide` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Structure de la table `initialproduitagence`
--

CREATE TABLE `initialproduitagence` (
  `id` int(11) NOT NULL,
  `agence_id` int(11) NOT NULL,
  `produit_id` int(11) NOT NULL,
  `quantite` int(11) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `protected` int(11) NOT NULL DEFAULT '0',
  `valide` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Structure de la table `initialproduitchantier`
--

CREATE TABLE `initialproduitchantier` (
  `id` int(11) NOT NULL,
  `chantier_id` int(11) NOT NULL,
  `produit_id` int(11) NOT NULL,
  `quantite` int(11) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `protected` int(11) NOT NULL DEFAULT '0',
  `valide` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Structure de la table `initialressourceagence`
--

CREATE TABLE `initialressourceagence` (
  `id` int(11) NOT NULL,
  `agence_id` int(11) NOT NULL,
  `ressource_id` int(11) NOT NULL,
  `quantite` int(11) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `protected` int(11) NOT NULL DEFAULT '0',
  `valide` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Structure de la table `initialressourcechantier`
--

CREATE TABLE `initialressourcechantier` (
  `id` int(11) NOT NULL,
  `chantier_id` int(11) NOT NULL,
  `ressource_id` int(11) NOT NULL,
  `quantite` int(11) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `protected` int(11) NOT NULL DEFAULT '0',
  `valide` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Structure de la table `ligneachatstock`
--

CREATE TABLE `ligneachatstock` (
  `id` int(11) NOT NULL,
  `achatstock_id` int(11) NOT NULL,
  `produit_id` int(11) NOT NULL,
  `quantite` float NOT NULL,
  `quantite_recu` float NOT NULL,
  `price` int(11) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `protected` int(11) NOT NULL DEFAULT '0',
  `valide` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Structure de la table `ligneapprochantiermateriel`
--

CREATE TABLE `ligneapprochantiermateriel` (
  `id` int(11) NOT NULL,
  `approchantiermateriel_id` int(11) NOT NULL,
  `materiel_id` int(11) NOT NULL,
  `quantite` float NOT NULL,
  `quantite_recu` float NOT NULL,
  `price` int(11) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `protected` int(11) NOT NULL DEFAULT '0',
  `valide` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Structure de la table `ligneapprochantierproduit`
--

CREATE TABLE `ligneapprochantierproduit` (
  `id` int(11) NOT NULL,
  `approchantierproduit_id` int(11) NOT NULL,
  `produit_id` int(11) NOT NULL,
  `quantite` float NOT NULL,
  `quantite_recu` float NOT NULL,
  `price` int(11) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `protected` int(11) NOT NULL DEFAULT '0',
  `valide` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Structure de la table `ligneapprochantierressource`
--

CREATE TABLE `ligneapprochantierressource` (
  `id` int(11) NOT NULL,
  `approchantierressource_id` int(11) NOT NULL,
  `ressource_id` int(11) NOT NULL,
  `quantite` float NOT NULL,
  `quantite_recu` float NOT NULL,
  `price` int(11) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `protected` int(11) NOT NULL DEFAULT '0',
  `valide` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Structure de la table `ligneapprovisionnement`
--

CREATE TABLE `ligneapprovisionnement` (
  `id` int(11) NOT NULL,
  `approvisionnement_id` int(11) NOT NULL,
  `ressource_id` int(11) NOT NULL,
  `quantite` float NOT NULL,
  `quantite_recu` float NOT NULL,
  `price` int(11) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `protected` int(11) NOT NULL DEFAULT '0',
  `valide` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Structure de la table `lignecommande`
--

CREATE TABLE `lignecommande` (
  `id` int(11) NOT NULL,
  `commande_id` int(11) NOT NULL,
  `produit_id` int(11) NOT NULL,
  `quantite` int(11) NOT NULL,
  `price` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `protected` int(11) NOT NULL DEFAULT '0',
  `valide` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Structure de la table `ligneconsommation`
--

CREATE TABLE `ligneconsommation` (
  `id` int(11) NOT NULL,
  `production_id` int(11) NOT NULL,
  `ressource_id` int(11) NOT NULL,
  `quantite` float NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `protected` int(11) NOT NULL DEFAULT '0',
  `valide` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Structure de la table `ligneconsommationchantier`
--

CREATE TABLE `ligneconsommationchantier` (
  `id` int(11) NOT NULL,
  `productionchantier_id` int(11) NOT NULL,
  `ressource_id` int(11) NOT NULL,
  `quantite` float NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `protected` int(11) NOT NULL DEFAULT '0',
  `valide` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Structure de la table `lignedepotproduit`
--

CREATE TABLE `lignedepotproduit` (
  `id` int(11) NOT NULL,
  `depotproduit_id` int(11) NOT NULL,
  `produit_id` int(11) NOT NULL,
  `quantite_depart` int(11) DEFAULT NULL,
  `quantite` int(11) DEFAULT NULL,
  `perte` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `protected` int(11) NOT NULL DEFAULT '0',
  `valide` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Structure de la table `lignedepotressource`
--

CREATE TABLE `lignedepotressource` (
  `id` int(11) NOT NULL,
  `depotressource_id` int(11) NOT NULL,
  `ressource_id` int(11) NOT NULL,
  `quantite_depart` int(11) DEFAULT NULL,
  `quantite` int(11) DEFAULT NULL,
  `perte` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `protected` int(11) NOT NULL DEFAULT '0',
  `valide` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Structure de la table `lignedevente`
--

CREATE TABLE `lignedevente` (
  `id` int(11) NOT NULL,
  `transfertstock_id` int(11) NOT NULL,
  `produit_id` int(11) NOT NULL,
  `quantite` int(11) NOT NULL,
  `quantite2` int(11) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `protected` int(11) NOT NULL DEFAULT '0',
  `valide` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Structure de la table `ligneexigenceproduction`
--

CREATE TABLE `ligneexigenceproduction` (
  `id` int(11) NOT NULL,
  `exigenceproduction_id` int(20) NOT NULL,
  `ressource_id` int(11) NOT NULL,
  `quantite` float NOT NULL DEFAULT '0',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `protected` int(11) NOT NULL DEFAULT '0',
  `valide` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Structure de la table `lignelivraison`
--

CREATE TABLE `lignelivraison` (
  `id` int(11) NOT NULL,
  `livraison_id` int(11) NOT NULL,
  `produit_id` int(11) NOT NULL,
  `quantite` int(11) NOT NULL,
  `surplus` int(11) DEFAULT NULL,
  `quantite_livree` int(11) NOT NULL,
  `reste` int(11) NOT NULL,
  `perte` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `protected` int(11) NOT NULL DEFAULT '0',
  `valide` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Structure de la table `lignepayement`
--

CREATE TABLE `lignepayement` (
  `id` int(11) NOT NULL,
  `reference` varchar(20) COLLATE utf8_bin NOT NULL,
  `commercial_id` int(11) NOT NULL,
  `mouvement_id` int(11) NOT NULL,
  `modepayement_id` int(11) NOT NULL,
  `etat_id` int(11) NOT NULL,
  `structure` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `numero` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `comment` text COLLATE utf8_bin,
  `employe_id` int(11) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `protected` int(11) NOT NULL DEFAULT '0',
  `valide` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Structure de la table `ligneperteproduit`
--

CREATE TABLE `ligneperteproduit` (
  `id` int(11) NOT NULL,
  `perteproduit_id` int(11) NOT NULL,
  `produit_id` int(11) DEFAULT NULL,
  `quantite` float NOT NULL DEFAULT '0',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `protected` int(11) NOT NULL DEFAULT '0',
  `valide` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Structure de la table `ligneproduction`
--

CREATE TABLE `ligneproduction` (
  `id` int(11) NOT NULL,
  `production_id` int(11) NOT NULL,
  `produit_id` int(11) NOT NULL,
  `quantite` float NOT NULL DEFAULT '0',
  `perte` float NOT NULL DEFAULT '0',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `protected` int(11) NOT NULL DEFAULT '0',
  `valide` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Structure de la table `ligneproductionchantier`
--

CREATE TABLE `ligneproductionchantier` (
  `id` int(11) NOT NULL,
  `productionchantier_id` int(11) NOT NULL,
  `produit_id` int(11) NOT NULL,
  `quantite` float NOT NULL DEFAULT '0',
  `perte` float NOT NULL DEFAULT '0',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `protected` int(11) NOT NULL DEFAULT '0',
  `valide` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Structure de la table `lignetransfertstock`
--

CREATE TABLE `lignetransfertstock` (
  `id` int(11) NOT NULL,
  `transfertstock_id` int(11) NOT NULL,
  `produit_id` int(11) NOT NULL,
  `quantite_avant` int(11) NOT NULL,
  `quantite_apres` int(11) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `protected` int(11) NOT NULL DEFAULT '0',
  `valide` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Structure de la table `ligneuseproduit`
--

CREATE TABLE `ligneuseproduit` (
  `id` int(11) NOT NULL,
  `useproduit_id` int(11) NOT NULL,
  `produit_id` int(11) NOT NULL,
  `quantite` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `protected` int(11) NOT NULL DEFAULT '0',
  `valide` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Structure de la table `ligneuseressource`
--

CREATE TABLE `ligneuseressource` (
  `id` int(11) NOT NULL,
  `useressource_id` int(11) NOT NULL,
  `ressource_id` int(11) NOT NULL,
  `quantite` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `protected` int(11) NOT NULL DEFAULT '0',
  `valide` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Structure de la table `livraison`
--

CREATE TABLE `livraison` (
  `id` int(11) NOT NULL,
  `agence_id` int(11) DEFAULT NULL,
  `reference` varchar(40) COLLATE utf8_bin DEFAULT NULL,
  `groupecommande_id` int(20) NOT NULL,
  `zonelivraison_id` int(11) DEFAULT NULL,
  `lieu` varchar(200) COLLATE utf8_bin DEFAULT NULL,
  `vehicule_id` int(11) DEFAULT NULL,
  `chauffeur_id` int(11) DEFAULT NULL,
  `etat_id` int(11) NOT NULL,
  `employe_id` int(11) DEFAULT NULL,
  `datelivraison` datetime DEFAULT NULL,
  `comment` text COLLATE utf8_bin,
  `chargement` varchar(5) COLLATE utf8_bin DEFAULT NULL,
  `dechargement` varchar(5) COLLATE utf8_bin DEFAULT NULL,
  `nom_receptionniste` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `contact_receptionniste` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `protected` int(11) NOT NULL DEFAULT '0',
  `valide` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Structure de la table `location`
--

CREATE TABLE `location` (
  `id` int(11) NOT NULL,
  `reference` varchar(40) COLLATE utf8_bin DEFAULT NULL,
  `chantier_id` int(11) DEFAULT NULL,
  `engin` varchar(40) COLLATE utf8_bin DEFAULT NULL,
  `started` datetime DEFAULT NULL,
  `finished` datetime DEFAULT NULL,
  `montant` int(11) NOT NULL,
  `avance` int(11) DEFAULT NULL,
  `etat_id` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `protected` int(11) NOT NULL DEFAULT '0',
  `valide` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Structure de la table `materiel`
--

CREATE TABLE `materiel` (
  `id` int(11) NOT NULL,
  `name` varchar(200) COLLATE utf8_bin NOT NULL,
  `isActive` int(11) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `protected` int(11) NOT NULL DEFAULT '0',
  `valide` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Structure de la table `modepayement`
--

CREATE TABLE `modepayement` (
  `id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8_bin NOT NULL,
  `initial` varchar(3) COLLATE utf8_bin NOT NULL,
  `etat_id` int(11) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `protected` int(11) NOT NULL DEFAULT '0',
  `valide` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Structure de la table `mouvement`
--

CREATE TABLE `mouvement` (
  `id` int(11) NOT NULL,
  `reference` varchar(20) COLLATE utf8_bin NOT NULL,
  `name` varchar(200) COLLATE utf8_bin NOT NULL,
  `typemouvement_id` int(11) NOT NULL,
  `comptebanque_id` int(11) DEFAULT NULL,
  `budgetchantier_id` int(11) DEFAULT NULL,
  `modepayement_id` int(11) DEFAULT '0',
  `structure` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `numero` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `montant` int(11) NOT NULL,
  `comment` text COLLATE utf8_bin,
  `etat_id` int(11) NOT NULL,
  `employe_id` int(11) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `protected` int(11) NOT NULL DEFAULT '0',
  `valide` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Structure de la table `mycompte`
--

CREATE TABLE `mycompte` (
  `id` int(11) NOT NULL,
  `identifiant` varchar(9) COLLATE utf8_bin NOT NULL,
  `tentative` int(11) NOT NULL,
  `expired` datetime NOT NULL,
  `protected` int(11) NOT NULL DEFAULT '1',
  `valide` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Structure de la table `operation`
--

CREATE TABLE `operation` (
  `id` int(11) NOT NULL,
  `reference` varchar(20) COLLATE utf8_bin NOT NULL,
  `agence_id` int(11) DEFAULT NULL,
  `categorieoperation_id` int(11) NOT NULL,
  `montant` int(11) NOT NULL,
  `mouvement_id` int(11) NOT NULL,
  `comment` text COLLATE utf8_bin,
  `employe_id` int(11) NOT NULL,
  `etat_id` int(11) NOT NULL,
  `date_approbation` datetime DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `protected` int(11) NOT NULL DEFAULT '0',
  `valide` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Structure de la table `operationchantier`
--

CREATE TABLE `operationchantier` (
  `id` int(11) NOT NULL,
  `reference` varchar(20) COLLATE utf8_bin NOT NULL,
  `chantier_id` int(11) DEFAULT NULL,
  `categorieoperationchantier_id` int(11) NOT NULL,
  `montant` int(11) NOT NULL,
  `budgetchantier_id` int(11) NOT NULL,
  `comment` text COLLATE utf8_bin,
  `employe_id` int(11) NOT NULL,
  `etat_id` int(11) NOT NULL,
  `date_approbation` datetime DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `protected` int(11) NOT NULL DEFAULT '0',
  `valide` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Structure de la table `params`
--

CREATE TABLE `params` (
  `id` int(11) NOT NULL,
  `societe` varchar(50) COLLATE utf8_bin NOT NULL,
  `email` varchar(200) COLLATE utf8_bin NOT NULL,
  `contact` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `fax` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `devise` varchar(50) COLLATE utf8_bin NOT NULL,
  `tva` int(11) NOT NULL,
  `productionAuto` int(11) NOT NULL,
  `seuilCredit` int(11) NOT NULL,
  `ruptureStock` int(11) NOT NULL,
  `adresse` varchar(200) COLLATE utf8_bin DEFAULT NULL,
  `postale` varchar(200) COLLATE utf8_bin DEFAULT NULL,
  `image` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `autoriserVersementAttente` varchar(11) COLLATE utf8_bin NOT NULL,
  `protected` int(11) NOT NULL DEFAULT '1',
  `valide` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Structure de la table `payeferie_produit`
--

CREATE TABLE `payeferie_produit` (
  `id` int(11) NOT NULL,
  `produit_id` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `price_rangement` int(11) NOT NULL,
  `price_livraison` int(11) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `protected` int(11) NOT NULL DEFAULT '0',
  `valide` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Structure de la table `payementtricycle`
--

CREATE TABLE `payementtricycle` (
  `id` int(11) NOT NULL,
  `agence_id` int(11) DEFAULT NULL,
  `reference` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `tricycle_id` int(11) DEFAULT NULL,
  `mouvement_id` int(11) DEFAULT NULL,
  `montant` int(11) DEFAULT NULL,
  `employe_id` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `protected` int(11) NOT NULL DEFAULT '0',
  `valide` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Structure de la table `paye_produit`
--

CREATE TABLE `paye_produit` (
  `id` int(11) NOT NULL,
  `produit_id` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `price_rangement` int(11) NOT NULL,
  `price_livraison` int(11) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `protected` int(11) NOT NULL DEFAULT '0',
  `valide` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Structure de la table `pertechantiermateriel`
--

CREATE TABLE `pertechantiermateriel` (
  `id` int(11) NOT NULL,
  `chantier_id` int(11) NOT NULL,
  `typeperte_id` int(11) NOT NULL,
  `materiel_id` int(11) NOT NULL,
  `quantite` float NOT NULL,
  `employe_id` int(11) NOT NULL,
  `etat_id` int(11) NOT NULL,
  `comment` text COLLATE utf8_bin,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `protected` int(11) NOT NULL DEFAULT '0',
  `valide` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Structure de la table `pertechantierproduit`
--

CREATE TABLE `pertechantierproduit` (
  `id` int(11) NOT NULL,
  `chantier_id` int(11) NOT NULL,
  `typeperte_id` int(11) NOT NULL,
  `produit_id` int(11) NOT NULL,
  `quantite` float NOT NULL,
  `employe_id` int(11) NOT NULL,
  `etat_id` int(11) NOT NULL,
  `comment` text COLLATE utf8_bin,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `protected` int(11) NOT NULL DEFAULT '0',
  `valide` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Structure de la table `pertechantierressource`
--

CREATE TABLE `pertechantierressource` (
  `id` int(11) NOT NULL,
  `chantier_id` int(11) NOT NULL,
  `typeperte_id` int(11) NOT NULL,
  `ressource_id` int(11) NOT NULL,
  `quantite` float NOT NULL,
  `employe_id` int(11) NOT NULL,
  `etat_id` int(11) NOT NULL,
  `comment` text COLLATE utf8_bin,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `protected` int(11) NOT NULL DEFAULT '0',
  `valide` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Structure de la table `perteentrepot`
--

CREATE TABLE `perteentrepot` (
  `id` int(11) NOT NULL,
  `typeperte_id` int(11) NOT NULL,
  `produit_id` int(11) DEFAULT NULL,
  `ressource_id` int(11) DEFAULT NULL,
  `emballage_id` int(11) DEFAULT NULL,
  `etiquette_id` int(11) DEFAULT NULL,
  `typeproduit_parfum_id` int(11) DEFAULT NULL,
  `quantite` int(11) NOT NULL,
  `entrepot_id` int(11) NOT NULL,
  `employe_id` int(11) NOT NULL,
  `etat_id` int(11) NOT NULL,
  `comment` text COLLATE utf8_bin,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `protected` int(11) NOT NULL DEFAULT '0',
  `valide` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Structure de la table `perteproduit`
--

CREATE TABLE `perteproduit` (
  `id` int(11) NOT NULL,
  `agence_id` int(11) NOT NULL,
  `typeperte_id` int(11) NOT NULL,
  `produit_id` int(11) NOT NULL,
  `quantite` float NOT NULL,
  `employe_id` int(11) NOT NULL,
  `etat_id` int(11) NOT NULL,
  `comment` text COLLATE utf8_bin,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `protected` int(11) NOT NULL DEFAULT '0',
  `valide` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Structure de la table `perteressource`
--

CREATE TABLE `perteressource` (
  `id` int(11) NOT NULL,
  `agence_id` int(11) NOT NULL,
  `typeperte_id` int(11) NOT NULL,
  `ressource_id` int(11) NOT NULL,
  `quantite` float NOT NULL,
  `employe_id` int(11) NOT NULL,
  `etat_id` int(11) NOT NULL,
  `comment` text COLLATE utf8_bin,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `protected` int(11) NOT NULL DEFAULT '0',
  `valide` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Structure de la table `perteressourceagence`
--

CREATE TABLE `perteressourceagence` (
  `id` int(11) NOT NULL,
  `agence_id` int(11) NOT NULL,
  `typeperte_id` int(11) NOT NULL,
  `ressource_id` int(11) DEFAULT NULL,
  `quantite` float NOT NULL DEFAULT '0',
  `employe_id` int(11) NOT NULL,
  `etat_id` int(11) NOT NULL,
  `comment` text COLLATE utf8_bin,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `protected` int(11) NOT NULL DEFAULT '0',
  `valide` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Structure de la table `prix_zonelivraison`
--

CREATE TABLE `prix_zonelivraison` (
  `id` int(11) NOT NULL,
  `produit_id` int(11) NOT NULL,
  `zonelivraison_id` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `protected` int(11) NOT NULL DEFAULT '0',
  `valide` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Structure de la table `production`
--

CREATE TABLE `production` (
  `id` int(11) NOT NULL,
  `agence_id` int(11) NOT NULL,
  `montant_production` int(11) DEFAULT NULL,
  `montant_rangement` int(11) DEFAULT NULL,
  `montant_livraison` int(11) DEFAULT NULL,
  `ladate` date DEFAULT NULL,
  `dateRangement` date DEFAULT NULL,
  `comment` text COLLATE utf8_bin NOT NULL,
  `employe_id` int(11) NOT NULL,
  `employe_id_rangement` int(11) DEFAULT NULL,
  `etat_id` int(11) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `protected` int(11) NOT NULL DEFAULT '0',
  `valide` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Structure de la table `productionchantier`
--

CREATE TABLE `productionchantier` (
  `id` int(11) NOT NULL,
  `chantier_id` int(11) NOT NULL,
  `montant_production` int(11) DEFAULT NULL,
  `montant_rangement` int(11) DEFAULT NULL,
  `montant_livraison` int(11) DEFAULT NULL,
  `ladate` date DEFAULT NULL,
  `dateRangement` date DEFAULT NULL,
  `comment` text COLLATE utf8_bin NOT NULL,
  `employe_id` int(11) NOT NULL,
  `employe_id_rangement` int(11) DEFAULT NULL,
  `etat_id` int(11) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `protected` int(11) NOT NULL DEFAULT '0',
  `valide` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Structure de la table `produit`
--

CREATE TABLE `produit` (
  `id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8_bin NOT NULL DEFAULT '0',
  `comment` text COLLATE utf8_bin,
  `image` varchar(50) COLLATE utf8_bin DEFAULT '0',
  `isActive` int(11) NOT NULL DEFAULT '0',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `protected` int(11) NOT NULL DEFAULT '0',
  `valide` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Structure de la table `reglementclient`
--

CREATE TABLE `reglementclient` (
  `id` int(11) NOT NULL,
  `agence_id` int(11) NOT NULL,
  `reference` varchar(20) COLLATE utf8_bin NOT NULL,
  `client_id` int(11) NOT NULL,
  `commande_id` int(11) DEFAULT NULL,
  `mouvement_id` int(11) DEFAULT NULL,
  `montant` int(11) DEFAULT NULL,
  `comment` text COLLATE utf8_bin,
  `employe_id` int(11) NOT NULL,
  `date_approbation` datetime DEFAULT NULL,
  `etat_id` int(11) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `protected` int(11) NOT NULL DEFAULT '0',
  `valide` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Structure de la table `reglementfournisseur`
--

CREATE TABLE `reglementfournisseur` (
  `id` int(11) NOT NULL,
  `agence_id` int(11) NOT NULL,
  `reference` varchar(20) COLLATE utf8_bin NOT NULL,
  `fournisseur_id` int(11) NOT NULL,
  `approvisionnement_id` int(11) DEFAULT NULL,
  `mouvement_id` int(11) DEFAULT NULL,
  `comment` text COLLATE utf8_bin,
  `montant` int(11) NOT NULL,
  `employe_id` int(11) NOT NULL,
  `acompte` int(11) DEFAULT NULL,
  `dette` int(11) DEFAULT NULL,
  `date_approbation` datetime DEFAULT NULL,
  `etat_id` int(11) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `protected` int(11) NOT NULL DEFAULT '0',
  `valide` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Structure de la table `reglementfournisseurchantier`
--

CREATE TABLE `reglementfournisseurchantier` (
  `id` int(11) NOT NULL,
  `chantier_id` int(11) NOT NULL,
  `reference` varchar(20) COLLATE utf8_bin NOT NULL,
  `approchantierressource_id` int(11) DEFAULT NULL,
  `approchantierproduit_id` int(11) DEFAULT NULL,
  `fournisseurchantier_id` int(11) NOT NULL,
  `mouvement_id` int(11) DEFAULT NULL,
  `comment` text COLLATE utf8_bin,
  `montant` int(11) NOT NULL,
  `employe_id` int(11) NOT NULL,
  `acompte` int(11) DEFAULT NULL,
  `dette` int(11) DEFAULT NULL,
  `date_approbation` datetime DEFAULT NULL,
  `etat_id` int(11) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `protected` int(11) NOT NULL DEFAULT '0',
  `valide` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Structure de la table `ressource`
--

CREATE TABLE `ressource` (
  `id` int(11) NOT NULL,
  `name` varchar(200) COLLATE utf8_bin NOT NULL,
  `unite` varchar(20) COLLATE utf8_bin DEFAULT NULL,
  `abbr` varchar(20) COLLATE utf8_bin NOT NULL,
  `price` float DEFAULT NULL,
  `isActive` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `protected` int(11) NOT NULL DEFAULT '0',
  `valide` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Structure de la table `role`
--

CREATE TABLE `role` (
  `id` int(11) NOT NULL,
  `name` varchar(200) COLLATE utf8_bin NOT NULL,
  `description` text COLLATE utf8_bin,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `protected` int(11) NOT NULL DEFAULT '0',
  `valide` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Structure de la table `role_employe`
--

CREATE TABLE `role_employe` (
  `id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `employe_id` int(11) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `protected` int(11) NOT NULL DEFAULT '0',
  `valide` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Structure de la table `sexe`
--

CREATE TABLE `sexe` (
  `id` int(11) NOT NULL,
  `name` varchar(15) COLLATE utf8_bin NOT NULL,
  `abreviation` varchar(11) COLLATE utf8_bin NOT NULL,
  `icon` varchar(50) COLLATE utf8_bin NOT NULL,
  `protected` int(11) NOT NULL DEFAULT '1',
  `valide` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Structure de la table `tache`
--

CREATE TABLE `tache` (
  `id` int(11) NOT NULL,
  `chantier_id` int(11) DEFAULT NULL,
  `name` varchar(200) COLLATE utf8_bin NOT NULL,
  `tache_id_parent` int(11) DEFAULT NULL,
  `rang` int(11) DEFAULT NULL,
  `duree` int(11) NOT NULL,
  `started` date DEFAULT NULL,
  `finished` datetime DEFAULT NULL,
  `comment` text COLLATE utf8_bin,
  `etatchantier_id` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `protected` int(11) NOT NULL DEFAULT '0',
  `valide` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Structure de la table `transfertfond`
--

CREATE TABLE `transfertfond` (
  `id` int(11) NOT NULL,
  `comptebanque_id_source` int(11) NOT NULL,
  `comptebanque_id_destination` int(11) NOT NULL,
  `montant` int(11) NOT NULL,
  `employe_id` int(11) NOT NULL,
  `comment` text COLLATE utf8_bin,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `protected` int(11) NOT NULL DEFAULT '0',
  `valide` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Structure de la table `transfertstock`
--

CREATE TABLE `transfertstock` (
  `id` int(11) NOT NULL,
  `agence_id` int(11) NOT NULL,
  `reference` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `client_id` int(11) NOT NULL,
  `groupecommande_id` int(11) NOT NULL,
  `groupecommande_id_new` int(11) NOT NULL,
  `employe_id` int(11) NOT NULL,
  `comment` text COLLATE utf8_bin,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `protected` int(11) NOT NULL DEFAULT '0',
  `valide` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Structure de la table `tricycle`
--

CREATE TABLE `tricycle` (
  `id` int(11) NOT NULL,
  `agence_id` int(11) DEFAULT NULL,
  `livraison_id` int(11) DEFAULT NULL,
  `name` varchar(50) COLLATE utf8_bin NOT NULL,
  `contact` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `montant` int(11) DEFAULT NULL,
  `etat_id` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `protected` int(11) NOT NULL DEFAULT '0',
  `valide` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Structure de la table `typeclient`
--

CREATE TABLE `typeclient` (
  `id` int(11) NOT NULL,
  `name` varchar(200) COLLATE utf8_bin NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `protected` int(11) NOT NULL DEFAULT '0',
  `valide` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Structure de la table `typeduree`
--

CREATE TABLE `typeduree` (
  `id` int(11) NOT NULL,
  `name` varchar(200) COLLATE utf8_bin NOT NULL,
  `unite` varchar(200) COLLATE utf8_bin NOT NULL,
  `abbr` varchar(200) COLLATE utf8_bin NOT NULL,
  `isActive` int(11) NOT NULL DEFAULT '0',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `protected` int(11) NOT NULL DEFAULT '0',
  `valide` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Structure de la table `typemouvement`
--

CREATE TABLE `typemouvement` (
  `id` int(11) NOT NULL,
  `name` varchar(200) COLLATE utf8_bin NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `protected` int(11) NOT NULL DEFAULT '0',
  `valide` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Structure de la table `typeoperationcaisse`
--

CREATE TABLE `typeoperationcaisse` (
  `id` int(11) NOT NULL,
  `name` varchar(200) COLLATE utf8_bin NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `protected` int(11) NOT NULL DEFAULT '0',
  `valide` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Structure de la table `typeperte`
--

CREATE TABLE `typeperte` (
  `id` int(11) NOT NULL,
  `name` varchar(200) COLLATE utf8_bin NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `protected` int(11) NOT NULL DEFAULT '0',
  `valide` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Structure de la table `typeproduit`
--

CREATE TABLE `typeproduit` (
  `id` int(11) NOT NULL,
  `name` varchar(200) COLLATE utf8_bin NOT NULL,
  `unite` varchar(200) COLLATE utf8_bin NOT NULL,
  `abbr` varchar(200) COLLATE utf8_bin NOT NULL,
  `isActive` int(11) NOT NULL DEFAULT '0',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `protected` int(11) NOT NULL DEFAULT '0',
  `valide` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Structure de la table `useproduit`
--

CREATE TABLE `useproduit` (
  `id` int(11) NOT NULL,
  `employe_id` int(11) NOT NULL,
  `chantier_id` int(11) NOT NULL,
  `tache_id` int(11) NOT NULL,
  `comment` text COLLATE utf8_bin,
  `etat_id` int(11) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `protected` int(11) NOT NULL DEFAULT '0',
  `valide` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Structure de la table `useressource`
--

CREATE TABLE `useressource` (
  `id` int(11) NOT NULL,
  `employe_id` int(11) NOT NULL,
  `chantier_id` int(11) NOT NULL,
  `tache_id` int(11) NOT NULL,
  `comment` text COLLATE utf8_bin,
  `etat_id` int(11) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `protected` int(11) NOT NULL DEFAULT '0',
  `valide` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Structure de la table `vehicule`
--

CREATE TABLE `vehicule` (
  `id` int(11) NOT NULL,
  `disponibilite_id` int(11) NOT NULL DEFAULT '0',
  `immatriculation` varchar(20) COLLATE utf8_bin NOT NULL,
  `modele` varchar(200) COLLATE utf8_bin NOT NULL,
  `image` text COLLATE utf8_bin,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `protected` int(11) NOT NULL DEFAULT '0',
  `valide` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Structure de la table `versementchantier`
--

CREATE TABLE `versementchantier` (
  `id` int(11) NOT NULL,
  `reference` varchar(50) COLLATE utf8_bin NOT NULL,
  `chantier_id` int(11) NOT NULL,
  `montant` int(11) DEFAULT NULL,
  `comment` text COLLATE utf8_bin,
  `mouvement_id` int(11) DEFAULT NULL,
  `employe_id` int(11) NOT NULL,
  `date_approbation` datetime DEFAULT NULL,
  `etat_id` int(11) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `protected` int(11) NOT NULL DEFAULT '0',
  `valide` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Structure de la table `zonelivraison`
--

CREATE TABLE `zonelivraison` (
  `id` int(11) NOT NULL,
  `name` varchar(200) COLLATE utf8_bin NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `protected` int(11) NOT NULL DEFAULT '0',
  `valide` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin ROW_FORMAT=DYNAMIC;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `acces_agence`
--
ALTER TABLE `acces_agence`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `acces_chantier`
--
ALTER TABLE `acces_chantier`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `achatstock`
--
ALTER TABLE `achatstock`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `agence`
--
ALTER TABLE `agence`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `approchantiermateriel`
--
ALTER TABLE `approchantiermateriel`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `approchantierproduit`
--
ALTER TABLE `approchantierproduit`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `approchantierressource`
--
ALTER TABLE `approchantierressource`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `approvisionnement`
--
ALTER TABLE `approvisionnement`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `budgetchantier`
--
ALTER TABLE `budgetchantier`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `categorieoperation`
--
ALTER TABLE `categorieoperation`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `categorieoperationchantier`
--
ALTER TABLE `categorieoperationchantier`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `chantier`
--
ALTER TABLE `chantier`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `chauffeur`
--
ALTER TABLE `chauffeur`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `clientchantier`
--
ALTER TABLE `clientchantier`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `commande`
--
ALTER TABLE `commande`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `comptebanque`
--
ALTER TABLE `comptebanque`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `connexion`
--
ALTER TABLE `connexion`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `depotproduit`
--
ALTER TABLE `depotproduit`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `depotressource`
--
ALTER TABLE `depotressource`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `disponibilite`
--
ALTER TABLE `disponibilite`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `documentchantier`
--
ALTER TABLE `documentchantier`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `employe`
--
ALTER TABLE `employe`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `etat`
--
ALTER TABLE `etat`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `etatchantier`
--
ALTER TABLE `etatchantier`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `etatchauffeur`
--
ALTER TABLE `etatchauffeur`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `etatvehicule`
--
ALTER TABLE `etatvehicule`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `exercicecomptable`
--
ALTER TABLE `exercicecomptable`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `exigenceproduction`
--
ALTER TABLE `exigenceproduction`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `fournisseur`
--
ALTER TABLE `fournisseur`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `fournisseurchantier`
--
ALTER TABLE `fournisseurchantier`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `groupecommande`
--
ALTER TABLE `groupecommande`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `history`
--
ALTER TABLE `history`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `imagechantier`
--
ALTER TABLE `imagechantier`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `initialmaterielchantier`
--
ALTER TABLE `initialmaterielchantier`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `initialproduitagence`
--
ALTER TABLE `initialproduitagence`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `initialproduitchantier`
--
ALTER TABLE `initialproduitchantier`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `initialressourceagence`
--
ALTER TABLE `initialressourceagence`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `initialressourcechantier`
--
ALTER TABLE `initialressourcechantier`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `ligneachatstock`
--
ALTER TABLE `ligneachatstock`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `ligneapprochantiermateriel`
--
ALTER TABLE `ligneapprochantiermateriel`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `ligneapprochantierproduit`
--
ALTER TABLE `ligneapprochantierproduit`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `ligneapprochantierressource`
--
ALTER TABLE `ligneapprochantierressource`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `ligneapprovisionnement`
--
ALTER TABLE `ligneapprovisionnement`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `lignecommande`
--
ALTER TABLE `lignecommande`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `ligneconsommation`
--
ALTER TABLE `ligneconsommation`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `ligneconsommationchantier`
--
ALTER TABLE `ligneconsommationchantier`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `lignedepotproduit`
--
ALTER TABLE `lignedepotproduit`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `lignedepotressource`
--
ALTER TABLE `lignedepotressource`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `lignedevente`
--
ALTER TABLE `lignedevente`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `ligneexigenceproduction`
--
ALTER TABLE `ligneexigenceproduction`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `lignelivraison`
--
ALTER TABLE `lignelivraison`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `lignepayement`
--
ALTER TABLE `lignepayement`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `ligneperteproduit`
--
ALTER TABLE `ligneperteproduit`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `ligneproduction`
--
ALTER TABLE `ligneproduction`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `ligneproductionchantier`
--
ALTER TABLE `ligneproductionchantier`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `lignetransfertstock`
--
ALTER TABLE `lignetransfertstock`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `ligneuseproduit`
--
ALTER TABLE `ligneuseproduit`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `ligneuseressource`
--
ALTER TABLE `ligneuseressource`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `livraison`
--
ALTER TABLE `livraison`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `location`
--
ALTER TABLE `location`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `materiel`
--
ALTER TABLE `materiel`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `modepayement`
--
ALTER TABLE `modepayement`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `mouvement`
--
ALTER TABLE `mouvement`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `mycompte`
--
ALTER TABLE `mycompte`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `operation`
--
ALTER TABLE `operation`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `operationchantier`
--
ALTER TABLE `operationchantier`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `params`
--
ALTER TABLE `params`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `payeferie_produit`
--
ALTER TABLE `payeferie_produit`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `payementtricycle`
--
ALTER TABLE `payementtricycle`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `paye_produit`
--
ALTER TABLE `paye_produit`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `pertechantiermateriel`
--
ALTER TABLE `pertechantiermateriel`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `pertechantierproduit`
--
ALTER TABLE `pertechantierproduit`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `pertechantierressource`
--
ALTER TABLE `pertechantierressource`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `perteentrepot`
--
ALTER TABLE `perteentrepot`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `perteproduit`
--
ALTER TABLE `perteproduit`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `perteressource`
--
ALTER TABLE `perteressource`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `perteressourceagence`
--
ALTER TABLE `perteressourceagence`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `prix_zonelivraison`
--
ALTER TABLE `prix_zonelivraison`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `production`
--
ALTER TABLE `production`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `productionchantier`
--
ALTER TABLE `productionchantier`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `produit`
--
ALTER TABLE `produit`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `reglementclient`
--
ALTER TABLE `reglementclient`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `reglementfournisseur`
--
ALTER TABLE `reglementfournisseur`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `reglementfournisseurchantier`
--
ALTER TABLE `reglementfournisseurchantier`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `ressource`
--
ALTER TABLE `ressource`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `role_employe`
--
ALTER TABLE `role_employe`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `sexe`
--
ALTER TABLE `sexe`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `tache`
--
ALTER TABLE `tache`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `transfertfond`
--
ALTER TABLE `transfertfond`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `transfertstock`
--
ALTER TABLE `transfertstock`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `tricycle`
--
ALTER TABLE `tricycle`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `typeclient`
--
ALTER TABLE `typeclient`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `typeduree`
--
ALTER TABLE `typeduree`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `typemouvement`
--
ALTER TABLE `typemouvement`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `typeoperationcaisse`
--
ALTER TABLE `typeoperationcaisse`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `typeperte`
--
ALTER TABLE `typeperte`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `typeproduit`
--
ALTER TABLE `typeproduit`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `useproduit`
--
ALTER TABLE `useproduit`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `useressource`
--
ALTER TABLE `useressource`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `vehicule`
--
ALTER TABLE `vehicule`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `versementchantier`
--
ALTER TABLE `versementchantier`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `zonelivraison`
--
ALTER TABLE `zonelivraison`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `acces_agence`
--
ALTER TABLE `acces_agence`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `acces_chantier`
--
ALTER TABLE `acces_chantier`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `achatstock`
--
ALTER TABLE `achatstock`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `agence`
--
ALTER TABLE `agence`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `approchantiermateriel`
--
ALTER TABLE `approchantiermateriel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `approchantierproduit`
--
ALTER TABLE `approchantierproduit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `approchantierressource`
--
ALTER TABLE `approchantierressource`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `approvisionnement`
--
ALTER TABLE `approvisionnement`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `budgetchantier`
--
ALTER TABLE `budgetchantier`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `categorieoperation`
--
ALTER TABLE `categorieoperation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `categorieoperationchantier`
--
ALTER TABLE `categorieoperationchantier`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `chantier`
--
ALTER TABLE `chantier`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `chauffeur`
--
ALTER TABLE `chauffeur`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `client`
--
ALTER TABLE `client`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `clientchantier`
--
ALTER TABLE `clientchantier`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `commande`
--
ALTER TABLE `commande`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `comptebanque`
--
ALTER TABLE `comptebanque`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `connexion`
--
ALTER TABLE `connexion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `depotproduit`
--
ALTER TABLE `depotproduit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `depotressource`
--
ALTER TABLE `depotressource`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `disponibilite`
--
ALTER TABLE `disponibilite`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `documentchantier`
--
ALTER TABLE `documentchantier`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `employe`
--
ALTER TABLE `employe`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `etat`
--
ALTER TABLE `etat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `etatchantier`
--
ALTER TABLE `etatchantier`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `etatchauffeur`
--
ALTER TABLE `etatchauffeur`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `etatvehicule`
--
ALTER TABLE `etatvehicule`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `exercicecomptable`
--
ALTER TABLE `exercicecomptable`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `exigenceproduction`
--
ALTER TABLE `exigenceproduction`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `fournisseur`
--
ALTER TABLE `fournisseur`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `fournisseurchantier`
--
ALTER TABLE `fournisseurchantier`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `groupecommande`
--
ALTER TABLE `groupecommande`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `history`
--
ALTER TABLE `history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `imagechantier`
--
ALTER TABLE `imagechantier`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `initialmaterielchantier`
--
ALTER TABLE `initialmaterielchantier`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `initialproduitagence`
--
ALTER TABLE `initialproduitagence`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `initialproduitchantier`
--
ALTER TABLE `initialproduitchantier`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `initialressourceagence`
--
ALTER TABLE `initialressourceagence`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `initialressourcechantier`
--
ALTER TABLE `initialressourcechantier`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `ligneachatstock`
--
ALTER TABLE `ligneachatstock`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `ligneapprochantiermateriel`
--
ALTER TABLE `ligneapprochantiermateriel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `ligneapprochantierproduit`
--
ALTER TABLE `ligneapprochantierproduit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `ligneapprochantierressource`
--
ALTER TABLE `ligneapprochantierressource`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `ligneapprovisionnement`
--
ALTER TABLE `ligneapprovisionnement`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `lignecommande`
--
ALTER TABLE `lignecommande`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `ligneconsommation`
--
ALTER TABLE `ligneconsommation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `ligneconsommationchantier`
--
ALTER TABLE `ligneconsommationchantier`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `lignedepotproduit`
--
ALTER TABLE `lignedepotproduit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `lignedepotressource`
--
ALTER TABLE `lignedepotressource`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `lignedevente`
--
ALTER TABLE `lignedevente`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `ligneexigenceproduction`
--
ALTER TABLE `ligneexigenceproduction`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `lignelivraison`
--
ALTER TABLE `lignelivraison`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `lignepayement`
--
ALTER TABLE `lignepayement`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `ligneperteproduit`
--
ALTER TABLE `ligneperteproduit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `ligneproduction`
--
ALTER TABLE `ligneproduction`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `ligneproductionchantier`
--
ALTER TABLE `ligneproductionchantier`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `lignetransfertstock`
--
ALTER TABLE `lignetransfertstock`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `ligneuseproduit`
--
ALTER TABLE `ligneuseproduit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `ligneuseressource`
--
ALTER TABLE `ligneuseressource`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `livraison`
--
ALTER TABLE `livraison`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `location`
--
ALTER TABLE `location`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `materiel`
--
ALTER TABLE `materiel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `modepayement`
--
ALTER TABLE `modepayement`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `mouvement`
--
ALTER TABLE `mouvement`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `mycompte`
--
ALTER TABLE `mycompte`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `operation`
--
ALTER TABLE `operation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `operationchantier`
--
ALTER TABLE `operationchantier`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `params`
--
ALTER TABLE `params`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `payeferie_produit`
--
ALTER TABLE `payeferie_produit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `payementtricycle`
--
ALTER TABLE `payementtricycle`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `paye_produit`
--
ALTER TABLE `paye_produit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `pertechantiermateriel`
--
ALTER TABLE `pertechantiermateriel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `pertechantierproduit`
--
ALTER TABLE `pertechantierproduit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `pertechantierressource`
--
ALTER TABLE `pertechantierressource`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `perteentrepot`
--
ALTER TABLE `perteentrepot`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `perteproduit`
--
ALTER TABLE `perteproduit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `perteressource`
--
ALTER TABLE `perteressource`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `perteressourceagence`
--
ALTER TABLE `perteressourceagence`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `prix_zonelivraison`
--
ALTER TABLE `prix_zonelivraison`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `production`
--
ALTER TABLE `production`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `productionchantier`
--
ALTER TABLE `productionchantier`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `produit`
--
ALTER TABLE `produit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `reglementclient`
--
ALTER TABLE `reglementclient`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `reglementfournisseur`
--
ALTER TABLE `reglementfournisseur`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `reglementfournisseurchantier`
--
ALTER TABLE `reglementfournisseurchantier`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `ressource`
--
ALTER TABLE `ressource`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `role`
--
ALTER TABLE `role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `role_employe`
--
ALTER TABLE `role_employe`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `sexe`
--
ALTER TABLE `sexe`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `tache`
--
ALTER TABLE `tache`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `transfertfond`
--
ALTER TABLE `transfertfond`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `transfertstock`
--
ALTER TABLE `transfertstock`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `tricycle`
--
ALTER TABLE `tricycle`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `typeclient`
--
ALTER TABLE `typeclient`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `typeduree`
--
ALTER TABLE `typeduree`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `typemouvement`
--
ALTER TABLE `typemouvement`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `typeoperationcaisse`
--
ALTER TABLE `typeoperationcaisse`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `typeperte`
--
ALTER TABLE `typeperte`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `typeproduit`
--
ALTER TABLE `typeproduit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `useproduit`
--
ALTER TABLE `useproduit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `useressource`
--
ALTER TABLE `useressource`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `vehicule`
--
ALTER TABLE `vehicule`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `versementchantier`
--
ALTER TABLE `versementchantier`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `zonelivraison`
--
ALTER TABLE `zonelivraison`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
