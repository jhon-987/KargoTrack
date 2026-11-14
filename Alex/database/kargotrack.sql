create database if not exists kargotrack
    character set utf8mb4
    collate utf8mb4_0900_ai_ci;

use kargotrack;

create table if not exists clientes (
    id int auto_increment primary key,
    nombre varchar(100) not null,
    documento varchar(20) not null,
    telefono varchar(20) not null
);

create table if not exists encomiendas (
    id int auto_increment primary key,
    cliente_id int not null,
    peso decimal(10, 2) not null,
    destino varchar(150) not null,
    foreign key (cliente_id) references clientes(id) on delete cascade
);
