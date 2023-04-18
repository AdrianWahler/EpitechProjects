-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost

-- Généré le : jeu. 16 mars 2023 à 11:47
-- Version du serveur : 10.4.27-MariaDB
-- Version de PHP : 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `common_database`
--

-- --------------------------------------------------------

--
-- Structure de la table `banner`
--

CREATE TABLE `banner` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `Path` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `banner`
--

INSERT INTO `banner` (`id`, `user_id`, `Path`) VALUES
(1, 1, 'http://localhost/twitter/uploads/defaultBanner.png'),
(2, 2, 'http://localhost/twitter/uploads/defaultBanner.png'),
(5, 18, 'http://localhost/twitter/uploads/defaultBanner.png');

-- --------------------------------------------------------

--
-- Structure de la table `follow`
--

CREATE TABLE `follow` (
  `user_id` int(11) NOT NULL,
  `followed_user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `follow`
--

INSERT INTO `follow` (`user_id`, `followed_user_id`) VALUES
(1, 2),
(2, 1),
(2, 3),
(1, 3);

-- --------------------------------------------------------

--
-- Structure de la table `hashtag`
--

CREATE TABLE `hashtag` (
  `tweet_id` int(11) NOT NULL,
  `hashtag_name` varchar(140) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `hashtag`
--

INSERT INTO `hashtag` (`tweet_id`, `hashtag_name`) VALUES
(38, 'test'),
(38, 'tweet'),
(38, 'pog'),
(39, 'testing'),
(39, 'dealwithit'),
(40, 'testing'),
(40, 'dealwithit'),
(41, 'testing'),
(41, 'dealwithit'),
(42, 'hifirushisdope'),
(43, 'hashtag'),
(44, 'test'),
(45, 'test');

-- --------------------------------------------------------

--
-- Structure de la table `like`
--

CREATE TABLE `like` (
  `user_id` int(11) NOT NULL,
  `tweet_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `like`
--

INSERT INTO `like` (`user_id`, `tweet_id`) VALUES
(2, 22),
(2, 20),
(1, 27),
(1, 29),
(1, 26),
(2, 18),
(2, 41),
(2, 44),
(1, 46),
(2, 47),
(1, 51);

-- --------------------------------------------------------

--
-- Structure de la table `mention`
--

CREATE TABLE `mention` (
  `user_id` int(11) NOT NULL,
  `mentionned_user_id` int(11) NOT NULL,
  `tweet_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `mention`
--

INSERT INTO `mention` (`user_id`, `mentionned_user_id`, `tweet_id`) VALUES
(2, 1, 41),
(2, 3, 42),
(2, 9, 46),
(1, 3, 58);

-- --------------------------------------------------------

--
-- Structure de la table `message_image`
--

CREATE TABLE `message_image` (
  `message_id` int(11) NOT NULL,
  `Path` varchar(255) NOT NULL,
  `Date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `message_image`
--

INSERT INTO `message_image` (`message_id`, `Path`, `Date`) VALUES
(29, 'http://localhost/twitter/uploads/imageMessage29.png', '2023-03-13 11:51:03'),
(30, 'http://localhost/twitter/uploads/imageMessage30.png', '2023-03-13 14:26:10'),
(31, 'http://localhost/twitter/uploads/imageMessage31.png', '2023-03-13 14:27:16'),
(32, 'http://localhost/twitter/uploads/imageMessage32.png', '2023-03-13 14:27:20'),
(33, 'http://localhost/twitter/uploads/imageMessage33.png', '2023-03-13 14:27:20'),
(34, 'http://localhost/twitter/uploads/imageMessage34.png', '2023-03-13 14:31:47'),
(39, 'http://localhost/twitter/uploads/imageMessage39.png', '2023-03-13 14:35:31'),
(40, 'http://localhost/twitter/uploads/imageMessage40.png', '2023-03-13 14:35:36'),
(41, 'http://localhost/twitter/uploads/imageMessage41.png', '2023-03-13 14:35:41'),
(43, 'http://localhost/twitter/uploads/imageMessage43.png', '2023-03-13 14:49:11');

-- --------------------------------------------------------

--
-- Structure de la table `notifications`
--

CREATE TABLE `notifications` (
  `user_id` int(11) NOT NULL,
  `content` varchar(255) NOT NULL,
  `tweet_id` int(11) NOT NULL,
  `notifying_user_id` int(11) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `private_message`
--

CREATE TABLE `private_message` (
  `id` int(11) NOT NULL,
  `user_from` int(11) NOT NULL,
  `user_to` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `message` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `private_message`
--

INSERT INTO `private_message` (`id`, `user_from`, `user_to`, `date`, `message`) VALUES
(1, 2, 1, '2023-03-09 10:44:22', 'Hey dude, wassup?'),
(2, 1, 2, '2023-03-09 10:44:39', 'Not much, wbu?'),
(3, 2, 9, '2023-03-09 10:44:58', 'You\'s still a bitch'),
(4, 10, 2, '2023-03-09 10:45:10', 'Buy my game'),
(5, 2, 1, '2023-03-09 14:27:21', ''),
(6, 2, 1, '2023-03-09 14:37:19', 'Test'),
(7, 2, 1, '2023-03-09 14:38:17', 'Test again'),
(8, 2, 1, '2023-03-09 14:38:21', 'Test again'),
(9, 2, 1, '2023-03-09 14:39:37', 'This is another test'),
(10, 2, 1, '2023-03-09 14:39:50', 'guess what more tests'),
(11, 2, 1, '2023-03-09 14:48:34', 'Fucking hell'),
(12, 2, 10, '2023-03-09 14:56:17', 'No'),
(13, 2, 10, '2023-03-09 14:56:27', 'I prefer ultrakill'),
(14, 2, 10, '2023-03-09 14:56:27', 'I prefer ultrakillnerd'),
(15, 2, 10, '2023-03-09 14:58:29', 'Hold on'),
(16, 2, 10, '2023-03-09 14:58:33', 'Lemme try somthing'),
(17, 2, 10, '2023-03-09 14:58:35', 'Cool'),
(18, 2, 1, '2023-03-09 15:45:45', 'I\'m going insane over here'),
(19, 2, 1, '2023-03-09 15:45:53', 'This is NOT healthy'),
(20, 2, 1, '2023-03-09 15:45:55', 'oietjoiherjoipzrtjipzrhoirzhiopzetrhgerhgaeirohgeroihgeaoirhgaeroghaerg'),
(21, 2, 1, '2023-03-09 15:58:02', 'njyhjghg'),
(22, 2, 1, '2023-03-09 16:04:28', 'nyjyjgjg'),
(23, 2, 1, '2023-03-10 10:07:31', 'THIS IIIIIIIIIIIIIIIIIIIIIS THE SORT OF A GIIIIIIIIRL THIS IS THE STORY OF A GIIIIIIIIIIRL THIS IS THE STORY OF A GIIIIIIIIIIRL'),
(24, 2, 1, '2023-03-13 11:46:58', 'This message has an image'),
(25, 2, 1, '2023-03-13 11:47:41', 'Previous message did not manage to send the image. Disregard.'),
(26, 2, 1, '2023-03-13 11:47:59', 'This one should have an image. '),
(27, 2, 1, '2023-03-13 11:49:16', 'Nope still no image'),
(28, 2, 1, '2023-03-13 11:49:46', 'ok'),
(29, 2, 1, '2023-03-13 11:51:03', 'azeaze'),
(30, 2, 1, '2023-03-13 14:26:10', 'YO THIS SHIT WORKS????'),
(31, 2, 1, '2023-03-13 14:27:16', 'pog pog pog pog pog pog pog pog '),
(32, 2, 1, '2023-03-13 14:27:20', 'pog pog pog pog pog pog pog pog '),
(33, 2, 1, '2023-03-13 14:27:20', 'pog pog pog pog pog pog pog pog '),
(34, 2, 1, '2023-03-13 14:31:47', 'more tests'),
(35, 2, 1, '2023-03-13 14:33:04', 'fucking'),
(36, 2, 1, '2023-03-13 14:33:50', 'bitch ass'),
(37, 2, 1, '2023-03-13 14:34:33', 'motherfucker'),
(38, 2, 1, '2023-03-13 14:35:20', '5 fails in a row istg'),
(39, 2, 1, '2023-03-13 14:35:31', 'maybe it works.....???'),
(40, 2, 1, '2023-03-13 14:35:36', 'IT FUCKING WORKS'),
(41, 2, 1, '2023-03-13 14:35:41', 'oh.'),
(42, 2, 1, '2023-03-13 14:47:34', 'azezae'),
(43, 2, 1, '2023-03-13 14:49:11', 'Ok so this has an image'),
(44, 2, 1, '2023-03-13 14:49:16', 'and this one shouldn\'t'),
(45, 2, 1, '2023-03-13 14:49:23', 'N I C E '),
(46, 2, 1, '2023-03-13 15:02:03', 'azeaze'),
(47, 1, 3, '2023-03-14 16:28:53', 'Hey does this work?'),
(48, 1, 3, '2023-03-14 16:28:55', 'Oh?'),
(49, 1, 3, '2023-03-14 16:28:57', 'Poggers'),
(50, 1, 1, '2023-03-14 16:29:19', 'bjr'),
(51, 1, 9, '2023-03-14 16:29:54', 'bjr'),
(52, 18, 1, '2023-03-15 09:58:19', 'whassup dickhead');

-- --------------------------------------------------------

--
-- Structure de la table `profile_image`
--

CREATE TABLE `profile_image` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `Path` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `profile_image`
--

INSERT INTO `profile_image` (`id`, `id_user`, `Path`) VALUES
(1, 1, 'http://localhost/twitter/uploads/profileImage1-0.png'),
(2, 2, 'http://localhost/twitter/uploads/profileImage2-0.png'),
(3, 3, 'http://localhost/twitter/uploads/default.png'),
(4, 9, 'http://localhost/twitter/uploads/default.png'),
(5, 10, 'http://localhost/twitter/uploads/default.png'),
(12, 18, 'http://localhost/twitter/uploads/default.png');


-- --------------------------------------------------------

--
-- Structure de la table `retweet`
--

CREATE TABLE `retweet` (
  `user_id` int(11) NOT NULL,
  `tweet_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `retweet`
--

INSERT INTO `retweet` (`user_id`, `tweet_id`) VALUES
(1, 11),
(3, 11),
(2, 18),
(2, 21),
(2, 22),
(2, 41),
(1, 46);

-- --------------------------------------------------------

--
-- Structure de la table `tweet`
--

CREATE TABLE `tweet` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `content` varchar(140) NOT NULL,
  `comment_of` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `tweet`
--

INSERT INTO `tweet` (`id`, `user_id`, `date`, `content`, `comment_of`) VALUES
(1, 1, '2023-02-23 10:47:25', 'I love cakes uwu', NULL),
(2, 2, '2023-02-23 10:56:25', 'azeazeaze', NULL),
(3, 2, '2023-02-23 11:01:04', 'azeazeaze', NULL),
(4, 2, '2023-02-23 11:01:13', 'azeazeaze', NULL),
(5, 2, '2023-02-23 11:01:32', 'Legalize catnip', NULL),
(6, 2, '2023-02-23 11:01:58', 'Legalize catnip', NULL),
(7, 2, '2023-02-23 11:02:03', 'Legalize catnip', NULL),
(8, 2, '2023-02-23 11:02:04', 'Legalize catnip', NULL),
(9, 2, '2023-02-23 11:02:55', 'Legalize catnip', NULL),
(10, 2, '2023-02-23 11:04:06', 'Legalize catnip', NULL),
(11, 2, '2023-02-23 11:21:35', 'Legalize catnip', NULL),
(12, 2, '2023-02-23 11:35:52', 'Legalize catnip', NULL),
(13, 1, '2023-02-24 11:39:32', 'This is a tweet', NULL),
(14, 1, '2023-02-24 11:39:41', 'This is another tweet', NULL),
(15, 1, '2023-02-24 11:39:50', 'This is another other tweet', NULL),
(16, 1, '2023-02-24 11:39:57', 'This is a 4th tweet', NULL),
(17, 1, '2023-02-24 11:40:02', 'Man i\'m hungry', NULL),
(18, 3, '2023-02-24 15:34:23', 'I AM MISTER TEACUP', NULL),
(19, 3, '2023-02-24 15:59:27', 'I AM STILL MISTER TEACUP', NULL),
(20, 3, '2023-02-24 16:42:18', 'FUCK YEAH MISTER TEAAAAAAAAAAAAAA', NULL),
(21, 3, '2023-02-24 16:42:31', 'Chai tea is for the weak.', NULL),
(22, 3, '2023-02-24 16:42:48', 'GREEN TEA IS THE BEST THO HELL YEAH', NULL),
(23, 4, '2023-03-02 10:04:21', 'I love beans', NULL),
(24, 2, '2023-03-02 10:25:28', 'ZAEAZEAZE', NULL),
(25, 2, '2023-03-02 14:57:15', 'azeazeaze', NULL),
(26, 2, '2023-03-02 15:07:07', 'I love crack cocaine!', NULL),
(27, 2, '2023-03-02 15:15:23', 'Just inject it into my fucking veins god please', NULL),
(29, 2, '2023-03-02 15:48:29', 'This is a tweet with random images', NULL),
(30, 1, '2023-03-02 15:56:13', 'I have a discord pfp', NULL),
(31, 2, '2023-03-03 10:57:43', '@wow HEY YOU\'S A LITTLE BITCH', NULL),
(38, 2, '2023-03-03 11:16:32', 'This is a #test #tweet ! #pog', NULL),
(39, 2, '2023-03-03 11:18:21', '@wow I\'m #testing with your handle #dealwithit', NULL),
(40, 2, '2023-03-03 11:23:14', '@wow I\'m #testing with your handle #dealwithit', NULL),
(41, 2, '2023-03-03 11:26:01', '@wow I\'m #testing with your handle #dealwithit', NULL),
(42, 2, '2023-03-03 11:55:48', '@MisterTea the FUCK DID YOU SAY ABOUT CHAI?? #hifirushisdope', NULL),
(43, 2, '2023-03-03 13:26:45', 'This a test for the #hashtag hashtag. Yep.', NULL),
(44, 2, '2023-03-03 13:54:47', 'This one tweet with the #test hashtag', NULL),
(45, 2, '2023-03-03 13:55:07', 'This is a second tweet with the #test hashtag', NULL),
(46, 2, '2023-03-03 14:37:19', '@sirlordquentintrembley u is a bitch', NULL),
(47, 2, '2023-03-03 15:46:24', 'c\'est bientot le week end yeepee', NULL),
(48, 1, '2023-03-06 14:32:48', 'Hello', NULL),
(49, 1, '2023-03-06 14:34:51', 'PJKFOQEKJG¨PZEkj^pgkzr$hkzer$ĥkp$^qethk^pqetk^phqekt^ph', NULL),
(50, 1, '2023-03-06 15:19:48', 'azeaze', NULL),
(51, 1, '2023-03-06 15:33:56', 'ce n\'est plus le week end', '47'),
(52, 1, '2023-03-06 15:38:42', 'This is not a response tweet', NULL),
(53, 1, '2023-03-06 15:43:56', 'azea', NULL),
(54, 2, '2023-03-06 16:06:53', 'Non ta gueule', '53'),
(55, 2, '2023-03-06 16:17:24', 'hghgh', '52'),
(56, 2, '2023-03-07 15:21:22', 'http://localhost/twitter/uploads/profileImage2-0.png', NULL),
(57, 2, '2023-03-08 09:37:45', 'Test', NULL),
(58, 1, '2023-03-08 14:27:15', 'aeazea @MisterTea', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `tweet_image`
--

CREATE TABLE `tweet_image` (
  `id` int(11) NOT NULL,
  `tweet_id` int(11) NOT NULL,
  `Path` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `tweet_image`
--

INSERT INTO `tweet_image` (`id`, `tweet_id`, `Path`) VALUES
(4, 12, 'http://localhost/twitter/uploads/imageTweet12-0.png'),
(5, 12, 'http://localhost/twitter/uploads/imageTweet12-1.png'),
(6, 12, 'http://localhost/twitter/uploads/imageTweet12-2.png'),
(7, 24, 'http://localhost/twitter/uploads/imageTweet24-0.jpg'),
(8, 24, 'http://localhost/twitter/uploads/imageTweet24-1.png'),
(9, 24, 'http://localhost/twitter/uploads/imageTweet24-2.png'),
(10, 29, 'http://localhost/twitter/uploads/imageTweet29-0.png'),
(11, 29, 'http://localhost/twitter/uploads/imageTweet29-1.png'),
(12, 29, 'http://localhost/twitter/uploads/imageTweet29-2.jpg'),
(13, 57, 'http://localhost/twitter/uploads/imageTweet57-0.png'),
(14, 57, 'http://localhost/twitter/uploads/imageTweet57-1.jpg'),
(15, 57, 'http://localhost/twitter/uploads/imageTweet57-2.jpg'),
(16, 57, 'http://localhost/twitter/uploads/imageTweet57-3.png'),
(17, 57, 'http://localhost/twitter/uploads/imageTweet57-4.png'),
(18, 57, 'http://localhost/twitter/uploads/imageTweet57-5.png'),
(19, 57, 'http://localhost/twitter/uploads/imageTweet57-6.png');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `birthdate` datetime NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `mail` varchar(255) NOT NULL,
  `password` varchar(70) NOT NULL,
  `bio` varchar(255) NOT NULL,
  `theme` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `username` varchar(45) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT current_timestamp(),
  `handle` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `birthdate`, `firstname`, `lastname`, `mail`, `password`, `bio`, `theme`, `city`, `username`, `created_date`, `handle`) VALUES
(1, '2023-02-21 11:07:56', 'Bob', 'Dylan', 'aventurier@toutguerriers.fr', '4064b7b1071638f88834e7c10f92fdb31fdfec05', 'wow', 'wow', 'wow', 'wow', '2023-02-21 11:07:56', 'wow'),
(2, '1991-02-09 00:00:00', 'Marier', 'Sued', 'marier@sued.com', '4064b7b1071638f88834e7c10f92fdb31fdfec05', 'I\'m the mariest of sues', '', 'MarySueLand', 'MARIERSUED', '2023-02-21 16:45:30', 'marysue'),
(3, '1999-02-12 00:00:00', 'Mister', 'Tea', 'mister@tea.com', '4064b7b1071638f88834e7c10f92fdb31fdfec05', '', '', '', 'MisterTea', '2023-02-24 15:04:28', 'MisterTea'),
(4, '1997-03-20 00:00:00', 'Mr', 'Bean', 'bean@gmail.com', '4064b7b1071638f88834e7c10f92fdb31fdfec05', '', '', 'BeanCity', 'bean', '2023-03-02 10:03:28', 'bean'),
(9, '1996-03-14 00:00:00', 'Sir Lord Trembley', 'Quentin', 'gravity@falls.com', '4064b7b1071638f88834e7c10f92fdb31fdfec05', '', '', '', 'sirlordquentintrembley', '2023-03-02 10:42:18', 'sirlordquentintrembley'),
(10, '1950-04-12 00:00:00', 'Doom', 'Guy', 'ripandtear@gmail.com', '4064b7b1071638f88834e7c10f92fdb31fdfec05', '', '', '', 'doomslayer', '2023-03-08 14:40:50', 'doomslayer'),
(18, '1989-04-12 00:00:00', 'Jack', 'Handsome', 'handsomejack@hyperion.com', '4064b7b1071638f88834e7c10f92fdb31fdfec05', '', '', '', 'HandsomeJack', '2023-03-15 09:57:19', 'HandsomeJack');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `banner`
--
ALTER TABLE `banner`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_Banner_user1_idx` (`user_id`);

--
-- Index pour la table `follow`
--
ALTER TABLE `follow`
  ADD KEY `fk_follow_user1` (`user_id`);

--
-- Index pour la table `hashtag`
--
ALTER TABLE `hashtag`
  ADD KEY `fk_hashtag_Tweet1_idx` (`tweet_id`);

--
-- Index pour la table `like`
--
ALTER TABLE `like`
  ADD KEY `fk_like_Tweet1_idx` (`tweet_id`),
  ADD KEY `fk_like_user1_idx` (`user_id`);

--
-- Index pour la table `mention`
--
ALTER TABLE `mention`
  ADD KEY `fk_Mention_Tweet1_idx` (`tweet_id`),
  ADD KEY `fk_Mention_user1_idx` (`user_id`);

--
-- Index pour la table `message_image`
--
ALTER TABLE `message_image`
  ADD KEY `fk_message_image_MP1_idx` (`message_id`);

--
-- Index pour la table `notifications`
--
ALTER TABLE `notifications`
  ADD KEY `fk_Notifications_Tweet1_idx` (`tweet_id`),
  ADD KEY `fk_Notifications_user1_idx` (`user_id`);

--
-- Index pour la table `private_message`
--
ALTER TABLE `private_message`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_MP_user1_idx` (`user_from`),
  ADD KEY `fk_MP_user2_idx` (`user_to`);

--
-- Index pour la table `profile_image`
--
ALTER TABLE `profile_image`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_profile_image_user1_idx` (`id_user`);

--
-- Index pour la table `retweet`
--
ALTER TABLE `retweet`
  ADD KEY `fk_retweet_Tweet_idx` (`tweet_id`),
  ADD KEY `fk_retweet_user1_idx` (`user_id`);

--
-- Index pour la table `tweet`
--
ALTER TABLE `tweet`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_Tweet_user1_idx` (`user_id`);

--
-- Index pour la table `tweet_image`
--
ALTER TABLE `tweet_image`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_IMG_tweet_user1_idx` (`tweet_id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `handle_UNIQUE` (`handle`),
  ADD UNIQUE KEY `mail` (`mail`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `banner`
--
ALTER TABLE `banner`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `private_message`
--
ALTER TABLE `private_message`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT pour la table `profile_image`
--
ALTER TABLE `profile_image`

--
-- AUTO_INCREMENT pour la table `tweet`
--
ALTER TABLE `tweet`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT pour la table `tweet_image`
--
ALTER TABLE `tweet_image`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;


--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `banner`
--
ALTER TABLE `banner`
  ADD CONSTRAINT `fk_Banner_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `follow`
--
ALTER TABLE `follow`
  ADD CONSTRAINT `fk_follow_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `hashtag`
--
ALTER TABLE `hashtag`
  ADD CONSTRAINT `fk_hashtag_Tweet1` FOREIGN KEY (`tweet_id`) REFERENCES `tweet` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `like`
--
ALTER TABLE `like`
  ADD CONSTRAINT `fk_like_Tweet1` FOREIGN KEY (`tweet_id`) REFERENCES `tweet` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_like_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `mention`
--
ALTER TABLE `mention`
  ADD CONSTRAINT `fk_Mention_Tweet1` FOREIGN KEY (`tweet_id`) REFERENCES `tweet` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Mention_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `message_image`
--
ALTER TABLE `message_image`
  ADD CONSTRAINT `fk_message_image_MP1` FOREIGN KEY (`message_id`) REFERENCES `private_message` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `fk_Notifications_Tweet1` FOREIGN KEY (`tweet_id`) REFERENCES `tweet` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Notifications_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `private_message`
--
ALTER TABLE `private_message`
  ADD CONSTRAINT `fk_MP_user1` FOREIGN KEY (`user_from`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_MP_user2` FOREIGN KEY (`user_to`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `profile_image`
--
ALTER TABLE `profile_image`
  ADD CONSTRAINT `fk_profile_image_user1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `retweet`
--
ALTER TABLE `retweet`
  ADD CONSTRAINT `fk_retweet_Tweet` FOREIGN KEY (`tweet_id`) REFERENCES `tweet` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_retweet_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `tweet`
--
ALTER TABLE `tweet`
  ADD CONSTRAINT `fk_Tweet_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `tweet_image`
--
ALTER TABLE `tweet_image`
  ADD CONSTRAINT `fk_IMG_tweet_user1` FOREIGN KEY (`tweet_id`) REFERENCES `tweet` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
