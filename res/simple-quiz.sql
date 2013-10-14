-- phpMyAdmin SQL Dump
-- version 4.0.7
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 14, 2013 at 08:24 PM
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
  `quiz_id` int(11) NOT NULL,
  `text` varchar(255) NOT NULL,
  `correct` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `question_id` (`question_id`,`correct`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=81 ;

--
-- Dumping data for table `answers`
--

INSERT INTO `answers` (`id`, `question_id`, `quiz_id`, `text`, `correct`) VALUES
(1, 1, 1, 'File Transfer Protocol', 1),
(2, 1, 1, 'Force Through Privately', 0),
(3, 1, 1, 'File Through Protocol', 0),
(4, 1, 1, 'File Test Protocol', 0),
(5, 2, 1, 'Asynchronous JavaScript and XML', 1),
(6, 2, 1, 'All JavaScript and XML', 0),
(7, 2, 1, 'Alternative Java and XML', 0),
(8, 2, 1, 'Actual JavaScript and XML', 0),
(9, 3, 1, 'Really Simple Syndication', 1),
(10, 3, 1, 'Really Simple Scripting', 0),
(11, 3, 1, 'Ready-Styled Scripting', 0),
(12, 3, 1, 'Really Stupid Syndication', 0),
(13, 4, 1, 'Cross-site Scripting', 1),
(14, 4, 1, 'Cross-site Security', 0),
(15, 4, 1, 'Cleverly Structured Scripting', 0),
(16, 4, 1, 'eXtremely Safe and Secure', 0),
(17, 5, 1, 'PHP: Hypertext Preprocessor', 1),
(18, 5, 1, 'Post Hypertext Processor', 0),
(19, 5, 1, 'Practical HTML Processing', 0),
(20, 5, 1, 'Process HTML Prettily', 0),
(21, 6, 1, 'World Wide Web Consortium', 1),
(22, 6, 1, 'World Wide Web Committee', 0),
(23, 6, 1, 'World Wide Web Creatives', 0),
(24, 6, 1, 'Wakefield Willy Wavers Club', 0),
(25, 7, 1, 'eXtensible Markup Language', 1),
(26, 7, 1, 'eXtendable Markup Language', 0),
(27, 7, 1, 'Crossover Markup Language', 0),
(28, 7, 1, 'eXtreme Markup Language', 0),
(29, 8, 1, 'Yahoo User Interface', 1),
(30, 8, 1, 'Yahoo''s Useful Idea', 0),
(31, 8, 1, 'Yahoo Utility Interface', 0),
(32, 8, 1, 'Yahoo User Interaction', 0),
(33, 9, 1, 'Hypertext Markup Language', 1),
(34, 9, 1, 'Human Markup Language', 0),
(35, 9, 1, 'Helpful Markup Language', 0),
(36, 9, 1, 'Hypertext Memory Language', 0),
(37, 10, 1, 'Common Gateway Interface', 1),
(38, 10, 1, 'Common or Garden Interaction', 0),
(39, 10, 1, 'Computer''s Graphical Intelligence', 0),
(40, 10, 1, 'Common Graphical Interface', 0),
(41, 11, 1, 'Secure Sockets Layer', 1),
(42, 11, 1, 'Server Security Layer', 0),
(43, 11, 1, 'Server Security Level', 0),
(44, 11, 1, 'Secret Socket Layer', 0),
(45, 12, 1, 'Structured Query Language', 1),
(46, 12, 1, 'Stupid Query Language', 0),
(47, 12, 1, 'Secure Query Language', 0),
(48, 12, 1, 'Strict Query Language', 0),
(49, 13, 1, 'Hypertext Transfer Protocol', 1),
(50, 13, 1, 'Hypertext Traffic Protocol', 0),
(51, 13, 1, 'HTML Traffic Transfer Protocol', 0),
(52, 13, 1, 'HTML Through Traffic Protocol', 0),
(53, 14, 1, 'Cascading Style Sheets', 1),
(54, 14, 1, 'Custom Style Sheets', 0),
(55, 14, 1, 'Clientside Style Sheets', 0),
(56, 14, 1, 'Calculated Style Sheets', 0),
(57, 15, 1, 'Simple Object Access Protocol', 1),
(58, 15, 1, 'Structured Object Access Protocol', 0),
(59, 15, 1, 'Simple, Objective And Private', 0),
(60, 15, 1, 'Simply Obvious Access Principle', 0),
(61, 16, 1, 'Web Accessibility Initiative', 1),
(62, 16, 1, 'World Wide Accessibility Intiative', 0),
(63, 16, 1, 'World Wide Accessibility Incorporation', 0),
(64, 16, 1, 'Web Accessibility and Inclusion', 0),
(65, 17, 1, 'Server-Side Include', 1),
(66, 17, 1, 'Server-Side Intelligence', 0),
(67, 17, 1, 'Scripted Server Include', 0),
(68, 17, 1, 'Secure Server Include', 0),
(69, 18, 1, 'JavaScript Object Notation', 1),
(70, 18, 1, 'JQuery-Scripting Object Notation', 0),
(71, 18, 1, 'Just Simple Object Notation', 0),
(72, 18, 1, 'JavaScript Over the Net', 0),
(73, 19, 1, 'eXtensible Stylesheet Language Transformation', 1),
(74, 19, 1, 'eXpandable Stylesheet Language Transfer', 0),
(75, 19, 1, 'eXtensible Stylesheet Language Transfer', 0),
(76, 19, 1, 'eXtendable Stylesheet Language Transformation', 0),
(77, 20, 1, 'Web Content Accessibility Guidelines', 1),
(78, 20, 1, 'Wakefield Community Action Group', 0),
(79, 20, 1, 'Web Criteria And Guidelines', 0),
(80, 20, 1, 'World-wide Common Access Group', 0);

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE IF NOT EXISTS `questions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `quiz_id` int(11) NOT NULL,
  `text` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `quiz_id` (`quiz_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `quiz_id`, `text`) VALUES
