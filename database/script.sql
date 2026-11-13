create database if not exists kargotrack_db
character set utf8mb4 collate utf8mb4_unicode_ci;

use kargotrack_db;

create table roles (
    id_rol int auto_increment primary key,
    nombre varchar(50) not null unique,
    descripcion varchar(255)
);

insert into roles (nombre, descripcion) values 
('administrador', 'acceso total al sistema y configuraciones'),
('operativo', 'gestion de envios, guias y clientes');

create table usuarios (
    id_usuario int auto_increment primary key,
    nombre varchar(100) not null,
    apellidos varchar(100) not null,
    correo varchar(100) not null unique,
    password varchar(255) not null,
    id_rol int not null,
    estado tinyint(1) not null default 1,
    fecha_registro datetime default current_timestamp,
    constraint fk_usuario_rol foreign key (id_rol) references roles(id_rol)
);

create table clientes (
    id_cliente int auto_increment primary key,
    nombre varchar(100) not null,
    apellido varchar(100) not null,
    documento varchar(20) not null unique,
    telefono varchar(20),
    correo varchar(150),
    direccion varchar(255),
    fecha_registro datetime default current_timestamp
);

-- usuario de prueba: jhon@gmail.com / clave: 1234 (id_rol 1 es administrador)
insert into usuarios (nombre, apellidos, correo, password, id_rol, estado) 
values (
    'jhon',
    'salcedo',
    'jhon@gmail.com',
    '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 
    1,
    1
);

insert into clientes (nombre, apellido, documento, telefono, correo, direccion) 
values (
    'carlos',
    'ramirez',
    '76543210',
    '987654321',
    'carlos@gmail.com',
    'av. universitaria 123, huanuco'
);