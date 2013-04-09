-- phpMyAdmin SQL Dump
-- version 3.4.11.1deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 09, 2013 at 07:34 PM
-- Server version: 5.5.29
-- PHP Version: 5.4.6-1ubuntu1.2

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
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
  `text` varchar(255) NOT NULL,
  `correct` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `question_id` (`question_id`,`correct`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=81 ;

--
-- Dumping data for table `answers`
--

INSERT INTO `answers` (`id`, `question_id`, `text`, `correct`) VALUES
(1, 1, 'File Transfer Protocol', 1),
(2, 1, 'Force Through Privately', 0),
(3, 1, 'File Through Protocol', 0),
(4, 1, 'File Test Protocol', 0),
(5, 2, 'Asynchronous JavaScript and XML', 1),
(6, 2, 'All JavaScript and XML', 0),
(7, 2, 'Alternative Java and XML', 0),
(8, 2, 'Actual JavaScript and XML', 0),
(9, 3, 'Really Simple Syndication', 1),
(10, 3, 'Really Simple Scripting', 0),
(11, 3, 'Ready-Styled Scripting', 0),
(12, 3, 'Really Stupid Syndication', 0),
(13, 4, 'Cross-site Scripting', 1),
(14, 4, 'Cross-site Security', 0),
(15, 4, 'Cleverly Structured Scripting', 0),
(16, 4, 'eXtremely Safe and Secure', 0),
(17, 5, 'PHP: Hypertext Preprocessor', 1),
(18, 5, 'Post Hypertext Processor', 0),
(19, 5, 'Practical HTML Processing', 0),
(20, 5, 'Process HTML Prettily', 0),
(21, 6, 'World Wide Web Consortium', 1),
(22, 6, 'World Wide Web Committee', 0),
(23, 6, 'World Wide Web Creatives', 0),
(24, 6, 'Wakefield Willy Wavers Club', 0),
(25, 7, 'eXtensible Markup Language', 1),
(26, 7, 'eXtendable Markup Language', 0),
(27, 7, 'Crossover Markup Language', 0),
(28, 7, 'eXtreme Markup Language', 0),
(29, 8, 'Yahoo User Interface', 1),
(30, 8, 'Yahoo''s Useful Idea', 0),
(31, 8, 'Yahoo Utility Interface', 0),
(32, 8, 'Yahoo User Interaction', 0),
(33, 9, 'Hypertext Markup Language', 1),
(34, 9, 'Human Markup Language', 0),
(35, 9, 'Helpful Markup Language', 0),
(36, 9, 'Hypertext Memory Language', 0),
(37, 10, 'Common Gateway Interface', 1),
(38, 10, 'Common or Garden Interaction', 0),
(39, 10, 'Computer''s Graphical Intelligence', 0),
(40, 10, 'Common Graphical Interface', 0),
(41, 11, 'Secure Sockets Layer', 1),
(42, 11, 'Server Security Layer', 0),
(43, 11, 'Server Security Level', 0),
(44, 11, 'Secret Socket Layer', 0),
(45, 12, 'Structured Query Language', 1),
(46, 12, 'Stupid Query Language', 0),
(47, 12, 'Secure Query Language', 0),
(48, 12, 'Strict Query Language', 0),
(49, 13, 'Hypertext Transfer Protocol', 1),
(50, 13, 'Hypertext Traffic Protocol', 0),
(51, 13, 'HTML Traffic Transfer Protocol', 0),
(52, 13, 'HTML Through Traffic Protocol', 0),
(53, 14, 'Cascading Style Sheets', 1),
(54, 14, 'Custom Style Sheets', 0),
(55, 14, 'Clientside Style Sheets', 0),
(56, 14, 'Calculated Style Sheets', 0),
(57, 15, 'Simple Object Access Protocol', 1),
(58, 15, 'Structured Object Access Protocol', 0),
(59, 15, 'Simple, Objective And Private', 0),
(60, 15, 'Simply Obvious Access Principle', 0),
(61, 16, 'Web Accessibility Initiative', 1),
(62, 16, 'World Wide Accessibility Intiative', 0),
(63, 16, 'World Wide Accessibility Incorporation', 0),
(64, 16, 'Web Accessibility and Inclusion', 0),
(65, 17, 'Server-Side Include', 1),
(66, 17, 'Server-Side Intelligence', 0),
(67, 17, 'Scripted Server Include', 0),
(68, 17, 'Secure Server Include', 0),
(69, 18, 'JavaScript Object Notation', 1),
(70, 18, 'JQuery-Scripting Object Notation', 0),
(71, 18, 'Just Simple Object Notation', 0),
(72, 18, 'JavaScript Over the Net', 0),
(73, 19, 'eXtensible Stylesheet Language Transformation', 1),
(74, 19, 'eXpandable Stylesheet Language Transfer', 0),
(75, 19, 'eXtensible Stylesheet Language Transfer', 0),
(76, 19, 'eXtendable Stylesheet Language Transformation', 0),
(77, 20, 'Web Content Accessibility Guidelines', 1),
(78, 20, 'Wakefield Community Action Group', 0),
(79, 20, 'Web Criteria And Guidelines', 0),
(80, 20, 'World-wide Common Access Group', 0);

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE IF NOT EXISTS `questions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `text` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `text`) VALUES
(1, 'FTP'),
(2, 'AJAX'),
(3, 'RSS'),
(4, 'XSS'),
(5, 'PHP'),
(6, 'W3C'),
(7, 'XML'),
(8, 'YUI'),
(9, 'HTML'),
(10, 'CGI'),
(11, 'SSL'),
(12, 'SQL'),
(13, 'HTTP'),
(14, 'CSS'),
(15, 'SOAP'),
(16, 'WAI'),
(17, 'SSI'),
(18, 'JSON'),
(19, 'XSLT'),
(20, 'WCAG');

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


-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(60) NOT NULL,
  `score` int(11) NOT NULL,
  `date_submitted` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `name` (`name`,`score`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
