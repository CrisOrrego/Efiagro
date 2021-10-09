-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 09-10-2021 a las 03:15:01
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
-- Estructura de tabla para la tabla `reps__filters`
--

CREATE TABLE `reps__filters` (
  `id` int(10) UNSIGNED NOT NULL,
  `Informe_id` int(11) NOT NULL,
  `Type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Desc` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Pattern` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Default` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Options` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `reps__filters`
--

INSERT INTO `reps__filters` (`id`, `Informe_id`, `Type`, `Name`, `Desc`, `Pattern`, `Default`, `Options`, `created_at`, `updated_at`) VALUES
(1, 1, 'Date', 'DateIni', 'Desde', '0_d_S', NULL, NULL, NULL, NULL),
(2, 1, 'Date', 'DateFin', 'Hasta', '0_d_.', NULL, NULL, NULL, NULL),
(3, 2, 'Date', 'DateFin', 'Corte', '0_d_.', NULL, NULL, NULL, NULL),
(4, 3, 'Date', 'DateIni', 'Desde', '0_d_S', NULL, NULL, NULL, NULL),
(5, 3, 'Date', 'DateFin', 'Hasta', '0_d_.', NULL, NULL, NULL, NULL),
(6, 3, 'Select', 'Modo', 'Modo', 'Resumen|Completo', 'Resumen', NULL, NULL, NULL),
(7, 4, 'Date', 'DateIni', 'Desde', '-12_M_S', NULL, NULL, NULL, NULL),
(8, 4, 'Date', 'DateFin', 'Hasta', '0_d_E', NULL, NULL, NULL, NULL),
(9, 5, 'Date', 'DateIni', 'Desde', '-12_M_S', NULL, NULL, NULL, NULL),
(10, 5, 'Date', 'DateFin', 'Hasta', '0_d_.', NULL, NULL, NULL, NULL),
(11, 5, 'Select', 'Incluir', 'Incluir', 'Activos|Eliminados', 'Activos', NULL, NULL, NULL),
(12, 6, 'Date', 'DateIni', 'Desde', '-12_M_S', NULL, NULL, NULL, NULL),
(13, 6, 'Date', 'DateFin', 'Hasta', '0_d_.', NULL, NULL, NULL, NULL),
(14, 7, 'Number', 'Dias', 'Dias', NULL, '15', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reps__informes`
--

CREATE TABLE `reps__informes` (
  `id` int(10) UNSIGNED NOT NULL,
  `Icon` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Titulo` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Order` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `reps__informes`
--

INSERT INTO `reps__informes` (`id`, `Icon`, `Titulo`, `Order`, `created_at`, `updated_at`, `deleted_at`) VALUES
(4, 'fa-chart-pie', 'Informe de Creditos', 1, NULL, NULL, NULL),
(5, 'fa-list', 'Detalle de Creditos', 2, NULL, NULL, NULL),
(6, 'fa-dollar-sign', 'Ingresos de Creditos', 3, NULL, NULL, NULL),
(7, 'fa-eye', 'Proyección de Ingresos', 4, NULL, NULL, NULL),
(8, 'fa-exclamation-triangle', 'Cartera Vencida', 5, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reps__sections`
--

CREATE TABLE `reps__sections` (
  `id` int(10) UNSIGNED NOT NULL,
  `Informe_id` int(11) NOT NULL,
  `Order` int(11) NOT NULL,
  `Route` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Width` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `reps__sections`
--

INSERT INTO `reps__sections` (`id`, `Informe_id`, `Order`, `Route`, `Width`, `created_at`, `updated_at`) VALUES
(8, 3, 1, '/api/Clientes/Factura/rep-det-recibos', 100, NULL, NULL),
(9, 4, 1, '/api/creditos/rep-resultados', 100, NULL, NULL),
(10, 4, 2, '/api/creditos/rep-cred-n-mes', 50, NULL, NULL),
(11, 4, 3, '/api/creditos/rep-cred-v-mes', 50, NULL, NULL),
(12, 4, 4, '/api/creditos/rep-linea/n', 50, NULL, NULL),
(13, 4, 5, '/api/creditos/rep-linea/v', 50, NULL, NULL),
(14, 4, 6, '/api/creditos/rep-estado/n', 50, NULL, NULL),
(15, 4, 7, '/api/creditos/rep-estado/v', 50, NULL, NULL),
(16, 5, 1, '/api/creditos/rep-det-creditos', 100, NULL, NULL),
(17, 6, 1, '/api/creditos/rep-ing/mes', 70, NULL, NULL),
(18, 6, 2, '/api/creditos/rep-ing-tipopago', 30, NULL, NULL),
(19, 6, 3, '/api/creditos/rep-ing/dia', 100, NULL, NULL),
(20, 7, 1, '/api/creditos/rep-proy-dia', 100, NULL, NULL),
(21, 7, 2, '/api/creditos/rep-proy-creditos', 100, NULL, NULL),
(22, 8, 1, '/api/creditos/rep-mora', 100, NULL, NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `reps__filters`
--
ALTER TABLE `reps__filters`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `reps__informes`
--
ALTER TABLE `reps__informes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `reps__sections`
--
ALTER TABLE `reps__sections`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Informe_id` (`Informe_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `reps__filters`
--
ALTER TABLE `reps__filters`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `reps__informes`
--
ALTER TABLE `reps__informes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `reps__sections`
--
ALTER TABLE `reps__sections`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
