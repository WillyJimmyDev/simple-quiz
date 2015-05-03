-- phpMyAdmin SQL Dump
-- version 4.4.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 03, 2015 at 10:08 PM
-- Server version: 10.0.17-MariaDB-log
-- PHP Version: 5.6.8

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
  `id` int(11) NOT NULL,
  `question_num` int(11) unsigned NOT NULL,
  `quiz_id` int(11) unsigned NOT NULL,
  `text` varchar(255) NOT NULL,
  `correct` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=623 DEFAULT CHARSET=latin1;

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
(615, 3, 11, 'Edward G Robinson', 0),
(619, 2, 10, 'Eric Clapton', 1),
(620, 2, 10, 'Eric Banner', 0),
(621, 2, 10, 'Eric Cantona', 0),
(622, 2, 10, 'Eric Wimp', 0);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

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
  `id` int(10) unsigned NOT NULL,
  `num` int(11) unsigned NOT NULL,
  `quiz_id` int(11) unsigned NOT NULL,
  `text` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=latin1;

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
  `id` int(11) unsigned NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` varchar(255) NOT NULL,
  `category` int(11) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `quizzes`
--

INSERT INTO `quizzes` (`id`, `name`, `description`, `category`, `active`, `created`, `updated`) VALUES
(6, 'Movies R Us', 'Know your movie trivia? Prove it!', 2, 1, '2013-11-21 21:55:12', '2014-10-19 22:33:36'),
(8, 'Sporting Greats', 'Do you know these sporting legends?', 1, 1, '2014-01-27 19:40:52', '2014-05-23 23:24:02'),
(10, 'Band Members', 'Name the member of these famous bands', 6, 1, '2014-10-20 16:19:01', '2015-05-03 12:17:54'),
(11, 'Famous Scientists', 'Name These Pioneers Of Science', 5, 1, '2014-10-31 19:35:56', '2014-10-31 19:35:56');

-- --------------------------------------------------------

--
-- Table structure for table `quiz_users`
--

CREATE TABLE IF NOT EXISTS `quiz_users` (
  `id` int(10) unsigned NOT NULL,
  `quiz_id` int(11) unsigned NOT NULL,
  `user_id` int(11) unsigned NOT NULL,
  `score` int(11) NOT NULL,
  `start_time` datetime NOT NULL,
  `date_submitted` datetime NOT NULL,
  `time_taken` varchar(10) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=latin1;

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
(30, 11, 196, 3, '2014-10-31 19:42:15', '2014-10-31 19:42:32', '00:17'),
(31, 6, 194, 4, '2014-11-06 21:07:09', '2014-11-06 21:07:34', '25'),
(32, 11, 194, 1, '2015-04-25 17:38:46', '2015-04-25 17:39:00', '14'),
(33, 10, 228, 3, '2015-05-03 11:49:49', '2015-05-03 11:51:25', '96'),
(34, 6, 228, 6, '2015-05-03 22:03:05', '2015-05-03 22:03:43', '38');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE IF NOT EXISTS `sessions` (
  `id` varchar(32) NOT NULL,
  `access` int(10) unsigned DEFAULT NULL,
  `data` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `access`, `data`) VALUES
('0e8k4b8n024kjqvm9dbu7ta9n4', 1415307408, 'slim.flash|a:0:{}'),
('0iasdvlf9hkjf0lqqo9qd4gol7', 1430651958, 'slim.flash|a:0:{}quizid|s:1:"6";score|i:0;correct|a:0:{}wrong|a:0:{}finished|s:2:"no";num|i:0;last|N;timetaken|N;starttime|N;urlRedirect|s:13:"/quiz/process";'),
('1c4m0jstuh95eua9uegbeepul1', 1414774607, 'slim.flash|a:0:{}'),
('3j5k8821vk9l8lt5i5gduud1q0', 1430650358, 'slim.flash|a:0:{}'),
('68alrjp0oobq98v6bu2d5ep2t0', 1415825115, 'slim.flash|a:0:{}'),
('6dqk58kuuenq3uoksk690p3o72', 1415827082, 'slim.flash|a:0:{}'),
('7f5dluqrl2r1hrokthccd1g0c7', 1415826561, 'slim.flash|a:0:{}user|O:29:"SimpleQuiz\\Utils\\User\\EndUser":6:{s:38:"\0SimpleQuiz\\Utils\\User\\EndUser\0quizzes";N;s:32:"\0SimpleQuiz\\Utils\\Base\\User\0name";s:8:"Benjamin";s:33:"\0SimpleQuiz\\Utils\\Base\\User\0email";s:15:"ben@elanman.com";s:36:"\0SimpleQuiz\\Utils\\Base\\User\0password";s:60:"$2y$10$eraTuCnc5rMVHBbhs3mTM.RhkZD9gjYqOL8tkYT443buofhtbOLFS";s:30:"\0SimpleQuiz\\Utils\\Base\\User\0id";s:3:"216";s:35:"\0SimpleQuiz\\Utils\\Base\\User\0quizzes";N;}'),
('8pvaervpie64jl8vqmfq7ss006', 1415455615, 'slim.flash|a:0:{}'),
('a1lqobkl2embi0rtlm3bils196', 1415739514, 'slim.flash|a:0:{}'),
('bs4vqfl4bgojqrk4rfrigp50l2', 1416251261, 'slim.flash|a:0:{}'),
('bvfgpa0kpkd64des9tjskba512', 1415388573, 'slim.flash|a:0:{}'),
('cao1kfireuhiki649h9b5p3i43', 1429977604, 'slim.flash|a:0:{}quizid|s:1:"8";score|i:0;correct|a:0:{}wrong|a:0:{}finished|s:2:"no";num|i:0;last|N;timetaken|N;starttime|N;urlRedirect|s:13:"/quiz/process";'),
('d759vvg399lssqnr2j2nsqp1e2', 1430687271, 'slim.flash|a:0:{}quizid|s:2:"11";score|i:0;correct|a:0:{}wrong|a:0:{}finished|s:2:"no";num|i:0;last|N;timetaken|N;starttime|N;urlRedirect|s:13:"/quiz/process";'),
('f7n557mcs3u2576h93svrsmte0', 1414774675, 'slim.flash|a:0:{}'),
('fe17dosofmnj88od19qffumok5', 1415826861, 'slim.flash|a:0:{}'),
('g5o8a043dnuq0hke9b0n3e23m4', 1429980688, 'slim.flash|a:0:{}'),
('j32ukni1373ggve1iaqbr23475', 1430647022, 'slim.flash|a:0:{}quizid|s:1:"8";score|i:0;correct|a:0:{}wrong|a:0:{}finished|s:2:"no";num|i:0;last|N;timetaken|N;starttime|N;urlRedirect|s:13:"/quiz/process";'),
('jnq939iqqplidsm954s5tjrl32', 1414774562, 'quizid|s:2:"10";score|i:0;correct|a:0:{}wrong|a:0:{}finished|s:2:"no";num|i:0;last|N;timetaken|N;starttime|N;slim.flash|a:0:{}urlRedirect|s:13:"/quiz/process";'),
('kdk5raht5ogurk0ubiphqog634', 1429980183, 'slim.flash|a:0:{}'),
('l1md4usemoa973g91v2gj9u264', 1430651980, 'slim.flash|a:0:{}quizid|s:1:"8";score|i:0;correct|a:0:{}wrong|a:0:{}finished|s:2:"no";num|i:0;last|N;timetaken|N;starttime|N;urlRedirect|s:13:"/quiz/process";'),
('l67ampdp5qs7tn22su2q5l1271', 1415455708, 'slim.flash|a:0:{}'),
('ljuashlug3o4o6b8ma666udnf0', 1429983957, 'slim.flash|a:0:{}'),
('mpfpd9k0p9r97ct77s6bj2vot7', 1415386465, 'slim.flash|a:0:{}'),
('omup8j6s8jet7fb7l48ebhk9v5', 1414784443, 'slim.flash|a:0:{}quizid|s:2:"11";score|i:0;correct|a:0:{}wrong|a:0:{}finished|s:2:"no";num|i:0;last|N;timetaken|N;starttime|N;urlRedirect|s:13:"/quiz/process";'),
('p4mb9pdjs7phq107c57rr0rvm7', 1430650127, 'slim.flash|a:0:{}quizid|s:1:"6";score|i:0;correct|a:0:{}wrong|a:0:{}finished|s:2:"no";num|i:0;last|N;timetaken|N;starttime|N;urlRedirect|s:13:"/quiz/process";'),
('qgm1jjnv7ock4lsgodcv6d24d6', 1415456006, 'slim.flash|a:0:{}quizid|s:1:"8";score|i:0;correct|a:0:{}wrong|a:0:{}finished|s:2:"no";num|i:0;last|N;timetaken|N;starttime|N;urlRedirect|s:13:"/quiz/process";'),
('qslrrb7qhel2a3ku4knr9fk0h7', 1415456030, 'slim.flash|a:0:{}'),
('r24ll4bqk7h3f90iukounlsht0', 1415826740, 'slim.flash|a:0:{}'),
('s0h8c6ps98r0h7gcg7qii6r856', 1415387047, 'slim.flash|a:0:{}'),
('sr5nrl8vvfijm9ilst9n90dn66', 1429979738, 'slim.flash|a:0:{}quizid|s:1:"8";score|i:0;correct|a:0:{}wrong|a:0:{}finished|s:2:"no";num|i:0;last|N;timetaken|N;starttime|N;urlRedirect|s:13:"/quiz/process";'),
('sss8av9ijumsl9p9lrg5hf8nv2', 1430686965, 'slim.flash|a:0:{}quizid|s:1:"6";score|i:0;correct|a:0:{}wrong|a:0:{}finished|s:2:"no";num|i:0;last|N;timetaken|N;starttime|N;urlRedirect|s:13:"/quiz/process";'),
('tgohnb0bhrok34tfrnrslsnlf2', 1414784488, 'slim.flash|a:0:{}'),
('u7n2mmiok62fhu9c1cqrt3rvn0', 1430650172, 'slim.flash|a:0:{}quizid|s:1:"6";score|i:0;correct|a:0:{}wrong|a:0:{}finished|s:2:"no";num|i:0;last|N;timetaken|N;starttime|N;urlRedirect|s:13:"/quiz/process";'),
('vgjo044tjl4hita7k14omjrlt4', 1415455805, 'slim.flash|a:0:{}');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL,
  `name` varchar(60) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `email` varchar(40) NOT NULL,
  `level` int(1) NOT NULL DEFAULT '0',
  `confirmed` tinyint(4) NOT NULL DEFAULT '0',
  `confirmhash` varchar(40) DEFAULT NULL,
  `hashstamp` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=229 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `pass`, `email`, `level`, `confirmed`, `confirmhash`, `hashstamp`) VALUES
(157, 'Admin', '$2y$10$LK9O0BesGScRkDWPnpVP3uGVcN6JqB/xsuFTq/xQFpNjsx2DvTOl2', 'example@gmail.com', 1, 1, NULL, NULL),
(192, 'user1', '$2y$10$D2tpVb9i6GsPawn1H18tCu2s.2T9uHHWMQY7Osyeh12AzJsJ9Y5VO', 'examples@gmail.com', 0, 0, NULL, NULL),
(193, 'user2', '$2y$10$DOueZ880b4buKA2sm0a67OzZNSfv3ev7DT31tI53Moq1pGA9h/Dx6', 'example2@gmail.com', 0, 0, NULL, NULL),
(194, 'user3', '$2y$10$cUcIj1qyd1rWYE3vQTXW8emBx27Je9ZWcgNMDUnKN3a5n9kCED/S2', 'example@gmail.com1', 0, 0, NULL, NULL),
(195, 'user4', '$2y$10$n1Y3HJSwWxq0toQa8pQzb.kra1mfMySsaCsC/bH0/oE3oMNLM7GmO', 'example@gmail.com432432', 0, 0, NULL, NULL),
(196, 'user6', '$2y$10$B4ufMwQ9BzhGLVfY0CTBseqVIhSbRk1XQB8zu5LmOor9uAeLXeQIa', 'example4@gmail.com', 0, 0, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `answers`
--
ALTER TABLE `answers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `question_id` (`correct`),
  ADD KEY `quiz_id` (`quiz_id`),
  ADD KEY `quiz_question_num` (`question_num`,`quiz_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `quiz_id` (`quiz_id`),
  ADD KEY `num` (`num`),
  ADD KEY `num_2` (`num`,`quiz_id`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `quizzes`
--
ALTER TABLE `quizzes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `active` (`active`),
  ADD KEY `id` (`id`),
  ADD KEY `created` (`created`),
  ADD KEY `updated` (`updated`);

--
-- Indexes for table `quiz_users`
--
ALTER TABLE `quiz_users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `quiz_id` (`quiz_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `name` (`name`),
  ADD KEY `pass` (`pass`),
  ADD KEY `confirmed` (`confirmed`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `answers`
--
ALTER TABLE `answers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=623;
--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=48;
--
-- AUTO_INCREMENT for table `quizzes`
--
ALTER TABLE `quizzes`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `quiz_users`
--
ALTER TABLE `quiz_users`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=35;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=229;
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
