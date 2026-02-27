<?php
   require('config/conectar.php');
   require('config/datos.php');
   
   $d = new Datos();

   $datos = $d->getDatos("SELECT  (b.id_bodega) as id,(b.codigo_bodega) as codigo, (b.nombre_bodega) as bodega,
         (b.direccion_bodega) as direccion, (b.dotacion)as dotacion, 
		 CONCAT_WS(' ', e.nombre, e.primer_apellido, e.segundo_apellido) AS encargado,
		 (b.fecha_creacion) as fecha_registro, (b.estado) as estado
FROM encargados e INNER JOIN bodegas b ON (e.bodega_id = b.id_bodega);");
 //print_r($datos);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de bodegas</title>
    <link rel="stylesheet" href="css/bodegas.css">
</head>
<body>
    <div>
        <div>
            <div>
                Registros de Bodegas
            </div>
            <div>
                <p>
                    <a href="/bodega.php">Crear Bodega</a>
                </p>
                <table>
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Código</th>
                            <th>Bodega</th>
                            <th>Dirección</th>
                            <th>Dotación</th>
                            <th>Encargado</th>
                            <th>Fecha de Registro</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            foreach( $datos as $dato){
                        ?> 
                        <tr>
                             <td><?php echo $dato['id'] ?></td>
                             <td><?php echo $dato['codigo'] ?></td>
                             <td><?php echo $dato['bodega'] ?></td>
                             <td><?php echo $dato['direccion'] ?></td>
                             <td><?php echo $dato['dotacion'] ?></td>
                             <td><?php echo $dato['encargado'] ?></td>
                             <td><?php echo $dato['fecha_registro'] ?></td>
                             <td><?php echo $dato['estado'] ?></td>
                             <td>
                                <a href="" class="editar">Editar</a>
                                <a href="" class="eliminar">Eliminar</a>
                             </td>
                        </tr>
                        <?php
                            } 
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
</body>
</html>