-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 22-12-2020 a las 03:20:17
-- Versión del servidor: 10.4.11-MariaDB
-- Versión de PHP: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `efiagro`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `articulos`
--

CREATE TABLE `articulos` (
  `id` int(10) NOT NULL,
  `titulo` varchar(1000) NOT NULL,
  `palabras_clave` varchar(1000) DEFAULT NULL,
  `estado` varchar(50) NOT NULL,
  `permisos` varchar(1000) DEFAULT NULL,
  `usuario_id` int(10) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `articulos`
--

INSERT INTO `articulos` (`id`, `titulo`, `palabras_clave`, `estado`, `permisos`, `usuario_id`, `created_at`, `updated_at`) VALUES
(1, '5 formas de evitar la roya en su cultivo', NULL, 'Activo', '', 1, '0000-00-00 00:00:00', '2020-11-20 22:46:03'),
(2, 'Ultimas guias de la OMS para el cuidado de sus vacas', '', 'Activo', '', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 'Mauris dapibus non nisi ac condimentum. Morbi tempus dui lacus, vel tempus sem bibendum vel. Nulla neque augue, malesuada ac turpis pharetra, pellentesque imperdiet lorem. Nulla ligula est, consectetur vitae ante tempus, hendrerit sagittis ex. Nulla nec quam feugiat, finibus.', '', 'Activo', '', 2, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, '3 nuevas semillas de platano', NULL, 'Activo', NULL, 1, '2020-11-20 01:52:22', '2020-11-20 01:52:22');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `articulos_secciones`
--

CREATE TABLE `articulos_secciones` (
  `id` int(10) NOT NULL,
  `articulo_id` int(10) NOT NULL,
  `tipo` varchar(50) NOT NULL,
  `contenido` text DEFAULT NULL,
  `ruta` varchar(1000) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `articulos_secciones`
--

INSERT INTO `articulos_secciones` (`id`, `articulo_id`, `tipo`, `contenido`, `ruta`, `created_at`, `updated_at`) VALUES
(15, 4, 'Imagen', NULL, 'files/articulos_media/4/20201214223028.jpg', '2020-12-15 03:30:44', '2020-12-15 03:30:44'),
(20, 1, 'Tabla', '[[\"Uno\",\"Dos\",\"Tres\"],[1,2,3],[4,5,6],[7,8,9]]', NULL, '2020-12-16 23:01:30', '2020-12-16 23:01:30'),
(21, 4, 'Parrafo', 'Este es un texto de prueba.', NULL, '2020-12-19 13:47:05', '2020-12-22 01:30:06'),
(22, 4, 'Tabla', '[[\"Uno\",\"Dos\",\"Tres\"],[1,2,3],[4,5,6],[7,8,9]]', NULL, '2020-12-19 13:47:12', '2020-12-19 13:47:12'),
(23, 1, 'Parrafo', NULL, NULL, '2020-12-22 01:24:06', '2020-12-22 01:27:43');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `casos`
--

CREATE TABLE `casos` (
  `id` int(11) NOT NULL,
  `solicitante_id` int(11) DEFAULT NULL,
  `titulo` varchar(500) NOT NULL,
  `tipo` varchar(100) NOT NULL,
  `asignados` varchar(1000) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `casos`
--

INSERT INTO `casos` (`id`, `solicitante_id`, `titulo`, `tipo`, `asignados`, `created_at`, `updated_at`) VALUES
(1, 1, 'Como se maneja esto', 'Consulta General', '[]', '2020-12-22 02:13:35', '2020-12-22 02:13:35');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `secciones`
--

CREATE TABLE `secciones` (
  `id` int(10) NOT NULL,
  `seccion` varchar(100) NOT NULL,
  `subseccion` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `secciones`
--

INSERT INTO `secciones` (`id`, `seccion`, `subseccion`, `created_at`, `updated_at`) VALUES
(1, 'Mi Técnico Amigo', 'Mi Técnico Amigo', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 'Gestión Organización', 'Organización', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 'Gestión Organización', 'Usuarios', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 'Gestión Organización', 'Productores', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5, 'Mi Finca', 'Mi Finca', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(6, 'Administración General', 'Artículos', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(10) NOT NULL,
  `nombres` varchar(100) NOT NULL,
  `apellidos` varchar(100) NOT NULL,
  `cedula` varchar(100) NOT NULL,
  `correo` varchar(100) NOT NULL,
  `asociacion_id` int(10) DEFAULT NULL,
  `finca_id` int(10) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombres`, `apellidos`, `cedula`, `correo`, `asociacion_id`, `finca_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Christian Alejandro', 'Orrego Herrera', '1093217141', 'info@mbrain.co', NULL, NULL, '0000-00-00 00:00:00', '2020-11-20 01:09:56', NULL),
(2, 'Miguel', 'Herrera', '999', 'miguel@agregandovalor.com', NULL, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(3, 'Pepito', 'Perez', '1093217142', 'pepito@mbrain.co', NULL, NULL, '2020-11-18 23:02:36', '2020-11-20 01:17:18', '2020-11-20 01:17:18');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `articulos`
--
ALTER TABLE `articulos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `articulos_secciones`
--
ALTER TABLE `articulos_secciones`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `casos`
--
ALTER TABLE `casos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `secciones`
--
ALTER TABLE `secciones`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `articulos`
--
ALTER TABLE `articulos`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `articulos_secciones`
--
ALTER TABLE `articulos_secciones`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT de la tabla `casos`
--
ALTER TABLE `casos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `secciones`
--
ALTER TABLE `secciones`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
