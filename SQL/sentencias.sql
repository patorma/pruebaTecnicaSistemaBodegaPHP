CREATE TYPE estado_bodega AS ENUM ('activada','desactivada');

CREATE TABLE  IF NOT EXISTS bodegas(

  id_bodega SERIAL PRIMARY KEY NOT NULL,
  codigo_bodega VARCHAR(5) UNIQUE NOT NULL,
  nombre_bodega VARCHAR(100) NOT NULL,
  direccion_bodega VARCHAR(1000) NOT NULL,
  dotacion INTEGER NOT NULL,
  estado estado_bodega DEFAULT 'activada',
  fecha_creacion  TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS encargados(

    id_encargado SERIAL PRIMARY KEY NOT NULL,
    rut_encargado VARCHAR(10) NOT NULL,
    nombre VARCHAR(150) NOT NULL,
    primer_apellido VARCHAR(150) NOT NULL,
    segundo_apellido VARCHAR(150) NOT NULL,
    direccion_encargado VARCHAR(100) NOT NULL,
    telefono VARCHAR(45) NOT NULL
    -- bodega_id INTEGER NOT NULL,

    -- CONSTRAINT encargados_bodega_id_fk FOREIGN KEY (bodega_id)
    --            REFERENCES bodegas (id_bodega)
    --            ON UPDATE RESTRICT
    --            ON DELETE RESTRICT
);

CREATE TABLE bodega_encargado (
    id SERIAL PRIMARY KEY,
    bodega_id INTEGER NOT NULL,
    encargado_id INTEGER NOT NULL,

    CONSTRAINT fk_bodega
        FOREIGN KEY (bodega_id)
        REFERENCES bodegas(id_bodega)
        ON DELETE CASCADE,--se elimina sus asociaciones pero no los encargados

    CONSTRAINT fk_encargado
        FOREIGN KEY (encargado_id)
        REFERENCES encargados(id_encargado)
        ON DELETE RESTRICT, --no se elimina un encargado si esta asociado a una bodega

    CONSTRAINT unique_bodega_encargado
        UNIQUE (bodega_id, encargado_id)
);

INSERT INTO bodegas (codigo_bodega, nombre_bodega,direccion_bodega,dotacion)
             VALUES('AS34D','Bodega 1','San Martin N°356',45);
			 
ALTER TABLE encargados ALTER COLUMN rut_encargado TYPE VARCHAR(10);

INSERT INTO encargados  (rut_encargado,nombre,primer_apellido,segundo_apellido,direccion_encargado,telefono)
VALUES ('10980333-2','Patricio','Contreras','Ortiz','Los Aromos N°125','(9)2569456');

INSERT INTO bodegas (codigo_bodega, nombre_bodega,direccion_bodega,dotacion)
             VALUES('TGH9B','Bodega 2','Villarica N°252',12);

INSERT INTO bodegas (codigo_bodega, nombre_bodega,direccion_bodega,dotacion)
             VALUES('XS349','Bodega 3','Alameda N°25',4);

select * from bodegas;
			 
INSERT INTO encargados  (rut_encargado,nombre,primer_apellido,segundo_apellido,direccion_encargado,telefono)
VALUES ('20256741-k','Raul','Cifuentes','Torres','San Martin N°12','(9)12456987');

INSERT INTO encargados  (rut_encargado,nombre,primer_apellido,segundo_apellido,direccion_encargado,telefono)
VALUES ('13256741-3','Leslie','Carrasco','Soto','Los Acacios N°120','(9)12456987');

SELECT 
    b.codigo_bodega,
    b.nombre_bodega,
    b.direccion_bodega,
    b.dotacion,
    CONCAT(e.nombre, ' ', e.primer_apellido, ' ', e.segundo_apellido) AS encargado,
    b.fecha_creacion,
    b.estado
FROM bodegas b
INNER JOIN bodega_encargado be ON b.id_bodega = be.bodega_id
INNER JOIN encargados e ON be.encargado_id = e.id_encargado
ORDER BY b.fecha_creacion DESC;