-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:8080
-- Généré le : mer. 25 juin 2025 à 10:51
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
-- Base de données : `gestion_parfum_shop`
--

-- --------------------------------------------------------

--
-- Structure de la table `clients`
--

CREATE TABLE `clients` (
  `client_id` int(11) NOT NULL,
  `client_nom` varchar(100) NOT NULL,
  `client_email` varchar(150) NOT NULL,
  `client_password` varchar(250) NOT NULL,
  `username` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `clients`
--

INSERT INTO `clients` (`client_id`, `client_nom`, `client_email`, `client_password`, `username`) VALUES
(1, 'x', 'x@gmail.com', 'x123*', 'user1'),
(3, 'x man', 'xman@gmail.com', 'xman123*', 'user3'),
(9, 'oussama drifi', 'oussama@gmail.com', '$2y$10$oMI0Xo7B/C0m1vEzvLRgZunbo4PnQHPuyQfLItXCk7HQ9B5.FsU1O', '');

-- --------------------------------------------------------

--
-- Structure de la table `commande`
--

CREATE TABLE `commande` (
  `commande_id` int(11) NOT NULL,
  `commande_date` date NOT NULL,
  `prix_totale` decimal(15,2) NOT NULL,
  `client_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `commande`
--

INSERT INTO `commande` (`commande_id`, `commande_date`, `prix_totale`, `client_id`) VALUES
(10, '2025-05-20', 3549.93, 1),
(12, '2025-06-09', 4299.96, 1),
(13, '2025-06-09', 3199.93, 1),
(14, '2025-06-18', 3699.96, 9),
(15, '2025-06-18', 1749.97, 9),
(16, '2025-06-21', 3549.95, 1),
(17, '2025-06-21', 2749.97, 1),
(18, '2025-06-23', 4599.90, 1),
(19, '2025-06-25', 5599.94, 1),
(20, '2025-06-25', 3749.94, 9),
(21, '2025-06-25', 4199.94, 9),
(22, '2025-06-25', 4349.87, 9);

-- --------------------------------------------------------

--
-- Structure de la table `detail_commande`
--

CREATE TABLE `detail_commande` (
  `commande_id` int(11) NOT NULL,
  `produit_id` int(11) NOT NULL,
  `quantite` int(11) NOT NULL,
  `prix` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `detail_commande`
--

INSERT INTO `detail_commande` (`commande_id`, `produit_id`, `quantite`, `prix`) VALUES
(10, 3, 1, 749.99),
(10, 15, 4, 199.99),
(10, 12, 2, 999.99),
(12, 4, 3, 1249.99),
(12, 20, 1, 549.99),
(13, 8, 2, 199.99),
(13, 16, 4, 449.99),
(13, 12, 1, 999.99),
(14, 12, 1, 999.99),
(14, 4, 1, 1249.99),
(14, 16, 1, 449.99),
(14, 18, 1, 999.99),
(15, 17, 1, 249.99),
(15, 5, 1, 749.99),
(15, 3, 1, 749.99),
(16, 20, 1, 549.99),
(16, 6, 1, 249.99),
(16, 3, 1, 749.99),
(16, 12, 1, 999.99),
(16, 18, 1, 999.99),
(17, 4, 1, 1249.99),
(17, 3, 1, 749.99),
(17, 5, 1, 749.99),
(18, 5, 1, 749.99),
(18, 3, 1, 749.99),
(18, 12, 1, 999.99),
(18, 11, 1, 299.99),
(18, 2, 6, 299.99),
(19, 2, 2, 299.99),
(19, 4, 4, 1249.99),
(20, 3, 3, 749.99),
(20, 12, 1, 999.99),
(20, 17, 2, 249.99),
(21, 10, 1, 549.99),
(21, 20, 3, 549.99),
(21, 18, 2, 999.99),
(22, 8, 8, 199.99),
(22, 19, 3, 349.99),
(22, 9, 2, 849.99);

-- --------------------------------------------------------

--
-- Structure de la table `pannier`
--

CREATE TABLE `pannier` (
  `pannier_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `produit_id` int(11) NOT NULL,
  `quantite` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `pannier`
--

INSERT INTO `pannier` (`pannier_id`, `client_id`, `produit_id`, `quantite`) VALUES
(107, 3, 4, 1),
(108, 3, 2, 1),
(109, 3, 10, 1),
(137, 3, 16, 1),
(138, 3, 18, 1),
(139, 3, 8, 1),
(140, 3, 12, 1),
(141, 3, 13, 1),
(142, 3, 19, 1);

-- --------------------------------------------------------

--
-- Structure de la table `produit`
--

CREATE TABLE `produit` (
  `produit_id` int(11) NOT NULL,
  `produit_nom` varchar(250) NOT NULL,
  `produit_description` text NOT NULL,
  `produit_prix` decimal(10,2) NOT NULL,
  `quantite_stock` int(11) NOT NULL,
  `produit_image` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `produit`
--

INSERT INTO `produit` (`produit_id`, `produit_nom`, `produit_description`, `produit_prix`, `quantite_stock`, `produit_image`) VALUES
(2, 'Demure Luxe', 'Une ouverture vibrante de poivre bronze et de cassis noir s\'épanouit en un cœur sensuel de pivoine veloutée et de thé noir, avant de se fondre dans un sillage envoûtant de bois de santal laqué et ambre ombragé. Pour celle qui ose mêler la douceur d\'un pétale à l\'intensité d\'une nuit sans lune. L\'élégance n\'a jamais été aussi mystérieuse.', 299.99, 368, 'DemureLuxe.png'),
(3, 'Dior Intense', 'Une étreute audacieuse entre le feu et la nuit. Une ouverture vibrante de poivre noir et cardamome fumée se dévoile en un cœur envoûtant de rose noire et café velouté, avant de se consumer dans un sillage sensuel d\'ambre foncé et de bois d\'oud brûlant. Pour ceux qui portent leur intensité comme une seconde peau, où chaque note est une promesse de pouvoir discret et d\'élégance inébranlable.', 749.99, 147, 'DiorIntense.png'),
(4, 'Dior Sauvage', 'L\'appel irrésistible de l\'horizon. Une explosion de bergamote soleil et de poivre de Sichuan libère une énergie brute, tandis qu\'un cœur de lavande sauvage et de vétiver brûlant évoque les grands espaces vierges. Le final, empreint d\'ambroxan minéral et de bois de cèdre enfumé, scelle ce voyage olfactif où la liberté se mêle à l\'élégance instinctive. Pour l\'homme qui ne suit pas les chemins tracés, mais les trace.', 1249.99, 278, 'DiorSauvage.png'),
(5, 'Hugo Boss', 'L\'élégance qui s\'écrit sans compromis. Une ouverture dynamique de pamplemousse glacé et de gingembre épicé donne le ton, avant de glisser vers un cœur structuré de cuir noble et de feuilles de violette. Le final, marqué par l\'ambre gris et le bois de cèdre sculpté, incarne une audace mesurée, parfaite pour l\'homme qui allie puissance et discrétion.', 749.99, 278, 'HugoBoss.png'),
(6, 'Marly Paris Noire', 'L\'ombre qui rayonne. Un parfum où la noblesse rencontre le mystère. Une ouverture royale de lavande glacée et citron noir laisse place à un cœur somptueux de rose veloutée et cuir vieilli, avant de se fondre dans un sillage envoûtant de bois d\'ébène et musc animal. Pour ceux qui préfèrent la puissance discrète aux éclats bruyants.', 249.99, 321, 'MarlyHabdan.jpg'),
(7, 'Marly Paris Bleu', 'Une fraîcheur aristocratique naît d\'une ouverture de bergamote italienne et de figue laiteuse, avant de révéler un cœur raffiné de lavande royale enlacée de vétiver doré. Le final ? Un sillage lumineux de bois de cèdre mariné et d\'ambre bleuté qui évoque les rivages méditerranéens sous le soleil de midi.', 599.99, 200, 'MarlyParis.jpg'),
(8, 'Grasse Parfum', 'Une ouverture vibrante de mandarine de Provence et basilic frais capture l’éclat méditerranéen, tandis qu’un cœur de lavande fine de Grasse et cuir blond rend hommage au savoir-faire ancestral de la capitale mondiale du parfum', 199.99, 98, 'ParfumGrasse.jpg'),
(9, 'Tauer Harude', 'Une ouverture lumineuse de citron zeste d\'or et cumin brûlant danse comme les premières lueurs sur les dunes, avant de laisser place à un cœur résolument minéral de genévrier bleu et santal râpeux. Un sillage envoûtant de ciste labdanum et ambre gris fossilisé qui évoque la chaleur accueillante d\'un campement bédouin à la nuit tombée', 849.99, 170, 'TauerHarude.png'),
(10, 'Azzaro Hommes', 'Une étreute audacieuse entre le feu et la nuit. Une ouverture vibrante de poivre noir et cardamome fumée se dévoile en un cœur envoûtant de rose noire et café velouté, avant de se consumer dans un sillage sensuel d\'ambre foncé et de bois d\'oud brûlant. Pour ceux qui portent leur intensité comme une seconde peau, où chaque note est une promesse de pouvoir discret et d\'élégance inébranlable.', 549.99, 290, 'AzzaroHommes.png'),
(11, 'Acqua Black', 'Une ouverture vibrante de poivre bronze et de cassis noir s\'épanouit en un cœur sensuel de pivoine veloutée et de thé noir, avant de se fondre dans un sillage envoûtant de bois de santal laqué et ambre ombragé. Pour celle qui ose mêler la douceur d\'un pétale à l\'intensité d\'une nuit sans lune. L\'élégance n\'a jamais été aussi mystérieuse.', 299.99, 194, 'AcquaBlack.jpg'),
(12, 'Versace Gold', 'L\'ombre qui rayonne. Un parfum où la noblesse rencontre le mystère. Une ouverture royale de lavande glacée et citron noir laisse place à un cœur somptueux de rose veloutée et cuir vieilli, avant de se fondre dans un sillage envoûtant de bois d\'ébène et musc animal. Pour ceux qui préfèrent la puissance discrète aux éclats bruyants.', 999.99, 284, 'VersaceGold.jpg'),
(13, 'Legend Blue', 'L\'appel irrésistible de l\'horizon. Une explosion de bergamote soleil et de poivre de Sichuan libère une énergie brute, tandis qu\'un cœur de lavande sauvage et de vétiver brûlant évoque les grands espaces vierges. Le final, empreint d\'ambroxan minéral et de bois de cèdre enfumé, scelle ce voyage olfactif où la liberté se mêle à l\'élégance instinctive. Pour l\'homme qui ne suit pas les chemins tracés, mais les trace.', 299.99, 472, 'LegendBlue.jpg'),
(14, 'Jean Paul', 'Une étreute audacieuse entre le feu et la nuit. Une ouverture vibrante de poivre noir et cardamome fumée se dévoile en un cœur envoûtant de rose noire et café velouté, avant de se consumer dans un sillage sensuel d\'ambre foncé et de bois d\'oud brûlant. Pour ceux qui portent leur intensité comme une seconde peau, où chaque note est une promesse de pouvoir discret et d\'élégance inébranlable.', 324.99, 211, 'JeanPaul.jpg'),
(15, 'Bea\'s Men', 'L\'ombre qui rayonne. Un parfum où la noblesse rencontre le mystère. Une ouverture royale de lavande glacée et citron noir laisse place à un cœur somptueux de rose veloutée et cuir vieilli, avant de se fondre dans un sillage envoûtant de bois d\'ébène et musc animal. Pour ceux qui préfèrent la puissance discrète aux éclats bruyants.', 199.99, 362, 'BeasMen.jpg'),
(16, 'Caron Paris', 'Une ouverture vibrante de poivre bronze et de cassis noir s\'épanouit en un cœur sensuel de pivoine veloutée et de thé noir, avant de se fondre dans un sillage envoûtant de bois de santal laqué et ambre ombragé. Pour celle qui ose mêler la douceur d\'un pétale à l\'intensité d\'une nuit sans lune. L\'élégance n\'a jamais été aussi mystérieuse.', 449.99, 248, 'CaronParis.jpg'),
(17, 'Gaultter Classic', 'Une fraîcheur aristocratique naît d\'une ouverture de bergamote italienne et de figue laiteuse, avant de révéler un cœur raffiné de lavande royale enlacée de vétiver doré. Le final ? Un sillage lumineux de bois de cèdre mariné et d\'ambre bleuté qui évoque les rivages méditerranéens sous le soleil de midi.', 249.99, 150, 'GaultterClassic.jpg'),
(18, 'Versace Blue', 'L\'appel irrésistible de l\'horizon. Une explosion de bergamote soleil et de poivre de Sichuan libère une énergie brute, tandis qu\'un cœur de lavande sauvage et de vétiver brûlant évoque les grands espaces vierges. Le final, empreint d\'ambroxan minéral et de bois de cèdre enfumé, scelle ce voyage olfactif où la liberté se mêle à l\'élégance instinctive. Pour l\'homme qui ne suit pas les chemins tracés, mais les trace.', 999.99, 148, 'VersaceBlue.jpg'),
(19, 'Baccarat Rouge', 'Une étreute audacieuse entre le feu et la nuit. Une ouverture vibrante de poivre noir et cardamome fumée se dévoile en un cœur envoûtant de rose noire et café velouté, avant de se consumer dans un sillage sensuel d\'ambre foncé et de bois d\'oud brûlant. Pour ceux qui portent leur intensité comme une seconde peau, où chaque note est une promesse de pouvoir discret et d\'élégance inébranlable.', 349.99, 159, 'BaccaratRouge.jpg'),
(20, 'Carron Crystal', 'L\'élégance qui s\'écrit sans compromis. Une ouverture dynamique de pamplemousse glacé et de gingembre épicé donne le ton, avant de glisser vers un cœur structuré de cuir noble et de feuilles de violette. Le final, marqué par l\'ambre gris et le bois de cèdre sculpté, incarne une audace mesurée, parfaite pour l\'homme qui allie puissance et discrétion.', 549.99, 200, 'CarronCrystal.jpg'),
(21, 'Saint Laurent', 'L\'élégance qui s\'écrit sans compromis. Une ouverture dynamique de pamplemousse glacé et de gingembre épicé donne le ton, avant de glisser vers un cœur structuré de cuir noble et de feuilles de violette. Le final, marqué par l\'ambre gris et le bois de cèdre sculpté, incarne une audace mesurée, parfaite pour l\'homme qui allie puissance et discrétion.', 299.99, 329, 'SaintLaurent.jpg');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`client_id`),
  ADD UNIQUE KEY `client_email` (`client_email`);

--
-- Index pour la table `commande`
--
ALTER TABLE `commande`
  ADD PRIMARY KEY (`commande_id`),
  ADD KEY `client_id` (`client_id`);

--
-- Index pour la table `detail_commande`
--
ALTER TABLE `detail_commande`
  ADD KEY `commande_id` (`commande_id`),
  ADD KEY `produit_id` (`produit_id`);

--
-- Index pour la table `pannier`
--
ALTER TABLE `pannier`
  ADD PRIMARY KEY (`pannier_id`),
  ADD KEY `client_id` (`client_id`),
  ADD KEY `produit_id` (`produit_id`);

--
-- Index pour la table `produit`
--
ALTER TABLE `produit`
  ADD PRIMARY KEY (`produit_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `clients`
--
ALTER TABLE `clients`
  MODIFY `client_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `commande`
--
ALTER TABLE `commande`
  MODIFY `commande_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT pour la table `pannier`
--
ALTER TABLE `pannier`
  MODIFY `pannier_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=172;

--
-- AUTO_INCREMENT pour la table `produit`
--
ALTER TABLE `produit`
  MODIFY `produit_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `commande`
--
ALTER TABLE `commande`
  ADD CONSTRAINT `commande_ibfk_1` FOREIGN KEY (`client_id`) REFERENCES `clients` (`client_id`);

--
-- Contraintes pour la table `detail_commande`
--
ALTER TABLE `detail_commande`
  ADD CONSTRAINT `detail_commande_ibfk_1` FOREIGN KEY (`commande_id`) REFERENCES `commande` (`commande_id`),
  ADD CONSTRAINT `detail_commande_ibfk_2` FOREIGN KEY (`produit_id`) REFERENCES `produit` (`produit_id`);

--
-- Contraintes pour la table `pannier`
--
ALTER TABLE `pannier`
  ADD CONSTRAINT `pannier_ibfk_1` FOREIGN KEY (`client_id`) REFERENCES `clients` (`client_id`),
  ADD CONSTRAINT `pannier_ibfk_2` FOREIGN KEY (`produit_id`) REFERENCES `produit` (`produit_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
