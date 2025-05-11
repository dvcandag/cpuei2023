
-- Base de datos: `cpuei2023`
--

CREATE TABLE `alumno` (
  `codalumno` char(8) NOT NULL,
  `nombrealumno` varchar(250) NOT NULL,
  `apaterno` varchar(250) NOT NULL,
  `amaterno` varchar(250) NOT NULL,
  `dni` char(8) NOT NULL,
  `fecha_nacimiento` date NOT NULL,
  `fotoalumno` blob DEFAULT NULL,
  `correo` varchar(250) NOT NULL,
  `escuela_nombre` varchar(250) NOT NULL,
  `aula` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `alumno_horario` (
  `codalumno` char(8) NOT NULL,
  `codhorario` char(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



CREATE TABLE `curso` (
  `codcurso` char(8) NOT NULL,
  `nombrecurso` varchar(250) NOT NULL,
  `descripcion` varchar(500) DEFAULT NULL,
  `creditos` int(11) DEFAULT NULL,
  `hora_semanal` int(10) DEFAULT NULL,
  `codprofesor` char(8) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


CREATE TABLE `horario` (
  `codhorario` char(8) NOT NULL,
  `codcurso` char(8) NOT NULL,
  `codprofesor` char(8) NOT NULL,
  `dia_semana` enum('Lunes','Martes','Miércoles','Jueves','Viernes','Sábado','Domingo') NOT NULL,
  `turno` enum('Mañana','Tarde') NOT NULL,
  `hora_inicio` time NOT NULL,
  `hora_fin` time NOT NULL
) ;



CREATE TABLE `matricula` (
  `codmatricula` int(8) NOT NULL,
  `codprofesor` char(8) NOT NULL,
  `codalumno` char(8) NOT NULL,
  `codcurso` char(8) NOT NULL,
  `modalidad` varchar(100) NOT NULL,
  `fecha_de_matricula` date DEFAULT NULL,
  `fecha_inicio_matricula` date DEFAULT NULL,
  `fecha_fin_matricula` date DEFAULT NULL,
  `fecha_inicio_curso` date DEFAULT NULL,
  `fecha_fin_curso` date DEFAULT NULL
) ;


CREATE TABLE `nota` (
  `idnota` int(11) NOT NULL,
  `codalumno` char(8) NOT NULL,
  `codcurso` char(8) NOT NULL,
  `nota1` double DEFAULT NULL,
  `nota2` double DEFAULT NULL,
  `nota3` double DEFAULT NULL,
  `nota4` double DEFAULT NULL,
  `promedio` double GENERATED ALWAYS AS ((`nota1` + `nota2` + `nota3` + `nota4`) / 4) STORED
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



CREATE TABLE `profesor` (
  `codprofesor` char(8) NOT NULL,
  `nombreprofesor` varchar(100) NOT NULL,
  `apaternoprofesor` varchar(100) NOT NULL,
  `amaternoprofesor` varchar(100) NOT NULL,
  `titulo_academico` enum('Doctorado','Maestría','Título Profesional','Bachillerato') NOT NULL,
  `correo` varchar(100) NOT NULL,
  `telefono` varchar(15) DEFAULT NULL,
  `direccion` varchar(250) DEFAULT NULL,
  `fecha_contratacion` date NOT NULL,
  `salario` decimal(10,2) NOT NULL,
  `departamento` varchar(100) NOT NULL,
  `estado` enum('Activo','Inactivo') DEFAULT 'Activo',
  `fecha_nacimiento` date DEFAULT NULL,
  `fecha_salida` date DEFAULT NULL,
  `motivo_salida` enum('Despido','Renuncia','Jubilación','Otro') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


ALTER TABLE `alumno`
  ADD PRIMARY KEY (`codalumno`);


ALTER TABLE `alumno_horario`
  ADD PRIMARY KEY (`codalumno`,`codhorario`),
  ADD KEY `codhorario` (`codhorario`);

ALTER TABLE `curso`
  ADD PRIMARY KEY (`codcurso`),
  ADD KEY `codprofesor` (`codprofesor`);

ALTER TABLE `horario`
  ADD PRIMARY KEY (`codhorario`),
  ADD KEY `codcurso` (`codcurso`),
  ADD KEY `codprofesor` (`codprofesor`);

ALTER TABLE `matricula`
  ADD PRIMARY KEY (`codmatricula`),
  ADD KEY `codprofesor` (`codprofesor`),
  ADD KEY `codalumno` (`codalumno`),
  ADD KEY `codcurso` (`codcurso`);


ALTER TABLE `nota`
  ADD PRIMARY KEY (`idnota`),
  ADD UNIQUE KEY `codalumno` (`codalumno`,`codcurso`),
  ADD KEY `codcurso` (`codcurso`);

ALTER TABLE `profesor`
  ADD PRIMARY KEY (`codprofesor`),
  ADD UNIQUE KEY `correo` (`correo`);

ALTER TABLE `usuario`
  ADD PRIMARY KEY (`codalumno`);

