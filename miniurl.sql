-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 23, 2016 at 04:03 PM
-- Server version: 10.1.10-MariaDB
-- PHP Version: 5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `miniurl`
--
CREATE DATABASE IF NOT EXISTS `miniurl` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `miniurl`;

-- --------------------------------------------------------

--
-- Table structure for table `cat_categories`
--

CREATE TABLE `cat_categories` (
  `id_category` smallint(5) UNSIGNED NOT NULL,
  `category` varchar(600) NOT NULL,
  `id_user` int(11) NOT NULL,
  `active` int(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cat_categories`
--

INSERT INTO `cat_categories` (`id_category`, `category`, `id_user`, `active`) VALUES
(1, 'Upload Test 1', 1, 1),
(2, 'Prueba 1', 1, 1),
(3, 'BetoUploads', 24, 1),
(4, 'Direct test', 1, 1),
(127, 'Direct test2', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `cat_permiso`
--

CREATE TABLE `cat_permiso` (
  `clave` smallint(5) UNSIGNED NOT NULL,
  `descripcion` varchar(50) NOT NULL,
  `abrev` varchar(10) NOT NULL,
  `edo_reg` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cat_permiso`
--

INSERT INTO `cat_permiso` (`clave`, `descripcion`, `abrev`, `edo_reg`) VALUES
(1, 'Permiso de usuario superprivilegiado', 'prm_root', 1),
(2, 'Crear mURLs con estadisticas', 'crLogStat', 1),
(3, 'Puede ver estadisticas propias', 'vwOwnStats', 1),
(4, 'Puede hacer cargas masivas de URLs', 'ulMassUrls', 1),
(5, 'Puede descargar lotes de mURLs', 'dlMassUrls', 1),
(6, 'Puede ver estadísticas propias y ajenas', 'vwAllStats', 1);

-- --------------------------------------------------------

--
-- Table structure for table `cat_protocolo`
--

CREATE TABLE `cat_protocolo` (
  `clave` smallint(5) UNSIGNED NOT NULL,
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
(5, 'GIT', NULL, 0),
(6, 'FTPS', NULL, 1),
(7, '', NULL, 1),
(8, 'asd', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `enlaces`
--

CREATE TABLE `enlaces` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_user` smallint(5) UNSIGNED DEFAULT NULL COMMENT 'id of user, if one was authenticated',
  `cve_protocolo` smallint(5) UNSIGNED NOT NULL,
  `url` varchar(200) NOT NULL,
  `hash` varchar(255) NOT NULL,
  `code` varchar(600) DEFAULT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `seLogea` tinyint(1) NOT NULL DEFAULT '0',
  `activo` tinyint(1) NOT NULL DEFAULT '1',
  `id_category` varchar(200) DEFAULT NULL,
  `mini_url` varchar(600) DEFAULT NULL,
  `time_stamp` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `enlaces`
--

INSERT INTO `enlaces` (`id`, `id_user`, `cve_protocolo`, `url`, `hash`, `code`, `created`, `seLogea`, `activo`, `id_category`, `mini_url`, `time_stamp`) VALUES
(1, NULL, 1, 'yahoo.com', '873c87c7', NULL, '2016-02-18 20:18:58', 0, 1, NULL, NULL, NULL),
(3, NULL, 1, 'en.wikipedia.org/wiki', 'a1ff918b', NULL, '2016-02-19 01:20:35', 1, 1, NULL, NULL, NULL),
(4, NULL, 2, 'en.wikipedia.org/wiki', '4167eb86', NULL, '2016-02-19 01:45:23', 0, 1, NULL, NULL, NULL),
(6, NULL, 1, 'questionablecontent.net', '2ec8c9b4', NULL, '2016-02-19 05:42:16', 1, 1, NULL, NULL, NULL),
(7, NULL, 2, 'questionablecontent.net', '32ec7a85', NULL, '2016-02-19 05:45:28', 1, 1, NULL, NULL, NULL),
(8, NULL, 1, 'www.ingenieria.unam.mx', '2027a097', NULL, '2016-02-19 05:49:07', 1, 1, NULL, NULL, NULL),
(9, NULL, 1, 'techdows.com/2015/12/google-chrome-48-49-and-50-release-dates.html', 'd9afb26b', NULL, '2016-02-19 21:13:44', 1, 1, NULL, NULL, NULL),
(10, NULL, 1, 'advancesinap.collegeboard.org/stem/computer-science-principles', 'f77e3364', NULL, '2016-02-22 15:08:49', 1, 1, NULL, NULL, NULL),
(11, NULL, 2, 'www.yahoo.com', '99e8a2cb', NULL, '2016-02-23 18:32:49', 1, 1, NULL, NULL, NULL),
(12, NULL, 1, 'www.yahoo.com', 'c5f7ac7a', NULL, '2016-02-23 18:36:42', 1, 1, NULL, NULL, NULL),
(13, NULL, 1, 'www.unam.mx', '52b9e615', NULL, '2016-02-23 18:42:50', 1, 1, NULL, NULL, NULL),
(14, NULL, 1, 'yahoo.com.mx', '9e407a7c', NULL, '2016-02-24 00:45:02', 1, 1, NULL, NULL, NULL),
(17, NULL, 1, 'facebook.com', 'hfbc', NULL, '2016-02-24 05:33:58', 1, 1, NULL, NULL, NULL),
(18, NULL, 2, 'facebook.com', 'a023cfbf', NULL, '2016-02-24 05:46:47', 1, 1, NULL, NULL, NULL),
(19, NULL, 2, 'superchamba.com', '44a2100d', NULL, '2016-02-24 15:22:59', 1, 1, NULL, NULL, NULL),
(20, NULL, 1, 'superchamba.com', 'xixi', NULL, '2016-02-24 15:29:21', 1, 1, NULL, NULL, NULL),
(21, NULL, 1, 'www.superchamba.com', 'xoxi', NULL, '2016-02-24 15:29:57', 1, 1, NULL, NULL, NULL),
(22, NULL, 2, 'www.superchamba.com', 'xoxii', NULL, '2016-02-24 15:30:20', 1, 1, NULL, NULL, NULL),
(23, NULL, 1, 'en.wikipedia.org/wiki/Ã†thelberht_of_Kent', 'noLog1', NULL, '2016-02-24 16:35:14', 0, 1, NULL, NULL, NULL),
(24, NULL, 1, 'en.wikipedia.org/wiki/Kingdom_of_Kent', 'noLog2', NULL, '2016-02-24 16:36:13', 0, 1, NULL, NULL, NULL),
(25, 1, 2, 'en.wikipedia.org/wiki/Tara_Air_Flight_193', 'conLog1', NULL, '2016-02-24 16:37:36', 1, 1, NULL, NULL, NULL),
(26, NULL, 5, 'github.com/legionmx/miniurl.git', 'd9d0f361', NULL, '2016-02-24 18:42:39', 0, 1, NULL, NULL, NULL),
(27, 1, 4, 'test.rebex.net', '3d2c9e34', NULL, '2016-02-24 18:48:49', 1, 1, NULL, NULL, NULL),
(28, NULL, 6, 'test.rebex.net', '8e0f1f8e', NULL, '2016-02-24 18:50:00', 0, 1, NULL, NULL, NULL),
(29, 1, 1, 'www.yahoo.com', '5d476288', NULL, '2016-02-24 19:12:37', 1, 1, NULL, NULL, NULL),
(30, NULL, 1, 'sometext.txt', 'a2f4a9db', NULL, '2016-03-01 17:11:05', 0, 1, NULL, NULL, NULL),
(31, 1, 1, 'www.eluniversal.com.mx', '512725ea', NULL, '2016-03-08 20:24:34', 1, 1, NULL, NULL, NULL),
(32, NULL, 2, 'superchamba.com', 'paolo', NULL, '2016-03-09 17:09:31', 0, 1, NULL, NULL, NULL),
(33, NULL, 2, 'superchamba.com/home', '4e72fa0f', NULL, '2016-03-09 17:13:20', 0, 1, NULL, NULL, NULL),
(34, NULL, 2, 'superchamba.com', '4a949788', NULL, '2016-03-09 18:27:50', 0, 1, NULL, NULL, NULL),
(35, 12, 1, 'superchamba.com', 'cd494412', NULL, '2016-03-10 00:11:59', 1, 1, NULL, NULL, NULL),
(36, 1, 2, 'https://bancomer.com.mx/promos//12345', 'ae4ac5ed', '12345', '2016-03-10 15:11:01', 1, 1, NULL, NULL, NULL),
(37, 1, 2, 'https://bancomer.com.mx/promos//23456', 'df48409e', '23456', '2016-03-10 15:11:01', 1, 1, NULL, NULL, NULL),
(38, 1, 2, 'https://bancomer.com.mx/promos//34567', 'b2ae4d3e', '34567', '2016-03-10 15:11:01', 1, 1, NULL, NULL, NULL),
(39, 1, 2, 'https://bancomer.com.mx/promos//45678', '23673e4c', '45678', '2016-03-10 15:11:01', 1, 1, NULL, NULL, NULL),
(40, 1, 2, 'https://bancomer.com.mx/promos//56789', 'd1f229c5', '56789', '2016-03-10 15:11:01', 1, 1, NULL, NULL, NULL),
(41, 1, 2, 'https://bancomer.com.mx/promos//67890', '101167d3', '67890', '2016-03-10 15:11:01', 1, 1, NULL, NULL, NULL),
(42, 1, 2, 'https://bancomer.com.mx/promos//09876', '90c35a69', '09876', '2016-03-10 15:11:02', 1, 1, NULL, NULL, NULL),
(43, 1, 2, 'https://bancomer.com.mx/promos//98765', '70985351', '98765', '2016-03-10 15:11:02', 1, 1, NULL, NULL, NULL),
(44, 1, 2, 'https://bancomer.com.mx/promos//87654', '3ea94101', '87654', '2016-03-10 15:11:02', 1, 1, NULL, NULL, NULL),
(45, 16, 2, 'superchamba.com/web/bienvenido/buscarchamba/search:/', 'scmaps', NULL, '2016-03-10 21:54:23', 1, 1, NULL, NULL, NULL),
(46, 17, 1, 'superchamba.com/web/bienvenido/buscarchamba/search:/', 'scmaps2', NULL, '2016-03-10 22:25:11', 1, 1, NULL, NULL, NULL),
(47, NULL, 1, '12345611', 'numeros1', NULL, '2016-03-11 19:23:28', 0, 1, NULL, NULL, NULL),
(48, NULL, 2, '12345616', 'numeros2', NULL, '2016-03-11 19:24:31', 0, 1, NULL, NULL, NULL),
(49, NULL, 2, 'asdsadadasdsada', 'a24ca4ad', NULL, '2016-03-11 23:21:55', 0, 1, NULL, NULL, NULL),
(50, NULL, 2, 'api.jquery.com/select/', 'selectjq', NULL, '2016-03-14 14:23:57', 0, 1, NULL, NULL, NULL),
(51, NULL, 1, 'stackoverflow.com/questions/1414365/disable-enable-an-input-with-jquery', '4013bb4c', NULL, '2016-03-14 15:34:04', 0, 1, NULL, NULL, NULL),
(52, NULL, 1, 'stackoverflow.com/questions/1414365/disable-enable-an-input-with-jquery', '8d11c295', NULL, '2016-03-14 15:47:18', 0, 1, NULL, NULL, NULL),
(53, NULL, 2, 'stackoverflow.com', 'c464bb5a', NULL, '2016-03-14 15:57:04', 0, 1, NULL, NULL, NULL),
(54, NULL, 2, 'stackoverflow.co', '66fefefb', NULL, '2016-03-14 15:58:28', 0, 1, NULL, NULL, NULL),
(55, NULL, 1, 'yahoo.com', '4fa3379d', NULL, '2016-03-14 16:10:18', 0, 1, NULL, NULL, NULL),
(56, NULL, 1, 'yahoo.com', '0cc6ed5c', NULL, '2016-03-14 16:16:21', 0, 1, NULL, NULL, NULL),
(57, NULL, 1, 'maps.google.com', 'mapsg', NULL, '2016-03-14 16:18:35', 0, 1, NULL, NULL, NULL),
(58, NULL, 2, 'maps.google.com', 'dcc8adfe', NULL, '2016-03-14 16:20:39', 0, 1, NULL, NULL, NULL),
(59, NULL, 1, 'google.com', '270ecb8b', NULL, '2016-03-14 16:21:33', 0, 1, NULL, NULL, NULL),
(60, NULL, 1, 'superchamba.com', 'f799baa6', NULL, '2016-03-14 16:25:49', 0, 1, NULL, NULL, NULL),
(61, NULL, 1, 'superchamba.com', '0d16bc11', NULL, '2016-03-14 16:31:36', 0, 1, NULL, NULL, NULL),
(62, NULL, 1, 'google.com.mx', 'bc0f2251', NULL, '2016-03-14 16:38:42', 0, 1, NULL, NULL, NULL),
(63, NULL, 1, 'www.google.com', '8ab06cb4', NULL, '2016-03-14 17:05:06', 0, 1, NULL, NULL, NULL),
(64, NULL, 1, 'en.wikipedia.org/wiki/Google_DeepMind', 'gdm', NULL, '2016-03-14 17:07:47', 0, 1, NULL, NULL, NULL),
(65, NULL, 1, 'en.wikipedia.org', 'eb88b37c', NULL, '2016-03-14 17:20:00', 0, 1, NULL, NULL, NULL),
(66, NULL, 1, 'en.wikipedia.org', 'ecf41d90', NULL, '2016-03-14 17:21:25', 0, 1, NULL, NULL, NULL),
(67, NULL, 2, 'yahoo.com.mx', '3ee3c0ca', NULL, '2016-03-14 17:23:13', 0, 1, NULL, NULL, NULL),
(68, NULL, 1, 'aol.com.mx', 'aolmx', NULL, '2016-03-14 17:25:17', 0, 1, NULL, NULL, NULL),
(69, NULL, 1, 'yahoo.com.mx', '80edaa78', NULL, '2016-03-14 17:26:20', 0, 1, NULL, NULL, NULL),
(70, NULL, 1, 'en.wikipedia.org', '4ed514b2', NULL, '2016-03-14 17:29:51', 0, 1, NULL, NULL, NULL),
(71, NULL, 1, 'www.google.com/edu/products/productivity-tools/', '55ebccdd', NULL, '2016-03-14 17:32:12', 0, 1, NULL, NULL, NULL),
(72, NULL, 1, 'developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/String/replace', 'd5a9407f', NULL, '2016-03-14 18:48:00', 0, 1, NULL, NULL, NULL),
(73, NULL, 1, 'yahoo.com.mx', 'c53b1f9b', NULL, '2016-03-14 22:17:59', 0, 1, NULL, NULL, NULL),
(74, NULL, 1, 'yahoo.com.mx', 'yhm', NULL, '2016-03-14 22:18:49', 0, 1, NULL, NULL, NULL),
(75, 1, 1, 'yahoo.com', '6dca1de4', NULL, '2016-03-14 22:20:26', 1, 1, NULL, NULL, NULL),
(76, 1, 1, 'facebook.com', 'd015e8d5', NULL, '2016-03-14 22:26:54', 1, 1, NULL, NULL, NULL),
(77, NULL, 1, 'yahoo.com', '6a3aaabf', NULL, '2016-03-15 20:14:59', 0, 1, NULL, NULL, NULL),
(78, 21, 1, 'superchamba.com/123123', '202a0272', '123123', '2016-03-15 22:10:13', 1, 1, NULL, 'localhost:8082/i/?202a0272', NULL),
(79, 21, 2, 'google.com/111111', 'e7e2bb67', '111111', '2016-03-15 22:10:13', 1, 1, NULL, 'localhost:8082/i/?e7e2bb67', NULL),
(80, 21, 1, 'atabay.mx/222222', '9c2496a8', '222222', '2016-03-15 22:10:13', 1, 1, NULL, 'localhost:8082/i/?9c2496a8', NULL),
(81, 21, 2, 'otrodominio.com/333333', '89c55184', '333333', '2016-03-15 22:10:13', 1, 1, NULL, 'localhost:8082/i/?89c55184', NULL),
(82, 1, 1, 'facebook.com', 'cce2b4d7', NULL, '2016-03-16 16:40:42', 0, 1, NULL, NULL, NULL),
(83, NULL, 1, 'a', 'sss', NULL, '2016-03-16 17:30:20', 0, 1, NULL, NULL, NULL),
(84, 1, 1, 'facebook.com', '7d61a3ae', NULL, '2016-03-16 20:45:18', 1, 1, NULL, NULL, NULL),
(85, 1, 1, 'facebook.com', 'fb1', NULL, '2016-03-16 20:46:58', 1, 1, NULL, NULL, NULL),
(86, 1, 2, 'facebook.com', 'fb10', NULL, '2016-03-16 20:48:02', 1, 1, NULL, NULL, NULL),
(87, 1, 2, 'facebook.com', 'fb11', NULL, '2016-03-16 20:48:23', 1, 1, NULL, NULL, NULL),
(88, 1, 2, 'facebook.com', 'fb100', NULL, '2016-03-16 20:48:43', 1, 1, NULL, NULL, NULL),
(89, 1, 2, 'facebook.com', 'fb101', NULL, '2016-03-16 20:48:52', 1, 1, NULL, NULL, NULL),
(90, 1, 2, 'facebook.com', 'fb110', NULL, '2016-03-16 20:49:04', 1, 1, NULL, NULL, NULL),
(91, 1, 2, 'facebook.com', 'fb111', NULL, '2016-03-16 20:49:56', 1, 1, NULL, NULL, NULL),
(92, 1, 2, 'facebook.com', 'fb1000', NULL, '2016-03-16 20:50:12', 1, 1, NULL, NULL, NULL),
(93, 1, 2, 'facebook.com', 'fb1001', NULL, '2016-03-16 20:50:34', 1, 1, NULL, NULL, NULL),
(94, 1, 2, 'facebook.com', 'fb1010', NULL, '2016-03-16 20:50:42', 1, 1, NULL, NULL, NULL),
(95, 1, 1, 'facebook.com', 'fb1011', NULL, '2016-03-16 20:50:53', 1, 1, NULL, NULL, NULL),
(96, 1, 1, 'facebook.com', 'fb1100', NULL, '2016-03-16 20:51:07', 1, 1, NULL, NULL, NULL),
(97, 1, 1, 'facebook.com', 'fb1101', NULL, '2016-03-16 20:51:32', 1, 1, NULL, NULL, NULL),
(98, 1, 1, 'facebook.com', 'fb1111', NULL, '2016-03-16 20:51:41', 1, 1, NULL, NULL, NULL),
(99, 1, 1, 'superchamba.com', 'e3e5d95d', NULL, '2016-03-17 13:50:33', 0, 1, NULL, NULL, NULL),
(100, 1, 1, 'superchamba.com', '8a714552', NULL, '2016-03-17 13:50:46', 0, 1, NULL, NULL, NULL),
(101, 1, 2, 'superchamba.com', '8a71455', NULL, '2016-03-17 13:51:00', 0, 1, NULL, NULL, NULL),
(102, 1, 2, 'superchamba.com', '8a7145', NULL, '2016-03-17 13:51:20', 0, 1, NULL, NULL, NULL),
(103, 1, 1, 'superchamba.com', '294fbad9', NULL, '2016-03-17 13:51:27', 0, 1, NULL, NULL, NULL),
(104, 1, 1, 'superchamba.com', '294fbad', NULL, '2016-03-17 13:51:38', 0, 1, NULL, NULL, NULL),
(105, 1, 1, 'superchamba.com', '294fba', NULL, '2016-03-17 13:51:45', 0, 1, NULL, NULL, NULL),
(106, 1, 1, 'superchamba.com', 'a2d52c83', NULL, '2016-03-17 15:12:21', 1, 1, NULL, NULL, NULL),
(107, 1, 1, 'superchamba.com', 'a2d52c82', NULL, '2016-03-17 15:12:37', 1, 1, NULL, NULL, NULL),
(108, 1, 2, 'superchamba.com', 'a2d52c82ad', NULL, '2016-03-17 15:12:51', 1, 1, NULL, NULL, NULL),
(111, 1, 2, 'superchamba.com', 'a2d52c82ab', NULL, '2016-03-17 15:21:10', 1, 1, NULL, NULL, NULL),
(112, 1, 1, 'superchamba.com', '583fe010', NULL, '2016-03-17 15:22:43', 1, 1, NULL, NULL, NULL),
(113, 1, 1, 'superchamba.com', '583fe01', NULL, '2016-03-17 15:22:51', 1, 1, NULL, NULL, NULL),
(114, 1, 1, 'superchamba.com', 'sch', NULL, '2016-03-17 15:23:22', 1, 1, NULL, NULL, NULL),
(147, 1, 1, 'en.wikipedia.org/wiki/2016_Brussels_bombings', '47c7e196', NULL, '2016-03-22 16:42:05', 0, 1, NULL, 'localhost:8082/i/?47c7e196', NULL),
(540, 1, 1, 'en.wikipedia.org/en', 'a2a30f33', NULL, '2016-03-22 18:55:30', 0, 1, NULL, 'localhost:8082/i/?a2a30f33', NULL),
(541, 1, 1, 'en.wikipedia.com', 'b52096f6', NULL, '2016-03-22 20:37:07', 0, 1, NULL, 'localhost:8082/i/?b52096f6', NULL),
(542, 1, 1, 'facebook.com', '5175e1f3', NULL, '2016-03-22 20:42:45', 0, 1, NULL, 'localhost:8082/i/?5175e1f3', NULL),
(543, 1, 1, 'facebook.com', 'ffd9d7aa', NULL, '2016-03-22 20:46:03', 0, 1, NULL, 'localhost:8082/i/?ffd9d7aa', NULL),
(572, 1, 1, 'superchambaa1.com/123123', '8061cba0', '123123', '2016-03-22 21:34:03', 0, 1, '2', 'localhost:8082/i/?8061cba0', '1458682443'),
(573, 1, 2, 'googlev2.com/111111', 'e4327dbe', '111111', '2016-03-22 21:34:03', 0, 1, '2', 'localhost:8082/i/?e4327dbe', '1458682443'),
(574, 1, 1, 'atabayx3.mx/222222', 'db138b92', '222222', '2016-03-22 21:34:03', 0, 1, '2', 'localhost:8082/i/?db138b92', '1458682443'),
(575, 1, 2, 'otrodominioc4.com/333333', '9f1137f5', '333333', '2016-03-22 21:34:03', 0, 1, '2', 'localhost:8082/i/?9f1137f5', '1458682443'),
(576, 1, 1, 'superchambac5.com/123123', '9196edf7', '123123', '2016-03-22 21:34:03', 0, 1, '2', 'localhost:8082/i/?9196edf7', '1458682443'),
(577, 1, 2, 'googlec6.com/111111', '7da39dd8', '111111', '2016-03-22 21:34:03', 0, 1, '2', 'localhost:8082/i/?7da39dd8', '1458682443'),
(578, 1, 1, 'atabays7.mx/222222', '26908e2e', '222222', '2016-03-22 21:34:03', 0, 1, '2', 'localhost:8082/i/?26908e2e', '1458682443'),
(579, 1, 2, 'otrodominios8.com/333333', '643ac0bb', '333333', '2016-03-22 21:34:03', 0, 1, '2', 'localhost:8082/i/?643ac0bb', '1458682443'),
(580, 1, 1, 'superchambas9.com/123123', '26558115', '123123', '2016-03-22 21:34:03', 0, 1, '2', 'localhost:8082/i/?26558115', '1458682443'),
(581, 1, 2, 'googlesa.com/111111', '5f65ba74', '111111', '2016-03-22 21:34:03', 0, 1, '2', 'localhost:8082/i/?5f65ba74', '1458682443'),
(582, 1, 1, 'atabays.mx/222222', 'd98b9907', '222222', '2016-03-22 21:34:03', 0, 1, '2', 'localhost:8082/i/?d98b9907', '1458682443'),
(583, 1, 2, 'otrodominios.com/333333', 'bf53ad9b', '333333', '2016-03-22 21:34:03', 0, 1, '2', 'localhost:8082/i/?bf53ad9b', '1458682443'),
(584, 1, 1, 'superchambad.com/123123', '91e63310', '123123', '2016-03-22 21:34:03', 0, 1, '2', 'localhost:8082/i/?91e63310', '1458682443'),
(585, 1, 2, 'googlev.com/111111', '7810252a', '111111', '2016-03-22 21:34:03', 0, 1, '2', 'localhost:8082/i/?7810252a', '1458682443'),
(586, 1, 1, 'atabayk.mx/222222', '2c93569d', '222222', '2016-03-22 21:34:03', 0, 1, '2', 'localhost:8082/i/?2c93569d', '1458682443'),
(587, 1, 2, 'otrodominiol.com/333333', '34c33009', '333333', '2016-03-22 21:34:03', 0, 1, '2', 'localhost:8082/i/?34c33009', '1458682443'),
(588, 1, 1, 'superchambaj.com/123123', 'a779a41c', '123123', '2016-03-22 21:34:04', 0, 1, '2', 'localhost:8082/i/?a779a41c', '1458682443'),
(589, 1, 2, 'googleg.com/111111', '2ea6d8fd', '111111', '2016-03-22 21:34:04', 0, 1, '2', 'localhost:8082/i/?2ea6d8fd', '1458682443'),
(590, 1, 1, 'atabayr.mx/222222', '6f924a34', '222222', '2016-03-22 21:34:04', 0, 1, '2', 'localhost:8082/i/?6f924a34', '1458682443'),
(591, 1, 2, 'otrodominiot.com/333333', '9382beb2', '333333', '2016-03-22 21:34:04', 0, 1, '2', 'localhost:8082/i/?9382beb2', '1458682443'),
(592, 1, 1, 'superchambas.com/123123', 'ce64be2e', '123123', '2016-03-22 21:34:04', 0, 1, '2', 'localhost:8082/i/?ce64be2e', '1458682443'),
(593, 1, 2, 'googler.com/111111', 'e76834c1', '111111', '2016-03-22 21:34:04', 0, 1, '2', 'localhost:8082/i/?e76834c1', '1458682443'),
(594, 1, 1, 'atabayu.mx/222222', 'a2e51c32', '222222', '2016-03-22 21:34:04', 0, 1, '2', 'localhost:8082/i/?a2e51c32', '1458682443'),
(595, 1, 2, 'otrodominio.comv/333333', 'a29051c2', '333333', '2016-03-22 21:34:04', 0, 1, '2', 'localhost:8082/i/?a29051c2', '1458682443'),
(596, 1, 1, 'superchamba.com/e123123', 'b31b4ace', 'e123123', '2016-03-22 21:34:04', 0, 1, '2', 'localhost:8082/i/?b31b4ace', '1458682443'),
(597, 1, 2, 'google.come/111111', '49323ad2', '111111', '2016-03-22 21:34:04', 0, 1, '2', 'localhost:8082/i/?49323ad2', '1458682443'),
(598, 1, 1, 'atabay1.mx/222222', '97cc904d', '222222', '2016-03-22 21:34:04', 0, 1, '2', 'localhost:8082/i/?97cc904d', '1458682443'),
(599, 1, 2, 'otrodominio5.com/333333', 'ad5add5a', '333333', '2016-03-22 21:34:04', 0, 1, '2', 'localhost:8082/i/?ad5add5a', '1458682443'),
(600, 24, 1, 'superchambaa1.com/123123', '2ba0ef21', '123123', '2016-03-22 23:03:27', 0, 1, '3', 'localhost:8082/i/?2ba0ef21', '1458687807'),
(601, 24, 2, 'googlev2.com/111111', '1332fbe0', '111111', '2016-03-22 23:03:27', 0, 1, '3', 'localhost:8082/i/?1332fbe0', '1458687807'),
(602, 24, 1, 'atabayx3.mx/222222', '00308f65', '222222', '2016-03-22 23:03:27', 0, 1, '3', 'localhost:8082/i/?00308f65', '1458687807'),
(603, 24, 2, 'otrodominioc4.com/333333', '543e319f', '333333', '2016-03-22 23:03:27', 0, 1, '3', 'localhost:8082/i/?543e319f', '1458687807'),
(604, 24, 1, 'superchambac5.com/123123', '7df88b42', '123123', '2016-03-22 23:03:27', 0, 1, '3', 'localhost:8082/i/?7df88b42', '1458687807'),
(605, 24, 2, 'googlec6.com/111111', '474c4c8a', '111111', '2016-03-22 23:03:27', 0, 1, '3', 'localhost:8082/i/?474c4c8a', '1458687807'),
(606, 24, 1, 'atabays7.mx/222222', '838622aa', '222222', '2016-03-22 23:03:27', 0, 1, '3', 'localhost:8082/i/?838622aa', '1458687807'),
(607, 24, 2, 'otrodominios8.com/333333', '94dd4baa', '333333', '2016-03-22 23:03:27', 0, 1, '3', 'localhost:8082/i/?94dd4baa', '1458687807'),
(608, 24, 1, 'superchambas9.com/123123', 'c0fac4cd', '123123', '2016-03-22 23:03:27', 0, 1, '3', 'localhost:8082/i/?c0fac4cd', '1458687807'),
(609, 24, 2, 'googlesa.com/111111', '8c81e538', '111111', '2016-03-22 23:03:27', 0, 1, '3', 'localhost:8082/i/?8c81e538', '1458687807'),
(610, 24, 1, 'atabays.mx/222222', '04daf3b7', '222222', '2016-03-22 23:03:27', 0, 1, '3', 'localhost:8082/i/?04daf3b7', '1458687807'),
(611, 24, 2, 'otrodominios.com/333333', '08e77c74', '333333', '2016-03-22 23:03:27', 0, 1, '3', 'localhost:8082/i/?08e77c74', '1458687807'),
(612, 24, 1, 'superchambad.com/123123', 'd845b414', '123123', '2016-03-22 23:03:27', 0, 1, '3', 'localhost:8082/i/?d845b414', '1458687807'),
(613, 24, 2, 'googlev.com/111111', '6c215caa', '111111', '2016-03-22 23:03:27', 0, 1, '3', 'localhost:8082/i/?6c215caa', '1458687807'),
(614, 24, 1, 'atabayk.mx/222222', '35412a6d', '222222', '2016-03-22 23:03:28', 0, 1, '3', 'localhost:8082/i/?35412a6d', '1458687807'),
(615, 24, 2, 'otrodominiol.com/333333', 'fd2c0cc2', '333333', '2016-03-22 23:03:28', 0, 1, '3', 'localhost:8082/i/?fd2c0cc2', '1458687807'),
(616, 24, 1, 'superchambaj.com/123123', 'b9b1d602', '123123', '2016-03-22 23:03:28', 0, 1, '3', 'localhost:8082/i/?b9b1d602', '1458687807'),
(617, 24, 2, 'googleg.com/111111', 'f2be94f5', '111111', '2016-03-22 23:03:28', 0, 1, '3', 'localhost:8082/i/?f2be94f5', '1458687807'),
(618, 24, 1, 'atabayr.mx/222222', '0e065316', '222222', '2016-03-22 23:03:28', 0, 1, '3', 'localhost:8082/i/?0e065316', '1458687807'),
(619, 24, 2, 'otrodominiot.com/333333', '8a7aeb8b', '333333', '2016-03-22 23:03:28', 0, 1, '3', 'localhost:8082/i/?8a7aeb8b', '1458687807'),
(620, 24, 1, 'superchambas.com/123123', '1495c09a', '123123', '2016-03-22 23:03:28', 0, 1, '3', 'localhost:8082/i/?1495c09a', '1458687807'),
(621, 24, 2, 'googler.com/111111', 'a3565f2a', '111111', '2016-03-22 23:03:28', 0, 1, '3', 'localhost:8082/i/?a3565f2a', '1458687807'),
(622, 24, 1, 'atabayu.mx/222222', 'f1d14af3', '222222', '2016-03-22 23:03:28', 0, 1, '3', 'localhost:8082/i/?f1d14af3', '1458687807'),
(623, 24, 2, 'otrodominio.comv/333333', 'aac908a7', '333333', '2016-03-22 23:03:28', 0, 1, '3', 'localhost:8082/i/?aac908a7', '1458687807'),
(624, 24, 1, 'superchamba.com/e123123', '7b676ab4', 'e123123', '2016-03-22 23:03:28', 0, 1, '3', 'localhost:8082/i/?7b676ab4', '1458687807'),
(625, 24, 2, 'google.come/111111', '0c2a37f6', '111111', '2016-03-22 23:03:28', 0, 1, '3', 'localhost:8082/i/?0c2a37f6', '1458687807'),
(626, 24, 1, 'atabay1.mx/222222', 'e0f8001a', '222222', '2016-03-22 23:03:28', 0, 1, '3', 'localhost:8082/i/?e0f8001a', '1458687807'),
(627, 24, 2, 'otrodominio5.com/333333', 'f65ce61d', '333333', '2016-03-22 23:03:28', 0, 1, '3', 'localhost:8082/i/?f65ce61d', '1458687807'),
(628, NULL, 1, '', '1234567888', NULL, '2016-03-22 23:15:28', 0, 1, NULL, 'localhost:8082/i/?1234567888888', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `permisos_en_rol`
--

CREATE TABLE `permisos_en_rol` (
  `id` smallint(5) UNSIGNED NOT NULL,
  `id_rol` smallint(5) UNSIGNED NOT NULL,
  `id_permiso` smallint(5) UNSIGNED NOT NULL,
  `vigente` tinyint(4) NOT NULL DEFAULT '1'
) COMMENT='El id del rol en roles';

--
-- Dumping data for table `permisos_en_rol`
--

INSERT INTO `permisos_en_rol` (`id`, `id_rol`, `id_permiso`, `vigente`) VALUES
(1, 1, 1, 1),
(2, 1, 2, 1),
(3, 1, 3, 1),
(4, 1, 4, 1),
(5, 1, 5, 1);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` smallint(5) UNSIGNED NOT NULL,
  `nombre` varchar(20) NOT NULL,
  `abrev` varchar(10) NOT NULL,
  `activo` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `nombre`, `abrev`, `activo`) VALUES
(1, 'Superusuario', 'root', 1),
(2, 'Usuario registrado', 'registUser', 1),
(3, 'Usuario de carga', 'loadUser', 1),
(4, 'Usuario premium', 'premiumUsr', 1),
(5, 'Administrador de Usu', 'usersAdmin', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` smallint(5) UNSIGNED NOT NULL,
  `username` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `password` char(64) NOT NULL DEFAULT '1234567890123456789012345678901234567890123456789012345678901234',
  `firstName` varchar(50) NOT NULL,
  `lastName` varchar(50) NOT NULL,
  `dob` date NOT NULL,
  `email` varchar(100) NOT NULL,
  `id_role` smallint(5) UNSIGNED NOT NULL DEFAULT '2',
  `active` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `firstName`, `lastName`, `dob`, `email`, `id_role`, `active`) VALUES
(1, 'admin', '240be518fabd2724ddb6f04eeb1da5967448d7e831c08c8fa822809f74c720a9', 'Administrador', 'de MiniURL', '2016-03-01', 'admin@mi.ni', 1, 1),
(2, 'usuario1', '1234567890123456789012345678901234567890123456789012345678901234', 'Usua', 'Rio Uno', '2013-11-09', 'usuario1@usuari.os', 2, 1),
(10, 'alberto.conrado.mx@gmail.com', '2f907ba9f55cba4670c1753ba7717b8b9c46a800a1adcffbdb564ad137f1728a', 'Aconrado', 'Ã‘oÃ±o', '0000-00-00', 'alberto.conrado.mx@soyunÃ±oÃ±o.com', 2, 1),
(11, 'paolorizzi78@gmail.com', 'daa35e4f1a0e43def76e13a948cbda05be2569901fa0c6d5d6342fb2bdc85028', '', '', '0000-00-00', 'paolorizzi78@gmail.com', 2, 1),
(12, 'unnombremuymuylargo@undominiotambienmuylargo.com.mx', 'ecd71870d1963316a97e3ac3408c9835ad8cf0f3c1bc703527c30265534f75ae', '', '', '0000-00-00', 'unnombremuymuylargo@undominiotambienmuylargo.com.mx', 2, 1),
(13, 'prueba@register.com', 'ecd71870d1963316a97e3ac3408c9835ad8cf0f3c1bc703527c30265534f75ae', 'Prueba', 'Register', '0000-00-00', 'prueba@register.com', 2, 1),
(15, 'prueba@registro.com', '4cc54d9563b250c0b0a993e5d7fd838ecca9960a5ed4412699d37439b28c78a0', '', '', '0000-00-00', 'prueba@registro.com', 2, 1),
(16, 'testA@test.com', 'ecd71870d1963316a97e3ac3408c9835ad8cf0f3c1bc703527c30265534f75ae', 'Al', 'Flo', '0000-00-00', 'testA@test.com', 2, 1),
(17, 'uno@dos.com', '4ea0041836d6328cf16f38b71f67ebdd077843f075eb5e112818503e065e7619', 'Uno', 'Dos Tres', '0000-00-00', 'uno@dos.com', 2, 1),
(18, 'anewone@users.net', 'ecd71870d1963316a97e3ac3408c9835ad8cf0f3c1bc703527c30265534f75ae', 'New Name', 'My Family', '0000-00-00', 'anewone@users.net', 2, 1),
(19, 'uno@dos.tres', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 'Uno', 'Dos Tres', '0000-00-00', 'uno@dos.tres', 2, 1),
(20, 'upload@user.com', 'ecd71870d1963316a97e3ac3408c9835ad8cf0f3c1bc703527c30265534f75ae', '', '', '0000-00-00', 'upload@user.com', 2, 1),
(21, 'pikosroler@hotmail.com', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 'A', 'B', '0000-00-00', 'pikosroler@hotmail.com', 2, 1),
(22, 'some@thi.ng', 'ecd71870d1963316a97e3ac3408c9835ad8cf0f3c1bc703527c30265534f75ae', 'Some', 'Thing', '0000-00-00', 'some@thi.ng', 2, 1),
(23, 'visitador', 'b460b1982188f11d175f60ed670027e1afdd16558919fe47023ecd38329e0b7f', '', '', '0000-00-00', 'visitador', 2, 1),
(24, 'alberto@flores.mx', 'c5f263343bb924a8f269bda66306f62f8dd0fca8a109a37849cb46a3f8c3ca45', 'Beto', 'Flores', '0000-00-00', 'alberto@flores.mx', 2, 1);

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
(38, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/49.0.2623.54 Safari/537.36', 'Chrome', 'Win10', 29, '2016-02-24 20:10:35'),
(39, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:44.0) Gecko/20100101 Firefox/44.0', '', '', 25, '2016-03-01 18:04:03'),
(40, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:44.0) Gecko/20100101 Firefox/44.0', '', '', 29, '2016-03-01 18:23:11'),
(41, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:44.0) Gecko/20100101 Firefox/44.0', '', '', 29, '2016-03-01 18:39:58'),
(42, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:44.0) Gecko/20100101 Firefox/44.0', 'Firefox', 'Win10', 29, '2016-03-01 19:14:37'),
(43, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/49.0.2623.54 Safari/537.36', '', '', 29, '2016-03-01 19:25:21'),
(44, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:44.0) Gecko/20100101 Firefox/44.0', 'Firefox', 'Win10', 29, '2016-03-01 21:12:56'),
(45, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:44.0) Gecko/20100101 Firefox/44.0', '', '', 29, '2016-03-01 21:14:06'),
(46, '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:44.0) Gecko/20100101 Firefox/44.0', 'Default Browser', 'unknown', 31, '2016-03-08 20:24:54'),
(47, '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:44.0) Gecko/20100101 Firefox/44.0', 'Default Browser', 'unknown', 31, '2016-03-08 20:25:07'),
(48, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/49.0.2623.54 Safari/537.36', 'Default Browser', 'unknown', 31, '2016-03-08 20:25:26'),
(49, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/49.0.2623.54 Safari/537.36', 'Default Browser', 'unknown', 31, '2016-03-08 20:25:33'),
(50, '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:44.0) Gecko/20100101 Firefox/44.0', 'Default Browser', 'unknown', 35, '2016-03-10 00:12:15'),
(51, '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:44.0) Gecko/20100101 Firefox/44.0', 'Default Browser', 'unknown', 46, '2016-03-10 22:25:27'),
(52, '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:44.0) Gecko/20100101 Firefox/44.0', 'Default Browser', 'unknown', 75, '2016-03-14 22:20:30'),
(53, '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:44.0) Gecko/20100101 Firefox/44.0', 'Default Browser', 'unknown', 76, '2016-03-14 22:27:02'),
(54, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/49.0.2623.54 Safari/537.36', 'Default Browser', 'unknown', 76, '2016-03-14 22:27:29'),
(55, '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:44.0) Gecko/20100101 Firefox/44.0', 'Default Browser', 'unknown', 84, '2016-03-16 20:46:32'),
(56, '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:44.0) Gecko/20100101 Firefox/44.0', 'Default Browser', 'unknown', 84, '2016-03-16 20:46:36'),
(57, '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:44.0) Gecko/20100101 Firefox/44.0', 'Default Browser', 'unknown', 85, '2016-03-16 20:47:02'),
(58, '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:44.0) Gecko/20100101 Firefox/44.0', 'Default Browser', 'unknown', 85, '2016-03-16 20:47:07'),
(59, '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:44.0) Gecko/20100101 Firefox/44.0', 'Default Browser', 'unknown', 86, '2016-03-16 20:48:04'),
(60, '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:44.0) Gecko/20100101 Firefox/44.0', 'Default Browser', 'unknown', 86, '2016-03-16 20:48:09'),
(61, '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:44.0) Gecko/20100101 Firefox/44.0', 'Default Browser', 'unknown', 87, '2016-03-16 20:48:30'),
(62, '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:44.0) Gecko/20100101 Firefox/44.0', 'Default Browser', 'unknown', 88, '2016-03-16 20:48:44'),
(63, '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:44.0) Gecko/20100101 Firefox/44.0', 'Default Browser', 'unknown', 89, '2016-03-16 20:48:53'),
(64, '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:44.0) Gecko/20100101 Firefox/44.0', 'Default Browser', 'unknown', 90, '2016-03-16 20:49:06'),
(65, '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:44.0) Gecko/20100101 Firefox/44.0', 'Default Browser', 'unknown', 90, '2016-03-16 20:49:44'),
(66, '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:44.0) Gecko/20100101 Firefox/44.0', 'Default Browser', 'unknown', 91, '2016-03-16 20:49:58'),
(67, '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:44.0) Gecko/20100101 Firefox/44.0', 'Default Browser', 'unknown', 91, '2016-03-16 20:50:01'),
(68, '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:44.0) Gecko/20100101 Firefox/44.0', 'Default Browser', 'unknown', 92, '2016-03-16 20:50:27'),
(69, '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:44.0) Gecko/20100101 Firefox/44.0', 'Default Browser', 'unknown', 93, '2016-03-16 20:50:35'),
(70, '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:44.0) Gecko/20100101 Firefox/44.0', 'Default Browser', 'unknown', 94, '2016-03-16 20:50:44'),
(71, '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:44.0) Gecko/20100101 Firefox/44.0', 'Default Browser', 'unknown', 95, '2016-03-16 20:50:55'),
(72, '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:44.0) Gecko/20100101 Firefox/44.0', 'Default Browser', 'unknown', 96, '2016-03-16 20:51:08'),
(73, '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:44.0) Gecko/20100101 Firefox/44.0', 'Default Browser', 'unknown', 96, '2016-03-16 20:51:11'),
(74, '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:44.0) Gecko/20100101 Firefox/44.0', 'Default Browser', 'unknown', 96, '2016-03-16 20:51:14'),
(75, '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:44.0) Gecko/20100101 Firefox/44.0', 'Default Browser', 'unknown', 96, '2016-03-16 20:51:15'),
(76, '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:44.0) Gecko/20100101 Firefox/44.0', 'Default Browser', 'unknown', 97, '2016-03-16 20:51:34'),
(77, '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:44.0) Gecko/20100101 Firefox/44.0', 'Default Browser', 'unknown', 98, '2016-03-16 20:51:48'),
(78, '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:44.0) Gecko/20100101 Firefox/44.0', 'Default Browser', 'unknown', 98, '2016-03-16 20:51:50'),
(79, '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:44.0) Gecko/20100101 Firefox/44.0', 'Default Browser', 'unknown', 98, '2016-03-16 20:51:51'),
(80, '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:44.0) Gecko/20100101 Firefox/44.0', 'Default Browser', 'unknown', 98, '2016-03-16 20:51:53'),
(81, '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:44.0) Gecko/20100101 Firefox/44.0', 'Default Browser', 'unknown', 98, '2016-03-16 20:51:54'),
(82, '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:44.0) Gecko/20100101 Firefox/44.0', 'Default Browser', 'unknown', 98, '2016-03-16 20:51:56'),
(83, '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:44.0) Gecko/20100101 Firefox/44.0', 'Default Browser', 'unknown', 98, '2016-03-16 20:51:57'),
(84, '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:44.0) Gecko/20100101 Firefox/44.0', 'Default Browser', 'unknown', 98, '2016-03-16 20:51:59'),
(85, '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:44.0) Gecko/20100101 Firefox/44.0', 'Default Browser', 'unknown', 98, '2016-03-16 20:52:01'),
(86, '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:44.0) Gecko/20100101 Firefox/44.0', 'Default Browser', 'unknown', 106, '2016-03-17 15:12:23'),
(87, '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:44.0) Gecko/20100101 Firefox/44.0', 'Default Browser', 'unknown', 107, '2016-03-17 15:12:40'),
(88, '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:44.0) Gecko/20100101 Firefox/44.0', 'Default Browser', 'unknown', 113, '2016-03-17 15:22:54'),
(89, '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:44.0) Gecko/20100101 Firefox/44.0', 'Default Browser', 'unknown', 114, '2016-03-17 15:23:34'),
(90, '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:44.0) Gecko/20100101 Firefox/44.0', 'Default Browser', 'unknown', 114, '2016-03-17 15:23:35'),
(91, '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:44.0) Gecko/20100101 Firefox/44.0', 'Default Browser', 'unknown', 114, '2016-03-17 15:23:37'),
(92, '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:44.0) Gecko/20100101 Firefox/44.0', 'Default Browser', 'unknown', 114, '2016-03-17 15:23:38'),
(93, '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:44.0) Gecko/20100101 Firefox/44.0', 'Default Browser', 'unknown', 114, '2016-03-17 15:23:39'),
(94, '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:44.0) Gecko/20100101 Firefox/44.0', 'Default Browser', 'unknown', 114, '2016-03-17 15:23:40'),
(95, '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:44.0) Gecko/20100101 Firefox/44.0', 'Default Browser', 'unknown', 114, '2016-03-17 15:23:42'),
(96, '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:44.0) Gecko/20100101 Firefox/44.0', 'Default Browser', 'unknown', 114, '2016-03-17 15:23:43'),
(97, '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:44.0) Gecko/20100101 Firefox/44.0', 'Default Browser', 'unknown', 114, '2016-03-17 15:23:45'),
(98, '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:44.0) Gecko/20100101 Firefox/44.0', 'Default Browser', 'unknown', 114, '2016-03-17 15:23:47'),
(99, '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:44.0) Gecko/20100101 Firefox/44.0', 'Default Browser', 'unknown', 114, '2016-03-17 15:23:48'),
(100, '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:44.0) Gecko/20100101 Firefox/44.0', 'Default Browser', 'unknown', 120, '2016-03-17 23:43:36'),
(101, '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:44.0) Gecko/20100101 Firefox/44.0', 'Default Browser', 'unknown', 121, '2016-03-17 23:43:48'),
(102, '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:44.0) Gecko/20100101 Firefox/44.0', 'Default Browser', 'unknown', 122, '2016-03-17 23:43:56'),
(103, '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:44.0) Gecko/20100101 Firefox/44.0', 'Default Browser', 'unknown', 123, '2016-03-17 23:44:59'),
(104, '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:44.0) Gecko/20100101 Firefox/44.0', 'Default Browser', 'unknown', 124, '2016-03-17 23:46:32'),
(105, '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:44.0) Gecko/20100101 Firefox/44.0', 'Default Browser', 'unknown', 125, '2016-03-17 23:48:06');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cat_categories`
--
ALTER TABLE `cat_categories`
  ADD PRIMARY KEY (`id_category`);

--
-- Indexes for table `cat_permiso`
--
ALTER TABLE `cat_permiso`
  ADD PRIMARY KEY (`clave`);

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
  ADD UNIQUE KEY `hash_uniq` (`hash`),
  ADD KEY `cve_protocolo` (`cve_protocolo`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `permisos_en_rol`
--
ALTER TABLE `permisos_en_rol`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_rol` (`id_rol`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD KEY `id_rol` (`id_role`);

--
-- Indexes for table `visitas`
--
ALTER TABLE `visitas`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cat_categories`
--
ALTER TABLE `cat_categories`
  MODIFY `id_category` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=128;
--
-- AUTO_INCREMENT for table `cat_permiso`
--
ALTER TABLE `cat_permiso`
  MODIFY `clave` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `cat_protocolo`
--
ALTER TABLE `cat_protocolo`
  MODIFY `clave` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `enlaces`
--
ALTER TABLE `enlaces`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=629;
--
-- AUTO_INCREMENT for table `permisos_en_rol`
--
ALTER TABLE `permisos_en_rol`
  MODIFY `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT for table `visitas`
--
ALTER TABLE `visitas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=106;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `enlaces`
--
ALTER TABLE `enlaces`
  ADD CONSTRAINT `fk_cve_prot` FOREIGN KEY (`cve_protocolo`) REFERENCES `cat_protocolo` (`clave`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`id_role`) REFERENCES `roles` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
