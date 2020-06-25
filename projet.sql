-- phpMyAdmin SQL Dump
-- version 4.1.4
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Jeu 14 Décembre 2017 à 15:23
-- Version du serveur :  5.6.15-log
-- Version de PHP :  5.4.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `projet`
--

-- --------------------------------------------------------

--
-- Structure de la table `comentaireimg`
--

CREATE TABLE IF NOT EXISTS `comentaireimg` (
  `id_cmt` int(4) NOT NULL AUTO_INCREMENT,
  `id_user` int(4) NOT NULL,
  `id_img` int(4) NOT NULL,
  `comentaire` varchar(500) NOT NULL,
  PRIMARY KEY (`id_cmt`),
  KEY `id_user` (`id_user`,`id_img`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Contenu de la table `comentaireimg`
--

INSERT INTO `comentaireimg` (`id_cmt`, `id_user`, `id_img`, `comentaire`) VALUES
(1, 3, 11, 'joli'),
(6, 1, 14, 'friends'),
(7, 3, 11, '<3'),
(4, 3, 13, 'i like'),
(8, 3, 11, ':*');

-- --------------------------------------------------------

--
-- Structure de la table `comentairevideo`
--

CREATE TABLE IF NOT EXISTS `comentairevideo` (
  `id_cmt` int(4) NOT NULL AUTO_INCREMENT,
  `id_user` int(4) NOT NULL,
  `id_video` int(4) NOT NULL,
  `comentaire` varchar(500) NOT NULL,
  PRIMARY KEY (`id_cmt`),
  KEY `id_user` (`id_user`,`id_video`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Contenu de la table `comentairevideo`
--

INSERT INTO `comentairevideo` (`id_cmt`, `id_user`, `id_video`, `comentaire`) VALUES
(1, 1, 4, 'i love'),
(5, 3, 4, 'magnifique'),
(4, 1, 3, 'waw'),
(6, 3, 3, 'yees'),
(7, 1, 3, 'huawei'),
(8, 1, 4, 'awatef'),
(9, 3, 4, 'gg'),
(10, 3, 4, 'gg'),
(11, 3, 4, 'hh');

-- --------------------------------------------------------

--
-- Structure de la table `commentaire`
--

CREATE TABLE IF NOT EXISTS `commentaire` (
  `id_cmt` int(4) NOT NULL AUTO_INCREMENT,
  `id_pub` int(4) NOT NULL,
  `id_user` int(4) NOT NULL,
  `commentaire` varchar(500) NOT NULL,
  PRIMARY KEY (`id_cmt`),
  KEY `id_pub` (`id_pub`),
  KEY `id_user` (`id_user`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=26 ;

--
-- Contenu de la table `commentaire`
--

INSERT INTO `commentaire` (`id_cmt`, `id_pub`, `id_user`, `commentaire`) VALUES
(8, 8, 3, 'tkt '),
(7, 8, 1, 'ok'),
(11, 2, 1, 'php'),
(12, 1, 3, 'yess'),
(13, 10, 3, 'tkt'),
(14, 10, 1, 'ok'),
(15, 15, 1, '<3'),
(16, 1, 1, ';)'),
(17, 1, 1, ';)'),
(18, 1, 1, ';)'),
(19, 1, 1, ';)'),
(20, 4, 3, 'java'),
(21, 4, 3, 'java'),
(22, 4, 3, 'java'),
(23, 4, 3, 'java'),
(24, 1, 3, 'aa'),
(25, 16, 24, '^hjkl');

-- --------------------------------------------------------

--
-- Structure de la table `images`
--

CREATE TABLE IF NOT EXISTS `images` (
  `id_img` int(4) NOT NULL AUTO_INCREMENT,
  `id_user` int(4) NOT NULL,
  `url_image` varchar(50) NOT NULL,
  `titre` varchar(30) NOT NULL,
  PRIMARY KEY (`id_img`),
  KEY `id_user` (`id_user`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;

--
-- Contenu de la table `images`
--

INSERT INTO `images` (`id_img`, `id_user`, `url_image`, `titre`) VALUES
(11, 1, 'photo4.png', ''),
(13, 1, '24257357_1880407015608107_123181604_n.jpg', ''),
(14, 1, '17759059_818682k724950231_589415023_o.jpg', ''),
(19, 24, 'logo.png', ''),
(8, 1, '14606388_664521470384428_1639230344038100144_n.jpg', 'nature');

-- --------------------------------------------------------

--
-- Structure de la table `like`
--

CREATE TABLE IF NOT EXISTS `like` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `nbr` int(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `like`
--

INSERT INTO `like` (`id`, `nbr`) VALUES
(1, 0);

-- --------------------------------------------------------

--
-- Structure de la table `publication`
--

CREATE TABLE IF NOT EXISTS `publication` (
  `id_pub` int(4) NOT NULL AUTO_INCREMENT,
  `id_user` int(4) NOT NULL,
  `titre` varchar(100) NOT NULL,
  `texte` text NOT NULL,
  PRIMARY KEY (`id_pub`),
  KEY `id_user` (`id_user`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Contenu de la table `publication`
--

INSERT INTO `publication` (`id_pub`, `id_user`, `titre`, `texte`) VALUES
(1, 1, 'iphone 8', 'iPhone 8 introduces an allâ€‘new glass design. The worldâ€™s most popular camera, now even better. The most powerful and smartest chip ever in a smartphone. Wireless charging thatâ€™s truly effortless. And augmented reality experiences never before possible. iPhone 8. A new generation of iPhone.'),
(2, 3, 'PHP', 'PHP is a server scripting language, and a powerful tool for making dynamic and interactive Web pages. PHP is a widely-used, free, and efficient alternative to competitors such as Microsoft''s ASP. '),
(3, 3, 'java', 'Java est un langage de programmation moderne dÃ©veloppÃ© par Sun Microsystems (aujourd''hui rachetÃ© par Oracle). Il ne faut surtout pas le confondre avec JavaScript (langage de scripts utilisÃ© principalement sur les sites web), car Java n''a rien Ã  voir.'),
(4, 3, 'javaScript', 'JavaScript is the programming language of HTML and the Web.\r\nJavaScript is easy to learn.'),
(10, 1, 'charapon', 'charapon'),
(16, 24, 'rtyu', 'fghyjukilomp'),
(15, 1, 'awatef', 'norhena');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `username` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `password2` varchar(50) NOT NULL,
  `photo` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=25 ;

--
-- Contenu de la table `user`
--

INSERT INTO `user` (`id`, `username`, `email`, `password`, `password2`, `photo`) VALUES
(1, 'Mahrzia Jlassi', 'jlassimahrzia@gmail.com', '25324210ma', '25324210ma', 'photo9.png'),
(14, 'Bouali Rooya', 'BoualiRooya', 'rooyabouali', 'rooyabouali', 'photo4.png'),
(3, 'Maghraoui Achraf', 'maghraouiachref@gmail.com', 'charapon', 'charapon', 'photo1.png'),
(24, 'mouhamed', 'houcemhedhli@gmail.com', '25324210', '25324210', 'photo2.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `videos`
--

CREATE TABLE IF NOT EXISTS `videos` (
  `id_video` int(4) NOT NULL AUTO_INCREMENT,
  `id_user` int(4) NOT NULL,
  `titreV` varchar(50) NOT NULL,
  `url_video` varchar(100) NOT NULL,
  PRIMARY KEY (`id_video`),
  KEY `id_user` (`id_user`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Contenu de la table `videos`
--

INSERT INTO `videos` (`id_video`, `id_user`, `titreV`, `url_video`) VALUES
(4, 1, 'iphone 8', 'iPhone 8 and iPhone 8 Plus â€” Unveiled â€” Apple.mp4'),
(3, 1, 'Huawei', 'Le Huawei Mate 9 en exclusivitÃ© chez Ooredoo Tunisie! (2).mp4');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
