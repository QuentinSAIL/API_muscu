-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : ven. 18 nov. 2022 à 20:51
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
-- Base de données : `api_muscu`
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
('DoctrineMigrations\\Version20221117171921', '2022-11-17 18:19:30', 329),
('DoctrineMigrations\\Version20221118182754', '2022-11-18 19:28:01', 43);

-- --------------------------------------------------------

--
-- Structure de la table `exercice`
--

CREATE TABLE `exercice` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'on',
  `url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `exercice`
--

INSERT INTO `exercice` (`id`, `name`, `description`, `status`, `url`) VALUES
(1, 'traction', 'La traction est un exercice physique consistant à hisser ses épaules au niveau d\'une barre en la tenant par les mains. Les tractions ont pour objectif principal le développement des muscles du dos et des bras. C\'est un exercice polyarticulaire de musculation, élémentaire et très populaire, car simple et efficace.', 'on', NULL),
(2, 'curl', 'Le curl ou flexion du coude en prise marteau développe efficacement les muscles des bras et des avant-bras, particulièrement près du coude. Ces muscles sont importants, car ils sont sollicités et jouent un rôle important dans de nombreux autres exercices de musculation pour soulever des barres ou pour les tirages.', 'on', NULL),
(162, 'tirage vertical', 'ca muscle le dos ', 'on', NULL),
(163, 'Curl', 'avec haltere', 'on', NULL),
(164, 'barre au front', 'La Barre au Front est un exercice de musculation qui développe les triceps en priorité. Il permet de gagner de la force et du volume musculaire sur cette portion-là. Il est appelé ainsi tout simplement car il s\'agit de ramener la barre vers le front en étant allongé sur un banc de musculation à plat.', 'on', NULL),
(165, 'Le rowing barre buste penché', 'Le rowing barre est un exercice de base qui recrute la totalité du dos. Veillez à bien verrouiller le bassin et à ne pas enrouler le bas du dos pendant l\'exécution du mouvement.', 'on', NULL),
(166, 'Le shrug', 'Prenez une barre, écartez vos mains en pronation avec une largeur légèrement supérieure à celle de vos épaules, étendez vos bras jusqu\'à ce que la barre soit au niveau de vos cuisses. Haussez au maximum vos épaules en direction de vos oreilles, maintenez cette position pendant 2 à 3 secondes, puis relâchez vos muscles.', 'on', NULL),
(167, 'Lombaire', 'Allongé sur le ventre, bras le long du corps, décollez simultanément votre buste et vos jambes. Soufflez lors de cette phase de contraction des muscles, puis relâchez.\r\nDans un premier temps, vous pouvez réalisez une dizaine de répétitions, en prenant bien le temps lors de chaque mouvement (comptez 2 à 3 secondes), puis augmentez la dose progressivement jusqu’à atteindre 30 répétitions. Ensuite vous pourrez passer à un travail stato-dynamique, en alternant quelques mouvements de 2 à 3 sec. et le maintien de la position en contraction entre 10 et 20 secondes.', 'on', NULL),
(168, 'le rowing barre ', 'Positionnez-vous devant une barre droite chargée, les mains en pronation et pieds écartés largeur d’épaules. Gardez le buste vers l’avant tout en conservant votre dos bien droit et vos genoux légèrement fléchis puis saisissez la barre bras tendus en tirant la barre au niveau du bas-ventre. Redescendez ensuite la barre dans un mouvement lent et contrôlé jusqu’à la position de départ. Votre corps doit être en angle à 45 degrés. Ne chargez pas trop lourd en poids et si vous n’avez jamais réalisé l’exercice, essayer la barre à vide dans un premier temps pour apprendre le mouvement.', 'on', NULL),
(169, 'petit rond (renforcement de la coiffe des rotateurs)', 'Cet exercice permet de solliciter les muscles infra-épineux et petit rond sur un mode de contraction classique (concentrique/excentrique). Il est réalisé à l’aide d’une bande élastique.\r\n\r\nCet exercice propose une sollicitation des muscles rotateurs externes du bras grâce à un mode de contraction excentrique. L’intérêt de ce type de sollicitation est multiple : renforcement des tendons, des cloisons conjonctives, mais surtout il permet un renforcement beaucoup plus intense de la coiffe des rotateurs que le mode de contraction concentrique, et par conséquent une meilleure stabilisation de l’épaule.', 'on', NULL),
(170, 'Le Front Squat', 'Le Front Squat est une bonne alternative à l\'exercice squat ou squat exercice, car il permet de travailler le devant des cuisses en plus des fessiers. D\'ailleurs, la stabilité du bas du corps est aussi sollicitée.', 'on', NULL),
(171, 'Le crunch au sol', 'Le crunch au sol est un exercice standard pour les abdominaux. Veillez à garder le bassin plaqué contre le sol. Seules les épaules doivent décoller du sol. Marquez une pause en contraction maximale avant de reposer les épaules au sol. ', 'on', NULL),
(172, 'Le crunch à la poulie haute', 'Le crunch à la poulie haute recrute la partie supérieure et inférieure des abdominaux. Enroulez votre buste afin que vous puissiez voir derrière vous entre vos genoux. Lors de la phase négative (la remontée), cambrez le bassin afin que les lombaires vous accompagnent tout au long de l\'exercice. ', 'on', NULL),
(173, 'Crunch oblique décliné', 'Installez-vous sur un banc décliné, les pieds maintenus sous les supports. Relevez votre buste en gardant une main derrière votre nuque, l’autre sur votre cuisse, en réalisant une rotation. Faites 10 à 20 reps puis passez à l’autre côté.', 'on', NULL),
(174, 'Crunch latéral(oblique)', 'Allongez-vous sur le côté, et placez votre main derrière votre nuque. Ensuite, rapprochez votre buste de votre jambe, le coude devant toucher le haut de la cuisse. Restez en contraction deux secondes avant de revenir en position de départ. Faites toutes les reps du même côté et passez ensuite au côté opposé.', 'on', NULL),
(175, 'Le curl ou flexion des avant-bras avec haltères', '\r\nPrenez un haltère dans chaque main, puis asseyez-vous sur un pupitre, paumes tournées vers le haut. Vous pouvez aussi vous agenouiller devant un banc et placez vos avant-bras en travers de ce dernier. Vos mains devraient être dans le vide de l’autre côté du bord du banc de façon qu’elles puissent se mouvoir librement en amplitude complète.\r\nAsseyez-vous en arrière de façon à ce que vos bras soient relativement tendus. Maintenez les haltères d’une prise plutôt relâchée.\r\nGardez le buste et les avant-bras immobiles et descendez les mains jusqu’à ce que vos poignets soient en hyperextension.\r\nFléchissez les poignets en ramenant les haltères (vos mains devraient finir à approximativement 60° par rapport à l’horizontale). La vitesse doit être modérée et assurez-vous que vos coudes et vos avant-bras restent tout le temps en contact avec le pupitre ou le banc.\r\n\r\n', 'on', NULL),
(176, 'Le curl marteau haltère,des biceps épais', 'Debout, les bras le long du corps et les mains en pronation, fléchissez l\'avant bras en gardant la main en pronation. Alternez un bras après l\'autre.\r\n', 'on', NULL),
(177, 'Extension des coudes à la poulie haute avec une corde', 'Debout, pieds largeur de hanches, inclinez légèrement le buste vers l\'avant. Réalisez une extension des avant-bras en contractant les triceps et en écartant les extrémités de la corde en position basse.', 'on', NULL),
(178, 'Le squat', 'En position debout, le positionnement des pieds légèrement supérieur à la largeur des épaules. La barre derrière la nuque, placée sur les trapèzes et maintenue par les mains. Descendez en fléchissant S\'accroupir en penchant légèrement le dos vers l\'avant jusqu\'à avoir les cuisses parallèles au sol. Contrôlez la descente et remontez jusqu\'à la position de départ.', 'on', NULL),
(179, 'La presse à cuisses ', 'Adossé au dossier de la presse inclinée,  les pieds sur le plateau suivant l\'écartement que vous aurez choisi, débloquez la sécurité de la machine et fléchissez les genoux et ramenez les cuisses sur le côté jusqu\'à la cage thoracique. Puis poussez sur vos cuisses en expirant pour revenir à la position initiale.', 'on', NULL),
(180, 'Les fentes', 'Exercice bas du dos : Debout, avec ou sans haltère dans les mains, buste droit et écartement des pieds inférieur à la largeur d\'épaules. Avancer la jambe gauche et reculer la jambe droite en fléchissant les genoux. Le buste reste droit pendant la descente. En fin de mouvement, la jambe avant est parallèle au sol, la jambe arrière quant à elle permet de stabiliser le corps, le genou au sol. Remontez en appuyant sur la jambe avant. Afin de travailler tous les muscles de la cuisse et les fessiers, alterner la jambe avant sur cet exercice de cuisses. ', 'on', NULL),
(181, 'Le leg curl', 'Exercice cuisse leg curl : Voici un exemple de machine incontournable dans votre salle de musculation. Assis sur la machine, les mains sur les poignées, les genoux placés au bout de l\'assise et les chevilles derrière le boudin. Effectuer une extension des jambes et redescendez doucement jusqu\'à la position initiale.', 'on', NULL),
(182, 'Développé couché barre', ' Position de départ, allongé sur le dos sur un banc plat horizontal, les pieds bien placés au sol pour la stabilité et l\'équilibre. Les yeux sous la barre. Positionnez les mains avec un écartement supérieur à la largeur d\'épaules. Décrochez la barre et descendre en contrôlant la charge jusqu\'à la poitrine. Développer la barre puis expirer à la fin du mouvement. ', 'on', NULL),
(183, 'Développé incliné barre pour développer les pectoraux dans leur portion haute', 'Assis sur un banc à 45°, les yeux sous la barre. Saisissez la barre en pronation avec une écartement supérieur à la largeur des épaules. Décrochez la barre et descendez jusqu\'à la poitrine puis remontez.  ', 'on', NULL),
(184, 'Développé décliné haltères, un exercice de pecs pour cibler la partie inférieure', 'Position de départ, allongé sur un banc incliné de 20° la tête vers le bas. Prenez les haltères à la main en pronation avec les bras parallèle au sol. Poussez pour que les haltères se rejoignent au dessus de votre poitrine. Puis redescendez doucement en position initiale.', 'on', NULL);

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
(1, 5),
(2, 13),
(164, 2),
(165, 6),
(165, 8),
(168, 8),
(170, 14),
(170, 18),
(171, 19),
(172, 19),
(174, 19),
(176, 13),
(177, 2),
(178, 12),
(178, 16),
(179, 12),
(179, 18),
(180, 12),
(181, 18),
(182, 11),
(183, 11),
(184, 11);

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
(2, 'triceps', 'on', 2),
(5, 'grand dorsal', 'on', 1),
(6, 'lombaire', 'on', 1),
(7, 'Trapèzes', 'on', 1),
(8, 'Dorsaux', 'on', 1),
(9, 'Deltoides', 'on', 1),
(11, 'Pectoraux', 'on', 5),
(12, 'Fessiers', 'on', 4),
(13, 'Biceps', 'on', 2),
(14, 'Ischios', 'on', 3),
(15, 'Avant-bras', 'on', 2),
(16, 'Mollets', 'on', 3),
(17, 'Adducteurs', 'on', 3),
(18, 'Quadriceps', 'on', 3),
(19, 'Abdos', 'on', 6);

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
(2, 'bras', 'on'),
(3, 'jambes', 'on'),
(4, 'fessier', 'on'),
(5, 'pectoraux', 'on'),
(6, 'Muscles abdominaux ', 'on');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=185;

--
-- AUTO_INCREMENT pour la table `muscle`
--
ALTER TABLE `muscle`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT pour la table `picture`
--
ALTER TABLE `picture`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `region`
--
ALTER TABLE `region`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

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
