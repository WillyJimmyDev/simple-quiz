-- phpMyAdmin SQL Dump
-- version 4.0.8
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 28, 2013 at 02:01 PM
-- Server version: 5.5.33a-MariaDB-log
-- PHP Version: 5.5.5

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
  `active` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `active` (`active`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `quizzes`
--

INSERT INTO `quizzes` (`id`, `name`, `description`, `active`) VALUES
(1, 'Web Acronyms', 'XML? HTTP? SOAP? How well do you know your web acronyms?', 1),
(2, 'Actors In Films', 'Which actor played the film character?', 1);

-- --------------------------------------------------------

--
-- Table structure for table `quiz_users`
--

CREATE TABLE IF NOT EXISTS `quiz_users` (
  `quiz_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
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
(1, 3, 5, '0000-00-00 00:00:00', '2013-04-17 21:22:44', ''),
(1, 4, 7, '0000-00-00 00:00:00', '2013-04-17 21:28:16', ''),
(1, 5, 5, '0000-00-00 00:00:00', '2013-04-17 21:58:25', ''),
(1, 6, 5, '0000-00-00 00:00:00', '2013-04-17 22:12:49', ''),
(1, 7, 4, '0000-00-00 00:00:00', '2013-04-17 22:17:05', ''),
(1, 8, 7, '0000-00-00 00:00:00', '2013-04-17 22:19:26', ''),
(1, 9, 9, '0000-00-00 00:00:00', '2013-04-17 22:35:51', ''),
(1, 10, 4, '0000-00-00 00:00:00', '2013-04-18 19:12:13', ''),
(1, 11, 7, '0000-00-00 00:00:00', '2013-04-18 20:59:12', ''),
(1, 12, 3, '0000-00-00 00:00:00', '2013-04-18 21:57:44', ''),
(1, 13, 5, '0000-00-00 00:00:00', '2013-04-18 22:00:00', ''),
(1, 14, 1, '0000-00-00 00:00:00', '2013-04-30 21:08:51', ''),
(1, 15, 2, '0000-00-00 00:00:00', '2013-05-09 22:30:12', ''),
(1, 16, 3, '0000-00-00 00:00:00', '2013-05-09 22:34:44', ''),
(1, 17, 11, '0000-00-00 00:00:00', '2013-05-09 22:38:39', ''),
(1, 18, 2, '0000-00-00 00:00:00', '2013-08-12 21:21:21', ''),
(1, 19, 6, '0000-00-00 00:00:00', '2013-08-12 21:40:37', ''),
(1, 20, 8, '0000-00-00 00:00:00', '2013-08-12 22:03:57', ''),
(1, 21, 8, '0000-00-00 00:00:00', '2013-09-21 18:58:31', ''),
(1, 22, 7, '0000-00-00 00:00:00', '2013-09-23 20:55:06', ''),
(1, 23, 6, '0000-00-00 00:00:00', '2013-09-23 20:56:40', ''),
(1, 24, 8, '0000-00-00 00:00:00', '2013-09-23 21:30:31', ''),
(1, 25, 7, '0000-00-00 00:00:00', '2013-09-25 21:32:43', ''),
(1, 26, 3, '0000-00-00 00:00:00', '2013-09-26 20:51:42', ''),
(1, 27, 7, '0000-00-00 00:00:00', '2013-09-26 21:21:33', ''),
(1, 28, 6, '0000-00-00 00:00:00', '2013-09-28 08:11:36', ''),
(1, 29, 3, '0000-00-00 00:00:00', '2013-09-28 08:56:57', ''),
(1, 30, 2, '0000-00-00 00:00:00', '2013-09-28 09:05:42', ''),
(1, 31, 4, '0000-00-00 00:00:00', '2013-09-29 18:26:54', ''),
(1, 32, 4, '0000-00-00 00:00:00', '2013-09-29 18:28:44', ''),
(1, 33, 4, '0000-00-00 00:00:00', '2013-09-29 18:31:32', ''),
(1, 34, 4, '0000-00-00 00:00:00', '2013-09-29 18:32:17', ''),
(1, 35, 4, '0000-00-00 00:00:00', '2013-09-29 18:34:36', ''),
(1, 36, 4, '0000-00-00 00:00:00', '2013-09-29 18:36:23', ''),
(1, 37, 4, '0000-00-00 00:00:00', '2013-09-29 18:37:28', ''),
(1, 38, 4, '0000-00-00 00:00:00', '2013-09-29 18:37:59', ''),
(1, 39, 4, '0000-00-00 00:00:00', '2013-09-29 18:38:10', ''),
(1, 40, 4, '0000-00-00 00:00:00', '2013-09-29 18:39:06', ''),
(1, 41, 4, '0000-00-00 00:00:00', '2013-09-29 18:40:49', ''),
(1, 42, 2, '0000-00-00 00:00:00', '2013-09-30 19:21:22', ''),
(1, 43, 3, '0000-00-00 00:00:00', '2013-09-30 19:54:48', ''),
(1, 44, 4, '0000-00-00 00:00:00', '2013-09-30 19:54:57', ''),
(1, 45, 4, '0000-00-00 00:00:00', '2013-09-30 19:55:09', ''),
(1, 46, 0, '0000-00-00 00:00:00', '2013-09-30 19:58:34', ''),
(1, 47, 0, '0000-00-00 00:00:00', '2013-09-30 19:58:46', ''),
(1, 48, 0, '0000-00-00 00:00:00', '2013-09-30 19:58:49', ''),
(1, 49, 0, '0000-00-00 00:00:00', '2013-09-30 19:58:50', ''),
(1, 50, 0, '0000-00-00 00:00:00', '2013-09-30 19:58:50', ''),
(1, 51, 0, '0000-00-00 00:00:00', '2013-09-30 19:58:51', ''),
(1, 52, 0, '0000-00-00 00:00:00', '2013-09-30 19:58:51', ''),
(1, 53, 0, '0000-00-00 00:00:00', '2013-09-30 19:58:52', ''),
(1, 54, 0, '0000-00-00 00:00:00', '2013-09-30 19:58:52', ''),
(1, 55, 2, '0000-00-00 00:00:00', '2013-09-30 19:59:34', ''),
(1, 56, 7, '0000-00-00 00:00:00', '2013-09-30 20:21:28', ''),
(1, 57, 8, '0000-00-00 00:00:00', '2013-09-30 20:22:14', ''),
(1, 58, 0, '0000-00-00 00:00:00', '2013-09-30 20:25:26', ''),
(1, 59, 6, '0000-00-00 00:00:00', '2013-09-30 20:29:50', ''),
(1, 60, 4, '0000-00-00 00:00:00', '2013-09-30 20:32:35', ''),
(1, 61, 3, '0000-00-00 00:00:00', '2013-09-30 20:34:30', ''),
(1, 62, 5, '0000-00-00 00:00:00', '2013-09-30 21:54:13', ''),
(1, 63, 9, '0000-00-00 00:00:00', '2013-10-08 19:52:37', ''),
(1, 64, 6, '2013-10-08 20:07:55', '2013-10-08 20:08:21', ''),
(1, 65, 3, '2013-10-08 20:45:08', '2013-10-08 20:45:42', ''),
(1, 66, 3, '2013-10-08 20:45:08', '2013-10-08 20:46:43', ''),
(1, 67, 3, '2013-10-08 20:45:08', '2013-10-08 20:46:48', ''),
(1, 68, 3, '2013-10-08 20:45:08', '2013-10-08 20:46:50', ''),
(1, 69, 3, '2013-10-08 20:45:08', '2013-10-08 20:46:51', ''),
(1, 70, 3, '2013-10-08 20:45:08', '2013-10-08 20:46:52', ''),
(1, 71, 3, '2013-10-08 20:45:08', '2013-10-08 20:46:52', ''),
(1, 72, 3, '2013-10-08 20:45:08', '2013-10-08 20:46:53', ''),
(1, 73, 3, '2013-10-08 20:45:08', '2013-10-08 21:00:22', ''),
(1, 74, 3, '2013-10-08 20:45:08', '2013-10-08 21:00:25', ''),
(1, 75, 3, '2013-10-08 20:45:08', '2013-10-08 21:00:31', ''),
(1, 76, 3, '2013-10-08 20:45:08', '2013-10-08 21:01:41', ''),
(1, 77, 3, '2013-10-08 20:45:08', '2013-10-08 21:01:43', ''),
(1, 78, 3, '2013-10-08 20:45:08', '2013-10-08 21:01:44', ''),
(1, 79, 3, '2013-10-08 20:45:08', '2013-10-08 21:01:45', ''),
(1, 80, 5, '2013-10-08 21:03:53', '2013-10-08 21:04:29', ''),
(1, 81, 5, '2013-10-08 21:03:53', '2013-10-08 21:04:34', ''),
(1, 82, 5, '2013-10-08 21:03:53', '2013-10-08 21:04:40', ''),
(1, 83, 5, '2013-10-08 21:03:53', '2013-10-08 21:05:34', ''),
(1, 84, 5, '2013-10-08 21:03:53', '2013-10-08 21:05:35', ''),
(1, 85, 0, '2013-10-08 21:05:46', '2013-10-08 21:05:46', ''),
(1, 86, 2, '2013-10-08 21:07:31', '2013-10-08 21:10:21', ''),
(1, 87, 2, '2013-10-08 21:07:31', '2013-10-08 21:10:25', ''),
(1, 88, 2, '2013-10-08 21:07:31', '2013-10-08 21:10:25', ''),
(1, 89, 2, '2013-10-08 21:07:31', '2013-10-08 21:10:26', ''),
(1, 90, 2, '2013-10-08 21:07:31', '2013-10-08 21:10:27', ''),
(1, 91, 2, '2013-10-08 21:07:31', '2013-10-08 21:20:34', ''),
(1, 92, 2, '2013-10-08 21:07:31', '2013-10-08 21:24:58', ''),
(1, 93, 2, '2013-10-08 21:07:31', '2013-10-08 21:24:59', ''),
(1, 94, 2, '2013-10-08 21:07:31', '2013-10-08 21:25:00', ''),
(1, 95, 2, '2013-10-08 21:07:31', '2013-10-08 21:25:00', ''),
(1, 96, 2, '2013-10-08 21:07:31', '2013-10-08 21:25:01', ''),
(1, 97, 4, '2013-10-08 21:25:37', '2013-10-08 21:26:05', ''),
(1, 98, 4, '2013-10-08 21:25:37', '2013-10-08 21:28:53', ''),
(1, 99, 4, '2013-10-08 21:25:37', '2013-10-08 21:29:06', ''),
(1, 100, 4, '2013-10-08 21:25:37', '2013-10-08 21:29:07', ''),
(1, 101, 0, '2013-10-08 21:29:22', '2013-10-08 21:29:22', ''),
(1, 102, 0, '2013-10-08 21:33:49', '2013-10-08 21:33:49', ''),
(1, 103, 0, '2013-10-08 21:33:49', '2013-10-08 21:35:00', ''),
(1, 104, 5, '2013-10-08 21:35:08', '2013-10-08 21:35:33', ''),
(1, 105, 5, '2013-10-08 21:35:08', '2013-10-08 21:35:38', ''),
(1, 106, 5, '2013-10-08 21:35:08', '2013-10-08 21:35:39', ''),
(1, 107, 3, '2013-10-08 21:35:47', '2013-10-08 21:36:19', ''),
(1, 108, 3, '2013-10-08 21:35:47', '2013-10-08 21:36:25', ''),
(1, 109, 3, '2013-10-08 21:35:47', '2013-10-08 21:36:26', ''),
(1, 110, 3, '2013-10-08 21:35:47', '2013-10-08 21:36:26', ''),
(1, 111, 3, '2013-10-08 21:35:47', '2013-10-08 21:37:32', ''),
(1, 112, 3, '2013-10-08 21:37:48', '2013-10-08 21:38:15', ''),
(1, 113, 3, '2013-10-08 21:37:48', '2013-10-08 21:38:18', ''),
(1, 114, 3, '2013-10-08 21:37:48', '2013-10-08 21:38:19', ''),
(1, 115, 2, '2013-10-08 21:38:33', '2013-10-08 21:41:46', ''),
(1, 116, 2, '2013-10-08 21:38:33', '2013-10-08 21:47:00', ''),
(1, 117, 4, '2013-10-08 21:56:28', '2013-10-08 21:58:08', '01:00'),
(1, 118, 4, '2013-10-08 21:56:28', '2013-10-08 21:58:39', '01:00'),
(1, 119, 7, '2013-10-08 22:00:41', '2013-10-08 22:01:20', '00:39'),
(1, 120, 4, '2013-10-11 19:17:17', '2013-10-11 19:17:46', '00:29'),
(1, 121, 3, '2013-10-11 19:19:30', '2013-10-11 19:19:55', '00:25'),
(1, 122, 3, '2013-10-14 21:27:16', '2013-10-14 21:27:48', '00:32'),
(1, 123, 9, '2013-10-19 17:34:19', '2013-10-19 17:34:47', '00:28'),
(1, 124, 4, '2013-10-19 18:45:25', '2013-10-19 18:46:09', '00:44'),
(1, 125, 4, '2013-10-19 19:33:43', '2013-10-19 19:34:16', '00:33'),
(2, 126, 0, '2013-10-20 14:25:45', '2013-10-20 14:28:13', '02:28'),
(2, 127, 4, '2013-10-20 14:40:00', '2013-10-20 14:40:13', '00:13'),
(2, 128, 3, '2013-10-20 18:12:49', '2013-10-20 18:13:01', '00:12'),
(2, 129, 3, '2013-10-20 18:21:51', '2013-10-20 18:22:05', '00:14'),
(2, 130, 1, '2013-10-20 18:22:39', '2013-10-20 18:22:50', '00:11'),
(2, 131, 1, '2013-10-20 18:35:44', '2013-10-20 18:36:07', '00:23'),
(2, 132, 4, '2013-10-20 18:36:27', '2013-10-20 18:36:41', '00:14'),
(2, 133, 2, '2013-10-20 19:10:47', '2013-10-20 19:11:11', '00:24'),
(2, 134, 0, '2013-10-20 19:13:01', '2013-10-20 19:13:19', '00:18'),
(2, 135, 3, '2013-10-20 19:16:21', '2013-10-20 19:16:33', '00:12'),
(2, 136, 2, '2013-10-20 19:18:09', '2013-10-20 19:18:19', '00:10'),
(2, 137, 2, '2013-10-20 19:25:54', '2013-10-20 19:26:10', '00:16'),
(2, 138, 0, '2013-10-20 19:27:05', '2013-10-20 19:27:17', '00:12'),
(2, 139, 4, '2013-10-20 19:33:06', '2013-10-20 19:33:19', '00:13'),
(2, 140, 2, '2013-10-20 19:34:07', '2013-10-20 19:34:19', '00:12'),
(2, 141, 2, '2013-10-20 19:35:39', '2013-10-20 19:35:50', '00:11'),
(2, 142, 2, '2013-10-20 19:40:57', '2013-10-20 19:41:07', '00:10'),
(2, 143, 3, '2013-10-20 19:42:36', '2013-10-20 19:42:48', '00:12'),
(2, 144, 2, '2013-10-20 22:16:22', '2013-10-20 22:16:33', '00:11'),
(1, 145, 3, '2013-10-20 22:17:36', '2013-10-20 22:18:08', '00:32'),
(2, 146, 2, '2013-10-24 21:39:48', '2013-10-24 21:41:12', '01:24'),
(2, 147, 2, '2013-10-24 21:43:07', '2013-10-24 21:43:19', '00:12'),
(2, 148, 1, '2013-10-24 21:46:11', '2013-10-24 21:46:24', '00:13'),
(2, 149, 2, '2013-10-24 21:47:00', '2013-10-24 21:47:14', '00:14'),
(2, 150, 0, '2013-10-25 21:14:55', '2013-10-25 21:15:05', '00:10'),
(2, 151, 3, '2013-10-27 08:32:48', '2013-10-27 08:33:00', '00:12'),
(2, 152, 2, '2013-10-27 19:22:57', '2013-10-27 19:23:07', '00:10'),
(2, 153, 2, '2013-10-27 22:47:41', '2013-10-27 22:47:54', '00:13'),
(1, 154, 5, '2013-10-28 09:09:05', '2013-10-28 09:09:51', '00:46'),
(2, 155, 1, '2013-10-28 10:21:41', '2013-10-28 10:22:03', '00:22'),
(2, 156, 2, '2013-10-28 11:35:11', '2013-10-28 11:35:25', '00:14'),
(2, 158, 3, '2013-10-28 13:10:10', '2013-10-28 13:10:22', '00:12');

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
('0gch747cdciif66a8mm5aem7g6', 1382871205, 'slim.flash|a:0:{}urlRedirect|s:7:"/admin/";'),
('3gjiphh9dmmb3j31chv0ukuba5', 1382965717, 'slim.flash|a:0:{}quizid|s:1:"2";score|i:0;correct|a:0:{}wrong|a:0:{}finished|s:2:"no";num|i:0;last|N;timetaken|N;starttime|N;urlRedirect|s:7:"/admin/";'),
('4fe4a4l5jn33n7pilfs5olc3m3', 1382961657, 'slim.flash|a:0:{}user|s:5:"Admin";quizid|s:1:"2";score|i:0;correct|a:0:{}wrong|a:0:{}finished|s:2:"no";num|i:0;last|N;timetaken|N;starttime|N;urlRedirect|s:7:"/admin/";'),
('5p03a00fpflpr0o1m8o1bqavb5', 1382961038, 'slim.flash|a:0:{}urlRedirect|s:7:"/admin/";'),
('7idpqljnr1naa9bjamn2q222h0', 1382737085, 'slim.flash|a:0:{}quizid|s:1:"2";score|i:0;correct|a:0:{}wrong|a:0:{}finished|s:2:"no";num|i:0;last|N;timetaken|N;starttime|N;'),
('96nfjt2l2uufoi5t00svc1m0l5', 1382960499, 'urlRedirect|s:7:"/admin/";slim.flash|a:0:{}'),
('a468tnh5nr20150hr96t434c50', 1382960663, 'slim.flash|a:0:{}urlRedirect|s:7:"/admin/";'),
('a5530vf7tuomuna65lu0k298v1', 1382738745, 'slim.flash|a:0:{}quizid|s:1:"2";score|i:0;correct|a:0:{}wrong|a:0:{}finished|s:2:"no";num|i:0;last|N;timetaken|N;starttime|N;urlRedirect|s:7:"/admin/";'),
('aovikgmsuue9ht12g0q914sn02', 1382467688, 'score|i:0;correct|a:0:{}wrong|a:0:{}finished|s:2:"no";num|i:0;last|N;timetaken|N;starttime|s:19:"2013-10-22 19:48:07";slim.flash|a:0:{}quizid|s:1:"2";user|s:6:"Anon63";'),
('bna73j5eh49b2goevfdjqitac5', 1382863917, 'slim.flash|a:0:{}urlRedirect|s:7:"/admin/";'),
('bnhbmkfljmfp3b5fk95knft302', 1382739311, 'slim.flash|a:0:{}quizid|s:1:"2";score|i:0;correct|a:0:{}wrong|a:0:{}finished|s:2:"no";num|i:0;last|N;timetaken|N;starttime|N;user|N;'),
('efi9i2h4sfb7a6rm20ues39s10', 1382914082, 'urlRedirect|s:7:"/admin/";slim.flash|a:0:{}'),
('fdmjesnk0uh9ppbgf8n5p5nm47', 1382737786, 'slim.flash|a:0:{}quizid|s:1:"2";score|i:0;correct|a:0:{}wrong|a:0:{}finished|s:2:"no";num|i:0;last|N;timetaken|N;starttime|N;urlRedirect|s:7:"/admin/";'),
('foe840019o1pbbp92cdbsbt2g4', 1382965840, 'urlRedirect|s:7:"/admin/";slim.flash|a:0:{}'),
('icdte240ul4a0nem82nfmj3pf7', 1382968833, 'slim.flash|a:0:{}adminuser|b:1;user|s:5:"Admin";'),
('nlfb5qi051ltgs8vqk3ot69t22', 1382738124, 'slim.flash|a:0:{}quizid|s:1:"2";score|i:0;correct|a:0:{}wrong|a:0:{}finished|s:2:"no";num|i:0;last|N;timetaken|N;starttime|N;'),
('nt3h2gc6hsr7gibbjom5qi4s54', 1382864056, 'slim.flash|a:0:{}user|s:11:"bob@bob.com";urlRedirect|s:7:"/admin/";'),
('prg3rbgip6g54j7ffc8u412ig1', 1382901152, 'urlRedirect|s:7:"/admin/";slim.flash|a:0:{}'),
('q648j0b671kaajerq1lf2jbc23', 1382888784, 'urlRedirect|s:7:"/admin/";slim.flash|a:0:{}'),
('s4r62ki9ql9qi9cpfa6bd2lep1', 1382961381, 'slim.flash|a:0:{}urlRedirect|s:7:"/admin/";'),
('u7mklo2c86hgd7q669rnlqrej4', 1382951649, 'last|N;slim.flash|a:0:{}urlRedirect|s:7:"/admin/";'),
('ug9jg5k1bah9agdoj3tnttgio0', 1382901795, 'slim.flash|a:0:{}urlRedirect|s:7:"/admin/";'),
('ve6is91t8ijifmmisdep6vqti0', 1382901181, 'slim.flash|a:0:{}urlRedirect|s:7:"/admin/";');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=159 ;

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
(158, 'cdwerr', '', '', 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
