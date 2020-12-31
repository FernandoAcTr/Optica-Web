-- phpMyAdmin SQL Dump
-- version 4.6.6deb5ubuntu0.5
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 31-12-2020 a las 12:48:15
-- Versión del servidor: 5.7.31-0ubuntu0.18.04.1
-- Versión de PHP: 7.2.24-0ubuntu0.18.04.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `optica`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `id_categoria` int(11) NOT NULL,
  `categoria` varchar(50) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`id_categoria`, `categoria`) VALUES
(2, 'Lentes oftálmicos'),
(3, 'Lentes de Sol'),
(4, 'Lentes de Seguridad'),
(5, 'Accesorios');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `id_cliente` varchar(13) COLLATE utf8_spanish_ci NOT NULL,
  `email` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `nombre` varchar(40) COLLATE utf8_spanish_ci DEFAULT NULL,
  `apellido` varchar(40) COLLATE utf8_spanish_ci DEFAULT NULL,
  `calle` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `colonia` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `ciudad` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `cod_postal` varchar(6) COLLATE utf8_spanish_ci DEFAULT NULL,
  `tipo` enum('Paypal','Manual') COLLATE utf8_spanish_ci NOT NULL DEFAULT 'Manual'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compra`
--

CREATE TABLE `compra` (
  `id_compra` int(11) NOT NULL,
  `folio` varchar(16) COLLATE utf8_spanish_ci NOT NULL,
  `fecha` date NOT NULL,
  `id_proveedor` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compra_detalle`
--

