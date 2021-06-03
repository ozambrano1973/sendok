-- phpMyAdmin SQL Dump
-- version 4.9.4
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 15-02-2021 a las 10:32:36
-- Versión del servidor: 5.6.23-cll-lve
-- Versión de PHP: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `sendok_laravel`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente_destino`
--

CREATE TABLE `cliente_destino` (
  `id_cliente` bigint(20) UNSIGNED NOT NULL,
  `rut_cliente` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nombre_cliente` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fono_cliente` int(15) UNSIGNED DEFAULT NULL,
  `id_comuna_cliente` int(2) UNSIGNED DEFAULT NULL,
  `id_region_cliente` int(2) UNSIGNED DEFAULT NULL,
  `email_cliente` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `direccion_cliente` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nombre_contacto` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cargo_contacto` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `cliente_destino`
--

INSERT INTO `cliente_destino` (`id_cliente`, `rut_cliente`, `nombre_cliente`, `fono_cliente`, `id_comuna_cliente`, `id_region_cliente`, `email_cliente`, `direccion_cliente`, `nombre_contacto`, `cargo_contacto`) VALUES
(8, '2232232-2', 'Datapro', 42212, 87, 7, 'cfigueroa@datapro.cl', 'Direccion', 'Sasha Stifel', 'Gerente General'),
(9, '11111111-1', 'Sasha stifel SPA', 11223, 108, 7, 'sstifel@datapro.cl', 'asda', 'Sasha', 'Gerente general'),
(10, '123123-2', 'Camila SPA', 112233, 65, 6, 'cfigueroa@datapro.cl', 'Valparaiso', 'Camila Figueroa', 'Ingeniero de SW'),
(11, '12312-1', 'Lorena', 11223, 96, 7, 'comercial@datapro.cl', 'asdasd', 'Lorena Valiente', 'Comercial');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comuna`
--

