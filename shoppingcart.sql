-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : jeu. 26 mai 2022 à 19:47
-- Version du serveur : 10.4.22-MariaDB
-- Version de PHP : 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `shoppingcart`
--

-- --------------------------------------------------------

--
-- Structure de la table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `desc` text NOT NULL,
  `price` decimal(7,2) NOT NULL,
  `rrp` decimal(7,2) NOT NULL DEFAULT 0.00,
  `quantity` int(11) NOT NULL,
  `img` text NOT NULL,
  `date_added` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `products`
--

INSERT INTO `products` (`id`, `name`, `desc`, `price`, `rrp`, `quantity`, `img`, `date_added`) VALUES
(1, 'Gaming-Chair\r\n', '', '250.00', '0.00', 10, 'gaming-chair.jpg\r\n', '2019-03-13 17:55:22'),
(2, 'headset', '', '50.00', '0.00', 34, 'headset.jpg', '2019-03-13 18:52:49'),
(3, 'keyboard', '', '40.00', '0.00', 23, 'keyboard.jpg', '2019-03-13 18:47:56'),
(4, 'Monitor', '', '69.99', '0.00', 7, 'monitor.jpg', '2019-03-13 17:42:04'),
(5, 'Mouse', '', '30.00', '0.00', 15, 'mouse.jpg', '2022-05-01 01:29:05'),
(6, 'Mousepad', '', '15.00', '0.00', 10, 'mousepad.jpg', '2022-05-01 01:30:35'),
(7, 'Pc-case', '', '25.99', '0.00', 26, 'pc-case.jpg', '2022-05-01 01:31:23'),
(8, 'Playstation-5', '', '499.99', '0.00', 5, 'playsation-5.jpg', '2022-05-01 01:32:10'),
(9, 'Xbox-one-x', '', '479.99', '0.00', 7, 'xbox-one-x.jpg', '2022-05-01 01:33:17'),
(10, 'Microphone', '', '45.00', '0.00', 25, 'microphone.jpg', '2022-05-01 02:02:33'),
(11, 'Gaming-speaker', '', '35.50', '0.00', 85, 'gaming-speaker.jpg', '2022-05-01 02:07:13'),
(12, 'Racing_wheel', '', '150.00', '0.00', 35, 'racing-wheel.jpg', '2022-05-01 02:10:53');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
