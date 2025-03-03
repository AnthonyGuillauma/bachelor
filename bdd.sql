-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 03, 2025 at 02:58 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shooting_star`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `username` varchar(50) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `created_at` datetime NOT NULL,
  `last_login` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`id`, `email`, `password`, `username`, `first_name`, `last_name`, `created_at`, `last_login`) VALUES
(4, 'guillaumaanthony@gmail.com', '$2y$10$y.reZshoOdEL9p.VnkLgpegJsGzUjCFs4ItRYRs7AAUnJNdfI2w0u', 'Voyageur', 'Anthony', 'GUILLAUMA', '2025-02-17 21:42:52', '2025-03-03 14:54:54'),
(8, 'a@a.c', '$2y$10$23WFsNWI3lpyk71KygN49.2JYX9Kzlfy0D58XsTXlMLk.jE5CVKju', 'Invité', 'Test', 'Test', '2025-02-25 22:34:33', '2025-02-25 22:36:08'),
(9, 'a@aa.c', '$2y$10$drSfexHZXgrM9Z.i3A/mxOOF0TlWWPLQHpqoVwVQQsVF721eW0XmK', 'Voyageur', 'dd', 'dd', '2025-03-03 14:55:40', '2025-03-03 14:55:55');

-- --------------------------------------------------------

--
-- Table structure for table `characters`
--

CREATE TABLE `characters` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `voice` varchar(50) NOT NULL,
  `description` varchar(100) NOT NULL,
  `origin` int(11) NOT NULL,
  `is_displayed` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `characters`
--

INSERT INTO `characters` (`id`, `name`, `voice`, `description`, `origin`, `is_displayed`) VALUES
(2, 'Abandon', '放棄 (Hōki)', '', 2, 1),
(3, 'Clarté', '明晰 (Meiseki)', '', 2, 1),
(4, 'Élégance', '優雅 (Yūga)', '', 2, 1),
(8, 'Forge', '鍛冶場 (Kajiba)', '', 2, 1),
(9, 'Chaine', '鎖 (Kusari)', '', 1, 1),
(10, 'Livre', '本 (Hon)', '', 1, 1),
(12, 'Pic', '峰 (Mine)', '', 2, 1),
(13, 'Écharpe', '襟巻 (Erimaki)', '', 2, 1),
(18, 'Nuit', '夜 (Yoru)', '', 5, 1);

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `id` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `content` mediumtext NOT NULL,
  `author` int(11) NOT NULL,
  `published_at` date NOT NULL DEFAULT current_timestamp(),
  `status` enum('published','draft') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id`, `title`, `content`, `author`, `published_at`, `status`) VALUES
