<?php
  class Procesos{
    function __construct(){
      include_once 'operacionesdb.php';
      $this->conexion = new OperacionesDB();
    }

//=========== COMPETICIONES ====================================================

    function listarCompeticiones(){
     $sql = 'select * from competicion';
     $resultado = $this->conexion->consultar($sql);
     $errno = $this->conexion->codigoError();
     if($errno){
       return $this->error($errno);
     }
     echo '<table>
     <tr>
       <th>COMPETICION</th>
       <th>DESCRIPCION</th>
     </tr>';
     for($i=0;$i<$resultado->num_rows;$i++){
       $fila = $this->conexion->extraerFila($resultado);
       echo '<tr>
         <td>'.$fila['nombreCompeticion'].'</td>
         <td>'.$fila['descripcion'].'</td>
         <td><a href="vistas/modificar.php?idCompeticion='.$fila['idCompeticion'].'">Modificar</a></td>
         <td><a href="index.php?borrar='.$fila['idCompeticion'].'">Borrar</a></td>
       </tr>';
     }
     echo '</table>';
     //$this->conexion->cerrarConexion();
   }
   function extraerDatos($idCompeticion){
     $sql = 'select nombreCompeticion, descripcion from competicion where idCompeticion='.$idCompeticion;
     $resultado = $this->conexion->consultar($sql);
     return $this->conexion->extraerFila($resultado);
   }
    function anadirCompeticion($datosCompeticion){
      $sql = 'insert into competicion(nombreCompeticion, descripcion) values ("'.$datosCompeticion['nombreCompeticion'].'","'.$datosCompeticion['descripcion'].'");';
      $resultado = $this->conexion->consultar($sql);
      $errno = $this->conexion->codigoError();
      if($errno){
        return $this->error($errno);
      }
      //$this->conexion->cerrarConexion();
      header('Location: vistas/equipos.php?nombreCompeticion='.$datosCompeticion['nombreCompeticion']);
    }
    function modificarCompeticion($datosCompeticion){
      $sql = 'update competicion set nombreCompeticion="'.$datosCompeticion['nombreCompeticion'].'", descripcion="'.$datosCompeticion['descripcion'].'" where idCompeticion='.$datosCompeticion['idCompeticion'];
      $resultado = $this->conexion->consultar($sql);
      $errno = $this->conexion->codigoError();
      if($errno){
        return $this->error($errno);
      }
      //$this->conexion->cerrarConexion();
      header('Location: ../index.php');
    }
    function borrarCompeticion($idCompeticion){
      $sql = 'delete from competicion where idCompeticion='.$idCompeticion;
      $resultado = $this->conexion->consultar($sql);
      $errno = $this->conexion->codigoError();
      if($errno){
        return $this->error($errno);
      }
      //$this->conexion->cerrarConexion();
      header('Location: index.php');
    }

//=========== EQUIPOS ==========================================================
    function anadirEquipo($datosEquipo){
      $sql = 'insert into equipos(puntos, idCompeticion) values ('.$datosEquipo['puntos'].','.$this->recuperarIdCompeticion($_POST['nombreCompeticion'])['idCompeticion'].')';
      $resultado = $this->conexion->consultar($sql);
      $sql = 'insert into alumno_equipo_competicion values ';
      foreach ($datosEquipo['jugador'] as $jugador) {
        $sql.='('.$this->recuperarIdAlumno($jugador)['idAlumno'].', '.$this->conexion->recuperarUltimoId().', '.$this->recuperarIdCompeticion($_POST['nombreCompeticion'])['idCompeticion'].'),';
      }
      $sql = substr($sql, 0, -1);
      echo $sql;
      $resultado = $this->conexion->consultar($sql);
      $errno = $this->conexion->codigoError();
      if($errno){
        return $this->error($errno);
      }
      //$this->conexion->cerrarConexion();
      header('Location: ../index.php');
    }
    function recuperarIdCompeticion($datosCompeticion){
      $sql = 'select idCompeticion from competicion where nombreCompeticion="'.$datosCompeticion.'"';
      $resultado = $this->conexion->consultar($sql);
      return $this->conexion->extraerFila($resultado);
    }
    function recuperarIdAlumno($datosJugadores){
      $sql = 'select idAlumno from alumno where nombre="'.$datosJugadores.'"';
      $resultado = $this->conexion->consultar($sql);
      return $this->conexion->extraerFila($resultado);
    }
    function listadoEquipo(){
      $sql= 'select * from equipos';
      $resultado = $this->conexion->consultar($sql);
      $errno = $this->conexion->codigoError();
      if($errno){
        return $this->error($errno);
      }
      echo '<table>
     <tr>
       <th>NOMBRE EQUIPO</th>
       <th>PUNTOS</th>
       <th>IDCOMPETICION</th>
     </tr>';
     for($i=0;$i<$resultado->num_rows;$i++){
      $fila = $this->conexion->extraerFila($resultado);
      echo '<tr>
        <td>'.$fila['nombreEquipo'].'</td>
        <td>'.$fila['puntos'].'</td>
        <td>'.$fila['idCompeticion'].'</td>
        <td><a href="modificar.php?idCompeticion='.$fila['idCompeticion'].'">Modificar</a></td>
        <td><a href="listadoequipos.php?borrar='.$fila['idEquipo'].'">Borrar</a></td>
      </tr>';
      }
      echo '</table>';
    }
    function borrarEquipo($idEquipo){
      $sql = 'delete from equipos where idEquipo='.$idEquipo;
      $resultado = $this->conexion->consultar($sql);
      $errno = $this->conexion->codigoError();
      if($errno){
        return $this->error($errno);
      }
      //$this->conexion->cerrarConexion();
      header('Location: listadoequipos.php');
    }
    function error($errno){
      switch ($errno) {
        default:
          echo $errno.' Ha ocurrido un error inesperado';
          break;
      }
    }
  }
