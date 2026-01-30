-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 27, 2026 at 02:52 PM
-- Server version: 10.6.22-MariaDB-0ubuntu0.22.04.1
-- PHP Version: 8.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mipuno_candelaria`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_usuarios`
--

CREATE TABLE `admin_usuarios` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('superadmin','hotel','danza','noticias','tienda') NOT NULL DEFAULT 'hotel',
  `assigned_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `admin_usuarios`
--

INSERT INTO `admin_usuarios` (`id`, `username`, `password`, `role`, `assigned_id`, `created_at`) VALUES
(1, 'admin', 'admin', 'superadmin', NULL, '2026-01-23 00:23:29'),
(2, 'noticia', '$2y$12$umVqgdg3SOElQphecM0GzODHsHGlXWJhASetWbqQZ9L0IF3tIrJ7u', 'noticias', NULL, '2026-01-23 00:47:40'),
(4, 'hotel', '$2y$12$l7AqLonhq2OEWBr9i6z3Ou2vmBKBaQwF13mT.GSZhlDZJmuJ83bfW', 'hotel', 14, '2026-01-23 01:37:41'),
(5, 'danza', '$2y$12$HBzd2xVzqdSWZr1ckRETgOUjKnqnlzZ2p1h1DeDXkpiXtbGvIVCwC', 'danza', 45, '2026-01-23 01:57:48'),
(6, 'tienda', '$2y$12$9LD/TRJWtLxZF5Y7fYo4POcI/2ZEsFY8LVxQLzSBPrOl5A/1ZNEGK', 'tienda', NULL, '2026-01-27 16:08:22');

-- --------------------------------------------------------

--
-- Table structure for table `calificaciones`
--

CREATE TABLE `calificaciones` (
  `id` int(11) NOT NULL,
  `hospedaje_id` int(11) NOT NULL,
  `cliente_id` int(11) DEFAULT NULL,
  `estrellas` int(11) NOT NULL CHECK (`estrellas` >= 1 and `estrellas` <= 5),
  `comentario` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `user_id` varchar(36) DEFAULT NULL,
  `user_email` varchar(100) DEFAULT NULL,
  `user_name` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `calificaciones`
--

INSERT INTO `calificaciones` (`id`, `hospedaje_id`, `cliente_id`, `estrellas`, `comentario`, `created_at`, `user_id`, `user_email`, `user_name`) VALUES
(5, 11, 9, 2, 'si', '2026-01-23 06:15:29', NULL, NULL, NULL),
(6, 11, NULL, 2, 'me gusto la comida muy buena', '2026-01-23 06:39:32', '04e7cf30-0775-46b1-94fd-de947ca010a7', 'p.sebastian.bn@gmail.com', 'pablo sebastian'),
(7, 11, NULL, 4, 'Muy bonito y acogedor', '2026-01-23 06:40:53', 'ed4c69ab-f7f9-47f3-864e-e8aa4019c2fe', 'antonyzapana17@gmail.com', 'Tony Montana');

-- --------------------------------------------------------

--
-- Table structure for table `candela_comida`
--

CREATE TABLE `candela_comida` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `lugar` varchar(255) DEFAULT NULL,
  `descripcion` text DEFAULT NULL,
  `categoria` varchar(255) DEFAULT NULL,
  `ubicacion` varchar(255) DEFAULT NULL,
  `capacidad` int(11) DEFAULT NULL,
  `dias_atencion` text DEFAULT NULL,
  `hora_apertura` time DEFAULT NULL,
  `hora_cierre` time DEFAULT NULL,
  `contacto` varchar(255) DEFAULT NULL,
  `precio_promedio` decimal(10,2) DEFAULT NULL,
  `servicios` text DEFAULT NULL,
  `imagen` text DEFAULT NULL,
  `foto_id` text DEFAULT NULL,
  `latitud` decimal(10,8) DEFAULT NULL,
  `longitud` decimal(11,8) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `candela_comida`
--

INSERT INTO `candela_comida` (`id`, `nombre`, `lugar`, `descripcion`, `categoria`, `ubicacion`, `capacidad`, `dias_atencion`, `hora_apertura`, `hora_cierre`, `contacto`, `precio_promedio`, `servicios`, `imagen`, `foto_id`, `latitud`, `longitud`) VALUES
(1, 'Chaquena Restaurantes', 'Mercado Laykakota', '', 'Tipica', 'Jr. Banchero Rossi 110, Puno', 24, 'Lunes a viernes', '07:00:00', '22:23:00', '929 396 935', NULL, '', '/candelaria/assets/uploads/69701cb994a2b_1768955065.webp', '69701cb994a2b_1768955065.webp', -15.82578300, -70.01389500),
(2, 'Mojsa Restaurante', 'centro de puno', '', 'Tipica', 'Jr. Lima N° 635', 23, 'Lunes a Domingo', '08:00:00', '19:30:00', '992 497 939', 15.00, '', '/candelaria/assets/uploads/69701fa69bb2c_1768955814.webp', '69701fa69bb2c_1768955814.webp', -15.83796300, -70.02775700);

-- --------------------------------------------------------

--
-- Table structure for table `candela_list`
--

CREATE TABLE `candela_list` (
  `id` int(11) NOT NULL,
  `categoria` varchar(255) DEFAULT NULL,
  `conjunto` varchar(255) NOT NULL,
  `orden_concurso` int(11) DEFAULT NULL,
  `orden_veneracion` int(11) DEFAULT NULL,
  `dia_concurso` date DEFAULT NULL,
  `dia_veneracion` date DEFAULT NULL,
  `accion` text DEFAULT NULL,
  `descripcion` text DEFAULT NULL,
  `hora` varchar(20) DEFAULT NULL,
  `detalles` text DEFAULT NULL,
  `foto` text DEFAULT NULL,
  `historia` text DEFAULT NULL,
  `junta_directiva` text DEFAULT NULL,
  `bloques` text DEFAULT NULL,
  `bandas` text DEFAULT NULL,
  `puntaje_estadio` decimal(6,2) DEFAULT 0.00,
  `puntaje_parada` decimal(6,2) DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `candela_list`
--

INSERT INTO `candela_list` (`id`, `categoria`, `conjunto`, `orden_concurso`, `orden_veneracion`, `dia_concurso`, `dia_veneracion`, `accion`, `descripcion`, `hora`, `detalles`, `foto`, `historia`, `junta_directiva`, `bloques`, `bandas`, `puntaje_estadio`, `puntaje_parada`) VALUES
(1, 'Autoctonos', 'xd', 3, 3, '2026-01-08', '2026-01-10', NULL, '32', '23', 'afds', '/php-candelaria/php-admin/uploads/6966bf5c866ed.png', NULL, NULL, NULL, NULL, 0.00, 0.00),
(2, 'Autoctonos', 'Carnaval De Nicasio', 1, NULL, '2026-01-31', NULL, NULL, NULL, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_2_696dad3dd55c0.jpg', NULL, NULL, NULL, NULL, 0.00, 0.00),
(3, 'Autoctonos', 'Conjunto De Zampoñas Juventud Central Chucuito - Puno', 2, NULL, '2026-01-31', NULL, NULL, NULL, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_3_696dad3dda7ac.jpg', NULL, NULL, NULL, NULL, 0.00, 0.00),
(4, 'Autoctonos', 'Asociación Folklórica Ayarachis Riqchary Huayna De Cuyo Cuyo- Sandia', 3, NULL, '2026-01-31', NULL, NULL, NULL, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_4_696dad3dd242c.jpg', NULL, NULL, NULL, NULL, 0.00, 0.00),
(5, 'Autoctonos', 'Danza Autóctona Choquelas De Calacoto', 4, NULL, '2026-01-31', NULL, NULL, NULL, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_5_696dad3ddd310.jpg', NULL, NULL, NULL, NULL, 0.00, 0.00),
(6, 'Autoctonos', 'Carnaval De Mañazo', 5, NULL, '2026-01-31', NULL, NULL, NULL, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_6_696dad3dd5418.jpg', NULL, NULL, NULL, NULL, 0.00, 0.00),
(7, 'Autoctonos', 'Conjunto De Sikuris Proyecto Cultural Wiñay Panqara Marka - Moho', 6, NULL, '2026-01-31', NULL, NULL, NULL, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_7_696dad3dda490.jpg', NULL, NULL, NULL, NULL, 0.00, 0.00),
(8, 'Autoctonos', 'Institución Cultural Mallku Kunturine - Kelluyo', 7, NULL, '2026-01-31', NULL, NULL, NULL, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_8_696dad3dde836.jpg', NULL, NULL, NULL, NULL, 0.00, 0.00),
(9, 'Autoctonos', 'Los Turcos De Cabanilla - Lampa', 8, NULL, '2026-01-31', NULL, NULL, NULL, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_9_696dad3ddf359.jpg', NULL, NULL, NULL, NULL, 0.00, 0.00),
(10, 'Autoctonos', 'Agrupación Sentimiento Sikuris De Ingeniería Civil', 9, NULL, '2026-01-31', NULL, NULL, NULL, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_10_696dad3dc8101.jpg', NULL, NULL, NULL, NULL, 0.00, 0.00),
(11, 'Autoctonos', 'Sicuris/Danza Clasificado de Manco Capac 2025', 10, NULL, '2026-01-31', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, 0.00),
(12, 'Autoctonos', 'Asociación Cultural Carnaval Chaku Chucahuacas - Chupa - Azangaro', 11, NULL, '2026-01-31', NULL, NULL, NULL, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_12_696dad3dcc047.jpg', NULL, NULL, NULL, NULL, 0.00, 0.00),
(13, 'Autoctonos', 'Asociación Folklórica Carnaval De Jayllihuaya', 12, NULL, '2026-01-31', NULL, NULL, NULL, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_13_696dad3dd2a7a.jpg', NULL, NULL, NULL, NULL, 0.00, 0.00),
(14, 'Autoctonos', 'Cultural De Arte Milenario Heraldos Sangre Aymara - Ilave', 13, NULL, '2026-01-31', NULL, NULL, NULL, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_14_696dad3ddd198.jpg', NULL, NULL, NULL, NULL, 0.00, 0.00),
(15, 'Autoctonos', 'Conjunto Autóctono Cahuires Tajquina - Chucuito', 14, NULL, '2026-01-31', NULL, NULL, NULL, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_15_696dad3dd8641.jpg', NULL, NULL, NULL, NULL, 0.00, 0.00),
(16, 'Autoctonos', 'Conjunto Arte Folklórico Nueva Generación Kajelos Del C.P. Marca Esqueña', 15, NULL, '2026-01-31', NULL, NULL, NULL, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_16_696dad3dd848b.jpg', NULL, NULL, NULL, NULL, 0.00, 0.00),
(17, 'Autoctonos', 'Asociación Central Pulipulis De Taraco', 16, NULL, '2026-01-31', NULL, NULL, NULL, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_17_696dad3dcaf80.jpg', NULL, NULL, NULL, NULL, 0.00, 0.00),
(18, 'Autoctonos', 'Asociación Cultural Carnaval De Chupa', 17, NULL, '2026-01-31', NULL, NULL, NULL, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_18_696dad3dcc437.jpg', NULL, NULL, NULL, NULL, 0.00, 0.00),
(19, 'Autoctonos', 'Conjunto Folklórico Carnaval De Taraco', 18, NULL, '2026-01-31', NULL, NULL, NULL, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_19_696dad3ddb421.jpg', NULL, NULL, NULL, NULL, 0.00, 0.00),
(20, 'Autoctonos', 'Asociación De Arte Folclórico Conjunto Yapuchiris 25 De Julio Huilacaya', 19, NULL, '2026-01-31', NULL, NULL, NULL, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_20_696dad3dd153f.jpg', NULL, NULL, NULL, NULL, 0.00, 0.00),
(21, 'Autoctonos', 'Asociación Juvenil De Sikuris Y Zampoñas Wayra Marca - Juliaca', 20, NULL, '2026-01-31', NULL, NULL, NULL, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_21_696dad3dd41a5.jpg', NULL, NULL, NULL, NULL, 0.00, 0.00),
(22, 'Autoctonos', 'Asociación Cultural Carnaval De Huerta Huaraya - Puno', 21, NULL, '2026-01-31', NULL, NULL, NULL, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_22_696dad3dcc80b.jpg', NULL, NULL, NULL, NULL, 0.00, 0.00),
(23, 'Autoctonos', 'Centro De Expresión Cultural Carnaval De Patambuco', 22, NULL, '2026-01-31', NULL, NULL, NULL, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_23_696dad3dd6cb2.jpg', NULL, NULL, NULL, NULL, 0.00, 0.00),
(24, 'Autoctonos', 'Asociación Cultural Chokela De La Comunidad Campesina Huarijuyo', 23, NULL, '2026-01-31', NULL, NULL, NULL, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_24_696dad3dcddc1.jpg', NULL, NULL, NULL, NULL, 0.00, 0.00),
(25, 'Autoctonos', 'Conjunto Folklórico Carnaval De Churo - Huayrapata', 24, NULL, '2026-01-31', NULL, NULL, NULL, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_25_696dad3ddb0e8.jpg', NULL, NULL, NULL, NULL, 0.00, 0.00),
(26, 'Autoctonos', 'Conjunto De Sikuris Centro Cultural 2 De Febrero De Sucuni - Conima', 25, NULL, '2026-01-31', NULL, NULL, NULL, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_26_696dad3dda178.jpg', NULL, NULL, NULL, NULL, 0.00, 0.00),
(27, 'Autoctonos', 'Conjunto Carnaval De Chullunquiani Palca Lampa', 26, NULL, '2026-01-31', NULL, NULL, NULL, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_27_696dad3dd8d09.jpg', NULL, NULL, NULL, NULL, 0.00, 0.00),
(28, 'Autoctonos', 'Asociación Folklórica Alpaqueros De Culta Acora', 27, NULL, '2026-01-31', NULL, NULL, NULL, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_28_696dad3dd227b.jpg', NULL, NULL, NULL, NULL, 0.00, 0.00),
(29, 'Autoctonos', 'Asociación Cultural De Luriguyos Auténticos Rivales De Aychuyo - Yunguyo', 28, NULL, '2026-01-31', NULL, NULL, NULL, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_29_696dad3dce177.jpg', NULL, NULL, NULL, NULL, 0.00, 0.00),
(30, 'Autoctonos', 'Danza Guerrera Los Unkakus De La Comunidad Campesina Pacaje', 29, NULL, '2026-01-31', NULL, NULL, NULL, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_30_696dad3ddd613.jpg', NULL, NULL, NULL, NULL, 0.00, 0.00),
(31, 'Autoctonos', 'Asociación Cultural Originarios Hach\'akallas De Usicayos - Carabaya Puno', 30, NULL, '2026-01-31', NULL, NULL, NULL, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_31_696dad3dcfc28.jpg', NULL, NULL, NULL, NULL, 0.00, 0.00),
(32, 'Autoctonos', 'Asociación Cultural Unucajas De Azangaro - Acupa', 31, NULL, '2026-01-31', NULL, NULL, NULL, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_32_696dad3dd06f2.jpg', NULL, NULL, NULL, NULL, 0.00, 0.00),
(33, 'Autoctonos', 'Asociación Cultural Carnaval De Santiago Del Distrito De Santiago De Pupuja - Azangaro', 32, NULL, '2026-01-31', NULL, NULL, NULL, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_33_696dad3dcca30.jpg', NULL, NULL, NULL, NULL, 0.00, 0.00),
(34, 'Autoctonos', 'Centro De Expresión Cultural Sikuris Sentimiento Q\'ori Wayra San Antonio De Putina', 33, NULL, '2026-01-31', NULL, NULL, NULL, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_34_696dad3dd6fab.jpg', NULL, NULL, NULL, NULL, 0.00, 0.00),
(35, 'Autoctonos', 'Confraternidad Negritos De Ccacca - Acora', 34, NULL, '2026-01-31', NULL, NULL, NULL, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_35_696dad3dd8093.jpg', NULL, NULL, NULL, NULL, 0.00, 0.00),
(36, 'Autoctonos', 'Conjunto Wifalas De San Fernando San Juan De Salinas', 35, NULL, '2026-01-31', NULL, NULL, NULL, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_36_696dad3ddce7d.jpg', NULL, NULL, NULL, NULL, 0.00, 0.00),
(37, 'Autoctonos', 'Sociedad De Expresión Cultural Café Pallay De Las Yungas De San Juan Del Oro', 36, NULL, '2026-01-31', NULL, NULL, NULL, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_37_696dad3de0e24.jpg', NULL, NULL, NULL, NULL, 0.00, 0.00),
(38, 'Autoctonos', 'Asociación De Arte Y Cultura Carnaval De Chucuito', 37, NULL, '2026-01-31', NULL, NULL, NULL, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_38_696dad3dd16bc.jpg', NULL, NULL, NULL, NULL, 0.00, 0.00),
(39, 'Autoctonos', 'Conjunto Juventud K\'ajelos San Juan De Dios De Pichacani', 38, NULL, '2026-01-31', NULL, NULL, NULL, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_39_696dad3ddc3b2.jpg', NULL, NULL, NULL, NULL, 0.00, 0.00),
(40, 'Autoctonos', 'Conjunto Folklórico Carnaval De Pusi-Cofocap', 39, NULL, '2026-01-31', NULL, NULL, NULL, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_40_696dad3ddb263.jpg', NULL, NULL, NULL, NULL, 0.00, 0.00),
(41, 'Autoctonos', 'Sikuris 27 De Junio Nueva Era - Puno', 40, NULL, '2026-01-31', NULL, NULL, NULL, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_41_696dad3de07ab.jpg', NULL, NULL, NULL, NULL, 0.00, 0.00),
(42, 'Autoctonos', 'Internacional Grupo De Arte Sikuris Los Chasquis De Coasia Vilquechico', 41, NULL, '2026-01-31', NULL, NULL, NULL, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_42_696dad3dde9af.jpg', NULL, NULL, NULL, NULL, 0.00, 0.00),
(43, 'Autoctonos', 'Luriguyos Fraternidad Cultural Los Compadres De Yunguyo', 42, NULL, '2026-01-31', NULL, NULL, NULL, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_43_696dad3ddf545.jpg', NULL, NULL, NULL, NULL, 0.00, 0.00),
(44, 'Autoctonos', 'Sicuris/Danza Clasificado de Manco Capac 2025', 43, NULL, '2026-01-31', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, 0.00),
(45, 'Autoctonos', 'A.C. Carnaval Ceniza Sangre Aymara Zona Lago - Perka Plateria', 44, NULL, '2026-01-31', NULL, NULL, 'descripcion', NULL, NULL, 'img_697526f6e3da35.28333859.png', 'descripcion', 'descripcion', 'descripcion', 'descripcion', 0.00, 0.00),
(46, 'Autoctonos', 'Asociación Cultural Qawra T\'ikhiris Kelluyo', 45, NULL, '2026-01-31', NULL, NULL, NULL, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_46_696dad3dcff2a.jpg', NULL, NULL, NULL, NULL, 0.00, 0.00),
(47, 'Autoctonos', 'Conjunto Autóctono Pinkillada Utachiris Aymaras - Desaguadero', 46, NULL, '2026-01-31', NULL, NULL, NULL, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_47_696dad3dd881c.jpg', NULL, NULL, NULL, NULL, 0.00, 0.00),
(48, 'Autoctonos', 'Conjunto Folklórico Flor De Sankayo Centro Pucara Acora', 47, NULL, '2026-01-31', NULL, NULL, NULL, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_48_696dad3ddb5d8.jpg', NULL, NULL, NULL, NULL, 0.00, 0.00),
(49, 'Autoctonos', 'Asociación Cultural Música Danza Sikuris Viento Andino Nueva Era Santa Lucia-Lampa', 48, NULL, '2026-01-31', NULL, NULL, NULL, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_49_696dad3dcfaa0.jpg', NULL, NULL, NULL, NULL, 0.00, 0.00),
(50, 'Autoctonos', 'Asociación Cultural Carnaval Misturitas Atuncolla - Sillustani', 49, NULL, '2026-01-31', NULL, NULL, NULL, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_50_696dad3dcd463.jpg', NULL, NULL, NULL, NULL, 0.00, 0.00),
(51, 'Autoctonos', 'Conjunto De Danzas Pinkilladas Lu\'qe Pankara De La Comunidad De Carancas - Desaguadero', 50, NULL, '2026-01-31', NULL, NULL, NULL, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_51_696dad3dd9cde.jpg', NULL, NULL, NULL, NULL, 0.00, 0.00),
(52, 'Autoctonos', 'Asociación Cultural Los Tenientes De Incasaya - Caracoto', 51, NULL, '2026-01-31', NULL, NULL, NULL, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_52_696dad3dcf755.jpg', NULL, NULL, NULL, NULL, 0.00, 0.00),
(53, 'Autoctonos', 'Conjunto Juventud Wifalas De Centro Poblado De San Isidro-Putina', 52, NULL, '2026-01-31', NULL, NULL, NULL, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_53_696dad3ddc52a.jpg', NULL, NULL, NULL, NULL, 0.00, 0.00),
(54, 'Autoctonos', 'Conjunto Milenario De Sikuris 12 De Diciembre - El Collao', 53, NULL, '2026-01-31', NULL, NULL, NULL, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_54_696dad3ddc6c2.jpg', NULL, NULL, NULL, NULL, 0.00, 0.00),
(55, 'Autoctonos', 'Conjunto Awatiris Santiago De Vizcachani Jayllihuaya', 54, NULL, '2026-01-31', NULL, NULL, NULL, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_55_696dad3dd89e8.jpg', NULL, NULL, NULL, NULL, 0.00, 0.00),
(56, 'Autoctonos', 'Asociación Cultural Chacareros De Caritamaya Acora - Puno', 55, NULL, '2026-01-31', NULL, NULL, NULL, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_56_696dad3dcd9e8.jpg', NULL, NULL, NULL, NULL, 0.00, 0.00),
(57, 'Autoctonos', 'Agrupación Cultural De Música Y Danzas Autóctonas Sikuris 29 De Septiembre Chillcapata - Conima', 56, NULL, '2026-01-31', NULL, NULL, NULL, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_57_696dad3dc671e.jpg', NULL, NULL, NULL, NULL, 0.00, 0.00),
(58, 'Autoctonos', 'Autenticos Lawa Kumus Del Centro Poblado Thunco - Acora', 57, NULL, '2026-01-31', NULL, NULL, NULL, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_58_696dad3dd4bc2.jpg', NULL, NULL, NULL, NULL, 0.00, 0.00),
(59, 'Autoctonos', 'Centro Cultural Juventud K\'ajelos Laraqueri', 58, NULL, '2026-01-31', NULL, NULL, NULL, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_59_696dad3dd6222.jpg', NULL, NULL, NULL, NULL, 0.00, 0.00),
(60, 'Autoctonos', 'Autentico Y Original Carnaval De Ichu', 59, NULL, '2026-01-31', NULL, NULL, NULL, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_60_696dad3dd4a0f.jpg', NULL, NULL, NULL, NULL, 0.00, 0.00),
(61, 'Autoctonos', 'Guerreros Hach\'akallas De Oruro - Crucero', 60, NULL, '2026-01-31', NULL, NULL, NULL, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_61_696dad3dde6b9.jpg', NULL, NULL, NULL, NULL, 0.00, 0.00),
(62, 'Autoctonos', 'Agrupación Cultural Sikuris Sentimiento Rosal Andino - Cabana', 61, NULL, '2026-01-31', NULL, NULL, NULL, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_62_696dad3dc71ce.jpg', NULL, NULL, NULL, NULL, 0.00, 0.00),
(63, 'Autoctonos', 'Sicuris/Danza Clasificado de Manco Capac 2025', 62, NULL, '2026-01-31', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, 0.00),
(64, 'Autoctonos', 'Asociación Cultural Q\'aswa 5 Claveles De Capachica', 63, NULL, '2026-01-31', NULL, NULL, NULL, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_64_696dad3dcfd9d.jpg', NULL, NULL, NULL, NULL, 0.00, 0.00),
(65, 'Autoctonos', 'Conjunto Folklórico Carnaval De Chuque De La Parcialidad De Lluscahaque Jurunawi - Acora', 64, NULL, '2026-01-31', NULL, NULL, NULL, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_65_696dad3ddaf4a.jpg', NULL, NULL, NULL, NULL, 0.00, 0.00),
(66, 'Autoctonos', 'Asociación Cultural Carnaval Machu - Thinkay Santa Lucia', 65, NULL, '2026-01-31', NULL, NULL, NULL, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_66_696dad3dcd247.jpg', NULL, NULL, NULL, NULL, 0.00, 0.00),
(67, 'Autoctonos', 'Asociación Chacallada Juventud Clavelitos De Camacani - Plateria', 66, NULL, '2026-01-31', NULL, NULL, NULL, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_67_696dad3dcb123.jpg', NULL, NULL, NULL, NULL, 0.00, 0.00),
(68, 'Autoctonos', 'Asociación Cultural Ispalla Llachon - Capachica', 67, NULL, '2026-01-31', NULL, NULL, NULL, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_68_696dad3dcf241.jpg', NULL, NULL, NULL, NULL, 0.00, 0.00),
(69, 'Autoctonos', 'Asociación Cultural Sikuris Kalacampana - Chucuito', 68, NULL, '2026-01-31', NULL, NULL, NULL, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_69_696dad3dd022b.jpg', NULL, NULL, NULL, NULL, 0.00, 0.00),
(70, 'Autoctonos', 'Conjunto Juventud De Wifalas San Antonio De Putina', 69, NULL, '2026-01-31', NULL, NULL, NULL, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_70_696dad3ddc23a.jpg', NULL, NULL, NULL, NULL, 0.00, 0.00),
(71, 'Autoctonos', 'Conjunto Folklórico Carnaval Autóctono De Angara - Vilavila', 70, NULL, '2026-01-31', NULL, NULL, NULL, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_71_696dad3ddaddd.jpg', NULL, NULL, NULL, NULL, 0.00, 0.00),
(72, 'Autoctonos', 'Kajelos Asociación Cultural Estudiantes Laraqueri', 71, NULL, '2026-01-31', NULL, NULL, NULL, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_72_696dad3ddeead.jpg', NULL, NULL, NULL, NULL, 0.00, 0.00),
(73, 'Autoctonos', 'Conjunto Carnaval De Alto Antalla', 72, NULL, '2026-01-31', NULL, NULL, NULL, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_73_696dad3dd8b82.jpg', NULL, NULL, NULL, NULL, 0.00, 0.00),
(74, 'Autoctonos', 'Asociación Cultural Chacareros Fuerza Aymara Yanaque Zona Lago - Acora', 73, NULL, '2026-01-31', NULL, NULL, NULL, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_74_696dad3dcdbb8.jpg', NULL, NULL, NULL, NULL, 0.00, 0.00),
(75, 'Autoctonos', 'Asociación Cultural Kaswas De Huata', 74, NULL, '2026-02-01', NULL, NULL, NULL, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_75_696dad3dcf411.jpg', NULL, NULL, NULL, NULL, 0.00, 0.00),
(76, 'Autoctonos', 'Asociación Cultural Allpachu Awatiris De Santa Rosa - Mazocruz', 75, NULL, '2026-02-01', NULL, NULL, NULL, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_76_696dad3dcb2ad.jpg', NULL, NULL, NULL, NULL, 0.00, 0.00),
(77, 'Autoctonos', 'Sociedad De Expresión Cultural Mercedes Achachi Vilquechico', 76, NULL, '2026-02-01', NULL, NULL, NULL, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_77_696dad3de1028.jpg', NULL, NULL, NULL, NULL, 0.00, 0.00),
(78, 'Autoctonos', 'Asociación Folklórica Llipí Pulis De Ccapalla - Acora', 77, NULL, '2026-02-01', NULL, NULL, NULL, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_78_696dad3dd36ca.jpg', NULL, NULL, NULL, NULL, 0.00, 0.00),
(79, 'Autoctonos', 'Chacareros Jhata Katus De Molino Kapia - Zepita', 78, NULL, '2026-02-01', NULL, NULL, NULL, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_79_696dad3dd7626.jpg', NULL, NULL, NULL, NULL, 0.00, 0.00),
(80, 'Autoctonos', 'Sicuris/Danza Clasificado de Manco Capac 2025', 79, NULL, '2026-02-01', NULL, NULL, NULL, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_80_696dad3de064e.jpg', NULL, NULL, NULL, NULL, 0.00, 0.00),
(81, 'Autoctonos', 'Conjunto Carnaval De Ichuña - Moquegua', 80, NULL, '2026-02-01', NULL, NULL, NULL, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_81_696dad3dd8ea7.jpg', NULL, NULL, NULL, NULL, 0.00, 0.00),
(82, 'Autoctonos', 'Asociación Cultural Y Tradicional Q\'arapulis Quena Quena 14 De Setiembre - Juli', 81, NULL, '2026-02-01', NULL, NULL, NULL, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_82_696dad3dd0ee3.jpg', NULL, NULL, NULL, NULL, 0.00, 0.00),
(83, 'Autoctonos', 'Centro De Expresión Cultural De Arte Milenario Originarios Ayarachis Chullunquiani Pacca Lampa', 82, NULL, '2026-02-01', NULL, NULL, NULL, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_83_696dad3dd6e35.jpg', NULL, NULL, NULL, NULL, 0.00, 0.00),
(84, 'Autoctonos', 'Asociación Cultural Carnaval Del Centro Poblado De Chucaripo Saman - Azangaro', 83, NULL, '2026-02-01', NULL, NULL, NULL, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_84_696dad3dcd030.jpg', NULL, NULL, NULL, NULL, 0.00, 0.00),
(85, 'Autoctonos', 'Danza Originaria Clasificado De Manco Capac 2025', 84, NULL, '2026-02-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, 0.00),
(86, 'Autoctonos', 'Asociación Cultural Carnaval Santiago De Pupuja Zona Valle', 85, NULL, '2026-02-01', NULL, NULL, NULL, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_86_696dad3dcd648.jpg', NULL, NULL, NULL, NULL, 0.00, 0.00),
(87, 'Autoctonos', 'Conjunto Folklórico K\'ajchas Chita Señalacuy Orurillo - Melgar', 86, NULL, '2026-02-01', NULL, NULL, NULL, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_87_696dad3ddb760.jpg', NULL, NULL, NULL, NULL, 0.00, 0.00),
(88, 'Autoctonos', 'K\'ajelos San Santiago De Viluyo', 87, NULL, '2026-02-01', NULL, NULL, NULL, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_88_696dad3ddf02b.jpg', NULL, NULL, NULL, NULL, 0.00, 0.00),
(89, 'Autoctonos', 'Asociación Juvenil Sikuris Kantutas Rojas Centro Poblado Isañura Distrito De Capachica - Puno', 88, NULL, '2026-02-01', NULL, NULL, NULL, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_89_696dad3dd4520.jpg', NULL, NULL, NULL, NULL, 0.00, 0.00),
(90, 'Autoctonos', 'Asociación Cultural Carnaval De Tiquillaca', 89, NULL, '2026-02-01', NULL, NULL, NULL, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_90_696dad3dccbe5.jpg', NULL, NULL, NULL, NULL, 0.00, 0.00),
(91, 'Autoctonos', 'Asociación Cultural Unucajas De La Comunidad De Chaupi Compuyo - Asillo - Azangaro', 90, NULL, '2026-02-01', NULL, NULL, NULL, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_91_696dad3dd08b0.jpg', NULL, NULL, NULL, NULL, 0.00, 0.00),
(92, 'Autoctonos', 'Asociación Cultural Carnaval Chacareros Del Centro Poblado De Chancachi', 91, NULL, '2026-02-01', NULL, NULL, NULL, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_92_696dad3dcbb02.jpg', NULL, NULL, NULL, NULL, 0.00, 0.00),
(93, 'Autoctonos', 'Agrupación Cultural Unucajas Sta Cruz Jose Domingo Choquehuanca', 92, NULL, '2026-02-01', NULL, NULL, NULL, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_93_696dad3dc7429.jpg', NULL, NULL, NULL, NULL, 0.00, 0.00),
(94, 'Autoctonos', 'Conjunto Folklórico K\'ajchas Cruz Taripacuy Ichucahua Distrito De Orurillo Provincia De Melgar', 93, NULL, '2026-02-01', NULL, NULL, NULL, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_94_696dad3ddb8e2.jpg', NULL, NULL, NULL, NULL, 0.00, 0.00),
(95, 'Autoctonos', 'Asociación Cultural Tradicional K\'acchas De Urinsaya', 94, NULL, '2026-02-01', NULL, NULL, NULL, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_95_696dad3dd03dc.jpg', NULL, NULL, NULL, NULL, 0.00, 0.00),
(96, 'Autoctonos', 'Asociación Folklórica Llameritos De Canteria - Lampa', 95, NULL, '2026-02-01', NULL, NULL, NULL, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_96_696dad3dd3565.jpg', NULL, NULL, NULL, NULL, 0.00, 0.00),
(97, 'Autoctonos', 'Sikuris Raíces Andinos Los Quechuas (Asiraq) Santa Lucía', 96, NULL, '2026-02-01', NULL, NULL, NULL, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_97_696dad3de091f.jpg', NULL, NULL, NULL, NULL, 0.00, 0.00),
(98, 'Autoctonos', 'Asociación Cultural Unucajas Del Distrito De San José', 97, NULL, '2026-02-01', NULL, NULL, NULL, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_98_696dad3dd0a31.jpg', NULL, NULL, NULL, NULL, 0.00, 0.00),
(99, 'Autoctonos', 'Asociación Cultural Zampónistas Arco Blanco - Puno', 98, NULL, '2026-02-01', NULL, NULL, NULL, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_99_696dad3dd107c.jpg', NULL, NULL, NULL, NULL, 0.00, 0.00),
(100, 'Autoctonos', 'Agrupación Folklórica Cultural Llamayuris Chusamarca Acora', 99, NULL, '2026-02-01', NULL, NULL, NULL, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_100_696dad3dc7b42.jpg', NULL, NULL, NULL, NULL, 0.00, 0.00),
(101, 'Autoctonos', 'Conjunto Chacallada Potojani Grande', 100, NULL, '2026-02-01', NULL, NULL, NULL, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_101_696dad3dd93b4.jpg', NULL, NULL, NULL, NULL, 0.00, 0.00),
(102, 'Autoctonos', 'Inti Tusuy De Lenzoro - Lampa', 101, NULL, '2026-02-01', NULL, NULL, NULL, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_102_696dad3ddeb62.jpg', NULL, NULL, NULL, NULL, 0.00, 0.00),
(103, 'Autoctonos', 'Centro De Expresión Cultural Andino Sikuris Jurimarka Occopampa - Moho', 102, NULL, '2026-02-01', NULL, NULL, NULL, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_103_696dad3dd6b42.jpg', NULL, NULL, NULL, NULL, 0.00, 0.00),
(104, 'Autoctonos', 'Carnaval De Cabanilla - Collana', 103, NULL, '2026-02-01', NULL, NULL, NULL, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_104_696dad3dd5276.jpg', NULL, NULL, NULL, NULL, 0.00, 0.00),
(105, 'Autoctonos', 'Asociación Cultural Unkakos Macusani - Carabaya', 104, NULL, '2026-02-01', NULL, NULL, NULL, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_105_696dad3dd0567.jpg', NULL, NULL, NULL, NULL, 0.00, 0.00),
(106, 'Autoctonos', 'Conjunto Vicuñitas De Collini - Acora', 105, NULL, '2026-02-01', NULL, NULL, NULL, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_106_696dad3ddcce4.jpg', NULL, NULL, NULL, NULL, 0.00, 0.00),
(107, 'Autoctonos', 'Conjunto Florklórico Carnaval De Paucarcolla', 106, NULL, '2026-02-01', NULL, NULL, NULL, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_107_696dad3ddac57.jpg', NULL, NULL, NULL, NULL, 0.00, 0.00),
(108, 'Autoctonos', 'Asociación Cultural Carnaval Ded Macari - Jauray Virgen Santa Lucia Macari - Melgar - Puno', 107, NULL, '2026-02-01', NULL, NULL, NULL, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_108_696dad3dcce15.jpg', NULL, NULL, NULL, NULL, 0.00, 0.00),
(109, 'Autoctonos', 'Conjunto Chacallada De Selva Alegre Del Centro Poblado De Camacani', 108, NULL, '2026-02-01', NULL, NULL, NULL, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_109_696dad3dd91e6.jpg', NULL, NULL, NULL, NULL, 0.00, 0.00),
(110, 'Autoctonos', 'Danza Originaria Clasificado De Manco Capac 2025', 109, NULL, '2026-02-01', NULL, NULL, NULL, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_110_696dad3ddd775.jpg', NULL, NULL, NULL, NULL, 0.00, 0.00),
(111, 'Autoctonos', 'Centro Cultural Juventud Collana - Cabana', 110, NULL, '2026-02-01', NULL, NULL, NULL, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_111_696dad3dd6085.jpg', NULL, NULL, NULL, NULL, 0.00, 0.00),
(112, 'Autoctonos', 'Agrupación De Expresión Cultural De Sikuri Y Danza Los Bosques De Huancané', 111, NULL, '2026-02-01', NULL, NULL, NULL, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_112_696dad3dc75b0.jpg', NULL, NULL, NULL, NULL, 0.00, 0.00),
(113, 'Autoctonos', 'Centro Cultural De Arte Y Folklore Los Autenticos Karabotas De Pichacani - Cafakap', 112, NULL, '2026-02-01', NULL, NULL, NULL, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_113_696dad3dd5f09.jpg', NULL, NULL, NULL, NULL, 0.00, 0.00),
(114, 'Autoctonos', 'Asociación Folklórica De Luriguayo Juventud Rivales De Aychuyo', 113, NULL, '2026-02-01', NULL, NULL, NULL, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_114_696dad3dd2d7c.jpg', NULL, NULL, NULL, NULL, 0.00, 0.00),
(115, 'Autoctonos', 'Asociación Expresión Cultural Unica Auqui Auquis Achachis Kumos Del Centro Poblado Umuchi Provincia Moho', 114, NULL, '2026-02-01', NULL, NULL, NULL, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_115_696dad3dd2104.jpg', NULL, NULL, NULL, NULL, 0.00, 0.00),
(116, 'Autoctonos', 'Asociación Folklórica Carnaval De Pusi - Huancane', 115, NULL, '2026-02-01', NULL, NULL, NULL, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_116_696dad3dd2bfd.jpg', NULL, NULL, NULL, NULL, 0.00, 0.00),
(117, 'Autoctonos', 'Asociación Cultural Warakeros Laqueque Iguara - Sandia', 116, NULL, '2026-02-01', NULL, NULL, NULL, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_117_696dad3dd0d5c.jpg', NULL, NULL, NULL, NULL, 0.00, 0.00),
(118, 'Autoctonos', 'Asociación Juvenil Carabaya Sikuris 8 De Diciembre - Macusani', 117, NULL, '2026-02-01', NULL, NULL, NULL, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_118_696dad3dd4006.jpg', NULL, NULL, NULL, NULL, 0.00, 0.00),
(119, 'Autoctonos', 'Asociación Folklórica Kajchas De Caracara Nicasio - Lampa', 118, NULL, '2026-02-01', NULL, NULL, NULL, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_119_696dad3dd33df.jpg', NULL, NULL, NULL, NULL, 0.00, 0.00),
(120, 'Autoctonos', 'Asociación De Zampónistas Juventud Mañazo - Distrito De Mañazo', 119, NULL, '2026-02-01', NULL, NULL, NULL, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_120_696dad3dd1df5.jpg', NULL, NULL, NULL, NULL, 0.00, 0.00),
(121, 'Autoctonos', 'Conjunto Carnaval Lawa K\'umus Del Centro Poblado De Villa Socca - Acora', 120, NULL, '2026-02-01', NULL, NULL, NULL, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_121_696dad3dd9027.jpg', NULL, NULL, NULL, NULL, 0.00, 0.00),
(122, 'Autoctonos', 'Conjunto De Sikuris Legendario Ghený Sankayo Huatta Conima', 121, NULL, '2026-02-01', NULL, NULL, NULL, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_122_696dad3dda307.jpg', NULL, NULL, NULL, NULL, 0.00, 0.00),
(123, 'Autoctonos', 'Asociación Cultural Autenticos Chacareros Titilaca Zona Lago Plateria', 122, NULL, '2026-02-01', NULL, NULL, NULL, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_123_696dad3dcb4bf.jpg', NULL, NULL, NULL, NULL, 0.00, 0.00),
(124, 'Autoctonos', 'Centro Cultural Pulí Pulís De Caracoto - San Roman', 123, NULL, '2026-02-01', NULL, NULL, NULL, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_124_696dad3dd669a.jpg', NULL, NULL, NULL, NULL, 0.00, 0.00),
(125, 'Autoctonos', 'Carnaval De Suatia Palca-Lampa', 124, NULL, '2026-02-01', NULL, NULL, NULL, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_125_696dad3dd58b3.jpg', NULL, NULL, NULL, NULL, 0.00, 0.00),
(126, 'Autoctonos', 'Asociación De Arte Y Cultura Kajelos De Yunguyo Chamacuta - Acora', 125, NULL, '2026-02-01', NULL, NULL, NULL, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_126_696dad3dd182a.jpg', NULL, NULL, NULL, NULL, 0.00, 0.00),
(127, 'Autoctonos', 'Asociación Cultural Uywa Ch\'uas De La Comunidad Campesina De Jatucachi', 126, NULL, '2026-02-01', NULL, NULL, NULL, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_127_696dad3dd0bb8.jpg', NULL, NULL, NULL, NULL, 0.00, 0.00),
(128, 'Autoctonos', 'Asociación Cultural Carnaval De Esmeralda Arapa - Azangaro', 127, NULL, '2026-02-01', NULL, NULL, NULL, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_128_696dad3dcc61d.jpg', NULL, NULL, NULL, NULL, 0.00, 0.00),
(129, 'Autoctonos', 'Asociación Cultural De Arte Zampónistas Confraternidad Acora', 128, NULL, '2026-02-01', NULL, NULL, NULL, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_129_696dad3dcdfa1.jpg', NULL, NULL, NULL, NULL, 0.00, 0.00),
(130, 'Autoctonos', 'Asociación Cultural De Sikuris Fuerza Joven - Puno', 129, NULL, '2026-02-01', NULL, NULL, NULL, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_130_696dad3dce350.jpg', NULL, NULL, NULL, NULL, 0.00, 0.00),
(131, 'Autoctonos', 'Danza De La Soltera Y Larq\'a Llank\'ay-Distrito Lloque Moquegua', 130, NULL, '2026-02-01', NULL, NULL, NULL, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_131_696dad3ddd491.jpg', NULL, NULL, NULL, NULL, 0.00, 0.00),
(132, 'Autoctonos', 'Carnaval Wapululos De Lampa', 131, NULL, '2026-02-01', NULL, NULL, NULL, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_132_696dad3dd5a3c.jpg', NULL, NULL, NULL, NULL, 0.00, 0.00),
(133, 'Autoctonos', 'Conjunto Juventud Chacallada Brisas De Lago Luquina Chico', 132, NULL, '2026-02-01', NULL, NULL, NULL, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_133_696dad3ddc0c1.jpg', NULL, NULL, NULL, NULL, 0.00, 0.00),
(134, 'Autoctonos', 'Centro Cultural Pinkillada Moho', 133, NULL, '2026-02-01', NULL, NULL, NULL, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_134_696dad3dd6519.jpg', NULL, NULL, NULL, NULL, 0.00, 0.00),
(135, 'Autoctonos', 'Centro De Expresión Cultural Wayra Marca - San Roman', 134, NULL, '2026-02-01', NULL, NULL, NULL, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_135_696dad3dd7162.jpg', NULL, NULL, NULL, NULL, 0.00, 0.00),
(136, 'Autoctonos', 'Asociación Cultural Carnaval De Capullani - Puno', 135, NULL, '2026-02-01', NULL, NULL, NULL, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_136_696dad3dcc277.jpg', NULL, NULL, NULL, NULL, 0.00, 0.00),
(137, 'Autoctonos', 'Asociación De Ayarachis Somos Patrimonio De La Cosmovisión Andina Paratia - Lampa', 136, NULL, '2026-02-01', NULL, NULL, NULL, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_137_696dad3dd1b22.jpg', NULL, NULL, NULL, NULL, 0.00, 0.00),
(138, 'Autoctonos', 'Agrupación Juvenil Nuevo Amanecer Sikuris Inti Marca - Coata', 137, NULL, '2026-02-01', NULL, NULL, NULL, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_138_696dad3dc7d4e.jpg', NULL, NULL, NULL, NULL, 0.00, 0.00),
(139, 'Autoctonos', 'Sikuris/Danzas originarias Clasificado De Manco Capac 2025', 138, NULL, '2026-02-01', NULL, NULL, NULL, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_139_696dad3de0a96.jpg', NULL, NULL, NULL, NULL, 0.00, 0.00),
(140, 'Autoctonos', 'Centro Cultural Carnaval Ayarcachi De Lacachi Zona Alta', 139, NULL, '2026-02-01', NULL, NULL, NULL, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_140_696dad3dd5d79.jpg', NULL, NULL, NULL, NULL, 0.00, 0.00),
(141, 'Autoctonos', 'Centro De Cultura Andina Varados De Ichu', 140, NULL, '2026-02-01', NULL, NULL, NULL, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_141_696dad3dd69d0.jpg', NULL, NULL, NULL, NULL, 0.00, 0.00),
(142, 'Autoctonos', 'Conjunto Folklórico Papa Tarpuy Alto Cataka - Lampa', 141, NULL, '2026-02-01', NULL, NULL, NULL, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_142_696dad3ddbf31.jpg', NULL, NULL, NULL, NULL, 0.00, 0.00),
(143, 'Autoctonos', 'Asociación Folklórico Carnaval De Arapa', 142, NULL, '2026-02-01', NULL, NULL, NULL, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_143_696dad3dd3cd1.jpg', NULL, NULL, NULL, NULL, 0.00, 0.00),
(144, 'Autoctonos', 'Asociación Cultural Carnaval Tupay Zona Lago Chocco - Chupa - Azangaro', 143, NULL, '2026-02-01', NULL, NULL, NULL, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_144_696dad3dcd813.jpg', NULL, NULL, NULL, NULL, 0.00, 0.00),
(145, 'Luces Parada', 'Organización Cultural Armonia de vientos Huj\'maya', NULL, NULL, '2026-02-08', '2026-02-09', NULL, NULL, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_145_696dad3de0046.jpg', NULL, NULL, NULL, NULL, 0.00, 0.00),
(146, 'Luces Parada', 'Conjunto de Sikuris Glorioso San Carlos', NULL, NULL, '2026-02-08', '2026-02-09', NULL, NULL, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_146_696dad3ddd031.jpg', NULL, NULL, NULL, NULL, 0.00, 0.00),
(147, 'Luces Parada', 'Asociacion Cultural Diablada Confraternidad Huascar', 1, 85, '2026-02-08', '2026-02-10', NULL, NULL, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_147_696dad3dc8434.jpg', NULL, NULL, NULL, NULL, 0.00, 0.00),
(148, 'Luces Parada', 'Centro Cultural Melodías El Collao - Ilave', 2, 88, '2026-02-08', '2026-02-10', NULL, NULL, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_148_696dad3dd63a8.jpg', NULL, NULL, NULL, NULL, 0.00, 0.00),
(149, 'Luces Parada', 'La Gran Confraternidad Llamerada Virgen De La Candelaria Central Puno - La Gran Collavic - Puno', 3, 97, '2026-02-08', '2026-02-10', NULL, NULL, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_149_696dad3ddf1ad.jpg', NULL, NULL, NULL, NULL, 0.00, 0.00),
(150, 'Luces Parada', 'Morenada San Martin', 4, 92, '2026-02-08', '2026-02-10', NULL, NULL, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_150_696dad3ddfd03.jpg', NULL, NULL, NULL, NULL, 0.00, 0.00),
(151, 'Luces Parada', 'Asociacion Folklórica Andino Amazonico Tobas Central Peru', 5, 89, '2026-02-08', '2026-02-10', NULL, NULL, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_151_696dad3dc87b6.jpg', NULL, NULL, NULL, NULL, 0.00, 0.00),
(152, 'Luces Parada', 'Asociacion Romeos De Candelaria', 6, 95, '2026-02-08', '2026-02-10', NULL, NULL, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_152_696dad3dcac8e.jpg', NULL, NULL, NULL, NULL, 0.00, 0.00),
(153, 'Luces Parada', 'Conjunto De Danzas Altiplanicas De La Uni (Tuntuna Uni)', 7, 94, '2026-02-08', '2026-02-10', NULL, NULL, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_153_696dad3dd9b76.jpg', NULL, NULL, NULL, NULL, 0.00, 0.00),
(154, 'Luces Parada', 'Asociacion Cultural Incomparable Gran Diablada Amigos De La PNP', 8, 93, '2026-02-08', '2026-02-10', NULL, NULL, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_154_696dad3dc85af.jpg', NULL, NULL, NULL, NULL, 0.00, 0.00),
(155, 'Luces Parada', 'Centro Cultural Sentimiento Sikuris Las Vicuñas De La Inmaculada - Lampa', 9, 87, '2026-02-08', '2026-02-10', NULL, NULL, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_155_696dad3dd6827.jpg', NULL, NULL, NULL, NULL, 0.00, 0.00),
(156, 'Luces Parada', 'Gran Morenada Salcedo', 10, 91, '2026-02-08', '2026-02-10', NULL, NULL, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_156_696dad3dde3b1.jpg', NULL, NULL, NULL, NULL, 0.00, 0.00),
(157, 'Luces Parada', 'Confraternidad Central Tobas Sur', 11, 86, '2026-02-08', '2026-02-10', NULL, NULL, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_157_696dad3dd791c.jpg', NULL, NULL, NULL, NULL, 0.00, 0.00),
(158, 'Luces Parada', 'Asociación Juvenil Puno Sikuris 27 De Junio (AJP)', 12, 90, '2026-02-08', '2026-02-10', NULL, NULL, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_158_696dad3dd437d.jpg', NULL, NULL, NULL, NULL, 0.00, 0.00),
(159, 'Luces Parada', 'Confraternidad Poderosa Y Espectacular Morenada San Valentin - Ilave', 13, 96, '2026-02-08', '2026-02-10', NULL, NULL, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_159_696dad3dd82a9.jpg', NULL, NULL, NULL, NULL, 0.00, 0.00),
(160, 'Luces Parada', 'Conjunto De Zampoñas Y Danzas Uni', 14, 1, '2026-02-08', '2026-02-09', NULL, NULL, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_160_696dad3dda918.jpg', NULL, NULL, NULL, NULL, 0.00, 0.00),
(161, 'Luces Parada', 'Conjunto Clasificado Salida De Manco Capac Y Mama Ocllo 2025 (Cupo A)', NULL, 2, '2026-02-08', '2026-02-09', NULL, NULL, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_161_696dad3dd9566.jpg', NULL, NULL, NULL, NULL, 0.00, 0.00),
(162, 'Luces Parada', 'Sociedad De Expresión Cultural Sikuris Wara Wara Wayras Huatasani - Huancane', 16, 43, '2026-02-08', '2026-02-09', NULL, NULL, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_162_696dad3de11fa.jpg', NULL, NULL, NULL, NULL, 0.00, 0.00),
(163, 'Luces Parada', 'Escuela De Arte \"Jose Carlos Mariategui\" Zambos Tundiques', 17, 19, '2026-02-08', '2026-02-09', NULL, NULL, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_163_696dad3ddda4d.jpg', NULL, NULL, NULL, NULL, 0.00, 0.00),
(164, 'Luces Parada', 'Confraternidad Diablada San Antonio', 18, 55, '2026-02-08', '2026-02-10', NULL, NULL, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_164_696dad3dd7bef.jpg', NULL, NULL, NULL, NULL, 0.00, 0.00),
(165, 'Luces Parada', 'Asociación De Expresión Cultural Juvenil 29 De Septiembre - Ilave', 19, 68, '2026-02-08', '2026-02-10', NULL, NULL, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_165_696dad3dd1c8d.jpg', NULL, NULL, NULL, NULL, 0.00, 0.00),
(166, 'Luces Parada', 'Conjunto Folklórico Morenada Orkapata', 20, 47, '2026-02-08', '2026-02-09', NULL, NULL, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_166_696dad3ddbd93.jpg', NULL, NULL, NULL, NULL, 0.00, 0.00),
(167, 'Luces Parada', 'Caporales Centro Cultural Andino', 21, 81, '2026-02-08', '2026-02-10', NULL, NULL, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_167_696dad3dd50d7.jpg', NULL, NULL, NULL, NULL, 0.00, 0.00),
(168, 'Luces Parada', 'Conjunto De Músicos Y Danzas Autóctonas \"Wiñay Qhantati\" Ururi Conima', 22, 80, '2026-02-08', '2026-02-10', NULL, NULL, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_168_696dad3dd9fd4.jpg', NULL, NULL, NULL, NULL, 0.00, 0.00),
(169, 'Luces Parada', 'Morenada Huajsapata', 23, 65, '2026-02-08', '2026-02-10', NULL, NULL, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_169_696dad3ddfa05.jpg', NULL, NULL, NULL, NULL, 0.00, 0.00),
(170, 'Luces Parada', 'Conjunto Folklórico La Llamerada Del Club Juvenil Andino De Lampa', 24, 39, '2026-02-08', '2026-02-09', NULL, NULL, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_170_696dad3ddba84.jpg', NULL, NULL, NULL, NULL, 0.00, 0.00),
(171, 'Luces Parada', 'Agrupación De Sikuris Raíces Aymaras - Ilave \"Asikur\"', 25, 3, '2026-02-08', '2026-02-09', NULL, NULL, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_171_696dad3dc775f.jpg', NULL, NULL, NULL, NULL, 0.00, 0.00),
(172, 'Luces Parada', 'Asociación Folklórica Diablada Azoguini', 26, 48, '2026-02-08', '2026-02-09', NULL, NULL, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_172_696dad3dd2f15.jpg', NULL, NULL, NULL, NULL, 0.00, 0.00),
(173, 'Luces Parada', 'Confraternidad Morenada Santa Rosa - Puno', 27, 82, '2026-02-08', '2026-02-10', NULL, NULL, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_173_696dad3dd7edb.jpg', NULL, NULL, NULL, NULL, 0.00, 0.00),
(174, 'Luces Parada', 'Asociación Folklórica Caporales San Valentin', 28, 9, '2026-02-08', '2026-02-09', NULL, NULL, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_174_696dad3dd2758.jpg', NULL, NULL, NULL, NULL, 0.00, 0.00),
(175, 'Luces Parada', 'Grupo De Arte 14 De Septiembre - Moho', 29, 23, '2026-02-08', '2026-02-09', NULL, NULL, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_175_696dad3dde531.jpg', NULL, NULL, NULL, NULL, 0.00, 0.00),
(176, 'Luces Parada', 'Conjunto De Arte Y Folklore Sikuris Juventud Obrera', 30, 77, '2026-02-08', '2026-02-10', NULL, NULL, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_176_696dad3dd9a0d.jpg', NULL, NULL, NULL, NULL, 0.00, 0.00),
(177, 'Luces Parada', 'Morenada Central Galeno - Dr. Ricardo J. Ruelas Rodriguez', 31, 37, '2026-02-08', '2026-02-09', NULL, NULL, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_177_696dad3ddf6d8.jpg', NULL, NULL, NULL, NULL, 0.00, 0.00),
(178, 'Luces Parada', 'Asociación Folklórica Caporales \"Sambos Con Sentimiento Y Devoción Porteño\"', 32, 54, '2026-02-08', '2026-02-10', NULL, NULL, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_178_696dad3dd25c3.jpg', NULL, NULL, NULL, NULL, 0.00, 0.00),
(179, 'Luces Parada', 'Rey Moreno Laykakota', 33, 51, '2026-02-08', '2026-02-10', NULL, NULL, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_179_696dad3de04d7.jpg', NULL, NULL, NULL, NULL, 0.00, 0.00),
(180, 'Luces Parada', 'Asociación Cultural Sangre Indomable - Azangaro', 34, 49, '2026-02-08', '2026-02-10', NULL, NULL, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_180_696dad3dd00b6.jpg', NULL, NULL, NULL, NULL, 0.00, 0.00),
(181, 'Luces Parada', 'Poderosa Espectacular Waca Waca Alto Puno', 35, 78, '2026-02-08', '2026-02-10', NULL, NULL, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_181_696dad3de01be.jpg', NULL, NULL, NULL, NULL, 0.00, 0.00),
(182, 'Luces Parada', 'Cofradía De Negritos Chacón Beaterio De Huanuco', 36, 56, '2026-02-08', '2026-02-10', NULL, NULL, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_182_696dad3dd77b3.jpg', NULL, NULL, NULL, NULL, 0.00, 0.00),
(183, 'Luces Parada', 'Morenada Virgen De La Candelaria - Mandachitos', 37, 6, '2026-02-08', '2026-02-09', NULL, NULL, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_183_696dad3ddfec1.jpg', NULL, NULL, NULL, NULL, 0.00, 0.00),
(184, 'Luces Parada', 'Expresión Cultural Milenarios De Sikuris Internacional Los Rosales Rosaspata - Huancane', 38, 18, '2026-02-08', '2026-02-09', NULL, NULL, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_184_696dad3dddd31.jpg', NULL, NULL, NULL, NULL, 0.00, 0.00),
(185, 'Luces Parada', 'Asociación La Voz Cultural Khantus 13 De Mayo - Distrito Huayrapata', 39, 66, '2026-02-08', '2026-02-10', NULL, NULL, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_185_696dad3dd46c8.jpg', NULL, NULL, NULL, NULL, 0.00, 0.00),
(186, 'Luces Parada', 'Escuela Internacional Del Folklore Caporales Del Sur Puno', 40, 40, '2026-02-08', '2026-02-09', NULL, NULL, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_186_696dad3dddbae.jpg', NULL, NULL, NULL, NULL, 0.00, 0.00),
(187, 'Luces Parada', 'Asociación Cultural Kullahuada Virgen Maria De La Candelaria', 41, 64, '2026-02-08', '2026-02-10', NULL, NULL, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_187_696dad3dcf5af.jpg', NULL, NULL, NULL, NULL, 0.00, 0.00),
(188, 'Luces Parada', 'Waca Waca Del Barrio Porteño', 42, 10, '2026-02-08', '2026-02-09', NULL, NULL, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_188_696dad3de2995.jpg', NULL, NULL, NULL, NULL, 0.00, 0.00),
(189, 'Luces Parada', 'Asociación Folklórica \"Caporales Victoria\" - Puno', 43, 76, '2026-02-08', '2026-02-10', NULL, NULL, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_189_696dad3dd28e2.jpg', NULL, NULL, NULL, NULL, 0.00, 0.00),
(190, 'Luces Parada', 'Asociación De Zampónistas Y Danzas Autóctonas San Francisco De Borja - Yunguyo', 44, 83, '2026-02-08', '2026-02-10', NULL, NULL, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_190_696dad3dd1f7a.jpg', NULL, NULL, NULL, NULL, 0.00, 0.00),
(191, 'Luces Parada', 'Agrupación Cultural Milenaria De Sikuris Internacional Huarihuma Rosaspata - Huancane', 45, 45, '2026-02-08', '2026-02-09', NULL, NULL, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_191_696dad3dc6960.jpg', NULL, NULL, NULL, NULL, 0.00, 0.00),
(192, 'Luces Parada', 'Tradicional Diablada Porteño', 47, 70, '2026-02-08', '2026-02-10', NULL, NULL, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_192_696dad3de1591.jpg', NULL, NULL, NULL, NULL, 0.00, 0.00),
(193, 'Luces Parada', 'Tradicional Rey Moreno San Antonio', 48, 16, '2026-02-08', '2026-02-09', NULL, NULL, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_193_696dad3de179a.jpg', NULL, NULL, NULL, NULL, 0.00, 0.00),
(194, 'Luces Parada', 'Wifalas San Francisco Javier de Muñani (Campeón en Danzas Originarias 2025)', NULL, NULL, '2026-02-08', '2026-02-09', NULL, NULL, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_194_696dad3de2bb3.jpg', NULL, NULL, NULL, NULL, 0.00, 0.00),
(195, 'Luces Parada', 'Confraternidad Cultural Wacas Puno', 49, 57, '2026-02-08', '2026-02-10', NULL, NULL, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_195_696dad3dd7a80.jpg', NULL, NULL, NULL, NULL, 0.00, 0.00),
(196, 'Luces Parada', 'Asociación Morenada Porteño', 50, 42, '2026-02-08', '2026-02-09', NULL, NULL, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_196_696dad3dd486b.jpg', NULL, NULL, NULL, NULL, 0.00, 0.00),
(197, 'Luces Parada', 'Agrupación Sociedad Cultural Autóctono Sikuris Wila Marca De Conima', 51, 59, '2026-02-08', '2026-02-10', NULL, NULL, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_197_696dad3dc829d.jpg', NULL, NULL, NULL, NULL, 0.00, 0.00),
(198, 'Luces Parada', 'Asociación Folklórica Tinkus Señor De Machallata', 52, 73, '2026-02-08', '2026-02-10', NULL, NULL, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_198_696dad3dd3839.jpg', NULL, NULL, NULL, NULL, 0.00, 0.00),
(199, 'Luces Parada', 'Asociación Cultural Zampónistas Lacustre Del Barrio José Antonio Encinas', 53, 5, '2026-02-08', '2026-02-09', NULL, NULL, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_199_696dad3dd1222.jpg', NULL, NULL, NULL, NULL, 0.00, 0.00),
(200, 'Luces Parada', 'Asociación Cultural Caporales Centralistas Puno', 54, 67, '2026-02-08', '2026-02-10', NULL, NULL, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_200_696dad3dcb6d1.jpg', NULL, NULL, NULL, NULL, 0.00, 0.00),
(201, 'Luces Parada', 'Auténticos Ayarachis Tawantin Ayllu Cuyo Cuyo - Sandia', 55, 26, '2026-02-08', '2026-02-09', NULL, NULL, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_201_696dad3dd4f01.jpg', NULL, NULL, NULL, NULL, 0.00, 0.00),
(202, 'Luces Parada', 'Asociación Folklórica Espectacular Diablada Bellavista', 56, 36, '2026-02-08', '2026-02-09', NULL, NULL, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_202_696dad3dd3222.jpg', NULL, NULL, NULL, NULL, 0.00, 0.00),
(203, 'Luces Parada', 'Sociedad Centro Social De Folklore Y Cultura: Sikuris Y Danzas Autóctonas \"Fundación Pokopaka\" De Huancane', 57, 71, '2026-02-08', '2026-02-10', NULL, NULL, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_203_696dad3de0c00.jpg', NULL, NULL, NULL, NULL, 0.00, 0.00),
(204, 'Luces Parada', 'Agrupación Kullahuada Victoria', 58, 17, '2026-02-08', '2026-02-09', NULL, NULL, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_204_696dad3dc7f23.jpg', NULL, NULL, NULL, NULL, 0.00, 0.00),
(205, 'Luces Parada', 'Asociación Cultural De Sikuris Intercontinentales Aymaras De Huancané', 59, 53, '2026-02-08', '2026-02-10', NULL, NULL, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_205_696dad3dce520.jpg', NULL, NULL, NULL, NULL, 0.00, 0.00),
(206, 'Luces Parada', 'Asociación Cultural Ecologista Etnias Amazonicas Del Peru-Biodanza', 60, 52, '2026-02-08', '2026-02-10', NULL, NULL, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_206_696dad3dcea35.jpg', NULL, NULL, NULL, NULL, 0.00, 0.00),
(207, 'Luces Parada', 'Asociación De Arte Cultura Y Folklore Caporales De Siempre - Pitones', 61, 35, '2026-02-08', '2026-02-09', NULL, NULL, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_207_696dad3dd13cb.jpg', NULL, NULL, NULL, NULL, 0.00, 0.00),
(208, 'Luces Parada', 'Confraternidad Morenada Intocables Juliaca Mia', 62, 79, '2026-02-08', '2026-02-10', NULL, NULL, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_208_696dad3dd7d68.jpg', NULL, NULL, NULL, NULL, 0.00, 0.00),
(209, 'Luces Parada', 'Asociación Cultural De Sikuris Los Aymaras De Huancane', 63, 8, '2026-02-08', '2026-02-09', NULL, NULL, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_209_696dad3dce6d4.jpg', NULL, NULL, NULL, NULL, 0.00, 0.00),
(210, 'Luces Parada', 'Conjunto De Zampoñas \"Expresión Cultural\" Del Centro Poblado De Ocoña - Ilave', 64, 15, '2026-02-08', '2026-02-09', NULL, NULL, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_210_696dad3dda63c.jpg', NULL, NULL, NULL, NULL, 0.00, 0.00),
(211, 'Luces Parada', 'Conjunto \"Rey Caporal Independencia\" - Puno', 65, 74, '2026-02-08', '2026-02-10', NULL, NULL, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_211_696dad3ddc9c9.jpg', NULL, NULL, NULL, NULL, 0.00, 0.00),
(212, 'Luces Parada', 'Asociación Folklórica Waca Waca Santa Rosa', 66, 38, '2026-02-08', '2026-02-09', NULL, NULL, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_212_696dad3dd3b65.jpg', NULL, NULL, NULL, NULL, 0.00, 0.00),
(213, 'Luces Parada', 'Asociación Cultural Folklórica Caporales Huascar', 67, 60, '2026-02-08', '2026-02-10', NULL, NULL, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_213_696dad3dcec15.jpg', NULL, NULL, NULL, NULL, 0.00, 0.00);
INSERT INTO `candela_list` (`id`, `categoria`, `conjunto`, `orden_concurso`, `orden_veneracion`, `dia_concurso`, `dia_veneracion`, `accion`, `descripcion`, `hora`, `detalles`, `foto`, `historia`, `junta_directiva`, `bloques`, `bandas`, `puntaje_estadio`, `puntaje_parada`) VALUES
(214, 'Luces Parada', 'Morenada Laykakota', 68, 27, '2026-02-08', '2026-02-09', NULL, NULL, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_214_696dad3ddfb7d.jpg', NULL, NULL, NULL, NULL, 0.00, 0.00),
(215, 'Luces Parada', 'Conjunto Folklórico Los Caporales De La Tuntuna Del Barrio Miraflores Catumi - Puno', 69, 14, '2026-02-08', '2026-02-09', NULL, NULL, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_215_696dad3ddbc13.jpg', NULL, NULL, NULL, NULL, 0.00, 0.00),
(216, 'Luces Parada', 'Agrupacion Sangre Chumbivilcana - Danza Huaylia Chumbivilcana-Cusco', 70, 22, '2026-02-08', '2026-02-09', NULL, NULL, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_216_696dad3dc651b.jpg', NULL, NULL, NULL, NULL, 0.00, 0.00),
(217, 'Luces Parada', 'Fraternidad Artística Sambos Caporales Señor De Quillor-Ritty', 71, 31, '2026-02-08', '2026-02-09', NULL, NULL, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_217_696dad3dde077.jpg', NULL, NULL, NULL, NULL, 0.00, 0.00),
(218, 'Luces Parada', 'Conjunto Sikuris 15 De Mayo De Cambria - Conima', 72, 34, '2026-02-08', '2026-02-09', NULL, NULL, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_218_696dad3ddcb57.jpg', NULL, NULL, NULL, NULL, 0.00, 0.00),
(219, 'Luces Parada', 'Diablada Confraternidad Victoria', 73, 21, '2026-02-08', '2026-02-09', NULL, NULL, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_219_696dad3ddd8eb.jpg', NULL, NULL, NULL, NULL, 0.00, 0.00),
(220, 'Luces Parada', 'Agrupación De Zampónistas Del Altiplano Del Barrio Huajsapata-Puno', 74, 25, '2026-02-08', '2026-02-09', NULL, NULL, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_220_696dad3dc7960.jpg', NULL, NULL, NULL, NULL, 0.00, 0.00),
(221, 'Luces Parada', 'Asociación Cultural Folklórica \"Legado Caporal\"', 75, 24, '2026-02-08', '2026-02-09', NULL, NULL, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_221_696dad3dced9e.jpg', NULL, NULL, NULL, NULL, 0.00, 0.00),
(222, 'Luces Parada', 'Auténticos Ayarachis De Antalla Palca - Lampa', 76, 72, '2026-02-08', '2026-02-10', NULL, NULL, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_222_696dad3dd4d56.jpg', NULL, NULL, NULL, NULL, 0.00, 0.00),
(223, 'Luces Parada', 'Asociación Cultural Folklórica Tobas Amazonas Anata', 77, 32, '2026-02-08', '2026-02-09', NULL, NULL, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_223_696dad3dcef38.jpg', NULL, NULL, NULL, NULL, 0.00, 0.00),
(224, 'Luces Parada', 'Asociación Cultural \"Morenada Azoguini\"', 78, 12, '2026-02-08', '2026-02-09', NULL, NULL, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_224_696dad3dcf8f5.jpg', NULL, NULL, NULL, NULL, 0.00, 0.00),
(225, 'Luces Parada', 'Centro Social Kullawada Central Puno', 79, 28, '2026-02-08', '2026-02-09', NULL, NULL, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_225_696dad3dd7320.jpg', NULL, NULL, NULL, NULL, 0.00, 0.00),
(226, 'Luces Parada', 'Asociación De Arte Y Folclore Caporales San Juan Bautista - Puno', 80, 63, '2026-02-08', '2026-02-10', NULL, NULL, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_226_696dad3dd19ba.jpg', NULL, NULL, NULL, NULL, 0.00, 0.00),
(227, 'Luces Parada', 'Conjunto Clasificado Salida De Manco Capac Y Mama Ocllo 2025 (Cupo B)', 81, 30, '2026-02-08', '2026-02-09', NULL, NULL, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_227_696dad3dd970d.jpg', NULL, NULL, NULL, NULL, 0.00, 0.00),
(228, 'Luces Parada', 'Centenario Conjunto Sikuris Del Barrio Mañazo', 82, 41, '2026-02-08', '2026-02-09', NULL, NULL, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_228_696dad3dd5bba.jpg', NULL, NULL, NULL, NULL, 0.00, 0.00),
(229, 'Luces Parada', 'Agrupación Cultural Sikuris \"Claveles Rojos\" De Huancane', 83, 29, '2026-02-08', '2026-02-09', NULL, NULL, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_229_696dad3dc6bcd.jpg', NULL, NULL, NULL, NULL, 0.00, 0.00),
(230, 'Luces Parada', 'Fraternidad Caporales Virgen De La Candelaria \"Vientos Del Sur\"', 84, 4, '2026-02-08', '2026-02-09', NULL, NULL, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_230_696dad3dde20c.jpg', NULL, NULL, NULL, NULL, 0.00, 0.00),
(231, 'Luces Parada', 'Poderosa y Espectacular Morenada Bellavista', 85, 62, '2026-02-08', '2026-02-10', NULL, NULL, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_231_696dad3de031f.jpg', NULL, NULL, NULL, NULL, 0.00, 0.00),
(232, 'Luces Parada', 'Asociación Cultural De Sikuris Proyecto Pariwanas De Huancane', 86, 84, '2026-02-08', '2026-02-10', NULL, NULL, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_232_696dad3dce882.jpg', NULL, NULL, NULL, NULL, 0.00, 0.00),
(233, 'Luces Parada', 'Asociación Cultural Genuinos Ayarachis De Paratia - Lampa', 87, 69, '2026-02-08', '2026-02-10', NULL, NULL, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_233_696dad3dcf0bc.jpg', NULL, NULL, NULL, NULL, 0.00, 0.00),
(234, 'Luces Parada', 'Conjunto De Zampónistas Juventud PAXA \"JUPAX\"', 88, 50, '2026-02-08', '2026-02-10', NULL, NULL, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_234_696dad3ddaae6.jpg', NULL, NULL, NULL, NULL, 0.00, 0.00),
(235, 'Luces Parada', 'Conjunto Morenada \"Ricardo Palma\"', 89, 33, '2026-02-08', '2026-02-09', NULL, NULL, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_235_696dad3ddc84b.jpg', NULL, NULL, NULL, NULL, 0.00, 0.00),
(236, 'Luces Parada', 'Asociación Juvenil Cabanillas Sikuris AJC', 90, 75, '2026-02-08', '2026-02-10', NULL, NULL, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_236_696dad3dd3e5b.jpg', NULL, NULL, NULL, NULL, 0.00, 0.00),
(237, 'Luces Parada', 'Asociación Folklórica Diablada \"Centinelas Del Altiplano\"', 91, 7, '2026-02-08', '2026-02-09', NULL, NULL, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_237_696dad3dd3085.jpg', NULL, NULL, NULL, NULL, 0.00, 0.00),
(238, 'Luces Parada', 'Asociación Folklórica Virgen De La Candelaria - AFOVIC', 92, 46, '2026-02-08', '2026-02-09', NULL, NULL, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_238_696dad3dd39ce.jpg', NULL, NULL, NULL, NULL, 0.00, 0.00),
(239, 'Luces Parada', 'Fabulosa Morenada Independencia', 93, 20, '2026-02-08', '2026-02-09', NULL, NULL, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_239_696dad3dddea9.jpg', NULL, NULL, NULL, NULL, 0.00, 0.00),
(240, 'Luces Parada', 'Taller De Arte Música Y Danza \"Real Asunción\" - Juli', 94, 61, '2026-02-08', '2026-02-10', NULL, NULL, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_240_696dad3de138b.jpg', NULL, NULL, NULL, NULL, 0.00, 0.00),
(241, 'Luces Parada', 'Juventud Tinkus Del Barrio Porteño', 95, 11, '2026-02-08', '2026-02-09', NULL, NULL, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_241_696dad3ddecd9.jpg', NULL, NULL, NULL, NULL, 0.00, 0.00),
(242, 'Luces Parada', 'Conjunto De Danzas Y Música Autóctona Ghantati Ururi De Conima', 96, 13, '2026-02-08', '2026-02-09', NULL, NULL, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_242_696dad3dd9e5f.jpg', NULL, NULL, NULL, NULL, 0.00, 0.00),
(243, 'Luces Parada', 'Centro Universitario De Folklore Y El Conjunto De Zampoñas De La Universidad Nacional Mayor De San Marcos(CZSM)', 97, 44, '2026-02-08', '2026-02-09', NULL, NULL, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_243_696dad3dd74a4.jpg', NULL, NULL, NULL, NULL, 0.00, 0.00),
(244, 'Luces Parada', 'Asociación Cultural Caporales Mi Viajo SJ', NULL, NULL, '2026-02-08', '2026-02-09', NULL, NULL, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_244_696dad3dcb910.jpg', NULL, NULL, NULL, NULL, 0.00, 0.00),
(245, 'Luces Parada', 'Morenada Central Puno', NULL, NULL, '2026-02-08', '2026-02-09', NULL, NULL, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_245_696dad3ddf855.jpg', NULL, NULL, NULL, NULL, 0.00, 0.00),
(246, 'Luces Parada', 'Conjunto Clasificado Salida De Manco Capac Y Mama Ocllo 2025 (Cupo C)', NULL, 58, NULL, '2026-02-10', NULL, NULL, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_246_696dad3dd9892.jpg', NULL, NULL, NULL, NULL, 0.00, 0.00);

-- --------------------------------------------------------

--
-- Table structure for table `candela_map_dances`
--

CREATE TABLE `candela_map_dances` (
  `id` varchar(50) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `type` varchar(100) DEFAULT NULL,
  `color` varchar(20) DEFAULT NULL,
  `icon` varchar(10) DEFAULT NULL,
  `distance_traveled` decimal(10,4) DEFAULT 0.0000,
  `speed` decimal(5,2) DEFAULT 0.50,
  `started` tinyint(1) DEFAULT 0,
  `finished` tinyint(1) DEFAULT 0,
  `progress` decimal(5,2) DEFAULT 0.00,
  `lat` decimal(10,8) DEFAULT -15.84070000,
  `lng` decimal(10,8) DEFAULT -70.02140000,
  `route_id` int(11) DEFAULT 1,
  `danza_service_id` int(11) DEFAULT NULL,
  `dia_concurso` varchar(50) DEFAULT NULL,
  `dia_veneracion` varchar(50) DEFAULT NULL,
  `orden_concurso` int(11) DEFAULT NULL,
  `orden_veneracion` int(11) DEFAULT NULL,
  `last_update_time` bigint(20) DEFAULT NULL,
  `foto` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `candela_map_dances`
--

INSERT INTO `candela_map_dances` (`id`, `name`, `type`, `color`, `icon`, `distance_traveled`, `speed`, `started`, `finished`, `progress`, `lat`, `lng`, `route_id`, `danza_service_id`, `dia_concurso`, `dia_veneracion`, `orden_concurso`, `orden_veneracion`, `last_update_time`, `foto`) VALUES
('danza_1', 'xd', 'Autoctonos', '#4CAF50', '🕺', 0.0000, 0.50, 0, 0, 0.00, -15.83015473, -70.01895905, 1, 1, '2026-01-08', '2026-01-10', 3, 3, NULL, '/php-candelaria/php-admin/uploads/6966bf5c866ed.png'),
('danza_10', 'Agrupación Sentimiento Sikuris De Ingeniería Civil', 'Autoctonos', '#4CAF50', '🕺', 0.0000, 0.50, 0, 0, 0.00, -15.83015473, -70.01895905, 1, 10, '2026-01-31', NULL, 9, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_10_696dad3dc8101.jpg'),
('danza_100', 'Agrupación Folklórica Cultural Llamayuris Chusamarca Acora', 'Autoctonos', '#4CAF50', '🕺', 0.0000, 0.50, 0, 0, 0.00, -15.83015473, -70.01895905, 1, 100, '2026-02-01', NULL, 99, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_100_696dad3dc7b42.jpg'),
('danza_101', 'Conjunto Chacallada Potojani Grande', 'Autoctonos', '#4CAF50', '🕺', 0.0000, 0.50, 0, 0, 0.00, -15.83015473, -70.01895905, 1, 101, '2026-02-01', NULL, 100, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_101_696dad3dd93b4.jpg'),
('danza_102', 'Inti Tusuy De Lenzoro - Lampa', 'Autoctonos', '#4CAF50', '🕺', 0.0000, 0.50, 0, 0, 0.00, -15.83015473, -70.01895905, 1, 102, '2026-02-01', NULL, 101, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_102_696dad3ddeb62.jpg'),
('danza_103', 'Centro De Expresión Cultural Andino Sikuris Jurimarka Occopampa - Moho', 'Autoctonos', '#4CAF50', '🕺', 0.0000, 0.50, 0, 0, 0.00, -15.83015473, -70.01895905, 1, 103, '2026-02-01', NULL, 102, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_103_696dad3dd6b42.jpg'),
('danza_104', 'Carnaval De Cabanilla - Collana', 'Autoctonos', '#4CAF50', '🕺', 0.0000, 0.50, 0, 0, 0.00, -15.83015473, -70.01895905, 1, 104, '2026-02-01', NULL, 103, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_104_696dad3dd5276.jpg'),
('danza_105', 'Asociación Cultural Unkakos Macusani - Carabaya', 'Autoctonos', '#4CAF50', '🕺', 0.0000, 0.50, 0, 0, 0.00, -15.83015473, -70.01895905, 1, 105, '2026-02-01', NULL, 104, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_105_696dad3dd0567.jpg'),
('danza_106', 'Conjunto Vicuñitas De Collini - Acora', 'Autoctonos', '#4CAF50', '🕺', 0.0000, 0.50, 0, 0, 0.00, -15.83015473, -70.01895905, 1, 106, '2026-02-01', NULL, 105, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_106_696dad3ddcce4.jpg'),
('danza_107', 'Conjunto Florklórico Carnaval De Paucarcolla', 'Autoctonos', '#4CAF50', '🕺', 0.0000, 0.50, 0, 0, 0.00, -15.83015473, -70.01895905, 1, 107, '2026-02-01', NULL, 106, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_107_696dad3ddac57.jpg'),
('danza_108', 'Asociación Cultural Carnaval Ded Macari - Jauray Virgen Santa Lucia Macari - Melgar - Puno', 'Autoctonos', '#4CAF50', '🕺', 0.0000, 0.50, 0, 0, 0.00, -15.83015473, -70.01895905, 1, 108, '2026-02-01', NULL, 107, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_108_696dad3dcce15.jpg'),
('danza_109', 'Conjunto Chacallada De Selva Alegre Del Centro Poblado De Camacani', 'Autoctonos', '#4CAF50', '🕺', 0.0000, 0.50, 0, 0, 0.00, -15.83015473, -70.01895905, 1, 109, '2026-02-01', NULL, 108, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_109_696dad3dd91e6.jpg'),
('danza_11', 'Sicuris/Danza Clasificado de Manco Capac 2025', 'Autoctonos', '#4CAF50', '🕺', 0.0000, 0.50, 0, 0, 0.00, -15.83015473, -70.01895905, 1, 11, '2026-01-31', NULL, 10, NULL, NULL, NULL),
('danza_110', 'Danza Originaria Clasificado De Manco Capac 2025', 'Autoctonos', '#4CAF50', '🕺', 0.0000, 0.50, 0, 0, 0.00, -15.83015473, -70.01895905, 1, 110, '2026-02-01', NULL, 109, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_110_696dad3ddd775.jpg'),
('danza_111', 'Centro Cultural Juventud Collana - Cabana', 'Autoctonos', '#4CAF50', '🕺', 0.0000, 0.50, 0, 0, 0.00, -15.83015473, -70.01895905, 1, 111, '2026-02-01', NULL, 110, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_111_696dad3dd6085.jpg'),
('danza_112', 'Agrupación De Expresión Cultural De Sikuri Y Danza Los Bosques De Huancané', 'Autoctonos', '#4CAF50', '🕺', 0.0000, 0.50, 0, 0, 0.00, -15.83015473, -70.01895905, 1, 112, '2026-02-01', NULL, 111, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_112_696dad3dc75b0.jpg'),
('danza_113', 'Centro Cultural De Arte Y Folklore Los Autenticos Karabotas De Pichacani - Cafakap', 'Autoctonos', '#4CAF50', '🕺', 0.0000, 0.50, 0, 0, 0.00, -15.83015473, -70.01895905, 1, 113, '2026-02-01', NULL, 112, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_113_696dad3dd5f09.jpg'),
('danza_114', 'Asociación Folklórica De Luriguayo Juventud Rivales De Aychuyo', 'Autoctonos', '#4CAF50', '🕺', 0.0000, 0.50, 0, 0, 0.00, -15.83015473, -70.01895905, 1, 114, '2026-02-01', NULL, 113, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_114_696dad3dd2d7c.jpg'),
('danza_115', 'Asociación Expresión Cultural Unica Auqui Auquis Achachis Kumos Del Centro Poblado Umuchi Provincia Moho', 'Autoctonos', '#4CAF50', '🕺', 0.0000, 0.50, 0, 0, 0.00, -15.83015473, -70.01895905, 1, 115, '2026-02-01', NULL, 114, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_115_696dad3dd2104.jpg'),
('danza_116', 'Asociación Folklórica Carnaval De Pusi - Huancane', 'Autoctonos', '#4CAF50', '🕺', 0.0000, 0.50, 0, 0, 0.00, -15.83015473, -70.01895905, 1, 116, '2026-02-01', NULL, 115, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_116_696dad3dd2bfd.jpg'),
('danza_117', 'Asociación Cultural Warakeros Laqueque Iguara - Sandia', 'Autoctonos', '#4CAF50', '🕺', 0.0000, 0.50, 0, 0, 0.00, -15.83015473, -70.01895905, 1, 117, '2026-02-01', NULL, 116, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_117_696dad3dd0d5c.jpg'),
('danza_118', 'Asociación Juvenil Carabaya Sikuris 8 De Diciembre - Macusani', 'Autoctonos', '#4CAF50', '🕺', 0.0000, 0.50, 0, 0, 0.00, -15.83015473, -70.01895905, 1, 118, '2026-02-01', NULL, 117, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_118_696dad3dd4006.jpg'),
('danza_119', 'Asociación Folklórica Kajchas De Caracara Nicasio - Lampa', 'Autoctonos', '#4CAF50', '🕺', 0.0000, 0.50, 0, 0, 0.00, -15.83015473, -70.01895905, 1, 119, '2026-02-01', NULL, 118, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_119_696dad3dd33df.jpg'),
('danza_12', 'Asociación Cultural Carnaval Chaku Chucahuacas - Chupa - Azangaro', 'Autoctonos', '#4CAF50', '🕺', 0.0000, 0.50, 0, 0, 0.00, -15.83015473, -70.01895905, 1, 12, '2026-01-31', NULL, 11, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_12_696dad3dcc047.jpg'),
('danza_120', 'Asociación De Zampónistas Juventud Mañazo - Distrito De Mañazo', 'Autoctonos', '#4CAF50', '🕺', 0.0000, 0.50, 0, 0, 0.00, -15.83015473, -70.01895905, 1, 120, '2026-02-01', NULL, 119, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_120_696dad3dd1df5.jpg'),
('danza_121', 'Conjunto Carnaval Lawa K\'umus Del Centro Poblado De Villa Socca - Acora', 'Autoctonos', '#4CAF50', '🕺', 0.0000, 0.50, 0, 0, 0.00, -15.83015473, -70.01895905, 1, 121, '2026-02-01', NULL, 120, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_121_696dad3dd9027.jpg'),
('danza_122', 'Conjunto De Sikuris Legendario Ghený Sankayo Huatta Conima', 'Autoctonos', '#4CAF50', '🕺', 0.0000, 0.50, 0, 0, 0.00, -15.83015473, -70.01895905, 1, 122, '2026-02-01', NULL, 121, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_122_696dad3dda307.jpg'),
('danza_123', 'Asociación Cultural Autenticos Chacareros Titilaca Zona Lago Plateria', 'Autoctonos', '#4CAF50', '🕺', 0.0000, 0.50, 0, 0, 0.00, -15.83015473, -70.01895905, 1, 123, '2026-02-01', NULL, 122, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_123_696dad3dcb4bf.jpg'),
('danza_124', 'Centro Cultural Pulí Pulís De Caracoto - San Roman', 'Autoctonos', '#4CAF50', '🕺', 0.0000, 0.50, 0, 0, 0.00, -15.83015473, -70.01895905, 1, 124, '2026-02-01', NULL, 123, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_124_696dad3dd669a.jpg'),
('danza_125', 'Carnaval De Suatia Palca-Lampa', 'Autoctonos', '#4CAF50', '🕺', 0.0000, 0.50, 0, 0, 0.00, -15.83015473, -70.01895905, 1, 125, '2026-02-01', NULL, 124, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_125_696dad3dd58b3.jpg'),
('danza_126', 'Asociación De Arte Y Cultura Kajelos De Yunguyo Chamacuta - Acora', 'Autoctonos', '#4CAF50', '🕺', 0.0000, 0.50, 0, 0, 0.00, -15.83015473, -70.01895905, 1, 126, '2026-02-01', NULL, 125, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_126_696dad3dd182a.jpg'),
('danza_127', 'Asociación Cultural Uywa Ch\'uas De La Comunidad Campesina De Jatucachi', 'Autoctonos', '#4CAF50', '🕺', 0.0000, 0.50, 0, 0, 0.00, -15.83015473, -70.01895905, 1, 127, '2026-02-01', NULL, 126, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_127_696dad3dd0bb8.jpg'),
('danza_128', 'Asociación Cultural Carnaval De Esmeralda Arapa - Azangaro', 'Autoctonos', '#4CAF50', '🕺', 0.0000, 0.50, 0, 0, 0.00, -15.83015473, -70.01895905, 1, 128, '2026-02-01', NULL, 127, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_128_696dad3dcc61d.jpg'),
('danza_129', 'Asociación Cultural De Arte Zampónistas Confraternidad Acora', 'Autoctonos', '#4CAF50', '🕺', 0.0000, 0.50, 0, 0, 0.00, -15.83015473, -70.01895905, 1, 129, '2026-02-01', NULL, 128, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_129_696dad3dcdfa1.jpg'),
('danza_13', 'Asociación Folklórica Carnaval De Jayllihuaya', 'Autoctonos', '#4CAF50', '🕺', 0.0000, 0.50, 0, 0, 0.00, -15.83015473, -70.01895905, 1, 13, '2026-01-31', NULL, 12, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_13_696dad3dd2a7a.jpg'),
('danza_130', 'Asociación Cultural De Sikuris Fuerza Joven - Puno', 'Autoctonos', '#4CAF50', '🕺', 0.0000, 0.50, 0, 0, 0.00, -15.83015473, -70.01895905, 1, 130, '2026-02-01', NULL, 129, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_130_696dad3dce350.jpg'),
('danza_131', 'Danza De La Soltera Y Larq\'a Llank\'ay-Distrito Lloque Moquegua', 'Autoctonos', '#4CAF50', '🕺', 0.0000, 0.50, 0, 0, 0.00, -15.83015473, -70.01895905, 1, 131, '2026-02-01', NULL, 130, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_131_696dad3ddd491.jpg'),
('danza_132', 'Carnaval Wapululos De Lampa', 'Autoctonos', '#4CAF50', '🕺', 0.0000, 0.50, 0, 0, 0.00, -15.83015473, -70.01895905, 1, 132, '2026-02-01', NULL, 131, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_132_696dad3dd5a3c.jpg'),
('danza_133', 'Conjunto Juventud Chacallada Brisas De Lago Luquina Chico', 'Autoctonos', '#4CAF50', '🕺', 0.0000, 0.50, 0, 0, 0.00, -15.83015473, -70.01895905, 1, 133, '2026-02-01', NULL, 132, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_133_696dad3ddc0c1.jpg'),
('danza_134', 'Centro Cultural Pinkillada Moho', 'Autoctonos', '#4CAF50', '🕺', 0.0000, 0.50, 0, 0, 0.00, -15.83015473, -70.01895905, 1, 134, '2026-02-01', NULL, 133, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_134_696dad3dd6519.jpg'),
('danza_135', 'Centro De Expresión Cultural Wayra Marca - San Roman', 'Autoctonos', '#4CAF50', '🕺', 0.0000, 0.50, 0, 0, 0.00, -15.83015473, -70.01895905, 1, 135, '2026-02-01', NULL, 134, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_135_696dad3dd7162.jpg'),
('danza_136', 'Asociación Cultural Carnaval De Capullani - Puno', 'Autoctonos', '#4CAF50', '🕺', 0.0000, 0.50, 0, 0, 0.00, -15.83015473, -70.01895905, 1, 136, '2026-02-01', NULL, 135, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_136_696dad3dcc277.jpg'),
('danza_137', 'Asociación De Ayarachis Somos Patrimonio De La Cosmovisión Andina Paratia - Lampa', 'Autoctonos', '#4CAF50', '🕺', 0.0000, 0.50, 0, 0, 0.00, -15.83015473, -70.01895905, 1, 137, '2026-02-01', NULL, 136, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_137_696dad3dd1b22.jpg'),
('danza_138', 'Agrupación Juvenil Nuevo Amanecer Sikuris Inti Marca - Coata', 'Autoctonos', '#4CAF50', '🕺', 0.0000, 0.50, 0, 0, 0.00, -15.83015473, -70.01895905, 1, 138, '2026-02-01', NULL, 137, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_138_696dad3dc7d4e.jpg'),
('danza_139', 'Sikuris/Danzas originarias Clasificado De Manco Capac 2025', 'Autoctonos', '#4CAF50', '🕺', 0.0000, 0.50, 0, 0, 0.00, -15.83015473, -70.01895905, 1, 139, '2026-02-01', NULL, 138, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_139_696dad3de0a96.jpg'),
('danza_14', 'Cultural De Arte Milenario Heraldos Sangre Aymara - Ilave', 'Autoctonos', '#4CAF50', '🕺', 0.0000, 0.50, 0, 0, 0.00, -15.83015473, -70.01895905, 1, 14, '2026-01-31', NULL, 13, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_14_696dad3ddd198.jpg'),
('danza_140', 'Centro Cultural Carnaval Ayarcachi De Lacachi Zona Alta', 'Autoctonos', '#4CAF50', '🕺', 0.0000, 0.50, 0, 0, 0.00, -15.83015473, -70.01895905, 1, 140, '2026-02-01', NULL, 139, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_140_696dad3dd5d79.jpg'),
('danza_141', 'Centro De Cultura Andina Varados De Ichu', 'Autoctonos', '#4CAF50', '🕺', 0.0000, 0.50, 0, 0, 0.00, -15.83015473, -70.01895905, 1, 141, '2026-02-01', NULL, 140, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_141_696dad3dd69d0.jpg'),
('danza_142', 'Conjunto Folklórico Papa Tarpuy Alto Cataka - Lampa', 'Autoctonos', '#4CAF50', '🕺', 0.0000, 0.50, 0, 0, 0.00, -15.83015473, -70.01895905, 1, 142, '2026-02-01', NULL, 141, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_142_696dad3ddbf31.jpg'),
('danza_143', 'Asociación Folklórico Carnaval De Arapa', 'Autoctonos', '#4CAF50', '🕺', 0.0000, 0.50, 0, 0, 0.00, -15.83015473, -70.01895905, 1, 143, '2026-02-01', NULL, 142, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_143_696dad3dd3cd1.jpg'),
('danza_144', 'Asociación Cultural Carnaval Tupay Zona Lago Chocco - Chupa - Azangaro', 'Autoctonos', '#4CAF50', '🕺', 0.0000, 0.50, 0, 0, 0.00, -15.83015473, -70.01895905, 1, 144, '2026-02-01', NULL, 143, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_144_696dad3dcd813.jpg'),
('danza_145', 'Organización Cultural Armonia de vientos Huj\'maya', 'Luces Parada', '#E91E63', '🎭', 0.0000, 0.50, 0, 0, 0.00, -15.83015473, -70.01895905, 1, 145, '2026-02-08', '2026-02-09', NULL, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_145_696dad3de0046.jpg'),
('danza_146', 'Conjunto de Sikuris Glorioso San Carlos', 'Luces Parada', '#E91E63', '🎭', 0.0000, 0.50, 0, 0, 0.00, -15.83015473, -70.01895905, 1, 146, '2026-02-08', '2026-02-09', NULL, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_146_696dad3ddd031.jpg'),
('danza_147', 'Asociacion Cultural Diablada Confraternidad Huascar', 'Luces Parada', '#E91E63', '🎭', 0.0000, 0.50, 0, 0, 0.00, -15.83058949, -70.02006215, 1, 147, '2026-02-08', '2026-02-10', 1, 85, NULL, '/candelaria/assets/uploads/danzas/danza_147_696dad3dc8434.jpg'),
('danza_148', 'Centro Cultural Melodías El Collao - Ilave', 'Luces Parada', '#E91E63', '🎭', 0.0000, 0.50, 0, 0, 0.00, -15.83015473, -70.01895905, 1, 148, '2026-02-08', '2026-02-10', 2, 88, NULL, '/candelaria/assets/uploads/danzas/danza_148_696dad3dd63a8.jpg'),
('danza_149', 'La Gran Confraternidad Llamerada Virgen De La Candelaria Central Puno - La Gran Collavic - Puno', 'Luces Parada', '#E91E63', '🎭', 0.0000, 0.50, 0, 0, 0.00, -15.83015473, -70.01895905, 1, 149, '2026-02-08', '2026-02-10', 3, 97, NULL, '/candelaria/assets/uploads/danzas/danza_149_696dad3ddf1ad.jpg'),
('danza_15', 'Conjunto Autóctono Cahuires Tajquina - Chucuito', 'Autoctonos', '#4CAF50', '🕺', 0.0000, 0.50, 0, 0, 0.00, -15.83015473, -70.01895905, 1, 15, '2026-01-31', NULL, 14, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_15_696dad3dd8641.jpg'),
('danza_150', 'Morenada San Martin', 'Luces Parada', '#E91E63', '🎭', 0.0000, 0.50, 0, 0, 0.00, -15.83015473, -70.01895905, 1, 150, '2026-02-08', '2026-02-10', 4, 92, NULL, '/candelaria/assets/uploads/danzas/danza_150_696dad3ddfd03.jpg'),
('danza_151', 'Asociacion Folklórica Andino Amazonico Tobas Central Peru', 'Luces Parada', '#E91E63', '🎭', 0.0000, 0.50, 0, 0, 0.00, -15.83015473, -70.01895905, 1, 151, '2026-02-08', '2026-02-10', 5, 89, NULL, '/candelaria/assets/uploads/danzas/danza_151_696dad3dc87b6.jpg'),
('danza_152', 'Asociacion Romeos De Candelaria', 'Luces Parada', '#E91E63', '🎭', 0.0000, 0.50, 0, 0, 0.00, -15.83015473, -70.01895905, 1, 152, '2026-02-08', '2026-02-10', 6, 95, NULL, '/candelaria/assets/uploads/danzas/danza_152_696dad3dcac8e.jpg'),
('danza_153', 'Conjunto De Danzas Altiplanicas De La Uni (Tuntuna Uni)', 'Luces Parada', '#E91E63', '🎭', 0.0000, 0.50, 0, 0, 0.00, -15.83015473, -70.01895905, 1, 153, '2026-02-08', '2026-02-10', 7, 94, NULL, '/candelaria/assets/uploads/danzas/danza_153_696dad3dd9b76.jpg'),
('danza_154', 'Asociacion Cultural Incomparable Gran Diablada Amigos De La PNP', 'Luces Parada', '#E91E63', '🎭', 0.0000, 0.50, 0, 0, 0.00, -15.83015473, -70.01895905, 1, 154, '2026-02-08', '2026-02-10', 8, 93, NULL, '/candelaria/assets/uploads/danzas/danza_154_696dad3dc85af.jpg'),
('danza_155', 'Centro Cultural Sentimiento Sikuris Las Vicuñas De La Inmaculada - Lampa', 'Luces Parada', '#E91E63', '🎭', 0.0000, 0.50, 0, 0, 0.00, -15.83015473, -70.01895905, 1, 155, '2026-02-08', '2026-02-10', 9, 87, NULL, '/candelaria/assets/uploads/danzas/danza_155_696dad3dd6827.jpg'),
('danza_156', 'Gran Morenada Salcedo', 'Luces Parada', '#E91E63', '🎭', 0.0000, 0.50, 0, 0, 0.00, -15.83015473, -70.01895905, 1, 156, '2026-02-08', '2026-02-10', 10, 91, NULL, '/candelaria/assets/uploads/danzas/danza_156_696dad3dde3b1.jpg'),
('danza_157', 'Confraternidad Central Tobas Sur', 'Luces Parada', '#E91E63', '🎭', 0.0000, 0.50, 0, 0, 0.00, -15.83015473, -70.01895905, 1, 157, '2026-02-08', '2026-02-10', 11, 86, NULL, '/candelaria/assets/uploads/danzas/danza_157_696dad3dd791c.jpg'),
('danza_158', 'Asociación Juvenil Puno Sikuris 27 De Junio (AJP)', 'Luces Parada', '#E91E63', '🎭', 0.0000, 0.50, 0, 0, 0.00, -15.83015473, -70.01895905, 1, 158, '2026-02-08', '2026-02-10', 12, 90, NULL, '/candelaria/assets/uploads/danzas/danza_158_696dad3dd437d.jpg'),
('danza_159', 'Confraternidad Poderosa Y Espectacular Morenada San Valentin - Ilave', 'Luces Parada', '#E91E63', '🎭', 0.0000, 0.50, 0, 0, 0.00, -15.83015473, -70.01895905, 1, 159, '2026-02-08', '2026-02-10', 13, 96, NULL, '/candelaria/assets/uploads/danzas/danza_159_696dad3dd82a9.jpg'),
('danza_16', 'Conjunto Arte Folklórico Nueva Generación Kajelos Del C.P. Marca Esqueña', 'Autoctonos', '#4CAF50', '🕺', 0.0000, 0.50, 0, 0, 0.00, -15.83015473, -70.01895905, 1, 16, '2026-01-31', NULL, 15, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_16_696dad3dd848b.jpg'),
('danza_160', 'Conjunto De Zampoñas Y Danzas Uni', 'Luces Parada', '#E91E63', '🎭', 0.0000, 0.50, 0, 0, 0.00, -15.83015473, -70.01895905, 1, 160, '2026-02-08', '2026-02-09', 14, 1, NULL, '/candelaria/assets/uploads/danzas/danza_160_696dad3dda918.jpg'),
('danza_161', 'Conjunto Clasificado Salida De Manco Capac Y Mama Ocllo 2025 (Cupo A)', 'Luces Parada', '#E91E63', '🎭', 0.0000, 0.50, 0, 0, 0.00, -15.83015473, -70.01895905, 1, 161, '2026-02-08', '2026-02-09', NULL, 2, NULL, '/candelaria/assets/uploads/danzas/danza_161_696dad3dd9566.jpg'),
('danza_162', 'Sociedad De Expresión Cultural Sikuris Wara Wara Wayras Huatasani - Huancane', 'Luces Parada', '#E91E63', '🎭', 0.0000, 0.50, 0, 0, 0.00, -15.83015473, -70.01895905, 1, 162, '2026-02-08', '2026-02-09', 16, 43, NULL, '/candelaria/assets/uploads/danzas/danza_162_696dad3de11fa.jpg'),
('danza_163', 'Escuela De Arte \"Jose Carlos Mariategui\" Zambos Tundiques', 'Luces Parada', '#E91E63', '🎭', 0.0000, 0.50, 0, 0, 0.00, -15.83015473, -70.01895905, 1, 163, '2026-02-08', '2026-02-09', 17, 19, NULL, '/candelaria/assets/uploads/danzas/danza_163_696dad3ddda4d.jpg'),
('danza_164', 'Confraternidad Diablada San Antonio', 'Luces Parada', '#E91E63', '🎭', 0.0000, 0.50, 0, 0, 0.00, -15.83015473, -70.01895905, 1, 164, '2026-02-08', '2026-02-10', 18, 55, NULL, '/candelaria/assets/uploads/danzas/danza_164_696dad3dd7bef.jpg'),
('danza_165', 'Asociación De Expresión Cultural Juvenil 29 De Septiembre - Ilave', 'Luces Parada', '#E91E63', '🎭', 0.0000, 0.50, 0, 0, 0.00, -15.83015473, -70.01895905, 1, 165, '2026-02-08', '2026-02-10', 19, 68, NULL, '/candelaria/assets/uploads/danzas/danza_165_696dad3dd1c8d.jpg'),
('danza_166', 'Conjunto Folklórico Morenada Orkapata', 'Luces Parada', '#E91E63', '🎭', 0.0000, 0.50, 0, 0, 0.00, -15.83015473, -70.01895905, 1, 166, '2026-02-08', '2026-02-09', 20, 47, NULL, '/candelaria/assets/uploads/danzas/danza_166_696dad3ddbd93.jpg'),
('danza_167', 'Caporales Centro Cultural Andino', 'Luces Parada', '#E91E63', '🎭', 0.0000, 0.50, 0, 0, 0.00, -15.83015473, -70.01895905, 1, 167, '2026-02-08', '2026-02-10', 21, 81, NULL, '/candelaria/assets/uploads/danzas/danza_167_696dad3dd50d7.jpg'),
('danza_168', 'Conjunto De Músicos Y Danzas Autóctonas \"Wiñay Qhantati\" Ururi Conima', 'Luces Parada', '#E91E63', '🎭', 0.0000, 0.50, 0, 0, 0.00, -15.83015473, -70.01895905, 1, 168, '2026-02-08', '2026-02-10', 22, 80, NULL, '/candelaria/assets/uploads/danzas/danza_168_696dad3dd9fd4.jpg'),
('danza_169', 'Morenada Huajsapata', 'Luces Parada', '#E91E63', '🎭', 0.0000, 0.50, 0, 0, 0.00, -15.83015473, -70.01895905, 1, 169, '2026-02-08', '2026-02-10', 23, 65, NULL, '/candelaria/assets/uploads/danzas/danza_169_696dad3ddfa05.jpg'),
('danza_17', 'Asociación Central Pulipulis De Taraco', 'Autoctonos', '#4CAF50', '🕺', 0.0000, 0.50, 0, 0, 0.00, -15.83015473, -70.01895905, 1, 17, '2026-01-31', NULL, 16, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_17_696dad3dcaf80.jpg'),
('danza_170', 'Conjunto Folklórico La Llamerada Del Club Juvenil Andino De Lampa', 'Luces Parada', '#E91E63', '🎭', 0.0000, 0.50, 0, 0, 0.00, -15.83015473, -70.01895905, 1, 170, '2026-02-08', '2026-02-09', 24, 39, NULL, '/candelaria/assets/uploads/danzas/danza_170_696dad3ddba84.jpg'),
('danza_171', 'Agrupación De Sikuris Raíces Aymaras - Ilave \"Asikur\"', 'Luces Parada', '#E91E63', '🎭', 0.0000, 0.50, 0, 0, 0.00, -15.83015473, -70.01895905, 1, 171, '2026-02-08', '2026-02-09', 25, 3, NULL, '/candelaria/assets/uploads/danzas/danza_171_696dad3dc775f.jpg'),
('danza_172', 'Asociación Folklórica Diablada Azoguini', 'Luces Parada', '#E91E63', '🎭', 0.0000, 0.50, 0, 0, 0.00, -15.83015473, -70.01895905, 1, 172, '2026-02-08', '2026-02-09', 26, 48, NULL, '/candelaria/assets/uploads/danzas/danza_172_696dad3dd2f15.jpg'),
('danza_173', 'Confraternidad Morenada Santa Rosa - Puno', 'Luces Parada', '#E91E63', '🎭', 0.0000, 0.50, 0, 0, 0.00, -15.83015473, -70.01895905, 1, 173, '2026-02-08', '2026-02-10', 27, 82, NULL, '/candelaria/assets/uploads/danzas/danza_173_696dad3dd7edb.jpg'),
('danza_174', 'Asociación Folklórica Caporales San Valentin', 'Luces Parada', '#E91E63', '🎭', 0.0000, 0.50, 0, 0, 0.00, -15.83015473, -70.01895905, 1, 174, '2026-02-08', '2026-02-09', 28, 9, NULL, '/candelaria/assets/uploads/danzas/danza_174_696dad3dd2758.jpg'),
('danza_175', 'Grupo De Arte 14 De Septiembre - Moho', 'Luces Parada', '#E91E63', '🎭', 0.0000, 0.50, 0, 0, 0.00, -15.83015473, -70.01895905, 1, 175, '2026-02-08', '2026-02-09', 29, 23, NULL, '/candelaria/assets/uploads/danzas/danza_175_696dad3dde531.jpg'),
('danza_176', 'Conjunto De Arte Y Folklore Sikuris Juventud Obrera', 'Luces Parada', '#E91E63', '🎭', 0.0000, 0.50, 0, 0, 0.00, -15.83015473, -70.01895905, 1, 176, '2026-02-08', '2026-02-10', 30, 77, NULL, '/candelaria/assets/uploads/danzas/danza_176_696dad3dd9a0d.jpg'),
('danza_177', 'Morenada Central Galeno - Dr. Ricardo J. Ruelas Rodriguez', 'Luces Parada', '#E91E63', '🎭', 0.0000, 0.50, 0, 0, 0.00, -15.83015473, -70.01895905, 1, 177, '2026-02-08', '2026-02-09', 31, 37, NULL, '/candelaria/assets/uploads/danzas/danza_177_696dad3ddf6d8.jpg'),
('danza_178', 'Asociación Folklórica Caporales \"Sambos Con Sentimiento Y Devoción Porteño\"', 'Luces Parada', '#E91E63', '🎭', 0.0000, 0.50, 0, 0, 0.00, -15.83015473, -70.01895905, 1, 178, '2026-02-08', '2026-02-10', 32, 54, NULL, '/candelaria/assets/uploads/danzas/danza_178_696dad3dd25c3.jpg'),
('danza_179', 'Rey Moreno Laykakota', 'Luces Parada', '#E91E63', '🎭', 0.0000, 0.50, 0, 0, 0.00, -15.83015473, -70.01895905, 1, 179, '2026-02-08', '2026-02-10', 33, 51, NULL, '/candelaria/assets/uploads/danzas/danza_179_696dad3de04d7.jpg'),
('danza_18', 'Asociación Cultural Carnaval De Chupa', 'Autoctonos', '#4CAF50', '🕺', 0.0000, 0.50, 0, 0, 0.00, -15.83015473, -70.01895905, 1, 18, '2026-01-31', NULL, 17, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_18_696dad3dcc437.jpg'),
('danza_180', 'Asociación Cultural Sangre Indomable - Azangaro', 'Luces Parada', '#E91E63', '🎭', 0.0000, 0.50, 0, 0, 0.00, -15.83015473, -70.01895905, 1, 180, '2026-02-08', '2026-02-10', 34, 49, NULL, '/candelaria/assets/uploads/danzas/danza_180_696dad3dd00b6.jpg'),
('danza_181', 'Poderosa Espectacular Waca Waca Alto Puno', 'Luces Parada', '#E91E63', '🎭', 0.0000, 0.50, 0, 0, 0.00, -15.83015473, -70.01895905, 1, 181, '2026-02-08', '2026-02-10', 35, 78, NULL, '/candelaria/assets/uploads/danzas/danza_181_696dad3de01be.jpg'),
('danza_182', 'Cofradía De Negritos Chacón Beaterio De Huanuco', 'Luces Parada', '#E91E63', '🎭', 0.0000, 0.50, 0, 0, 0.00, -15.83015473, -70.01895905, 1, 182, '2026-02-08', '2026-02-10', 36, 56, NULL, '/candelaria/assets/uploads/danzas/danza_182_696dad3dd77b3.jpg'),
('danza_183', 'Morenada Virgen De La Candelaria - Mandachitos', 'Luces Parada', '#E91E63', '🎭', 0.0000, 0.50, 0, 0, 0.00, -15.83015473, -70.01895905, 1, 183, '2026-02-08', '2026-02-09', 37, 6, NULL, '/candelaria/assets/uploads/danzas/danza_183_696dad3ddfec1.jpg'),
('danza_184', 'Expresión Cultural Milenarios De Sikuris Internacional Los Rosales Rosaspata - Huancane', 'Luces Parada', '#E91E63', '🎭', 0.0000, 0.50, 0, 0, 0.00, -15.83015473, -70.01895905, 1, 184, '2026-02-08', '2026-02-09', 38, 18, NULL, '/candelaria/assets/uploads/danzas/danza_184_696dad3dddd31.jpg'),
('danza_185', 'Asociación La Voz Cultural Khantus 13 De Mayo - Distrito Huayrapata', 'Luces Parada', '#E91E63', '🎭', 0.0000, 0.50, 0, 0, 0.00, -15.83015473, -70.01895905, 1, 185, '2026-02-08', '2026-02-10', 39, 66, NULL, '/candelaria/assets/uploads/danzas/danza_185_696dad3dd46c8.jpg'),
('danza_186', 'Escuela Internacional Del Folklore Caporales Del Sur Puno', 'Luces Parada', '#E91E63', '🎭', 0.0000, 0.50, 0, 0, 0.00, -15.83015473, -70.01895905, 1, 186, '2026-02-08', '2026-02-09', 40, 40, NULL, '/candelaria/assets/uploads/danzas/danza_186_696dad3dddbae.jpg'),
('danza_187', 'Asociación Cultural Kullahuada Virgen Maria De La Candelaria', 'Luces Parada', '#E91E63', '🎭', 0.0000, 0.50, 0, 0, 0.00, -15.83015473, -70.01895905, 1, 187, '2026-02-08', '2026-02-10', 41, 64, NULL, '/candelaria/assets/uploads/danzas/danza_187_696dad3dcf5af.jpg'),
('danza_188', 'Waca Waca Del Barrio Porteño', 'Luces Parada', '#E91E63', '🎭', 0.0000, 0.50, 0, 0, 0.00, -15.83015473, -70.01895905, 1, 188, '2026-02-08', '2026-02-09', 42, 10, NULL, '/candelaria/assets/uploads/danzas/danza_188_696dad3de2995.jpg'),
('danza_189', 'Asociación Folklórica \"Caporales Victoria\" - Puno', 'Luces Parada', '#E91E63', '🎭', 0.0000, 0.50, 0, 0, 0.00, -15.83015473, -70.01895905, 1, 189, '2026-02-08', '2026-02-10', 43, 76, NULL, '/candelaria/assets/uploads/danzas/danza_189_696dad3dd28e2.jpg'),
('danza_19', 'Conjunto Folklórico Carnaval De Taraco', 'Autoctonos', '#4CAF50', '🕺', 0.0000, 0.50, 0, 0, 0.00, -15.83015473, -70.01895905, 1, 19, '2026-01-31', NULL, 18, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_19_696dad3ddb421.jpg'),
('danza_190', 'Asociación De Zampónistas Y Danzas Autóctonas San Francisco De Borja - Yunguyo', 'Luces Parada', '#E91E63', '🎭', 0.0000, 0.50, 0, 0, 0.00, -15.83015473, -70.01895905, 1, 190, '2026-02-08', '2026-02-10', 44, 83, NULL, '/candelaria/assets/uploads/danzas/danza_190_696dad3dd1f7a.jpg'),
('danza_191', 'Agrupación Cultural Milenaria De Sikuris Internacional Huarihuma Rosaspata - Huancane', 'Luces Parada', '#E91E63', '🎭', 0.0000, 0.50, 0, 0, 0.00, -15.83015473, -70.01895905, 1, 191, '2026-02-08', '2026-02-09', 45, 45, NULL, '/candelaria/assets/uploads/danzas/danza_191_696dad3dc6960.jpg'),
('danza_192', 'Tradicional Diablada Porteño', 'Luces Parada', '#E91E63', '🎭', 0.0000, 0.50, 0, 0, 0.00, -15.83015473, -70.01895905, 1, 192, '2026-02-08', '2026-02-10', 47, 70, NULL, '/candelaria/assets/uploads/danzas/danza_192_696dad3de1591.jpg'),
('danza_193', 'Tradicional Rey Moreno San Antonio', 'Luces Parada', '#E91E63', '🎭', 0.0000, 0.50, 0, 0, 0.00, -15.83015473, -70.01895905, 1, 193, '2026-02-08', '2026-02-09', 48, 16, NULL, '/candelaria/assets/uploads/danzas/danza_193_696dad3de179a.jpg'),
('danza_194', 'Wifalas San Francisco Javier de Muñani (Campeón en Danzas Originarias 2025)', 'Luces Parada', '#E91E63', '🎭', 0.0000, 0.50, 0, 0, 0.00, -15.83015473, -70.01895905, 1, 194, '2026-02-08', '2026-02-09', NULL, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_194_696dad3de2bb3.jpg'),
('danza_195', 'Confraternidad Cultural Wacas Puno', 'Luces Parada', '#E91E63', '🎭', 0.0000, 0.50, 0, 0, 0.00, -15.83015473, -70.01895905, 1, 195, '2026-02-08', '2026-02-10', 49, 57, NULL, '/candelaria/assets/uploads/danzas/danza_195_696dad3dd7a80.jpg'),
('danza_196', 'Asociación Morenada Porteño', 'Luces Parada', '#E91E63', '🎭', 0.0000, 0.50, 0, 0, 0.00, -15.83015473, -70.01895905, 1, 196, '2026-02-08', '2026-02-09', 50, 42, NULL, '/candelaria/assets/uploads/danzas/danza_196_696dad3dd486b.jpg'),
('danza_197', 'Agrupación Sociedad Cultural Autóctono Sikuris Wila Marca De Conima', 'Luces Parada', '#E91E63', '🎭', 0.0000, 0.50, 0, 0, 0.00, -15.83015473, -70.01895905, 1, 197, '2026-02-08', '2026-02-10', 51, 59, NULL, '/candelaria/assets/uploads/danzas/danza_197_696dad3dc829d.jpg'),
('danza_198', 'Asociación Folklórica Tinkus Señor De Machallata', 'Luces Parada', '#E91E63', '🎭', 0.0000, 0.50, 0, 0, 0.00, -15.83015473, -70.01895905, 1, 198, '2026-02-08', '2026-02-10', 52, 73, NULL, '/candelaria/assets/uploads/danzas/danza_198_696dad3dd3839.jpg'),
('danza_199', 'Asociación Cultural Zampónistas Lacustre Del Barrio José Antonio Encinas', 'Luces Parada', '#E91E63', '🎭', 0.0000, 0.50, 0, 0, 0.00, -15.83015473, -70.01895905, 1, 199, '2026-02-08', '2026-02-09', 53, 5, NULL, '/candelaria/assets/uploads/danzas/danza_199_696dad3dd1222.jpg'),
('danza_2', 'Carnaval De Nicasio', 'Autoctonos', '#4CAF50', '🕺', 0.0000, 0.50, 0, 0, 0.00, -15.84847069, -70.01713514, 1, 2, '2026-01-31', NULL, 1, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_2_696dad3dd55c0.jpg'),
('danza_20', 'Asociación De Arte Folclórico Conjunto Yapuchiris 25 De Julio Huilacaya', 'Autoctonos', '#4CAF50', '🕺', 0.0000, 0.50, 0, 0, 0.00, -15.83015473, -70.01895905, 1, 20, '2026-01-31', NULL, 19, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_20_696dad3dd153f.jpg'),
('danza_200', 'Asociación Cultural Caporales Centralistas Puno', 'Luces Parada', '#E91E63', '🎭', 0.0000, 0.50, 0, 0, 0.00, -15.83015473, -70.01895905, 1, 200, '2026-02-08', '2026-02-10', 54, 67, NULL, '/candelaria/assets/uploads/danzas/danza_200_696dad3dcb6d1.jpg'),
('danza_201', 'Auténticos Ayarachis Tawantin Ayllu Cuyo Cuyo - Sandia', 'Luces Parada', '#E91E63', '🎭', 0.0000, 0.50, 0, 0, 0.00, -15.83015473, -70.01895905, 1, 201, '2026-02-08', '2026-02-09', 55, 26, NULL, '/candelaria/assets/uploads/danzas/danza_201_696dad3dd4f01.jpg'),
('danza_202', 'Asociación Folklórica Espectacular Diablada Bellavista', 'Luces Parada', '#E91E63', '🎭', 0.0000, 0.50, 0, 0, 0.00, -15.83015473, -70.01895905, 1, 202, '2026-02-08', '2026-02-09', 56, 36, NULL, '/candelaria/assets/uploads/danzas/danza_202_696dad3dd3222.jpg'),
('danza_203', 'Sociedad Centro Social De Folklore Y Cultura: Sikuris Y Danzas Autóctonas \"Fundación Pokopaka\" De Huancane', 'Luces Parada', '#E91E63', '🎭', 0.0000, 0.50, 0, 0, 0.00, -15.83015473, -70.01895905, 1, 203, '2026-02-08', '2026-02-10', 57, 71, NULL, '/candelaria/assets/uploads/danzas/danza_203_696dad3de0c00.jpg'),
('danza_204', 'Agrupación Kullahuada Victoria', 'Luces Parada', '#E91E63', '🎭', 0.0000, 0.50, 0, 0, 0.00, -15.83015473, -70.01895905, 1, 204, '2026-02-08', '2026-02-09', 58, 17, NULL, '/candelaria/assets/uploads/danzas/danza_204_696dad3dc7f23.jpg'),
('danza_205', 'Asociación Cultural De Sikuris Intercontinentales Aymaras De Huancané', 'Luces Parada', '#E91E63', '🎭', 0.0000, 0.50, 0, 0, 0.00, -15.83015473, -70.01895905, 1, 205, '2026-02-08', '2026-02-10', 59, 53, NULL, '/candelaria/assets/uploads/danzas/danza_205_696dad3dce520.jpg'),
('danza_206', 'Asociación Cultural Ecologista Etnias Amazonicas Del Peru-Biodanza', 'Luces Parada', '#E91E63', '🎭', 0.0000, 0.50, 0, 0, 0.00, -15.83015473, -70.01895905, 1, 206, '2026-02-08', '2026-02-10', 60, 52, NULL, '/candelaria/assets/uploads/danzas/danza_206_696dad3dcea35.jpg'),
('danza_207', 'Asociación De Arte Cultura Y Folklore Caporales De Siempre - Pitones', 'Luces Parada', '#E91E63', '🎭', 0.0000, 0.50, 0, 0, 0.00, -15.83015473, -70.01895905, 1, 207, '2026-02-08', '2026-02-09', 61, 35, NULL, '/candelaria/assets/uploads/danzas/danza_207_696dad3dd13cb.jpg'),
('danza_208', 'Confraternidad Morenada Intocables Juliaca Mia', 'Luces Parada', '#E91E63', '🎭', 0.0000, 0.50, 0, 0, 0.00, -15.83015473, -70.01895905, 1, 208, '2026-02-08', '2026-02-10', 62, 79, NULL, '/candelaria/assets/uploads/danzas/danza_208_696dad3dd7d68.jpg'),
('danza_209', 'Asociación Cultural De Sikuris Los Aymaras De Huancane', 'Luces Parada', '#E91E63', '🎭', 0.0000, 0.50, 0, 0, 0.00, -15.83015473, -70.01895905, 1, 209, '2026-02-08', '2026-02-09', 63, 8, NULL, '/candelaria/assets/uploads/danzas/danza_209_696dad3dce6d4.jpg'),
('danza_21', 'Asociación Juvenil De Sikuris Y Zampoñas Wayra Marca - Juliaca', 'Autoctonos', '#4CAF50', '🕺', 0.0000, 0.50, 0, 0, 0.00, -15.83015473, -70.01895905, 1, 21, '2026-01-31', NULL, 20, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_21_696dad3dd41a5.jpg'),
('danza_210', 'Conjunto De Zampoñas \"Expresión Cultural\" Del Centro Poblado De Ocoña - Ilave', 'Luces Parada', '#E91E63', '🎭', 0.0000, 0.50, 0, 0, 0.00, -15.83015473, -70.01895905, 1, 210, '2026-02-08', '2026-02-09', 64, 15, NULL, '/candelaria/assets/uploads/danzas/danza_210_696dad3dda63c.jpg'),
('danza_211', 'Conjunto \"Rey Caporal Independencia\" - Puno', 'Luces Parada', '#E91E63', '🎭', 0.0000, 0.50, 0, 0, 0.00, -15.83015473, -70.01895905, 1, 211, '2026-02-08', '2026-02-10', 65, 74, NULL, '/candelaria/assets/uploads/danzas/danza_211_696dad3ddc9c9.jpg'),
('danza_212', 'Asociación Folklórica Waca Waca Santa Rosa', 'Luces Parada', '#E91E63', '🎭', 0.0000, 0.50, 0, 0, 0.00, -15.83015473, -70.01895905, 1, 212, '2026-02-08', '2026-02-09', 66, 38, NULL, '/candelaria/assets/uploads/danzas/danza_212_696dad3dd3b65.jpg'),
('danza_213', 'Asociación Cultural Folklórica Caporales Huascar', 'Luces Parada', '#E91E63', '🎭', 0.0000, 0.50, 0, 0, 0.00, -15.83015473, -70.01895905, 1, 213, '2026-02-08', '2026-02-10', 67, 60, NULL, '/candelaria/assets/uploads/danzas/danza_213_696dad3dcec15.jpg'),
('danza_214', 'Morenada Laykakota', 'Luces Parada', '#E91E63', '🎭', 0.0000, 0.50, 0, 0, 0.00, -15.83015473, -70.01895905, 1, 214, '2026-02-08', '2026-02-09', 68, 27, NULL, '/candelaria/assets/uploads/danzas/danza_214_696dad3ddfb7d.jpg'),
('danza_215', 'Conjunto Folklórico Los Caporales De La Tuntuna Del Barrio Miraflores Catumi - Puno', 'Luces Parada', '#E91E63', '🎭', 0.0000, 0.50, 0, 0, 0.00, -15.83015473, -70.01895905, 1, 215, '2026-02-08', '2026-02-09', 69, 14, NULL, '/candelaria/assets/uploads/danzas/danza_215_696dad3ddbc13.jpg'),
('danza_216', 'Agrupacion Sangre Chumbivilcana - Danza Huaylia Chumbivilcana-Cusco', 'Luces Parada', '#E91E63', '🎭', 0.0000, 0.50, 0, 0, 0.00, -15.83015473, -70.01895905, 1, 216, '2026-02-08', '2026-02-09', 70, 22, NULL, '/candelaria/assets/uploads/danzas/danza_216_696dad3dc651b.jpg'),
('danza_217', 'Fraternidad Artística Sambos Caporales Señor De Quillor-Ritty', 'Luces Parada', '#E91E63', '🎭', 0.0000, 0.50, 0, 0, 0.00, -15.83015473, -70.01895905, 1, 217, '2026-02-08', '2026-02-09', 71, 31, NULL, '/candelaria/assets/uploads/danzas/danza_217_696dad3dde077.jpg'),
('danza_218', 'Conjunto Sikuris 15 De Mayo De Cambria - Conima', 'Luces Parada', '#E91E63', '🎭', 0.0000, 0.50, 0, 0, 0.00, -15.83015473, -70.01895905, 1, 218, '2026-02-08', '2026-02-09', 72, 34, NULL, '/candelaria/assets/uploads/danzas/danza_218_696dad3ddcb57.jpg'),
('danza_219', 'Diablada Confraternidad Victoria', 'Luces Parada', '#E91E63', '🎭', 0.0000, 0.50, 0, 0, 0.00, -15.83015473, -70.01895905, 1, 219, '2026-02-08', '2026-02-09', 73, 21, NULL, '/candelaria/assets/uploads/danzas/danza_219_696dad3ddd8eb.jpg'),
('danza_22', 'Asociación Cultural Carnaval De Huerta Huaraya - Puno', 'Autoctonos', '#4CAF50', '🕺', 0.0000, 0.50, 0, 0, 0.00, -15.83015473, -70.01895905, 1, 22, '2026-01-31', NULL, 21, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_22_696dad3dcc80b.jpg'),
('danza_220', 'Agrupación De Zampónistas Del Altiplano Del Barrio Huajsapata-Puno', 'Luces Parada', '#E91E63', '🎭', 0.0000, 0.50, 0, 0, 0.00, -15.83015473, -70.01895905, 1, 220, '2026-02-08', '2026-02-09', 74, 25, NULL, '/candelaria/assets/uploads/danzas/danza_220_696dad3dc7960.jpg'),
('danza_221', 'Asociación Cultural Folklórica \"Legado Caporal\"', 'Luces Parada', '#E91E63', '🎭', 0.0000, 0.50, 0, 0, 0.00, -15.83015473, -70.01895905, 1, 221, '2026-02-08', '2026-02-09', 75, 24, NULL, '/candelaria/assets/uploads/danzas/danza_221_696dad3dced9e.jpg'),
('danza_222', 'Auténticos Ayarachis De Antalla Palca - Lampa', 'Luces Parada', '#E91E63', '🎭', 0.0000, 0.50, 0, 0, 0.00, -15.83015473, -70.01895905, 1, 222, '2026-02-08', '2026-02-10', 76, 72, NULL, '/candelaria/assets/uploads/danzas/danza_222_696dad3dd4d56.jpg'),
('danza_223', 'Asociación Cultural Folklórica Tobas Amazonas Anata', 'Luces Parada', '#E91E63', '🎭', 0.0000, 0.50, 0, 0, 0.00, -15.83015473, -70.01895905, 1, 223, '2026-02-08', '2026-02-09', 77, 32, NULL, '/candelaria/assets/uploads/danzas/danza_223_696dad3dcef38.jpg'),
('danza_224', 'Asociación Cultural \"Morenada Azoguini\"', 'Luces Parada', '#E91E63', '🎭', 0.0000, 0.50, 0, 0, 0.00, -15.83015473, -70.01895905, 1, 224, '2026-02-08', '2026-02-09', 78, 12, NULL, '/candelaria/assets/uploads/danzas/danza_224_696dad3dcf8f5.jpg'),
('danza_225', 'Centro Social Kullawada Central Puno', 'Luces Parada', '#E91E63', '🎭', 0.0000, 0.50, 0, 0, 0.00, -15.83015473, -70.01895905, 1, 225, '2026-02-08', '2026-02-09', 79, 28, NULL, '/candelaria/assets/uploads/danzas/danza_225_696dad3dd7320.jpg'),
('danza_226', 'Asociación De Arte Y Folclore Caporales San Juan Bautista - Puno', 'Luces Parada', '#E91E63', '🎭', 0.0000, 0.50, 0, 0, 0.00, -15.83015473, -70.01895905, 1, 226, '2026-02-08', '2026-02-10', 80, 63, NULL, '/candelaria/assets/uploads/danzas/danza_226_696dad3dd19ba.jpg'),
('danza_227', 'Conjunto Clasificado Salida De Manco Capac Y Mama Ocllo 2025 (Cupo B)', 'Luces Parada', '#E91E63', '🎭', 0.0000, 0.50, 0, 0, 0.00, -15.83015473, -70.01895905, 1, 227, '2026-02-08', '2026-02-09', 81, 30, NULL, '/candelaria/assets/uploads/danzas/danza_227_696dad3dd970d.jpg'),
('danza_228', 'Centenario Conjunto Sikuris Del Barrio Mañazo', 'Luces Parada', '#E91E63', '🎭', 0.0000, 0.50, 0, 0, 0.00, -15.83015473, -70.01895905, 1, 228, '2026-02-08', '2026-02-09', 82, 41, NULL, '/candelaria/assets/uploads/danzas/danza_228_696dad3dd5bba.jpg'),
('danza_229', 'Agrupación Cultural Sikuris \"Claveles Rojos\" De Huancane', 'Luces Parada', '#E91E63', '🎭', 0.0000, 0.50, 0, 0, 0.00, -15.83015473, -70.01895905, 1, 229, '2026-02-08', '2026-02-09', 83, 29, NULL, '/candelaria/assets/uploads/danzas/danza_229_696dad3dc6bcd.jpg'),
('danza_23', 'Centro De Expresión Cultural Carnaval De Patambuco', 'Autoctonos', '#4CAF50', '🕺', 0.0000, 0.50, 0, 0, 0.00, -15.83015473, -70.01895905, 1, 23, '2026-01-31', NULL, 22, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_23_696dad3dd6cb2.jpg'),
('danza_230', 'Fraternidad Caporales Virgen De La Candelaria \"Vientos Del Sur\"', 'Luces Parada', '#E91E63', '🎭', 0.0000, 0.50, 0, 0, 0.00, -15.83015473, -70.01895905, 1, 230, '2026-02-08', '2026-02-09', 84, 4, NULL, '/candelaria/assets/uploads/danzas/danza_230_696dad3dde20c.jpg'),
('danza_231', 'Poderosa y Espectacular Morenada Bellavista', 'Luces Parada', '#E91E63', '🎭', 0.0000, 0.50, 0, 0, 0.00, -15.83015473, -70.01895905, 1, 231, '2026-02-08', '2026-02-10', 85, 62, NULL, '/candelaria/assets/uploads/danzas/danza_231_696dad3de031f.jpg'),
('danza_232', 'Asociación Cultural De Sikuris Proyecto Pariwanas De Huancane', 'Luces Parada', '#E91E63', '🎭', 0.0000, 0.50, 0, 0, 0.00, -15.83015473, -70.01895905, 1, 232, '2026-02-08', '2026-02-10', 86, 84, NULL, '/candelaria/assets/uploads/danzas/danza_232_696dad3dce882.jpg'),
('danza_233', 'Asociación Cultural Genuinos Ayarachis De Paratia - Lampa', 'Luces Parada', '#E91E63', '🎭', 0.0000, 0.50, 0, 0, 0.00, -15.83015473, -70.01895905, 1, 233, '2026-02-08', '2026-02-10', 87, 69, NULL, '/candelaria/assets/uploads/danzas/danza_233_696dad3dcf0bc.jpg'),
('danza_234', 'Conjunto De Zampónistas Juventud PAXA \"JUPAX\"', 'Luces Parada', '#E91E63', '🎭', 0.0000, 0.50, 0, 0, 0.00, -15.83015473, -70.01895905, 1, 234, '2026-02-08', '2026-02-10', 88, 50, NULL, '/candelaria/assets/uploads/danzas/danza_234_696dad3ddaae6.jpg'),
('danza_235', 'Conjunto Morenada \"Ricardo Palma\"', 'Luces Parada', '#E91E63', '🎭', 0.0000, 0.50, 0, 0, 0.00, -15.83015473, -70.01895905, 1, 235, '2026-02-08', '2026-02-09', 89, 33, NULL, '/candelaria/assets/uploads/danzas/danza_235_696dad3ddc84b.jpg'),
('danza_236', 'Asociación Juvenil Cabanillas Sikuris AJC', 'Luces Parada', '#E91E63', '🎭', 0.0000, 0.50, 0, 0, 0.00, -15.83015473, -70.01895905, 1, 236, '2026-02-08', '2026-02-10', 90, 75, NULL, '/candelaria/assets/uploads/danzas/danza_236_696dad3dd3e5b.jpg'),
('danza_237', 'Asociación Folklórica Diablada \"Centinelas Del Altiplano\"', 'Luces Parada', '#E91E63', '🎭', 0.0000, 0.50, 0, 0, 0.00, -15.83015473, -70.01895905, 1, 237, '2026-02-08', '2026-02-09', 91, 7, NULL, '/candelaria/assets/uploads/danzas/danza_237_696dad3dd3085.jpg'),
('danza_238', 'Asociación Folklórica Virgen De La Candelaria - AFOVIC', 'Luces Parada', '#E91E63', '🎭', 0.0000, 0.50, 0, 0, 0.00, -15.83015473, -70.01895905, 1, 238, '2026-02-08', '2026-02-09', 92, 46, NULL, '/candelaria/assets/uploads/danzas/danza_238_696dad3dd39ce.jpg'),
('danza_239', 'Fabulosa Morenada Independencia', 'Luces Parada', '#E91E63', '🎭', 0.0000, 0.50, 0, 0, 0.00, -15.83015473, -70.01895905, 1, 239, '2026-02-08', '2026-02-09', 93, 20, NULL, '/candelaria/assets/uploads/danzas/danza_239_696dad3dddea9.jpg'),
('danza_24', 'Asociación Cultural Chokela De La Comunidad Campesina Huarijuyo', 'Autoctonos', '#4CAF50', '🕺', 0.0000, 0.50, 0, 0, 0.00, -15.83015473, -70.01895905, 1, 24, '2026-01-31', NULL, 23, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_24_696dad3dcddc1.jpg'),
('danza_240', 'Taller De Arte Música Y Danza \"Real Asunción\" - Juli', 'Luces Parada', '#E91E63', '🎭', 0.0000, 0.50, 0, 0, 0.00, -15.83015473, -70.01895905, 1, 240, '2026-02-08', '2026-02-10', 94, 61, NULL, '/candelaria/assets/uploads/danzas/danza_240_696dad3de138b.jpg'),
('danza_241', 'Juventud Tinkus Del Barrio Porteño', 'Luces Parada', '#E91E63', '🎭', 0.0000, 0.50, 0, 0, 0.00, -15.83015473, -70.01895905, 1, 241, '2026-02-08', '2026-02-09', 95, 11, NULL, '/candelaria/assets/uploads/danzas/danza_241_696dad3ddecd9.jpg'),
('danza_242', 'Conjunto De Danzas Y Música Autóctona Ghantati Ururi De Conima', 'Luces Parada', '#E91E63', '🎭', 0.0000, 0.50, 0, 0, 0.00, -15.83015473, -70.01895905, 1, 242, '2026-02-08', '2026-02-09', 96, 13, NULL, '/candelaria/assets/uploads/danzas/danza_242_696dad3dd9e5f.jpg'),
('danza_243', 'Centro Universitario De Folklore Y El Conjunto De Zampoñas De La Universidad Nacional Mayor De San Marcos(CZSM)', 'Luces Parada', '#E91E63', '🎭', 0.0000, 0.50, 0, 0, 0.00, -15.83015473, -70.01895905, 1, 243, '2026-02-08', '2026-02-09', 97, 44, NULL, '/candelaria/assets/uploads/danzas/danza_243_696dad3dd74a4.jpg'),
('danza_244', 'Asociación Cultural Caporales Mi Viajo SJ', 'Luces Parada', '#E91E63', '🎭', 0.0000, 0.50, 0, 0, 0.00, -15.83015473, -70.01895905, 1, 244, '2026-02-08', '2026-02-09', NULL, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_244_696dad3dcb910.jpg'),
('danza_245', 'Morenada Central Puno', 'Luces Parada', '#E91E63', '🎭', 0.0000, 0.50, 0, 0, 0.00, -15.83015473, -70.01895905, 1, 245, '2026-02-08', '2026-02-09', NULL, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_245_696dad3ddf855.jpg'),
('danza_246', 'Conjunto Clasificado Salida De Manco Capac Y Mama Ocllo 2025 (Cupo C)', 'Luces Parada', '#E91E63', '🎭', 0.0000, 0.50, 0, 0, 0.00, -15.83015473, -70.01895905, 1, 246, NULL, '2026-02-10', NULL, 58, NULL, '/candelaria/assets/uploads/danzas/danza_246_696dad3dd9892.jpg'),
('danza_25', 'Conjunto Folklórico Carnaval De Churo - Huayrapata', 'Autoctonos', '#4CAF50', '🕺', 0.0000, 0.50, 0, 0, 0.00, -15.83015473, -70.01895905, 1, 25, '2026-01-31', NULL, 24, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_25_696dad3ddb0e8.jpg'),
('danza_26', 'Conjunto De Sikuris Centro Cultural 2 De Febrero De Sucuni - Conima', 'Autoctonos', '#4CAF50', '🕺', 0.0000, 0.50, 0, 0, 0.00, -15.83015473, -70.01895905, 1, 26, '2026-01-31', NULL, 25, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_26_696dad3dda178.jpg'),
('danza_27', 'Conjunto Carnaval De Chullunquiani Palca Lampa', 'Autoctonos', '#4CAF50', '🕺', 0.0000, 0.50, 0, 0, 0.00, -15.83015473, -70.01895905, 1, 27, '2026-01-31', NULL, 26, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_27_696dad3dd8d09.jpg'),
('danza_28', 'Asociación Folklórica Alpaqueros De Culta Acora', 'Autoctonos', '#4CAF50', '🕺', 0.0000, 0.50, 0, 0, 0.00, -15.83015473, -70.01895905, 1, 28, '2026-01-31', NULL, 27, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_28_696dad3dd227b.jpg'),
('danza_29', 'Asociación Cultural De Luriguyos Auténticos Rivales De Aychuyo - Yunguyo', 'Autoctonos', '#4CAF50', '🕺', 0.0000, 0.50, 0, 0, 0.00, -15.83015473, -70.01895905, 1, 29, '2026-01-31', NULL, 28, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_29_696dad3dce177.jpg'),
('danza_3', 'Conjunto De Zampoñas Juventud Central Chucuito - Puno', 'Autoctonos', '#4CAF50', '🕺', 0.0000, 0.50, 0, 0, 0.00, -15.84847069, -70.01713514, 1, 3, '2026-01-31', NULL, 2, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_3_696dad3dda7ac.jpg'),
('danza_30', 'Danza Guerrera Los Unkakus De La Comunidad Campesina Pacaje', 'Autoctonos', '#4CAF50', '🕺', 0.0000, 0.50, 0, 0, 0.00, -15.83015473, -70.01895905, 1, 30, '2026-01-31', NULL, 29, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_30_696dad3ddd613.jpg'),
('danza_31', 'Asociación Cultural Originarios Hach\'akallas De Usicayos - Carabaya Puno', 'Autoctonos', '#4CAF50', '🕺', 0.0000, 0.50, 0, 0, 0.00, -15.83015473, -70.01895905, 1, 31, '2026-01-31', NULL, 30, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_31_696dad3dcfc28.jpg'),
('danza_32', 'Asociación Cultural Unucajas De Azangaro - Acupa', 'Autoctonos', '#4CAF50', '🕺', 0.0000, 0.50, 0, 0, 0.00, -15.83015473, -70.01895905, 1, 32, '2026-01-31', NULL, 31, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_32_696dad3dd06f2.jpg'),
('danza_33', 'Asociación Cultural Carnaval De Santiago Del Distrito De Santiago De Pupuja - Azangaro', 'Autoctonos', '#4CAF50', '🕺', 0.0000, 0.50, 0, 0, 0.00, -15.83015473, -70.01895905, 1, 33, '2026-01-31', NULL, 32, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_33_696dad3dcca30.jpg'),
('danza_34', 'Centro De Expresión Cultural Sikuris Sentimiento Q\'ori Wayra San Antonio De Putina', 'Autoctonos', '#4CAF50', '🕺', 0.0000, 0.50, 0, 0, 0.00, -15.83015473, -70.01895905, 1, 34, '2026-01-31', NULL, 33, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_34_696dad3dd6fab.jpg'),
('danza_35', 'Confraternidad Negritos De Ccacca - Acora', 'Autoctonos', '#4CAF50', '🕺', 0.0000, 0.50, 0, 0, 0.00, -15.83015473, -70.01895905, 1, 35, '2026-01-31', NULL, 34, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_35_696dad3dd8093.jpg'),
('danza_36', 'Conjunto Wifalas De San Fernando San Juan De Salinas', 'Autoctonos', '#4CAF50', '🕺', 0.0000, 0.50, 0, 0, 0.00, -15.83015473, -70.01895905, 1, 36, '2026-01-31', NULL, 35, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_36_696dad3ddce7d.jpg'),
('danza_37', 'Sociedad De Expresión Cultural Café Pallay De Las Yungas De San Juan Del Oro', 'Autoctonos', '#4CAF50', '🕺', 0.0000, 0.50, 0, 0, 0.00, -15.83015473, -70.01895905, 1, 37, '2026-01-31', NULL, 36, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_37_696dad3de0e24.jpg'),
('danza_38', 'Asociación De Arte Y Cultura Carnaval De Chucuito', 'Autoctonos', '#4CAF50', '🕺', 0.0000, 0.50, 0, 0, 0.00, -15.83015473, -70.01895905, 1, 38, '2026-01-31', NULL, 37, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_38_696dad3dd16bc.jpg'),
('danza_39', 'Conjunto Juventud K\'ajelos San Juan De Dios De Pichacani', 'Autoctonos', '#4CAF50', '🕺', 0.0000, 0.50, 0, 0, 0.00, -15.83015473, -70.01895905, 1, 39, '2026-01-31', NULL, 38, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_39_696dad3ddc3b2.jpg'),
('danza_4', 'Asociación Folklórica Ayarachis Riqchary Huayna De Cuyo Cuyo- Sandia', 'Autoctonos', '#4CAF50', '🕺', 0.0000, 0.50, 0, 0, 0.00, -15.84847069, -70.01713514, 1, 4, '2026-01-31', NULL, 3, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_4_696dad3dd242c.jpg'),
('danza_40', 'Conjunto Folklórico Carnaval De Pusi-Cofocap', 'Autoctonos', '#4CAF50', '🕺', 0.0000, 0.50, 0, 0, 0.00, -15.83015473, -70.01895905, 1, 40, '2026-01-31', NULL, 39, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_40_696dad3ddb263.jpg'),
('danza_41', 'Sikuris 27 De Junio Nueva Era - Puno', 'Autoctonos', '#4CAF50', '🕺', 0.0000, 0.50, 0, 0, 0.00, -15.83015473, -70.01895905, 1, 41, '2026-01-31', NULL, 40, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_41_696dad3de07ab.jpg'),
('danza_42', 'Internacional Grupo De Arte Sikuris Los Chasquis De Coasia Vilquechico', 'Autoctonos', '#4CAF50', '🕺', 0.0000, 0.50, 0, 0, 0.00, -15.83015473, -70.01895905, 1, 42, '2026-01-31', NULL, 41, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_42_696dad3dde9af.jpg'),
('danza_43', 'Luriguyos Fraternidad Cultural Los Compadres De Yunguyo', 'Autoctonos', '#4CAF50', '🕺', 0.0000, 0.50, 0, 0, 0.00, -15.83015473, -70.01895905, 1, 43, '2026-01-31', NULL, 42, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_43_696dad3ddf545.jpg'),
('danza_44', 'Sicuris/Danza Clasificado de Manco Capac 2025', 'Autoctonos', '#4CAF50', '🕺', 0.0000, 0.50, 0, 0, 0.00, -15.83015473, -70.01895905, 1, 44, '2026-01-31', NULL, 43, NULL, NULL, NULL);
INSERT INTO `candela_map_dances` (`id`, `name`, `type`, `color`, `icon`, `distance_traveled`, `speed`, `started`, `finished`, `progress`, `lat`, `lng`, `route_id`, `danza_service_id`, `dia_concurso`, `dia_veneracion`, `orden_concurso`, `orden_veneracion`, `last_update_time`, `foto`) VALUES
('danza_45', 'A.C. Carnaval Ceniza Sangre Aymara Zona Lago - Perka Plateria', 'Autoctonos', '#4CAF50', '🕺', 0.0000, 0.50, 0, 0, 0.00, -15.83015473, -70.01895905, 1, 45, '2026-01-31', NULL, 44, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_45_696dad3dc60d3.jpg'),
('danza_46', 'Asociación Cultural Qawra T\'ikhiris Kelluyo', 'Autoctonos', '#4CAF50', '🕺', 0.0000, 0.50, 0, 0, 0.00, -15.83015473, -70.01895905, 1, 46, '2026-01-31', NULL, 45, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_46_696dad3dcff2a.jpg'),
('danza_47', 'Conjunto Autóctono Pinkillada Utachiris Aymaras - Desaguadero', 'Autoctonos', '#4CAF50', '🕺', 0.0000, 0.50, 0, 0, 0.00, -15.83015473, -70.01895905, 1, 47, '2026-01-31', NULL, 46, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_47_696dad3dd881c.jpg'),
('danza_48', 'Conjunto Folklórico Flor De Sankayo Centro Pucara Acora', 'Autoctonos', '#4CAF50', '🕺', 0.0000, 0.50, 0, 0, 0.00, -15.83015473, -70.01895905, 1, 48, '2026-01-31', NULL, 47, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_48_696dad3ddb5d8.jpg'),
('danza_49', 'Asociación Cultural Música Danza Sikuris Viento Andino Nueva Era Santa Lucia-Lampa', 'Autoctonos', '#4CAF50', '🕺', 0.0000, 0.50, 0, 0, 0.00, -15.83015473, -70.01895905, 1, 49, '2026-01-31', NULL, 48, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_49_696dad3dcfaa0.jpg'),
('danza_5', 'Danza Autóctona Choquelas De Calacoto', 'Autoctonos', '#4CAF50', '🕺', 0.0000, 0.50, 0, 0, 0.00, -15.83015473, -70.01895905, 1, 5, '2026-01-31', NULL, 4, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_5_696dad3ddd310.jpg'),
('danza_50', 'Asociación Cultural Carnaval Misturitas Atuncolla - Sillustani', 'Autoctonos', '#4CAF50', '🕺', 0.0000, 0.50, 0, 0, 0.00, -15.83015473, -70.01895905, 1, 50, '2026-01-31', NULL, 49, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_50_696dad3dcd463.jpg'),
('danza_51', 'Conjunto De Danzas Pinkilladas Lu\'qe Pankara De La Comunidad De Carancas - Desaguadero', 'Autoctonos', '#4CAF50', '🕺', 0.0000, 0.50, 0, 0, 0.00, -15.83015473, -70.01895905, 1, 51, '2026-01-31', NULL, 50, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_51_696dad3dd9cde.jpg'),
('danza_52', 'Asociación Cultural Los Tenientes De Incasaya - Caracoto', 'Autoctonos', '#4CAF50', '🕺', 0.0000, 0.50, 0, 0, 0.00, -15.83015473, -70.01895905, 1, 52, '2026-01-31', NULL, 51, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_52_696dad3dcf755.jpg'),
('danza_53', 'Conjunto Juventud Wifalas De Centro Poblado De San Isidro-Putina', 'Autoctonos', '#4CAF50', '🕺', 0.0000, 0.50, 0, 0, 0.00, -15.83015473, -70.01895905, 1, 53, '2026-01-31', NULL, 52, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_53_696dad3ddc52a.jpg'),
('danza_54', 'Conjunto Milenario De Sikuris 12 De Diciembre - El Collao', 'Autoctonos', '#4CAF50', '🕺', 0.0000, 0.50, 0, 0, 0.00, -15.83015473, -70.01895905, 1, 54, '2026-01-31', NULL, 53, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_54_696dad3ddc6c2.jpg'),
('danza_55', 'Conjunto Awatiris Santiago De Vizcachani Jayllihuaya', 'Autoctonos', '#4CAF50', '🕺', 0.0000, 0.50, 0, 0, 0.00, -15.83015473, -70.01895905, 1, 55, '2026-01-31', NULL, 54, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_55_696dad3dd89e8.jpg'),
('danza_56', 'Asociación Cultural Chacareros De Caritamaya Acora - Puno', 'Autoctonos', '#4CAF50', '🕺', 0.0000, 0.50, 0, 0, 0.00, -15.83015473, -70.01895905, 1, 56, '2026-01-31', NULL, 55, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_56_696dad3dcd9e8.jpg'),
('danza_57', 'Agrupación Cultural De Música Y Danzas Autóctonas Sikuris 29 De Septiembre Chillcapata - Conima', 'Autoctonos', '#4CAF50', '🕺', 0.0000, 0.50, 0, 0, 0.00, -15.83015473, -70.01895905, 1, 57, '2026-01-31', NULL, 56, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_57_696dad3dc671e.jpg'),
('danza_58', 'Autenticos Lawa Kumus Del Centro Poblado Thunco - Acora', 'Autoctonos', '#4CAF50', '🕺', 0.0000, 0.50, 0, 0, 0.00, -15.83015473, -70.01895905, 1, 58, '2026-01-31', NULL, 57, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_58_696dad3dd4bc2.jpg'),
('danza_59', 'Centro Cultural Juventud K\'ajelos Laraqueri', 'Autoctonos', '#4CAF50', '🕺', 0.0000, 0.50, 0, 0, 0.00, -15.83015473, -70.01895905, 1, 59, '2026-01-31', NULL, 58, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_59_696dad3dd6222.jpg'),
('danza_6', 'Carnaval De Mañazo', 'Autoctonos', '#4CAF50', '🕺', 0.0000, 0.50, 0, 0, 0.00, -15.83015473, -70.01895905, 1, 6, '2026-01-31', NULL, 5, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_6_696dad3dd5418.jpg'),
('danza_60', 'Autentico Y Original Carnaval De Ichu', 'Autoctonos', '#4CAF50', '🕺', 0.0000, 0.50, 0, 0, 0.00, -15.83015473, -70.01895905, 1, 60, '2026-01-31', NULL, 59, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_60_696dad3dd4a0f.jpg'),
('danza_61', 'Guerreros Hach\'akallas De Oruro - Crucero', 'Autoctonos', '#4CAF50', '🕺', 0.0000, 0.50, 0, 0, 0.00, -15.83015473, -70.01895905, 1, 61, '2026-01-31', NULL, 60, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_61_696dad3dde6b9.jpg'),
('danza_62', 'Agrupación Cultural Sikuris Sentimiento Rosal Andino - Cabana', 'Autoctonos', '#4CAF50', '🕺', 0.0000, 0.50, 0, 0, 0.00, -15.83015473, -70.01895905, 1, 62, '2026-01-31', NULL, 61, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_62_696dad3dc71ce.jpg'),
('danza_63', 'Sicuris/Danza Clasificado de Manco Capac 2025', 'Autoctonos', '#4CAF50', '🕺', 0.0000, 0.50, 0, 0, 0.00, -15.83015473, -70.01895905, 1, 63, '2026-01-31', NULL, 62, NULL, NULL, NULL),
('danza_64', 'Asociación Cultural Q\'aswa 5 Claveles De Capachica', 'Autoctonos', '#4CAF50', '🕺', 0.0000, 0.50, 0, 0, 0.00, -15.83015473, -70.01895905, 1, 64, '2026-01-31', NULL, 63, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_64_696dad3dcfd9d.jpg'),
('danza_65', 'Conjunto Folklórico Carnaval De Chuque De La Parcialidad De Lluscahaque Jurunawi - Acora', 'Autoctonos', '#4CAF50', '🕺', 0.0000, 0.50, 0, 0, 0.00, -15.83015473, -70.01895905, 1, 65, '2026-01-31', NULL, 64, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_65_696dad3ddaf4a.jpg'),
('danza_66', 'Asociación Cultural Carnaval Machu - Thinkay Santa Lucia', 'Autoctonos', '#4CAF50', '🕺', 0.0000, 0.50, 0, 0, 0.00, -15.83015473, -70.01895905, 1, 66, '2026-01-31', NULL, 65, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_66_696dad3dcd247.jpg'),
('danza_67', 'Asociación Chacallada Juventud Clavelitos De Camacani - Plateria', 'Autoctonos', '#4CAF50', '🕺', 0.0000, 0.50, 0, 0, 0.00, -15.83015473, -70.01895905, 1, 67, '2026-01-31', NULL, 66, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_67_696dad3dcb123.jpg'),
('danza_68', 'Asociación Cultural Ispalla Llachon - Capachica', 'Autoctonos', '#4CAF50', '🕺', 0.0000, 0.50, 0, 0, 0.00, -15.83015473, -70.01895905, 1, 68, '2026-01-31', NULL, 67, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_68_696dad3dcf241.jpg'),
('danza_69', 'Asociación Cultural Sikuris Kalacampana - Chucuito', 'Autoctonos', '#4CAF50', '🕺', 0.0000, 0.50, 0, 0, 0.00, -15.83015473, -70.01895905, 1, 69, '2026-01-31', NULL, 68, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_69_696dad3dd022b.jpg'),
('danza_7', 'Conjunto De Sikuris Proyecto Cultural Wiñay Panqara Marka - Moho', 'Autoctonos', '#4CAF50', '🕺', 0.0000, 0.50, 0, 0, 0.00, -15.83015473, -70.01895905, 1, 7, '2026-01-31', NULL, 6, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_7_696dad3dda490.jpg'),
('danza_70', 'Conjunto Juventud De Wifalas San Antonio De Putina', 'Autoctonos', '#4CAF50', '🕺', 0.0000, 0.50, 0, 0, 0.00, -15.83015473, -70.01895905, 1, 70, '2026-01-31', NULL, 69, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_70_696dad3ddc23a.jpg'),
('danza_71', 'Conjunto Folklórico Carnaval Autóctono De Angara - Vilavila', 'Autoctonos', '#4CAF50', '🕺', 0.0000, 0.50, 0, 0, 0.00, -15.83015473, -70.01895905, 1, 71, '2026-01-31', NULL, 70, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_71_696dad3ddaddd.jpg'),
('danza_72', 'Kajelos Asociación Cultural Estudiantes Laraqueri', 'Autoctonos', '#4CAF50', '🕺', 0.0000, 0.50, 0, 0, 0.00, -15.83015473, -70.01895905, 1, 72, '2026-01-31', NULL, 71, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_72_696dad3ddeead.jpg'),
('danza_73', 'Conjunto Carnaval De Alto Antalla', 'Autoctonos', '#4CAF50', '🕺', 0.0000, 0.50, 0, 0, 0.00, -15.83015473, -70.01895905, 1, 73, '2026-01-31', NULL, 72, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_73_696dad3dd8b82.jpg'),
('danza_74', 'Asociación Cultural Chacareros Fuerza Aymara Yanaque Zona Lago - Acora', 'Autoctonos', '#4CAF50', '🕺', 0.0000, 0.50, 0, 0, 0.00, -15.83015473, -70.01895905, 1, 74, '2026-01-31', NULL, 73, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_74_696dad3dcdbb8.jpg'),
('danza_75', 'Asociación Cultural Kaswas De Huata', 'Autoctonos', '#4CAF50', '🕺', 0.0000, 0.50, 0, 0, 0.00, -15.83015473, -70.01895905, 1, 75, '2026-02-01', NULL, 74, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_75_696dad3dcf411.jpg'),
('danza_76', 'Asociación Cultural Allpachu Awatiris De Santa Rosa - Mazocruz', 'Autoctonos', '#4CAF50', '🕺', 0.0000, 0.50, 0, 0, 0.00, -15.83015473, -70.01895905, 1, 76, '2026-02-01', NULL, 75, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_76_696dad3dcb2ad.jpg'),
('danza_77', 'Sociedad De Expresión Cultural Mercedes Achachi Vilquechico', 'Autoctonos', '#4CAF50', '🕺', 0.0000, 0.50, 0, 0, 0.00, -15.83015473, -70.01895905, 1, 77, '2026-02-01', NULL, 76, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_77_696dad3de1028.jpg'),
('danza_78', 'Asociación Folklórica Llipí Pulis De Ccapalla - Acora', 'Autoctonos', '#4CAF50', '🕺', 0.0000, 0.50, 0, 0, 0.00, -15.83015473, -70.01895905, 1, 78, '2026-02-01', NULL, 77, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_78_696dad3dd36ca.jpg'),
('danza_79', 'Chacareros Jhata Katus De Molino Kapia - Zepita', 'Autoctonos', '#4CAF50', '🕺', 0.0000, 0.50, 0, 0, 0.00, -15.83015473, -70.01895905, 1, 79, '2026-02-01', NULL, 78, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_79_696dad3dd7626.jpg'),
('danza_8', 'Institución Cultural Mallku Kunturine - Kelluyo', 'Autoctonos', '#4CAF50', '🕺', 0.0000, 0.50, 0, 0, 0.00, -15.83015473, -70.01895905, 1, 8, '2026-01-31', NULL, 7, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_8_696dad3dde836.jpg'),
('danza_80', 'Sicuris/Danza Clasificado de Manco Capac 2025', 'Autoctonos', '#4CAF50', '🕺', 0.0000, 0.50, 0, 0, 0.00, -15.83015473, -70.01895905, 1, 80, '2026-02-01', NULL, 79, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_80_696dad3de064e.jpg'),
('danza_81', 'Conjunto Carnaval De Ichuña - Moquegua', 'Autoctonos', '#4CAF50', '🕺', 0.0000, 0.50, 0, 0, 0.00, -15.83015473, -70.01895905, 1, 81, '2026-02-01', NULL, 80, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_81_696dad3dd8ea7.jpg'),
('danza_82', 'Asociación Cultural Y Tradicional Q\'arapulis Quena Quena 14 De Setiembre - Juli', 'Autoctonos', '#4CAF50', '🕺', 0.0000, 0.50, 0, 0, 0.00, -15.83015473, -70.01895905, 1, 82, '2026-02-01', NULL, 81, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_82_696dad3dd0ee3.jpg'),
('danza_83', 'Centro De Expresión Cultural De Arte Milenario Originarios Ayarachis Chullunquiani Pacca Lampa', 'Autoctonos', '#4CAF50', '🕺', 0.0000, 0.50, 0, 0, 0.00, -15.83015473, -70.01895905, 1, 83, '2026-02-01', NULL, 82, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_83_696dad3dd6e35.jpg'),
('danza_84', 'Asociación Cultural Carnaval Del Centro Poblado De Chucaripo Saman - Azangaro', 'Autoctonos', '#4CAF50', '🕺', 0.0000, 0.50, 0, 0, 0.00, -15.83015473, -70.01895905, 1, 84, '2026-02-01', NULL, 83, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_84_696dad3dcd030.jpg'),
('danza_85', 'Danza Originaria Clasificado De Manco Capac 2025', 'Autoctonos', '#4CAF50', '🕺', 0.0000, 0.50, 0, 0, 0.00, -15.83015473, -70.01895905, 1, 85, '2026-02-01', NULL, 84, NULL, NULL, NULL),
('danza_86', 'Asociación Cultural Carnaval Santiago De Pupuja Zona Valle', 'Autoctonos', '#4CAF50', '🕺', 0.0000, 0.50, 0, 0, 0.00, -15.83015473, -70.01895905, 1, 86, '2026-02-01', NULL, 85, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_86_696dad3dcd648.jpg'),
('danza_87', 'Conjunto Folklórico K\'ajchas Chita Señalacuy Orurillo - Melgar', 'Autoctonos', '#4CAF50', '🕺', 0.0000, 0.50, 0, 0, 0.00, -15.83015473, -70.01895905, 1, 87, '2026-02-01', NULL, 86, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_87_696dad3ddb760.jpg'),
('danza_88', 'K\'ajelos San Santiago De Viluyo', 'Autoctonos', '#4CAF50', '🕺', 0.0000, 0.50, 0, 0, 0.00, -15.83015473, -70.01895905, 1, 88, '2026-02-01', NULL, 87, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_88_696dad3ddf02b.jpg'),
('danza_89', 'Asociación Juvenil Sikuris Kantutas Rojas Centro Poblado Isañura Distrito De Capachica - Puno', 'Autoctonos', '#4CAF50', '🕺', 0.0000, 0.50, 0, 0, 0.00, -15.83015473, -70.01895905, 1, 89, '2026-02-01', NULL, 88, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_89_696dad3dd4520.jpg'),
('danza_9', 'Los Turcos De Cabanilla - Lampa', 'Autoctonos', '#4CAF50', '🕺', 0.0000, 0.50, 0, 0, 0.00, -15.83015473, -70.01895905, 1, 9, '2026-01-31', NULL, 8, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_9_696dad3ddf359.jpg'),
('danza_90', 'Asociación Cultural Carnaval De Tiquillaca', 'Autoctonos', '#4CAF50', '🕺', 0.0000, 0.50, 0, 0, 0.00, -15.83015473, -70.01895905, 1, 90, '2026-02-01', NULL, 89, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_90_696dad3dccbe5.jpg'),
('danza_91', 'Asociación Cultural Unucajas De La Comunidad De Chaupi Compuyo - Asillo - Azangaro', 'Autoctonos', '#4CAF50', '🕺', 0.0000, 0.50, 0, 0, 0.00, -15.83015473, -70.01895905, 1, 91, '2026-02-01', NULL, 90, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_91_696dad3dd08b0.jpg'),
('danza_92', 'Asociación Cultural Carnaval Chacareros Del Centro Poblado De Chancachi', 'Autoctonos', '#4CAF50', '🕺', 0.0000, 0.50, 0, 0, 0.00, -15.83015473, -70.01895905, 1, 92, '2026-02-01', NULL, 91, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_92_696dad3dcbb02.jpg'),
('danza_93', 'Agrupación Cultural Unucajas Sta Cruz Jose Domingo Choquehuanca', 'Autoctonos', '#4CAF50', '🕺', 0.0000, 0.50, 0, 0, 0.00, -15.83015473, -70.01895905, 1, 93, '2026-02-01', NULL, 92, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_93_696dad3dc7429.jpg'),
('danza_94', 'Conjunto Folklórico K\'ajchas Cruz Taripacuy Ichucahua Distrito De Orurillo Provincia De Melgar', 'Autoctonos', '#4CAF50', '🕺', 0.0000, 0.50, 0, 0, 0.00, -15.83015473, -70.01895905, 1, 94, '2026-02-01', NULL, 93, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_94_696dad3ddb8e2.jpg'),
('danza_95', 'Asociación Cultural Tradicional K\'acchas De Urinsaya', 'Autoctonos', '#4CAF50', '🕺', 0.0000, 0.50, 0, 0, 0.00, -15.83015473, -70.01895905, 1, 95, '2026-02-01', NULL, 94, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_95_696dad3dd03dc.jpg'),
('danza_96', 'Asociación Folklórica Llameritos De Canteria - Lampa', 'Autoctonos', '#4CAF50', '🕺', 0.0000, 0.50, 0, 0, 0.00, -15.83015473, -70.01895905, 1, 96, '2026-02-01', NULL, 95, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_96_696dad3dd3565.jpg'),
('danza_97', 'Sikuris Raíces Andinos Los Quechuas (Asiraq) Santa Lucía', 'Autoctonos', '#4CAF50', '🕺', 0.0000, 0.50, 0, 0, 0.00, -15.83015473, -70.01895905, 1, 97, '2026-02-01', NULL, 96, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_97_696dad3de091f.jpg'),
('danza_98', 'Asociación Cultural Unucajas Del Distrito De San José', 'Autoctonos', '#4CAF50', '🕺', 0.0000, 0.50, 0, 0, 0.00, -15.83015473, -70.01895905, 1, 98, '2026-02-01', NULL, 97, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_98_696dad3dd0a31.jpg'),
('danza_99', 'Asociación Cultural Zampónistas Arco Blanco - Puno', 'Autoctonos', '#4CAF50', '🕺', 0.0000, 0.50, 0, 0, 0.00, -15.83015473, -70.01895905, 1, 99, '2026-02-01', NULL, 98, NULL, NULL, '/candelaria/assets/uploads/danzas/danza_99_696dad3dd107c.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `candela_route_distances`
--

CREATE TABLE `candela_route_distances` (
  `id` int(11) NOT NULL,
  `route_id` int(11) NOT NULL DEFAULT 1,
  `start_lat` decimal(10,8) DEFAULT NULL,
  `start_lng` decimal(10,8) DEFAULT NULL,
  `end_lat` decimal(10,8) DEFAULT NULL,
  `end_lng` decimal(10,8) DEFAULT NULL,
  `distance` decimal(10,4) DEFAULT NULL,
  `cumulative_distance` decimal(10,4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `candela_route_distances`
--

INSERT INTO `candela_route_distances` (`id`, `route_id`, `start_lat`, `start_lng`, `end_lat`, `end_lng`, `distance`, `cumulative_distance`) VALUES
(288, 1, -15.82828621, -70.01689643, -15.82871697, -70.01768500, 0.0970, 0.0970),
(289, 1, -15.82871697, -70.01768500, -15.82923860, -70.01849033, 0.1039, 0.2009),
(290, 1, -15.82923860, -70.01849033, -15.83015510, -70.01972482, 0.1668, 0.3677),
(291, 1, -15.83015510, -70.01972482, -15.83071225, -70.02036586, 0.0924, 0.4601),
(292, 1, -15.83071225, -70.02036586, -15.83110625, -70.02097070, 0.0781, 0.5382),
(293, 1, -15.83110625, -70.02097070, -15.83133430, -70.02125099, 0.0393, 0.5775),
(294, 1, -15.83133430, -70.02125099, -15.83174050, -70.02180873, 0.0748, 0.6523),
(295, 1, -15.83174050, -70.02180873, -15.83188043, -70.02203336, 0.0286, 0.6810),
(296, 1, -15.83188043, -70.02203336, -15.83198074, -70.02241038, 0.0418, 0.7228),
(297, 1, -15.83198074, -70.02241038, -15.83224288, -70.02325243, 0.0947, 0.8175),
(298, 1, -15.83224288, -70.02325243, -15.83245697, -70.02412599, 0.0964, 0.9139),
(299, 1, -15.83245697, -70.02412599, -15.83275618, -70.02545771, 0.1463, 1.0602),
(300, 1, -15.83275618, -70.02545771, -15.83289180, -70.02601175, 0.0612, 1.1214),
(301, 1, -15.83289180, -70.02601175, -15.83302195, -70.02672539, 0.0777, 1.1991),
(302, 1, -15.83302195, -70.02672539, -15.83328375, -70.02765041, 0.1031, 1.3022),
(303, 1, -15.83328375, -70.02765041, -15.83420522, -70.02734900, 0.1074, 1.4097),
(304, 1, -15.83420522, -70.02734900, -15.83501843, -70.02696679, 0.0992, 1.5089),
(305, 1, -15.83501843, -70.02696679, -15.83575096, -70.02668784, 0.0867, 1.5956),
(306, 1, -15.83575096, -70.02668784, -15.83621329, -70.02652287, 0.0544, 1.6500),
(307, 1, -15.83621329, -70.02652287, -15.83636912, -70.02728261, 0.0831, 1.7331),
(308, 1, -15.83636912, -70.02728261, -15.83651320, -70.02802273, 0.0808, 1.8139),
(309, 1, -15.83651320, -70.02802273, -15.83661171, -70.02853520, 0.0559, 1.8698),
(310, 1, -15.83661171, -70.02853520, -15.83739437, -70.02839237, 0.0884, 1.9581),
(311, 1, -15.83739437, -70.02839237, -15.83818622, -70.02823681, 0.0896, 2.0477),
(312, 1, -15.83818622, -70.02823681, -15.83899612, -70.02806783, 0.0919, 2.1396),
(313, 1, -15.83899612, -70.02806783, -15.84075787, -70.02758503, 0.2026, 2.3422),
(314, 1, -15.84075787, -70.02758503, -15.83902039, -70.02291799, 0.5353, 2.8775);

-- --------------------------------------------------------

--
-- Table structure for table `candela_route_points`
--

CREATE TABLE `candela_route_points` (
  `id` int(11) NOT NULL,
  `lat` decimal(10,8) NOT NULL,
  `lng` decimal(10,8) NOT NULL,
  `number` int(11) NOT NULL,
  `route_id` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `candela_route_points`
--

INSERT INTO `candela_route_points` (`id`, `lat`, `lng`, `number`, `route_id`) VALUES
(296, -15.82828621, -70.01689643, 1, 1),
(297, -15.82871697, -70.01768500, 2, 1),
(298, -15.82923860, -70.01849033, 3, 1),
(299, -15.83015510, -70.01972482, 4, 1),
(300, -15.83071225, -70.02036586, 5, 1),
(301, -15.83110625, -70.02097070, 6, 1),
(302, -15.83133430, -70.02125099, 7, 1),
(303, -15.83174050, -70.02180873, 8, 1),
(304, -15.83188043, -70.02203336, 9, 1),
(305, -15.83198074, -70.02241038, 10, 1),
(306, -15.83224288, -70.02325243, 11, 1),
(307, -15.83245697, -70.02412599, 12, 1),
(308, -15.83275618, -70.02545771, 13, 1),
(309, -15.83289180, -70.02601175, 14, 1),
(310, -15.83302195, -70.02672539, 15, 1),
(311, -15.83328375, -70.02765041, 16, 1),
(312, -15.83420522, -70.02734900, 17, 1),
(313, -15.83501843, -70.02696679, 18, 1),
(314, -15.83575096, -70.02668784, 19, 1),
(315, -15.83621329, -70.02652287, 20, 1),
(316, -15.83636912, -70.02728261, 21, 1),
(317, -15.83651320, -70.02802273, 22, 1),
(318, -15.83661171, -70.02853520, 23, 1),
(319, -15.83739437, -70.02839237, 24, 1),
(320, -15.83818622, -70.02823681, 25, 1),
(321, -15.83899612, -70.02806783, 26, 1),
(322, -15.84075787, -70.02758503, 27, 1),
(323, -15.83902039, -70.02291799, 28, 1);

-- --------------------------------------------------------

--
-- Table structure for table `clientes`
--

CREATE TABLE `clientes` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `telefono` varchar(50) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `clientes`
--

INSERT INTO `clientes` (`id`, `nombre`, `email`, `telefono`, `password_hash`, `created_at`, `updated_at`) VALUES
(1, 'aldo ', 'aldo@zanabria.org', '951925511', '$2y$12$8S8daVx45i4QASMKOH3BleOpQrVbMsVY1yfbDzcUy8w098KHbykn2', '2026-01-17 01:09:54', '2026-01-17 01:09:54'),
(2, 'usuario de prueba2', 'aaa@gmail.com', '974526627', '$2y$12$oT6YNvKqx2HHo2kmydjtt.iOZGeZwmrMygWoe1TCHcKToy6rl2l7m', '2026-01-18 23:35:20', '2026-01-18 23:35:20'),
(3, 'cccccc', 'ccc@gmail.com', '974526627', '$2y$12$g/wxrdGifZD6Y4fzb43QzO3PCuSVFpqTHGl3J7bw5QRregHUUWb1e', '2026-01-18 23:43:59', '2026-01-18 23:43:59'),
(4, 'prueba', 'admina@gmail.com', 'asdfasdds', '$2y$12$kTjFAZZBOD27m6knQVTm.OqoDoS/YEqibyc.RtbfQ/iJ6GuomvJt6', '2026-01-18 23:46:20', '2026-01-18 23:46:20'),
(5, 'ssssssssss', 'aaaaaa@gmail.com', '974526627', '$2y$12$TFcjlGWp7DkXKpJpkXJgTeCy5NvCLR9a7VY3rx/4FHe1P94QHEnHm', '2026-01-18 23:54:17', '2026-01-18 23:54:17'),
(6, 'hunjk', 'aasad@gmail.com', '974526627', '$2y$12$EHn.itHoiVSVsQCXQ0V7/ui9V8rEoiN7KFC30phb426Iy8abDyoou', '2026-01-19 00:00:03', '2026-01-19 00:00:03'),
(7, 'Sam', 'antonyzapana550@gmail.com', '988888756', '$2y$12$e7z.CMhX.JnCMLvS2p9fcOgLede0LcbV15vYDoxGrzyKQPVpjsHBS', '2026-01-19 01:37:09', '2026-01-19 01:37:09'),
(8, 'xyz', 'xyz@gmail.com', '974526627', '$2y$12$ZTi3zRIgvaaDcuNnflzEK.EpKXqKBtqngF4gFPAI7Mgk9WjwKYVRG', '2026-01-19 01:40:15', '2026-01-19 01:40:15'),
(9, 'asdf', 'asdf2@gmail.com', 'asdf', '$2y$12$IFSpIxYt8Ak3jKfe0nZt7O4PlmJUZh0vyts06NkAj.dvKZOZJNfjG', '2026-01-21 01:21:18', '2026-01-21 01:21:18');

-- --------------------------------------------------------

--
-- Table structure for table `dances`
--

CREATE TABLE `dances` (
  `id` varchar(50) NOT NULL,
  `name` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `color` varchar(20) NOT NULL,
  `icon` varchar(10) NOT NULL,
  `distance_traveled` decimal(10,6) DEFAULT 0.000000,
  `speed` decimal(10,6) DEFAULT 5.000000,
  `started` tinyint(1) DEFAULT 0,
  `finished` tinyint(1) DEFAULT 0,
  `progress` decimal(5,2) DEFAULT 0.00,
  `lat` decimal(10,8) DEFAULT -15.84070000,
  `lng` decimal(11,8) DEFAULT -70.02140000,
  `route_id` int(11) NOT NULL DEFAULT 1,
  `last_update_time` bigint(20) DEFAULT 0,
  `animation_frame` int(11) DEFAULT 0,
  `danza_service_id` int(11) DEFAULT NULL,
  `dia_concurso` varchar(20) DEFAULT NULL,
  `dia_veneracion` varchar(20) DEFAULT NULL,
  `orden_concurso` int(11) DEFAULT NULL,
  `orden_veneracion` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `eventos`
--

CREATE TABLE `eventos` (
  `id` int(11) NOT NULL,
  `nombre_evento` varchar(255) NOT NULL DEFAULT 'Festividad de la Candelaria',
  `fecha_evento` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `eventos`
--

INSERT INTO `eventos` (`id`, `nombre_evento`, `fecha_evento`) VALUES
(1, 'Festividad de la Candelaria', '2024-02-02'),
(2, 'Festividad de la Candelaria', '2024-02-03');

-- --------------------------------------------------------

--
-- Table structure for table `habitaciones`
--

CREATE TABLE `habitaciones` (
  `id` int(11) NOT NULL,
  `hospedaje_id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `tipo` enum('individual','doble','matrimonial','suite','familiar') NOT NULL,
  `descripcion` text DEFAULT NULL,
  `precio_noche` decimal(10,2) NOT NULL,
  `capacidad` int(11) NOT NULL DEFAULT 2,
  `cantidad_total` int(11) NOT NULL DEFAULT 1,
  `amenidades` text DEFAULT NULL,
  `imagenes` text DEFAULT NULL,
  `activo` tinyint(1) DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `hospedajes`
