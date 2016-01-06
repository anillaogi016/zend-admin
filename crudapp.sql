CREATE TABLE IF NOT EXISTS `zf_admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ;

--
-- Dumping data for table `zf_admin`
--

INSERT INTO `zf_admin` (`id`, `username`, `password`, `status`) VALUES
(1, 'admin', 'admin', 0);

-- --------------------------------------------------------

--
-- Table structure for table `zf_users`
--

CREATE TABLE IF NOT EXISTS `zf_users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(40) NOT NULL,
  `email` varchar(150) NOT NULL,
  `mobile` varchar(40) NOT NULL,
  `url` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=36 ;

--
-- Dumping data for table `zf_users`
--