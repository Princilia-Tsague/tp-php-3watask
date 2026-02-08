-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Hôte : db.3wa.io
-- Généré le : dim. 08 fév. 2026 à 19:48
-- Version du serveur :  5.7.33-0ubuntu0.18.04.1-log
-- Version de PHP : 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `princiliatsaguetefouegang_datas`
--

-- --------------------------------------------------------

--
-- Structure de la table `task`
--

CREATE TABLE `task` (
  `id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8_bin NOT NULL,
  `content` text COLLATE utf8_bin,
  `is_urgent` tinyint(1) NOT NULL DEFAULT '0',
  `is_important` tinyint(1) NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL,
  `is_completed` tinyint(1) DEFAULT '0',
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `task`
--

INSERT INTO `task` (`id`, `title`, `content`, `is_urgent`, `is_important`, `user_id`, `is_completed`, `created_at`) VALUES
(5, 'hy(&quot;h&quot;(', 'hy(ééjhè', 1, 0, 5, 1, '2026-02-08 00:36:26'),
(6, 'yn(éjnhyèé', 'énj(èyju&quot;', 0, 1, 5, 1, '2026-02-08 00:36:35'),
(7, '&quot;èh(yèjn&quot;', 'jhèyén&quot;-jk', 1, 1, 5, 1, '2026-02-08 00:36:47'),
(8, 'yb&quot;(yh(', 'juhynr(&#039;g&quot;(', 1, 1, 5, 1, '2026-02-08 00:36:56'),
(9, 'fgh', 'drftvybgnhj,k', 0, 0, 5, 1, '2026-02-08 00:37:08'),
(10, 'erftgyhuji', 'drftgyhunj', 0, 0, 5, 1, '2026-02-08 00:37:22'),
(12, 'iujnyhbtgv', 'm:l;k,jnhrb', 1, 0, 5, 1, '2026-02-08 00:54:13'),
(13, 'l-kiujryn', ';iu,jyrnhetbg', 0, 0, 5, 1, '2026-02-08 00:55:31'),
(14, 'yrnjuf', 'u&#039;jen-&#039;,', 1, 0, 5, 1, '2026-02-08 00:57:49'),
(15, 'i;uj,nyrhe', ',njyhvf', 0, 0, 5, 1, '2026-02-08 01:16:54'),
(16, 'iju(nhybgt', 'k,iujn(yh', 0, 0, 5, 1, '2026-02-08 01:17:50'),
(19, 'm:l;ky,jtnh', 'm:l;ky,jtnh', 1, 1, 5, 1, '2026-02-08 01:22:06'),
(20, 'iujynh', ',ijun(yhbtgv', 0, 0, 5, 0, '2026-02-08 01:34:51'),
(22, 'r-è_kek-_', 'k-_ezjlrçekek', 1, 1, 8, 1, '2026-02-08 19:19:59');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8_bin NOT NULL,
  `email` varchar(255) COLLATE utf8_bin NOT NULL,
  `password` varchar(255) COLLATE utf8_bin NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `created_at`) VALUES
(5, 'princilia', 'banane@banane.fr', '$2y$10$GcktkyV3m/ZgqkAO9l47rOZ0Ylz7vaRvewxmuX1Qan72oXv1Rjvji', '2026-02-08 00:27:30'),
(7, 'Dorian', 'dorian@dorian', '$2y$10$QgFuDKqNvH4BgxD8XQ2Z2u1glT0Md79jpkYIbgNqWXLvOB6P8rmZS', '2026-02-08 19:17:55'),
(8, 'Anasse', 'anasse@anasse', '$2y$10$yaP6kL9zCjzwGp95X0wq9uiKfpqUsLL1BMBb64vd/flj.7GvRH1gK', '2026-02-08 19:19:24'),
(9, 'bob', 'bob@bob', '$2y$10$1iCN9cIEo2asXQv/lE.u6uyAeV6V43pQ3i0Zl6es/fXqxk9ldY5Li', '2026-02-08 19:20:58'),
(10, 'banana', 'banana@banana', '$2y$10$x5Ah2ascGVd2EFEX2BuFweohYekOni0Sd/oaa70La8wE3rZPK3UJq', '2026-02-08 19:25:24');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `task`
--
ALTER TABLE `task`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `task`
--
ALTER TABLE `task`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `task`
--
ALTER TABLE `task`
  ADD CONSTRAINT `fk_user_task` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
