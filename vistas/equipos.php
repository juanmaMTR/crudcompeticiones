<!DOCTYPE html>
<html lang="es" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <?php
      echo '<form action="equipos.php" method="POST">';
        if(!isset($_POST['enviar'])){
          echo '<input type="hidden" name="nombreCompeticion" value="'.$_GET['nombreCompeticion'].'" />';
        }
      echo '<input type="text" name="jugador[]" placeholder="Nombre Jugador..." />
        <input type="button" name="anadirJugador" value="+" onclick="anadirCampo()" />
        <input type="number" name="puntos" min="0" />
        <input type="submit" name="enviar" value="ENVIAR" />
      </form>';

      include_once '../php/procesos.php';
      $procesos = new Procesos();
      if(isset($_POST['enviar'])){
        $procesos->anadirEquipo($_POST);
      }
     ?>
  </body>
  <script src="../js/competiciones.js" charset="utf-8"></script>
</html>
