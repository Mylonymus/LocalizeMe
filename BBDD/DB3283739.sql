-- phpMyAdmin SQL Dump
-- version 4.2.12
-- http://www.phpmyadmin.net
--
-- Servidor: rdbms
-- Tiempo de generación: 09-03-2018 a las 20:49:47
-- Versión del servidor: 5.6.37-log
-- Versión de PHP: 5.5.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `DB3283739`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `configuracion_global`
--

CREATE TABLE IF NOT EXISTS `configuracion_global` (
`id_app` int(11) NOT NULL,
  `nombre` varchar(255) COLLATE utf8_bin NOT NULL,
  `fase_beta` tinyint(1) NOT NULL,
  `numero_maximo_usuarios` int(8) NOT NULL,
  `registro_usuarios` tinyint(1) NOT NULL,
  `creacion_grupos` tinyint(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `configuracion_global`
--

INSERT INTO `configuracion_global` (`id_app`, `nombre`, `fase_beta`, `numero_maximo_usuarios`, `registro_usuarios`, `creacion_grupos`) VALUES
(1, 'LocalizeMe', 1, 500, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupos`
--

CREATE TABLE IF NOT EXISTS `grupos` (
`id` int(11) NOT NULL,
  `nombre` varchar(255) COLLATE utf8_bin NOT NULL,
  `avatar` varchar(255) COLLATE utf8_bin NOT NULL,
  `estado` tinyint(3) NOT NULL,
  `fecha_creacion` datetime NOT NULL,
  `id_admin` int(11) NOT NULL,
  `restringido` tinyint(1) NOT NULL,
  `password` varchar(255) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `grupos`
--

INSERT INTO `grupos` (`id`, `nombre`, `avatar`, `estado`, `fecha_creacion`, `id_admin`, `restringido`, `password`) VALUES
(1, 'Testing (3 Usuarios)', '', 0, '2018-03-01 00:00:00', 1, 0, ''),
(2, 'Casa', '', 1, '2018-03-01 00:00:00', 2, 0, ''),
(3, 'Bigpyx', '', 1, '2018-03-01 00:00:00', 1, 0, 'prueba'),
(4, 'Testing (4 Usuarios)', '', 1, '2018-03-01 00:00:00', 1, 0, ''),
(5, 'Testing (5 Usuarios)', '', 1, '2018-03-01 00:00:00', 1, 0, ''),
(10, 'Testing Controlado', '', 1, '2018-03-01 00:00:00', 1, 0, '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupos_usuarios`
--

CREATE TABLE IF NOT EXISTS `grupos_usuarios` (
  `id_grupo` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `estado` tinyint(3) NOT NULL,
  `fecha_creacion` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `grupos_usuarios`
--

INSERT INTO `grupos_usuarios` (`id_grupo`, `id_usuario`, `estado`, `fecha_creacion`) VALUES
(0, 0, 0, '0000-00-00 00:00:00'),
(1, 1, 1, '2018-02-27 00:00:00'),
(1, 2, 1, '2018-02-27 00:00:00'),
(1, 3, 1, '2018-02-27 00:00:00'),
(2, 1, 1, '2018-02-27 00:00:00'),
(2, 3, 1, '2018-02-27 00:00:00'),
(2, 6, 1, '2018-03-06 00:00:00'),
(3, 1, 1, '2018-02-27 00:00:00'),
(3, 4, 1, '2018-02-27 00:00:00'),
(3, 7, 1, '2018-03-06 00:00:00'),
(3, 12, 1, '2018-03-08 18:30:32');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `invitaciones`
--

CREATE TABLE IF NOT EXISTS `invitaciones` (
`id` int(11) NOT NULL,
  `id_usuario_admin` int(11) NOT NULL,
  `id_grupo` int(11) NOT NULL,
  `id_usuario_invitado` int(11) NOT NULL,
  `estado` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `posiciones`
--

CREATE TABLE IF NOT EXISTS `posiciones` (
  `id_usuario` int(11) NOT NULL,
  `id_grupo` int(11) NOT NULL,
  `latitud` float NOT NULL,
  `longitud` float NOT NULL,
  `fecha_posicion` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `posiciones`
--

INSERT INTO `posiciones` (`id_usuario`, `id_grupo`, `latitud`, `longitud`, `fecha_posicion`) VALUES
(1, 1, 37.673, -4.72693, '2018-03-08 20:47:19'),
(1, 2, 37.673, -4.72691, '2018-03-09 15:46:39'),
(1, 3, 37.673, -4.72692, '2018-03-09 15:45:59'),
(1, 11, 37.673, -4.72694, '2018-03-08 20:47:13'),
(2, 1, 37.6731, -4.72689, '2018-03-08 22:20:23'),
(2, 2, 3123120000, -5.02002, '2018-03-05 11:34:24'),
(3, 2, 37.6729, -4.72705, '2018-03-07 00:38:11'),
(4, 3, 37.3933, -6.002, '2018-03-06 21:52:20'),
(6, 2, 37.8701, -4.79101, '2018-03-07 00:50:53'),
(12, 3, 37.6673, -4.72399, '2018-03-08 18:54:25');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE IF NOT EXISTS `usuarios` (
`id` int(11) NOT NULL,
  `nombre` varchar(255) CHARACTER SET utf8 NOT NULL,
  `apellidos` varchar(255) CHARACTER SET utf8 NOT NULL,
  `email` varchar(255) CHARACTER SET utf8 NOT NULL,
  `login` varchar(120) CHARACTER SET utf8 NOT NULL,
  `password` varchar(255) CHARACTER SET utf8 NOT NULL,
  `fecha_creacion` datetime NOT NULL,
  `activado` tinyint(3) NOT NULL,
  `bloqueado` tinyint(3) NOT NULL,
  `estado` tinyint(3) NOT NULL,
  `idioma` varchar(5) CHARACTER SET utf8 NOT NULL,
  `avatar` varchar(255) CHARACTER SET utf8 NOT NULL,
  `ultima_conexion` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `apellidos`, `email`, `login`, `password`, `fecha_creacion`, `activado`, `bloqueado`, `estado`, `idioma`, `avatar`, `ultima_conexion`) VALUES
(1, 'José', 'Vázquez Membrillo', 'mylo@bigpyx.com', 'mylo@bigpyx.com', 'c93ccd78b2076528346216b3b2f701e6', '2018-02-23 19:00:00', 1, 0, 1, 'es_ES', 'http://position.es/Imagenes/JV.JPG', '2018-02-23 18:00:00'),
(2, 'Test', 'Cuenta de pruebas', 'test@bigpyx.com', 'test@bigpyx.com', 'c93ccd78b2076528346216b3b2f701e6', '2018-02-27 10:24:17', 1, 0, 1, 'es_ES', '', '2018-02-27 10:24:17'),
(3, 'Yeymi', 'Bueno Estrella', 'ybueno@bigpyx.com', 'ybueno@bigpyx.com', 'c93ccd78b2076528346216b3b2f701e6', '2018-02-26 00:00:00', 1, 0, 1, 'es_ES', '', '2018-02-25 00:00:00'),
(4, 'Juan José', 'Moreno García', 'design@bigpyx.com', 'design@bigpyx.com', 'c93ccd78b2076528346216b3b2f701e6', '2018-02-26 00:00:00', 1, 0, 1, 'es_ES', '', '2018-02-25 00:00:00'),
(6, 'José', 'Vázquez Solórzano', 'arsaquillo2001@yahoo.es', 'arsaquillo2001@yahoo.es', '362d786a2a3495b0e93f15bd52e9fec0', '2018-03-06 00:00:00', 1, 0, 1, 'es_ES', '', '2018-03-06 00:00:00'),
(7, 'Jaime', 'Oliva Guijarro', 'jaime.oliva@novinfor.es', 'jaime.oliva@novinfor.es', '7434fafe9980dfc097fb979ba9e14812', '2018-03-06 00:00:00', 1, 0, 1, 'es_ES', '', '2018-03-06 00:00:00'),
(11, 'Jaime', 'Moreno García', 'jaime41@hotmail.com', 'jaime41@hotmail.com', '9a9c933853ec22a209c7cb6cb04ebee8', '2018-03-07 17:32:10', 1, 0, 1, 'es_ES', '', '2018-03-07 17:32:10'),
(12, 'Jarr', 'iero', 'joseantoniogarciaariza@gmail.com', 'joseantoniogarciaariza@gmail.com', '19f6bd79157d401370be2e65e21c951c', '2018-03-08 00:00:00', 1, 0, 1, 'es_ES', '', '2018-03-07 00:00:00');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `configuracion_global`
--
ALTER TABLE `configuracion_global`
 ADD PRIMARY KEY (`id_app`);

--
-- Indices de la tabla `grupos`
--
ALTER TABLE `grupos`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `grupos_usuarios`
--
ALTER TABLE `grupos_usuarios`
 ADD PRIMARY KEY (`id_grupo`,`id_usuario`);

--
-- Indices de la tabla `invitaciones`
--
ALTER TABLE `invitaciones`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `posiciones`
--
ALTER TABLE `posiciones`
 ADD PRIMARY KEY (`id_usuario`,`id_grupo`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `configuracion_global`
--
ALTER TABLE `configuracion_global`
MODIFY `id_app` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `grupos`
--
ALTER TABLE `grupos`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT de la tabla `invitaciones`
--
ALTER TABLE `invitaciones`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