CREATE TABLE `compra_detalle` (
  `id_compra` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio_proveedor` double(5,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `forma`
--

CREATE TABLE `forma` (
  `id_forma` int(11) NOT NULL,
  `forma` varchar(50) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `forma`
--

INSERT INTO `forma` (`id_forma`, `forma`) VALUES
(1, 'Cuadrada'),
(2, 'Redondo'),
(3, 'Aviador'),
(4, 'Lágrima'),
(5, 'Niños');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inventario`
--

CREATE TABLE `inventario` (
  `id_producto` int(11) NOT NULL,
  `stock` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `inventario`
--

INSERT INTO `inventario` (`id_producto`, `stock`) VALUES
(5, 2),
(6, 3),
(7, 3),
(8, 3),
(9, 3),
(10, 2),
(11, 3),
(12, 3),
(13, 3),
(14, 3),
(15, 3),
(16, 3),
(17, 2),
(18, 3),
(19, 2),
(20, 3),
(21, 3),
(22, 3),
(23, 2),
(24, 3),
(25, 3),
(26, 3),
(27, 3),
(28, 2),
(29, 3),
(30, 3),
(31, 3),
(32, 3),
(33, 3),
(34, 3),
(35, 3),
(36, 3),
(37, 3),
(38, 2),
(39, 3),
(40, 3),
(41, 3),
(42, 3),
(43, 3),
(44, 3),
(45, 3),
(46, 3),
(47, 3),
(48, 3),
(49, 3),
(50, 2),
(51, 3),
(52, 3),
(53, 3),
(54, 3),
(55, 3),
(56, 3),
(57, 3),
(58, 3),
(59, 3),
(60, 3),
(61, 3),
(62, 3),
(63, 3),
(64, 3),
(65, 3),
(66, 3),
(67, 3),
(68, 3),
(69, 3),
(70, 3),
(71, 3),
(72, 3),
(73, 3),
(74, 3),
(75, 3),
(76, 3),
(77, 3),
(78, 3),
(79, 3),
(80, 3),
(81, 3),
(82, 3),
(83, 3),
(84, 3),
(85, 3),
(86, 3),
(87, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `marca`
--

CREATE TABLE `marca` (
  `id_marca` int(11) NOT NULL,
  `marca` varchar(50) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `marca`
--

INSERT INTO `marca` (`id_marca`, `marca`) VALUES
(7, 'Bebe'),
(8, 'Bolon'),
(9, 'Carolina Herrera'),
(10, 'Carrera'),
(11, 'Ck'),
(12, 'Coach'),
(13, 'Dkny'),
(14, 'Eagle Eyes'),
(15, 'Gigil Sol'),
(16, 'Giolé Milan'),
(17, 'Hawkers'),
(18, 'Lacoste'),
(19, 'Longchamp'),
(20, 'Maul Jim'),
(21, 'Michael Kors'),
(22, 'Nautica'),
(23, 'Nike'),
(24, 'Northweek'),
(25, 'Oakley'),
(26, 'Perse'),
(27, 'Polaroid'),
(28, 'Ray Ban'),
(29, 'Sting'),
(30, 'Tommy Jeans'),
(31, 'Versace'),
(32, 'Vogue'),
(33, 'Xsun'),
(34, 'Accura'),
(35, 'Link Flex Kids'),
(36, 'Molto'),
(37, 'Readers 4'),
(40, 'Trendy & Crazy'),
(41, 'Viatori');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permiso`
--

CREATE TABLE `permiso` (
  `id_permiso` int(11) NOT NULL,
  `permiso` varchar(100) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `permiso`
--

INSERT INTO `permiso` (`id_permiso`, `permiso`) VALUES
(9, 'Cruge'),
(10, 'Catalogos'),
(11, 'Inventario'),
(13, 'Leer compras'),
(14, 'Escribir compras'),
(15, 'Eliminar compras'),
(16, 'Leer proveedores'),
(17, 'Escribir proveedores'),
(18, 'Eliminar proveedores'),
(19, 'Dashboard'),
(20, 'Productos'),
(21, 'Leer clientes'),
(22, 'Escribir clientes'),
(23, 'Eliminar clientes'),
(24, 'Leer ventas'),
(25, 'Escribir ventas'),
(26, 'Eliminar ventas');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `id_producto` int(11) NOT NULL,
  `precio` decimal(6,2) NOT NULL,
  `descripcion` text COLLATE utf8_spanish_ci NOT NULL,
  `id_tipo_armazon` int(11) DEFAULT NULL,
  `id_marca` int(11) DEFAULT NULL,
  `id_categoria` int(11) DEFAULT NULL,
  `id_forma` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`id_producto`, `precio`, `descripcion`, `id_tipo_armazon`, `id_marca`, `id_categoria`, `id_forma`) VALUES
(5, '999.00', 'LENTE OFTÁLMICO PARA HOMBRE ACCURA ACC21908 GRIS', 6, 34, 2, 1),
(6, '999.00', 'LENTE OFTÁLMICO PARA MUJER ACCURA ACC21903 ROSA', 8, 34, 2, 2),
(7, '999.00', 'LENTE OFTÁLMICO PARA MUJER ACCURA ACC21902 ROJO', 5, 34, 2, 2),
(8, '999.00', 'LENTE OFTÁLMICO PARA MUJER ACCURA ACC21902 MORADO', 5, 34, 2, 2),
(9, '999.00', 'LENTE OFTÁLMICO PARA MUJER ACCURA ACC21903 MORADO', 8, 34, 2, 2),
(10, '999.00', 'LENTE OFTÁLMICO PARA HOMBRE ACCURA ACC21909 CAFÉ', 8, 34, 2, 1),
(11, '999.00', 'LENTE OFTÁLMICO PARA HOMBRE ACCURA ACC21901 ROJO', 10, 34, 2, 3),
(12, '999.00', 'LENTE OFTÁLMICO PARA NIÑO LINK FLEX KIDS CON1863 AZUL', 11, 35, 2, 5),
(13, '999.00', 'LENTE OFTÁLMICO PARA NIÑO LINK FLEX KIDS CON1863 MORADO', 11, 35, 2, 5),
(14, '999.00', 'LENTE OFTÁLMICO PARA NIÑO LINK FLEX KIDS CON1862 ROSA', 11, 35, 2, 5),
(15, '999.00', 'LENTE OFTÁLMICO PARA NIÑO LINK FLEX KIDS CON1864 NEGRO', 11, 35, 2, 5),
(16, '999.00', 'LENTE OFTÁLMICO PARA HOMBRE MOLTO DG94635M CAFE', 10, 36, 2, 3),
(17, '1200.00', 'LENTE OFTÁLMICO PARA HOMBRE MOLTO DG94618S AZUL', 10, 36, 2, 1),
(18, '999.00', 'LENTE OFTÁLMICO PARA HOMBRE MOLTO DG94622S AZUL', 6, 36, 2, 1),
(19, '1400.00', 'LENTE OFTÁLMICO PARA HOMBRE MOLTO DG84553S CAFE', 10, 36, 2, 1),
(20, '1100.00', 'LENTE OFTÁLMICO PARA HOMBRE MOLTO DG94639S CAFE', 10, 21, 2, 1),
(21, '999.00', 'LENTE OFTÁLMICO PARA HOMBRE MOLTO DG94623S NEGRO', 10, 36, 2, 2),
(22, '1100.00', 'LENTE OFTÁLMICO PARA HOMBRE MOLTO DG84506S CAFE', 10, 36, 2, 1),
(23, '999.00', 'Lente Oftálmico para Hombre Molto DG94613M Cafe', 5, 36, 2, 1),
(24, '850.00', 'LENTE OFTÁLMICO PARA MUJER READERS 4 S15531AI NEGRO', 6, 37, 2, 2),
(25, '999.00', 'LENTE OFTÁLMICO PARA MUJER READERS 4 S15531AI CAFÉ', 6, 37, 2, 2),
(26, '999.00', 'LENTE OFTÁLMICO PARA MUJER READERS 4 S15531AI AZUL', 6, 37, 2, 2),
(27, '1100.00', 'LENTE OFTÁLMICO UNISEX READERS 4 TAYLOR ROJO', 8, 37, 2, 1),
(28, '999.00', 'LENTE OFTÁLMICO PARA MUJER READERS 4 TAYLOR AZUL', 8, 37, 2, 1),
(29, '999.00', 'LENTE OFTÁLMICO PARA HOMBRE READERS 4 S15620AI VERDE', 8, 37, 2, 1),
(30, '999.00', 'LENTE OFTÁLMICO PARA HOMBRE TRENDY GIF910187S AZUL', 8, 40, 2, 1),
(31, '999.00', 'LENTE OFTÁLMICO UNISEX TRENDY & CRAZY LAF861892S NEGRO', 6, 40, 2, 2),
(32, '1200.00', 'LENTE OFTÁLMICO PARA HOMBRE TRENDY & CRAZY TIF851707S GRIS', 8, 40, 2, 1),
(33, '1100.00', 'LENTE OFTÁLMICO PARA MUJER TRENDY & CRAZY LIF851591S MORADO', 8, 40, 2, 2),
(34, '1650.00', 'LENTE OFTÁLMICO UNISEX TRENDY & CRAZY LAF861892S CAREY', 6, 40, 2, 2),
(35, '999.00', 'LENTE OFTÁLMICO PARA MUJER TRENDY & CRAZY LIH841368 GRIS', 8, 40, 2, 1),
(36, '1100.00', 'LENTE OFTÁLMICO UNISEX TRENDY & CRAZY TIF820505S CAREY GRIS', 8, 40, 2, 2),
(37, '950.00', 'LENTE OFTÁLMICO PARA MUJER TRENDY & CRAZY LIH841369 MORADO', 8, 40, 2, 2),
(38, '1100.00', 'LENTE OFTÁLMICO PARA MUJER TRENDY & CRAZY LIH841377 ROSA', 5, 40, 2, 1),
(39, '999.00', 'LENTE OFTÁLMICO UNISEX TRENDY & CRAZY TIF851707S CAREY', 8, 40, 2, 1),
(40, '999.00', 'LENTE OFTÁLMICO PARA MUJER TRENDY & CRAZY TIF820505S CAREY', 8, 40, 2, 2),
(41, '999.00', 'LENTE OFTÁLMICO UNISEX VIATORI VIA2007 AZUL', 10, 41, 2, 1),
(42, '1100.00', 'LENTE OFTÁLMICO UNISEX VIATORI VIA1809 CAFÉ', 5, 41, 2, 2),
(43, '1400.00', 'LENTE OFTÁLMICO PARA MUJER VIATORI VIA2009 NEGRO', 8, 41, 2, 2),
(44, '1300.00', 'LENTE OFTÁLMICO UNISEX VIATORI S18222AF2 AZUL', 6, 41, 2, 2),
(45, '999.00', 'LENTE OFTÁLMICO PARA MUJER VIATORI VIA1803 AZUL', 8, 41, 2, 1),
(46, '1200.00', 'LENTE OFTÁLMICO UNISEX VIATORI VIA1806 CAREY', 5, 41, 2, 1),
(47, '999.00', 'LENTE OFTÁLMICO PARA HOMBRE VIATORI S17434AF AZUL', 8, 41, 2, 1),
(48, '1200.00', 'LENTE OFTÁLMICO UNISEX VIATORI VIA1811 CAFÉ', 6, 41, 2, 2),
(49, '1100.00', 'LENTE OFTÁLMICO UNISEX VIATORI VIA1809 VERDE', 6, 41, 2, 2),
(50, '1350.00', 'LENTE OFTÁLMICO PARA HOMBRE VIATORI S17434AF CAREY', 8, 41, 2, 1),
(51, '999.00', 'LENTE OFTÁLMICO PARA MUJER VIATORI VIA1814 ROSA', 8, 41, 2, 1),
(52, '1100.00', 'LENTE OFTÁLMICO PARA HOMBRE VIATORI VIA1808 CAFÉ', 8, 41, 2, 1),
(53, '4999.00', 'LENTE SOLAR PARA MUJER BEBE BB7219 NEGRO', 6, 7, 3, 1),
(54, '4999.00', 'LENTE SOLAR PARA MUJER BEBE BB7219 VINO', 6, 7, 3, 1),
(55, '4999.00', 'LENTE SOLAR PARA MUJER BEBE BB7224 VINO', 6, 7, 3, 2),
(56, '4999.00', 'LENTE SOLAR PARA MUJER BEBE BB7224 NEGRO', 6, 7, 3, 2),
(57, '4699.00', 'LENTE SOLAR PARA MUJER BEBE BB7222 GRIS', 6, 7, 3, 2),
(58, '3999.00', 'LENTE DE SOL PARA HOMBRE BOLON BL7039A90 GRIS', 5, 8, 3, 4),
(59, '3949.00', 'LENTE DE SOL PARA MUJER BOLON BL7080B91 ARMAR', 6, 8, 3, 2),
(60, '3949.00', 'LENTE DE SOL PARA UNISEX BOLON BL7050A63 GRIS', 8, 8, 3, 1),
(61, '3949.00', 'LENTE DE SOL PARA MUJER BOLON BL7036B31 CAFÉ', 5, 8, 3, 2),
(62, '3949.00', 'LENTE DE SOL PARA MUJER BOLON BL7090B90 PLATA', 10, 8, 3, 1),
(63, '4599.00', 'LENTE DE SOL PARA MUJER CAROLINA HERRERA SHE153 DORADO', 10, 9, 3, 1),
(64, '4599.00', 'LENTE DE SOL PARA MUJER CAROLINA HERRERA SHE152 ROJO', 6, 9, 2, 2),
(65, '4399.00', 'LENTE DE SOL PARA MUJER CAROLINA HERRERA SHE752 NEGRO', 5, 9, 2, 1),
(66, '3799.00', 'LENTE DE SOL PARA HOMBRE CARRERA GRAND PRIX NEGRO', 6, 10, 3, 3),
(67, '4799.00', 'LENTE DE SOL PARA HOMBRE CARRERA CAR1027 NEGRO', 10, 10, 3, 1),
(68, '4999.00', 'LENTE DE SOL PARA HOMBRE CARRERA CAR10303 NEGRO', 8, 10, 2, 1),
(69, '5649.00', 'LENTE DE SOL PARA HOMBRE CARRERA CAR8035 NEGRO', 8, 10, 3, 1),
(70, '6499.00', 'LENTE DE SOL PARA HOMBRE CARRERA CAR8034 PLATA', 7, 10, 3, 1),
(71, '1799.00', 'LENTE DE SOL PARA HOMBRE EAGLE EYES TEARDROP NEGRO', 10, 14, 3, 4),
(72, '1799.00', 'LENTE DE SOL UNISEX EAGLE EYES AVIATOR DORADO', 10, 14, 3, 3),
(73, '3149.00', 'LENTE DE SOL PARA HOMBRE RAY BAN 0RB3029 DORADO', 6, 28, 3, 4),
(74, '3849.00', 'LENTE DE SOL UNISEX RAY BAN 0RB3570 NEGRO', 5, 28, 3, 1),
(75, '3399.00', 'LENTE DE SOL UNISEX RAY BAN 0RB3584N DORADO', 6, 28, 3, 4),
(76, '3499.00', 'LENTE DE SOL PARA HOMBRE RAY BAN RB3183 NEGRO', 5, 28, 3, 1),
(77, '5199.00', 'LENTE SOLAR PARA MUJER VERSACE 0VE2180 PLATA', 7, 31, 3, 3),
(78, '799.00', 'LENTE DE SOL UNISEX NORTHWEEK IRONMAN NEGRO', 8, 24, 3, 1),
(79, '518.00', 'Anteojo seguridad EAGLE', 8, 14, 4, 2),
(80, '518.00', 'Anteojo seguridad A2000', 8, 27, 4, 1),
(81, '518.00', 'Anteojo seguridad ZT200', 5, 22, 4, 2),
(82, '518.00', 'Anteojo seguridad Steel-Pro', 5, 17, 4, 1),
(83, '680.00', 'Gafas de seguridad PENTAX A2500', 5, 27, 4, 1),
(84, '299.00', 'Líquido limpiador de lentes Lens Cleaner', 5, 22, 5, 1),
(85, '170.00', 'Pinzas limpiadoras de lentes', 5, 16, 5, 1),
(86, '20.00', 'Microfibra limpiadora de lentes', 5, 34, 5, 1),
(87, '180.00', 'Estuche para gafas rígido case thermo negro', 5, 34, 5, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto_detalle`
--

CREATE TABLE `producto_detalle` (
  `id_producto` int(11) NOT NULL,
  `color` varchar(20) COLLATE utf8_spanish_ci DEFAULT NULL,
  `talla` smallint(6) NOT NULL,
  `longitud_varilla` smallint(6) NOT NULL,
  `ancho_puente` smallint(6) NOT NULL,
  `ancho_total` smallint(6) NOT NULL,
  `sku` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `foto` varchar(20) COLLATE utf8_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `producto_detalle`
--

INSERT INTO `producto_detalle` (`id_producto`, `color`, `talla`, `longitud_varilla`, `ancho_puente`, `ancho_total`, `sku`, `foto`) VALUES
(5, 'Gris', 56, 149, 16, 134, '90BAC313', '5fe2d14415ab1.jpeg'),
(6, 'Rosa', 58, 144, 21, 135, '10C06ED4', '5fe2d1f2c402e.jpeg'),
(7, 'Rojo', 54, 141, 20, 133, 'BD5127B6', '5fe2d230424c1.jpeg'),
(8, 'Morado', 56, 140, 17, 136, '2506E9CC', '5fe2d268dffe4.jpeg'),
(9, 'Morado', 58, 145, 16, 121, 'D6C8E993', '5fe2d2af69672.jpeg'),
(10, 'Café', 53, 143, 19, 124, 'DA2DF3EB', '5fe2d2fa26aa1.jpeg'),
(11, 'Rojo', 55, 149, 17, 127, 'FC2400D4', '5fe2d35351533.jpeg'),
(12, 'Azúl', 57, 149, 17, 120, '7CA7998A', '5fe2d411ee0ee.jpeg'),
(13, 'Morado', 58, 148, 17, 133, 'E55E7B17', '5fe2d444a8e97.jpeg'),
(14, 'Rosa', 58, 141, 15, 121, '43FB7A23', '5fe2d477817e8.jpeg'),
(15, 'Negro', 54, 149, 15, 139, '20DCD568', '5fe2d4a12a3af.jpeg'),
(16, 'Café', 53, 145, 20, 138, '7E6994F2', '5fe2d50bdec05.jpeg'),
(17, 'Azul', 55, 142, 17, 134, '91AAFF0F', '5fe2d57aec0b9.jpeg'),
(18, 'Azul', 53, 142, 18, 129, '7AC26ADF', '5fe2d5ed08eda.jpeg'),
(19, 'Café', 54, 147, 21, 132, 'A10EC421', '5fe2d62d8c6d9.jpeg'),
(20, 'Café', 56, 141, 21, 131, '6EBD3AAD', '5fe2d694ae923.jpeg'),
(21, 'Negro', 57, 150, 21, 128, '8F0CF75B', '5fe2d6ceb74da.jpeg'),
(22, 'Café', 57, 140, 18, 124, '3DF4C5D4', '5fe2d6f5a70b2.jpeg'),
(23, 'Café', 55, 140, 21, 124, 'EF5CF858', '5fe2d73ae97e5.jpeg'),
(24, 'Negro', 57, 149, 18, 131, '1270DB8D', '5fe2d7dabc052.jpeg'),
(25, 'Café', 57, 146, 19, 134, '240D9B56', '5fe2d804b053d.jpeg'),
(26, 'Azul', 56, 148, 18, 136, '8581954B', '5fe2d8307c9f0.jpeg'),
(27, 'Rojo', 53, 150, 16, 136, '43E7CAED', '5fe2d8625c005.jpeg'),
(28, 'Azul', 55, 140, 20, 128, '9AE764BD', '5fe2d89f8718d.jpeg'),
(29, 'Verde', 58, 148, 21, 122, 'E627B425', '5fe2d8e7bc655.jpeg'),
(30, 'Azul', 54, 146, 20, 137, '3DE68678', '5fe2d9380c19c.jpeg'),
(31, 'Negro', 54, 149, 20, 122, '3C4F89A3', '5fe2d97510804.jpeg'),
(32, 'Gris', 54, 144, 19, 135, '9F8AD69C', '5fe2d9c1baf77.jpeg'),
(33, 'Morado', 57, 145, 18, 120, '6CA509A3', '5fe2d9eca8d03.jpeg'),
(34, 'Carey', 55, 148, 18, 136, '1669D37E', '5fe2da3c7b752.jpeg'),
(35, 'Gris', 58, 140, 17, 139, '0CE66E38', '5fe2da6b63974.jpeg'),
(36, 'Gris', 56, 142, 17, 122, 'C9B96F63', '5fe2da9987c9a.jpeg'),
(37, 'Morado', 53, 149, 16, 139, '27581167', '5fe2dac77bacf.jpeg'),
(38, 'Rosa', 53, 144, 15, 124, '445EBAD8', '5fe2dae9740bd.jpeg'),
(39, 'Carey', 57, 147, 21, 128, 'BDAC9837', '5fe2db10708b3.jpeg'),
(40, 'Carey', 54, 149, 18, 122, 'C35579CF', '5fe557897aab3.jpeg'),
(41, 'Azul', 53, 143, 19, 123, '73FBFB08', '5fe2dbc2aedf2.jpeg'),
(42, 'Café', 55, 144, 17, 138, '591D99B6', '5fe2dbdfe7c72.jpeg'),
(43, 'Negro', 54, 149, 20, 121, '345E0FC8', '5fe2dc0e3e4dd.jpeg'),
(44, 'Azul', 53, 142, 18, 132, '05B8E555', '5fe2dc3928d9e.jpeg'),
(45, 'Azul', 58, 144, 16, 126, '0D5FB85D', '5fe2dc845cd6e.jpeg'),
(46, 'Carey', 57, 149, 21, 127, '2D3B22D7', '5fe2dca7695c9.jpeg'),
(47, 'Azul', 53, 148, 15, 128, '27708B3E', '5fe2dcf7c1448.jpeg'),
(48, 'Café', 54, 144, 18, 121, 'BE932BDE', '5fe2dd238e98e.jpeg'),
(49, 'Verde', 58, 144, 15, 128, '869096D3', '5fe2dd541803b.jpeg'),
(50, 'Carey', 54, 146, 21, 124, 'D2FFD474', '5fe2dd84c5069.jpeg'),
(51, 'Rosa', 57, 142, 18, 132, '15FABCE5', '5fe2dda75e4b8.jpeg'),
(52, 'Café', 55, 148, 21, 121, 'ADEBD371', '5fe2ddcace962.jpeg'),
(53, 'Negro', 53, 142, 17, 130, '1556341E', '5fe35ce04b078.jpeg'),
(54, 'Vino', 54, 144, 21, 135, '0415CE8C', '5fe35d2f57956.jpeg'),
(55, 'Vino', 55, 144, 20, 131, '27E69301', '5fe35d58062fe.jpeg'),
(56, 'Negro', 54, 145, 16, 128, '6F1A0AA8', '5fe35d7ac1d7f.jpeg'),
(57, 'Gris', 54, 141, 20, 131, 'FEFD5758', '5fe35da4e2f31.jpeg'),
(58, 'Gris', 54, 142, 15, 134, 'F1F1BA79', '5fe35dda6541e.jpeg'),
(59, 'Plata', 56, 140, 17, 122, '7C7A4AD0', '5fe35e0f4c72b.jpeg'),
(60, 'Gris', 56, 141, 21, 137, '52A3E750', '5fe35e3891ced.jpeg'),
(61, 'Café', 57, 144, 20, 121, '78B05B8E', '5fe35e652ecd4.jpeg'),
(62, 'Plata', 53, 145, 20, 137, 'E4561FC9', '5fe35e8feb141.jpeg'),
(63, 'Dorado', 58, 140, 21, 127, 'EA4906E3', '5fe35edea0bab.jpeg'),
(64, 'Rojo', 53, 142, 19, 137, '1E700159', '5fe35effd469d.jpeg'),
(65, 'Negro', 56, 142, 16, 124, '4B3B7305', '5fe35f22ce4e7.jpeg'),
(66, 'Negro', 57, 143, 15, 132, '57E2A0C9', '5fe35f672c469.jpeg'),
(67, 'Negro', 58, 150, 17, 132, '8E030DB1', '5fe35f8d68d2b.jpeg'),
(68, 'Negro', 54, 141, 18, 122, '91A82850', '5fe35ff2bb265.jpeg'),
(69, 'Negro', 55, 150, 19, 128, '51C06390', '5fe360233b016.jpeg'),
(70, 'Plata', 53, 144, 15, 129, '22DFA936', '5fe3604c05080.jpeg'),
(71, 'Negro', 53, 146, 16, 122, '0B372118', '5fe3607be529e.jpeg'),
(72, 'Dorado', 55, 150, 17, 123, '74FFE7AE', '5fe360ab75672.png'),
(73, 'Dorado', 54, 147, 18, 121, 'A8458863', '5fe360ddaf510.jpeg'),
(74, 'Negro', 55, 140, 15, 120, 'A4B3F34A', '5fe3611d69fe0.jpeg'),
(75, 'Dorado', 54, 142, 15, 138, 'D1216CC0', '5fe361428929a.jpeg'),
(76, 'Negro', 57, 144, 18, 138, 'B4EF8B5A', '5fe3616e1b0e3.jpeg'),
(77, 'Plata', 58, 142, 19, 122, 'E18EE613', '5fe3619fad3ae.jpeg'),
(78, 'Negro', 57, 150, 16, 132, '27EB04E0', '5fe361c951941.png'),
(79, 'Negro', 54, 148, 17, 122, '6B5F75AA', '5fe3631172931.jpeg'),
(80, 'Negro', 58, 147, 20, 132, 'C9DF5941', '5fe36469dc34d.jpeg'),
(81, 'Negro', 54, 142, 18, 120, '099163CE', '5fe3649ecbe23.jpeg'),
(82, 'Negro', 54, 148, 16, 125, 'B0B26E30', '5fe364cb8b6ae.jpeg'),
(83, 'Negro', 53, 146, 21, 121, 'EF9002B2', '5fe3650ae3e16.jpeg'),
(84, 'Blanco', 56, 146, 20, 140, '0A3D6632', '5fe3662f45ce9.jpeg'),
(85, 'Azul', 56, 144, 17, 140, 'D060775E', '5fe3667928043.jpeg'),
(86, '', 55, 144, 21, 123, '1E5C7FB0', '5fe4032ea787f.jpeg'),
(87, 'Negro', 56, 145, 18, 129, 'AEFFC7C9', '5fec31bb1645b.jpeg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedor`
--

CREATE TABLE `proveedor` (
  `id_proveedor` int(11) NOT NULL,
  `razon_social` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `rfc` varchar(13) COLLATE utf8_spanish_ci NOT NULL,
  `domicilio` text COLLATE utf8_spanish_ci NOT NULL,
  `telefono` varchar(10) COLLATE utf8_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `id_rol` int(11) NOT NULL,
  `rol` varchar(100) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`id_rol`, `rol`) VALUES
(3, 'Administrador'),
(4, 'Empleado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol_permiso`
--

CREATE TABLE `rol_permiso` (
  `id_rol` int(11) NOT NULL,
  `id_permiso` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `rol_permiso`
--

INSERT INTO `rol_permiso` (`id_rol`, `id_permiso`) VALUES
(3, 9),
(3, 10),
(4, 10),
(3, 11),
(4, 11),
(3, 13),
(4, 13),
(3, 14),
(3, 15),
(3, 16),
(4, 16),
(3, 17),
(3, 18),
(3, 19),
(4, 19),
(3, 20),
(4, 20),
(3, 21),
(4, 21),
(3, 22),
(4, 22),
(3, 23),
(3, 24),
(4, 24),
(3, 25),
(4, 25),
(3, 26);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_armazon`
--

CREATE TABLE `tipo_armazon` (
  `id_tipo_armazon` int(11) NOT NULL,
  `tipo_armazon` varchar(50) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tipo_armazon`
--

INSERT INTO `tipo_armazon` (`id_tipo_armazon`, `tipo_armazon`) VALUES
(5, 'Ranurado'),
(6, 'Aro completo'),
(7, 'Volado'),
(8, 'Acetato'),
(10, 'Metálico'),
(11, 'Flex');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id_usuario` int(11) NOT NULL,
  `correo` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `nombre` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `contrasena` varchar(32) COLLATE utf8_spanish_ci NOT NULL,
  `foto` varchar(20) COLLATE utf8_spanish_ci DEFAULT NULL,
  `token` varchar(16) COLLATE utf8_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `correo`, `nombre`, `contrasena`, `foto`, `token`) VALUES
(43, 'fernandotovar9902@gmail.com', 'Fernando Acosta', '202cb962ac59075b964b07152d234b70', '5fe151ff8d933.jpeg', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario_rol`
--

CREATE TABLE `usuario_rol` (
  `id_usuario` int(11) NOT NULL,
  `id_rol` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `usuario_rol`
--

INSERT INTO `usuario_rol` (`id_usuario`, `id_rol`) VALUES
(43, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `venta`
--

CREATE TABLE `venta` (
  `id_venta` varchar(17) COLLATE utf8_spanish_ci NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_cliente` varchar(13) COLLATE utf8_spanish_ci DEFAULT NULL,
  `status` enum('COMPLETED','CANCELLED') COLLATE utf8_spanish_ci NOT NULL,
  `tipo` enum('Paypal','Manual') COLLATE utf8_spanish_ci NOT NULL DEFAULT 'Manual'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `venta_detalle`
--

CREATE TABLE `venta_detalle` (
  `id_venta` varchar(17) COLLATE utf8_spanish_ci NOT NULL,
  `id_producto` int(11) NOT NULL,
  `cantidad` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`id_categoria`);

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`id_cliente`);

--
-- Indices de la tabla `compra`
--
ALTER TABLE `compra`
  ADD PRIMARY KEY (`id_compra`),
  ADD UNIQUE KEY `uq_folio` (`folio`),
  ADD KEY `fk_proveedor_compra` (`id_proveedor`);

--
-- Indices de la tabla `compra_detalle`
--
ALTER TABLE `compra_detalle`
  ADD PRIMARY KEY (`id_compra`,`id_producto`),
  ADD KEY `fk_pruducto_compra` (`id_producto`);

--
-- Indices de la tabla `forma`
--
ALTER TABLE `forma`
  ADD PRIMARY KEY (`id_forma`);

--
-- Indices de la tabla `inventario`
--
ALTER TABLE `inventario`
  ADD KEY `fk_producto_inventario` (`id_producto`);

--
-- Indices de la tabla `marca`
--
ALTER TABLE `marca`
  ADD PRIMARY KEY (`id_marca`);

--
-- Indices de la tabla `permiso`
--
ALTER TABLE `permiso`
  ADD PRIMARY KEY (`id_permiso`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`id_producto`),
  ADD KEY `fk_id_marca` (`id_marca`),
  ADD KEY `fk_id_categoria` (`id_categoria`),
  ADD KEY `fk_id_tipo_armazon` (`id_tipo_armazon`),
  ADD KEY `fk_id_forma` (`id_forma`);

--
-- Indices de la tabla `producto_detalle`
--
ALTER TABLE `producto_detalle`
  ADD KEY `fk_producto_detalle` (`id_producto`);

--
-- Indices de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  ADD PRIMARY KEY (`id_proveedor`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`id_rol`);

--
-- Indices de la tabla `rol_permiso`
--
ALTER TABLE `rol_permiso`
  ADD PRIMARY KEY (`id_rol`,`id_permiso`),
  ADD KEY `id_permiso` (`id_permiso`);

--
-- Indices de la tabla `tipo_armazon`
--
ALTER TABLE `tipo_armazon`
  ADD PRIMARY KEY (`id_tipo_armazon`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_usuario`),
  ADD UNIQUE KEY `correo` (`correo`);

--
-- Indices de la tabla `usuario_rol`
--
ALTER TABLE `usuario_rol`
  ADD PRIMARY KEY (`id_usuario`,`id_rol`),
  ADD KEY `usuario_rol_ibfk_2` (`id_rol`);

--
-- Indices de la tabla `venta`
--
ALTER TABLE `venta`
  ADD PRIMARY KEY (`id_venta`),
  ADD KEY `fk_id_venta_cliente` (`id_cliente`);

--
-- Indices de la tabla `venta_detalle`
--
ALTER TABLE `venta_detalle`
  ADD PRIMARY KEY (`id_venta`,`id_producto`),
  ADD KEY `fk_id_producto_venta_detalle` (`id_producto`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `compra`
--
ALTER TABLE `compra`
  MODIFY `id_compra` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `forma`
--
ALTER TABLE `forma`
  MODIFY `id_forma` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `marca`
--
ALTER TABLE `marca`
  MODIFY `id_marca` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;
--
-- AUTO_INCREMENT de la tabla `permiso`
--
ALTER TABLE `permiso`
  MODIFY `id_permiso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `id_producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;
--
-- AUTO_INCREMENT de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  MODIFY `id_proveedor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `id_rol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `tipo_armazon`
--
ALTER TABLE `tipo_armazon`
  MODIFY `id_tipo_armazon` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `compra`
--
ALTER TABLE `compra`
  ADD CONSTRAINT `fk_proveedor_compra` FOREIGN KEY (`id_proveedor`) REFERENCES `proveedor` (`id_proveedor`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `compra_detalle`
--
ALTER TABLE `compra_detalle`
  ADD CONSTRAINT `fk_comṕra_detalle` FOREIGN KEY (`id_compra`) REFERENCES `compra` (`id_compra`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_pruducto_compra` FOREIGN KEY (`id_producto`) REFERENCES `producto` (`id_producto`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `inventario`
--
ALTER TABLE `inventario`
  ADD CONSTRAINT `fk_producto_inventario` FOREIGN KEY (`id_producto`) REFERENCES `producto` (`id_producto`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `producto`
--
ALTER TABLE `producto`
  ADD CONSTRAINT `fk_id_categoria` FOREIGN KEY (`id_categoria`) REFERENCES `categoria` (`id_categoria`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_id_forma` FOREIGN KEY (`id_forma`) REFERENCES `forma` (`id_forma`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_id_marca` FOREIGN KEY (`id_marca`) REFERENCES `marca` (`id_marca`),
  ADD CONSTRAINT `fk_id_tipo_armazon` FOREIGN KEY (`id_tipo_armazon`) REFERENCES `tipo_armazon` (`id_tipo_armazon`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Filtros para la tabla `producto_detalle`
--
ALTER TABLE `producto_detalle`
  ADD CONSTRAINT `fk_producto_detalle` FOREIGN KEY (`id_producto`) REFERENCES `producto` (`id_producto`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `rol_permiso`
--
ALTER TABLE `rol_permiso`
  ADD CONSTRAINT `fk_rol_permiso` FOREIGN KEY (`id_rol`) REFERENCES `rol` (`id_rol`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_rol_permiso_permiso` FOREIGN KEY (`id_permiso`) REFERENCES `permiso` (`id_permiso`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuario_rol`
--
ALTER TABLE `usuario_rol`
  ADD CONSTRAINT `fk_usuario_rol` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_usuario_rol_rol` FOREIGN KEY (`id_rol`) REFERENCES `rol` (`id_rol`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `venta`
--
ALTER TABLE `venta`
  ADD CONSTRAINT `fk_id_venta_cliente` FOREIGN KEY (`id_cliente`) REFERENCES `cliente` (`id_cliente`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `venta_detalle`
--
ALTER TABLE `venta_detalle`
  ADD CONSTRAINT `fk_id_producto_venta_detalle` FOREIGN KEY (`id_producto`) REFERENCES `producto` (`id_producto`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_id_venta_venta_detalle` FOREIGN KEY (`id_venta`) REFERENCES `venta` (`id_venta`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
