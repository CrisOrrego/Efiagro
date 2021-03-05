-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 05-03-2021 a las 18:40:09
-- Versión del servidor: 10.4.14-MariaDB
-- Versión de PHP: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
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
-- Estructura de tabla para la tabla `organizaciones_muro_secciones`
--

CREATE TABLE `organizaciones_muro_secciones` (
  `id` int(10) NOT NULL,
  `organizacion_id` int(10) NOT NULL,
  `contenido` text DEFAULT NULL,
  `ruta` varchar(100) DEFAULT NULL,
  `url` varchar(200) DEFAULT NULL,
  `ext` varchar(4) DEFAULT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `estado` varchar(10) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `organizaciones_muro_secciones`
--

INSERT INTO `organizaciones_muro_secciones` (`id`, `organizacion_id`, `contenido`, `ruta`, `url`, `ext`, `usuario_id`, `estado`, `created_at`, `updated_at`) VALUES
(151, 8, '<p>dfsdfzdfz</p>', 'files/muro_media/8/20210305114917.jpg', 'http://efiagro.local/#/Home/GestionOrganizacion/Organizacion', NULL, 1, NULL, '2021-03-05 16:49:20', '2021-03-05 16:49:20'),
(152, 8, '<h1 class=\"sc-1efpnfq-0 biSEwE\" style=\"font-size: 52px;\"><b>Este nuevo método de siembra podría hacer innecesarios los pesticidas</b></h1><div><br/><br/><!--StartFragment--><p class=\"sc-77igqf-0 bOfvBY\" style=\"font-size: 18px;\">En <a class=\"sc-1out364-0 hMndXN sc-145m8ut-0 kVnoAv js_link\" href=\"http://onlinelibrary.wiley.com/doi/10.1111/wre.12101/abstract\" target=\"_blank\" rel=\"noopener noreferrer\">estudios</a>, los científicos demostraron que la maleza no puede competir con el crecimiento de cultivos como el maíz, granos y frijoles si los agricultores alteran sus patrones de siembra. La idea es plantar las semillas en modelos de red en lugar de hileras que es como normalmente se hace. Así lo explica Jacob Weiner, encargado del proyecto:</p><blockquote class=\"sc-8hxd3p-0 gZJbdR\" style=\"font-size: 18px;\"><p class=\"sc-77igqf-0 bOfvBY\" style=\"font-size: 18px;\">Nuestros resultados demuestran que el control de malezas en los campos mejora con el abandono de técnicas tradicionales de siembra. Los agricultores de todo el mundo, siembran sus cultivos en hileras. Nuestros estudios con trigo y maíz sembrados en un modelo de red, suprimen el crecimiento de malezas. Esto proporciona una mayor cosecha en los campos propensos a tener grandes cantidades de maleza.</p></blockquote><!--EndFragment--><br/><br/></div><!--EndFragment--><p><br/></p><p><br/></p>', 'files/muro_media/8/20210305121025.jpg', 'https://es.gizmodo.com/este-nuevo-metodo-de-siembra-podria-hacer-innecesarios-1679320460', NULL, 1, NULL, '2021-03-05 17:10:26', '2021-03-05 17:10:26'),
(153, 8, '<h1 class=\"sc-1efpnfq-0 biSEwE\" style=\"font-size: 52px;\"><b>Los pesticidas</b></h1><div><b><br/><br/><!--StartFragment--><span style=\"font-size: 18px;float: none;\">l estudio busca mejorar la agricultura con un método sostenible que mantenga la producción, no dañe el medio ambiente ni a los consumidores. Los investigadores aún estudian la interacción de las plantas para mejorar la técnica de sembrado en otros tipos de granos.</span><!--EndFragment--><br/><br/><br/></b></div><!--EndFragment--><p><br/></p><p><br/></p>', 'files/muro_media/8/20210305121402.jpg', NULL, NULL, 1, NULL, '2021-03-05 17:14:02', '2021-03-05 17:14:02'),
(154, 8, '<p><span style=\"font-size: 18px;float: none;\"></span></p><h1>El truco es aumentar la competencia</h1><p><br/></p><p><br/><br/><!--StartFragment--><span style=\"font-size: 18px;float: none;\">de las plantas buenas por el espacio, de manera que no dejen sitio a la maleza. El hecho de que las primeras se cultiven les da cierta ventaja temporal a la hora de colonizar todo el espacio más rápido. El estudio busca mejorar la agricultura con un método sostenible que mantenga la producción, no dañe el medio ambiente ni a los consumidores. Los investigadores aún estudian la interacción de las plantas para mejorar la técnica</span><!--EndFragment--><br/><br/><br/></p><!--EndFragment--><p><br/></p><p><br/></p><p><br/></p><p></p>', 'files/muro_media/8/20210305123419.jpg', 'https://es.gizmodo.com/este-nuevo-metodo-de-siembra-podria-hacer-innecesarios-1679320460', NULL, 1, NULL, '2021-03-05 17:34:20', '2021-03-05 17:34:20');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `organizaciones_muro_secciones`
--
ALTER TABLE `organizaciones_muro_secciones`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `organizaciones_muro_secciones`
--
ALTER TABLE `organizaciones_muro_secciones`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=155;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