CREATE TABLE `comuna` (
  `id` int(11) NOT NULL,
  `comuna` varchar(64) NOT NULL,
  `provincia_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `comuna`
--

INSERT INTO `comuna` (`id`, `comuna`, `provincia_id`) VALUES
(1, 'Arica', 1),
(2, 'Camarones', 1),
(3, 'General Lagos', 2),
(4, 'Putre', 2),
(5, 'Alto Hospicio', 3),
(6, 'Iquique', 3),
(7, 'Camiña', 4),
(8, 'Colchane', 4),
(9, 'Huara', 4),
(10, 'Pica', 4),
(11, 'Pozo Almonte', 4),
(12, 'Tocopilla', 5),
(13, 'María Elena', 5),
(14, 'Calama', 6),
(15, 'Ollague', 6),
(16, 'San Pedro de Atacama', 6),
(17, 'Antofagasta', 7),
(18, 'Mejillones', 7),
(19, 'Sierra Gorda', 7),
(20, 'Taltal', 7),
(21, 'Chañaral', 8),
(22, 'Diego de Almagro', 8),
(23, 'Copiapó', 9),
(24, 'Caldera', 9),
(25, 'Tierra Amarilla', 9),
(26, 'Vallenar', 10),
(27, 'Alto del Carmen', 10),
(28, 'Freirina', 10),
(29, 'Huasco', 10),
(30, 'La Serena', 11),
(31, 'Coquimbo', 11),
(32, 'Andacollo', 11),
(33, 'La Higuera', 11),
(34, 'Paihuano', 11),
(35, 'Vicuña', 11),
(36, 'Ovalle', 12),
(37, 'Combarbalá', 12),
(38, 'Monte Patria', 12),
(39, 'Punitaqui', 12),
(40, 'Río Hurtado', 12),
(41, 'Illapel', 13),
(42, 'Canela', 13),
(43, 'Los Vilos', 13),
(44, 'Salamanca', 13),
(45, 'La Ligua', 14),
(46, 'Cabildo', 14),
(47, 'Zapallar', 14),
(48, 'Papudo', 14),
(49, 'Petorca', 14),
(50, 'Los Andes', 15),
(51, 'San Esteban', 15),
(52, 'Calle Larga', 15),
(53, 'Rinconada', 15),
(54, 'San Felipe', 16),
(55, 'Llaillay', 16),
(56, 'Putaendo', 16),
(57, 'Santa María', 16),
(58, 'Catemu', 16),
(59, 'Panquehue', 16),
(60, 'Quillota', 17),
(61, 'La Cruz', 17),
(62, 'La Calera', 17),
(63, 'Nogales', 17),
(64, 'Hijuelas', 17),
(65, 'Valparaíso', 18),
(66, 'Viña del Mar', 18),
(67, 'Concón', 18),
(68, 'Quintero', 18),
(69, 'Puchuncaví', 18),
(70, 'Casablanca', 18),
(71, 'Juan Fernández', 18),
(72, 'San Antonio', 19),
(73, 'Cartagena', 19),
(74, 'El Tabo', 19),
(75, 'El Quisco', 19),
(76, 'Algarrobo', 19),
(77, 'Santo Domingo', 19),
(78, 'Isla de Pascua', 20),
(79, 'Quilpué', 21),
(80, 'Limache', 21),
(81, 'Olmué', 21),
(82, 'Villa Alemana', 21),
(83, 'Colina', 22),
(84, 'Lampa', 22),
(85, 'Tiltil', 22),
(86, 'Santiago', 23),
(87, 'Vitacura', 23),
(88, 'San Ramón', 23),
(89, 'San Miguel', 23),
(90, 'San Joaquín', 23),
(91, 'Renca', 23),
(92, 'Recoleta', 23),
(93, 'Quinta Normal', 23),
(94, 'Quilicura', 23),
(95, 'Pudahuel', 23),
(96, 'Providencia', 23),
(97, 'Peñalolén', 23),
(98, 'Pedro Aguirre Cerda', 23),
(99, 'Ñuñoa', 23),
(100, 'Maipú', 23),
(101, 'Macul', 23),
(102, 'Lo Prado', 23),
(103, 'Lo Espejo', 23),
(104, 'Lo Barnechea', 23),
(105, 'Las Condes', 23),
(106, 'La Reina', 23),
(107, 'La Pintana', 23),
(108, 'La Granja', 23),
(109, 'La Florida', 23),
(110, 'La Cisterna', 23),
(111, 'Independencia', 23),
(112, 'Huechuraba', 23),
(113, 'Estación Central', 23),
(114, 'El Bosque', 23),
(115, 'Conchalí', 23),
(116, 'Cerro Navia', 23),
(117, 'Cerrillos', 23),
(118, 'Puente Alto', 24),
(119, 'San José de Maipo', 24),
(120, 'Pirque', 24),
(121, 'San Bernardo', 25),
(122, 'Buin', 25),
(123, 'Paine', 25),
(124, 'Calera de Tango', 25),
(125, 'Melipilla', 26),
(126, 'Alhué', 26),
(127, 'Curacaví', 26),
(128, 'María Pinto', 26),
(129, 'San Pedro', 26),
(130, 'Isla de Maipo', 27),
(131, 'El Monte', 27),
(132, 'Padre Hurtado', 27),
(133, 'Peñaflor', 27),
(134, 'Talagante', 27),
(135, 'Codegua', 28),
(136, 'Coínco', 28),
(137, 'Coltauco', 28),
(138, 'Doñihue', 28),
(139, 'Graneros', 28),
(140, 'Las Cabras', 28),
(141, 'Machalí', 28),
(142, 'Malloa', 28),
(143, 'Mostazal', 28),
(144, 'Olivar', 28),
(145, 'Peumo', 28),
(146, 'Pichidegua', 28),
(147, 'Quinta de Tilcoco', 28),
(148, 'Rancagua', 28),
(149, 'Rengo', 28),
(150, 'Requínoa', 28),
(151, 'San Vicente de Tagua Tagua', 28),
(152, 'Chépica', 29),
(153, 'Chimbarongo', 29),
(154, 'Lolol', 29),
(155, 'Nancagua', 29),
(156, 'Palmilla', 29),
(157, 'Peralillo', 29),
(158, 'Placilla', 29),
(159, 'Pumanque', 29),
(160, 'San Fernando', 29),
(161, 'Santa Cruz', 29),
(162, 'La Estrella', 30),
(163, 'Litueche', 30),
(164, 'Marchigüe', 30),
(165, 'Navidad', 30),
(166, 'Paredones', 30),
(167, 'Pichilemu', 30),
(168, 'Curicó', 31),
(169, 'Hualañé', 31),
(170, 'Licantén', 31),
(171, 'Molina', 31),
(172, 'Rauco', 31),
(173, 'Romeral', 31),
(174, 'Sagrada Familia', 31),
(175, 'Teno', 31),
(176, 'Vichuquén', 31),
(177, 'Talca', 32),
(178, 'San Clemente', 32),
(179, 'Pelarco', 32),
(180, 'Pencahue', 32),
(181, 'Maule', 32),
(182, 'San Rafael', 32),
(183, 'Curepto', 33),
(184, 'Constitución', 32),
(185, 'Empedrado', 32),
(186, 'Río Claro', 32),
(187, 'Linares', 33),
(188, 'San Javier', 33),
(189, 'Parral', 33),
(190, 'Villa Alegre', 33),
(191, 'Longaví', 33),
(192, 'Colbún', 33),
(193, 'Retiro', 33),
(194, 'Yerbas Buenas', 33),
(195, 'Cauquenes', 34),
(196, 'Chanco', 34),
(197, 'Pelluhue', 34),
(198, 'Bulnes', 35),
(199, 'Chillán', 35),
(200, 'Chillán Viejo', 35),
(201, 'El Carmen', 35),
(202, 'Pemuco', 35),
(203, 'Pinto', 35),
(204, 'Quillón', 35),
(205, 'San Ignacio', 35),
(206, 'Yungay', 35),
(207, 'Cobquecura', 36),
(208, 'Coelemu', 36),
(209, 'Ninhue', 36),
(210, 'Portezuelo', 36),
(211, 'Quirihue', 36),
(212, 'Ránquil', 36),
(213, 'Treguaco', 36),
(214, 'San Carlos', 37),
(215, 'Coihueco', 37),
(216, 'San Nicolás', 37),
(217, 'Ñiquén', 37),
(218, 'San Fabián', 37),
(219, 'Alto Biobío', 38),
(220, 'Antuco', 38),
(221, 'Cabrero', 38),
(222, 'Laja', 38),
(223, 'Los Ángeles', 38),
(224, 'Mulchén', 38),
(225, 'Nacimiento', 38),
(226, 'Negrete', 38),
(227, 'Quilaco', 38),
(228, 'Quilleco', 38),
(229, 'San Rosendo', 38),
(230, 'Santa Bárbara', 38),
(231, 'Tucapel', 38),
(232, 'Yumbel', 38),
(233, 'Concepción', 39),
(234, 'Coronel', 39),
(235, 'Chiguayante', 39),
(236, 'Florida', 39),
(237, 'Hualpén', 39),
(238, 'Hualqui', 39),
(239, 'Lota', 39),
(240, 'Penco', 39),
(241, 'San Pedro de La Paz', 39),
(242, 'Santa Juana', 39),
(243, 'Talcahuano', 39),
(244, 'Tomé', 39),
(245, 'Arauco', 40),
(246, 'Cañete', 40),
(247, 'Contulmo', 40),
(248, 'Curanilahue', 40),
(249, 'Lebu', 40),
(250, 'Los Álamos', 40),
(251, 'Tirúa', 40),
(252, 'Angol', 41),
(253, 'Collipulli', 41),
(254, 'Curacautín', 41),
(255, 'Ercilla', 41),
(256, 'Lonquimay', 41),
(257, 'Los Sauces', 41),
(258, 'Lumaco', 41),
(259, 'Purén', 41),
(260, 'Renaico', 41),
(261, 'Traiguén', 41),
(262, 'Victoria', 41),
(263, 'Temuco', 42),
(264, 'Carahue', 42),
(265, 'Cholchol', 42),
(266, 'Cunco', 42),
(267, 'Curarrehue', 42),
(268, 'Freire', 42),
(269, 'Galvarino', 42),
(270, 'Gorbea', 42),
(271, 'Lautaro', 42),
(272, 'Loncoche', 42),
(273, 'Melipeuco', 42),
(274, 'Nueva Imperial', 42),
(275, 'Padre Las Casas', 42),
(276, 'Perquenco', 42),
(277, 'Pitrufquén', 42),
(278, 'Pucón', 42),
(279, 'Saavedra', 42),
(280, 'Teodoro Schmidt', 42),
(281, 'Toltén', 42),
(282, 'Vilcún', 42),
(283, 'Villarrica', 42),
(284, 'Valdivia', 43),
(285, 'Corral', 43),
(286, 'Lanco', 43),
(287, 'Los Lagos', 43),
(288, 'Máfil', 43),
(289, 'Mariquina', 43),
(290, 'Paillaco', 43),
(291, 'Panguipulli', 43),
(292, 'La Unión', 44),
(293, 'Futrono', 44),
(294, 'Lago Ranco', 44),
(295, 'Río Bueno', 44),
(297, 'Osorno', 45),
(298, 'Puerto Octay', 45),
(299, 'Purranque', 45),
(300, 'Puyehue', 45),
(301, 'Río Negro', 45),
(302, 'San Juan de la Costa', 45),
(303, 'San Pablo', 45),
(304, 'Calbuco', 46),
(305, 'Cochamó', 46),
(306, 'Fresia', 46),
(307, 'Frutillar', 46),
(308, 'Llanquihue', 46),
(309, 'Los Muermos', 46),
(310, 'Maullín', 46),
(311, 'Puerto Montt', 46),
(312, 'Puerto Varas', 46),
(313, 'Ancud', 47),
(314, 'Castro', 47),
(315, 'Chonchi', 47),
(316, 'Curaco de Vélez', 47),
(317, 'Dalcahue', 47),
(318, 'Puqueldón', 47),
(319, 'Queilén', 47),
(320, 'Quellón', 47),
(321, 'Quemchi', 47),
(322, 'Quinchao', 47),
(323, 'Chaitén', 48),
(324, 'Futaleufú', 48),
(325, 'Hualaihué', 48),
(326, 'Palena', 48),
(327, 'Lago Verde', 49),
(328, 'Coihaique', 49),
(329, 'Aysén', 50),
(330, 'Cisnes', 50),
(331, 'Guaitecas', 50),
(332, 'Río Ibáñez', 51),
(333, 'Chile Chico', 51),
(334, 'Cochrane', 52),
(335, 'O´Higgins', 52),
(336, 'Tortel', 52),
(337, 'Natales', 53),
(338, 'Torres del Paine', 53),
(339, 'Laguna Blanca', 54),
(340, 'Punta Arenas', 54),
(341, 'Río Verde', 54),
(342, 'San Gregorio', 54),
(343, 'Porvenir', 55),
(344, 'Primavera', 55),
(345, 'Timaukel', 55),
(346, 'Cabo de Hornos', 56),
(347, 'Antártica', 56);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ejecutivo_venta`
--

CREATE TABLE `ejecutivo_venta` (
  `id_ejecutivo` bigint(20) UNSIGNED NOT NULL,
  `rut_ejecutivo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nombre_ejecutivo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fono_ejecutivo` int(15) UNSIGNED DEFAULT NULL,
  `rut_empresa` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_comuna_ejecutivo` int(2) UNSIGNED DEFAULT NULL,
  `id_region_ejecutivo` int(2) UNSIGNED DEFAULT NULL,
  `email_ejecutivo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `direccion_ejecutivo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empresa_origen`
--

CREATE TABLE `empresa_origen` (
  `id_empresa` bigint(20) UNSIGNED NOT NULL,
  `rut_empresa` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nombre_empresa` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fono_empresa` int(15) UNSIGNED DEFAULT NULL,
  `id_comuna_empresa` int(2) UNSIGNED DEFAULT NULL,
  `id_region_empresa` int(2) UNSIGNED DEFAULT NULL,
  `id_tipo_empresa` int(2) UNSIGNED DEFAULT NULL,
  `direccion_empresa` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `id_producto` bigint(20) UNSIGNED NOT NULL,
  `valor_producto` bigint(20) UNSIGNED NOT NULL,
  `descripcion_producto` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nombre_producto` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tipo_cambio` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `numero_fabricacion` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `numero_interno` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `stock` int(15) DEFAULT NULL,
  `costo` int(15) DEFAULT NULL,
  `margen` int(15) DEFAULT NULL,
  `clase` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tiene_folleto` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`id_producto`, `valor_producto`, `descripcion_producto`, `nombre_producto`, `tipo_cambio`, `numero_fabricacion`, `numero_interno`, `stock`, `costo`, `margen`, `clase`, `tiene_folleto`) VALUES
(29, 15, 'Mouse con cable', 'Mouse', 'usd', '1000', '1000', 10, 10, 50, 'producto', 1),
(30, 30, 'Licencia de office 2020', 'Licencia office', 'usd', '1001', '1001', 20, 20, 50, 'producto', 0),
(31, 150, 'Monitor', 'Happy sheep', 'usd', '10002', '10002', 20, 100, 50, 'producto', 0),
(32, 63, 'Cargador de notebook', 'Charger', 'usd', '10003', '10003', 20, 50, 25, 'producto', 0),
(33, 150, 'Monitor', 'Happy sheep', 'usd', '10002', '10002', 20, 100, 50, 'producto', 0),
(34, 63, 'Cargador de notebook', 'Charger', 'usd', '10003', '10003', 20, 50, 25, 'producto', 0),
(35, 150, 'Monitor2', 'Happy sheep2', 'usd', '10002', '10002', 20, 100, 50, 'producto', 0),
(36, 63, 'Cargador de notebook2', 'Charger2', 'usd', '10003', '10003', 20, 50, 25, 'producto', 0),
(37, 150, 'asd', 'Happy sheep2', 'usd', '1231231', '10002', 20, 100, 50, 'producto', 0),
(38, 63, 'Cargador de notebook2 asdasdasdasdasdsadasdasdasaasdasasdasdasdasdasdasd ajskdjaskdjaksjdkajsldkajsd askdjalskdjalksjdaljs', 'asdasd', 'usd', '10003', '10003', 20, 50, 25, 'producto', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `propuesta_comercial`
--

CREATE TABLE `propuesta_comercial` (
  `id_propuesta` bigint(200) NOT NULL,
  `id_ejecutivo` int(15) NOT NULL,
  `id_cliente` int(15) NOT NULL,
  `id_producto` varchar(100) DEFAULT NULL,
  `id_servicio` varchar(100) DEFAULT NULL,
  `email_destino` varchar(250) DEFAULT NULL,
  `unidades` varchar(100) DEFAULT NULL,
  `valor_s_iva` varchar(100) DEFAULT NULL,
  `iva` varchar(100) DEFAULT NULL,
  `total` varchar(100) DEFAULT NULL,
  `nombre_producto` varchar(100) DEFAULT NULL,
  `valor_unitario` varchar(100) DEFAULT NULL,
  `nombre_cliente` varchar(100) DEFAULT NULL,
  `tipo_cambio` varchar(20) DEFAULT NULL,
  `folio_propuesta` varchar(200) DEFAULT NULL,
  `fecha_creacion` datetime DEFAULT CURRENT_TIMESTAMP,
  `estado_envio` varchar(50) DEFAULT NULL,
  `fecha_modificacion` datetime DEFAULT NULL,
  `descuento` varchar(1000) DEFAULT NULL,
  `version_documento` int(100) DEFAULT '1',
  `fichas_tecnicas` varchar(1000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `propuesta_comercial`
--

INSERT INTO `propuesta_comercial` (`id_propuesta`, `id_ejecutivo`, `id_cliente`, `id_producto`, `id_servicio`, `email_destino`, `unidades`, `valor_s_iva`, `iva`, `total`, `nombre_producto`, `valor_unitario`, `nombre_cliente`, `tipo_cambio`, `folio_propuesta`, `fecha_creacion`, `estado_envio`, `fecha_modificacion`, `descuento`, `version_documento`, `fichas_tecnicas`) VALUES
(21, 7, 10, '[\"29\"]', NULL, 'cfigueroa@datapro.cl', '[\"2\"]', '30', '6', '36', '[\"Mouse\"]', '[\"15\"]', 'Camila SPA', '[\"USD\"]', 'PC10_21-2', '2021-02-09 09:52:10', 'Enviado', '2021-02-09 10:21:43', '[\"\"]', 1, '[]'),
(22, 7, 10, '[\"30\",\"29\"]', NULL, 'cfigueroa@datapro.cl', '[\"2\",\"4\"]', '102', '19', '121', '[\"Licencia office\",\"Mouse\"]', '[\"30\",\"15\"]', 'Camila SPA', '[\"USD\",\"USD\"]', 'PC10_22-1', '2021-02-09 10:06:50', 'Enviado', '2021-02-09 10:06:50', '[\"30\",\"\"]', 1, '[\"producto_1000.pdf\"]');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `provincia`
--

CREATE TABLE `provincia` (
  `id` int(11) NOT NULL,
  `provincia` varchar(64) NOT NULL,
  `region_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `provincia`
--

INSERT INTO `provincia` (`id`, `provincia`, `region_id`) VALUES
(1, 'Arica', 1),
(2, 'Parinacota', 1),
(3, 'Iquique', 2),
(4, 'El Tamarugal', 2),
(5, 'Tocopilla', 3),
(6, 'El Loa', 3),
(7, 'Antofagasta', 3),
(8, 'Chañaral', 4),
(9, 'Copiapó', 4),
(10, 'Huasco', 4),
(11, 'Elqui', 5),
(12, 'Limarí', 5),
(13, 'Choapa', 5),
(14, 'Petorca', 6),
(15, 'Los Andes', 6),
(16, 'San Felipe de Aconcagua', 6),
(17, 'Quillota', 6),
(18, 'Valparaiso', 6),
(19, 'San Antonio', 6),
(20, 'Isla de Pascua', 6),
(21, 'Marga Marga', 6),
(22, 'Chacabuco', 7),
(23, 'Santiago', 7),
(24, 'Cordillera', 7),
(25, 'Maipo', 7),
(26, 'Melipilla', 7),
(27, 'Talagante', 7),
(28, 'Cachapoal', 8),
(29, 'Colchagua', 8),
(30, 'Cardenal Caro', 8),
(31, 'Curicó', 9),
(32, 'Talca', 9),
(33, 'Linares', 9),
(34, 'Cauquenes', 9),
(35, 'Diguillín', 10),
(36, 'Itata', 10),
(37, 'Punilla', 10),
(38, 'Bio Bío', 11),
(39, 'Concepción', 11),
(40, 'Arauco', 11),
(41, 'Malleco', 12),
(42, 'Cautín', 12),
(43, 'Valdivia', 13),
(44, 'Ranco', 13),
(45, 'Osorno', 14),
(46, 'Llanquihue', 14),
(47, 'Chiloé', 14),
(48, 'Palena', 14),
(49, 'Coyhaique', 15),
(50, 'Aysén', 15),
(51, 'General Carrera', 15),
(52, 'Capitán Prat', 15),
(53, 'Última Esperanza', 16),
(54, 'Magallanes', 16),
(55, 'Tierra del Fuego', 16),
(56, 'Antártica Chilena', 16);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `region`
--

CREATE TABLE `region` (
  `id` int(11) NOT NULL,
  `region` varchar(64) NOT NULL,
  `abreviatura` varchar(4) NOT NULL,
  `capital` varchar(64) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `region`
--

INSERT INTO `region` (`id`, `region`, `abreviatura`, `capital`) VALUES
(1, 'Arica y Parinacota', 'AP', 'Arica'),
(2, 'Tarapacá', 'TA', 'Iquique'),
(3, 'Antofagasta', 'AN', 'Antofagasta'),
(4, 'Atacama', 'AT', 'Copiapó'),
(5, 'Coquimbo', 'CO', 'La Serena'),
(6, 'Valparaiso', 'VA', 'valparaíso'),
(7, 'Metropolitana de Santiago', 'RM', 'Santiago'),
(8, 'Libertador General Bernardo O´Higgins', 'OH', 'Rancagua'),
(9, 'Maule', 'MA', 'Talca'),
(10, 'Ñuble', 'NB', 'Chillán'),
(11, 'Biobío', 'BI', 'Concepción'),
(12, 'La Araucanía', 'IAR', 'Temuco'),
(13, 'Los Ríos', 'LR', 'Valdivia'),
(14, 'Los Lagos', 'LL', 'Puerto Montt'),
(15, 'Aysén del General Carlos Ibáñez del Campo', 'AI', 'Coyhaique'),
(16, 'Magallanes y de la Antártica Chilena', 'MG', 'Punta Arenas');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicio`
--

CREATE TABLE `servicio` (
  `id_servicio` bigint(20) UNSIGNED NOT NULL,
  `valor_servicio` bigint(20) UNSIGNED NOT NULL,
  `descripcion_servicio` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_empresa`
--

CREATE TABLE `tipo_empresa` (
  `id_tipo_empresa` bigint(20) UNSIGNED NOT NULL,
  `nombre_tipo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descripcion_tipo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_producto`
--

CREATE TABLE `tipo_producto` (
  `id_tipo_producto` bigint(20) UNSIGNED NOT NULL,
  `nombre_tipo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descripcion_tipo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `tipo_producto`
--

INSERT INTO `tipo_producto` (`id_tipo_producto`, `nombre_tipo`, `descripcion_tipo`) VALUES
(1, 'Licencias', 'Licencias de software'),
(2, 'Aplicación', 'aplicación web o de escritorio');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(7, 'Camila Figueroa', 'cfigueroa@datapro.cl', NULL, '$2y$10$I9UmrHnZRFSMVoh2/Lo25uW1A6ioU4yFd/0pVF4zbn6I/FXU6xz1C', NULL, '2021-01-15 20:56:02', '2021-01-15 20:56:02'),
(8, 'Mitchel', 'web@datapro.cl', NULL, '$2y$10$iQOp6Ck0EApq5h.LEp3wWeaACotPebSuA2WbrLwuNSGU2WygN/E/a', NULL, '2021-01-16 00:20:02', '2021-01-16 00:20:02'),
(9, 'Sasha', 'sstifel@datapro.cl', NULL, '$2y$10$toOqfvrM9SA2uvijF0s0kOXChzPJ1W4nkH6UCZiPMn1D8z2ZmMsFC', NULL, '2021-01-18 18:30:21', '2021-01-18 18:30:21'),
(10, 'Señor', 'info@datapro.cl', NULL, '$2y$10$gAQf3Nr12PbFe9cbiOmRBeDGMy860s.LJWAHhV5HVEcU9zPf.pUX6', NULL, '2021-01-25 18:07:57', '2021-01-25 18:07:57');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cliente_destino`
--
ALTER TABLE `cliente_destino`
  ADD PRIMARY KEY (`id_cliente`),
  ADD KEY `id_cliente` (`id_cliente`);

--
-- Indices de la tabla `comuna`
--
ALTER TABLE `comuna`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`id_producto`);

--
-- Indices de la tabla `propuesta_comercial`
--
ALTER TABLE `propuesta_comercial`
  ADD PRIMARY KEY (`id_propuesta`),
  ADD KEY `id_propuesta` (`id_propuesta`);

--
-- Indices de la tabla `provincia`
--
ALTER TABLE `provincia`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `region`
--
ALTER TABLE `region`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tipo_producto`
--
ALTER TABLE `tipo_producto`
  ADD PRIMARY KEY (`id_tipo_producto`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`),
  ADD KEY `id_2` (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cliente_destino`
--
ALTER TABLE `cliente_destino`
  MODIFY `id_cliente` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `comuna`
--
ALTER TABLE `comuna`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=348;

--
-- AUTO_INCREMENT de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `id_producto` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT de la tabla `propuesta_comercial`
--
ALTER TABLE `propuesta_comercial`
  MODIFY `id_propuesta` bigint(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de la tabla `provincia`
--
ALTER TABLE `provincia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT de la tabla `region`
--
ALTER TABLE `region`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `tipo_producto`
--
ALTER TABLE `tipo_producto`
  MODIFY `id_tipo_producto` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

alter table producto add column proveedor varchar(100);