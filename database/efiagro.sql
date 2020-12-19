-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 20-11-2020 a las 03:05:04
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
(1, '5 formas de evitar la roya en su cultivo', '', 'A', '', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 'Ultimas guias de la OMS para el cuidado de sus vacas', '', 'A', '', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 'Mauris dapibus non nisi ac condimentum. Morbi tempus dui lacus, vel tempus sem bibendum vel. Nulla neque augue, malesuada ac turpis pharetra, pellentesque imperdiet lorem. Nulla ligula est, consectetur vitae ante tempus, hendrerit sagittis ex. Nulla nec quam feugiat, finibus.', '', 'A', '', 2, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, '3 nuevas semillas de platano', NULL, 'Borrador', NULL, 1, '2020-11-20 01:52:22', '2020-11-20 01:52:22');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `articulos_secciones`
--

CREATE TABLE `articulos_secciones` (
  `id` int(10) NOT NULL,
  `articulo_id` int(10) NOT NULL,
  `tipo` varchar(50) NOT NULL,
  `contenido` text NOT NULL,
  `ruta` varchar(1000) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `articulos_secciones`
--

INSERT INTO `articulos_secciones` (`id`, `articulo_id`, `tipo`, `contenido`, `ruta`, `created_at`, `updated_at`) VALUES
(1, 1, 'Parrafo', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. In tempor augue nulla, sed maximus quam faucibus vitae. Cras ullamcorper dictum dignissim. Mauris viverra turpis et massa egestas maximus. Etiam rhoncus ultrices sodales. Ut dapibus, est sed feugiat pharetra, lectus nisi tristique velit, non faucibus est augue a mi. Sed viverra sapien elit, id convallis libero porttitor quis. Aliquam vitae semper ipsum.', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 1, 'Parrafo', 'Curabitur fermentum, nulla eu aliquet commodo, eros arcu lacinia ex, eu mattis ex diam eget neque. Ut auctor, enim vel congue tincidunt, nunc lacus eleifend turpis, vel porta elit dolor id odio. Ut sit amet aliquam elit. Quisque ornare condimentum tincidunt. Quisque feugiat leo quam, ut blandit velit commodo eu. Fusce vulputate mauris eget nisl dapibus lobortis. Quisque a mauris gravida enim gravida posuere et sit amet nunc. Quisque quis turpis ac nibh tincidunt pulvinar. Donec ac enim non turpis semper posuere vitae in urna. Suspendisse potenti. Aliquam congue justo non eros ultricies lacinia.', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

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
(6, 'Gestión Organización', 'Artículos', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

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
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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