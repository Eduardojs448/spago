-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 31-07-2021 a las 19:26:13
-- Versión del servidor: 5.7.24
-- Versión de PHP: 7.4.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `spago`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ordenes_de_pago`
--

CREATE TABLE `ordenes_de_pago` (
  `id` int(11) NOT NULL,
  `num_orden` varchar(190) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `rut` varchar(190) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `empresa` varchar(190) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `monto_total` decimal(11,2) NOT NULL,
  `cuotas` int(5) NOT NULL,
  `fecha_orden` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ordenes_de_pago_detalle`
--

CREATE TABLE `ordenes_de_pago_detalle` (
  `id` int(11) NOT NULL,
  `fk_orden_pago` int(11) NOT NULL,
  `num_orden` varchar(190) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `rut_deudor` varchar(190) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `empresa` varchar(190) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `cuota` int(5) NOT NULL,
  `cuota_monto` decimal(11,2) NOT NULL,
  `fecha_vencimiento` date NOT NULL,
  `estado` varchar(190) COLLATE utf8mb4_spanish2_ci NOT NULL DEFAULT 'DEUDA',
  `id_transaccion` varchar(190) COLLATE utf8mb4_spanish2_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pago_orden_pago`
--

CREATE TABLE `pago_orden_pago` (
  `idOrdenPago` varchar(11) NOT NULL,
  `rut` varchar(10) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `total` double DEFAULT NULL,
  `fechaOrden` varchar(8) NOT NULL,
  `status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `pago_orden_pago`
--

INSERT INTO `pago_orden_pago` (`idOrdenPago`, `rut`, `email`, `total`, `fechaOrden`, `status`) VALUES
('3456276', '272093016', 'esolano547@gmail.com', 3000, '26/06/20', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tabladetallepagos`
--

CREATE TABLE `tabladetallepagos` (
  `idOrdenPago` int(11) NOT NULL,
  `empresa` varchar(100) DEFAULT NULL,
  `rutDeudor` varchar(10) DEFAULT NULL,
  `operacion` varchar(100) DEFAULT NULL,
  `cuota` varchar(45) DEFAULT NULL,
  `fechaVencimiento` date DEFAULT NULL,
  `monto` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tabladetallepagos`
--

INSERT INTO `tabladetallepagos` (`idOrdenPago`, `empresa`, `rutDeudor`, `operacion`, `cuota`, `fechaVencimiento`, `monto`) VALUES
(1, 'duoc', '187003210', '4564465', '2', '2021-07-22', 500),
(2, 'abcdin', '187003210', '56789065', '5', '2021-07-22', 500);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tablapagos`
--

CREATE TABLE `tablapagos` (
  `flowOrder` int(11) DEFAULT NULL,
  `commerceOrder` varchar(100) DEFAULT NULL,
  `requestDate` varchar(100) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `subject` varchar(250) DEFAULT NULL,
  `currency` varchar(45) DEFAULT NULL,
  `amount` int(11) DEFAULT NULL,
  `payer` varchar(100) DEFAULT NULL,
  `pd_date` varchar(100) DEFAULT NULL,
  `pd_media` varchar(100) DEFAULT NULL,
  `pd_conversionDate` varchar(45) DEFAULT NULL,
  `pd_conversionRate` int(11) DEFAULT NULL,
  `pd_amount` int(11) DEFAULT NULL,
  `pd_currency` varchar(45) DEFAULT NULL,
  `pd_fee` int(11) DEFAULT NULL,
  `pd_balance` int(11) DEFAULT NULL,
  `pd_transferDate` varchar(45) DEFAULT NULL,
  `merchantId` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tabla_deudas`
--

CREATE TABLE `tabla_deudas` (
  `id_temporal` int(11) NOT NULL,
  `cedente` varchar(50) NOT NULL,
  `rut` varchar(50) NOT NULL,
  `operacion` varchar(45) NOT NULL,
  `cuota` varchar(45) NOT NULL,
  `fecha_vencimiento` varchar(10) NOT NULL,
  `monto` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `rut` varchar(11) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `ordenes_de_pago`
--
ALTER TABLE `ordenes_de_pago`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `ordenes_de_pago_detalle`
--
ALTER TABLE `ordenes_de_pago_detalle`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `pago_orden_pago`
--
ALTER TABLE `pago_orden_pago`
  ADD PRIMARY KEY (`idOrdenPago`);

--
-- Indices de la tabla `tabladetallepagos`
--
ALTER TABLE `tabladetallepagos`
  ADD PRIMARY KEY (`idOrdenPago`);

--
-- Indices de la tabla `tabla_deudas`
--
ALTER TABLE `tabla_deudas`
  ADD PRIMARY KEY (`id_temporal`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `ordenes_de_pago`
--
ALTER TABLE `ordenes_de_pago`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `ordenes_de_pago_detalle`
--
ALTER TABLE `ordenes_de_pago_detalle`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tabladetallepagos`
--
ALTER TABLE `tabladetallepagos`
  MODIFY `idOrdenPago` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
