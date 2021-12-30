<?php
  class Procesos{
    function __construct(){
      include_once 'operacionesdb.php';
      $this->conexion = new OperacionesDB();
    }
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
      header('Location: index.php');
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
    function error($errno){
      switch ($errno) {
        default:
          echo $errno.' Ha ocurrido un error inesperado';
          break;
      }
    }
  }
