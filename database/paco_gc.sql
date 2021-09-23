-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 23-09-2021 a las 05:43:24
-- Versión del servidor: 10.4.20-MariaDB
-- Versión de PHP: 7.4.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `paco_gc`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `organizaciones`
--

CREATE TABLE `organizaciones` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `nombre` varchar(500) NOT NULL,
  `nit` varchar(100) NOT NULL,
  `sigla` varchar(100) NOT NULL,
  `linea_productiva_id` int(11) NOT NULL,
  `latitud` decimal(11,8) NOT NULL,
  `longitud` decimal(11,8) NOT NULL,
  `direccion` varchar(100) NOT NULL,
  `departamento` varchar(100) NOT NULL,
  `municipio` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `telefono` varchar(100) NOT NULL,
  `correo` varchar(100) NOT NULL,
  `total_asociados` int(100) NOT NULL,
  `fecha_constitucion` varchar(100) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `organizaciones`
--

INSERT INTO `organizaciones` (`id`, `usuario_id`, `nombre`, `nit`, `sigla`, `linea_productiva_id`, `latitud`, `longitud`, `direccion`, `departamento`, `municipio`, `telefono`, `correo`, `total_asociados`, `fecha_constitucion`, `created_at`, `updated_at`) VALUES
(1, 1, 'PARA OPCIONES', '012345789', 'PO', 4, '234.00000000', '-125.00000000', 'Cra 30 Calle 34', '66', '66001', '31000000', 'orgcultivos@gmail.com', 10, '2021-06-22T05:00:00.000Z', '2021-06-23 01:44:25', '2021-09-23 03:42:52'),
(20, 2, 'ORG CULTIVOS', '55555763', 'ORGC', 5, '234.00000000', '-125.00000000', 'Calle 34', '66', '66001', '31000000', 'orgcultivos@gmail.com', 10, '2021-06-22T05:00:00.000Z', '2021-06-23 01:44:25', '2021-09-23 03:42:59'),
(21, NULL, 'ORGANIZA', '12345', 'GAN', 7, '234.00000000', '234.00000000', 'cALLE23', '66', '66045', '31854524223', 'NDFN@GMAIL.COM', 5454, '2021-07-29T05:00:00.000Z', '2021-07-30 02:54:10', '2021-09-23 03:42:42'),
(22, NULL, 'Prueba  Final', '660005554443', 'PF', 6, '4.34232140', '79.48653200', 'Cra 21 Calle 24', '66', '66045', '31232123', 'pruebafinl@gmail.com', 3, '2021-09-22T05:00:00.000Z', '2021-09-23 03:42:12', '2021-09-23 03:42:12');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `organizaciones`
--
ALTER TABLE `organizaciones`
  ADD PRIMARY KEY (`id`),
  ADD KEY `departamento` (`departamento`),
  ADD KEY `municipio` (`municipio`),
  ADD KEY `usuario_id` (`usuario_id`),
  ADD KEY `linea_productiva_id` (`linea_productiva_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `organizaciones`
--
ALTER TABLE `organizaciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
