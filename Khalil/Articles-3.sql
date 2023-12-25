-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:8889
-- Généré le : ven. 22 déc. 2023 à 18:47
-- Version du serveur : 5.7.39
-- Version de PHP : 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `Articles`
--

-- --------------------------------------------------------

--
-- Structure de la table `articles`
--

CREATE TABLE `articles` (
  `Id_art` int(11) NOT NULL,
  `Nom` varchar(10) DEFAULT NULL,
  `quantités` int(2) DEFAULT NULL,
  `prix` decimal(4,2) DEFAULT NULL,
  `Image` varchar(27) DEFAULT NULL,
  `description` varchar(64) DEFAULT NULL,
  `ID_STRIPE` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `articles`
--

INSERT INTO `articles` (`Id_art`, `Nom`, `quantités`, `prix`, `Image`, `description`, `ID_STRIPE`) VALUES
(1, 'MaillotDom', 18, '69.00', '/Khalil/Images/IMG_5317.jpg', 'Maillot des icônes de foot porté au 20 ème siècles à domicile', 'price_1OFwzQKZD4b1xfUyv3PisuLd'),
(2, 'MaillotExt', 39, '69.99', '/Khalil/Images/IMG_5318.jpg', 'Maillot des icônes de foot porté au 20 ème siècles à l’exterieur', 'price_1OFx16KZD4b1xfUySrW8Pfnk'),
(3, 'MaillotThi', 0, '79.99', '/Khalil/Images/IMG_5321.jpg', 'Maillot porté lors des compétitions eurpéenes', 'price_1OFx2dKZD4b1xfUyzLj1BrqI');

-- --------------------------------------------------------

--
-- Structure de la table `Clients`
--

CREATE TABLE `Clients` (
  `id_client` int(11) NOT NULL,
  `nom` varchar(20) DEFAULT NULL,
  `prenom` varchar(20) DEFAULT NULL,
  `adresse` text,
  `numero` int(11) DEFAULT NULL,
  `mail` varchar(255) DEFAULT NULL,
  `mdp` varchar(255) DEFAULT NULL,
  `ID_STRIPE` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `Clients`
--

INSERT INTO `Clients` (`id_client`, `nom`, `prenom`, `adresse`, `numero`, `mail`, `mdp`, `ID_STRIPE`) VALUES
(2, 'Makhloufi', 'Khalil', '59 allée des reds', 909090909, 'VirgilVandijk@gmail.com', '$2y$10$nG8Kggc6yNPbhgqr1SPwQ.ihQsH2t.rb9bQHTluPfylRinAu7Pby.', '2'),
(3, 'Robin', 'Van persie', '20 allée d\'Arsenal', 789898989, 'robin@gmail.com', '$2y$10$ejNEwQfSxVnCaeZv1eoLiu5Tq9Gy/5rdoLL/jQZA592k98GPLTG/6', '3'),
(8, 'Khalil', 'Makhloufi', '20 liverpool', 707070707, 'khalil4vandijk@gmail.com', '$2y$10$Hd7wOwa7VUs8goZKEHD9nu0mqWnTZ/3PCWx08iWWTNHYZbmbPCmD.', '8'),
(9, 'Dimi', 'Berbatov', '34 united', 909090909, 'berbatov@gmail.com', '$2y$10$SkI0vnRJO74UxqF2vlGPHuffulgHz8RnCEodPpuGv1Z1TwdsUnbKy', '9'),
(10, 'Khalil', 'KHYHY', '20 phpmyadim SQL', 878787878, 'phpmyadmin@gmail.com', '$2y$10$FH25k8jBKLSAdgHlHCwpnenNEcjdhOjVt/9Xsano4a4dF87/AJmO.', '10'),
(13, 'Khalil', 'Khalil', '20 allee de la largade', 787878787, 'poureir@gmail.com', '$2y$10$w8JwpdqA6ymqb.re04dyj.XM9sQByhAv7GPc2k.ni74end58a09Xq', '13'),
(14, 'Martin', 'Gelson', '56 rue du portugal', 987878778, 'gelsonmartins@gmail.com', '$2y$10$QcUOxwNdCfsdtEbKixngjOtDsbVGZWvYwkDBe6QVnlj2ddDV0M8d6', '14'),
(15, 'Khalil', 'jhauaj', 'gegege', 678767675, 'khalil9ju@gmail.com', '$2y$10$SX4XAkHq00R/QcXMYvF4a.z8z4CaLQRtoD4c1xC7tCw3lsbldSRD.', '15'),
(16, 'khalil', 'Forlan', '67 geyr eheh', 987878787, 'khaliljq@gmail.com', '$2y$10$4kkh1yjDCi924LMAxgqDSeBxiht3vYNkw.pEU8Wlilft5J5VCZALy', '16'),
(19, 'makhloufi', 'khili', '90 eooe', 989898989, 'khalilvdf@gmail.com', '$2y$10$0TZ9PPJ6Zy83sdCjS8opturzKhN6gf0HrI8/EWN/k9RzZ8EBELO3m', '19'),
(20, 'khalil', 'makhloufi', '45 allée de lart', 756545454, 'khaheh@gmail.com', '$2y$10$CVF5POQtxjNBgGWVlylGKOJtNgAcqYa69QHXnr/TaBATookfhbbma', '20'),
(21, '', 'Makhloufi', '38 allee des soupirs', 909090909, 'khaliheuh@gmail.com', '$2y$10$ujLEqNiWcK2Ic3DxtGAO.OtrLHx7FnRzr/ALMh4feUhYVQX9RZfeS', '21'),
(22, 'vggjgjgj', 'jkhgkjhgkjgkj', 'hhjhjh', 712141567, 'ffggfgfhg@gmail.com', '$2y$10$E6fmKwXtwRcELhEuop0Vy.GHaK5QqXjHEv/Ma8F2/rVveHgfZe1ma', '22'),
(41, 'khalil', 'makhloufi', '21 allée de la largade', 787878787, 'robhin@gmail.com', '$2y$10$KW74Ce90G6Ahoy84pmbYGufXMQjEMLRjR7M4EFScpHKpqBsdwWldq', '41'),
(42, 'khalil', 'makhloufi', 'JJJjj', 989898989, 'khalil@gmail.com', '$2y$10$tyzHLUNj7PpRvKF8qsgkGuT9eyEjpwSs/SKZqLJG5KfRIseXcl8zq', '42'),
(43, 'khalil', 'ahaaaha', 'UUU!aaua', 909898989, 'khali@gmail.com', '$2y$10$M.H9hnz5G2YfmBOo/S.9WeMbezXo2h7LAmqejkvusQ1SfGF5lY.Wa', '43'),
(44, 'bbb', 'bbb', 'bbb', 909090909, 'khalil4ajauia@gmai.com', '$2y$10$Lnk7StUQL48heTQrigGauOdIYEhqCeYN6HNsBN.05wfWj.A8HEnjq', '44'),
(49, 'bbb', 'bbb', 'bbb', 909090909, 'khalilPOPO@gmail.com', '$2y$10$2ax5NeZ3QPnM4saf5Ucq3efiEZSFVB3m1R7LbJ3D7CI/TrPgcqkgy', '49'),
(50, 'ff', 'ff', 'fff', 909090909, 'khalil5kkzz@gmail.com', '$2y$10$FrXEHrR44Hu.r8pIYm4Mpuike4T/9L8SHuFhIfRYXLHDfBF2nYE9W', '50'),
(51, 'kkkkk', 'kkkkkk', 'kkakakk', 90909090, 'mappzp@gmail.com', '$2y$10$LZKOjMVN.dpdFI.AGkzwTeLNxlCF0lQJFvan.TPuNTPdVTx4q30JC', '51'),
(52, 'ghhg', 'hghggh', 'hghgghgh', 909090909, 'Vaoaoao@gmail.com', '$2y$10$IaBB/bbM6iHYRuGLsOqgYeFb2sZC00L9dJ8Qy2cfe2tVjJcNXUTCm', '52'),
(53, 'Khalil', 'www', 'wwww', 909090909, 'khalihhhl@gmail.com', '$2y$10$nDPYyp..6pF2PF4zf5oIyufZmu7YBce5gNI8g3GK9chpDdmBHEGRi', '53'),
(54, 'khalil', 'makhloufi', '34 allée de la uitjie', 876543246, 'bbrobin@gmail.com', '$2y$10$ghjLDl5P8FYU31US4kLksepCQc1mzhH3MnyTRWDWE1YDE.2SSEFly', '54'),
(55, 'aaa', 'aa', 'kakakakak', 909, 'Vandijk4@gmail.com', '$2y$10$VYrdcFfu4Xh50saAHg7oF.rT0C3ibM8NSj.Ck5tlGBCl3Mq6neFdq', '55'),
(56, 'xjjxjx', 'xnnxnx', 'xxxxx', 7, 'khannnnli@gmail.com', '$2y$10$05hdKSIg0LhHCuX30A.e4.d8D8Qg6DBoPFLzTTkpbGkaK5nCyuT92', '56'),
(57, 'Makhloufi', 'Khalil', '676 rte gagne', 989898989, 'robnin@gmail.com', '$2y$10$6QlYml7HKZohfYxlFPntYe3HdvDHitHDx9DpC8bfqPPMQqB9HdB9G', '57'),
(59, 's', 's', 's', 909090909, 'hhh@gmail.com', '$2y$10$EIaOng./uvRXHv9Qm.fb3e/m5/vUTAK.YPlFl9gbWowGwLxjhDI/K', '59'),
(61, 'KAAOKa', 'Khal', '71777171771', 990999999, 'nnnnn@gmail.com', '$2y$10$0CFIGFaEskdWFuYXT/dWpuCwH6R8/qR6rD7hGK4rClYbBhZGGDItu', '61'),
(62, 'kakakak', 'khalil', 'bababba', 909090900, 'khalilll@gmail.com', '$2y$10$yJZ2fbmtCs2UL9wdDjL9KOpY011jD6jjbNBw6iYERTFGkYnCuHkDS', '62'),
(63, 'khujhuj', 'bbbbb', 'poopoàop', 1111111111, 'lolojujhu@gmail.com', '$2y$10$l2PUqpEKW6HO13oW/.2XIOoTHnyXV713nzJNUX/EEwAvR7KEsU8mG', '63'),
(64, 'v', 'v', 'bhvgcfx', 0, 'knjbhvgcf@gmail.com', '$2y$10$1rb0jxPSCyoL3asmszFNduGaYWageqknYX56DBH0BIhzgaoiXRB6u', '64'),
(65, 'lllll', 'kkkkk', 'nnnnn', 0, 'kihjuhj@gmail.com', '$2y$10$Z.Qleg8tY.pM.uTjQNMkJ.XgDOHaUIIzL8Y6MOqyVbRRPgk0abxAq', '65'),
(66, 'nnnn', 'oi', 'nnn', 0, 'juj@gmail.com', '$2y$10$KNtKjGLAxFu.EHhxVeZnTO7JD9fTsWY8i3fhzQIwHw4JRBsYD6Jtu', '66'),
(67, 'qbqbbq', 'qbbqbqbq', 'PO', 909090909, 'khalaij@gmail.com', '$2y$10$HJNxRDyPlNtfcMdbjN4OguiMXdUn.nZuMTKqPaDfqbA.RZJEoKXsm', '67'),
(68, 'llqlqlq', 'qnqnqnqn', '090909090909', 989898989, 'khalil4vadijk@gmail.com', '$2y$10$geaCTs9vkRYJ82kv3icXrOCZ.3O3lED9LILXKNOYZLYRXPL/2TxBa', '68'),
(69, 'kksks', 'sss', 'ssss', 909090909, 'nwwnnwwn@gmail.com', '$2y$10$JqH//Ebgj3s6ZsRH9khsz.BjdOxPIyA12XaIiq1pNN5ZxkD.dh1am', '69'),
(70, 'bb', 'bb', 'lll', 2111111111, 'khalil9@gmail.com', '$2y$10$SIndBjGrD77QuXbJQ8vACOQy547.58wcZm2RHFMR8khz3DrEGU68W', '70'),
(71, 'makhloufi', 'khalil', '89 allre largade', 909090909, 'khalil4vd@gmail.com', '$2y$10$dnCpm4UNhpaC9108L9Brm.szh4dtSdT/37.eNjjUaPTDyogxVYyqi', 'cus_P61Mp1S3pFKMsT'),
(72, 'Patrick', 'Vieira', '98 alee de france', 909090909, 'Vieira4DC@gmail.com', '$2y$10$mgtf5bFaP/TcvOWDEM2/ae2A0IV0V9c/VJjPMmxtxLwamazvXX1BW', '72'),
(73, 'baba', 'abbaba', 'auauua', 909090909, 'Davidluiz@gmail.com', '$2y$10$yO5lPXreXPi6irB0zHcDxutE577563nv9mpp4bsIGHoxQ06lZoeLi', '73'),
(75, 'jajaja', 'aababa', 'aabababa', 909090909, 'khalilV@gmail.com', '$2y$10$yV1.Y1JI1o.kDS42VH0K3uQ7tiM8k8kA2.qlRbqwd72QvosO5aFO.', '75'),
(77, 's', 's', 's', 909090909, 'khaljiijjuh@gmail.com', '$2y$10$RPR3YFAVMpxfjeXEdJcQ9.hkq.eazqMxC2dAYenGig/hEivlM3aJ.', '77'),
(78, 'ss', 'ss', 'ss', 787878787, 'khalilaggaga@gmail.com', '$2y$10$49SfMEbeWcRPRxYiWdVa4exTfybk3MdkP7UVRXsU7ffapIcS/8s1i', '78'),
(80, 'x', 'x', 'x', 909090909, 'kcccchali@gmail.com', '$2y$10$czNfgy1zln5AGsnbEaJTWe1C2PcttTUZSVjhTpqFnCrkL6rAR.2he', '80'),
(82, 'ffff', 'ffff', '20 lalalla', 876765324, 'Gaerobin@gmail.com', '$2y$10$cAtBTDPbDTvJHgRsA7oILOB0K2cY9RfUgIhM.StaJ6tGGvZOqRPiW', '82'),
(84, 'f', 'f', 'f', 909090909, 'sggsgsgsrobin@gmail.com', '$2y$10$rx7JizP386eQoOU3e5YZYuGXhDOmhZrg10y9nYeBA78syIKabPXtW', '84'),
(86, 'Makhloufi', 'Khalil', 'lll', 909090909, 'robiggn@gmail.com', '$2y$10$/.mvtXADUuCd4XEjJBiBLuvhbHRO4d5j750QE.5aBIdjV6MkF4FGS', NULL),
(87, 'Khalil', 'Makhloufi', '34 allée de Liverpool', 909090909, 'khalil4vdd@gmail.com', '$2y$10$9ZlMt22w4ah10v/g3TO5COF7AKKowOIwPYGZp6WIL3xiiRTJ1LtKS', NULL),
(88, 'kka', 'kakak', 'akaka', 909090909, ' khalil4bsvd@gmail.com', '$2y$10$4o9fNYsWquY7jm6JsI1x.uHVDRp1kLEE14QIXs3/rMAOVLStS1hle', NULL),
(89, 'JHuah', 'Khalil', '10 allée de liverpool', 909090909, 'okok@gmail.com', '$2y$10$H.VBjyvxMyNCXcdXvPOoVOLdBp1LUC4C6VJYW37Yb.iWXhZ4AqR.e', 'cus_P8gYJjzqCiisrT'),
(90, 'd', 'd', 'd', 909090909, 'khalil4bsbsbbs@gmail.com', '$2y$10$RfNCJciUVz6CARazTcvfzOxSsp6p39wTUAv3fZL8pPAHHUSWdDGTW', NULL),
(91, 'Compte', 'B', 'B UPV', 909090909, 'CompteB@gmail.com', '$2y$10$sUE9dnmLd.Y7oxSGke8kiOzn4VMQbl8kMaSOKpPYEgTujv.uSHplq', NULL),
(95, 'Compte', 'A', 'UPV', 909090909, 'CompteA@gmail.com', '$2y$10$DQ7Kg2K8j/V13utXxHCTeOgGYxKcG.QB6QLKMobJkz073l9kTtj52', 'cus_P8jVZFsXqtKKNw');

-- --------------------------------------------------------

--
-- Structure de la table `Commandes`
--

CREATE TABLE `Commandes` (
  `id_commande` int(11) NOT NULL,
  `Id_art` int(11) DEFAULT NULL,
  `id_client` int(11) DEFAULT NULL,
  `quantite` int(11) DEFAULT NULL,
  `envoi` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `Commandes`
--

INSERT INTO `Commandes` (`id_commande`, `Id_art`, `id_client`, `quantite`, `envoi`) VALUES
(1, 1, 8, 1, 0),
(2, 1, 8, 1, 0),
(3, 2, 8, 1, 0),
(4, 1, 8, 1, 0),
(5, 2, 8, 1, 0),
(6, 3, 8, 3, 0),
(7, 2, 8, 1, 0),
(8, 2, 8, 1, 0),
(9, 2, 8, 1, 0),
(10, 2, 8, 1, 0),
(11, 2, 8, 1, 0),
(12, 1, 8, 8, 0),
(13, 3, 71, 1, 0),
(14, 1, 71, 1, 0),
(15, 2, 71, 3, 0),
(16, 1, 71, 1, 0),
(17, 1, 71, 2, 0),
(18, 1, 89, 1, 0),
(19, 3, 89, 10, 0),
(20, 2, 89, 13, 0),
(21, 1, 71, 1, 0),
(22, 1, 95, 1, 0),
(23, 2, 95, 1, 0),
(24, 3, 95, 32, 0);

-- --------------------------------------------------------

--
-- Structure de la table `message`
--

CREATE TABLE `message` (
  `id_mess` int(11) NOT NULL,
  `mess` text NOT NULL,
  `timestamp` datetime DEFAULT CURRENT_TIMESTAMP,
  `Id_client` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `message`
--

INSERT INTO `message` (`id_mess`, `mess`, `timestamp`, `Id_client`) VALUES
(42, 'bitch', '2023-12-22 19:28:53', 71),
(43, 'whore', '2023-12-22 19:29:03', 71),
(44, 'the', '2023-12-22 19:34:16', 71);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`Id_art`);

--
-- Index pour la table `Clients`
--
ALTER TABLE `Clients`
  ADD PRIMARY KEY (`id_client`),
  ADD UNIQUE KEY `mail` (`mail`),
  ADD KEY `numero` (`numero`) USING BTREE,
  ADD KEY `numero_2` (`numero`),
  ADD KEY `numero_3` (`numero`),
  ADD KEY `numero_4` (`numero`);

--
-- Index pour la table `Commandes`
--
ALTER TABLE `Commandes`
  ADD PRIMARY KEY (`id_commande`),
  ADD KEY `Id_art` (`Id_art`),
  ADD KEY `id_client` (`id_client`);

--
-- Index pour la table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id_mess`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `Clients`
--
ALTER TABLE `Clients`
  MODIFY `id_client` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=96;

--
-- AUTO_INCREMENT pour la table `Commandes`
--
ALTER TABLE `Commandes`
  MODIFY `id_commande` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT pour la table `message`
--
ALTER TABLE `message`
  MODIFY `id_mess` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `Commandes`
--
ALTER TABLE `Commandes`
  ADD CONSTRAINT `commandes_ibfk_1` FOREIGN KEY (`Id_art`) REFERENCES `articles` (`Id_art`),
  ADD CONSTRAINT `commandes_ibfk_2` FOREIGN KEY (`id_client`) REFERENCES `Clients` (`id_client`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
