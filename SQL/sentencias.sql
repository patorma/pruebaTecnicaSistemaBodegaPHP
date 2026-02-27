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
    rut_encargado VARCHAR(45) NOT NULL,
    nombre VARCHAR(150) NOT NULL,
    primer_apellido VARCHAR(150) NOT NULL,
    segundo_apellido VARCHAR(150) NOT NULL,
    direccion_encargado VARCHAR(100) NOT NULL,
    telefono VARCHAR(45) NOT NULL,
    bodega_id INTEGER NOT NULL,

    CONSTRAINT encargados_bodega_id_fk FOREIGN KEY (bodega_id)
               REFERENCES bodegas (id_bodega)
               ON UPDATE RESTRICT
               ON DELETE RESTRICT
);

INSERT INTO bodegas (codigo_bodega, nombre_bodega,direccion_bodega,dotacion)
             VALUES('AS34D','Bodega 1','San Martin N°356',45);
INSERT INTO bodegas (codigo_bodega, nombre_bodega,direccion_bodega,dotacion)
             VALUES('TGH9B','Bodega 2','Villarica N°252',12);


INSERT INTO bodegas (codigo_bodega, nombre_bodega,direccion_bodega,dotacion)
             VALUES('XS349','Bodega 3','Alameda N°25',4);

ALTER TABLE encargados ALTER COLUMN rut_encargado TYPE VARCHAR(10);

INSERT INTO encargados  (rut_encargado,nombre,primer_apellido,segundo_apellido,direccion_encargado,telefono,bodega_id)
VALUES ('10980333-2','Patricio','Contreras','Ortiz','Los Aromos N°125','(9)2569456',2);

INSERT INTO encargados  (rut_encargado,nombre,primer_apellido,segundo_apellido,direccion_encargado,telefono,bodega_id)
VALUES ('20256741-k','Raul','Cifuentes','Torres','San Martin N°12','(9)12456987',2);

INSERT INTO encargados  (rut_encargado,nombre,primer_apellido,segundo_apellido,direccion_encargado,telefono,bodega_id)
VALUES ('13256741-3','Leslie','Carrasco','Soto','Los Acacios N°120','(9)12456987',5);

SELECT  (b.id_bodega) as id,(b.codigo_bodega) as codigo, (b.nombre_bodega) as bodega,
         (b.direccion_bodega) as direccion, (b.dotacion)as dotacion, 
		 CONCAT_WS(' ', e.nombre, e.primer_apellido, e.segundo_apellido) AS encargado,
		 (b.fecha_creacion) as fecha_registro, (b.estado) as estado
FROM encargados e INNER JOIN bodegas b ON (e.bodega_id = b.id_bodega); 