--

CREATE TABLE `hospedajes` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `ubicacion` varchar(255) NOT NULL,
  `latitud` decimal(10,8) DEFAULT NULL,
  `longitud` decimal(11,8) DEFAULT NULL,
  `tipo` varchar(100) NOT NULL,
  `precio_noche` decimal(10,2) NOT NULL,
  `capacidad` int(11) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `servicios` text DEFAULT NULL,
  `imagenes` text DEFAULT NULL,
  `calificacion` decimal(3,2) DEFAULT 0.00,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `hospedajes`
--

INSERT INTO `hospedajes` (`id`, `nombre`, `ubicacion`, `latitud`, `longitud`, `tipo`, `precio_noche`, `capacidad`, `descripcion`, `servicios`, `imagenes`, `calificacion`, `created_at`, `updated_at`) VALUES
(11, 'Casona Plaza Hotel Puno', 'Jiron Puno Nº 280 - Cercado, 051 Puno, Perú Ubicación excelente, ¡puntuada con 9.5/10!(puntuación basada en 629 comentarios) Valorado por los clientes después de alojarse en el Casona Plaza Hotel Puno.', -15.84020000, -70.02190000, 'Hotel', 179.00, 1, 'El Hotel Casona Plaza Puno está convenientemente ubicado a una cuadra de la céntrica Plaza de Armas y a dos cuadras de la Catedral.  Los huéspedes pueden visitar las antiguas ruinas coloniales de Chucuito, a 18 km de distancia, o practicar windsurf en el lago.\n', NULL, '[\"\\/candelaria\\/assets\\/uploads\\/69701914789561.44607027.jpg\"]', 2.67, '2026-01-21 00:08:52', '2026-01-23 06:40:53'),
(12, 'Titicaca Atrion Uros', 'Titicaca Titicaca Atrion, los uros, 21001 Puno, Perú Ubicación excelente, ¡puntuada con 10/10!(puntuación basada en 5 comentarios) Valorado por los clientes después de alojarse en el Titicaca Atrion Uros.', -15.84020000, -70.02190000, 'Hotel', 114.00, 1, 'Titicaca Atrion Uros está en Puno y ofrece vistas a la ciudad, jardín, terraza y restaurante.\n\nCada unidad cuenta con un balcón con vistas a la montaña.\n\nEn el lodge se puede disfrutar de un desayuno continental.\n\nEl aeropuerto (Aeropuerto Internacional Inca Manco Cápac) está a 50 km, y el alojamiento ofrece servicio de traslado de pago para ir o volver del aeropuerto.', NULL, '[\"\\/candelaria\\/assets\\/uploads\\/69701a65053020.55499220.jpg\"]', 0.00, '2026-01-21 00:14:29', '2026-01-21 00:14:29');

