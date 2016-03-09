-- phpMyAdmin SQL Dump
-- version 4.2.10
-- http://www.phpmyadmin.net
--
-- Servidor: localhost:8889
-- Tiempo de generación: 09-03-2016 a las 16:59:00
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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `cat_categories`
--

INSERT INTO `cat_categories` (`id_category`, `category`, `id_user`, `active`) VALUES
(1, 'Campaña Navideña', 1, 1),
(2, 'Campaña newsletter', 1, 1),
(3, 'Campaña de promociones', 2, 1);

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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `cat_protocolo`
--

INSERT INTO `cat_protocolo` (`clave`, `descripcion`, `html`, `edo_reg`) VALUES
(1, 'HTTP', NULL, 1),
(2, 'HTTPS', NULL, 1),
(3, 'OTRO', NULL, 1),
(4, 'FTP', NULL, 1),
(5, 'GIT', NULL, 0),
(6, 'FTPS', NULL, 1),
(7, 'Ã±Ã±Ã±', NULL, 1);

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
  `code` varchar(600) CHARACTER SET utf8 NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `seLogea` tinyint(1) NOT NULL DEFAULT '0',
  `activo` tinyint(1) NOT NULL DEFAULT '1',
  `id_category` varchar(600) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `enlaces`
--

INSERT INTO `enlaces` (`id`, `id_user`, `cve_protocolo`, `url`, `hash`, `code`, `created`, `seLogea`, `activo`, `id_category`) VALUES
(1, 1, 6, 'ftps://elmismourl.mx/123123', '5b94a2c6', '123123', '2016-03-09 04:28:52', 1, 1, '1'),
(2, 1, 6, 'ftps://elmismourl.mx/111111', '9e2b8a3f', '111111', '2016-03-09 04:28:52', 1, 1, '2'),
(3, 1, 6, 'ftps://elmismourl.mx/222222', '7ada7158', '222222', '2016-03-09 04:28:52', 1, 1, '2'),
(4, 1, 6, 'ftps://elmismourl.mx/333333', '245e4948', '333333', '2016-03-09 04:28:52', 1, 1, '1'),
(5, NULL, 2, 'urlmismo.com', '479a73ad', '', '2016-03-09 06:03:10', 0, 1, NULL),
(6, 1, 1, 'http://loquesea.com/123123', 'ce26ad40', '123123', '2016-03-09 07:00:54', 1, 1, NULL),
(7, 1, 2, 'https://google.com/111111', '9c8dd063', '111111', '2016-03-09 07:00:54', 1, 1, NULL),
(8, 1, 4, 'ftp://atabay.mx/222222', 'be48da83', '222222', '2016-03-09 07:00:54', 1, 1, NULL),
(9, 1, 1, 'http://otrodominio.com/333333', 'b0473dd4', '333333', '2016-03-09 07:00:54', 1, 1, NULL),
(10, 1, 7, 'laurl.com', 'b5de50a0', '', '2016-03-09 14:35:46', 0, 1, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permisos_en_rol`
--

CREATE TABLE `permisos_en_rol` (
`id` smallint(5) unsigned NOT NULL,
  `id_rol` smallint(5) unsigned NOT NULL,
  `id_permiso` smallint(5) unsigned NOT NULL,
  `vigente` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COMMENT='El id del rol en roles';

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
  `username` varchar(15) NOT NULL,
  `password` char(64) NOT NULL DEFAULT '1234567890123456789012345678901234567890123456789012345678901234',
  `firstName` varchar(50) NOT NULL,
  `lastName` varchar(50) NOT NULL,
  `dob` date NOT NULL,
  `email` varchar(100) NOT NULL,
  `id_role` smallint(5) unsigned NOT NULL DEFAULT '2',
  `active` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `firstName`, `lastName`, `dob`, `email`, `id_role`, `active`) VALUES
(1, 'admin', '240be518fabd2724ddb6f04eeb1da5967448d7e831c08c8fa822809f74c720a9', 'Administrador', 'de MiniURL', '2016-03-01', 'admin@mi.ni', 1, 1),
(2, 'usuario1', '1234567890123456789012345678901234567890123456789012345678901234', 'Usua', 'Rio Uno', '2013-11-09', 'usuario1@usuari.os', 2, 1);

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
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=latin1;

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
(45, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:44.0) Gecko/20100101 Firefox/44.0', '', '', 29, '2016-03-01 21:14:06');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cat_categories`
--
ALTER TABLE `cat_categories`
 ADD PRIMARY KEY (`id_category`);

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
MODIFY `id_category` tinyint(25) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `cat_permiso`
--
ALTER TABLE `cat_permiso`
MODIFY `clave` smallint(6) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de la tabla `cat_protocolo`
--
ALTER TABLE `cat_protocolo`
MODIFY `clave` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT de la tabla `enlaces`
--
ALTER TABLE `enlaces`
MODIFY `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
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
MODIFY `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `visitas`
--
ALTER TABLE `visitas`
MODIFY `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=46;
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
