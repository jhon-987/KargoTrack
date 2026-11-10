create database if not exists kargotrack
character set utf8mb4
collate utf8mb4_unicode_ci;

use kargotrack;

create table if not exists roles (
    id_rol int auto_increment primary key,
    nombre varchar(50) not null unique,
    descripcion varchar(150)
);

create table if not exists usuarios (
    id_usuario int auto_increment primary key,
    nombre varchar(100) not null,
    apellido varchar(100) not null,
    correo varchar(150) not null unique,
    password varchar(255) not null,
    id_rol int not null,
    estado tinyint(1) not null default 1,
    fecha_registro timestamp default current_timestamp,

    constraint fk_usuario_rol
    foreign key (id_rol)
    references roles(id_rol)
);

insert ignore into roles (nombre, descripcion)
values
('administrador', 'acceso administrativo al sistema'),
('operativo', 'gestion operativa de encomiendas');