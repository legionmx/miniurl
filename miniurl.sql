-- phpMyAdmin SQL Dump
-- version 4.2.10
-- http://www.phpmyadmin.net
--
-- Servidor: localhost:8889
-- Tiempo de generación: 17-03-2016 a las 23:38:41
-- Versión del servidor: 5.5.38
-- Versión de PHP: 5.5.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Base de datos: `miniurl`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cat_categories`
--

CREATE TABLE `cat_categories` (
`id_category` tinyint(25) NOT NULL,
  `category` varchar(600) NOT NULL,
  `id_user` int(11) NOT NULL,
  `active` int(25) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=57 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `cat_categories`
--

INSERT INTO `cat_categories` (`id_category`, `category`, `id_user`, `active`) VALUES
(1, 'Navidad', 1, 1),
(2, 'campaÃ±a 1', 1, 1),
(4, 'Newsletter', 1, 1),
(14, 'San Valentin', 1, 1),
(54, 'campaÃ±a de inicio', 1, 1),
(55, '', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cat_permiso`
--

CREATE TABLE `cat_permiso` (
`clave` smallint(6) unsigned NOT NULL,
  `descripcion` varchar(50) NOT NULL,
  `abrev` varchar(10) NOT NULL,
  `edo_reg` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `cat_permiso`
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
-- Estructura de tabla para la tabla `cat_protocolo`
--

CREATE TABLE `cat_protocolo` (
`clave` tinyint(3) unsigned NOT NULL,
  `descripcion` varchar(20) NOT NULL,
  `html` varchar(20) DEFAULT NULL,
  `edo_reg` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `cat_protocolo`
--

INSERT INTO `cat_protocolo` (`clave`, `descripcion`, `html`, `edo_reg`) VALUES
(1, 'HTTP', NULL, 1),
(2, 'HTTPS', NULL, 1),
(3, 'OTRO', NULL, 1),
(20, 'git', NULL, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `enlaces`
--

CREATE TABLE `enlaces` (
`id` bigint(20) unsigned NOT NULL,
  `id_user` smallint(5) unsigned DEFAULT NULL COMMENT 'id of user, if one was authenticated',
  `cve_protocolo` tinyint(3) unsigned NOT NULL,
  `url` varchar(200) NOT NULL,
  `hash` varchar(10) NOT NULL,
  `code` varchar(600) DEFAULT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `seLogea` tinyint(1) NOT NULL DEFAULT '0',
  `activo` tinyint(1) NOT NULL DEFAULT '1',
  `id_category` varchar(200) DEFAULT NULL,
  `mini_url` varchar(600) DEFAULT NULL,
  `time_stamp` varchar(45) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=75 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `enlaces`
--

INSERT INTO `enlaces` (`id`, `id_user`, `cve_protocolo`, `url`, `hash`, `code`, `created`, `seLogea`, `activo`, `id_category`, `mini_url`, `time_stamp`) VALUES
(1, 1, 1, 'elpikos.com', 'e7ae5c98', NULL, '2016-03-17 16:25:41', 0, 1, '1', NULL, NULL),
(2, 1, 1, 'manterola.mx', 'f5bbca09', NULL, '2016-03-17 16:26:46', 1, 1, '14', NULL, NULL),
(3, 1, 1, 'superchamba.com/123123', 'a675a4a2', '123123', '2016-03-17 16:37:09', 1, 1, '2', 'localhost:8888/i/?a675a4a2', '1458232629'),
(4, 1, 2, 'google.com/111111', '2411a15b', '111111', '2016-03-17 16:37:09', 1, 1, '1', 'localhost:8888/i/?2411a15b', '1458232629'),
(5, 1, 1, 'atabay.mx/222222', '02c863b5', '222222', '2016-03-17 16:37:09', 0, 1, '1', 'localhost:8888/i/?02c863b5', '1458232629'),
(6, 1, 20, 'otrodominio.com/333333', '26409f98', '333333', '2016-03-17 16:37:09', 1, 1, '4', 'localhost:8888/i/?26409f98', '1458232629'),
(7, 1, 1, 'elpikos.com/123123', 'c26fb8da', '123123', '2016-03-17 16:39:20', 1, 1, '4', 'localhost:8888/i/?c26fb8da', '1458232760'),
(8, 1, 1, 'elpikos.com/111111', '1ce94919', '111111', '2016-03-17 16:39:20', 1, 1, '4', 'localhost:8888/i/?1ce94919', '1458232760'),
(9, 1, 1, 'elpikos.com/222222', '03cf4589', '222222', '2016-03-17 16:39:20', 1, 1, '4', 'localhost:8888/i/?03cf4589', '1458232760'),
(10, 1, 1, 'elpikos.com/333333', 'cfc4e78b', '333333', '2016-03-17 16:39:20', 1, 1, '4', 'localhost:8888/i/?cfc4e78b', '1458232760'),
(11, 1, 1, 'manterola.mx/123123', '1f083377', '123123', '2016-03-17 16:43:54', 1, 1, '1', 'localhost:8888/i/?1f083377', '1458233034'),
(12, 1, 1, 'manterola.mx/111111', 'd980706f', '111111', '2016-03-17 16:43:54', 1, 1, '1', 'localhost:8888/i/?d980706f', '1458233034'),
(13, 1, 1, 'manterola.mx/222222', '9880aa47', '222222', '2016-03-17 16:43:54', 1, 1, '1', 'localhost:8888/i/?9880aa47', '1458233034'),
(14, 1, 1, 'manterola.mx/333333', '7559d9ad', '333333', '2016-03-17 16:43:54', 1, 1, '1', 'localhost:8888/i/?7559d9ad', '1458233034'),
(15, 1, 1, 'superchamba.com/123123', '5b3fcda1', '123123', '2016-03-17 16:55:50', 1, 1, '2', 'localhost:8888/i/?5b3fcda1', '1458233750'),
(16, 1, 2, 'google.com/111111', 'dac34b1e', '111111', '2016-03-17 16:55:50', 1, 1, '1', 'localhost:8888/i/?dac34b1e', '1458233750'),
(17, 1, 1, 'atabay.mx/222222', '56b83747', '222222', '2016-03-17 16:55:50', 0, 1, '1', 'localhost:8888/i/?56b83747', '1458233750'),
(18, 1, 20, 'otrodominio.com/333333', 'aa0f979a', '333333', '2016-03-17 16:55:50', 1, 1, '4', 'localhost:8888/i/?aa0f979a', '1458233750'),
(19, 1, 1, 'superchamba.com/123123', '3c7f07c5', '123123', '2016-03-17 17:10:25', 1, 1, '2', 'localhost:8888/i/?3c7f07c5', '1458234625'),
(20, 1, 2, 'google.com/111111', 'eba45424', '111111', '2016-03-17 17:10:25', 1, 1, '1', 'localhost:8888/i/?eba45424', '1458234625'),
(21, 1, 1, 'atabay.mx/222222', 'ae69048d', '222222', '2016-03-17 17:10:25', 0, 1, '1', 'localhost:8888/i/?ae69048d', '1458234625'),
(22, 1, 20, 'otrodominio.com/333333', 'd2eaa108', '333333', '2016-03-17 17:10:25', 1, 1, '4', 'localhost:8888/i/?d2eaa108', '1458234625'),
(23, 1, 1, 'superchamba.com/123123', 'a153b3d2', '123123', '2016-03-17 17:11:18', 1, 1, '2', 'localhost:8888/i/?a153b3d2', '1458234678'),
(24, 1, 2, 'google.com/111111', '88be7c2e', '111111', '2016-03-17 17:11:18', 1, 1, '1', 'localhost:8888/i/?88be7c2e', '1458234678'),
(25, 1, 1, 'atabay.mx/222222', '18d42e5f', '222222', '2016-03-17 17:11:18', 0, 1, '1', 'localhost:8888/i/?18d42e5f', '1458234678'),
(26, 1, 20, 'otrodominio.com/333333', '0cb254b1', '333333', '2016-03-17 17:11:18', 1, 1, '4', 'localhost:8888/i/?0cb254b1', '1458234678'),
(27, 1, 1, 'superchamba.com/123123', '5dfabfe6', '123123', '2016-03-17 17:11:53', 1, 1, '2', 'localhost:8888/i/?5dfabfe6', '1458234713'),
(28, 1, 2, 'google.com/111111', 'bdfba669', '111111', '2016-03-17 17:11:53', 1, 1, '1', 'localhost:8888/i/?bdfba669', '1458234713'),
(29, 1, 1, 'atabay.mx/222222', 'cdd9b538', '222222', '2016-03-17 17:11:53', 0, 1, '1', 'localhost:8888/i/?cdd9b538', '1458234713'),
(30, 1, 20, 'otrodominio.com/333333', '5e6e82e2', '333333', '2016-03-17 17:11:53', 1, 1, '4', 'localhost:8888/i/?5e6e82e2', '1458234713'),
(31, 1, 1, 'superchamba.com/123123', 'cfa6dc49', '123123', '2016-03-17 17:12:46', 1, 1, '2', 'localhost:8888/i/?cfa6dc49', '1458234766'),
(32, 1, 2, 'google.com/111111', 'b95637d7', '111111', '2016-03-17 17:12:46', 1, 1, '1', 'localhost:8888/i/?b95637d7', '1458234766'),
(33, 1, 1, 'atabay.mx/222222', '50e5c410', '222222', '2016-03-17 17:12:46', 0, 1, '1', 'localhost:8888/i/?50e5c410', '1458234766'),
(34, 1, 20, 'otrodominio.com/333333', 'c9ba1d36', '333333', '2016-03-17 17:12:46', 1, 1, '4', 'localhost:8888/i/?c9ba1d36', '1458234766'),
(35, 1, 1, 'superchamba.com/123123', '31214b33', '123123', '2016-03-17 17:16:37', 1, 1, '2', 'localhost:8888/i/?31214b33', '1458234997'),
(36, 1, 2, 'google.com/111111', '0ba1f666', '111111', '2016-03-17 17:16:37', 1, 1, '1', 'localhost:8888/i/?0ba1f666', '1458234997'),
(37, 1, 1, 'atabay.mx/222222', '4ccf3665', '222222', '2016-03-17 17:16:37', 0, 1, '1', 'localhost:8888/i/?4ccf3665', '1458234997'),
(38, 1, 20, 'otrodominio.com/333333', '0c0900b0', '333333', '2016-03-17 17:16:37', 1, 1, '4', 'localhost:8888/i/?0c0900b0', '1458234997'),
(39, 1, 1, 'superchamba.com/123123', '9d9700da', '123123', '2016-03-17 17:18:05', 1, 1, '2', 'localhost:8888/i/?9d9700da', '1458235085'),
(40, 1, 2, 'google.com/111111', '1d4c5282', '111111', '2016-03-17 17:18:05', 1, 1, '1', 'localhost:8888/i/?1d4c5282', '1458235085'),
(41, 1, 1, 'atabay.mx/222222', 'a75583ec', '222222', '2016-03-17 17:18:05', 0, 1, '1', 'localhost:8888/i/?a75583ec', '1458235085'),
(42, 1, 20, 'otrodominio.com/333333', '7ef49046', '333333', '2016-03-17 17:18:05', 1, 1, '4', 'localhost:8888/i/?7ef49046', '1458235085'),
(43, 1, 1, 'superchamba.com/123123', '943cb1a5', '123123', '2016-03-17 17:19:33', 1, 1, '2', 'localhost:8888/i/?943cb1a5', '1458235173'),
(44, 1, 2, 'google.com/111111', '4ac589f3', '111111', '2016-03-17 17:19:33', 1, 1, '1', 'localhost:8888/i/?4ac589f3', '1458235173'),
(45, 1, 1, 'atabay.mx/222222', 'e5ca1cc1', '222222', '2016-03-17 17:19:33', 0, 1, '1', 'localhost:8888/i/?e5ca1cc1', '1458235173'),
(46, 1, 20, 'otrodominio.com/333333', '8291b807', '333333', '2016-03-17 17:19:33', 1, 1, '4', 'localhost:8888/i/?8291b807', '1458235173'),
(47, 1, 1, 'superchamba.com/123123', 'd17c211e', '123123', '2016-03-17 17:20:10', 1, 1, '2', 'localhost:8888/i/?d17c211e', '1458235210'),
(48, 1, 2, 'google.com/111111', 'c07db665', '111111', '2016-03-17 17:20:10', 1, 1, '1', 'localhost:8888/i/?c07db665', '1458235210'),
(49, 1, 1, 'atabay.mx/222222', '9799221b', '222222', '2016-03-17 17:20:10', 0, 1, '1', 'localhost:8888/i/?9799221b', '1458235210'),
(50, 1, 20, 'otrodominio.com/333333', 'bf3e4041', '333333', '2016-03-17 17:20:10', 1, 1, '4', 'localhost:8888/i/?bf3e4041', '1458235210'),
(51, 1, 1, 'superchamba.com/123123', 'e0747929', '123123', '2016-03-17 17:24:51', 1, 1, '2', 'localhost:8888/i/?e0747929', '1458235491'),
(52, 1, 2, 'google.com/111111', 'feeaffa1', '111111', '2016-03-17 17:24:51', 1, 1, '1', 'localhost:8888/i/?feeaffa1', '1458235491'),
(53, 1, 1, 'atabay.mx/222222', 'b06f9c01', '222222', '2016-03-17 17:24:51', 0, 1, '1', 'localhost:8888/i/?b06f9c01', '1458235491'),
(54, 1, 20, 'otrodominio.com/333333', '68727e05', '333333', '2016-03-17 17:24:51', 1, 1, '4', 'localhost:8888/i/?68727e05', '1458235491'),
(55, 1, 1, 'superchamba.com/123123', '8246b550', '123123', '2016-03-17 18:05:43', 1, 1, '2', 'localhost:8888/i/?8246b550', '1458237943'),
(56, 1, 2, 'google.com/111111', '6814c3c8', '111111', '2016-03-17 18:05:43', 1, 1, '1', 'localhost:8888/i/?6814c3c8', '1458237943'),
(57, 1, 1, 'atabay.mx/222222', 'f528869d', '222222', '2016-03-17 18:05:43', 0, 1, '1', 'localhost:8888/i/?f528869d', '1458237943'),
(58, 1, 20, 'otrodominio.com/333333', 'd57101fd', '333333', '2016-03-17 18:05:43', 1, 1, '4', 'localhost:8888/i/?d57101fd', '1458237943'),
(59, NULL, 1, 'zs', 'xs', NULL, '2016-03-17 18:14:20', 0, 1, '', NULL, NULL),
(60, NULL, 1, 'zsxs', 'xsxxs', NULL, '2016-03-17 18:14:27', 0, 1, '', NULL, NULL),
(61, NULL, 1, 'zsxsxsxs', 'bsvcjbdvc', NULL, '2016-03-17 18:14:35', 0, 1, '', NULL, NULL),
(62, NULL, 1, 'zsxsxsxs', '6a4979ef', NULL, '2016-03-17 18:14:49', 0, 1, '', NULL, NULL),
(63, NULL, 1, 'elpikos.com', 'e14be2fb', NULL, '2016-03-17 18:15:33', 0, 1, '', NULL, NULL),
(64, NULL, 1, 'alias.com', '1ebba82e', NULL, '2016-03-17 18:20:54', 0, 1, '', NULL, NULL),
(65, NULL, 1, 'lomismo.com', 'jsnxcscd', NULL, '2016-03-17 18:24:07', 0, 1, '', NULL, NULL),
(66, NULL, 1, 'qxqxqs', '43c3fac9', NULL, '2016-03-17 18:30:21', 0, 1, '', NULL, NULL),
(67, NULL, 1, 'lomismo.com', 'c8b0c196', NULL, '2016-03-17 18:31:47', 0, 1, '', NULL, NULL),
(68, NULL, 1, 'elpikos.com', '9e4cc133', NULL, '2016-03-17 18:34:26', 0, 1, '', NULL, NULL),
(69, 1, 1, 'superchamba.com/123123', '9b3409d6', '123123', '2016-03-17 20:23:44', 1, 1, '2', 'localhost:8888/i/?9b3409d6', '1458246224'),
(70, 1, 2, 'google.com/111111', '943bb846', '111111', '2016-03-17 20:23:44', 1, 1, '1', 'localhost:8888/i/?943bb846', '1458246224'),
(71, 1, 1, 'atabay.mx/222222', '2d3e48e8', '222222', '2016-03-17 20:23:44', 0, 1, '1', 'localhost:8888/i/?2d3e48e8', '1458246224'),
(72, 1, 20, 'otrodominio.com/333333', '65888786', '333333', '2016-03-17 20:23:44', 1, 1, '4', 'localhost:8888/i/?65888786', '1458246224'),
(73, 1, 1, 'lnk.cool/index.php', '38a40779', 'index.php', '2016-03-17 21:37:23', 1, 1, '54', 'localhost:8888/i/?38a40779', '1458250643'),
(74, 1, 1, 'lnk.cool/index.php', '7b0c8938', 'index.php', '2016-03-17 21:42:29', 1, 1, '54', 'localhost:8888/i/?7b0c8938', '1458250949');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permisos_en_rol`
--

CREATE TABLE `permisos_en_rol` (
`id` smallint(5) unsigned NOT NULL,
  `id_rol` smallint(5) unsigned NOT NULL,
  `id_permiso` smallint(5) unsigned NOT NULL,
  `vigente` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1 COMMENT='El id del rol en roles';

--
-- Volcado de datos para la tabla `permisos_en_rol`
--

INSERT INTO `permisos_en_rol` (`id`, `id_rol`, `id_permiso`, `vigente`) VALUES
(1, 1, 1, 1),
(2, 1, 2, 1),
(3, 1, 3, 1),
(4, 1, 4, 1),
(5, 1, 5, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
`id` smallint(5) unsigned NOT NULL,
  `nombre` varchar(20) NOT NULL,
  `abrev` varchar(10) NOT NULL,
  `activo` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id`, `nombre`, `abrev`, `activo`) VALUES
(1, 'Superusuario', 'root', 1),
(2, 'Usuario registrado', 'registUser', 1),
(3, 'Usuario de carga', 'loadUser', 1),
(4, 'Usuario premium', 'premiumUsr', 1),
(5, 'Administrador de Usu', 'usersAdmin', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
`id` smallint(5) unsigned NOT NULL,
  `username` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `password` char(64) NOT NULL DEFAULT '1234567890123456789012345678901234567890123456789012345678901234',
  `firstName` varchar(50) NOT NULL,
  `lastName` varchar(50) NOT NULL,
  `dob` date NOT NULL,
  `email` varchar(100) NOT NULL,
  `id_role` smallint(5) unsigned NOT NULL DEFAULT '2',
  `active` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `users`
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
(22, 'david@manterola.mx', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 'David', 'Manterola', '0000-00-00', 'david@manterola.mx', 2, 1),
(23, 'pikos@manterola.com', '96cae35ce8a9b0244178bf28e4966c2ce1b8385723a96a6b838858cdd6ca0a1e', 'Pikos', 'Manterola', '0000-00-00', 'pikos@manterola.com', 2, 1),
(24, 'pikosmanterola@manterola.mx', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 'David', 'Manterola', '0000-00-00', 'pikosmanterola@manterola.mx', 2, 1),
(25, 'pikos@manterola.mx', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 'david', 'manterola', '0000-00-00', 'pikos@manterola.mx', 2, 1),
(26, '123@manterola.com', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 'David ', 'Manterola ', '0000-00-00', '123@manterola.com', 2, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `visitas`
--

CREATE TABLE `visitas` (
`id` bigint(20) unsigned NOT NULL,
  `ip` varchar(15) NOT NULL,
  `user_agent` varchar(200) DEFAULT NULL,
  `browser` varchar(50) DEFAULT NULL,
  `sisop` varchar(50) DEFAULT NULL,
  `id_enlace` bigint(20) unsigned NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=68 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `visitas`
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
(55, '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_10_1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/48.0.2564.116 Safari/537.36', NULL, NULL, 79, '2016-03-16 01:29:18'),
(56, '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_10_1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/48.0.2564.116 Safari/537.36', NULL, NULL, 2, '2016-03-17 16:27:52'),
(57, '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_10_1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/48.0.2564.116 Safari/537.36', NULL, NULL, 3, '2016-03-17 16:37:24'),
(58, '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_10_1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/48.0.2564.116 Safari/537.36', NULL, NULL, 4, '2016-03-17 16:37:36'),
(59, '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_10_1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/48.0.2564.116 Safari/537.36', NULL, NULL, 6, '2016-03-17 16:37:59'),
(60, '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_10_1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/48.0.2564.116 Safari/537.36', NULL, NULL, 7, '2016-03-17 16:39:29'),
(61, '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_10_1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/48.0.2564.116 Safari/537.36', NULL, NULL, 8, '2016-03-17 16:39:41'),
(62, '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_10_1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/48.0.2564.116 Safari/537.36', NULL, NULL, 9, '2016-03-17 16:39:50'),
(63, '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_10_1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/48.0.2564.116 Safari/537.36', NULL, NULL, 10, '2016-03-17 16:40:01'),
(64, '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_10_1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/48.0.2564.116 Safari/537.36', NULL, NULL, 11, '2016-03-17 16:44:07'),
(65, '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_10_1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/48.0.2564.116 Safari/537.36', NULL, NULL, 12, '2016-03-17 16:44:21'),
(66, '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_10_1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/48.0.2564.116 Safari/537.36', NULL, NULL, 13, '2016-03-17 16:45:38'),
(67, '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_10_1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/48.0.2564.116 Safari/537.36', NULL, NULL, 14, '2016-03-17 16:52:46');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cat_categories`
--
ALTER TABLE `cat_categories`
 ADD PRIMARY KEY (`id_category`), ADD UNIQUE KEY `id_category` (`id_category`), ADD UNIQUE KEY `category` (`category`);

--
-- Indices de la tabla `cat_permiso`
--
ALTER TABLE `cat_permiso`
 ADD PRIMARY KEY (`clave`);

--
-- Indices de la tabla `cat_protocolo`
--
ALTER TABLE `cat_protocolo`
 ADD PRIMARY KEY (`clave`);

--
-- Indices de la tabla `enlaces`
--
ALTER TABLE `enlaces`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `hash_uniq` (`hash`), ADD KEY `cve_protocolo` (`cve_protocolo`), ADD KEY `id_user` (`id_user`);

--
-- Indices de la tabla `permisos_en_rol`
--
ALTER TABLE `permisos_en_rol`
 ADD PRIMARY KEY (`id`), ADD KEY `id_rol` (`id_rol`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `username` (`username`), ADD KEY `id_rol` (`id_role`);

--
-- Indices de la tabla `visitas`
--
ALTER TABLE `visitas`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cat_categories`
--
ALTER TABLE `cat_categories`
MODIFY `id_category` tinyint(25) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=57;
--
-- AUTO_INCREMENT de la tabla `cat_permiso`
--
ALTER TABLE `cat_permiso`
MODIFY `clave` smallint(6) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de la tabla `cat_protocolo`
--
ALTER TABLE `cat_protocolo`
MODIFY `clave` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT de la tabla `enlaces`
--
ALTER TABLE `enlaces`
MODIFY `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=75;
--
-- AUTO_INCREMENT de la tabla `permisos_en_rol`
--
ALTER TABLE `permisos_en_rol`
MODIFY `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
MODIFY `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
MODIFY `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=27;
--
-- AUTO_INCREMENT de la tabla `visitas`
--
ALTER TABLE `visitas`
MODIFY `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=68;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `enlaces`
--
ALTER TABLE `enlaces`
ADD CONSTRAINT `fk_cve_prot` FOREIGN KEY (`cve_protocolo`) REFERENCES `cat_protocolo` (`clave`);

--
-- Filtros para la tabla `users`
--
ALTER TABLE `users`
ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`id_role`) REFERENCES `roles` (`id`);