-- --------------------------------------------------------

--
-- Table structure for table `hospedaje_servicios`
--

CREATE TABLE `hospedaje_servicios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `icono` varchar(50) DEFAULT NULL,
  `descripcion` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `noticias`
--

CREATE TABLE `noticias` (
  `id` int(11) NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `resumen` text DEFAULT NULL,
  `contenido` longtext DEFAULT NULL,
  `imagen_principal` varchar(255) DEFAULT NULL,
  `categoria` varchar(100) DEFAULT NULL,
  `autor` varchar(100) DEFAULT 'Redacción',
  `fecha_publicacion` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `noticias`
--

INSERT INTO `noticias` (`id`, `titulo`, `resumen`, `contenido`, `imagen_principal`, `categoria`, `autor`, `fecha_publicacion`, `created_at`, `updated_at`) VALUES
(20, 'Candelaria en la mira del mundo', '¡Candelaria para el mundo! Puno brilla con su fiesta Patrimonio de la Humanidad', '<div>Puno, Perú — La Festividad de la Virgen de la Candelaria, una de las expresiones culturales y religiosas más importantes del Perú y América Latina, continúa proyectándose internacionalmente como un símbolo de identidad, diversidad y tradición ancestral.</div><div><br></div><div>Declarada Patrimonio Cultural Inmaterial de la Humanidad por la UNESCO, esta fiesta transforma cada año a la ciudad de Puno en un escenario global de danza, música, devoción y folclore andino.</div><div><br></div><div>Desde el 24 de enero hasta mediados de febrero, miles de visitantes nacionales y extranjeros llegan a las orillas del Lago Titicaca para presenciar una celebración que combina fe religiosa con expresiones artísticas únicas. Más de 40 000 danzantes y cerca de 9 000 músicos llenan las calles, plazas y estadios de la ciudad en competencias de trajes, música y danzas tradicionales como la diablada, morenada, kullawada y otras manifestaciones culturales andinas.</div><div><br></div><div>La fiesta tiene su día central el 2 de febrero, cuando se realiza la solemne misa y la tradicional procesión de la Virgen por el centro de Puno, acompañada por devotos de diferentes países.</div><div><br></div><div>La proyección internacional de Candelaria no solo se limita al flujo de turistas: en fechas recientes, delegaciones culturales peruanas han llevado la festividad al extranjero, incluido un evento representativo en Madrid, España, donde se presentó la esencia del folclore puneño ante audiencias europeas.</div><div><br></div><div>Autoridades locales continúan reforzando la organización del evento con inversiones en seguridad, servicios y logística para recibir a un público global, reforzando a Puno como un punto de encuentro cultural de alcance mundial.</div><div><br></div><div>La Festividad de la Virgen de la Candelaria es, sin duda, una celebración que trasciende fronteras y mantiene viva la riqueza ancestral de los Andes, consolidándose como un patrimonio vivo que el mundo celebra con admiración y respeto.</div>', 'img_6974cb2e2b20b8.50921275.jpg', 'Cultura', 'Redacción', '2026-01-23 01:22:19', '2026-01-23 01:22:19', '2026-01-24 13:38:11');

-- --------------------------------------------------------

--
-- Table structure for table `reservaciones`
--

CREATE TABLE `reservaciones` (
  `id` int(11) NOT NULL,
  `cliente_id` int(11) DEFAULT NULL,
  `habitacion_id` int(11) NOT NULL,
  `hospedaje_id` int(11) NOT NULL,
  `fecha_entrada` date NOT NULL,
  `fecha_salida` date NOT NULL,
  `num_huespedes` int(11) NOT NULL DEFAULT 1,
  `precio_total` decimal(10,2) NOT NULL,
  `estado` enum('pendiente','confirmada','cancelada','completada') DEFAULT 'pendiente',
  `notas` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `user_id` varchar(36) DEFAULT NULL COMMENT 'Supabase UUID',
  `user_email` varchar(100) DEFAULT NULL,
  `user_name` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `route_distances`
--

CREATE TABLE `route_distances` (
  `id` int(11) NOT NULL,
  `route_id` int(11) NOT NULL,
  `start_lat` decimal(10,8) NOT NULL,
  `start_lng` decimal(11,8) NOT NULL,
  `end_lat` decimal(10,8) NOT NULL,
  `end_lng` decimal(11,8) NOT NULL,
  `distance` decimal(10,6) NOT NULL,
  `cumulative_distance` decimal(10,6) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `route_points`
--

CREATE TABLE `route_points` (
  `id` int(11) NOT NULL,
  `lat` decimal(10,8) NOT NULL,
  `lng` decimal(11,8) NOT NULL,
  `number` int(11) NOT NULL,
  `route_id` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tienda_carrito`
