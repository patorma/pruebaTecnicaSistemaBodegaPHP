<?php
require('config/conectar.php');
require('config/datos.php');

$d = new Datos();
$pdo = $d->conectar();

if(!isset($_GET['id']) || !is_numeric($_GET['id'])){
    header("Location: index.php");
    exit();
}

$id = $_GET['id'];

// Obtener bodega
$stmt = $pdo->prepare("SELECT * FROM bodegas WHERE id_bodega=?");
$stmt->execute([$id]);
$bodega = $stmt->fetch(PDO::FETCH_ASSOC);

if(!$bodega){
    header("Location: index.php");
    exit();
}

// Obtener encargados seleccionados
$stmt = $pdo->prepare("SELECT encargado_id FROM bodega_encargado WHERE bodega_id=?");
$stmt->execute([$id]);
$encSeleccionados = $stmt->fetchAll(PDO::FETCH_COLUMN);

// Obtener todos los encargados
$encargados = $pdo->query("SELECT * FROM encargados")->fetchAll(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Datos de bodega</title>
    <link rel="stylesheet" href="css/editarBodega.css">
</head>
<body>
    <h1 class="titulo1">Editar una Bodega</h1>
   <form method="POST" action="actualizar_bodega.php" class="insert" >

<input type="hidden" name="id_bodega" value="<?=$bodega['id_bodega']?>">

<label>Código</label>
<input type="text" value="<?=$bodega['codigo_bodega']?>" disabled >

<label>Nombre</label>
<input type="text" name="nombre_bodega" 
       value="<?=$bodega['nombre_bodega']?>" maxlength="100">

<label>Dirección</label>
<input type="text" name="direccion_bodega"
       value="<?=$bodega['direccion_bodega']?>">

<label>Dotación</label>
<input type="number" name="dotacion"
       value="<?=$bodega['dotacion']?>" min="1">

<label>Estado</label>
<select name="estado">
    <option value="activada" 
        <?=$bodega['estado']=='Activada'?'selected':''?>>
        Activada
    </option>
    <option value="desactivada"
        <?=$bodega['estado']=='desactivada'?'selected':''?>>
        Desactivada
    </option>
</select>

<label>Encargados</label>
<select name="encargados[]" multiple>

<?php foreach($encargados as $enc): ?>
<option value="<?=$enc['id_encargado']?>"
<?= in_array($enc['id_encargado'],$encSeleccionados)?'selected':'' ?>>
<?=$enc['nombre']?> <?=$enc['primer_apellido']?>
</option>
<?php endforeach; ?>

</select>

<button type="submit">Actualizar</button>

</form>
</body>
</html>