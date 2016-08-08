-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Sam 19 Mars 2016 à 21:28
-- Version du serveur :  5.6.17
-- Version de PHP :  5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `hotel`
--

-- --------------------------------------------------------

--
-- Structure de la table `hl_booking`
--

CREATE TABLE IF NOT EXISTS `hl_booking` (
  `booking_id` int(11) NOT NULL AUTO_INCREMENT,
  `booking_room_nb` int(11) DEFAULT NULL,
  `booking_gest_nb` int(1) DEFAULT NULL,
  `booking_checkin` datetime DEFAULT NULL,
  `booking_checkout` datetime DEFAULT NULL,
  `booking_nights` int(1) DEFAULT NULL,
  `booking_price` int(10) DEFAULT NULL,
  `hl_users_user_id` int(11) NOT NULL,
  `hl_hotel_hotel_id` int(11) NOT NULL,
  PRIMARY KEY (`booking_id`),
  KEY `fk_hl_booking_hl_users_idx` (`hl_users_user_id`),
  KEY `fk_hl_booking_hl_hotel1_idx` (`hl_hotel_hotel_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=17 ;

--
-- Contenu de la table `hl_booking`
--

INSERT INTO `hl_booking` (`booking_id`, `booking_room_nb`, `booking_gest_nb`, `booking_checkin`, `booking_checkout`, `booking_nights`, `booking_price`, `hl_users_user_id`, `hl_hotel_hotel_id`) VALUES
(1, 1, 2, '2016-03-24 00:00:00', NULL, 2, 60, 0, 1),
(2, 1, 2, '2016-03-24 00:00:00', NULL, 3, 90, 0, 1),
(3, 1, 2, '2016-03-24 00:00:00', NULL, 3, 90, 0, 1),
(4, 1, 2, '2016-03-24 00:00:00', NULL, 3, 90, 0, 1),
(5, 1, 2, '2016-03-24 00:00:00', NULL, 3, 90, 0, 1),
(6, 1, 2, '2016-03-24 00:00:00', NULL, 3, 90, 0, 1),
(7, 1, 2, '2016-03-24 00:00:00', NULL, 3, 90, 0, 1),
(8, 2, 4, '2016-03-24 00:00:00', NULL, 3, 180, 0, 1),
(9, 2, 4, '2016-03-24 00:00:00', NULL, 3, 180, 0, 1),
(10, 2, 4, '2016-03-24 00:00:00', NULL, 3, 180, 0, 1),
(11, 2, 4, '2016-03-31 00:00:00', NULL, 2, 200, 0, 1),
(12, 1, 2, '2016-03-23 00:00:00', NULL, 3, 90, 0, 2),
(13, 1, 2, '2016-03-23 00:00:00', NULL, 3, 90, 0, 2),
(14, 1, 2, '2016-03-23 00:00:00', NULL, 3, 90, 0, 2),
(15, 1, 2, '2016-03-23 00:00:00', NULL, 3, 90, 0, 2),
(16, 2, 4, '2016-03-23 00:00:00', NULL, 3, 180, 0, 2);

-- --------------------------------------------------------

--
-- Structure de la table `hl_cities`
--

CREATE TABLE IF NOT EXISTS `hl_cities` (
  `city_id` int(11) NOT NULL AUTO_INCREMENT,
  `city_name` varchar(45) NOT NULL,
  PRIMARY KEY (`city_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Contenu de la table `hl_cities`
--

INSERT INTO `hl_cities` (`city_id`, `city_name`) VALUES
(1, 'London'),
(2, 'Manchester'),
(3, 'Liverpool'),
(4, 'Exeter'),
(5, 'Birmingham'),
(6, 'Cardiff'),
(7, 'Newcastle');

-- --------------------------------------------------------

--
-- Structure de la table `hl_hotel`
--

CREATE TABLE IF NOT EXISTS `hl_hotel` (
  `hotel_id` int(11) NOT NULL AUTO_INCREMENT,
  `hotel_name` varchar(35) NOT NULL,
  `hotel_rooms` int(4) NOT NULL,
  `hotel_email` varchar(50) NOT NULL,
  `hotel_phone` int(10) NOT NULL,
  `hotel_address` text NOT NULL,
  `hotel_zip` int(15) NOT NULL,
  `hl_cities_cities_id` int(11) NOT NULL,
  PRIMARY KEY (`hotel_id`),
  KEY `fk_hl_hotel_hl_cities1_idx` (`hl_cities_cities_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Contenu de la table `hl_hotel`
--

INSERT INTO `hl_hotel` (`hotel_id`, `hotel_name`, `hotel_rooms`, `hotel_email`, `hotel_phone`, `hotel_address`, `hotel_zip`, `hl_cities_cities_id`) VALUES
(1, 'Hotel One', 3, 'one@email.com', 0, 'Address', 123456, 1),
(2, 'Hotel Two', 2, 'two@email.com', 0, 'Address', 123456, 2),
(3, 'Hotel Three', 1, 'three@email.com', 0, 'Address', 123456, 3),
(4, 'Hotel Four', 1, 'four@email.com', 0, 'Address', 123456, 4),
(5, 'Hotel Five', 1, 'five@email.com', 0, 'Address', 123456, 5),
(6, 'Hotel Six', 1, 'six@email.com', 0, 'Address', 123456, 6),
(7, 'Hotel Seven', 1, 'seven@email.com', 0, 'Address', 123456, 7),
(8, 'Hotel Eight', 1, 'eight@email.com', 0, 'Address', 123456, 1),
(9, 'Hotel Nine', 1, 'nine@email.com', 0, 'Address', 123456, 1),
(10, 'Hotel Ten', 1, 'ten@email.com', 0, 'Address', 123456, 2);

-- --------------------------------------------------------

--
-- Structure de la table `hl_payment`
--

CREATE TABLE IF NOT EXISTS `hl_payment` (
  `payment_id` int(11) NOT NULL AUTO_INCREMENT,
  `payment_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `hl_users_infos_user_info_id` int(11) NOT NULL,
  PRIMARY KEY (`payment_id`),
  KEY `fk_hl_payment_hl_users_infos1_idx` (`hl_users_infos_user_info_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `hl_payment`
--

INSERT INTO `hl_payment` (`payment_id`, `payment_date`, `hl_users_infos_user_info_id`) VALUES
(1, '2016-03-19 19:29:58', 7);

-- --------------------------------------------------------

--
-- Structure de la table `hl_rooms`
--

CREATE TABLE IF NOT EXISTS `hl_rooms` (
  `room_id` int(11) NOT NULL,
  `room_space` tinyint(1) NOT NULL,
  `room_price` int(10) NOT NULL,
  `hl_hotel_hotel_id` int(11) NOT NULL,
  PRIMARY KEY (`room_id`),
  KEY `fk_hl_rooms_hl_hotel1_idx` (`hl_hotel_hotel_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `hl_rooms`
--

INSERT INTO `hl_rooms` (`room_id`, `room_space`, `room_price`, `hl_hotel_hotel_id`) VALUES
(0, 2, 30, 1),
(1, 2, 30, 2),
(2, 3, 45, 3),
(3, 2, 50, 4),
(4, 4, 70, 5),
(5, 3, 75, 6),
(6, 2, 15, 7),
(7, 4, 80, 8),
(8, 4, 65, 9),
(9, 3, 49, 10),
(10, 3, 50, 1),
(11, 4, 65, 1),
(12, 3, 45, 2);

-- --------------------------------------------------------

--
-- Structure de la table `hl_users`
--

CREATE TABLE IF NOT EXISTS `hl_users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(35) DEFAULT NULL,
  `user_firstname` varchar(35) DEFAULT NULL,
  `user_login` varchar(35) DEFAULT NULL,
  `user_password` varchar(32) NOT NULL,
  `user_email` varchar(75) DEFAULT NULL,
  `user_phone` int(12) DEFAULT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `user_email` (`user_email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Contenu de la table `hl_users`
--

INSERT INTO `hl_users` (`user_id`, `user_name`, `user_firstname`, `user_login`, `user_password`, `user_email`, `user_phone`) VALUES
(0, 'Doe', 'John', 'Jo', '123456', 'jo@email.com', 102030405);

-- --------------------------------------------------------

--
-- Structure de la table `hl_users_infos`
--

CREATE TABLE IF NOT EXISTS `hl_users_infos` (
  `user_info_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_credit_card` int(16) DEFAULT NULL,
  `user_credit_card_type` varchar(45) NOT NULL,
  `hl_users_user_id` int(11) NOT NULL,
  `user_credit_card_exp` datetime NOT NULL,
  `hl_booking_id` int(11) NOT NULL,
  PRIMARY KEY (`user_info_id`),
  UNIQUE KEY `hl_booking_id` (`hl_booking_id`),
  KEY `fk_hl_users_infos_hl_users1_idx` (`hl_users_user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Contenu de la table `hl_users_infos`
--

INSERT INTO `hl_users_infos` (`user_info_id`, `user_credit_card`, `user_credit_card_type`, `hl_users_user_id`, `user_credit_card_exp`, `hl_booking_id`) VALUES
(2, 2147483647, 'American express', 0, '2018-01-01 00:00:00', 9),
(3, 2147483647, 'American express', 0, '2019-01-01 00:00:00', 11),
(4, 2147483647, 'American express', 0, '2020-01-01 00:00:00', 12),
(5, 2147483647, 'American express', 0, '2017-01-01 00:00:00', 14),
(6, 2147483647, 'American express', 0, '2019-01-01 00:00:00', 15),
(7, 2147483647, 'American express', 0, '2019-01-01 00:00:00', 16);

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `hl_booking`
--
ALTER TABLE `hl_booking`
  ADD CONSTRAINT `fk_hl_booking_hl_hotel1` FOREIGN KEY (`hl_hotel_hotel_id`) REFERENCES `hl_hotel` (`hotel_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_hl_booking_hl_users` FOREIGN KEY (`hl_users_user_id`) REFERENCES `hl_users` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `hl_hotel`
--
ALTER TABLE `hl_hotel`
  ADD CONSTRAINT `fk_hl_hotel_hl_cities1` FOREIGN KEY (`hl_cities_cities_id`) REFERENCES `hl_cities` (`city_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `hl_payment`
--
ALTER TABLE `hl_payment`
  ADD CONSTRAINT `fk_hl_payment_hl_users_infos1` FOREIGN KEY (`hl_users_infos_user_info_id`) REFERENCES `hl_users_infos` (`user_info_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `hl_rooms`
--
ALTER TABLE `hl_rooms`
  ADD CONSTRAINT `fk_hl_rooms_hl_hotel1` FOREIGN KEY (`hl_hotel_hotel_id`) REFERENCES `hl_hotel` (`hotel_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `hl_users_infos`
--
ALTER TABLE `hl_users_infos`
  ADD CONSTRAINT `hl_booking_id_fk` FOREIGN KEY (`hl_booking_id`) REFERENCES `hl_booking` (`booking_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_hl_users_infos_hl_users1` FOREIGN KEY (`hl_users_user_id`) REFERENCES `hl_users` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
