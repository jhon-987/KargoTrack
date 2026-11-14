
CREATE DATABASE  kargotrack;
USE kargotrack;

CREATE TABLE ciudades (
    id_ciudad INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    departamento VARCHAR(100) NOT NULL
);

CREATE TABLE envios (
    id_envio INT AUTO_INCREMENT PRIMARY KEY,
    id_encomienda INT NOT NULL UNIQUE,
    id_ciudad_origen INT NOT NULL,
    id_ciudad_destino INT NOT NULL,
    id_vehiculo INT NOT NULL,
    id_chofer INT NOT NULL,
    fecha_salida DATE NOT NULL,
    fecha_llegada DATE NOT NULL,

    CONSTRAINT fk_envio_ciudad_origen
    FOREIGN KEY (id_ciudad_origen)
    REFERENCES ciudades(id_ciudad),

    CONSTRAINT fk_envio_ciudad_destino
    FOREIGN KEY (id_ciudad_destino)
    REFERENCES ciudades(id_ciudad)
);
