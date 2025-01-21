-- Crear la base de datos
DROP DATABASE IF EXISTS ong;
CREATE DATABASE ong;

-- Usar la base de datos
USE ong;

-- Crear la tabla de Centros
CREATE TABLE centros (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    localidad VARCHAR(100) NOT NULL,
    activo boolean default true not null
);

-- Insertar datos en la tabla Centros
INSERT INTO centros (nombre, localidad) 
VALUES 
    ('Centro Este', 'Navalmoral de la Mata'),
    ('Centro Oeste', 'Plasencia'),
    ('Centro Principal', 'Cáceres');

-- Crear la tabla de Beneficiarios
CREATE TABLE beneficiarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    dni varchar(9) unique not null,
    nombre VARCHAR(100) NOT NULL,
    centro int not null,
    fechaN DATE NOT NULL,
    direccion VARCHAR(200),
	FOREIGN KEY (centro) REFERENCES centros(id) on update cascade on delete restrict
);

-- Insertar datos en la tabla Beneficiarios
INSERT INTO beneficiarios
VALUES 
    (1,'1A','María López García', 1, '1980-04-15', 'Calle Mayor, 3, Navalmoral de la Mata'),
    (2,'2B','José Martínez Pérez', 1, '1975-09-12', 'Avenida España, 45, Plasencia'),
    (3,'3C','Ana Gómez Sánchez', 2,'1990-01-22', 'Calle Real, 8, Cáceres'),
    (4,'4D','Luis Díaz Fernández', 2, '1985-07-30', 'Calle Nueva, 12, Cáceres'),
    (5,'5E','Elena Ruiz Torres', 3, '1995-03-10', 'Plaza Mayor, 1, Plasencia');

-- Crear la tabla de Servicios
CREATE TABLE servicios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre_servicio VARCHAR(100) NOT NULL,
    descripcion TEXT
);

-- Insertar datos en la tabla Servicios
INSERT INTO servicios
VALUES 
    (1,'Asesoramiento legal', 'Ayuda con temas legales y jurídicos'),
    (2,'Atención psicológica', 'Sesiones con psicólogos profesionales'),
    (3,'Formación laboral', 'Cursos para mejorar la empleabilidad'),
    (4,'Distribución de alimentos', 'Entrega de alimentos básicos'),
    (5,'Apoyo escolar', 'Clases y materiales para estudiantes en riesgo de exclusión');

-- Crear la tabla Servicio_Usuario
CREATE TABLE servicio_usuario (
    id INT AUTO_INCREMENT PRIMARY KEY,
    beneficiario INT NOT NULL,
    servicio INT NOT NULL,
    fecha DATE NOT NULL,
    FOREIGN KEY (beneficiario) REFERENCES beneficiarios(id) on update cascade on delete restrict,
    FOREIGN KEY (servicio) REFERENCES servicios(id)  on update cascade on delete restrict
);

-- Insertar datos en la tabla Servicio_Usuario
INSERT INTO servicio_usuario
VALUES 
    (null, 1, 1, '2024-12-01'),
    (null, 2, 3, '2024-12-02'),
    (null, 3, 2, '2024-12-03'),
    (null, 4, 4, '2023-12-14'),
    (null, 5, 5, '2023-12-15'),
    (null, 5, 1, '2023-12-11'),
    (null, 4, 3, '2023-12-12'),
    (null, 1, 2, '2023-12-01'),
    (null, 3, 4, '2023-12-14'),
    (null, 2, 5, '2023-12-15');
    
delimiter //
create procedure infoCentro(pCentro int)
begin
	declare numBeneficiarios int default 0;
    declare numServiciosP int default 0;
    select count(*) into numBeneficiarios from beneficiarios where centro = pCentro;
     select count(*) into numServiciosP from beneficiarios b inner join servicio_usuario s on s.beneficiario = b.id where centro = pCentro;
     select numBeneficiarios, numServiciosP;
end//
delimiter ;

call infoCentro(1);