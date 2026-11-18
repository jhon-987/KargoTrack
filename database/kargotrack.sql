create database if not exists kargotrack
    character set utf8mb4
    collate utf8mb4_unicode_ci;

use kargotrack;


create table if not exists clientes (
    id_cliente int auto_increment primary key,
    nombre varchar(100) not null,
    apellido varchar(100) not null,
    documento varchar(20) not null unique,
    telefono varchar(20),
    correo varchar(150),
    direccion varchar(255),
    fecha_registro datetime default current_timestamp
);

create table if not exists encomiendas (
    id_encomienda int auto_increment primary key,
    id_cliente int null,
    descripcion varchar(255) not null,
    peso decimal(10, 2) null,
    destino varchar(150) null,
    estado varchar(50) not null default 'Registrado',
    fecha_registro datetime default current_timestamp,
    constraint fk_encomienda_cliente
        foreign key (id_cliente) references clientes(id_cliente)
        on delete set null
);

drop database if exists kargotrack;
