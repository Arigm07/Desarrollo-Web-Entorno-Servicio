drop database if exists biblioteca;
create database biblioteca;
use biblioteca;


create table socios(
id int auto_increment primary key,
nombre varchar (100) not null,
fechaSancion date default null,
email varchar (255) not null
)engine innodb;


create table libros(
id int auto_increment primary key,
titulo varchar (100) not null,
ejemplares int not null,
autor varchar (100)
)engine innodb;


create table prestamos(
id int auto_increment primary key,
socio int not null,
libro int not null,
fechaP date not null,	-- FECHA PRÉSTAMO
fechaD date not null,	-- FECHA DEVOLUCIÓN
fechaRD date null default null,		-- FECHA REAL DEVOLUCIÓN
foreign key (socio) references socios(id) on update cascade on delete restrict,
foreign key (libro) references libros(id) on update cascade on delete restrict
)engine innodb;



												-- FUNCIÓN QUE COMPRUEBA SI SE PUEDE PRESTAR EL LIBRO AL SOCIO
			-- Devuelve
            -- 1: Si se puede hacer el préstamo
            -- -1: Si no hay ejemplares del libro
            -- -2: Si el socio esta sancionado
            -- -3: Si el socio tiene libros sin devolver
            -- -4: Si el socio tiene más de 2 libros prestados
            -- 0 en cualquier otro caso (error)
delimiter //
	create function comprobarSiPrestar(pSocio int, pLibro int) returns int
    begin
		declare resultado default 0;
			-- Comprobar ejemplares
            
    end;
delimiter ;