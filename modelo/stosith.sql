-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 16-12-2024 a las 00:32:36
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `stosith`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `certificados`
--

CREATE TABLE `certificados` (
  `COD_Cert` int(11) NOT NULL,
  `NombreCert` varchar(255) NOT NULL,
  `Tipo` enum('e-mail','usuario','tarjeta identificativa','server') NOT NULL,
  `Estado` enum('en vigor','revocado','renovar') NOT NULL,
  `COD_Dom` int(11) DEFAULT NULL,
  `FechaCreacion` datetime DEFAULT current_timestamp(),
  `FechaCaducidad` datetime GENERATED ALWAYS AS (`FechaCreacion` + interval 18 month) STORED
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `certificados`
--

INSERT INTO `certificados` (`COD_Cert`, `NombreCert`, `Tipo`, `Estado`, `COD_Dom`, `FechaCreacion`) VALUES
(1, 'alonso@kormorram.com', 'e-mail', 'en vigor', 1, '2024-12-15 23:40:57'),
(2, 'carlos@kormorram.com', 'e-mail', 'en vigor', 1, '2024-12-15 23:41:23'),
(3, 'pepe@kormorram.es', 'e-mail', 'en vigor', 2, '2024-12-15 23:41:23'),
(4, 'shop.kormorram.com', 'server', 'en vigor', 1, '2024-12-15 23:43:15');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `COD_Cliente` int(11) NOT NULL,
  `NombreCliente` varchar(100) NOT NULL,
  `Email` varchar(100) DEFAULT NULL,
  `Address` varchar(255) DEFAULT NULL,
  `NIF` varchar(15) DEFAULT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`COD_Cliente`, `NombreCliente`, `Email`, `Address`, `NIF`, `password`) VALUES
(1, 'Kormorram', 'sistemas@kormorram.com', 'Poligono de Castiñeiras, 56', '35491562D', '$2y$10$T.6jo.K794OnhdCEMOVylezfeOTON1445MJ49KCGFMRAi5Xtl9ex.');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dominios`
--

CREATE TABLE `dominios` (
  `COD_Dom` int(11) NOT NULL,
  `NombreDom` varchar(255) NOT NULL,
  `COD_Cliente` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `dominios`
--

INSERT INTO `dominios` (`COD_Dom`, `NombreDom`, `COD_Cliente`) VALUES
(1, 'kormorram.com', 1),
(2, 'kormorram.es', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `certificados`
--
ALTER TABLE `certificados`
  ADD PRIMARY KEY (`COD_Cert`),
  ADD KEY `COD_Dom` (`COD_Dom`);

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`COD_Cliente`);

--
-- Indices de la tabla `dominios`
--
ALTER TABLE `dominios`
  ADD PRIMARY KEY (`COD_Dom`),
  ADD KEY `COD_Cliente` (`COD_Cliente`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `certificados`
--
ALTER TABLE `certificados`
  MODIFY `COD_Cert` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `COD_Cliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `dominios`
--
ALTER TABLE `dominios`
  MODIFY `COD_Dom` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `certificados`
--
ALTER TABLE `certificados`
  ADD CONSTRAINT `certificados_ibfk_1` FOREIGN KEY (`COD_Dom`) REFERENCES `dominios` (`COD_Dom`) ON DELETE CASCADE;

--
-- Filtros para la tabla `dominios`
--
ALTER TABLE `dominios`
  ADD CONSTRAINT `dominios_ibfk_1` FOREIGN KEY (`COD_Cliente`) REFERENCES `clientes` (`COD_Cliente`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
