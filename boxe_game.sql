-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  mer. 19 mars 2025 à 17:05
-- Version du serveur :  5.7.17
-- Version de PHP :  5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `boxe_game`
--

-- --------------------------------------------------------

--
-- Structure de la table `boxeur`
--

CREATE TABLE `boxeur` (
  `id` int(11) NOT NULL,
  `nom` varchar(100) NOT NULL,
  `prenom` varchar(100) NOT NULL,
  `attaque` int(11) NOT NULL,
  `vitesse` int(11) NOT NULL,
  `pv` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `boxeur`
--

INSERT INTO `boxeur` (`id`, `nom`, `prenom`, `attaque`, `vitesse`, `pv`) VALUES
(1, 'Floyd Mayweather', 'Junior', 30, 30, 100),
(2, 'Ali', 'Mohamed', 35, 35, 105),
(3, 'Tyson', 'Mike', 50, 25, 110),
(4, 'Usyk', 'Oleksandr', 25, 30, 95);

-- --------------------------------------------------------

--
-- Structure de la table `historique`
--

CREATE TABLE `historique` (
  `id` int(11) NOT NULL,
  `idjoueur1` int(11) NOT NULL,
  `idjoueur2` int(11) NOT NULL,
  `id_boxeur_j1` int(11) NOT NULL,
  `id_boxeur_j2` int(11) NOT NULL,
  `id_joueur_vainqueur` int(11) NOT NULL,
  `date_combat` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `pseudo` varchar(50) NOT NULL,
  `mdp` varchar(255) NOT NULL,
  `nom` varchar(100) NOT NULL,
  `prenom` varchar(100) NOT NULL,
  `genre` enum('Homme','Femme','Autre') DEFAULT 'Autre',
  `email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `pseudo`, `mdp`, `nom`, `prenom`, `genre`, `email`) VALUES
(1, 'tom', '$2y$10$cYGVrVDHygn/sknnk1s8B.oVMduikT7RFpafNgkCsB.HtEwgRvMSu', '', '', 'Autre', 'tom@gmail.com');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `boxeur`
--
ALTER TABLE `boxeur`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `historique`
--
ALTER TABLE `historique`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idjoueur1` (`idjoueur1`),
  ADD KEY `idjoueur2` (`idjoueur2`),
  ADD KEY `id_joueur_vainqueur` (`id_joueur_vainqueur`),
  ADD KEY `id_boxeur_j1` (`id_boxeur_j1`),
  ADD KEY `id_boxeur_j2` (`id_boxeur_j2`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `boxeur`
--
ALTER TABLE `boxeur`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT pour la table `historique`
--
ALTER TABLE `historique`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `historique`
--
ALTER TABLE `historique`
  ADD CONSTRAINT `historique_ibfk_1` FOREIGN KEY (`idjoueur1`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `historique_ibfk_2` FOREIGN KEY (`idjoueur2`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `historique_ibfk_3` FOREIGN KEY (`id_joueur_vainqueur`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `historique_ibfk_4` FOREIGN KEY (`id_boxeur_j1`) REFERENCES `boxeur` (`id`),
  ADD CONSTRAINT `historique_ibfk_5` FOREIGN KEY (`id_boxeur_j2`) REFERENCES `boxeur` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
