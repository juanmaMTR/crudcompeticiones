<!DOCTYPE html>
<html lang="es" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <form action="index.php" method="POST">
      <input type="text" name="nombreCompeticion" placeholder="Nombre Competición..." /><br />
      <textarea name="descripcion" maxlength="60" placeholder="Descripción..."></textarea>
      <input type="submit" name="enviar" value="ENVIAR" />
    </form>
    <?php
      include_once 'php/procesos.php';
      $procesos = new Procesos();
      if(isset($_POST['enviar'])){
        $procesos->anadirCompeticion($_POST);
      }
      if(isset($_GET['borrar'])){
        $procesos->borrarCompeticion($_GET['borrar']);
      }
      $procesos->listarCompeticiones();
     ?>
  </body>
</html>
