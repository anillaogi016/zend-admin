-- phpMyAdmin SQL Dump
-- version 4.4.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 04, 2016 at 06:15 AM
-- Server version: 5.6.25
-- PHP Version: 5.5.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `zndemo`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE IF NOT EXISTS `admins` (
  `id` int(11) NOT NULL,
  `site_id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `site_id`, `username`, `email`, `password`) VALUES
(1, 1, 'Anil singh', 'anil@braintechnosys.biz', '21232f297a57a5a743894a0e4a801fc3');

-- --------------------------------------------------------

--
-- Table structure for table `album`
--

CREATE TABLE IF NOT EXISTS `album` (
  `id` int(11) NOT NULL,
  `artist` varchar(100) NOT NULL,
  `title` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `album`
--

INSERT INTO `album` (`id`, `artist`, `title`) VALUES
(1, 'The  Military  Wivessss', 'In  My  Dreams'),
(3, 'Bruce  Springsteen', 'Wrecking Ball (Deluxe)'),
(4, 'Lana  Del  Rey', 'Born  To  Die'),
(5, 'Gotye', 'Making  Mirrors'),
(6, 'anil singh', 'dgdfsg'),
(7, 'dgfgd', 'sadg');

-- --------------------------------------------------------

--
-- Table structure for table `albums`
--

CREATE TABLE IF NOT EXISTS `albums` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `mob` int(11) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `title` varchar(100) DEFAULT NULL,
  `short_description` varchar(200) DEFAULT NULL,
  `description` text,
  `image` varchar(200) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `albums`
--

INSERT INTO `albums` (`id`, `name`, `email`, `mob`, `address`, `title`, `short_description`, `description`, `image`, `user_id`) VALUES
(9, 'anil', 'anil@braintechnosys.biz', 2147483647, 'bulandshahr', 'Kelash khaur', 'hsgbisdfg sdifogsd fgiosdfg disfg dsoifgd sfiogs dfiogs dfigsd figsd fguods fguosdf guds fguods fgusdf guosdf gusodg sdfug dsufg sdf dfsg', '<p>dfghb sdifg sdfg dfog dsfig dfg sodgf sodgf ihosd gfousdfg bdifg osudfgo dfs gousdfg sdfg ousfdg ousdfgihosdfg sdufg su9dfg 9sdg ds9fg udsfg dsfg</p>\r\n', NULL, 0),
(10, 'lucky', 'lucky@gmail.com', 2147483647, 'aligarh', 'ddddddd', 'hlihyfdsghisd sdhfggbs sdjlhfg fdsog siodfg sdfiogsd bfignijdsfgs', '<p>sdhgpusdf sdfgnosd fgosd fgo9spdf gospdfg sfdg sdpfbg sdipgf dspifg dsfpg dfspig dsfpog dsfpgo dsfpgo sdfgosd fgopsd fgpds fgdsfg sopfdg sdfg sdfpgo sdfogdfsogp dsfgio</p>\r\n', 'images122.jpg', 0),
(11, 'sunil singh', 'sunil@gmail.com', 2147483647, 'aligarh', 'aligarh', 'aligarhaligarhaligarhaligarhaligarhaligarhaligarhaligarhaligarh aligarhaligarhaligarhaligarh', '<p>aligarhaligarhaligarh&nbsp;&nbsp; aligarhaligarhaligarhaligarh&nbsp;&nbsp; aligarhaligarhaligarhaligarh&nbsp;&nbsp; aligarhaligarhaligarhaligarh&nbsp;&nbsp; aligarhaligarhaligarh&nbsp; aligarhaligarhaligarh aligarhaligarhaligarh&nbsp; aligarhaligarhaligarh aligarhaligarhaligarh&nbsp; aligarhaligarh&nbsp; aligarhaligarhaligarh&nbsp; aligarhaligarh</p>\r\n', 'images1234.jpg', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `status` tinyint(2) NOT NULL DEFAULT '1'
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `status`) VALUES
(1, 'Audio', 1),
(2, 'video', 1),
(3, 'mp3', 1),
(4, 'mp4', 1),
(5, 'avi', 1),
(6, 'gfhjfhgj', 1),
(7, 'live video', 1),
(8, 'xfvbgsxdf', 1),
(9, 'fgdshbghbhsdfghdskhbg', 1),
(10, 'sdvzd', 1),
(11, 'sfgdhjndfgjhnjdfghjkdfghdfghdfgh', 1);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE IF NOT EXISTS `products` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `quantity`) VALUES
(14, 'product1', 100, 23),
(15, 'product2', 1000, 23),
(16, 'product11', 100, 2),
(17, 'product12', 234, 12),
(18, 'product14', 234, 23),
(19, 'product15', 112, 24),
(20, 'product5', 10000, 2),
(21, 'aaaaaa', 100, 2),
(22, 'ppppppfgdhd', 2567, 2),
(28, 'fasfas', 214234, 10000);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `first_name` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `mob` int(11) NOT NULL,
  `country` varchar(100) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`first_name`, `username`, `email`, `mob`, `country`, `id`) VALUES
('anil', 'anil', 'anil@gmail.com', 2147483647, 'fhsdgfgasdf', 1),
('sdfgsdf', 'sdfgsdf', 'dsfgsd', 3576435, 'dfghsdfh', 2),
('sgdsdf', 'sadfgasd', 'sadfasd', 0, 'sadfasd', 3),
('qwertewr', 'wqetrqwet', 'wqetrqwe', 0, 'weqrtqwe', 4);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD FULLTEXT KEY `username` (`username`);
ALTER TABLE `admins`
  ADD FULLTEXT KEY `email` (`email`);
ALTER TABLE `admins`
  ADD FULLTEXT KEY `password` (`password`);

--
-- Indexes for table `albums`
--
ALTER TABLE `albums`
  ADD PRIMARY KEY (`id`),
  ADD FULLTEXT KEY `name` (`name`);
ALTER TABLE `albums`
  ADD FULLTEXT KEY `email` (`email`);
ALTER TABLE `albums`
  ADD FULLTEXT KEY `address` (`address`);
ALTER TABLE `albums`
  ADD FULLTEXT KEY `title` (`title`);
ALTER TABLE `albums`
  ADD FULLTEXT KEY `short_description` (`short_description`);
ALTER TABLE `albums`
  ADD FULLTEXT KEY `description` (`description`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD FULLTEXT KEY `name` (`name`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD FULLTEXT KEY `name` (`name`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD FULLTEXT KEY `first_name` (`first_name`);
ALTER TABLE `users`
  ADD FULLTEXT KEY `username` (`username`);
ALTER TABLE `users`
  ADD FULLTEXT KEY `email` (`email`);
ALTER TABLE `users`
  ADD FULLTEXT KEY `country` (`country`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `albums`
--
ALTER TABLE `albums`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
