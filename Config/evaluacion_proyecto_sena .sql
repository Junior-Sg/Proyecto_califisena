-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 06-11-2025 a las 18:28:31
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
  `fecha_asignacion` date DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `asignaciones`
--

INSERT INTO `asignaciones` (`id_asignacion`, `id_evaluador`, `id_proyecto`, `fecha_asignacion`) VALUES
(1, 1, 46, '2025-10-30'),
(2, 1, 51, '2025-10-30'),
(3, 2, 62, '2025-10-30'),
(4, 3, 45, '2025-10-30'),
(5, 4, 47, '2025-10-30'),
(6, 4, 77, '2025-10-30'),
(7, 5, 52, '2025-10-30'),
(8, 5, 50, '2025-10-30'),
(9, 6, 56, '2025-10-30'),
(10, 6, 53, '2025-10-30'),
(11, 7, 55, '2025-10-30'),
(12, 7, 78, '2025-10-30'),
(13, 8, 63, '2025-10-30'),
(14, 8, 57, '2025-10-30'),
(15, 8, 79, '2025-10-30'),
(16, 9, 59, '2025-10-30'),
(17, 9, 76, '2025-10-30'),
(18, 9, 54, '2025-10-30'),
(19, 10, 61, '2025-10-30'),
(20, 10, 60, '2025-10-30'),
(21, 11, 48, '2025-10-30'),
(22, 11, 1, '2025-10-30'),
(23, 11, 75, '2025-10-30'),
(24, 12, 65, '2025-10-30'),
(25, 12, 43, '2025-10-30'),
(26, 12, 74, '2025-10-30'),
(27, 12, 80, '2025-10-30'),
(28, 13, 67, '2025-10-30'),
(29, 13, 61, '2025-10-30'),
(30, 14, 69, '2025-10-30'),
(31, 14, 54, '2025-10-30'),
(32, 14, 81, '2025-10-30'),
(33, 15, 71, '2025-10-30'),
(34, 15, 72, '2025-10-30'),
(35, 16, 73, '2025-10-30'),
(36, 16, 21, '2025-10-30'),
(37, 17, 74, '2025-10-30'),
(38, 17, 64, '2025-10-30'),
(39, 18, 75, '2025-10-30'),
(40, 18, 82, '2025-10-30'),
(41, 18, 60, '2025-10-30'),
(42, 19, 76, '2025-10-30'),
(43, 19, 83, '2025-10-30'),
(44, 20, 77, '2025-10-30'),
(45, 20, 70, '2025-10-30'),
(46, 20, 71, '2025-10-30'),
(47, 21, 49, '2025-10-30'),
(48, 21, 78, '2025-10-30'),
(49, 22, 79, '2025-10-30'),
(50, 22, 56, '2025-10-30'),
(51, 22, 57, '2025-10-30'),
(52, 23, 80, '2025-10-30'),
(53, 23, 69, '2025-10-30'),
(54, 24, 81, '2025-10-30'),
(55, 24, 59, '2025-10-30'),
(56, 24, 2, '2025-10-30'),
(57, 25, 72, '2025-10-30'),
(58, 25, 82, '2025-10-30'),
(59, 26, 83, '2025-10-30'),
(60, 26, 58, '2025-10-30'),
(61, 26, 70, '2025-10-30'),
(62, 27, 84, '2025-10-30'),
(63, 27, 55, '2025-10-30'),
(64, 28, 58, '2025-10-30'),
(65, 28, 44, '2025-10-30'),
(66, 28, 63, '2025-10-30'),
(67, 29, 16, '2025-10-30'),
(68, 29, 20, '2025-10-30'),
(69, 30, 19, '2025-10-30'),
(70, 30, 68, '2025-10-30'),
(71, 31, 36, '2025-10-30'),
(72, 31, 44, '2025-10-30'),
(73, 32, 11, '2025-10-30'),
(74, 32, 20, '2025-10-30'),
(75, 33, 17, '2025-10-30'),
(76, 33, 64, '2025-10-30'),
(77, 33, 15, '2025-10-30'),
(78, 34, 6, '2025-10-30'),
(79, 34, 10, '2025-10-30'),
(80, 35, 35, '2025-10-30'),
(81, 35, 7, '2025-10-30'),
(82, 36, 8, '2025-10-30'),
(83, 37, 37, '2025-10-30'),
(84, 38, 18, '2025-10-30'),
(85, 38, 19, '2025-10-30'),
(86, 39, 38, '2025-10-30'),
(87, 39, 3, '2025-10-30'),
(88, 40, 41, '2025-10-30'),
(89, 40, 84, '2025-10-30'),
(90, 40, 12, '2025-10-30'),
(91, 41, 42, '2025-10-30'),
(92, 41, 38, '2025-10-30'),
(93, 42, 30, '2025-10-30'),
(94, 42, 34, '2025-10-30'),
(95, 42, 45, '2025-10-30'),
(96, 42, 65, '2025-10-30'),
(97, 43, 9, '2025-10-30'),
(98, 43, 21, '2025-10-30'),
(99, 44, 36, '2025-10-30'),
(100, 44, 4, '2025-10-30'),
(101, 45, 27, '2025-10-30'),
(102, 45, 33, '2025-10-30'),
(103, 45, 31, '2025-10-30'),
(104, 46, 31, '2025-10-30'),
(105, 46, 18, '2025-10-30'),
(106, 47, 34, '2025-10-30'),
(107, 47, 17, '2025-10-30'),
(108, 48, 22, '2025-10-30'),
(109, 48, 30, '2025-10-30'),
(110, 49, 33, '2025-10-30'),
(111, 49, 53, '2025-10-30'),
(112, 50, 22, '2025-10-30'),
(113, 50, 66, '2025-10-30'),
(114, 50, 50, '2025-10-30'),
(115, 51, 29, '2025-10-30'),
(116, 52, 37, '2025-10-30'),
(117, 52, 26, '2025-10-30'),
(118, 53, 32, '2025-10-30'),
(119, 53, 68, '2025-10-30'),
(120, 53, 13, '2025-10-30'),
(121, 54, 13, '2025-10-30'),
(122, 54, 28, '2025-10-30'),
(123, 55, 16, '2025-10-30'),
(124, 55, 25, '2025-10-30'),
(125, 56, 9, '2025-10-30'),
(126, 56, 66, '2025-10-30'),
(127, 57, 49, '2025-10-30'),
(128, 57, 39, '2025-10-30'),
(129, 59, 43, '2025-10-30'),
(130, 59, 47, '2025-10-30'),
(131, 60, 48, '2025-10-30'),
(132, 60, 29, '2025-10-30'),
(133, 62, 41, '2025-10-30'),
(134, 62, 35, '2025-10-30'),
(135, 63, 39, '2025-10-30'),
(136, 63, 32, '2025-10-30'),
(137, 64, 15, '2025-10-30'),
(138, 64, 26, '2025-10-30'),
(139, 65, 49, '2025-10-30'),
(140, 65, 8, '2025-10-30'),
(141, 66, 5, '2025-10-30'),
(142, 66, 40, '2025-10-30'),
(143, 67, 4, '2025-10-30'),
(144, 67, 40, '2025-10-30'),
(145, 68, 3, '2025-10-30'),
(146, 68, 25, '2025-10-30'),
(147, 69, 7, '2025-10-30'),
(148, 69, 6, '2025-10-30'),
(149, 73, 14, '2025-10-30'),
(150, 70, 12, '2025-10-30'),
(151, 71, 52, '2025-10-30'),
(152, 71, 2, '2025-10-30'),
(153, 72, 5, '2025-10-30'),
(154, 74, 28, '2025-10-30'),
(155, 74, 27, '2025-10-30'),
(156, 75, 51, '2025-10-30'),
(157, 75, 46, '2025-10-30'),
(158, 75, 10, '2025-10-30'),
(159, 61, 62, '2025-11-05'),
(160, 78, 1, '2025-11-05'),
(161, 51, 67, '2025-11-05'),
(162, 15, 73, '2025-11-05'),
(163, 78, 11, '2025-11-05'),
(164, 61, 42, '2025-11-05'),
(165, 70, 14, '2025-11-05');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `calificaciones`
--

