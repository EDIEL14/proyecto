-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 28-10-2024 a las 17:17:36
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
-- Base de datos: `planos`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `condominios_horizontales`
--

CREATE TABLE `condominios_horizontales` (
  `id_condominio` int(11) NOT NULL,
  `nombre_condominio` varchar(100) NOT NULL,
  `total_unidades` int(11) NOT NULL,
  `estilo_viviendas` varchar(100) DEFAULT NULL,
  `superficie_promedio` decimal(10,2) DEFAULT NULL,
  `tamano_terreno` decimal(10,2) DEFAULT NULL,
  `zonas_comunes` varchar(255) DEFAULT NULL,
  `servicios` varchar(255) DEFAULT NULL,
  `precio` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `condominios_horizontales`
--

INSERT INTO `condominios_horizontales` (`id_condominio`, `nombre_condominio`, `total_unidades`, `estilo_viviendas`, `superficie_promedio`, `tamano_terreno`, `zonas_comunes`, `servicios`, `precio`) VALUES
(1, 'Condominio Vista Verde', 30, 'Moderno y funcional', 120.00, 10000.00, 'Parque infantil, Área de BBQ, Piscina comunitaria, Gimnasio, Salón de eventos', 'Seguridad 24/7, Estacionamiento para visitantes, Mantenimiento de áreas comunes, Jardinería', 1500000.00);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `departamentos`
--

CREATE TABLE `departamentos` (
  `id_departamento` int(11) NOT NULL,
  `tipo_departamento` varchar(50) NOT NULL,
  `torres` varchar(50) NOT NULL,
  `niveles` varchar(20) NOT NULL,
  `habitaciones` varchar(20) NOT NULL,
  `precio` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `departamentos`
--

INSERT INTO `departamentos` (`id_departamento`, `tipo_departamento`, `torres`, `niveles`, `habitaciones`, `precio`) VALUES
(4, 'Departamento tipo (50 x 60)', '2', '4 a 8', '3', 120000.00),
(5, 'Departamento tipo (29 x 40)', '1', '8', '3', 80000.00),
(6, 'Departamento tipo (20 x 25)', '1', '4', '3', 60000.00);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historial_compras`
--

CREATE TABLE `historial_compras` (
  `id_compra` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `tipo_plano` varchar(100) NOT NULL,
  `precio_plano` decimal(10,2) NOT NULL,
  `metodo_pago` varchar(50) NOT NULL,
  `fecha_hora` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historial_condominio`
--

CREATE TABLE `historial_condominio` (
  `id_compra` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `nombre_condominio` varchar(100) NOT NULL,
  `precio_condominio` decimal(10,2) NOT NULL,
  `metodo_pago` varchar(50) NOT NULL,
  `fecha_hora` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historial_departamento`
--

CREATE TABLE `historial_departamento` (
  `id_compra` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `tipo_departamento` varchar(50) NOT NULL,
  `precio_departamento` decimal(10,2) NOT NULL,
  `metodo_pago` varchar(50) NOT NULL,
  `fecha_hora` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `planos_residenciales`
--

CREATE TABLE `planos_residenciales` (
  `id_planos` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `habitaciones` int(11) NOT NULL,
  `niveles` int(11) NOT NULL,
  `descripcion` varchar(255) NOT NULL,
  `tamano` varchar(50) NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `vehiculos` int(11) NOT NULL,
  `detalles` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `planos_residenciales`
--

INSERT INTO `planos_residenciales` (`id_planos`, `nombre`, `habitaciones`, `niveles`, `descripcion`, `tamano`, `precio`, `vehiculos`, `detalles`) VALUES
(1, 'Casa tipo (terreno 9 x 17)', 4, 4, 'Ideal para vivir, cuenta con un diseño contemporáneo y funcional.', '144 m²', 6000.00, 1, NULL),
(2, 'Casa tipo (terreno 8 x 20)', 3, 3, 'Perfecta para un estilo de vida moderno, con espacios amplios y luminosos.', '200 m²', 5350.00, 2, NULL),
(3, 'Casa tipo (terreno 7 x 16)', 2, 1, 'Espacios diseñados para el confort familiar, ideal para la convivencia.', '216 m²', 5000.00, 2, NULL),
(4, 'Casa tipo (terreno 8 x 16)', 3, 2, 'Diseño un poco amplio que maximiza los espacios.', '128 m²', 5200.00, 1, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `numero_telefono` varchar(15) DEFAULT NULL,
  `correo_electronico` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `nombre`, `usuario`, `password`, `numero_telefono`, `correo_electronico`) VALUES
(10, 'Ediel Martin Solis Lozano', 'ediel', '123', '9983296166', 'edielmartinsolislozano@gmail.com');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `condominios_horizontales`
--
ALTER TABLE `condominios_horizontales`
  ADD PRIMARY KEY (`id_condominio`);

--
-- Indices de la tabla `departamentos`
--
ALTER TABLE `departamentos`
  ADD PRIMARY KEY (`id_departamento`);

--
-- Indices de la tabla `historial_compras`
--
ALTER TABLE `historial_compras`
  ADD PRIMARY KEY (`id_compra`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `historial_condominio`
--
ALTER TABLE `historial_condominio`
  ADD PRIMARY KEY (`id_compra`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `historial_departamento`
--
ALTER TABLE `historial_departamento`
  ADD PRIMARY KEY (`id_compra`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `planos_residenciales`
--
ALTER TABLE `planos_residenciales`
  ADD PRIMARY KEY (`id_planos`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`),
  ADD UNIQUE KEY `usuario` (`usuario`),
  ADD UNIQUE KEY `correo_electronico` (`correo_electronico`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `condominios_horizontales`
--
ALTER TABLE `condominios_horizontales`
  MODIFY `id_condominio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `departamentos`
--
ALTER TABLE `departamentos`
  MODIFY `id_departamento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `historial_compras`
--
ALTER TABLE `historial_compras`
  MODIFY `id_compra` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `historial_condominio`
--
ALTER TABLE `historial_condominio`
  MODIFY `id_compra` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `historial_departamento`
--
ALTER TABLE `historial_departamento`
  MODIFY `id_compra` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `planos_residenciales`
--
ALTER TABLE `planos_residenciales`
  MODIFY `id_planos` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `historial_compras`
--
ALTER TABLE `historial_compras`
  ADD CONSTRAINT `historial_compras_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`);

--
-- Filtros para la tabla `historial_condominio`
--
ALTER TABLE `historial_condominio`
  ADD CONSTRAINT `historial_condominio_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`);

--
-- Filtros para la tabla `historial_departamento`
--
ALTER TABLE `historial_departamento`
  ADD CONSTRAINT `historial_departamento_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