(1, 1, 'FTP'),
(2, 1, 'AJAX'),
(3, 1, 'RSS'),
(4, 1, 'XSS'),
(5, 1, 'PHP'),
(6, 1, 'W3C'),
(7, 1, 'XML'),
(8, 1, 'YUI'),
(9, 1, 'HTML'),
(10, 1, 'CGI'),
(11, 1, 'SSL'),
(12, 1, 'SQL'),
(13, 1, 'HTTP'),
(14, 1, 'CSS'),
(15, 1, 'SOAP'),
(16, 1, 'WAI'),
(17, 1, 'SSI'),
(18, 1, 'JSON'),
(19, 1, 'XSLT'),
(20, 1, 'WCAG');

-- --------------------------------------------------------

--
-- Table structure for table `quizzes`
--

CREATE TABLE IF NOT EXISTS `quizzes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `description` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `quizzes`
--

INSERT INTO `quizzes` (`id`, `name`, `description`) VALUES
(1, 'Web Acronyms', 'XML? HTTP? SOAP? How well do you know your web acronyms? Probably not as well as you think!');

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
('2tp02bfiimm41qtvmu2rg7tn15', 1380053724, 'score|i:2;correct|a:2:{i:0;s:22:"File Transfer Protocol";i:1;s:31:"Asynchronous JavaScript and XML";}wrong|a:0:{}finished|s:2:"no";num|i:3;user|s:7:"Anon399";'),
('58t2lcfn55ubikb0qqgfl420a1', 1381572322, 'last|N;slim.flash|a:0:{}score|i:0;correct|a:0:{}wrong|a:0:{}finished|s:2:"no";num|i:0;timetaken|N;starttime|N;'),
('6mm9c32hd3s2ef5lt65lj8hnj5', 1370288764, 'score|i:0;correct|a:0:{}wrong|a:0:{}finished|s:2:"no";num|i:0;quizid|i:1;'),
('8q1djleshtuhtaa7t6eom99n64', 1376341451, 'score|i:0;correct|a:0:{}wrong|a:0:{}finished|s:2:"no";num|i:0;'),
('9eujq2tl6vajsupbtjsugnk9p6', 1369170017, 'score|i:0;correct|a:0:{}wrong|a:0:{}finished|s:2:"no";num|i:0;quizid|i:1;'),
('cq364hu8khsvl6sbhrqjsl20g5', 1366314765, 'score|i:0;correct|a:0:{}wrong|a:0:{}finished|s:2:"no";num|i:0;user|s:6:"bjbtgy";'),
('d8ldntaea4oa50a8jg93u4j4d5', 1368565252, ''),
('dvjkbtdftk8tvt1e1j44v0ctf6', 1370980724, 'score|i:0;correct|a:0:{}wrong|a:0:{}finished|s:2:"no";num|i:0;quizid|i:1;'),
('eoqq5cht4k0cchih5mikcrski5', 1368222213, 'last|N;'),
('j7silp5aleo90s7mcbvvvdbj92', 1379786334, 'score|i:0;correct|a:0:{}wrong|a:0:{}finished|s:2:"no";num|i:0;');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=122 ;

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
(10, 1, 'Anon400', 4, '0000-00-00 00:00:00', '2013-04-18 19:12:13', '');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;