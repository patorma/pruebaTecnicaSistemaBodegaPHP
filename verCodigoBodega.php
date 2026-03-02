<?php
require ('config/conectar.php');
require ('config/datos.php');

$d = new Datos();
//se valida que venga el código y no este vacio
if (isset($_POST['codigo']) && !empty($_POST['codigo'])){
    $codigo = $_POST['codigo'];
      $dato = $d->getDato("SELECT id_bodega FROM bodegas WHERE codigo_bodega = ?", [$codigo]);
   if ($dato) {
        echo "<span style='color:red;'>El código <strong>$codigo</strong> ya existe.</span>";
    } else {
        echo "<span style='color:green;'>El código está disponible.</span>";
    }

}else {
    echo "<span style='color:orange;'>Código no recibido.</span>";
}
