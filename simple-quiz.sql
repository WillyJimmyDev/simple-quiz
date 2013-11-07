-- phpMyAdmin SQL Dump
-- version 4.0.8
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 07, 2013 at 09:44 PM
-- Server version: 5.5.33a-MariaDB-log
-- PHP Version: 5.5.5

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=374 ;

--
-- Dumping data for table `answers`
--

INSERT INTO `answers` (`id`, `question_num`, `quiz_id`, `text`, `correct`) VALUES
(328, 1, 4, 'Norman Cooke', 0),
(329, 1, 4, 'Norman Wisdom', 0),
(330, 1, 4, 'Norman Bates', 1),
(331, 1, 4, 'Norman Tebbit', 0),
(332, 2, 4, 'Stan and Oliver', 1),
(333, 2, 4, 'Stan and Groucho', 0),
(334, 2, 4, 'Oliver and Marco', 0),
(335, 2, 4, 'Bob and Billy', 0),
(336, 3, 4, 'Bob Hoskins', 1),
(337, 3, 4, 'Adam Sandler', 0),
(338, 3, 4, 'Charlie Sheen', 0),
(339, 3, 4, 'Hugh Grant', 0),
(340, 3, 4, 'Robert De Niro', 0),
(341, 4, 4, 'damn', 1),
(342, 4, 4, 'darn', 0),
(343, 4, 4, 'hoot', 0),
(344, 4, 4, 'twist', 0),
(345, 5, 4, 'Morgan Freeman', 1),
(346, 5, 4, 'Jude Law', 0),
(347, 5, 4, 'Tim Robbins', 0),
(348, 5, 4, 'Samuel L Jackson', 0),
(349, 5, 4, 'Tom Cruise', 0),
(350, 1, 5, 'Muhammad Ali', 1),
(351, 1, 5, 'Mike Tyson', 0),
(352, 1, 5, 'Henry Cooper', 0),
(353, 1, 5, 'Marvin Hagler', 0),
(354, 2, 5, 'Tennis', 1),
(355, 2, 5, 'Rowing', 0),
(356, 2, 5, 'Snooker', 0),
(357, 2, 5, 'Golf', 0),
(358, 3, 5, 'Thorpedo', 1),
(359, 3, 5, 'Thorpester', 0),
(360, 3, 5, 'ThorpeMan', 0),
(361, 3, 5, 'The Thorpe Meister', 0),
(366, 4, 5, 'Cricketer', 1),
(367, 4, 5, 'Footballer', 0),
(368, 4, 5, 'Rower', 0),
(369, 4, 5, 'Tennis Player', 0),
(370, 5, 5, '5', 1),
(371, 5, 5, '4', 0),
(372, 5, 5, '3', 0),
(373, 5, 5, '6', 0);

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE IF NOT EXISTS `questions` (
  `num` int(11) unsigned NOT NULL,
  `quiz_id` int(11) unsigned NOT NULL,
  `text` varchar(255) NOT NULL,
  PRIMARY KEY (`num`,`quiz_id`),
  KEY `quiz_id` (`quiz_id`),
  KEY `num` (`num`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`num`, `quiz_id`, `text`) VALUES
(1, 4, 'What was the name of the killer in Psycho?'),
(1, 5, 'Who ''floated like a butterfly''?'),
(2, 4, 'What were the first names of Laurel And Hardy?'),
(2, 5, 'The Davis Cup is awarded in which sport?'),
(3, 4, 'Who played the lead ''real'' person in Who Framed Roger Rabbit?'),
(3, 5, 'What was the nickname of Australian swimmer Ian Thorpe?'),
(4, 4, 'Fill in the missing word from this famous movie quote: ''Frankly my dear, I don''t give a ....!'''),
(4, 5, 'W.G Grace was a famous what?'),
(5, 4, 'Who played ''Red'' in The Shawshank Redemption?'),
(5, 5, 'How many points are scored for a try in Rugby Union?');

-- --------------------------------------------------------

--
-- Table structure for table `quizzes`
--

CREATE TABLE IF NOT EXISTS `quizzes` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `description` varchar(255) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `active` (`active`),
  KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `quizzes`
--

INSERT INTO `quizzes` (`id`, `name`, `description`, `active`) VALUES
(4, 'Movies', 'Know your movie trivia? Prove it!', 1),
(5, 'Sports', 'Test Your Sports Knowledge', 1);

-- --------------------------------------------------------

--
-- Table structure for table `quiz_users`
--

CREATE TABLE IF NOT EXISTS `quiz_users` (
  `quiz_id` int(11) unsigned NOT NULL,
  `user_id` int(11) unsigned NOT NULL,
  `score` int(11) NOT NULL,
  `start_time` datetime NOT NULL,
  `date_submitted` datetime NOT NULL,
  `time_taken` varchar(10) NOT NULL,
  KEY `user_id` (`user_id`),
  KEY `quiz_id` (`quiz_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `quiz_users`
--

INSERT INTO `quiz_users` (`quiz_id`, `user_id`, `score`, `start_time`, `date_submitted`, `time_taken`) VALUES
(4, 177, 4, '2013-11-07 21:20:53', '2013-11-07 21:21:27', '00:34'),
(5, 177, 5, '2013-11-07 21:38:49', '2013-11-07 21:39:09', '00:20');

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
('071adaj79juoqagmgonh8hb212', 1383684151, 'slim.flash|a:0:{}quizid|s:1:"4";score|i:0;correct|a:0:{}wrong|a:0:{}finished|s:2:"no";num|i:0;last|N;timetaken|N;starttime|N;urlRedirect|s:7:"/admin/";'),
('e4oahg6km02qb6f7tlabvtaim7', 1383775979, 'slim.flash|a:0:{}urlRedirect|s:7:"/admin/";'),
('eecugv9igr6ojjjam1lrc0ijb5', 1383860357, 'slim.flash|a:0:{}'),
('gdm5s36ohoo0ov5vvqpl3ukef0', 1383600543, 'slim.flash|a:0:{}urlRedirect|s:13:"/admin/quiz/2";'),
('gtuqpkqfpgroth1gfiav9glt01', 1383776127, 'slim.flash|a:0:{}adminuser|b:1;user|s:5:"Admin";'),
('h79o130mqpon3kl31ibao86pm1', 1383601835, 'urlRedirect|s:7:"/admin/";slim.flash|a:0:{}'),
('hrns6rn86lkfqd0hmdons28137', 1383601727, 'slim.flash|a:0:{}urlRedirect|s:7:"/admin/";'),
('m7sqb4u5spnp45gojfef36st37', 1383775684, 'slim.flash|a:0:{}urlRedirect|s:7:"/admin/";'),
('q6v7bf6mio9ri8bjnnfh5mi1i0', 1383859307, 'slim.flash|a:0:{}urlRedirect|s:7:"/admin/";');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=178 ;

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
(177, 'ElanMan', '', '', 0);

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
