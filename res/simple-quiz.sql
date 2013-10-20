-- phpMyAdmin SQL Dump
-- version 4.0.7
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 20, 2013 at 10:19 PM
-- Server version: 5.5.33a-MariaDB-log
-- PHP Version: 5.5.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


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
  `question_id` int(11) NOT NULL,
  `question_num` int(11) NOT NULL,
  `quiz_id` int(11) NOT NULL,
  `text` varchar(255) NOT NULL,
  `correct` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `question_id` (`question_id`,`correct`),
  KEY `question_num` (`question_num`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=113 ;

--
-- Dumping data for table `answers`
--

INSERT INTO `answers` (`id`, `question_id`, `question_num`, `quiz_id`, `text`, `correct`) VALUES
(1, 1, 1, 1, 'File Transfer Protocol', 1),
(2, 1, 1, 1, 'Force Through Privately', 0),
(3, 1, 1, 1, 'File Through Protocol', 0),
(4, 1, 1, 1, 'File Test Protocol', 0),
(5, 2, 2, 1, 'Asynchronous JavaScript and XML', 1),
(6, 2, 2, 1, 'All JavaScript and XML', 0),
(7, 2, 2, 1, 'Alternative Java and XML', 0),
(8, 2, 2, 1, 'Actual JavaScript and XML', 0),
(9, 3, 3, 1, 'Really Simple Syndication', 1),
(10, 3, 3, 1, 'Really Simple Scripting', 0),
(11, 3, 3, 1, 'Ready-Styled Scripting', 0),
(12, 3, 3, 1, 'Really Stupid Syndication', 0),
(13, 4, 4, 1, 'Cross-site Scripting', 1),
(14, 4, 4, 1, 'Cross-site Security', 0),
(15, 4, 4, 1, 'Cleverly Structured Scripting', 0),
(16, 4, 4, 1, 'eXtremely Safe and Secure', 0),
(17, 5, 5, 1, 'PHP: Hypertext Preprocessor', 1),
(18, 5, 5, 1, 'Post Hypertext Processor', 0),
(19, 5, 5, 1, 'Practical HTML Processing', 0),
(20, 5, 5, 1, 'Process HTML Prettily', 0),
(21, 6, 6, 1, 'World Wide Web Consortium', 1),
(22, 6, 6, 1, 'World Wide Web Committee', 0),
(23, 6, 6, 1, 'World Wide Web Creatives', 0),
(24, 6, 6, 1, 'Wakefield Willy Wavers Club', 0),
(25, 7, 7, 1, 'eXtensible Markup Language', 1),
(26, 7, 7, 1, 'eXtendable Markup Language', 0),
(27, 7, 7, 1, 'Crossover Markup Language', 0),
(28, 7, 7, 1, 'eXtreme Markup Language', 0),
(29, 8, 8, 1, 'Yahoo User Interface', 1),
(30, 8, 8, 1, 'Yahoo''s Useful Idea', 0),
(31, 8, 8, 1, 'Yahoo Utility Interface', 0),
(32, 8, 8, 1, 'Yahoo User Interaction', 0),
(33, 9, 9, 1, 'Hypertext Markup Language', 1),
(34, 9, 9, 1, 'Human Markup Language', 0),
(35, 9, 9, 1, 'Helpful Markup Language', 0),
(36, 9, 9, 1, 'Hypertext Memory Language', 0),
(37, 10, 10, 1, 'Common Gateway Interface', 1),
(38, 10, 10, 1, 'Common or Garden Interaction', 0),
(39, 10, 10, 1, 'Computer''s Graphical Intelligence', 0),
(40, 10, 10, 1, 'Common Graphical Interface', 0),
(41, 11, 11, 1, 'Secure Sockets Layer', 1),
(42, 11, 11, 1, 'Server Security Layer', 0),
(43, 11, 11, 1, 'Server Security Level', 0),
(44, 11, 11, 1, 'Secret Socket Layer', 0),
(45, 12, 12, 1, 'Structured Query Language', 1),
(46, 12, 12, 1, 'Stupid Query Language', 0),
(47, 12, 12, 1, 'Secure Query Language', 0),
(48, 12, 12, 1, 'Strict Query Language', 0),
(49, 13, 13, 1, 'Hypertext Transfer Protocol', 1),
(50, 13, 13, 1, 'Hypertext Traffic Protocol', 0),
(51, 13, 13, 1, 'HTML Traffic Transfer Protocol', 0),
(52, 13, 13, 1, 'HTML Through Traffic Protocol', 0),
(53, 14, 14, 1, 'Cascading Style Sheets', 1),
(54, 14, 14, 1, 'Custom Style Sheets', 0),
(55, 14, 14, 1, 'Clientside Style Sheets', 0),
(56, 14, 14, 1, 'Calculated Style Sheets', 0),
(57, 15, 15, 1, 'Simple Object Access Protocol', 1),
(58, 15, 15, 1, 'Structured Object Access Protocol', 0),
(59, 15, 15, 1, 'Simple, Objective And Private', 0),
(60, 15, 15, 1, 'Simply Obvious Access Principle', 0),
(61, 16, 16, 1, 'Web Accessibility Initiative', 1),
(62, 16, 16, 1, 'World Wide Accessibility Intiative', 0),
(63, 16, 16, 1, 'World Wide Accessibility Incorporation', 0),
(64, 16, 16, 1, 'Web Accessibility and Inclusion', 0),
(65, 17, 17, 1, 'Server-Side Include', 1),
(66, 17, 17, 1, 'Server-Side Intelligence', 0),
(67, 17, 17, 1, 'Scripted Server Include', 0),
(68, 17, 17, 1, 'Secure Server Include', 0),
(69, 18, 18, 1, 'JavaScript Object Notation', 1),
(70, 18, 18, 1, 'JQuery-Scripting Object Notation', 0),
(71, 18, 18, 1, 'Just Simple Object Notation', 0),
(72, 18, 18, 1, 'JavaScript Over the Net', 0),
(73, 19, 19, 1, 'eXtensible Stylesheet Language Transformation', 1),
(74, 19, 19, 1, 'eXpandable Stylesheet Language Transfer', 0),
(75, 19, 19, 1, 'eXtensible Stylesheet Language Transfer', 0),
(76, 19, 19, 1, 'eXtendable Stylesheet Language Transformation', 0),
(77, 20, 20, 1, 'Web Content Accessibility Guidelines', 1),
(78, 20, 20, 1, 'Wakefield Community Action Group', 0),
(79, 20, 20, 1, 'Web Criteria And Guidelines', 0),
(80, 20, 20, 1, 'World-wide Common Access Group', 0),
(81, 21, 1, 2, 'Robert De Niro', 1),
(82, 21, 1, 2, 'Harrison Ford', 0),
(83, 21, 1, 2, 'Ray Winston', 0),
(84, 21, 1, 2, 'Leo Sayer', 0),
(85, 22, 2, 2, 'Morgan Freeman', 1),
(86, 22, 2, 2, 'Leo Sayer', 0),
(87, 22, 2, 2, 'Harrison  Ford', 0),
(88, 22, 2, 2, 'Ben Hall', 0),
(89, 23, 3, 2, 'Marlon Brando', 1),
(90, 23, 3, 2, 'Jerry Lewis', 0),
(91, 23, 3, 2, 'Robert De Niro', 0),
(92, 23, 3, 2, 'Daniel Craig', 0),
(93, 24, 4, 2, 'Harrison Ford', 1),
(94, 24, 4, 2, 'Leo Sayer', 0),
(95, 24, 4, 2, 'Tommy Lee Jones', 0),
(96, 24, 4, 2, 'Marlon Brando', 0),
(97, 25, 5, 2, 'Tom Hanks', 1),
(98, 25, 5, 2, 'Larry Hagman', 0),
(99, 25, 5, 2, 'Tom Cruise', 0),
(100, 25, 5, 2, 'Val Kilmer', 0),
(101, 26, 6, 2, 'Val Kilmer', 1),
(102, 26, 6, 2, 'George Clooney', 0),
(103, 26, 6, 2, 'Christian Bale', 0),
(104, 26, 6, 2, 'Michael Keaton', 0),
(105, 27, 7, 2, 'John Travolta', 1),
(106, 27, 7, 2, 'Samuel L. Jackson', 0),
(107, 27, 7, 2, 'Ray Winstone', 0),
(108, 27, 7, 2, 'Quentin Tarantino', 0),
(109, 28, 8, 2, 'Quentin Tarantino', 0),
(110, 28, 8, 2, 'Samuel L. Jackson', 1),
(111, 28, 8, 2, 'John Travolta', 0),
(112, 28, 8, 2, 'Daniel Day-Lewis', 0);

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE IF NOT EXISTS `questions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `num` int(11) NOT NULL,
  `quiz_id` int(11) NOT NULL,
  `text` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `quiz_id` (`quiz_id`),
  KEY `num` (`num`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=29 ;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `num`, `quiz_id`, `text`) VALUES
(1, 1, 1, 'What does FTP stand for?'),
(2, 2, 1, 'What does AJAX stand for?'),
(3, 3, 1, 'What does RSS stand for?'),
(4, 4, 1, 'What does XSS stand for?'),
(5, 5, 1, 'What does PHP stand for?'),
(6, 6, 1, 'What does W3C stand for?'),
(7, 7, 1, 'What does XML stand for?'),
(8, 8, 1, 'What does YUI stand for?'),
(9, 9, 1, 'What does HTML stand for?'),
(10, 10, 1, 'What does CGI stand for?'),
(11, 11, 1, 'What does SSL stand for?'),
(12, 12, 1, 'What does SQL stand for?'),
(13, 13, 1, 'What does HTTP stand for?'),
(14, 14, 1, 'What does CSS stand for?'),
(15, 15, 1, 'What does SOAP stand for?'),
(16, 16, 1, 'What does WAI stand for?'),
(17, 17, 1, 'What does SSI stand for?'),
(18, 18, 1, 'What does JSON stand for?'),
(19, 19, 1, 'What does XSLT stand for?'),
(20, 20, 1, 'What does WCAG stand for?'),
(21, 1, 2, 'Who played the lead role in Taxi Driver?'),
(22, 2, 2, 'Who played Red in The Shawshank Redemption?'),
(23, 3, 2, 'Who played The Godfather?'),
(24, 4, 2, 'Who played The Fugitive?'),
(25, 5, 2, 'Who played Forrest Gump?'),
(26, 6, 2, 'Which actor played Batman in Batman Forever?'),
(27, 7, 2, 'Who played Vincent Vega in Pulp Fiction?'),
(28, 8, 2, 'Who played Jules Winnfield in Pulp Fiction?');

-- --------------------------------------------------------

--
-- Table structure for table `quizzes`
--

CREATE TABLE IF NOT EXISTS `quizzes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `description` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `quizzes`
--

INSERT INTO `quizzes` (`id`, `name`, `description`) VALUES
(1, 'Web Acronyms', 'XML? HTTP? SOAP? How well do you know your web acronyms?'),
(2, 'Actors In Films', 'Which actor played the film character?');

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
('aovikgmsuue9ht12g0q914sn02', 1382303907, 'score|i:0;correct|a:0:{}wrong|a:0:{}finished|s:2:"no";num|i:0;last|N;timetaken|N;starttime|N;slim.flash|a:0:{}');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `quiz_id` int(11) NOT NULL,
  `name` varchar(60) NOT NULL,
  `score` int(11) NOT NULL,
  `start_time` datetime NOT NULL,
  `date_submitted` datetime NOT NULL,
  `time_taken` varchar(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `name` (`name`,`score`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=146 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `quiz_id`, `name`, `score`, `start_time`, `date_submitted`, `time_taken`) VALUES
(3, 1, 'Anon134', 5, '0000-00-00 00:00:00', '2013-04-17 21:22:44', ''),
(4, 1, 'Anon287', 7, '0000-00-00 00:00:00', '2013-04-17 21:28:16', ''),
(5, 1, 'Anon285', 5, '0000-00-00 00:00:00', '2013-04-17 21:58:25', ''),
(6, 1, 'Anon203', 5, '0000-00-00 00:00:00', '2013-04-17 22:12:49', ''),
(7, 1, 'Anon949', 4, '0000-00-00 00:00:00', '2013-04-17 22:17:05', ''),
(8, 1, 'Anon771', 7, '0000-00-00 00:00:00', '2013-04-17 22:19:26', ''),
(9, 1, 'bbb', 9, '0000-00-00 00:00:00', '2013-04-17 22:35:51', ''),
(10, 1, 'Anon400', 4, '0000-00-00 00:00:00', '2013-04-18 19:12:13', ''),
(11, 1, ';lpokk', 7, '0000-00-00 00:00:00', '2013-04-18 20:59:12', ''),
(12, 1, 'gytr', 3, '0000-00-00 00:00:00', '2013-04-18 21:57:44', ''),
(13, 1, 'lpoij', 5, '0000-00-00 00:00:00', '2013-04-18 22:00:00', ''),
(14, 1, 'Anon835', 1, '0000-00-00 00:00:00', '2013-04-30 21:08:51', ''),
(15, 1, 'Anon285', 2, '0000-00-00 00:00:00', '2013-05-09 22:30:12', ''),
(16, 1, 'Anon241', 3, '0000-00-00 00:00:00', '2013-05-09 22:34:44', ''),
(17, 1, 'Anon406', 11, '0000-00-00 00:00:00', '2013-05-09 22:38:39', ''),
(18, 1, 'Anon939', 2, '0000-00-00 00:00:00', '2013-08-12 21:21:21', ''),
(19, 1, 'Anon621', 6, '0000-00-00 00:00:00', '2013-08-12 21:40:37', ''),
(20, 1, 'bobomcgraw', 8, '0000-00-00 00:00:00', '2013-08-12 22:03:57', ''),
(21, 1, 'Anon116', 8, '0000-00-00 00:00:00', '2013-09-21 18:58:31', ''),
(22, 1, 'Anon127', 7, '0000-00-00 00:00:00', '2013-09-23 20:55:06', ''),
(23, 1, 'Anon956', 6, '0000-00-00 00:00:00', '2013-09-23 20:56:40', ''),
(24, 1, 'Anon980', 8, '0000-00-00 00:00:00', '2013-09-23 21:30:31', ''),
(25, 1, 'Anon986', 7, '0000-00-00 00:00:00', '2013-09-25 21:32:43', ''),
(26, 1, 'Anon539', 3, '0000-00-00 00:00:00', '2013-09-26 20:51:42', ''),
(27, 1, 'Anon135', 7, '0000-00-00 00:00:00', '2013-09-26 21:21:33', ''),
(28, 1, 'Anon426', 6, '0000-00-00 00:00:00', '2013-09-28 08:11:36', ''),
(29, 1, 'Anon260', 3, '0000-00-00 00:00:00', '2013-09-28 08:56:57', ''),
(30, 1, 'dwert', 2, '0000-00-00 00:00:00', '2013-09-28 09:05:42', ''),
(31, 1, 'Anon643', 4, '0000-00-00 00:00:00', '2013-09-29 18:26:54', ''),
(32, 1, 'Anon643', 4, '0000-00-00 00:00:00', '2013-09-29 18:28:44', ''),
(33, 1, 'Anon643', 4, '0000-00-00 00:00:00', '2013-09-29 18:31:32', ''),
(34, 1, 'Anon643', 4, '0000-00-00 00:00:00', '2013-09-29 18:32:17', ''),
(35, 1, 'Anon643', 4, '0000-00-00 00:00:00', '2013-09-29 18:34:36', ''),
(36, 1, 'Anon643', 4, '0000-00-00 00:00:00', '2013-09-29 18:36:23', ''),
(37, 1, 'Anon643', 4, '0000-00-00 00:00:00', '2013-09-29 18:37:28', ''),
(38, 1, 'Anon643', 4, '0000-00-00 00:00:00', '2013-09-29 18:37:59', ''),
(39, 1, 'Anon643', 4, '0000-00-00 00:00:00', '2013-09-29 18:38:10', ''),
(40, 1, 'Anon643', 4, '0000-00-00 00:00:00', '2013-09-29 18:39:06', ''),
(41, 1, 'Anon643', 4, '0000-00-00 00:00:00', '2013-09-29 18:40:49', ''),
(42, 1, 'Anon638', 2, '0000-00-00 00:00:00', '2013-09-30 19:21:22', ''),
(43, 1, 'Anon638', 3, '0000-00-00 00:00:00', '2013-09-30 19:54:48', ''),
(44, 1, 'Anon638', 4, '0000-00-00 00:00:00', '2013-09-30 19:54:57', ''),
(45, 1, 'Anon638', 4, '0000-00-00 00:00:00', '2013-09-30 19:55:09', ''),
(46, 1, 'Anon60', 0, '0000-00-00 00:00:00', '2013-09-30 19:58:34', ''),
(47, 1, 'Anon752', 0, '0000-00-00 00:00:00', '2013-09-30 19:58:46', ''),
(48, 1, 'Anon752', 0, '0000-00-00 00:00:00', '2013-09-30 19:58:49', ''),
(49, 1, 'Anon752', 0, '0000-00-00 00:00:00', '2013-09-30 19:58:50', ''),
(50, 1, 'Anon752', 0, '0000-00-00 00:00:00', '2013-09-30 19:58:50', ''),
(51, 1, 'Anon752', 0, '0000-00-00 00:00:00', '2013-09-30 19:58:51', ''),
(52, 1, 'Anon752', 0, '0000-00-00 00:00:00', '2013-09-30 19:58:51', ''),
(53, 1, 'Anon752', 0, '0000-00-00 00:00:00', '2013-09-30 19:58:52', ''),
(54, 1, 'Anon752', 0, '0000-00-00 00:00:00', '2013-09-30 19:58:52', ''),
(55, 1, 'Anon524', 2, '0000-00-00 00:00:00', '2013-09-30 19:59:34', ''),
(56, 1, 'Anon914', 7, '0000-00-00 00:00:00', '2013-09-30 20:21:28', ''),
(57, 1, 'Anon576', 8, '0000-00-00 00:00:00', '2013-09-30 20:22:14', ''),
(58, 1, 'Anon982', 0, '0000-00-00 00:00:00', '2013-09-30 20:25:26', ''),
(59, 1, 'Anon137', 6, '0000-00-00 00:00:00', '2013-09-30 20:29:50', ''),
(60, 1, 'Anon425', 4, '0000-00-00 00:00:00', '2013-09-30 20:32:35', ''),
(61, 1, 'Anon602', 3, '0000-00-00 00:00:00', '2013-09-30 20:34:30', ''),
(62, 1, 'Anon916', 5, '0000-00-00 00:00:00', '2013-09-30 21:54:13', ''),
(63, 1, 'chunky', 9, '0000-00-00 00:00:00', '2013-10-08 19:52:37', ''),
(64, 1, 'wonky', 6, '2013-10-08 20:07:55', '2013-10-08 20:08:21', ''),
(65, 1, 'Anon50', 3, '2013-10-08 20:45:08', '2013-10-08 20:45:42', ''),
(66, 1, 'Anon50', 3, '2013-10-08 20:45:08', '2013-10-08 20:46:43', ''),
(67, 1, 'Anon50', 3, '2013-10-08 20:45:08', '2013-10-08 20:46:48', ''),
(68, 1, 'Anon50', 3, '2013-10-08 20:45:08', '2013-10-08 20:46:50', ''),
(69, 1, 'Anon50', 3, '2013-10-08 20:45:08', '2013-10-08 20:46:51', ''),
(70, 1, 'Anon50', 3, '2013-10-08 20:45:08', '2013-10-08 20:46:52', ''),
(71, 1, 'Anon50', 3, '2013-10-08 20:45:08', '2013-10-08 20:46:52', ''),
(72, 1, 'Anon50', 3, '2013-10-08 20:45:08', '2013-10-08 20:46:53', ''),
(73, 1, 'Anon50', 3, '2013-10-08 20:45:08', '2013-10-08 21:00:22', ''),
(74, 1, 'Anon50', 3, '2013-10-08 20:45:08', '2013-10-08 21:00:25', ''),
(75, 1, 'Anon50', 3, '2013-10-08 20:45:08', '2013-10-08 21:00:31', ''),
(76, 1, 'Anon50', 3, '2013-10-08 20:45:08', '2013-10-08 21:01:41', ''),
(77, 1, 'Anon50', 3, '2013-10-08 20:45:08', '2013-10-08 21:01:43', ''),
(78, 1, 'Anon50', 3, '2013-10-08 20:45:08', '2013-10-08 21:01:44', ''),
(79, 1, 'Anon50', 3, '2013-10-08 20:45:08', '2013-10-08 21:01:45', ''),
(80, 1, 'flinky', 5, '2013-10-08 21:03:53', '2013-10-08 21:04:29', ''),
(81, 1, 'flinky', 5, '2013-10-08 21:03:53', '2013-10-08 21:04:34', ''),
(82, 1, 'flinky', 5, '2013-10-08 21:03:53', '2013-10-08 21:04:40', ''),
(83, 1, 'flinky', 5, '2013-10-08 21:03:53', '2013-10-08 21:05:34', ''),
(84, 1, 'flinky', 5, '2013-10-08 21:03:53', '2013-10-08 21:05:35', ''),
(85, 1, 'fonky', 0, '2013-10-08 21:05:46', '2013-10-08 21:05:46', ''),
(86, 1, 'dfret', 2, '2013-10-08 21:07:31', '2013-10-08 21:10:21', ''),
(87, 1, 'dfret', 2, '2013-10-08 21:07:31', '2013-10-08 21:10:25', ''),
(88, 1, 'dfret', 2, '2013-10-08 21:07:31', '2013-10-08 21:10:25', ''),
(89, 1, 'dfret', 2, '2013-10-08 21:07:31', '2013-10-08 21:10:26', ''),
(90, 1, 'dfret', 2, '2013-10-08 21:07:31', '2013-10-08 21:10:27', ''),
(91, 1, 'dfret', 2, '2013-10-08 21:07:31', '2013-10-08 21:20:34', ''),
(92, 1, 'dfret', 2, '2013-10-08 21:07:31', '2013-10-08 21:24:58', ''),
(93, 1, 'dfret', 2, '2013-10-08 21:07:31', '2013-10-08 21:24:59', ''),
(94, 1, 'dfret', 2, '2013-10-08 21:07:31', '2013-10-08 21:25:00', ''),
(95, 1, 'dfret', 2, '2013-10-08 21:07:31', '2013-10-08 21:25:00', ''),
(96, 1, 'dfret', 2, '2013-10-08 21:07:31', '2013-10-08 21:25:01', ''),
(97, 1, 'zsadw', 4, '2013-10-08 21:25:37', '2013-10-08 21:26:05', ''),
(98, 1, 'zsadw', 4, '2013-10-08 21:25:37', '2013-10-08 21:28:53', ''),
(99, 1, 'zsadw', 4, '2013-10-08 21:25:37', '2013-10-08 21:29:06', ''),
(100, 1, 'zsadw', 4, '2013-10-08 21:25:37', '2013-10-08 21:29:07', ''),
(101, 1, 'slink', 0, '2013-10-08 21:29:22', '2013-10-08 21:29:22', ''),
(102, 1, 'Anon294', 0, '2013-10-08 21:33:49', '2013-10-08 21:33:49', ''),
(103, 1, 'Anon294', 0, '2013-10-08 21:33:49', '2013-10-08 21:35:00', ''),
(104, 1, 'Anon93', 5, '2013-10-08 21:35:08', '2013-10-08 21:35:33', ''),
(105, 1, 'Anon93', 5, '2013-10-08 21:35:08', '2013-10-08 21:35:38', ''),
(106, 1, 'Anon93', 5, '2013-10-08 21:35:08', '2013-10-08 21:35:39', ''),
(107, 1, 'Anon609', 3, '2013-10-08 21:35:47', '2013-10-08 21:36:19', ''),
(108, 1, 'Anon609', 3, '2013-10-08 21:35:47', '2013-10-08 21:36:25', ''),
(109, 1, 'Anon609', 3, '2013-10-08 21:35:47', '2013-10-08 21:36:26', ''),
(110, 1, 'Anon609', 3, '2013-10-08 21:35:47', '2013-10-08 21:36:26', ''),
(111, 1, 'Anon609', 3, '2013-10-08 21:35:47', '2013-10-08 21:37:32', ''),
(112, 1, 'Anon753', 3, '2013-10-08 21:37:48', '2013-10-08 21:38:15', ''),
(113, 1, 'Anon753', 3, '2013-10-08 21:37:48', '2013-10-08 21:38:18', ''),
(114, 1, 'Anon753', 3, '2013-10-08 21:37:48', '2013-10-08 21:38:19', ''),
(115, 1, 'sdsdsdungh', 2, '2013-10-08 21:38:33', '2013-10-08 21:41:46', ''),
(116, 1, 'sdsdsdungh', 2, '2013-10-08 21:38:33', '2013-10-08 21:47:00', ''),
(117, 1, 'Anon850', 4, '2013-10-08 21:56:28', '2013-10-08 21:58:08', '01:00'),
(118, 1, 'Anon850', 4, '2013-10-08 21:56:28', '2013-10-08 21:58:39', '01:00'),
(119, 1, 'swerty', 7, '2013-10-08 22:00:41', '2013-10-08 22:01:20', '00:39'),
(120, 1, 'Anon256', 4, '2013-10-11 19:17:17', '2013-10-11 19:17:46', '00:29'),
(121, 1, 'bobobobob', 3, '2013-10-11 19:19:30', '2013-10-11 19:19:55', '00:25'),
(122, 1, 'sssss', 3, '2013-10-14 21:27:16', '2013-10-14 21:27:48', '00:32'),
(123, 1, 'Anon764', 9, '2013-10-19 17:34:19', '2013-10-19 17:34:47', '00:28'),
(124, 1, 'dertw', 4, '2013-10-19 18:45:25', '2013-10-19 18:46:09', '00:44'),
(125, 1, 'Anon686', 4, '2013-10-19 19:33:43', '2013-10-19 19:34:16', '00:33'),
(126, 2, 'Anon50', 0, '2013-10-20 14:25:45', '2013-10-20 14:28:13', '02:28'),
(127, 2, 'Anon63', 4, '2013-10-20 14:40:00', '2013-10-20 14:40:13', '00:13'),
(128, 2, 'Anon154', 3, '2013-10-20 18:12:49', '2013-10-20 18:13:01', '00:12'),
(129, 2, 'Anon31', 3, '2013-10-20 18:21:51', '2013-10-20 18:22:05', '00:14'),
(130, 2, 'Anon552', 1, '2013-10-20 18:22:39', '2013-10-20 18:22:50', '00:11'),
(131, 2, 'Anon79', 1, '2013-10-20 18:35:44', '2013-10-20 18:36:07', '00:23'),
(132, 2, 'Anon362', 4, '2013-10-20 18:36:27', '2013-10-20 18:36:41', '00:14'),
(133, 2, 'Anon581', 2, '2013-10-20 19:10:47', '2013-10-20 19:11:11', '00:24'),
(134, 2, 'Anon224', 0, '2013-10-20 19:13:01', '2013-10-20 19:13:19', '00:18'),
(135, 2, 'Anon914', 3, '2013-10-20 19:16:21', '2013-10-20 19:16:33', '00:12'),
(136, 2, 'Anon910', 2, '2013-10-20 19:18:09', '2013-10-20 19:18:19', '00:10'),
(137, 2, 'Anon784', 2, '2013-10-20 19:25:54', '2013-10-20 19:26:10', '00:16'),
(138, 2, 'Anon591', 0, '2013-10-20 19:27:05', '2013-10-20 19:27:17', '00:12'),
(139, 2, 'Anon381', 4, '2013-10-20 19:33:06', '2013-10-20 19:33:19', '00:13'),
(140, 2, 'Anon440', 2, '2013-10-20 19:34:07', '2013-10-20 19:34:19', '00:12'),
(141, 2, 'Anon197', 2, '2013-10-20 19:35:39', '2013-10-20 19:35:50', '00:11'),
(142, 2, 'Anon483', 2, '2013-10-20 19:40:57', '2013-10-20 19:41:07', '00:10'),
(143, 2, 'Anon453', 3, '2013-10-20 19:42:36', '2013-10-20 19:42:48', '00:12'),
(144, 2, 'Anon220', 2, '2013-10-20 22:16:22', '2013-10-20 22:16:33', '00:11'),
(145, 1, 'Anon835', 3, '2013-10-20 22:17:36', '2013-10-20 22:18:08', '00:32');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
