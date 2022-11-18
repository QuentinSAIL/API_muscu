-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : ven. 18 nov. 2022 à 14:25
-- Version du serveur : 10.4.25-MariaDB
-- Version de PHP : 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `api_muscu_copy_teach`
--

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
-- Déchargement des données de la table `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20221115134305', '2022-11-15 14:43:22', 163),
('DoctrineMigrations\\Version20221117171921', '2022-11-17 18:19:30', 329);

-- --------------------------------------------------------

--
-- Structure de la table `exercice`
--

CREATE TABLE `exercice` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `exercice`
--

INSERT INTO `exercice` (`id`, `name`) VALUES
(1, 'traction'),
(2, 'curl');

-- --------------------------------------------------------

--
-- Structure de la table `exercice_muscle`
--

CREATE TABLE `exercice_muscle` (
  `exercice_id` int(11) NOT NULL,
  `muscle_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `exercice_muscle`
--

INSERT INTO `exercice_muscle` (`exercice_id`, `muscle_id`) VALUES
(1, 1),
(1, 5),
(2, 1);

-- --------------------------------------------------------

--
-- Structure de la table `muscle`
--

CREATE TABLE `muscle` (
  `id` int(11) NOT NULL,
  `muscle_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `region_id_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `muscle`
--

INSERT INTO `muscle` (`id`, `muscle_name`, `status`, `region_id_id`) VALUES
(1, 'biceps', 'on', 2),
(2, 'triceps', 'on', 2),
(5, 'grand dorsal', 'on', 1);

-- --------------------------------------------------------

--
-- Structure de la table `picture`
--

CREATE TABLE `picture` (
  `id` int(11) NOT NULL,
  `picture_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `picture_url` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `public_path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mime_type` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `region`
--

CREATE TABLE `region` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `region`
--

INSERT INTO `region` (`id`, `name`, `status`) VALUES
(1, 'dos', 'on'),
(2, 'bras', 'on');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `email` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` longtext COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '(DC2Type:json)',
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `email`, `roles`, `password`) VALUES
(1, 'admin@email', '[\"ROLE_ADMIN\"]', '$2y$13$TKuuUVu7j4mAkERA1J6I4evaPI4U3nLYCugNI0lsFuGoZgVlOECX2'),
(2, 'thibaut22@gmail.com@i8sk?)', '[\"ROLE_USER\"]', '$2y$13$bWN7ad880K.aUQXsu3Cmi.y4BCZjyY8eVVr3lSBu.6qEHD0NL41o.'),
(3, 'descamps.matthieu@louis.fr@~xyIL', '[\"ROLE_USER\"]', '$2y$13$.ZpqXbQGn1Yldm40ro3kke46KG13IECtIvBDAi5hnRlGLpufsr1s.'),
(4, 'susanne75@gmail.com@=izuq', '[\"ROLE_USER\"]', '$2y$13$K5.uDkrKLzqTgckFtorI7eBpYeTKBQFif/rj.oREJra/4W2J51bsa'),
(5, 'hguyon@jacquet.fr@L,', '[\"ROLE_USER\"]', '$2y$13$LzTvnoVPl/XMPsQhpQy3PekBFagaDBSIlI/wjeMa5CEBZUryeOJfm'),
(6, 'laurence55@charpentier.fr@>niE4I', '[\"ROLE_USER\"]', '$2y$13$QeBpXZCjgaPbOsH7h4oZ3OYkFkkGY1cp6lSynLNP3rhhDqrclGCQ6'),
(7, 'normand.charles@schneider.com@534y', '[\"ROLE_USER\"]', '$2y$13$lPrARM9fsBb8hBrnPJXMbe9KlZbUmE88TLZPOQulj8PDG8pS.LYwS'),
(8, 'qguillou@colas.fr@t-_', '[\"ROLE_USER\"]', '$2y$13$Fd02Ay.GS0K1D700lMsAaOuDP91Lso3coIozSgsuLqQ0svbU16fR.'),
(9, 'franck33@yahoo.fr@rj', '[\"ROLE_USER\"]', '$2y$13$36L6k.RUJP3Sk0tys9ppYuvvPNL25MQ8aUQDAQDdj3q1dfkaNBHg2'),
(10, 'genevieve.perrin@fabre.net@-]ed', '[\"ROLE_USER\"]', '$2y$13$HuIE98NoM/2gRxaXpB/NKujDbzeHXGjXzihNPsCN4dBAQIFXRzWhW'),
(11, 'xlouis@maillot.net@dN', '[\"ROLE_USER\"]', '$2y$13$x6Npi6aHzefZ3mhOCC4zIOnxnRP.u9a7PUK3Eb9nIHCsZHMOQxSWm');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `doctrine_migration_versions`
--
ALTER TABLE `doctrine_migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Index pour la table `exercice`
--
ALTER TABLE `exercice`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `exercice_muscle`
--
ALTER TABLE `exercice_muscle`
  ADD PRIMARY KEY (`exercice_id`,`muscle_id`),
  ADD KEY `IDX_2A9ECEF589D40298` (`exercice_id`),
  ADD KEY `IDX_2A9ECEF5354FDBB4` (`muscle_id`);

--
-- Index pour la table `muscle`
--
ALTER TABLE `muscle`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_F31119EFC7209D4F` (`region_id_id`);

--
-- Index pour la table `picture`
--
ALTER TABLE `picture`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `region`
--
ALTER TABLE `region`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_8D93D649E7927C74` (`email`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `exercice`
--
ALTER TABLE `exercice`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `muscle`
--
ALTER TABLE `muscle`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `picture`
--
ALTER TABLE `picture`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `region`
--
ALTER TABLE `region`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `exercice_muscle`
--
ALTER TABLE `exercice_muscle`
  ADD CONSTRAINT `FK_2A9ECEF5354FDBB4` FOREIGN KEY (`muscle_id`) REFERENCES `muscle` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_2A9ECEF589D40298` FOREIGN KEY (`exercice_id`) REFERENCES `exercice` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `muscle`
--
ALTER TABLE `muscle`
  ADD CONSTRAINT `FK_F31119EFC7209D4F` FOREIGN KEY (`region_id_id`) REFERENCES `region` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
