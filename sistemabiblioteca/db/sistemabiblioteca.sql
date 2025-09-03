-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 11-08-2025 a las 21:21:30
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `sistemabiblioteca`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `autores`
--

CREATE TABLE `autores` (
  `AutorID` int(11) NOT NULL,
  `Nombre` varchar(100) NOT NULL,
  `Apellido` varchar(100) DEFAULT NULL,
  `Nacionalidad` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `busquedalibros`
--

CREATE TABLE `busquedalibros` (
  `BusquedaID` int(11) NOT NULL,
  `UsuarioID` int(11) DEFAULT NULL,
  `TextoBusqueda` varchar(255) DEFAULT NULL,
  `FechaBusqueda` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clasificacionlibros`
--

CREATE TABLE `clasificacionlibros` (
  `ClasificacionID` int(11) NOT NULL,
  `Nombre` varchar(100) NOT NULL,
  `Descripcion` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleados`
--

CREATE TABLE `empleados` (
  `EmpleadoID` int(11) NOT NULL,
  `Cargo` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estudiantes`
--

CREATE TABLE `estudiantes` (
  `EstudianteID` int(11) NOT NULL,
  `Carrera` varchar(100) DEFAULT NULL,
  `Semestre` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `horarios`
--

CREATE TABLE `horarios` (
  `HorarioID` int(11) NOT NULL,
  `DiaSemana` enum('Lunes','Martes','Miércoles','Jueves','Viernes','Sábado','Domingo') DEFAULT NULL,
  `HoraApertura` time DEFAULT NULL,
  `HoraCierre` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inventario`
--

CREATE TABLE `inventario` (
  `InventarioID` int(11) NOT NULL,
  `LibroID` int(11) DEFAULT NULL,
  `CodigoBarra` varchar(50) DEFAULT NULL,
  `Estado` enum('Disponible','Prestado','Dañado','Perdido') DEFAULT NULL,
  `Ubicacion` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `libroautor`
--

CREATE TABLE `libroautor` (
  `LibroID` int(11) NOT NULL,
  `AutorID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `libros`
--

CREATE TABLE `libros` (
  `LibroID` int(11) NOT NULL,
  `Titulo` varchar(255) NOT NULL,
  `ISBN` varchar(20) DEFAULT NULL,
  `AnioPublicacion` year(4) DEFAULT NULL,
  `ClasificacionID` int(11) DEFAULT NULL,
  `ImagenURL` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `prestamos`
--

CREATE TABLE `prestamos` (
  `PrestamoID` int(11) NOT NULL,
  `UsuarioID` int(11) DEFAULT NULL,
  `InventarioID` int(11) DEFAULT NULL,
  `FechaPrestamo` date DEFAULT NULL,
  `FechaDevolucion` date DEFAULT NULL,
  `FechaDevuelto` date DEFAULT NULL,
  `Estado` enum('Prestado','Devuelto','Retrasado') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `profesores`
--

CREATE TABLE `profesores` (
  `ProfesorID` int(11) NOT NULL,
  `Departamento` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reporteprestamos`
--

CREATE TABLE `reporteprestamos` (
  `ReporteID` int(11) NOT NULL,
  `PrestamoID` int(11) DEFAULT NULL,
  `FechaReporte` date DEFAULT NULL,
  `Observaciones` varchar(255) DEFAULT NULL,
  `GeneradoPor` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `UsuarioID` int(11) NOT NULL,
  `Documento` int(12) NOT NULL,
  `Nombre` varchar(100) NOT NULL,
  `Apellido` varchar(100) NOT NULL,
  `Email` varchar(100) DEFAULT NULL,
  `Telefono` varchar(20) DEFAULT NULL,
  `TipoUsuario` enum('Estudiante','Profesor','Empleado') NOT NULL,
  `password` varchar(20) DEFAULT NULL,
  `fecha_registro` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`UsuarioID`, `Documento`, `Nombre`, `Apellido`, `Email`, `Telefono`, `TipoUsuario`, `password`, `fecha_registro`) VALUES
(11, 1011593550, 'Geronimo', 'Perez Rivera', 'geronimoperers341@gmail.com', '3168505554', 'Estudiante', '12345678', '2025-07-28 20:03:58'),
(13, 1022095707, 'Oscar', 'espinosa', 'oscar123@gmail.com', '3194845289', 'Estudiante', '123456789', '2025-07-28 20:45:16');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `autores`
--
ALTER TABLE `autores`
  ADD PRIMARY KEY (`AutorID`);

--
-- Indices de la tabla `busquedalibros`
--
ALTER TABLE `busquedalibros`
  ADD PRIMARY KEY (`BusquedaID`),
  ADD KEY `UsuarioID` (`UsuarioID`);

--
-- Indices de la tabla `clasificacionlibros`
--
ALTER TABLE `clasificacionlibros`
  ADD PRIMARY KEY (`ClasificacionID`);

--
-- Indices de la tabla `empleados`
--
ALTER TABLE `empleados`
  ADD PRIMARY KEY (`EmpleadoID`);

--
-- Indices de la tabla `estudiantes`
--
ALTER TABLE `estudiantes`
  ADD PRIMARY KEY (`EstudianteID`);

--
-- Indices de la tabla `horarios`
--
ALTER TABLE `horarios`
  ADD PRIMARY KEY (`HorarioID`);

--
-- Indices de la tabla `inventario`
--
ALTER TABLE `inventario`
  ADD PRIMARY KEY (`InventarioID`),
  ADD UNIQUE KEY `CodigoBarra` (`CodigoBarra`),
  ADD KEY `LibroID` (`LibroID`);

--
-- Indices de la tabla `libroautor`
--
ALTER TABLE `libroautor`
  ADD PRIMARY KEY (`LibroID`,`AutorID`),
  ADD KEY `AutorID` (`AutorID`);

--
-- Indices de la tabla `libros`
--
ALTER TABLE `libros`
  ADD PRIMARY KEY (`LibroID`),
  ADD UNIQUE KEY `ISBN` (`ISBN`),
  ADD KEY `ClasificacionID` (`ClasificacionID`);

--
-- Indices de la tabla `prestamos`
--
ALTER TABLE `prestamos`
  ADD PRIMARY KEY (`PrestamoID`),
  ADD KEY `UsuarioID` (`UsuarioID`),
  ADD KEY `InventarioID` (`InventarioID`);

--
-- Indices de la tabla `profesores`
--
ALTER TABLE `profesores`
  ADD PRIMARY KEY (`ProfesorID`);

--
-- Indices de la tabla `reporteprestamos`
--
ALTER TABLE `reporteprestamos`
  ADD PRIMARY KEY (`ReporteID`),
  ADD KEY `PrestamoID` (`PrestamoID`),
  ADD KEY `GeneradoPor` (`GeneradoPor`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`UsuarioID`),
  ADD UNIQUE KEY `Email` (`Email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `autores`
--
ALTER TABLE `autores`
  MODIFY `AutorID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `busquedalibros`
--
ALTER TABLE `busquedalibros`
  MODIFY `BusquedaID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `clasificacionlibros`
--
ALTER TABLE `clasificacionlibros`
  MODIFY `ClasificacionID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `horarios`
--
ALTER TABLE `horarios`
  MODIFY `HorarioID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `inventario`
--
ALTER TABLE `inventario`
  MODIFY `InventarioID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `libros`
--
ALTER TABLE `libros`
  MODIFY `LibroID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `prestamos`
--
ALTER TABLE `prestamos`
  MODIFY `PrestamoID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `reporteprestamos`
--
ALTER TABLE `reporteprestamos`
  MODIFY `ReporteID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `UsuarioID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `busquedalibros`
--
ALTER TABLE `busquedalibros`
  ADD CONSTRAINT `busquedalibros_ibfk_1` FOREIGN KEY (`UsuarioID`) REFERENCES `usuarios` (`UsuarioID`);

--
-- Filtros para la tabla `empleados`
--
ALTER TABLE `empleados`
  ADD CONSTRAINT `empleados_ibfk_1` FOREIGN KEY (`EmpleadoID`) REFERENCES `usuarios` (`UsuarioID`);

--
-- Filtros para la tabla `estudiantes`
--
ALTER TABLE `estudiantes`
  ADD CONSTRAINT `estudiantes_ibfk_1` FOREIGN KEY (`EstudianteID`) REFERENCES `usuarios` (`UsuarioID`);

--
-- Filtros para la tabla `inventario`
--
ALTER TABLE `inventario`
  ADD CONSTRAINT `inventario_ibfk_1` FOREIGN KEY (`LibroID`) REFERENCES `libros` (`LibroID`);

--
-- Filtros para la tabla `libroautor`
--
ALTER TABLE `libroautor`
  ADD CONSTRAINT `libroautor_ibfk_1` FOREIGN KEY (`LibroID`) REFERENCES `libros` (`LibroID`),
  ADD CONSTRAINT `libroautor_ibfk_2` FOREIGN KEY (`AutorID`) REFERENCES `autores` (`AutorID`);

--
-- Filtros para la tabla `libros`
--
ALTER TABLE `libros`
  ADD CONSTRAINT `libros_ibfk_1` FOREIGN KEY (`ClasificacionID`) REFERENCES `clasificacionlibros` (`ClasificacionID`);

--
-- Filtros para la tabla `prestamos`
--
ALTER TABLE `prestamos`
  ADD CONSTRAINT `prestamos_ibfk_1` FOREIGN KEY (`UsuarioID`) REFERENCES `usuarios` (`UsuarioID`),
  ADD CONSTRAINT `prestamos_ibfk_2` FOREIGN KEY (`InventarioID`) REFERENCES `inventario` (`InventarioID`);

--
-- Filtros para la tabla `profesores`
--
ALTER TABLE `profesores`
  ADD CONSTRAINT `profesores_ibfk_1` FOREIGN KEY (`ProfesorID`) REFERENCES `usuarios` (`UsuarioID`);

--
-- Filtros para la tabla `reporteprestamos`
--
ALTER TABLE `reporteprestamos`
  ADD CONSTRAINT `reporteprestamos_ibfk_1` FOREIGN KEY (`PrestamoID`) REFERENCES `prestamos` (`PrestamoID`),
  ADD CONSTRAINT `reporteprestamos_ibfk_2` FOREIGN KEY (`GeneradoPor`) REFERENCES `empleados` (`EmpleadoID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
