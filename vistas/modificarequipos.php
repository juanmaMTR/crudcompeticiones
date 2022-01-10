<!DOCTYPE html>
<html lang="es" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <?php
      include_once '../php/procesos.php';
      $procesos = new Procesos();
      if(isset($_POST['enviar'])){
        $procesos->modificarCompeticion($_POST);
      }else{
        echo '<form action="modificar.php" method="POST">
            <input type="hidden" name="idCompeticion" value="'.$_GET['idCompeticion'].'" />
            <input type="text" name="nombreCompeticion" value="'.$procesos->extraerDatos($_GET['idCompeticion'])['nombreCompeticion'].'" placeholder="Nombre Competición..." />
            <textarea name="descripcion" maxlength="60" placeholder="Descripción...">'.$procesos->extraerDatos($_GET['idCompeticion'])['descripcion'].'</textarea>
            <input type="submit" name="enviar" value="ENVIAR" />
          </form>';
      }
     ?>
  </body>
</html>
