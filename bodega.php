<?php
require('config/conectar.php');
require('config/datos.php');

$d = new Datos();
$pdo = $d->conectar();
// Obtener todos los encargados
$encargados = $pdo->query("SELECT * FROM encargados")
                  ->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Bodega</title>
    <link rel="stylesheet" href="css/registroBodega.css">
</head>

<body>
      <div class="h1">
      <h1 class="titulo1">Registro de una Bodega</h1>
    </div>
    <form id="formBodega" class="insert" action="" method="post">
         <div id="resultado" class="resultado "></div>
        <label for="codigo_bodega" class="form-label">Código</label>
        <input type="text" name="codigo_bodega" class="codigo" id="codigo" maxlength="5" required>
       
        <label for="nombre_bodega" class="form-label-nombre">Nombre</label>
        <input type="text" name="nombre_bodega" class="nombre_bodega" id="nombre_bodega" maxlength="100">
       
        <label for="direccion_bodega" class="form-label-nombre">Dirección</label>
        <input type="text" name="direccion_bodega" class="direccion_bodega" id="direccion_bodega" maxlength="100" required>
       
        <label for="dotacion" class="form-label-nombre">Dotación</label>
        <input type="number" name="dotacion" class="dotacion" id="dotacion" maxlength="50" required>
       
        <label>Encargados</label>
        <select name="encargados[]" id="encargado_id" multiple required>

            <?php foreach ($encargados as $enc): ?>
                <option value="<?= $enc['id_encargado'] ?>">
                 <?= $enc['nombre'] ?> <?= $enc['primer_apellido'] ?>
                </option>
            <?php endforeach; ?>

        </select>
       <button type="submit">Guardar</button>
    </form><!--libreria jquery para el tema de manejo del dom-->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="js/validar.js"></script>
</body>

</html>