-- phpMyAdmin SQL Dump
-- version 4.0.6deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 22, 2014 at 06:53 PM
-- Server version: 5.5.35-0ubuntu0.13.10.1
-- PHP Version: 5.5.3-1ubuntu2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";
SET foreign_key_checks = 0;


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `simple-quiz`
--

-- --------------------------------------------------------

--
-- Table structure for table `answers`
--

CREATE TABLE IF NOT EXISTS `answers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `question_num` int(11) unsigned NOT NULL,
  `quiz_id` int(11) unsigned NOT NULL,
  `text` varchar(255) NOT NULL,
  `correct` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `question_id` (`correct`),
  KEY `quiz_id` (`quiz_id`),
  KEY `quiz_question_num` (`question_num`,`quiz_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=460 ;

--
-- Dumping data for table `answers`
--

INSERT INTO `answers` (`id`, `question_num`, `quiz_id`, `text`, `correct`) VALUES
(433, 1, 6, 'Tom Hanks', 1),
(434, 1, 6, 'Marlon Brando', 0),
(435, 1, 6, 'Robert De Niro', 0),
(436, 1, 6, 'Bob Hoskins', 0),
(441, 3, 6, 'Norman Bates', 1),
(442, 3, 6, 'Norman Tebbit', 0),
(443, 3, 6, 'Norman Wisdom', 0),
(444, 3, 6, 'Norman Cooke', 0),
(445, 4, 6, 'Stan and Oliver', 1),
(446, 4, 6, 'Stan and Groucho', 0),
(447, 4, 6, 'Bob and Billy', 0),
(448, 5, 6, 'Morgan Freeman', 1),
(449, 5, 6, 'Marlon Brando', 0),
(450, 5, 6, 'Tim Robbins', 0),
(451, 5, 6, 'Tom Cruise', 0),
(452, 6, 6, '4', 1),
(453, 6, 6, '1', 0),
(454, 6, 6, '2', 0),
(455, 6, 6, '3', 0),
(456, 2, 6, 'Robert De Niro', 1),
(457, 2, 6, 'Tom Hanks', 0),
(458, 2, 6, 'Bob Hope', 0),
(459, 2, 6, 'Christopher Hall', 0);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `description`) VALUES
(1, 'Sports', 'Sports related quizzes'),
(2, 'Films', 'Movie related quizzes'),
(3, 'Technology', 'Tecnology related quizzes'),
(4, 'General Knowledge', 'General Knowledge related quizzes'),
(5, 'Science', 'Science related quizzes'),
(6, 'Music', 'Music related quizzes');

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE IF NOT EXISTS `questions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `num` int(11) unsigned NOT NULL,
  `quiz_id` int(11) unsigned NOT NULL,
  `text` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `quiz_id` (`quiz_id`),
  KEY `num` (`num`),
  KEY `num_2` (`num`,`quiz_id`),
  KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `num`, `quiz_id`, `text`) VALUES
(15, 1, 6, 'Who played Forrest Gump?'),
(16, 2, 6, 'Who played the lead role in Taxi Driver?'),
(17, 3, 6, 'What was the name of the killer in Psycho?'),
(18, 4, 6, 'What were the first names of Laurel And Hardy?'),
(19, 5, 6, 'Who played ''Red'' in The Shawshank Redemption?'),
(20, 6, 6, 'How many films were there in the ''Alien'' series?');

-- --------------------------------------------------------

--
-- Table structure for table `quizzes`
--

CREATE TABLE IF NOT EXISTS `quizzes` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `description` varchar(255) NOT NULL,
  `category` int(11) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `active` (`active`),
  KEY `id` (`id`),
  KEY `created` (`created`),
  KEY `updated` (`updated`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `quizzes`
--

INSERT INTO `quizzes` (`id`, `name`, `description`, `category`, `active`, `created`, `updated`) VALUES
(6, 'Movies', 'Know your movie trivia? Prove it!', 2, 1, '2013-11-21 21:55:12', '2014-01-20 21:16:46');

-- --------------------------------------------------------

--
-- Table structure for table `quiz_users`
--

CREATE TABLE IF NOT EXISTS `quiz_users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `quiz_id` int(11) unsigned NOT NULL,
  `user_id` int(11) unsigned NOT NULL,
  `score` int(11) NOT NULL,
  `start_time` datetime NOT NULL,
  `date_submitted` datetime NOT NULL,
  `time_taken` varchar(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `quiz_id` (`quiz_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=39 ;

--
-- Dumping data for table `quiz_users`
--

INSERT INTO `quiz_users` (`id`, `quiz_id`, `user_id`, `score`, `start_time`, `date_submitted`, `time_taken`) VALUES
(34, 6, 182, 5, '2013-11-21 21:59:59', '2013-11-21 22:00:16', '00:17'),
(35, 6, 209, 6, '2013-12-31 11:14:38', '2013-12-31 11:15:02', '00:24'),
(36, 6, 210, 3, '2014-01-05 20:04:30', '2014-01-05 20:04:58', '00:28'),
(37, 6, 211, 1, '2014-01-05 20:06:29', '2014-01-05 20:06:55', '00:26'),
(38, 6, 212, 2, '2014-01-05 20:23:32', '2014-01-05 20:23:59', '00:27');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE IF NOT EXISTS `sessions` (
  `id` varchar(32) NOT NULL,
  `access` int(10) unsigned DEFAULT NULL,
  `data` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `access`, `data`) VALUES
('0lc4o8hk08tu5eus7l18puf0v2', 1384895797, 'urlRedirect|s:7:"/admin/";slim.flash|a:0:{}'),
('1p03rmbt53mk93puqiohkhc9e0', 1384595829, 'slim.flash|a:0:{}quizid|s:1:"5";score|i:0;correct|a:0:{}wrong|a:0:{}finished|s:2:"no";num|i:0;last|N;timetaken|N;starttime|N;urlRedirect|s:7:"/admin/";'),
('3og1gvjl0nlciid506qbb96en3', 1385072406, 'slim.flash|a:0:{}adminuser|b:1;user|s:5:"Admin";quizid|s:1:"6";score|i:0;correct|a:0:{}wrong|a:0:{}finished|s:2:"no";num|i:0;last|N;timetaken|N;starttime|N;'),
('5d5onh98jvu80n8somv95bdbg1', 1384469694, 'urlRedirect|s:7:"/admin/";slim.flash|a:0:{}'),
('7ar9l1fqancg9o2fhspjfhml11', 1384900287, 'slim.flash|a:0:{}adminuser|b:1;user|s:5:"Admin";'),
('bpg70ci1ugd94f0rggmr8kkrn6', 1385072261, 'urlRedirect|s:7:"/admin/";slim.flash|a:0:{}'),
('c4g6914rkh5rq0prd1vripq702', 1384899916, 'slim.flash|a:0:{}quizid|s:1:"4";score|i:0;correct|a:0:{}wrong|a:0:{}finished|s:2:"no";num|i:0;last|N;timetaken|N;starttime|N;urlRedirect|s:7:"/admin/";'),
('ffamg7aj4qpsk494uqtvc8n7i1', 1384600655, 'slim.flash|a:0:{}quizid|s:1:"5";score|i:0;correct|a:0:{}wrong|a:0:{}finished|s:2:"no";num|i:0;last|N;timetaken|N;starttime|N;adminuser|b:1;user|s:5:"Admin";'),
('fi0upe3jmujg26u2eenagom3h4', 1384809113, 'urlRedirect|s:7:"/admin/";slim.flash|a:0:{}'),
('hj1laglukn7pjcm4rsu4dvver4', 1384984270, 'urlRedirect|s:7:"/admin/";slim.flash|a:0:{}'),
('iuer9a54ishdai3v5t7h9fndq1', 1384898612, 'slim.flash|a:0:{}urlRedirect|s:7:"/admin/";'),
('ldpj1trc2fdo6krqfdri1of333', 1384470264, 'slim.flash|a:0:{}adminuser|b:1;user|s:5:"Admin";'),
('mghuldejfedett61td1boem2k4', 1384981507, 'quizid|s:1:"7";score|i:0;correct|a:0:{}wrong|a:0:{}finished|s:2:"no";num|i:0;last|N;timetaken|N;starttime|N;slim.flash|a:0:{}urlRedirect|s:7:"/admin/";'),
('o0dqueei6rr6aavt4s6e2a2tu7', 1388953550, 'urlRedirect|s:7:"/admin/";slim.flash|a:0:{}'),
('plf1kd6l64t7d7mk7fpbkfkfk1', 1388488263, 'slim.flash|a:0:{}'),
('q8191hknupipqu2lqq4om47oa3', 1388437224, 'slim.flash|a:0:{}quizid|s:1:"6";score|i:0;correct|a:0:{}wrong|a:0:{}finished|s:2:"no";num|i:0;last|N;timetaken|N;starttime|N;'),
('r5kdhm6ta73er542ppfca6m2r6', 1384899950, 'slim.flash|a:0:{}urlRedirect|s:7:"/admin/";'),
('t5k642bmd1hv2qn03cabsoocr2', 1390252748, 'slim.flash|a:0:{}adminuser|b:1;user|s:5:"Admin";quizid|s:1:"6";score|i:0;correct|a:0:{}wrong|a:0:{}finished|s:2:"no";num|i:0;last|N;timetaken|N;starttime|N;'),
('ufh1jiienhn8bbad9jinae6lk7', 1385069950, 'slim.flash|a:0:{}urlRedirect|s:7:"/admin/";');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(60) NOT NULL,
  `pass` varchar(40) NOT NULL,
  `email` varchar(40) NOT NULL,
  `level` int(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `name` (`name`),
  KEY `pass` (`pass`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=213 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `pass`, `email`, `level`) VALUES
(3, 'Anon134', '', '', 0),
(4, 'Anon287', '', '', 0),
(5, 'Anon285', '', '', 0),
(6, 'Anon203', '', '', 0),
(7, 'Anon949', '', '', 0),
(8, 'Anon771', '', '', 0),
(9, 'bbb', '', '', 0),
(10, 'Anon400', '', '', 0),
(11, ';lpokk', '', '', 0),
(12, 'gytr', '', '', 0),
(13, 'lpoij', '', '', 0),
(14, 'Anon835', '', '', 0),
(15, 'Anon285', '', '', 0),
(16, 'Anon241', '', '', 0),
(17, 'Anon406', '', '', 0),
(18, 'Anon939', '', '', 0),
(19, 'Anon621', '', '', 0),
(20, 'bobomcgraw', '', '', 0),
(21, 'Anon116', '', '', 0),
(22, 'Anon127', '', '', 0),
(23, 'Anon956', '', '', 0),
(24, 'Anon980', '', '', 0),
(25, 'Anon986', '', '', 0),
(26, 'Anon539', '', '', 0),
(27, 'Anon135', '', '', 0),
(28, 'Anon426', '', '', 0),
(29, 'Anon260', '', '', 0),
(30, 'dwert', '', '', 0),
(31, 'Anon643', '', '', 0),
(32, 'Anon643', '', '', 0),
(33, 'Anon643', '', '', 0),
(34, 'Anon643', '', '', 0),
(35, 'Anon643', '', '', 0),
(36, 'Anon643', '', '', 0),
(37, 'Anon643', '', '', 0),
(38, 'Anon643', '', '', 0),
(39, 'Anon643', '', '', 0),
(40, 'Anon643', '', '', 0),
(41, 'Anon643', '', '', 0),
(42, 'Anon638', '', '', 0),
(43, 'Anon638', '', '', 0),
(44, 'Anon638', '', '', 0),
(45, 'Anon638', '', '', 0),
(46, 'Anon60', '', '', 0),
(47, 'Anon752', '', '', 0),
(48, 'Anon752', '', '', 0),
(49, 'Anon752', '', '', 0),
(50, 'Anon752', '', '', 0),
(51, 'Anon752', '', '', 0),
(52, 'Anon752', '', '', 0),
(53, 'Anon752', '', '', 0),
(54, 'Anon752', '', '', 0),
(55, 'Anon524', '', '', 0),
(56, 'Anon914', '', '', 0),
(57, 'Anon576', '', '', 0),
(58, 'Anon982', '', '', 0),
(59, 'Anon137', '', '', 0),
(60, 'Anon425', '', '', 0),
(61, 'Anon602', '', '', 0),
(62, 'Anon916', '', '', 0),
(63, 'chunky', '', '', 0),
(64, 'wonky', '', '', 0),
(65, 'Anon50', '', '', 0),
(66, 'Anon50', '', '', 0),
(67, 'Anon50', '', '', 0),
(68, 'Anon50', '', '', 0),
(69, 'Anon50', '', '', 0),
(70, 'Anon50', '', '', 0),
(71, 'Anon50', '', '', 0),
(72, 'Anon50', '', '', 0),
(73, 'Anon50', '', '', 0),
(74, 'Anon50', '', '', 0),
(75, 'Anon50', '', '', 0),
(76, 'Anon50', '', '', 0),
(77, 'Anon50', '', '', 0),
(78, 'Anon50', '', '', 0),
(79, 'Anon50', '', '', 0),
(80, 'flinky', '', '', 0),
(81, 'flinky', '', '', 0),
(82, 'flinky', '', '', 0),
(83, 'flinky', '', '', 0),
(84, 'flinky', '', '', 0),
(85, 'fonky', '', '', 0),
(86, 'dfret', '', '', 0),
(87, 'dfret', '', '', 0),
(88, 'dfret', '', '', 0),
(89, 'dfret', '', '', 0),
(90, 'dfret', '', '', 0),
(91, 'dfret', '', '', 0),
(92, 'dfret', '', '', 0),
(93, 'dfret', '', '', 0),
(94, 'dfret', '', '', 0),
(95, 'dfret', '', '', 0),
(96, 'dfret', '', '', 0),
(97, 'zsadw', '', '', 0),
(98, 'zsadw', '', '', 0),
(99, 'zsadw', '', '', 0),
(100, 'zsadw', '', '', 0),
(101, 'slink', '', '', 0),
(102, 'Anon294', '', '', 0),
(103, 'Anon294', '', '', 0),
(104, 'Anon93', '', '', 0),
(105, 'Anon93', '', '', 0),
(106, 'Anon93', '', '', 0),
(107, 'Anon609', '', '', 0),
(108, 'Anon609', '', '', 0),
(109, 'Anon609', '', '', 0),
(110, 'Anon609', '', '', 0),
(111, 'Anon609', '', '', 0),
(112, 'Anon753', '', '', 0),
(113, 'Anon753', '', '', 0),
(114, 'Anon753', '', '', 0),
(115, 'sdsdsdungh', '', '', 0),
(116, 'sdsdsdungh', '', '', 0),
(117, 'Anon850', '', '', 0),
(118, 'Anon850', '', '', 0),
(119, 'swerty', '', '', 0),
(120, 'Anon256', '', '', 0),
(121, 'bobobobob', '', '', 0),
(122, 'sssss', '', '', 0),
(123, 'Anon764', '', '', 0),
(124, 'dertw', '', '', 0),
(125, 'Anon686', '', '', 0),
(126, 'Anon50', '', '', 0),
(127, 'Anon63', '', '', 0),
(128, 'Anon154', '', '', 0),
(129, 'Anon31', '', '', 0),
(130, 'Anon552', '', '', 0),
(131, 'Anon79', '', '', 0),
(132, 'Anon362', '', '', 0),
(133, 'Anon581', '', '', 0),
(134, 'Anon224', '', '', 0),
(135, 'Anon914', '', '', 0),
(136, 'Anon910', '', '', 0),
(137, 'Anon784', '', '', 0),
(138, 'Anon591', '', '', 0),
(139, 'Anon381', '', '', 0),
(140, 'Anon440', '', '', 0),
(141, 'Anon197', '', '', 0),
(142, 'Anon483', '', '', 0),
(143, 'Anon453', '', '', 0),
(144, 'Anon220', '', '', 0),
(145, 'Anon835', '', '', 0),
(146, 'Anon668', '', '', 0),
(147, 'Anon896', '', '', 0),
(148, 'Anon800', '', '', 0),
(149, 'Anon5', '', '', 0),
(150, 'Anon928', '', '', 0),
(151, 'Anon775', '', '', 0),
(152, 'Anon703', '', '', 0),
(153, 'Anon255', '', '', 0),
(154, 'Anon799', '', '', 0),
(155, 'cdcdscds', '', '', 0),
(156, 'bbbbbb', '', '', 0),
(157, 'Admin', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'example@gmail.com', 1),
(158, 'cdwerr', '', '', 0),
(159, 'badass', '', '', 0),
(160, 'bilbo', '', '', 0),
(161, 'sniffer', '', '', 0),
(162, 'xswerty', '', '', 0),
(163, ';pokjjh', '', '', 0),
(164, 'sambvo', '', '', 0),
(165, 'rotters', '', '', 0),
(166, 'amo261', '', '', 0),
(167, 'bigbum', '', '', 0),
(168, 'BAZOOIE!', '', '', 0),
(169, 'xsxssx', '', '', 0),
(170, 'rettyyio', '', '', 0),
(171, 'derwwrq', '', '', 0),
(172, 'dedededede', '', '', 0),
(173, 'dsww', '', '', 0),
(174, 'dsdww', '', '', 0),
(175, 'dwdw', '', '', 0),
(176, 'kikik', '', '', 0),
(177, 'ElanMan', '', '', 0),
(178, 'fdsfdssdf', '', '', 0),
(179, 'werrfeg', '', '', 0),
(180, 'qqq', '', '', 0),
(181, 'wettyjjk', '', '', 0),
(182, 'bobb', '', '', 0),
(183, 'swerty', '', '', 0),
(184, 'deertyttyt', '', '', 0),
(185, 'dswew', '', '', 0),
(186, 'vfdvfd', '', '', 0),
(187, 'dewrttytyy', '', '', 0),
(188, 'dwdd', '', '', 0),
(189, 'sasa', '', '', 0),
(190, 'lkjljk', '', '', 0),
(191, 'bvc', '', '', 0),
(192, 'fff', '', '', 0),
(193, 'gyky', '', '', 0),
(194, 'kjh', '', '', 0),
(195, 'loi', '', '', 0),
(196, 'sdp', '', '', 0),
(197, 'lkja', '', '', 0),
(198, 'deeww', '', '', 0),
(199, 'gtgt', '', '', 0),
(200, 'gfdd', '', '', 0),
(201, 'iiii', '', '', 0),
(202, 'hgfff', '', '', 0),
(203, 'dwwww', '', '', 0),
(204, 'sqqqqq', '', '', 0),
(205, 'dwdwdw', '', '', 0),
(206, 'dwdwdwd', '', '', 0),
(207, 'hyuiy', '', '', 0),
(208, 'lkgi', '', '', 0),
(209, 'Sweaty', '', '', 0),
(210, 'quizma1', '', '', 0),
(211, 'quizma2', '', '', 0),
(212, 'quizma3', '', '', 0);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `answers`
--
ALTER TABLE `answers`
  ADD CONSTRAINT `answers_ibfk_2` FOREIGN KEY (`question_num`, `quiz_id`) REFERENCES `questions` (`num`, `quiz_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `answers_ibfk_3` FOREIGN KEY (`quiz_id`) REFERENCES `quizzes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `questions`
--
ALTER TABLE `questions`
  ADD CONSTRAINT `questions_ibfk_1` FOREIGN KEY (`quiz_id`) REFERENCES `quizzes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `quiz_users`
--
ALTER TABLE `quiz_users`
  ADD CONSTRAINT `quiz_users_ibfk_1` FOREIGN KEY (`quiz_id`) REFERENCES `quizzes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
