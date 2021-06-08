-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mar. 08 juin 2021 à 21:01
-- Version du serveur :  10.4.14-MariaDB
-- Version de PHP : 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `produits`
--

-- --------------------------------------------------------

--
-- Structure de la table `produits`
--

CREATE TABLE `produits` (
  `id` int(11) NOT NULL,
  `lieux` varchar(255) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `reference` varchar(255) NOT NULL,
  `categorie` varchar(255) NOT NULL,
  `dateachat` date NOT NULL,
  `garantie` date NOT NULL,
  `prix` float NOT NULL,
  `conseil` text NOT NULL,
  `ticket` varchar(255) NOT NULL,
  `manuel` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `produits`
--

INSERT INTO `produits` (`id`, `lieux`, `nom`, `reference`, `categorie`, `dateachat`, `garantie`, `prix`, `conseil`, `ticket`, `manuel`) VALUES
(7, ' vc gd', ' gdf ', '2583', 'Bricolage', '2020-11-07', '2020-11-15', 12, 'g; c;', 'laurent-carrion-logo-1-1.png', ''),
(9, '77210', 'abdel aouini', 'dezdze', 'Tv_HIFI', '2021-06-01', '2021-07-10', 1400, 'fyhertdtrhthd', 'assets/imgticket/abdel.jpg', 'htdhtdh');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `u_email` varchar(255) NOT NULL,
  `u_password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `u_email`, `u_password`) VALUES
(1, 'celiarameau@live.fr', '77940'),
(2, 'abdy.003@gmail.com', 'azerty');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `produits`
--
ALTER TABLE `produits`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `produits`
--
ALTER TABLE `produits`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
