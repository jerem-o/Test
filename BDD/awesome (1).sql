-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Mar 21 Mars 2017 à 17:36
-- Version du serveur :  10.1.13-MariaDB
-- Version de PHP :  5.6.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `awesome`
--

-- --------------------------------------------------------

--
-- Structure de la table `appart`
--

CREATE TABLE `appart` (
  `id_appart` int(3) NOT NULL,
  `titre` varchar(200) NOT NULL,
  `description` text NOT NULL,
  `photo` varchar(200) NOT NULL,
  `pays` varchar(20) NOT NULL,
  `ville` varchar(20) NOT NULL,
  `adresse` varchar(50) NOT NULL,
  `cp` int(5) NOT NULL,
  `capacite` int(3) NOT NULL,
  `categorie` enum('maison','studio','appartement') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `appart`
--

INSERT INTO `appart` (`id_appart`, `titre`, `description`, `photo`, `pays`, `ville`, `adresse`, `cp`, `capacite`, `categorie`) VALUES
(1, 'Appartement blanc', 'Un superbe appartement aux couleurs immaculées', 'appartement_blanc.jpg', 'france', 'paris', '1 rue du Moulin à vent\r\n', 74660, 2, 'appartement'),
(2, 'Appart avec vue', 'Une vue de guedin sur la deuxième ville Lumière après Lyon', 'appart_avec_vue_paris.jpg', 'france', 'paris', '1 rue du Kiff', 75000, 4, 'appartement'),
(3, 'Appart classique', 'Appart on-ne-peut-plus classique qui ressemble à une maison tout ce qu''il y a plus de classique.\r\n\r\nIdéal si vous voulez ne rien ressentir de particulier durant votre séjour.', 'appart_classique.jpg', 'espagne', 'lyon', '49 boulevard du Renard-Rusé', 69004, 1, 'appartement'),
(4, 'Appart modulaire', 'La modularité de cet appartement lui confère une capacité d''auto-modulation relativement élevée.\r\nÂmes sensibles, s''abstenir.', 'appartement_modulaire.jpg', 'france', 'lyon', '57 impasse de la loutre percée', 55559, 2, 'appartement'),
(5, 'L''appart aux milles surprises...', 'Dans cet appart, les mots d''ordre est confort et plaisir... dans toutes les configurations. Saurez-vous trouver notre cadeau caché ?', 'chambre_industrielle.jpg', 'france', 'paris', '69 rue de Jouy', 75069, 2, 'studio'),
(6, 'Loft industriel', 'Un superbe loft basé sur une ancienne usine de carton.\r\nLes propriétaires se sont inspirés du style anglais de la seconde partie du IVè siècle avant J.-C. pour donner au lieu une folle énergie créative.', 'grand_loft_industriel.jpg', 'france', 'paris', '10 rue Birmingham', 142, 5, 'maison'),
(7, 'Loft lumineux', 'Un lieu aéré et ouvert aux énergies, dans le plus grand respect du Feng-Shui et du Kamasutra (outils fournis).', 'loft_grandes_fenetres_atelier.jpg', 'france', 'lyon', '4 rue de ta race', 60879, 4, 'maison'),
(8, 'Nid d''aigles Bogota', 'Envie de vous prendre pour Pablo Escobar ? Ce lieu perché sur les hauteurs de Bogotá, vous donnera le pouvoir d''uriner sur vos voisins d''en-dessous quand vous aurez sniffé toutes les lignes sur nos prostituées.', 'mezzanine_bois.jpg', 'france', 'paris', '49 rue du trafic', 69000, 12, 'appartement'),
(9, 'Maison vieillotte', 'Dans ce temple du mauvais goût, vous passerez un excellent moment, bien entouré entre la tapisserie d''époque et le fantôme de l''ex-propriétaire.', 'maison_vieillotte.JPG', 'france', 'lyon', '13 rue du spectre', 69013, 3, 'maison'),
(10, 'Maison avec hélicoptère', 'Pas envie de prendre la Porsche pour aller chercher le pain ? Aucun problème : après une rapide démo, Alfred vous laissera les clés de la bécane à hélices.', 'default.jpg', 'france', 'paris', '132 rue du milliard', 44223, 1, 'maison');

-- --------------------------------------------------------

--
-- Structure de la table `avis`
--

CREATE TABLE `avis` (
  `id_avis` int(3) NOT NULL,
  `id_membre` int(3) NOT NULL,
  `id_appart` int(3) NOT NULL,
  `commentaire` text NOT NULL,
  `note` int(2) NOT NULL,
  `date_enregistrement` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `commande`
--

CREATE TABLE `commande` (
  `id_commande` int(3) NOT NULL,
  `id_membre` int(3) DEFAULT NULL,
  `id_produit` int(3) NOT NULL,
  `date_enregistrement` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `membre`
--

CREATE TABLE `membre` (
  `id_membre` int(3) NOT NULL,
  `pseudo` varchar(20) NOT NULL,
  `mdp` varchar(60) NOT NULL,
  `nom` varchar(20) NOT NULL,
  `prenom` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `civilite` enum('m','f') NOT NULL,
  `statut` int(1) NOT NULL,
  `date_enregistrement` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `membre`
--

INSERT INTO `membre` (`id_membre`, `pseudo`, `mdp`, `nom`, `prenom`, `email`, `civilite`, `statut`, `date_enregistrement`) VALUES
(3, 'jcd', 'hahaha', 'Dusse', 'Jean-Claude', 'jcd@you.fr', 'm', 1, '2017-03-15 00:00:00'),
(9, 'José', 'chorizo', 'Blanco', 'José', 'joseblanco@espagne.es', 'm', 1, '2017-03-21 00:00:00'),
(10, 'Stephen', 'stephen', 'Dutartre', 'Stephen', 'stephen@stephen.fr', 'm', 0, '2017-03-01 00:00:00'),
(11, 'admin', 'admin', 'admin', 'admin', 'admin@admin.admin', 'f', 1, '2017-03-15 00:00:00');

-- --------------------------------------------------------

--
-- Structure de la table `produit`
--

CREATE TABLE `produit` (
  `id_produit` int(3) NOT NULL,
  `id_appart` int(3) NOT NULL,
  `date_arrivee` datetime NOT NULL,
  `date_depart` datetime NOT NULL,
  `prix` int(3) NOT NULL,
  `etat` enum('libre','reservation','','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Index pour les tables exportées
--

--
-- Index pour la table `appart`
--
ALTER TABLE `appart`
  ADD PRIMARY KEY (`id_appart`);

--
-- Index pour la table `avis`
--
ALTER TABLE `avis`
  ADD PRIMARY KEY (`id_avis`),
  ADD KEY `id_membre` (`id_membre`),
  ADD KEY `id_salle` (`id_appart`);

--
-- Index pour la table `commande`
--
ALTER TABLE `commande`
  ADD PRIMARY KEY (`id_commande`),
  ADD KEY `id_produit` (`id_produit`),
  ADD KEY `id_membre` (`id_membre`);

--
-- Index pour la table `membre`
--
ALTER TABLE `membre`
  ADD PRIMARY KEY (`id_membre`);

--
-- Index pour la table `produit`
--
ALTER TABLE `produit`
  ADD PRIMARY KEY (`id_produit`),
  ADD KEY `id_appart` (`id_appart`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `appart`
--
ALTER TABLE `appart`
  MODIFY `id_appart` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT pour la table `avis`
--
ALTER TABLE `avis`
  MODIFY `id_avis` int(3) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `commande`
--
ALTER TABLE `commande`
  MODIFY `id_commande` int(3) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `membre`
--
ALTER TABLE `membre`
  MODIFY `id_membre` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT pour la table `produit`
--
ALTER TABLE `produit`
  MODIFY `id_produit` int(3) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
