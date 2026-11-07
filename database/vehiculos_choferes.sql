create database if not exists kargotrack;
use kargotrack;

create table if not exists vehiculo (
  id int not null auto_increment,
  placa varchar(10) not null,
  modelo varchar(60) not null,
  disponible tinyint(1) not null default 1,
  primary key (id),
  unique (placa)
);

create table if not exists chofer (
  id int not null auto_increment,
  nombre varchar(100) not null,
  licencia varchar(15) not null,
  primary key (id),
  unique (licencia)
);

insert into vehiculo (placa, modelo, disponible) values
('ABC-123', 'Volvo FH 460', 1),
('BCD-456', 'Hyundai HD78', 1),
('CDE-789', 'Isuzu NPR', 0);

insert into chofer (nombre, licencia) values
('Carlos Ramirez Tucto', 'Q45879632'),
('Luis Espinoza Rojas', 'Q71235498'),
('Miguel Huaman Soto', 'Q60984127');
