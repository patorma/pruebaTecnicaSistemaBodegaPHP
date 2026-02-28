<?php
   require('config/conectar.php');
   require('config/datos.php');
   
   $d = new Datos();

   $datos = $d->getDatos("SELECT 
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
ORDER BY b.fecha_creacion DESC;");
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
                             
                             <td><?php echo $dato['codigo_bodega'] ?></td>
                             <td><?php echo $dato['nombre_bodega'] ?></td>
                             <td><?php echo $dato['direccion_bodega'] ?></td>
                             <td><?php echo $dato['dotacion'] ?></td>
                             <td><?php echo $dato['encargado'] ?></td>
                             <td><?php echo $dato['fecha_creacion'] ?></td>
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