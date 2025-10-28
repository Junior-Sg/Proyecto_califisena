-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 27-10-2025 a las 05:00:14
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
-- Base de datos: `evaluacion_proyecto_sena`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asignaciones`
--

CREATE TABLE `asignaciones` (
  `id_asignacion` int(11) NOT NULL,
  `id_evaluador` int(11) NOT NULL,
  `id_proyecto` int(11) NOT NULL,
  `fecha_asignacion` date DEFAULT curdate()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `asignaciones`
--

INSERT INTO `asignaciones` (`id_asignacion`, `id_evaluador`, `id_proyecto`, `fecha_asignacion`) VALUES
(1, 1, 1, '2025-10-23'),
(2, 2, 2, '2025-10-23'),
(3, 1, 3, '2025-10-26'),
(4, 1, 4, '2025-10-26'),
(5, 1, 5, '2025-10-26'),
(6, 1, 6, '2025-10-26'),
(7, 1, 7, '2025-10-26'),
(8, 1, 8, '2025-10-26'),
(9, 1, 9, '2025-10-26'),
(10, 1, 10, '2025-10-26'),
(11, 1, 11, '2025-10-26'),
(12, 1, 12, '2025-10-26');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `calificaciones`
--

CREATE TABLE `calificaciones` (
  `id_calificacion` int(11) NOT NULL,
  `id_asignacion` int(11) NOT NULL,
  `dominio_tematico` decimal(4,2) DEFAULT NULL CHECK (`dominio_tematico` between 0 and 10),
  `formato_poster` decimal(4,2) DEFAULT NULL CHECK (`formato_poster` between 0 and 10),
  `creatividad_diseno` decimal(4,2) DEFAULT NULL CHECK (`creatividad_diseno` between 0 and 5),
  `introduccion` decimal(4,2) DEFAULT NULL CHECK (`introduccion` between 0 and 10),
  `planteamiento_problema` decimal(4,2) DEFAULT NULL CHECK (`planteamiento_problema` between 0 and 15),
  `objetivos` decimal(4,2) DEFAULT NULL CHECK (`objetivos` between 0 and 10),
  `total` decimal(5,2) GENERATED ALWAYS AS (`dominio_tematico` + `formato_poster` + `creatividad_diseno` + `introduccion` + `planteamiento_problema` + `objetivos`) STORED,
  `fecha_calificacion` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `calificaciones`
--

INSERT INTO `calificaciones` (`id_calificacion`, `id_asignacion`, `dominio_tematico`, `formato_poster`, `creatividad_diseno`, `introduccion`, `planteamiento_problema`, `objetivos`, `fecha_calificacion`) VALUES
(2, 2, 8.00, 8.50, 4.00, 9.00, 13.00, 8.50, '2025-10-23 23:34:11'),
(3, 1, 1.00, 1.00, 2.00, 1.00, 2.00, 1.00, '2025-10-24 01:40:01'),
(4, 7, 5.00, 5.00, 5.00, 5.00, 5.00, 5.00, '2025-10-27 03:55:28');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `evaluadores`
--

CREATE TABLE `evaluadores` (
  `id_evaluador` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `contrasena_hash` varchar(255) NOT NULL,
  `correo` varchar(100) DEFAULT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `cargo` varchar(100) DEFAULT NULL,
  `fecha_registro` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `evaluadores`
--

INSERT INTO `evaluadores` (`id_evaluador`, `nombre`, `usuario`, `contrasena_hash`, `correo`, `telefono`, `cargo`, `fecha_registro`) VALUES
(1, 'Carlos Pérez', 'cperez', '12345', 'cperez@sena.edu.co', NULL, 'Instructor', '2025-10-23 23:34:11'),
(2, 'María Gómez', 'mgomez', '36bbe50ed96841d10443bcb670d6554f0a34b761be67ec9c4a8ad2c0c44ca42c', 'mgomez@sena.edu.co', NULL, 'Evaluadora Técnica', '2025-10-23 23:34:11');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proyectos`
--