CREATE TABLE `calificaciones` (
  `id_calificacion` int(11) NOT NULL,
  `id_asignacion` int(11) NOT NULL,
  `dominio_tematico` tinyint(4) NOT NULL,
  `creatividad_diseno` tinyint(4) NOT NULL,
  `planteamiento_problema` tinyint(4) NOT NULL,
  `pertinencia_impacto` tinyint(4) NOT NULL,
  `objetivos` tinyint(4) NOT NULL,
  `metodologia` tinyint(4) NOT NULL,
  `resultados` tinyint(4) NOT NULL,
  `bibliografia` tinyint(4) NOT NULL,
  `estado` varchar(80) DEFAULT NULL,
  `fecha_calificacion` datetime DEFAULT current_timestamp(),
  `total` int(11) DEFAULT NULL
) ;

--
-- Volcado de datos para la tabla `calificaciones`
--

INSERT INTO `calificaciones` (`id_calificacion`, `id_asignacion`, `dominio_tematico`, `creatividad_diseno`, `planteamiento_problema`, `pertinencia_impacto`, `objetivos`, `metodologia`, `resultados`, `bibliografia`, `estado`, `fecha_calificacion`, `total`) VALUES
(1, 1, 10, 15, 15, 10, 10, 15, 20, 10, 'En curso', '2025-11-06 10:28:04', 105),
(2, 157, 5, 5, 5, 5, 5, 5, 5, 5, 'En curso', '2025-11-06 10:30:55', 40);

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
(1, 'Sandra Celia Tapia Coral', 'stapia', 'StapíaCoral18', 'stapia@sena.edu.co', '3116884801', NULL, '2025-10-29 21:34:45'),
(2, 'Jose Martin Bermudez Monsalve', 'jmbermudez', 'JbermudezMonsalve37', 'jmbermudez@sena.edu.co', NULL, 'Contratista', '2025-10-29 21:34:45'),
(3, 'Marisol Osorio Beltran', 'marosorio', 'MosorioBeltran63', 'marosorio@sena.edu.do', NULL, 'Contratista', '2025-10-29 21:34:45'),
(4, 'Luz Llined Mendoza Victoria', 'lmendozav', 'LmendozaVictoria81', 'lmendozav@sena.edu.co', '3194788103', NULL, '2025-10-29 21:34:45'),
(5, 'Jennifer Andrea Londoño Gallego', 'jealondonog', 'JlondonoGallego74', 'jealondonog@sena.edu.co', '3146484274', NULL, '2025-10-29 21:34:45'),
(6, 'Jose Vicente Delgado Gomez', 'jdelgadog', 'JdelgadoGomez22', 'jdelgadog@sena.edu.co', '3042422707', NULL, '2025-10-29 21:34:45'),
(7, 'Henry Alonso Bermudez Saldarriaga', 'habermudez', 'HbermudezSaldarriaga91', 'habermudez@sena.edu.co', '3122095517', NULL, '2025-10-29 21:34:45'),
(8, 'Karol Mendoza Martinez', 'kmendozam', 'KmendozaMartinez19', 'kmendozam@sena.edu.co', '3043533779', NULL, '2025-10-29 21:34:45'),
(9, 'Slim Camilo Alvarez Alarcon', 'scalvarez', 'SalvarezAlarcon53', 'scalvarez@sena.edu.co', '3012784186', NULL, '2025-10-29 21:34:45'),
(10, 'Javier Restrepo Rendon', 'jrestrepore', 'JrestrepoRendon44', 'jrestrepore@sena.edu.co', '3144440081', NULL, '2025-10-29 21:34:45'),
(11, 'Luz Marina Pulido Peñaloza', 'lpulidop', 'LpulidoPeñaloza67', 'lpulidop@sena.edu.co', '3005033339', NULL, '2025-10-29 21:34:45'),
(12, 'Dannys Patricia Mendoza Valencia', 'dpmendozav', 'DmendozaValencia30', 'dpmendozav@sena.edu.co', '3005485695', NULL, '2025-10-29 21:34:45'),
(13, 'José Arcenio Moreno Martinez', 'jammartinez', 'JmorenoMartinez25', 'jammartinez@sena.edu.co', '3113308388', NULL, '2025-10-29 21:34:45'),
(14, 'Antonio Bustillo Simanca', 'abustillos', 'AbustilloSimanca84', 'abustillos@sena.edu.co', NULL, 'Planta', '2025-10-29 21:34:45'),
(15, 'Claudia Esperanza Vega Panqueva', 'cvega', 'CvegaPanqueva31', 'cvega@sena.edu.co', '3103902641', NULL, '2025-10-29 21:34:45'),
(16, 'Erika Lorena Giraldo Vargas', 'elgiraldo', 'EgiraldoVargas70', 'elgiraldo@sena.edu.co', '3125416446', NULL, '2025-10-29 21:34:45'),
(17, 'Andrés Felipe Aguirre Buitrago', 'afaguirreb', 'AaguirreBuitrago39', 'afaguirreb@sena.edu.co', '3207077536', NULL, '2025-10-29 21:34:45'),
(18, 'Miguel Antonio Coy Gonzalez', 'macoyg', 'McoyGonzalez42', 'macoyg@sena.edu.co', '3125503846', NULL, '2025-10-29 21:34:45'),
(19, 'Sebastian Saldarriaga Muñoz', 'ssaldarriaga', 'SsaldarriagaMuñoz36', 'ssaldarriaga@sena.edu.co', '3187148644', NULL, '2025-10-29 21:34:45'),
(20, 'Andres Fernando Maya Santacruz', 'afmaya', 'AmayaSantacruz52', 'afmaya@sena.edu.co', '3006117739', NULL, '2025-10-29 21:34:45'),
(21, 'Daniel Eduardo Bolaños Bonilla', 'debolanosb', 'DbolanosBonilla60', 'debolanosb@sena.edu.co', '3217811163', NULL, '2025-10-29 21:34:45'),
(22, 'Ciro Alexander Montañez Rubiano', 'cmontanezr', 'CmontanezRubiano24', 'cmontanezr@sena.edu.co', '3118506927', NULL, '2025-10-29 21:34:45'),
(23, 'Karina Del Carmen Guzman Martinez', 'kguzmanm', 'KguzmanMartinez28', 'kguzmanm@sena.edu.co', '3103522332', NULL, '2025-10-29 21:34:45'),
(24, 'Ana Rosa Romero Gutierrez', 'arromerog', 'AromeroGutierrez75', 'arromerog@sena.edu.co', '3005196781', NULL, '2025-10-29 21:34:45'),
(25, 'Sandra Ximena Toro Melendez', 'storom', 'StoroMelendez85', 'storom@sena.edu.co', '3163893212', NULL, '2025-10-29 21:34:45'),
(26, 'Flor Alba Albarracin Caro', 'falbarracinc', 'FalbarracinCaro33', 'falbarracinc@sena.edu.co', '3045302453', NULL, '2025-10-29 21:34:45'),
(27, 'Claudia Patricia Tellez Villamizar', 'cptellesv', 'CtellezVillamizar26', 'cptellesv@sena.edu.co', '3106267738', NULL, '2025-10-29 21:34:45'),
(28, 'Alex Jairsino Perea Olave', 'ajperea', 'ApereaOlave41', 'ajperea@sena.edu.co', '3193580645', NULL, '2025-10-29 21:34:45'),
(29, 'Wilson Cardenas Gonzalez', 'wcardenas', 'WcardenasGonzalez46', 'wcardenas@sena.edu.co', '3177168328', NULL, '2025-10-29 21:34:45'),
(30, 'Carlos Enrique Parra Rodriguez', 'cparra', 'CparraRodriguez58', 'cparra@sena.edu.co', '3172739885', NULL, '2025-10-29 21:34:45'),
(31, 'Adalberto Lopez Gomez', 'adlopezg', 'AlopezGomez91', 'adlopezg@sena.edu.co', '3108398938', NULL, '2025-10-29 21:34:45'),
(32, 'Edwin Ricardo Garrido Weber', 'egarrido', 'EgarridoWeber29', 'egarrido@sena.edu.co', NULL, 'Contratista', '2025-10-29 21:34:45'),
(33, 'Diego Garcia Jimenez', 'dgarciaj', 'DgarciaJimenez73', 'dgarciaj@sena.edu.co', '3165208912', NULL, '2025-10-29 21:34:45'),
(34, 'Yoly Dayana Moreno Ortega', 'ydmorneo', 'YmorneoOrtega22', 'ydmorneo@sena.edu.co', '3173320041', NULL, '2025-10-29 21:34:45'),
(35, 'Daniel Rodriguez Acosta', 'darodrigueza', 'DrodriguezAcosta39', 'darodrigueza@sena.edu.co', '3162206421', NULL, '2025-10-29 21:34:45'),
(36, 'Colombo Estupiñan Montaño', 'coestupinanm', 'CestupiñanMontaño30', 'coestupinanm@sena.edu.co', '3042164327', NULL, '2025-10-29 21:34:45'),
(37, 'Edgar Fernando Ayala Quitiaquez', 'fayala', 'FayalaQuitiaquez42', 'fayala@sena.edu.co', '3176389255', NULL, '2025-10-29 21:34:45'),
(38, 'Ana Delfina Tovar Quiroz', 'adtovar', 'AtovarQuiroz53', 'adtovar@sena.edu.co', '3015183134', NULL, '2025-10-29 21:34:45'),
(39, 'Luis Antonio Contreras Ramon', 'lacontrer', 'LcontrerasRamon33', 'lacontrer@sena.edu.co', NULL, 'Planta', '2025-10-29 21:34:45'),
(40, 'Adrian Rolando Riascos Vallejos', 'ariascos', 'AriascosVallejos16', 'ariascos@sena.edu.co', '3223715554', NULL, '2025-10-29 21:34:45'),
(41, 'Diana Lucía Ruiz Moreno', 'dlruiz', 'DruizMoreno43', 'dlruiz@sena.edu.co', '3147149254', NULL, '2025-10-29 21:34:45'),
(42, 'Juan Alejandro Correa Gonzalez', 'jacorrea', 'JcorreaGonzalez28', 'jacorrea@sena.edu.co', NULL, 'Contratista', '2025-10-29 21:34:45'),
(43, 'Andrés Felipe Diaz Arias', 'afdiaza', 'AdiazArias10', 'afdiaza@sena.edu.co', '3207439602', NULL, '2025-10-29 21:34:45'),
(44, 'Maria Yaqueline Palacio Florez', 'mypalacio', 'MpalacioFlorez24', 'mypalacio@sena.edu.co', '3186734150', NULL, '2025-10-29 21:34:45'),
(45, 'Jorge Alexander Gómez Gómez', 'jorgeagomez', 'JgomezGomez83', 'jorgeagomez@sena.edu.co', '3007587839', NULL, '2025-10-29 21:34:45'),
(46, 'Wilfren Alberto Ortega Jaime', 'wortega', 'WortegaJaime46', 'wortega@sena.edu.co', NULL, 'Planta', '2025-10-29 21:34:45'),
(47, 'Ruben Carvajal Caballero', 'rcarvajalc', 'RcarvajalCaballero72', 'rcarvajalc@sena.edu.co', '3112317846', NULL, '2025-10-29 21:34:45'),
(48, 'Carlos Alberto Cerverza Gonzalez', 'ccervera', 'CcerveraGonzalez32', 'ccervera@sena.edu.co', '3216482725', NULL, '2025-10-29 21:34:45'),
(49, 'Julian Alonso Garzon Quiroga', 'jagarzonq', 'JgarzonQuiroga40', 'jagarzonq@sena.edu.co', '3175756725', NULL, '2025-10-29 21:34:45'),
(50, 'Haidee Támara Gonzalez Lozano', 'hgonzalezl', 'HgonzalezLozano19', 'hgonzalezl@sena.edu.co', NULL, 'Planta', '2025-10-29 21:34:45'),
(51, 'Martha Cecilia Diaz Hernandez', 'mdiazh', 'MdiazHernández59', 'mdiazh@sena.edu.co', NULL, 'Contratista', '2025-10-29 21:34:45'),
(52, 'Karen Leidy Johanna Borrero Duque', 'kborrero', 'KborreroDuque95', 'kborrero@sena.edu.co', '3185501052', NULL, '2025-10-29 21:34:45'),
(53, 'Mario Fernando Moncayo Palacios', 'mmoncayop', 'MmoncayoPalacios67', 'mmoncayop@sena.edu.co', '3147803043', NULL, '2025-10-29 21:34:45'),
(54, 'Luz Karen Leal Barbosa', 'lleal', 'LlealBarbosa26', 'lleal@sena.edu.co', '3162888491', NULL, '2025-10-29 21:34:45'),
(55, 'Aline Isabel Melo Henriquez', 'aimelo', 'AimeloHenriquez47', 'aimelo@sena.edu.co', '3162290249', NULL, '2025-10-29 21:34:45'),
(56, 'Andrés Felipe Orozco Valencia', 'aforozco', 'AorozcoValencia21', 'aforozco@sena.edu.co', '3223445172', NULL, '2025-10-29 21:34:45'),
(57, 'Esneider Arciniegas Arenas', 'earciniegasa', 'EarciniegasArenas63', 'earciniegasa@sena.edu.co', '3123813735', NULL, '2025-10-29 21:34:45'),
(58, 'Rafael Martinez Gonzalez', 'rmgonzaleza', 'RmartinezGonzalez50', 'rmgonzaleza@sena.edu.co', '3107396650', NULL, '2025-10-29 21:34:45'),
(59, 'Edilson Alejandro Lesmes Fabian', 'elesmesf', 'ElesmesFabian89', 'elesmesf@sena.edu.co', '3163710643', NULL, '2025-10-29 21:34:45'),
(60, 'Daissy Rocio Hernandez Mena', 'drhernandezm', 'DhernandezMena38', 'drhernandezm@sena.edu.co', '3114434124', NULL, '2025-10-29 21:34:45'),
(61, 'Yuseth Yair Florez Taborda', 'yflorezt', 'YflorezTaborda77', 'yflorezt@sena.edu.co', '3219710887', NULL, '2025-10-29 21:34:45'),
(62, 'Jorge Eliecer Orozco Patiño', 'jeorozcop', 'JorozcoPatiño74', 'jeorozcop@sena.edu.co', '3197682597', NULL, '2025-10-29 21:34:45'),
(63, 'Daniel Andres Calderon Buelvas', 'dacalderona', 'DcalderonBuelvas48', 'dacalderona@sena.edu.co', '3118127533', NULL, '2025-10-29 21:34:45'),
(64, 'Fredy Alexander Garcia Pulido', 'fagarciap', 'FgarciaPulido53', 'fagarciap@sena.edu.co', '3116092944', NULL, '2025-10-29 21:34:45'),
(65, 'Juan Carlos Sanchez Muriel', 'jcsanchezm', 'JsanchezMuriel68', 'jcsanchezm@sena.edu.co', '3152622914', NULL, '2025-10-29 21:34:45'),
(66, 'Katerine Del Carmen Sarmiento Algarin', 'ksarmiento', 'KsarmientoAlgarin23', 'ksarmiento@sena.edu.co', '3008628265', NULL, '2025-10-29 21:34:45'),
(67, 'Laura Daniela Beltran Aguirre', 'ldbeltran', 'LbeltranAguirre86', 'ldbeltran@sena.edu.co', '3218467097', NULL, '2025-10-29 21:34:45'),
(68, 'Nataly Cáceres Ramirez', 'ncaceres', 'NcaceresRamirez15', 'ncaceres@sena.edu.co', '3103885156', NULL, '2025-10-29 21:34:45'),
(69, 'Hernan Felipe Calderon Garcia', 'hfcalderon', 'HcalderonGarcia11', 'hfcalderon@sena.edu.co', '3203431377', NULL, '2025-10-29 21:34:45'),
(70, 'Yoly Paulina Gonzalez', 'ygonzalez', 'YgonzalezGonzalez58', 'ygonzalez@sena.edu.co', '3178846347', NULL, '2025-10-29 21:34:45'),
(71, 'Erik Darlyn Ayala Garcia', 'eayalag', 'EayalaGarcia69', 'eayalag@sena.edu.co', '3143165448', NULL, '2025-10-29 21:34:45'),
(72, 'Rita Isabel Leon Marquez', 'rileon', 'RleonMarquez61', 'rileon@sena.edu.co', '3138934710', NULL, '2025-10-29 21:34:45'),
(73, 'Pedro Antonio Celis Parra', 'pcelisp', 'PcelisParra45', 'pcelisp@sena.edu.co', '3204581120', NULL, '2025-10-29 21:34:45'),
(74, 'Anuar Ferney Caldón Quira', 'afcaldon', 'AcaldonQuira44', 'afcaldon@sena.edu.co', '3128477848', NULL, '2025-10-29 21:34:45'),
(75, 'ELIANA MARCELA TUNAROSA', 'elirosa', 'eliriosa314', NULL, NULL, NULL, '2025-10-30 20:10:26'),
(76, 'SENAADMIN', 'Senaadmin', 'Senaadmin', 'sena@gmail.com', '3107928579', 'admin', '2025-11-03 00:55:57'),
(78, 'John Alejandro Vargas Alfonso ', 'Jonh A', 'Jonh A', NULL, NULL, NULL, '2025-11-05 20:11:30');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proyectos`
--

CREATE TABLE `proyectos` (
  `id_proyecto` int(11) NOT NULL,
  `nombre_proyecto` varchar(500) NOT NULL,
  `tipo_participacion` varchar(100) DEFAULT NULL,
  `regional` varchar(100) NOT NULL,
  `centro_formacion` varchar(150) NOT NULL,
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `proyectos`
--

INSERT INTO `proyectos` (`id_proyecto`, `nombre_proyecto`, `tipo_participacion`, `regional`, `centro_formacion`, `fecha_creacion`) VALUES
(1, 'Fortalecimiento de la seguridad alimentaria sostenible a través del cultivo de plantas alimenticias en el vivero del Sena Regional Amazonas', 'Stand', 'Amazonas', '9517 - Centro para la Biodiversidad y el Turismo del Amazonas', '2025-10-30 19:11:13'),
(2, 'Innovación de técnicas para la cría sostenible de abejas nativas a partir de conocimientos locales, Leticia, Amazonas', 'Cartel o Poster', 'Amazonas', '9517 - Centro para la Biodiversidad y el Turismo del Amazonas', '2025-10-30 19:11:13'),
(3, 'TIEMPOS PREDETERMINADOS EN MIPYMES DE CONFECCION', 'Stand', 'Antioquia', '9202 - Centro de Formación en Diseño, Confección y Moda', '2025-10-30 19:11:13'),
(4, 'Moda Popular: Circularidad en la moda', NULL, 'Antioquia', '9202 - Centro de Formación en Diseño, Confección y Moda', '2025-10-30 19:11:13'),
(5, 'Estrategia de respuesta a emergencias cardiorrespiratorias en una zona rural del municipio de Guarne, Antioquia', 'Cartel o Poster', 'Antioquia', '9401 - Centro de Servicios de Salud', '2025-10-30 19:11:13'),
(6, 'Transformación digital en sectores de la economía popular de la plaza minorista José María Villa', 'Cartel o Poster', 'Antioquia', '9402 - Centro de Servicios y Gestión Empresarial', '2025-10-30 19:11:13'),
(7, 'EPOCA.COM', 'Cartel o Poster', 'Antioquia', '9402 - Centro de Servicios y Gestión Empresarial', '2025-10-30 19:11:13'),
(8, 'Cultivando Biodiversidad: Arroz + Peces + Patos', 'Cartel o Poster', 'Antioquia', '9501 - Complejo Tecnológico para la Gestión Agroempresarial', '2025-10-30 19:11:13'),
(9, 'Procesamiento de raciones alimenticias para Bovinos y Equinos', 'Poster y Prototipo', 'Antioquia', '9502 - Complejo Tecnológico Minero Agroempresarial', '2025-10-30 19:11:13'),
(10, 'La Chagra: el valor agregado que recupera el campo', 'Stand', 'Antioquia', '9503 - Centro de la Innovación, la Agroindustria y la Aviación', '2025-10-30 19:11:13'),
(11, 'Influencia de bioestimulantes en el crecimiento fisiología e índice relativo de clorofila en el cultivo de La berenjena (Solanum melongena) después del trasplante en Apartado Antioquia.', 'Cartel o Poster', 'Antioquia', '9504 - Complejo Tecnológico Agroindustrial, Pecuario y Turístico', '2025-10-30 19:11:13'),
(12, 'Arauca Sostenible, aprovechamiento de donaciones de alimentos en el municipio de Arauca para alimentar a población vulnerable, producción para alimentación animal y abono orgánico, como estrategia para contribuir al establecimiento de objetivos del desarrollo sostenible. Desperdicio cero (0) y hambre cero (0).', 'Cartel o Poster', 'Arauca', '9530 - Centro de Gestión y Desarrollo Agroindustrial de Arauca', '2025-10-30 19:11:13'),
(13, 'EVALUACIÓN DE LA PECTINA OBTENIDA MEDIANTE HIDRÓLISIS ÁCIDA PARA EL APROVECHAMIENTO DE RESIDUOS AGROINDUSTRIALES DE MANGO', 'Poster y Prototipo', 'Atlántico', '9103 - Centro para el Desarrollo Agroecologico y Agroindustrial', '2025-10-30 19:11:13'),
(14, 'Estandarización del proceso de elaboración de helado soft a partir de la leche de búfala producida en el departamento del Atlántico', 'Poster y Prototipo', 'Atlántico', '9103 - Centro para el Desarrollo Agroecologico y Agroindustrial', '2025-10-30 19:11:13'),
(15, 'Fortalecimiento comercial en canales digitales de los micronegocios en la economía popular del Área Metropolitana de Barranquilla: Ruta full popular.', 'Cartel o Poster', 'Atlántico', '9302 - Centro de Comercio y Servicios', '2025-10-30 19:11:13'),
(16, 'Modelo estratégico de innovación social para el fortalecimiento de negocios de economía popular en el sector pesquero del Atlántico: ECORIO', 'Cartel o Poster', 'Atlántico', '9302 - Centro de Comercio y Servicios', '2025-10-30 19:11:13'),
(17, 'Inteligencia de mercado para el sector agroindustrial del departamento del Atlántico.', 'Cartel o Poster', 'Atlántico', '9302 - Centro de Comercio y Servicios', '2025-10-30 19:11:13'),
(18, 'Conectando con el consumidor: estrategias de venta y promoción para las unidades de negocios pertenecientes a CAMPESENA, laboratorio de economía popular y Tesoros del Atlántico.', 'Cartel o Poster', 'Atlántico', '9302 - Centro de Comercio y Servicios', '2025-10-30 19:11:13'),
(19, 'DIAGNOSTICO DEL RECIBO DE MERCANCIAS EN LAS TIENDAS DE TURBANA- BOLIVAR.', 'Cartel o Poster', 'Bolívar', '9105 - Centro Internacional Náutico, Fluvial y Portuario', '2025-10-30 19:11:13'),
(20, 'Cadena sostenible del ñame en Montes de María para el impulso de la economía campesina y la conexión con mercados internacionales', 'Cartel o Poster', 'Bolívar', '9304 - Centro de Comercio y Servicios', '2025-10-30 19:11:13'),
(21, 'Aprovechamiento de plantas medicinales del departamento de Bolívar para el desarrollo de parches con actividad antiinflamatoria y antibacteriana como alternativa productiva campesina', 'Cartel o Poster', 'Bolívar', '9304 - Centro de Comercio y Servicios', '2025-10-30 19:11:13'),
(22, 'Evaluación del nivel de infestación de picudos que afectan fitosanitariamente las palmas datileras en Boyacá.', NULL, 'Boyacá', '9110 - Centro de Desarrollo Agropecuario y Agroindustrial', '2025-10-30 19:11:13'),
(23, 'Granja agroecológica y economía circular', 'Ponencia', 'Boyacá', '9551 - Centro de la Innovación Agroindustrial y de Servicios', '2025-10-30 19:11:13'),
(24, 'Revitalización Vivero', 'Ponencia', 'Boyacá', '9551 - Centro de la Innovación Agroindustrial y de Servicios', '2025-10-30 19:11:13'),
(25, 'Elaboración del Plan de Comercialización Internacional de Productos para Pymes en Colombia', 'Ponencia', 'Caldas', '9306 - Centro de Comercio y Servicios', '2025-10-30 19:11:13'),
(26, 'Estrategias Comerciales y Administrativas para los micronegocios de economía popular de la ciudad de Manizales', 'Ponencia', 'Caldas', '9306 - Centro de Comercio y Servicios', '2025-10-30 19:11:13'),
(27, 'Aprovechamiento de la planta Sapindus saponaria para la obtención de jabón natural como producto sostenible en la comunidad de aprendices del CPYA de La Dorada, Caldas', 'Cartel o Poster', 'Caldas', '9515 - Centro Pecuario y Agroempresarial', '2025-10-30 19:11:13'),
(28, 'Evaluación de la calidad fisicoquímica y microbiológica de la leche cruda como base para el fortalecimiento de los sistemas de producción bovina en el norte del departamento del Caquetá', 'Ponencia', 'Caquetá', '9516 - Centro Tecnológico de la Amazonia', '2025-10-30 19:11:13'),
(29, 'Aprovechamiento del Tallo de Cannabis Sativa como uso alternativo para procesos de Bioconstrucción en Toribío, Cauca.', 'Cartel o Poster', 'Cauca', '9113 - Centro Agropecuario', '2025-10-30 19:11:13'),
(30, 'Marketing digital desde el territorio: diseño de contenidos para visibilizar productos y servicios de la economía popular en Timbío', 'Poster y Prototipo', 'Cauca', '9113 - Centro Agropecuario', '2025-10-30 19:11:13'),
(31, 'Prácticas administrativas, contables y financieras en unidades productivas adscritas al C.C. y S. Popayán-cauca: análisis diagnostico desde el año 2021', 'Cartel o Poster', 'Cauca', '9307 - Centro de Comercio y Servicios', '2025-10-30 19:11:13'),
(32, 'Automatización del cultivo de Forraje Verde Hidropónico (FVH) mediante el control de variables de producción', 'Poster y Prototipo', 'Córdoba', '9115 - Centro Agropecuario y de Biotecnología el Porvenir', '2025-10-30 19:11:13'),
(33, 'Modelo Piloto Integrador para fomento del Entrenamiento Autónomo el Emprendimiento y la Innovación en el Sector Confección fortaleciendo la economía Popular en Aprendices de la Red Textil del Centro de Comercio, Industria y Turismo de Córdoba', 'Cartel o Poster', 'Córdoba', '9523 - Centro de Comercio, Industria y Turismo de Córdoba', '2025-10-30 19:11:13'),
(34, 'Agromind 360: Plataforma Inteligente para la Comercialización y Trazabilidad Agroempresarial del Sumapaz', 'Cartel o Poster', 'Cundinamarca', '9510 - Centro Agroecológico y Empresarial', '2025-10-30 19:11:13'),
(35, 'Syropes funcionales, una alternativa en la elaboración de bebidas para consumo humano.', 'Poster y Prototipo', 'Cundinamarca', '9512 - Centro de Biotecnología Agropecuaria', '2025-10-30 19:11:13'),
(36, 'Estudio sobre la viabilidad de exportar moda sostenible para caninos e innovación ambiental hacia Berlin Alemania.', 'Cartel o Poster', 'Cundinamarca', '9513 - Centro de Desarrollo Agroempresarial', '2025-10-30 19:11:13'),
(37, 'Uso de la TIC´s en la Red de Actividad Física Recreación y Deporte Aplicadas a la formación en el Centro de desarrollo agroempresarial de Chía.', 'Cartel o Poster', 'Cundinamarca', '9513 - Centro de Desarrollo Agroempresarial', '2025-10-30 19:11:13'),
(38, 'Diagnóstico de mercado para productos autóctonos del municipio de Soacha', 'Cartel o Poster', 'Distrito Capital', '9209 - Centro de Tecnologías para la Construcción y la Madera', '2025-10-30 19:11:13'),
(39, 'Diseño Singular del Pedal de Freno para Minicargo como Herramienta de Transporte para Economía Popular y Campesina', 'Poster y Prototipo', 'Distrito Capital', '9213 - Centro de Tecnologías del Transporte', '2025-10-30 19:11:13'),
(40, 'Seguridad vial, economía popular y campesina: un enfoque integral para el desarrollo rural.', 'Ponencia', 'Distrito Capital', '9213 - Centro de Tecnologías del Transporte', '2025-10-30 19:11:13'),
(41, 'Mi Vivero Digital', 'Cartel o Poster', 'Distrito Capital', '9213 - Centro de Tecnologías del Transporte', '2025-10-30 19:11:13'),
(42, 'Diseño e implementación del modulo ABS para vehículo de Transporte para Economía Popular y Campesina', 'Poster y Prototipo', 'Distrito Capital', '9213 - Centro de Tecnologías del Transporte', '2025-10-30 19:11:13'),
(43, 'Proyecto Recuperación de la memoria histórica: mercados campesinos una estrategia para el empoderamiento de la mujer campesina en el caso ANUC', 'Cartel o Poster', 'Distrito Capital', '9303 - Centro de Gestión de Mercados, Logística y Tecnologías de la Información', '2025-10-30 19:11:13'),
(44, 'Implementar la herramienta tecnológica para medir el clima y la cultura en las tiendas de barrio (muestra representativa) en la Localidad de Bosa para 2025.', 'Cartel o Poster', 'Distrito Capital', '9404 - Centro de Gestión Administrativa', '2025-10-30 19:11:13'),
(45, 'Fortalecimiento del Emprendimiento Campesino en Colombia: Estrategias con base en la denominación de origen y la identidad campesina para la creación de empresas sostenibles. Estudio de caso: Vereda Pasquilla', 'Cartel o Poster', 'Distrito Capital', '9404 - Centro de Gestión Administrativa', '2025-10-30 19:11:13'),
(46, 'Rescatando la sabiduría de nuestras raíces para construir un futuro sostenible', 'Ponencia', 'Distrito Capital', '9404 - Centro de Gestión Administrativa', '2025-10-30 19:11:13'),
(47, 'YOSUULIA JEMETSU: Tradición que nutre y cuida', 'Stand', 'Guajira', '9222 - Centro Industrial y de Energías Alternativas', '2025-10-30 19:11:13'),
(48, 'MODELACIÓN DE AMBIENTES DE APRENDIZAJE CONTEXTUALIZADOS PARA LA FORMACIÓN TÉCNICA EN AGROINDUSTRIA EN ZONAS RURALES DE LA GUAJIRA', 'Stand', 'Guajira', '9524 - Centro Agroempresarial y Acuícola', '2025-10-30 19:11:13'),
(49, 'Implementación de forraje verde hidropónico como alternativa sostenible para el fortalecimiento de la economía campesina en sistemas agropecuarios de pequeña escala', 'Stand', 'Guajira', '9524 - Centro Agroempresarial y Acuícola', '2025-10-30 19:11:13'),
(50, 'USO DE SUBPRODUCTOS DEL CULTIVO DE CACAO COMO INSUMOS PARA LA PRODUCCIÓN DE ABONOS ORGÁNICOS EN SAN JOSÉ DEL GUAVIARE.', 'Cartel o Poster', 'Guaviare', '9533 - Centro de Desarrollo Agroindustrial, Turístico y Tecnológico del Guaviare', '2025-10-30 19:11:13'),
(51, 'Inventario De Mariposas Diurnas (Lepidóptera) Asociadas A Agroecosistemas Ubicados En Zona De Bosque Seco Tropical Campoalegre- Huila', 'Cartel o Poster', 'Huila', '9116 - Centro de Formación Agroindustrial', '2025-10-30 19:11:13'),
(52, 'Implementación de estrategias de mitigación de Gases de efecto invernadero y sostenibilidad en sistemas de producción pecuaria', 'Cartel o Poster', 'Huila', '9116 - Centro de Formación Agroindustrial', '2025-10-30 19:11:13'),
(53, 'Modelo integral de marketing sostenible, para potencializar la comercialización de los productos del campo y bienestar de los campesinos.', 'Cartel o Poster', 'Huila', '9526 - Centro de Desarrollo Agroempresarial y Turístico del Huila', '2025-10-30 19:11:13'),
(54, 'Cultivo de pepino (Cucumis sativus) a partir del uso de la microalga Chlorella vulgaris como biofertilizante: una alternativa agrícola para los productores nariñenses', 'Ponencia', 'Nariño', '9535 - Centro Agroindustrial y Pesquero de la Costa Pacífica', '2025-10-30 19:11:13'),
(55, 'Diseño estratégico de un sistema integrado de gestión desde el enfoque en procesos de la unidad productiva de cerdos del Centro Internacional de Producción Limpia Lope SENA Regional Nariño, en el año 2025.', 'Cartel o Poster', 'Nariño', '9536 - Centro Internacional de Producción Limpia - Lope', '2025-10-30 19:11:13'),
(56, 'Reconocimiento del pefil sensorial del cacao de calidad superior por los actores de la cadena cacaotera en Norte de Santander.', 'Poster y Prototipo', 'Norte de Santander', '9119 - Centro de Formación para el Desarrollo Rural y Minero', '2025-10-30 19:11:13'),
(57, 'ESTRATEGIA DE COMUNICACIÓN DIGITAL BASADO EN AVIFAUNA PARA NEGOCIOS DE ECONOMÍA POPULAR DE LA ZONA RURAL DEL ÁREA METROPOLITANA CÚCUTA', 'Cartel o Poster', 'Norte de Santander', '9537 - Centro de la Industria, la Empresa y los Servicios', '2025-10-30 19:11:13'),
(58, 'Plan exportador de panela pulverizada elaborada en el municipio de Arboledas, Norte de Santander.', 'Cartel o Poster', 'Norte de Santander', '9537 - Centro de la Industria, la Empresa y los Servicios', '2025-10-30 19:11:13'),
(59, 'Evaluación de tres tipos de abono orgánico tipo bocashi en la producción de pepino (cucumis sativus) en la Amazonía Colombiana', 'Cartel o Poster', 'Putumayo', '9518 - Centro Agroforestal y Acuícola Arapaima', '2025-10-30 19:11:13'),
(60, 'Efecto del uso de concentrado a base de alimentos alternativos de la región como estrategia de alimentación sostenible en cachama (colossoma macropumum) en el departamento del putumayo', 'Cartel o Poster', 'Putumayo', '9518 - Centro Agroforestal y Acuícola Arapaima', '2025-10-30 19:11:13'),
(61, 'Efecto de la inclusión de larva de mosca negra soldado (Hermetia illunces) como alternativa de suplementación sostenible en cachama (Colossoma macropomum) en el departamento del Putumayo.', 'Cartel o Poster', 'Putumayo', '9518 - Centro Agroforestal y Acuícola Arapaima', '2025-10-30 19:11:13'),
(62, 'Optimización de los flujos de trabajo en prenda superior deportiva para las empresas de confección del departamento del Quindío', 'Ponencia', 'Quindío', '9231 - Centro para el Desarrollo Tecnológico de la Construcción y la Industria', '2025-10-30 19:11:13'),
(63, 'Software de gestión automotriz TallerSoft', 'Cartel o Poster', 'Quindío', '9231 - Centro para el Desarrollo Tecnológico de la Construcción y la Industria', '2025-10-30 19:11:13'),
(64, 'Factores determinantes en las estrategias de comercialización para la economia informal de la población indigena de la Ciudad de Armenia.', 'Cartel o Poster', 'Quindío', '9538 - Centro de Comercio y Turismo', '2025-10-30 19:11:13'),
(65, 'Estrategias de mejora de los Sistemas Contables en los procesos productivos de Campesinos de Circasia Quindío.', NULL, 'Quindío', '9538 - Centro de Comercio y Turismo', '2025-10-30 19:11:13'),
(66, 'Incubadora y Nacedora de huevos con rotación automática Centro Agropecuario SENA - Risaralda', 'Poster y Prototipo', 'Risaralda', '9121 - Centro Atención Sector Agropecuario', '2025-10-30 19:11:13'),
(67, 'EL RINCON DEL SALTARIN', 'Stand', 'Risaralda', '9308 - Centro de Comercio y Servicios', '2025-10-30 19:11:13'),
(68, 'Desarrollo de una herramienta tecnológica de apoyo a la gestión de la información administrativa y comercial de la ANUC-Floridablanca', 'Cartel o Poster', 'Santander', '9225 - Centro Industrial del Diseño y la Manufactura', '2025-10-30 19:11:13'),
(69, 'XERIDAS Y ANCESTRALIDAD. LA RUTA PARA RECONECTAR PROYECTO XERIDAS', NULL, 'Santander', '9309 - Centro de Servicios Empresariales y Turísticos', '2025-10-30 19:11:13'),
(70, 'Fortalecimiento de competencias de gestión contable y financiera para emprendedores de economía popular en Bucaramanga', 'Cartel o Poster', 'Santander', '9309 - Centro de Servicios Empresariales y Turísticos', '2025-10-30 19:11:13'),
(71, 'Caracterización de las razas machos ovinos en el páramo del almorzadero provincia García Rovira Santander', 'Cartel o Poster', 'Santander', '9545 - Centro Agroempresarial y Turístico de los Andes', '2025-10-30 19:11:13'),
(72, 'Caracterización del cultivo de tomate bajo invernadero a través de imágenes satelitales en el municipio de Málaga Santander', 'Cartel o Poster', 'Santander', '9545 - Centro Agroempresarial y Turístico de los Andes', '2025-10-30 19:11:13'),
(73, 'Protección de las variedades de semillas de maiz nativo en el sur del Tolima', 'Cartel o Poster', 'Tolima', '9123 - Centro Agropecuario la Granja', '2025-10-30 19:11:13'),
(74, 'Diseño del plan de marketing internacional para dos pymes de la ciudad de Ibagué.', 'Cartel o Poster', 'Tolima', '9310 - Centro de Comercio y Servicios', '2025-10-30 19:11:13'),
(75, 'Prácticas campesinas en la produccion de papa criolla y carne de cuy para la soberania alimentaria familiar en la zona rural de Porto Bello', NULL, 'Valle', '9125 - Centro Latinoamericano de Especies Menores', '2025-10-30 19:11:13'),
(76, 'Implementación de una Metodología Integral de Intervención para el Desarrollo Participativo de Hábitats Rurales Productivos de la Región del Pacífico Colombiano, en el marco de los objetivos de desarrollo sostenible. (Fase I)', 'Cartel o Poster', 'Valle', '9228 - Centro de la Construcción', '2025-10-30 19:11:13'),
(77, 'Efectos organizativos en comunidades urbanas por implementación del Piloto \"Formación profesional integral para fortalecimiento economías populares urbanas Valle del Cauca\"', 'Ponencia', 'Valle', '9311 - Centro de Gestión Tecnológica de Servicios', '2025-10-30 19:11:13'),
(78, 'Asistencia técnica para el desarrollo sustentable y económico de redes de mujeres comunales y rurales, Cali 2024.', NULL, 'Valle', '9311 - Centro de Gestión Tecnológica de Servicios', '2025-10-30 19:11:13'),
(79, 'Impacto económico de la incorporación de café de alta calidad en la comercialización ambulante de la bebida bajo el marco de la economía popular en el norte del Valle del Cauca', 'Cartel o Poster', 'Valle', '9543 - Centro de Tecnologías Agroindustriales', '2025-10-30 19:11:13'),
(80, 'Diseño del plan operativo para la cadena de suministro de la empresa Jireth en la ciudad de Palmira', 'Ponencia', 'Valle', '9544 - Centro de Biotecnología Industrial', '2025-10-30 19:11:13'),
(81, 'Panorama de la Economía Popular en Colombia', 'Ponencia', 'Valle', '9544 - Centro de Biotecnología Industrial', '2025-10-30 19:11:13'),
(82, 'Optimización del plan de gestión integral de residuos sólidos en el Centro Acuícola y Agroindustrial de Gaira.', 'Cartel o Poster', 'Magdalena', '9118 - Centro Acuícola y Agroindustrial de Gaira', '2025-10-30 19:11:13'),
(83, 'Prototipo de Biodigestor de Recursos Hídricos.', 'Cartel o Poster', 'Magdalena', '9118 - Centro Acuícola y Agroindustrial de Gaira', '2025-10-30 19:11:13'),
(84, 'Caracterización de residuos sólidos en el Río Manzanares en la ciudad de Santa Marta', NULL, 'Magdalena', '9118 - Centro Acuícola y Agroindustrial de Gaira', '2025-10-30 19:11:13');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `asignaciones`
--
ALTER TABLE `asignaciones`
  ADD PRIMARY KEY (`id_asignacion`);

--
-- Indices de la tabla `calificaciones`
--
ALTER TABLE `calificaciones`
  ADD PRIMARY KEY (`id_calificacion`),
  ADD KEY `fk_calificaciones_asignacion` (`id_asignacion`);

--
-- Indices de la tabla `evaluadores`
--
ALTER TABLE `evaluadores`
  ADD PRIMARY KEY (`id_evaluador`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `asignaciones`
--
ALTER TABLE `asignaciones`
  MODIFY `id_asignacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=324;

--
-- AUTO_INCREMENT de la tabla `calificaciones`
--
ALTER TABLE `calificaciones`
  MODIFY `id_calificacion` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `evaluadores`
--
ALTER TABLE `evaluadores`
  MODIFY `id_evaluador` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `calificaciones`
--
ALTER TABLE `calificaciones`
  ADD CONSTRAINT `fk_calificaciones_asignacion` FOREIGN KEY (`id_asignacion`) REFERENCES `asignaciones` (`id_asignacion`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
