-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 30-09-2022 a las 06:28:34
-- Versión del servidor: 10.4.24-MariaDB
-- Versión de PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `mascota`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estados`
--

CREATE TABLE `estados` (
  `id_est` int(11) NOT NULL,
  `desc_est` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `estados`
--

INSERT INTO `estados` (`id_est`, `desc_est`) VALUES
(1, 'Activo'),
(2, 'Inactivo'),
(3, 'Sano'),
(4, 'Enfermo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mascotas_clientes`
--

CREATE TABLE `mascotas_clientes` (
  `cod_masc` varchar(10) NOT NULL,
  `nom_masc` varchar(30) NOT NULL,
  `id_usuario` varchar(15) NOT NULL,
  `color` varchar(30) NOT NULL,
  `id_masc` int(11) NOT NULL,
  `raza` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `medicamentos`
--

CREATE TABLE `medicamentos` (
  `id_med` varchar(5) NOT NULL,
  `desc_med` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_mascotas`
--

CREATE TABLE `tipo_mascotas` (
  `id_masc` int(11) NOT NULL,
  `tip_masc` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tipo_mascotas`
--

INSERT INTO `tipo_mascotas` (`id_masc`, `tip_masc`) VALUES
(1, 'PERRO'),
(2, 'GATO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_usuarios`
--

CREATE TABLE `tipo_usuarios` (
  `tipo_usuario` int(11) NOT NULL,
  `rol` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tipo_usuarios`
--

INSERT INTO `tipo_usuarios` (`tipo_usuario`, `rol`) VALUES
(1, 'ADMINISTRADOR'),
(2, 'VETERINARIO'),
(3, 'PROPIETARIO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` varchar(15) NOT NULL,
  `nombres` varchar(30) NOT NULL,
  `apellidos` varchar(30) NOT NULL,
  `direccion` varchar(30) NOT NULL,
  `telefono` varchar(15) NOT NULL,
  `correo` varchar(15) DEFAULT NULL,
  `tarj_prof` varchar(15) DEFAULT NULL,
  `tipo_usuario` int(11) NOT NULL,
  `id_est` int(11) NOT NULL,
  `password` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `nombres`, `apellidos`, `direccion`, `telefono`, `correo`, `tarj_prof`, `tipo_usuario`, `id_est`, `password`) VALUES
('111111', 'Juan', 'PEREZ', 'CARRERA', '01800012345', 'prueba@gmail.co', '89898989', 1, 1, '123');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `visita`
--

CREATE TABLE `visita` (
  `id_vis` int(11) NOT NULL,
  `fecha_visita` datetime NOT NULL,
  `id_usuario` varchar(15) NOT NULL,
  `cod_masc` varchar(10) NOT NULL,
  `id_est` varchar(5) NOT NULL,
  `temperatura` double NOT NULL,
  `fr_resp` varchar(5) NOT NULL,
  `fr_card` varchar(5) NOT NULL,
  `est_animo` varchar(20) NOT NULL,
  `peso` varchar(5) NOT NULL,
  `recomendacion` varchar(255) NOT NULL,
  `costo_visita` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `visita_medicamento`
--

CREATE TABLE `visita_medicamento` (
  `id_detallevisita` int(11) NOT NULL,
  `id_vis` varchar(15) NOT NULL,
  `id_med` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `estados`
--
ALTER TABLE `estados`
  ADD PRIMARY KEY (`id_est`);

--
-- Indices de la tabla `mascotas_clientes`
--
ALTER TABLE `mascotas_clientes`
  ADD PRIMARY KEY (`cod_masc`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `id_masc` (`id_masc`);

--
-- Indices de la tabla `medicamentos`
--
ALTER TABLE `medicamentos`
  ADD PRIMARY KEY (`id_med`);

--
-- Indices de la tabla `tipo_mascotas`
--
ALTER TABLE `tipo_mascotas`
  ADD PRIMARY KEY (`id_masc`);

--
-- Indices de la tabla `tipo_usuarios`
--
ALTER TABLE `tipo_usuarios`
  ADD PRIMARY KEY (`tipo_usuario`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`),
  ADD KEY `id_est` (`id_est`),
  ADD KEY `tipo_usuario` (`tipo_usuario`);

--
-- Indices de la tabla `visita`
--
ALTER TABLE `visita`
  ADD PRIMARY KEY (`id_vis`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `cod_masc` (`cod_masc`),
  ADD KEY `id_est` (`id_est`);

--
-- Indices de la tabla `visita_medicamento`
--
ALTER TABLE `visita_medicamento`
  ADD PRIMARY KEY (`id_detallevisita`),
  ADD KEY `id_vis` (`id_vis`),
  ADD KEY `id_med` (`id_med`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `estados`
--
ALTER TABLE `estados`
  MODIFY `id_est` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `tipo_mascotas`
--
ALTER TABLE `tipo_mascotas`
  MODIFY `id_masc` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `tipo_usuarios`
--
ALTER TABLE `tipo_usuarios`
  MODIFY `tipo_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `visita_medicamento`
--
ALTER TABLE `visita_medicamento`
  MODIFY `id_detallevisita` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `mascotas_clientes`
--
ALTER TABLE `mascotas_clientes`
  ADD CONSTRAINT `mascotas_clientes_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `mascotas_clientes_ibfk_2` FOREIGN KEY (`id_masc`) REFERENCES `tipo_mascotas` (`id_masc`);

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`tipo_usuario`) REFERENCES `tipo_usuarios` (`tipo_usuario`),
  ADD CONSTRAINT `usuarios_ibfk_2` FOREIGN KEY (`id_est`) REFERENCES `estados` (`id_est`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
