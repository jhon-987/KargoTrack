create database if not exists kargotrack
    character set utf8mb4
    collate utf8mb4_unicode_ci;

use kargotrack;

create table roles (
    id_rol int auto_increment primary key,
    nombre varchar(50) not null unique,
    descripcion varchar(255)
);

create table ciudades (
    id_ciudad int auto_increment primary key,
    nombre varchar(100) not null,
    departamento varchar(100) not null
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

create table vehiculo (
    id int  auto_increment primary key,
    placa varchar(10) not null,
    modelo varchar(60) not null,
    disponible tinyint(1) not null default 1,
    unique (placa)
);

create table chofer (
    id int  auto_increment primary key,
    nombre varchar(100) not null,
    licencia varchar(15) not null,
    unique (licencia)
);

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

create table encomiendas (
    id_encomienda int auto_increment primary key,
    cliente_id int not null,
    peso decimal(10, 2) not null,
    destino varchar(150) not null,
    foreign key (cliente_id) references clientes(id_cliente) on delete cascade
);

create table envios (
    id_envio int auto_increment primary key,
    id_encomienda int not null unique,
    id_ciudad_origen int not null,
    id_ciudad_destino int not null,
    id_vehiculo int not null,
    id_chofer int not null,
    fecha_salida date not null,
    fecha_llegada date not null,
    
    constraint fk_envio_ciudad_origen foreign key (id_ciudad_origen) references ciudades(id_ciudad),
    constraint fk_envio_ciudad_destino foreign key (id_ciudad_destino) references ciudades(id_ciudad),
    constraint fk_envio_encomienda foreign key (id_encomienda) references encomiendas(id_encomienda),
    constraint fk_envio_vehiculo foreign key (id_vehiculo) references vehiculo(id),
    constraint fk_envio_chofer foreign key (id_chofer) references chofer(id)
);

insert into roles (nombre, descripcion) values 
('administrador', 'acceso total al sistema y configuraciones'),
('operativo', 'gestion de envios, guias y clientes');

-- usuarios (la contraseña es: password)
insert into usuarios (nombre, apellidos, correo, password, id_rol, estado) values 
('jhon', 'salcedo', 'jhon@gmail.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 1, 1),
('carlos', 'pérez', 'carlos@gmail.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 2, 1);

insert into clientes (nombre, apellido, documento, telefono, correo, direccion) values 
('carlos', 'ramirez', '76543210', '987654321', 'carlos@gmail.com', 'av. universitaria 123, huanuco');

insert into vehiculo (placa, modelo, disponible) values
('ABC-123', 'Volvo FH 460', 1),
('BCD-456', 'Hyundai HD78', 1),
('CDE-789', 'Isuzu NPR', 0);

insert into chofer (nombre, licencia) values
('Carlos Ramirez Tucto', 'Q45879632'),
('Luis Espinoza Rojas', 'Q71235498'),
('Miguel Huaman Soto', 'Q60984127');