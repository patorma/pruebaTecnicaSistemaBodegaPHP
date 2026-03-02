<?php
   require('config/conectar.php');
   require('config/datos.php');
   
  
   $d = new Datos();

  
  $filtro = "";

  //se valida que este el parametro de estado en la consulta para que se haga el filtro
  //$filtro se agrega en la consulta sql para mostrar los datos como un filtro
if (isset($_GET['estado']) && $_GET['estado'] != "") {
    $estado = $_GET['estado'];
    $filtro = " WHERE b.estado = '$estado' ";
}

$sql = "SELECT 
    b.id_bodega as id_bodega,
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
$filtro
ORDER BY b.fecha_creacion DESC";

$datos = $d->getDatos($sql);
//$filtro es la bandera para mostrar en el select de filtrar
// ambos, activada o desactivada lo que representa los valores
// del estado de la bodega  
 //print_r($datos);
    // $filtroEstado = $d->getDatos("SELECT ");
    //  print_r($filtroEstado);
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
               <h1>Registros de Bodegas</h1> 
            </div>
            <div>
                <p>
                    <a href="bodega.php" class="crear">Crear Bodega</a>
                </p>

                <form method="GET">
    <label class="titulo-filtro"><strong>Filtrar por Estado:</strong></label>
    <select class="select" name="estado">
        <option value="">Ambos</option>
        <option value="activada" 
            <?= (isset($_GET['estado']) && $_GET['estado']=='activada')?'selected':'' ?>>
            Activada
        </option>
        <option value="desactivada" 
            <?= (isset($_GET['estado']) && $_GET['estado']=='desactivada')?'selected':'' ?>>
            Desactivada
        </option>
    </select>
    <button  class="filtrar" type="submit">Filtrar</button>
</form>
                <table>
                    <thead>
                        <tr>
                           <th>id</th>
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
                             <td><?php echo $dato['id_bodega'] ?></td>
                             <td><?php echo $dato['codigo_bodega'] ?></td>
                             <td><?php echo $dato['nombre_bodega'] ?></td>
                             <td><?php echo $dato['direccion_bodega'] ?></td>
                             <td><?php echo $dato['dotacion'] ?></td>
                             <td><?php echo $dato['encargado'] ?></td>
                             <td><?php echo $dato['fecha_creacion'] ?></td>
                             <td><?php echo $dato['estado'] ?></td>
                             <td>
                             <a href="editarBodega.php?id=<?=$dato  ['id_bodega']?>" class="editar">
                                Editar
                                </a>
                                <a href="#" class="eliminar" data-id="<?=$dato['id_bodega']?>">Eliminar</a>
                          
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
    
    <script src="js/eliminar.js"></script>
</body>
</html>