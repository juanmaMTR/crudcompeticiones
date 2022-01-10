<!DOCTYPE html>
<html lang="es" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <h1>Listado de equipos</h1>
    <?php
      include_once '../php/procesos.php';
      $procesos = new Procesos();
      
      if(isset($_GET['borrar'])){
        $procesos->borrarEquipo($_GET['borrar']);
      }
      $procesos->listadoEquipo();
     ?>
  </body>
</html>
