-- phpMyAdmin SQL Dump
-- version 4.5.3.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 24, 2016 at 11:55 PM
-- Server version: 5.7.10
-- PHP Version: 5.6.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `miniurl`
--

-- --------------------------------------------------------

--
-- Table structure for table `cat_protocolo`
--

CREATE TABLE `cat_protocolo` (
  `clave` tinyint(3) UNSIGNED NOT NULL,
  `descripcion` varchar(20) NOT NULL,
  `html` varchar(20) DEFAULT NULL,
  `edo_reg` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cat_protocolo`
--

INSERT INTO `cat_protocolo` (`clave`, `descripcion`, `html`, `edo_reg`) VALUES
(1, 'HTTP', NULL, 1),
(2, 'HTTPS', NULL, 1),
(3, 'OTRO', NULL, 1),
(4, 'FTP', NULL, 1),
(5, 'GIT', NULL, 1),
(6, 'FTPS', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `enlaces`
--

CREATE TABLE `enlaces` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `cve_protocolo` tinyint(3) UNSIGNED NOT NULL,
  `url` varchar(200) NOT NULL,
  `hash` varchar(10) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `seLogea` tinyint(1) NOT NULL DEFAULT '0',
  `activo` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `enlaces`
--

INSERT INTO `enlaces` (`id`, `cve_protocolo`, `url`, `hash`, `created`, `seLogea`, `activo`) VALUES
(1, 1, 'yahoo.com', '873c87c7', '2016-02-18 20:18:58', 0, 1),
(3, 1, 'en.wikipedia.org/wiki', 'a1ff918b', '2016-02-19 01:20:35', 1, 1),
(4, 2, 'en.wikipedia.org/wiki', '4167eb86', '2016-02-19 01:45:23', 0, 1),
(6, 1, 'questionablecontent.net', '2ec8c9b4', '2016-02-19 05:42:16', 1, 1),
(7, 2, 'questionablecontent.net', '32ec7a85', '2016-02-19 05:45:28', 1, 1),
(8, 1, 'www.ingenieria.unam.mx', '2027a097', '2016-02-19 05:49:07', 1, 1),
(9, 1, 'techdows.com/2015/12/google-chrome-48-49-and-50-release-dates.html', 'd9afb26b', '2016-02-19 21:13:44', 1, 1),
(10, 1, 'advancesinap.collegeboard.org/stem/computer-science-principles', 'f77e3364', '2016-02-22 15:08:49', 1, 1),
(11, 2, 'www.yahoo.com', '99e8a2cb', '2016-02-23 18:32:49', 1, 1),
(12, 1, 'www.yahoo.com', 'c5f7ac7a', '2016-02-23 18:36:42', 1, 1),
(13, 1, 'www.unam.mx', '52b9e615', '2016-02-23 18:42:50', 1, 1),
(14, 1, 'yahoo.com.mx', '9e407a7c', '2016-02-24 00:45:02', 1, 1),
(17, 1, 'facebook.com', 'hfbc', '2016-02-24 05:33:58', 1, 1),
(18, 2, 'facebook.com', 'a023cfbf', '2016-02-24 05:46:47', 1, 1),
(19, 2, 'superchamba.com', '44a2100d', '2016-02-24 15:22:59', 1, 1),
(20, 1, 'superchamba.com', 'xixi', '2016-02-24 15:29:21', 1, 1),
(21, 1, 'www.superchamba.com', 'xoxi', '2016-02-24 15:29:57', 1, 1),
(22, 2, 'www.superchamba.com', 'xoxii', '2016-02-24 15:30:20', 1, 1),
(23, 1, 'en.wikipedia.org/wiki/Ã†thelberht_of_Kent', 'noLog1', '2016-02-24 16:35:14', 0, 1),
(24, 1, 'en.wikipedia.org/wiki/Kingdom_of_Kent', 'noLog2', '2016-02-24 16:36:13', 0, 1),
(25, 2, 'en.wikipedia.org/wiki/Tara_Air_Flight_193', 'conLog1', '2016-02-24 16:37:36', 1, 1),
(26, 5, 'github.com/legionmx/miniurl.git', 'd9d0f361', '2016-02-24 18:42:39', 0, 1),
(27, 4, 'test.rebex.net', '3d2c9e34', '2016-02-24 18:48:49', 1, 1),
(28, 6, 'test.rebex.net', '8e0f1f8e', '2016-02-24 18:50:00', 0, 1),
(29, 1, 'www.yahoo.com', '5d476288', '2016-02-24 19:12:37', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `visitas`
--

CREATE TABLE `visitas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ip` varchar(15) NOT NULL,
  `user_agent` varchar(200) DEFAULT NULL,
  `browser` varchar(50) DEFAULT NULL,
  `sisop` varchar(50) DEFAULT NULL,
  `id_enlace` bigint(20) UNSIGNED NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `visitas`
--

INSERT INTO `visitas` (`id`, `ip`, `user_agent`, `browser`, `sisop`, `id_enlace`, `fecha`) VALUES
(1, '127.0.0.1', NULL, NULL, NULL, 3, '2016-02-19 04:22:53'),
(4, '127.0.0.1', NULL, NULL, NULL, 6, '2016-02-19 05:42:52'),
(5, '127.0.0.1', NULL, NULL, NULL, 7, '2016-02-19 05:45:39'),
(6, '127.0.0.1', NULL, NULL, NULL, 6, '2016-02-19 05:46:25'),
(7, '127.0.0.1', NULL, NULL, NULL, 8, '2016-02-19 05:49:19'),
(8, '127.0.0.1', NULL, NULL, NULL, 3, '2016-02-19 14:38:37'),
(9, '127.0.0.1', NULL, NULL, NULL, 3, '2016-02-19 21:08:51'),
(10, '127.0.0.1', NULL, NULL, NULL, 9, '2016-02-19 21:14:08'),
(11, '127.0.0.1', NULL, NULL, NULL, 10, '2016-02-22 15:09:03'),
(12, '127.0.0.1', NULL, NULL, NULL, 10, '2016-02-22 15:09:22'),
(13, '127.0.0.1', NULL, NULL, NULL, 10, '2016-02-22 15:09:25'),
(14, '127.0.0.1', NULL, NULL, NULL, 10, '2016-02-22 15:09:29'),
(15, '127.0.0.1', NULL, NULL, NULL, 10, '2016-02-22 15:09:35'),
(16, '127.0.0.1', NULL, NULL, NULL, 11, '2016-02-23 18:33:15'),
(17, '127.0.0.1', NULL, NULL, NULL, 12, '2016-02-23 18:37:15'),
(18, '127.0.0.1', NULL, NULL, NULL, 17, '2016-02-24 05:34:13'),
(19, '127.0.0.1', NULL, NULL, NULL, 18, '2016-02-24 05:47:10'),
(20, '127.0.0.1', NULL, NULL, NULL, 19, '2016-02-24 15:23:15'),
(21, '127.0.0.1', NULL, NULL, NULL, 19, '2016-02-24 15:23:49'),
(22, '127.0.0.1', NULL, NULL, NULL, 20, '2016-02-24 15:29:33'),
(23, '127.0.0.1', NULL, NULL, NULL, 21, '2016-02-24 15:30:07'),
(24, '127.0.0.1', NULL, NULL, NULL, 22, '2016-02-24 15:30:29'),
(25, '127.0.0.1', NULL, NULL, NULL, 25, '2016-02-24 16:37:55'),
(26, '127.0.0.1', NULL, NULL, NULL, 27, '2016-02-24 18:49:02'),
(27, '127.0.0.1', NULL, NULL, NULL, 27, '2016-02-24 18:50:22'),
(28, '127.0.0.1', NULL, NULL, NULL, 29, '2016-02-19 19:13:11'),
(29, '127.0.0.1', NULL, NULL, NULL, 29, '2016-02-21 19:13:20'),
(30, '127.0.0.1', NULL, NULL, NULL, 29, '2016-02-21 19:13:28'),
(31, '127.0.0.1', NULL, NULL, NULL, 29, '2016-02-21 19:15:31'),
(32, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:44.0) Gecko/20100101 Firefox/44.0', NULL, NULL, 29, '2016-02-22 19:17:52'),
(33, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:44.0) Gecko/20100101 Firefox/44.0', NULL, NULL, 29, '2016-02-22 19:19:21'),
(34, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:44.0) Gecko/20100101 Firefox/44.0', NULL, NULL, 29, '2016-02-22 19:21:52'),
(35, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/49.0.2623.54 Safari/537.36', NULL, NULL, 29, '2016-02-22 19:23:46'),
(36, '127.0.0.1', NULL, NULL, NULL, 29, '2016-02-23 19:44:06'),
(37, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:44.0) Gecko/20100101 Firefox/44.0', 'Firefox', 'Win10', 29, '2016-02-24 20:08:57'),
(38, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/49.0.2623.54 Safari/537.36', 'Chrome', 'Win10', 29, '2016-02-24 20:10:35');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cat_protocolo`
--
ALTER TABLE `cat_protocolo`
  ADD PRIMARY KEY (`clave`);

--
-- Indexes for table `enlaces`
--
ALTER TABLE `enlaces`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD UNIQUE KEY `hash_uniq` (`hash`),
  ADD KEY `cve_protocolo` (`cve_protocolo`);

--
-- Indexes for table `visitas`
--
ALTER TABLE `visitas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cat_protocolo`
--
ALTER TABLE `cat_protocolo`
  MODIFY `clave` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `enlaces`
--
ALTER TABLE `enlaces`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
--
-- AUTO_INCREMENT for table `visitas`
--
ALTER TABLE `visitas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `enlaces`
--
ALTER TABLE `enlaces`
  ADD CONSTRAINT `fk_cve_prot` FOREIGN KEY (`cve_protocolo`) REFERENCES `cat_protocolo` (`clave`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