--

CREATE TABLE `tienda_carrito` (
  `id` int(11) NOT NULL,
  `usuario_id` varchar(255) NOT NULL,
  `producto_id` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL DEFAULT 1,
  `fecha_agregado` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tienda_pedidos`
--

CREATE TABLE `tienda_pedidos` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `estado` enum('pendiente','pagado','enviado','entregado','cancelado') DEFAULT 'pendiente',
  `metodo_pago` varchar(50) DEFAULT 'yape_plin',
  `datos_contacto` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`datos_contacto`)),
  `items_json` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`items_json`)),
  `creado_en` timestamp NOT NULL DEFAULT current_timestamp(),
  `actualizado_en` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tienda_productos`
--

CREATE TABLE `tienda_productos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `precio` decimal(10,2) NOT NULL DEFAULT 0.00,
  `precio_oferta` decimal(10,2) DEFAULT NULL,
  `stock` int(11) NOT NULL DEFAULT 0,
  `numero_whatsapp` varchar(20) DEFAULT NULL,
  `imagen_principal` varchar(255) DEFAULT NULL,
  `imagenes_galeria` text DEFAULT NULL,
  `categoria` varchar(100) DEFAULT NULL,
  `estado` enum('activo','inactivo') DEFAULT 'activo',
  `creado_en` timestamp NOT NULL DEFAULT current_timestamp(),
  `actualizado_en` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tienda_productos`
--

INSERT INTO `tienda_productos` (`id`, `nombre`, `descripcion`, `precio`, `precio_oferta`, `stock`, `numero_whatsapp`, `imagen_principal`, `imagenes_galeria`, `categoria`, `estado`, `creado_en`, `actualizado_en`) VALUES
(10, 'polo candelaria', 'polo oficial de la candelaria', 23.00, NULL, 20, '97452662', 'assets/uploads/tienda/prod_1769530318_120.jpeg', NULL, 'Ropa', 'activo', '2026-01-27 16:11:58', '2026-01-27 16:11:58');

-- --------------------------------------------------------

--
-- Table structure for table `tipos_entrada`
--

CREATE TABLE `tipos_entrada` (
  `id` int(11) NOT NULL,
  `zona` varchar(50) NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `stock_inicial` int(11) DEFAULT 100,
  `stock_actual` int(11) NOT NULL DEFAULT 100
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `tipos_entrada`
--

INSERT INTO `tipos_entrada` (`id`, `zona`, `precio`, `stock_inicial`, `stock_actual`) VALUES
(1, 'SUR ZONA ALTA', 34.00, 100, 100),
(2, 'SUR ZONA BAJA', 22.00, 100, 100),
(3, 'ORIENTE ZONA ALTA', 45.00, 100, 100),
(4, 'ORIENTE ZONA BAJA', 34.00, 100, 100),
(5, 'OCCIDENTE ZONA ALTA', 56.00, 100, 100),
(6, 'OCCIDENTE ZONA BAJA', 34.00, 100, 100);

-- --------------------------------------------------------

--
-- Table structure for table `transporte`
--

CREATE TABLE `transporte` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `tipo` varchar(100) NOT NULL,
  `ubicacion` varchar(255) NOT NULL,
  `destino` varchar(255) NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `capacidad` int(11) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `servicios` text DEFAULT NULL,
  `imagenes` text DEFAULT NULL,
  `calificacion` decimal(3,2) DEFAULT 0.00,
  `horario_inicio` time DEFAULT NULL,
  `horario_fin` time DEFAULT NULL,
  `latitud` decimal(10,8) DEFAULT NULL,
  `longitud` decimal(11,8) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `turismo`
--

CREATE TABLE `turismo` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `ubicacion` varchar(255) NOT NULL,
  `tipo` varchar(100) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `horario` varchar(100) DEFAULT NULL,
  `precio` decimal(10,2) DEFAULT NULL,
  `capacidad` int(11) DEFAULT NULL,
  `servicios` text DEFAULT NULL,
  `imagenes` text DEFAULT NULL,
  `calificacion` decimal(3,2) DEFAULT 0.00,
  `telefono` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `pagina_web` varchar(255) DEFAULT NULL,
  `latitud` decimal(10,8) DEFAULT NULL,
  `longitud` decimal(11,8) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ventas`
--

CREATE TABLE `ventas` (
  `id_venta` int(11) NOT NULL,
  `id_tipo_entrada` int(11) NOT NULL,
  `id_evento` int(11) NOT NULL,
  `fecha_venta` timestamp NOT NULL DEFAULT current_timestamp(),
  `monto_pagado` decimal(10,2) NOT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_usuarios`
--
ALTER TABLE `admin_usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `calificaciones`
--
ALTER TABLE `calificaciones`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_review` (`hospedaje_id`,`cliente_id`),
  ADD KEY `cliente_id` (`cliente_id`);

--
-- Indexes for table `candela_comida`
--
ALTER TABLE `candela_comida`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `candela_list`
--
ALTER TABLE `candela_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `candela_map_dances`
--
ALTER TABLE `candela_map_dances`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `candela_route_distances`
--
ALTER TABLE `candela_route_distances`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `candela_route_points`
--
ALTER TABLE `candela_route_points`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `dances`
--
ALTER TABLE `dances`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `eventos`
--
ALTER TABLE `eventos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `habitaciones`
--
ALTER TABLE `habitaciones`
  ADD PRIMARY KEY (`id`),
  ADD KEY `hospedaje_id` (`hospedaje_id`);

--
-- Indexes for table `hospedajes`
--
ALTER TABLE `hospedajes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hospedaje_servicios`
--
ALTER TABLE `hospedaje_servicios`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `noticias`
--
ALTER TABLE `noticias`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reservaciones`
--
ALTER TABLE `reservaciones`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cliente_id` (`cliente_id`),
  ADD KEY `habitacion_id` (`habitacion_id`),
  ADD KEY `hospedaje_id` (`hospedaje_id`),
  ADD KEY `idx_reservaciones_user_id` (`user_id`);

--
-- Indexes for table `route_distances`
--
ALTER TABLE `route_distances`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `route_points`
--
ALTER TABLE `route_points`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tienda_carrito`
--
ALTER TABLE `tienda_carrito`
  ADD PRIMARY KEY (`id`),
  ADD KEY `producto_id` (`producto_id`),
  ADD KEY `usuario_id` (`usuario_id`);

--
-- Indexes for table `tienda_pedidos`
--
ALTER TABLE `tienda_pedidos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario_id` (`usuario_id`);

--
-- Indexes for table `tienda_productos`
--
ALTER TABLE `tienda_productos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tipos_entrada`
--
ALTER TABLE `tipos_entrada`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transporte`
--
ALTER TABLE `transporte`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `turismo`
--
ALTER TABLE `turismo`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `ventas`
--
ALTER TABLE `ventas`
  ADD PRIMARY KEY (`id_venta`),
  ADD KEY `id_tipo_entrada` (`id_tipo_entrada`),
  ADD KEY `id_evento` (`id_evento`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_usuarios`
--
ALTER TABLE `admin_usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `calificaciones`
--
ALTER TABLE `calificaciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `candela_comida`
--
ALTER TABLE `candela_comida`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `candela_list`
--
ALTER TABLE `candela_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=247;

--
-- AUTO_INCREMENT for table `candela_route_distances`
--
ALTER TABLE `candela_route_distances`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=315;

--
-- AUTO_INCREMENT for table `candela_route_points`
--
ALTER TABLE `candela_route_points`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=324;

--
-- AUTO_INCREMENT for table `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `eventos`
--
ALTER TABLE `eventos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `habitaciones`
--
ALTER TABLE `habitaciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `hospedajes`
--
ALTER TABLE `hospedajes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `hospedaje_servicios`
--
ALTER TABLE `hospedaje_servicios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `noticias`
--
ALTER TABLE `noticias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `reservaciones`
--
ALTER TABLE `reservaciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `route_distances`
--
ALTER TABLE `route_distances`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `route_points`
--
ALTER TABLE `route_points`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tienda_carrito`
--
ALTER TABLE `tienda_carrito`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tienda_pedidos`
--
ALTER TABLE `tienda_pedidos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tienda_productos`
--
ALTER TABLE `tienda_productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tipos_entrada`
--
ALTER TABLE `tipos_entrada`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `transporte`
--
ALTER TABLE `transporte`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `turismo`
--
ALTER TABLE `turismo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ventas`
--
ALTER TABLE `ventas`
  MODIFY `id_venta` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `calificaciones`
--
ALTER TABLE `calificaciones`
  ADD CONSTRAINT `calificaciones_ibfk_1` FOREIGN KEY (`hospedaje_id`) REFERENCES `hospedajes` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `calificaciones_ibfk_2` FOREIGN KEY (`cliente_id`) REFERENCES `clientes` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `habitaciones`
--
ALTER TABLE `habitaciones`
  ADD CONSTRAINT `habitaciones_ibfk_1` FOREIGN KEY (`hospedaje_id`) REFERENCES `hospedajes` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `reservaciones`
--
ALTER TABLE `reservaciones`
  ADD CONSTRAINT `reservaciones_ibfk_1` FOREIGN KEY (`cliente_id`) REFERENCES `clientes` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `reservaciones_ibfk_2` FOREIGN KEY (`habitacion_id`) REFERENCES `habitaciones` (`id`),
  ADD CONSTRAINT `reservaciones_ibfk_3` FOREIGN KEY (`hospedaje_id`) REFERENCES `hospedajes` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `tienda_carrito`
--
ALTER TABLE `tienda_carrito`
  ADD CONSTRAINT `tienda_carrito_ibfk_1` FOREIGN KEY (`producto_id`) REFERENCES `tienda_productos` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `tienda_pedidos`
--
ALTER TABLE `tienda_pedidos`
  ADD CONSTRAINT `tienda_pedidos_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `ventas`
--
ALTER TABLE `ventas`
  ADD CONSTRAINT `ventas_ibfk_1` FOREIGN KEY (`id_tipo_entrada`) REFERENCES `tipos_entrada` (`id`),
  ADD CONSTRAINT `ventas_ibfk_2` FOREIGN KEY (`id_evento`) REFERENCES `eventos` (`id`),
  ADD CONSTRAINT `ventas_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `usuarios` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