CREATE TABLE `proyectos` (
  `id_proyecto` int(11) NOT NULL,
  `nombre_proyecto` varchar(150) NOT NULL,
  `regional` varchar(100) NOT NULL,
  `centro_formacion` varchar(150) NOT NULL,
  `estado` enum('En curso','Finalizado') DEFAULT 'En curso',
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `proyectos`
--

INSERT INTO `proyectos` (`id_proyecto`, `nombre_proyecto`, `regional`, `centro_formacion`, `estado`, `fecha_creacion`) VALUES
(1, 'Sistema de Energía Solar', 'Antioquia', 'Centro de Energías Renovables', 'En curso', '2025-10-23 23:34:11'),
(2, 'Aplicación de Reciclaje Inteligente', 'Valle del Cauca', 'Centro de Servicios Tecnológicos', 'Finalizado', '2025-10-23 23:34:11'),
(3, 'Invernadero Automatizado con IoT', 'Cundinamarca', 'Centro de Biotecnología Agropecuaria', 'En curso', '2025-10-27 03:50:36'),
(4, 'Plataforma Web de Gestión Ambiental', 'Santander', 'Centro Industrial del Diseño y la Manufactura', 'En curso', '2025-10-27 03:50:36'),
(5, 'Sistema de Control de Riego por Sensores', 'Tolima', 'Centro Agropecuario La Granja', 'Finalizado', '2025-10-27 03:50:36'),
(6, 'Robot Educativo con Impresión 3D', 'Atlántico', 'Centro Nacional Colombo Alemán', 'En curso', '2025-10-27 03:50:36'),
(7, 'Aplicativo de Turismo Sostenible', 'Huila', 'Centro de la Industria, la Empresa y los Servicios', 'En curso', '2025-10-27 03:50:36'),
(8, 'Sistema de Seguridad con Reconocimiento Facial', 'Meta', 'Centro de Industria y Energía', 'Finalizado', '2025-10-27 03:50:36'),
(9, 'App de Monitoreo de Cultivos en Tiempo Real', 'Caldas', 'Centro para la Formación Cafetera', 'En curso', '2025-10-27 03:50:36'),
(10, 'Estación Meteorológica Inteligente', 'Nariño', 'Centro Internacional de Producción Limpia – Lope', 'Finalizado', '2025-10-27 03:50:36'),
(11, 'Gestor de Residuos Electrónicos con IA', 'Córdoba', 'Centro de Comercio, Industria y Turismo', 'En curso', '2025-10-27 03:50:36'),
(12, 'Plataforma Virtual de Aprendizaje Sostenible', 'Boyacá', 'Centro Minero', 'Finalizado', '2025-10-27 03:50:36');

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `vista_exportacion_excel`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `vista_exportacion_excel` (
`Proyecto` varchar(150)
,`Evaluador` varchar(100)
,`dominio_tematico` decimal(4,2)
,`formato_poster` decimal(4,2)
,`creatividad_diseno` decimal(4,2)
,`introduccion` decimal(4,2)
,`planteamiento_problema` decimal(4,2)
,`objetivos` decimal(4,2)
,`Total Final` decimal(5,2)
,`regional` varchar(100)
,`centro_formacion` varchar(150)
,`estado` enum('En curso','Finalizado')
);

-- --------------------------------------------------------

--
-- Estructura para la vista `vista_exportacion_excel`
--
DROP TABLE IF EXISTS `vista_exportacion_excel`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vista_exportacion_excel`  AS SELECT `p`.`nombre_proyecto` AS `Proyecto`, `e`.`nombre` AS `Evaluador`, `c`.`dominio_tematico` AS `dominio_tematico`, `c`.`formato_poster` AS `formato_poster`, `c`.`creatividad_diseno` AS `creatividad_diseno`, `c`.`introduccion` AS `introduccion`, `c`.`planteamiento_problema` AS `planteamiento_problema`, `c`.`objetivos` AS `objetivos`, `c`.`total` AS `Total Final`, `p`.`regional` AS `regional`, `p`.`centro_formacion` AS `centro_formacion`, `p`.`estado` AS `estado` FROM (((`calificaciones` `c` join `asignaciones` `a` on(`c`.`id_asignacion` = `a`.`id_asignacion`)) join `evaluadores` `e` on(`a`.`id_evaluador` = `e`.`id_evaluador`)) join `proyectos` `p` on(`a`.`id_proyecto` = `p`.`id_proyecto`)) ;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `asignaciones`
--
ALTER TABLE `asignaciones`
  ADD PRIMARY KEY (`id_asignacion`),
  ADD UNIQUE KEY `id_evaluador` (`id_evaluador`,`id_proyecto`),
  ADD KEY `id_proyecto` (`id_proyecto`);

--
-- Indices de la tabla `calificaciones`
--
ALTER TABLE `calificaciones`
  ADD PRIMARY KEY (`id_calificacion`),
  ADD KEY `id_asignacion` (`id_asignacion`);

--
-- Indices de la tabla `evaluadores`
--
ALTER TABLE `evaluadores`
  ADD PRIMARY KEY (`id_evaluador`),
  ADD UNIQUE KEY `usuario` (`usuario`);

--
-- Indices de la tabla `proyectos`
--
ALTER TABLE `proyectos`
  ADD PRIMARY KEY (`id_proyecto`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `asignaciones`
--
ALTER TABLE `asignaciones`
  MODIFY `id_asignacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `calificaciones`
--
ALTER TABLE `calificaciones`
  MODIFY `id_calificacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `evaluadores`
--
ALTER TABLE `evaluadores`
  MODIFY `id_evaluador` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `proyectos`
--
ALTER TABLE `proyectos`
  MODIFY `id_proyecto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `asignaciones`
--
ALTER TABLE `asignaciones`
  ADD CONSTRAINT `asignaciones_ibfk_1` FOREIGN KEY (`id_evaluador`) REFERENCES `evaluadores` (`id_evaluador`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `asignaciones_ibfk_2` FOREIGN KEY (`id_proyecto`) REFERENCES `proyectos` (`id_proyecto`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `calificaciones`
--
ALTER TABLE `calificaciones`
  ADD CONSTRAINT `calificaciones_ibfk_1` FOREIGN KEY (`id_asignacion`) REFERENCES `asignaciones` (`id_asignacion`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
