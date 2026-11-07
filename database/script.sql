create database if not exists kargotrack;
use kargotrack;

create table if not exists ciudades (
    id_ciudad int not null auto_increment primary key,
    nombre varchar(100) not null,
    deparetamento varchar(100) not null, 
);

