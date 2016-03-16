-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 16, 2016 at 07:16 PM
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
  `id_category` tinyint(25) NOT NULL,
  `category` varchar(600) NOT NULL,
  `id_user` int(11) NOT NULL,
  `active` int(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cat_categories`
--

INSERT INTO `cat_categories` (`id_category`, `category`, `id_user`, `active`) VALUES
(1, 'Campaña Navideña', 1, 1),
(2, 'Campaña newsletter', 1, 1),
(3, 'Campaña de promociones', 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `cat_permiso`
--

CREATE TABLE `cat_permiso` (
  `clave` smallint(6) UNSIGNED NOT NULL,
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
(5, 'GIT', NULL, 0),
(6, 'FTPS', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `enlaces`
--

CREATE TABLE `enlaces` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_user` smallint(5) UNSIGNED DEFAULT NULL COMMENT 'id of user, if one was authenticated',
  `cve_protocolo` tinyint(3) UNSIGNED NOT NULL,
  `url` varchar(200) NOT NULL,
  `hash` varchar(10) NOT NULL,
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
(83, NULL, 1, 'a', 'sss', NULL, '2016-03-16 17:30:20', 0, 1, NULL, NULL, NULL);

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
(22, 'some@thi.ng', 'ecd71870d1963316a97e3ac3408c9835ad8cf0f3c1bc703527c30265534f75ae', 'Some', 'Thing', '0000-00-00', 'some@thi.ng', 2, 1);

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
(54, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/49.0.2623.54 Safari/537.36', 'Default Browser', 'unknown', 76, '2016-03-14 22:27:29');

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
-- AUTO_INCREMENT for table `cat_permiso`
--
ALTER TABLE `cat_permiso`
  MODIFY `clave` smallint(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `cat_protocolo`
--
ALTER TABLE `cat_protocolo`
  MODIFY `clave` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `enlaces`
--
ALTER TABLE `enlaces`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;
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
  MODIFY `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT for table `visitas`
--
ALTER TABLE `visitas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;
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