(2, 'Patch Note 0.1.1', '<h1>Patch Note 0.1.1 - Améliorations et Corrections</h1>\n    <p>Publié le 22 février 2025</p>\n    <div>\n        <h2>Nouvelle fonctionnalité</h2>\n        <ul>\n            <li>Ajout d\'un nouveau personnage jouable : <strong>Pic, la flèche des ronces</strong>.</li>\n            <li>Nouveau donjon : <strong>La Forteresse des Étoiles Perdues</strong>, avec des ennemis inédits et un boss légendaire.</li>\n            <li>Possibilité de personnaliser l\'apparence de votre personnage avec des skins exclusifs.</li>\n        </ul>\n    </div>\n\n    <div>\n        <h2>Équilibrage des personnages</h2>\n        <ul>\n            <li>Réduction des dégâts de l\'attaque spéciale de <strong>Chaine</strong> de 15% pour un meilleur équilibre en PvP.</li>\n            <li>Augmentation de la vitesse de déplacement de <strong>Clarté</strong> pour améliorer sa mobilité.</li>\n            <li>Révision des compétences de <strong>Nuit</strong> afin de mieux correspondre à son rôle de soutien.</li>\n        </ul>\n    </div>\n\n    <div>\n        <h2>Améliorations générales</h2>\n        <ul>\n            <li>Optimisation des performances pour une expérience plus fluide sur les appareils de moyenne gamme.</li>\n            <li>Amélioration des effets visuels et sonores pour une immersion accrue.</li>\n            <li>Mise à jour de l\'interface utilisateur pour une navigation plus intuitive.</li>\n        </ul>\n    </div>\n\n    <div>\n        <h2>Corrections de bugs</h2>\n        <ul>\n            <li>Correction d\'un bug qui empêchait les joueurs de se connecter après une déconnexion soudaine.</li>\n            <li>Résolution d\'un problème de collision dans le donjon \"Caverne du Destin\".</li>\n            <li>Correction de plusieurs problèmes de traduction dans la version française.</li>\n        </ul>\n    </div>\n\n    <div>\n        <h2>Événements à venir</h2>\n        <ul>\n            <li><strong>Festival des Étoiles Filantes :</strong> Du 1er au 15 mars, participez à des quêtes exclusives pour obtenir des récompenses limitées.</li>\n            <li><strong>Double XP Weekend :</strong> Gagnez deux fois plus d\'expérience du 8 au 9 mars.</li>\n        </ul>\n    </div>\n\n    <div>\n        <p>Merci pour votre soutien continu ! Rendez-vous dans le jeu pour découvrir toutes ces nouveautés.</p>\n    </div>', 4, '2025-02-22', 'published'),
(3, 'Mise à Jour de Sécurité', '<h1>Mise à Jour de Sécurité - Protection Améliorée et Mesures Anti-Triche</h1>\n    <p>Publié le 21 février 2025</p>\n    <div>\n        <h2>Renforcement de la Sécurité</h2>\n        <p>Dans notre effort continu pour garantir un environnement de jeu sécurisé et équitable, nous avons appliqué les améliorations suivantes :</p>\n        <ul>\n            <li>Mise à jour du système anti-triche pour détecter plus efficacement les logiciels tiers non autorisés.</li>\n            <li>Renforcement de la sécurité des comptes utilisateurs avec une double authentification.</li>\n            <li>Amélioration des protocoles de chiffrement pour protéger les données personnelles.</li>\n        </ul>\n    </div>\n\n    <div>\n        <h2>Mesures Disciplinaires</h2>\n        <p>Nous prenons au sérieux l\'intégrité du jeu et appliquons des sanctions strictes contre les tricheurs :</p>\n        <ul>\n            <li><strong>Ban temporaire :</strong> Pour les infractions mineures détectées pour la première fois.</li>\n            <li><strong>Ban permanent :</strong> Pour les récidivistes et les utilisateurs de logiciels de triche avancés.</li>\n            <li><strong>Réinitialisation du compte :</strong> Suppression des récompenses acquises de manière frauduleuse.</li>\n        </ul>\n    </div>\n\n    <div>\n        <h2>Appel à la Communauté</h2>\n        <p>Nous vous invitons à nous aider à maintenir un environnement de jeu équitable :</p>\n        <ul>\n            <li>Signalez tout comportement suspect via notre système de signalement en jeu.</li>\n            <li>Ne partagez jamais vos identifiants de connexion, même avec des amis proches.</li>\n            <li>Activez la double authentification pour sécuriser votre compte.</li>\n        </ul>\n    </div>\n\n    <div>\n        <h2>Remerciements</h2>\n        <p>Nous remercions sincèrement notre communauté pour son soutien continu et sa vigilance. Ensemble, nous garantissons une expérience de jeu équitable et amusante pour tous !</p>\n    </div>\n\n    <div>\n        <p>Pour toute question ou problème lié à la sécurité, contactez notre <a href=\"/contact\">service support</a>.</p>\n    </div>', 4, '2025-02-21', 'published'),
(4, 'Aperçu : Version 0.1.2', '<h1>Aperçu de la Prochaine Mise à Jour - Version 0.1.2</h1>\n    <p>Publié le 24 février 2025</p>\n    <section>\n        <h2>Préparez-vous pour une Nouvelle Aventure !</h2>\n        <p>La version 0.1.2 de <strong>Shooting Stars</strong> approche à grands pas ! Découvrez en avant-première ce qui vous attend dans cette mise à jour épique.</p>\n    </section>\n\n    <div>\n        <h2>Nouvelle Zone : Le Volcan des Songes</h2>\n        <p>Explorez un tout nouveau territoire enchanteur, rempli de mystères et de créatures magiques. Le <strong>Volcan des Songes</strong> est un lieu où le rêve et la réalité se rencontrent. Mais attention, de dangereux gardiens veillent sur ces terres...</p>\n    </div>\n\n    <div>\n        <h2>Nouveaux Personnages</h2>\n        <ul>\n            <li><strong>Luna, la Gardienne des Rêves :</strong> Une mage puissante capable de manipuler les illusions et de contrôler le temps.</li>\n            <li><strong>Nébulus, le Chasseur Étoilé :</strong> Un puissant combattant capable d\'absorber les attaques et de les rediriger.</li>\n        </ul>\n    </div>\n\n    <div>\n        <h2>Nouvelles Quêtes et Défis</h2>\n        <ul>\n            <li>Quête principale : <em>Les Secrets des Rêves</em> – Découvrez l\'origine des gardiens du Volcan des Songes.</li>\n            <li>Défis journaliers : Relevez de nouveaux défis pour obtenir des récompenses exclusives.</li>\n        </ul>\n    </div>\n\n    <div>\n        <h2>Date de Sortie et Accès Anticipé</h2>\n        <p>La mise à jour 1.3.0 sera disponible le <strong>15 mars 2025 à 18h00</strong>.\n    </div>\n\n    <div>\n        <p>Restez à l\'écoute pour plus de détails et préparez-vous à plonger dans un monde où les rêves deviennent réalité !</p>\n        <p>Suivez-nous sur nos réseaux sociaux pour ne rien manquer des futures annonces.</p>\n    </div>', 4, '2025-02-24', 'published'),
(5, 'Évènement : Maître des Étoiles', '<h1>Concours \"Maître des Étoiles\" - Montrez vos talents !</h1>\r\n    <p>Publié le 9 février 2025</p>\r\n    <div>\r\n        <h2>Montrez vos compétences et gagnez des récompenses exclusives !</h2>\r\n        <p>\r\n            Participez à notre concours <strong>\"Maître des Étoiles\"</strong> en réalisant les défis imposés dans le jeu. \r\n            Seuls les plus courageux et stratèges réussiront à obtenir le titre ultime !\r\n        </p>\r\n    </div>\r\n\r\n    <div>\r\n        <h2>Comment participer ?</h2>\r\n        <ol>\r\n            <li>Connectez-vous au jeu durant la période de l\'événement : <strong>du 1er au 15 mars 2025</strong>.</li>\r\n            <li>Complétez les défis quotidiens pour accumuler des points.</li>\r\n            <li>Capturez des captures d\'écran de vos meilleurs moments et partagez-les sur les réseaux sociaux avec le hashtag <strong>#MaitreDesEtoiles</strong>.</li>\r\n        </ol>\r\n    </div>\r\n\r\n    <div>\r\n        <h2>Défis à relever :</h2>\r\n        <ul>\r\n            <li>Vaincre le boss légendaire <strong>Astérion, le Dieu de Sépulaga</strong> sans utiliser de potions de soin.</li>\r\n            <li>Terminer le donjon <strong>Forteresse des Étoiles Perdues</strong> en moins de 30 minutes.</li>\r\n            <li>Accumuler un combo de 100 coups en mode Survie.</li>\r\n        </ul>\r\n    </div>\r\n\r\n    <div>\r\n        <h2>Récompenses :</h2>\r\n        <ul>\r\n            <li><strong>1ère place :</strong> Titre exclusif <em>\"Maître des Étoiles\"</em> + Skin légendaire (au choix) + 10 000 pièces d\'or</li>\r\n            <li><strong>2ème place :</strong> Skin légendaire (au choix) + 5 000 pièces d\'or</li>\r\n            <li><strong>3ème place :</strong> Skin légendaire (au choix)</li>\r\n        </ul>\r\n        <p>Tous les participants recevront un badge de participation exclusif !</p>\r\n    </div>\r\n\r\n    <div>\r\n        <h2>Règles du concours :</h2>\r\n        <ul>\r\n            <li>Une seule participation par joueur.</li>\r\n            <li>Les tricheries entraîneront une disqualification immédiate.</li>\r\n            <li>Les gagnants seront annoncés le <strong>20 mars 2025</strong> sur notre site officiel et nos réseaux sociaux.</li>\r\n        </ul>\r\n    </div>\r\n\r\n    <div>\r\n        <p>Bonne chance à tous les challengers ! Que les étoiles vous guident vers la victoire !</p>\r\n    </div>', 4, '2025-02-09', 'published');

-- --------------------------------------------------------

--
-- Table structure for table `places_of_origin`
--

CREATE TABLE `places_of_origin` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `display_order` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `places_of_origin`
--

INSERT INTO `places_of_origin` (`id`, `name`, `display_order`) VALUES
(1, 'Étoiles', 1),
(2, 'Poussiage', 5),
(5, 'Éclipse', 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `characters`
--
ALTER TABLE `characters`
  ADD PRIMARY KEY (`id`),
  ADD KEY `origin` (`origin`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`),
  ADD KEY `author` (`author`);

--
-- Indexes for table `places_of_origin`
--
ALTER TABLE `places_of_origin`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `characters`
--
ALTER TABLE `characters`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `places_of_origin`
--
ALTER TABLE `places_of_origin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `characters`
--
ALTER TABLE `characters`
  ADD CONSTRAINT `characters_ibfk_1` FOREIGN KEY (`origin`) REFERENCES `places_of_origin` (`id`);

--
-- Constraints for table `news`
--
ALTER TABLE `news`
  ADD CONSTRAINT `news_ibfk_1` FOREIGN KEY (`author`) REFERENCES `accounts` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
