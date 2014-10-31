-- phpMyAdmin SQL Dump
-- version 3.4.11.1deb2+deb7u1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 31, 2014 at 07:45 PM
-- Server version: 5.5.40
-- PHP Version: 5.4.4-14+deb7u14

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
  `question_num` int(11) unsigned NOT NULL,
  `quiz_id` int(11) unsigned NOT NULL,
  `text` varchar(255) NOT NULL,
  `correct` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `question_id` (`correct`),
  KEY `quiz_id` (`quiz_id`),
  KEY `quiz_question_num` (`question_num`,`quiz_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=616 ;

--
-- Dumping data for table `answers`
--

INSERT INTO `answers` (`id`, `question_num`, `quiz_id`, `text`, `correct`) VALUES
(441, 3, 6, 'Norman Bates', 1),
(442, 3, 6, 'Norman Tebbit', 0),
(443, 3, 6, 'Norman Wisdom', 0),
(444, 3, 6, 'Norman Cooke', 0),
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
(459, 2, 6, 'Christopher Hall', 0),
(460, 7, 6, 'Jeff Daniels', 1),
(461, 7, 6, 'Jeff Goldblum', 0),
(462, 7, 6, 'Jeff Bridges', 0),
(463, 7, 6, 'Jeff Branson', 0),
(536, 1, 6, 'Tom Hanks', 1),
(537, 1, 6, 'Bob Hoskins', 0),
(538, 1, 6, 'Robert De Niro', 0),
(539, 1, 6, 'Marlon Brando', 0),
(549, 1, 10, 'Freddie', 1),
(550, 1, 10, 'Bob', 0),
(551, 1, 10, 'Jimmy', 0),
(552, 1, 10, 'Richard', 0),
(562, 2, 10, 'Eric Clapton', 1),
(563, 2, 10, 'Eric Banner', 0),
(564, 2, 10, 'Eric Cantona', 0),
(565, 2, 10, 'Eric Clapton', 1),
(566, 2, 10, 'Eric Banner', 0),
(567, 2, 10, 'Eric Cantona', 0),
(568, 3, 10, 'George Michael', 1),
(569, 3, 10, 'George Bernard Shaw', 0),
(570, 4, 10, 'Frank Beard', 1),
(571, 4, 10, 'Frank Nobeard', 0),
(587, 4, 6, 'Stan and Oliver', 1),
(588, 4, 6, 'Stan and Groucho', 0),
(589, 4, 6, 'Bob and Billy', 0),
(590, 1, 8, 'Muhammad Ali', 1),
(591, 1, 8, 'Samuel L Jackson', 0),
(592, 1, 8, 'Nigel Manson', 0),
(593, 2, 8, 'Botham', 1),
(594, 2, 8, 'Beckham', 0),
(595, 2, 8, 'Beardsley', 0),
(596, 3, 8, 'Best', 1),
(597, 3, 8, 'Of The Jungle', 0),
(598, 3, 8, '''Dubya'' Bush', 0),
(601, 4, 8, 'Juggling', 1),
(602, 4, 8, 'Football', 0),
(603, 4, 8, 'Downhill Skiing', 0),
(607, 1, 11, 'Alexander Graham Bell', 1),
(608, 1, 11, 'Barry Manilow', 0),
(609, 1, 11, 'Albert Einstein', 0),
(610, 2, 11, 'Albert Einstein', 1),
(611, 2, 11, 'David Beckham', 0),
(612, 2, 11, 'Samuel Johnson', 0),
(613, 3, 11, 'Edward Jenner', 1),
(614, 3, 11, 'Edward Scissorhands', 0),
(615, 3, 11, 'Edward G Robinson', 0);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=48 ;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `num`, `quiz_id`, `text`) VALUES
(15, 1, 6, 'Who played Forrest Gump?'),
(16, 2, 6, 'Who played the lead role in Taxi Driver?'),
(17, 3, 6, 'What was the name of the killer in Psycho?'),
(18, 4, 6, 'What were the first names of Laurel And Hardy?'),
(19, 5, 6, 'Who played ''Red'' in The Shawshank Redemption?'),
(20, 6, 6, 'How many films were there in the ''Alien'' series?'),
(21, 7, 6, 'Who starred in ''Chasing Sleep'' from 2000'),
(23, 1, 8, 'Famous Boxer'),
(24, 2, 8, 'Famous cricketer'),
(32, 1, 10, 'Lead singer of the band Queen'),
(40, 2, 10, 'A member of Cream'),
(41, 3, 10, 'Singer in Wham!'),
(42, 4, 10, 'Drummer In ZZ Top'),
(43, 3, 8, 'Footballer, George ...'),
(44, 4, 8, 'Not An Olympic Event'),
(45, 1, 11, 'Invented The Telephone'),
(46, 2, 11, 'Known For e=mc2'),
(47, 3, 11, 'Pioneer Of The Smallpox Vaccination');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `quizzes`
--

INSERT INTO `quizzes` (`id`, `name`, `description`, `category`, `active`, `created`, `updated`) VALUES
(6, 'Movies R Us', 'Know your movie trivia? Prove it!', 2, 1, '2013-11-21 21:55:12', '2014-10-19 22:33:36'),
(8, 'Sporting Greats', 'Do you know these sporting legends?', 1, 1, '2014-01-27 19:40:52', '2014-05-23 23:24:02'),
(10, 'Band Members', 'Name the member of these famous bands', 6, 1, '2014-10-20 17:19:01', '2014-10-31 19:24:24'),
(11, 'Famous Scientists', 'Name These Pioneers Of Science', 5, 1, '2014-10-31 19:35:56', '2014-10-31 19:35:56');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=31 ;

--
-- Dumping data for table `quiz_users`
--

INSERT INTO `quiz_users` (`id`, `quiz_id`, `user_id`, `score`, `start_time`, `date_submitted`, `time_taken`) VALUES
(23, 6, 193, 3, '2014-10-30 20:35:46', '2014-10-30 20:36:14', '00:28'),
(24, 8, 194, 2, '2014-10-30 21:29:44', '2014-10-30 21:29:52', '00:08'),
(26, 6, 192, 3, '2014-10-31 07:54:37', '2014-10-31 07:57:16', '02:39'),
(27, 8, 192, 2, '2014-10-31 07:58:50', '2014-10-31 07:59:02', '00:12'),
(28, 10, 192, 1, '2014-10-31 08:40:57', '2014-10-31 08:41:04', '00:07'),
(29, 10, 194, 2, '2014-10-31 08:43:18', '2014-10-31 08:43:24', '00:06'),
(30, 11, 196, 3, '2014-10-31 19:42:15', '2014-10-31 19:42:32', '00:17');

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
('0e8k4b8n024kjqvm9dbu7ta9n4', 1414784572, 'slim.flash|a:0:{}'),
('1c4m0jstuh95eua9uegbeepul1', 1414774607, 'slim.flash|a:0:{}'),
('f7n557mcs3u2576h93svrsmte0', 1414774675, 'slim.flash|a:0:{}'),
('jnq939iqqplidsm954s5tjrl32', 1414774562, 'quizid|s:2:"10";score|i:0;correct|a:0:{}wrong|a:0:{}finished|s:2:"no";num|i:0;last|N;timetaken|N;starttime|N;slim.flash|a:0:{}urlRedirect|s:13:"/quiz/process";'),
('omup8j6s8jet7fb7l48ebhk9v5', 1414784443, 'slim.flash|a:0:{}quizid|s:2:"11";score|i:0;correct|a:0:{}wrong|a:0:{}finished|s:2:"no";num|i:0;last|N;timetaken|N;starttime|N;urlRedirect|s:13:"/quiz/process";'),
('tgohnb0bhrok34tfrnrslsnlf2', 1414784488, 'slim.flash|a:0:{}');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(60) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `email` varchar(40) NOT NULL,
  `level` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `name` (`name`),
  KEY `pass` (`pass`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=197 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `pass`, `email`, `level`) VALUES
(157, 'Admin', '$2y$10$LK9O0BesGScRkDWPnpVP3uGVcN6JqB/xsuFTq/xQFpNjsx2DvTOl2', 'example@gmail.com', 1),
(192, 'user1', '$2y$10$D2tpVb9i6GsPawn1H18tCu2s.2T9uHHWMQY7Osyeh12AzJsJ9Y5VO', 'examples@gmail.com', 0),
(193, 'user2', '$2y$10$DOueZ880b4buKA2sm0a67OzZNSfv3ev7DT31tI53Moq1pGA9h/Dx6', 'example2@gmail.com', 0),
(194, 'user3', '$2y$10$cUcIj1qyd1rWYE3vQTXW8emBx27Je9ZWcgNMDUnKN3a5n9kCED/S2', 'example@gmail.com1', 0),
(195, 'user4', '$2y$10$n1Y3HJSwWxq0toQa8pQzb.kra1mfMySsaCsC/bH0/oE3oMNLM7GmO', 'example@gmail.com432432', 0),
(196, 'user6', '$2y$10$B4ufMwQ9BzhGLVfY0CTBseqVIhSbRk1XQB8zu5LmOor9uAeLXeQIa', 'example4@gmail.com', 0);

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
