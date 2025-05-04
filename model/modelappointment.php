<?php
class Modelo{

  private $appointment;
  private $db;
  public $codcit;
  public $dates;
  public $hour;
  public $codpaci;
  public $coddoc;
  public $codespe;
  public $estado;
  
  
  

  public function __construct(){
      $this->appointment=array();
      $this->db=new PDO('mysql:host=localhost;dbname=trabajo_grado',"root","");
  }
  public function mostrar($tabla,$condicion){
      $consulta="SELECT appointment.codcit, appointment.dates, appointment.hour,customers.nombrep,doctor.nomdoc, specialty.nombrees, appointment.estado, appointment.fecha_create FROM appointment INNER JOIN customers ON appointment.codpaci = customers.codpaci INNER JOIN doctor ON appointment.coddoc = doctor.coddoc INNER JOIN specialty ON appointment.codespe = specialty.codespe";

      $resultado=$this->db->query($consulta);
      while ($tabla=$resultado->fetchAll(PDO::FETCH_ASSOC)) {
          $this->appointment[]=$tabla;
      }
      return $this->appointment;
    }
    public function  insertar(Modelo $data){
    try {
      $query="INSERT INTO appointment (dates,hour,codpaci,coddoc,codespe,estado)VALUES(?,?,?,?,?,?)";

      $this->db->prepare($query)->execute(array($data->dates,$data->hour,$data->codpaci,
	  $data->coddoc,$data->codespe,$data->estado));

    }catch (Exception $e) {

      die($e->getMessage());
    }
    }
    public function llenarespecialidad(){



    try{
      $consulta="SELECT * FROM specialty";
      $smt=$this->db->prepare($consulta);
      $smt->execute();
      return $smt->fetchAll(PDO::FETCH_OBJ);


    }catch(Exception $e){


    }

    }
    public function verificarDisponibilidadHorario($coddoc, $dia, $hora) {
      try {
          // 1. Verificar si el horario está ocupado
          $sqlOcupado = "SELECT COUNT(*) as ocupado FROM appointment 
                        WHERE coddoc = ? AND dates = ? AND hour = ?";
          $stmt = $this->db->prepare($sqlOcupado);
          $stmt->execute([$coddoc, date('Y-m-d', strtotime($dia)), $hora]);
          $result = $stmt->fetch(PDO::FETCH_ASSOC);
          
          if ($result['ocupado'] > 0) {
              // 2. Si está ocupado, buscar horarios disponibles alternativos
              $sqlDisponibles = "SELECT hora_inicio, hora_fin FROM horario 
                               WHERE coddoc = ? AND dia = ? 
                               AND hora_inicio NOT IN (
                                   SELECT hour FROM appointment 
                                   WHERE coddoc = ? AND dates = ?
                               )";
              $stmt = $this->db->prepare($sqlDisponibles);
              $stmt->execute([$coddoc, $dia, $coddoc, date('Y-m-d', strtotime($dia))]);
              
              return [
                  'disponible' => false,
                  'horarios_disponibles' => $stmt->fetchAll(PDO::FETCH_ASSOC)
              ];
          }
          
          return ['disponible' => true];
          
      } catch (PDOException $e) {
          error_log("Error en verificarDisponibilidadHorario: " . $e->getMessage());
          return ['disponible' => false];
      }
  }
  
  public function verificarDisponibilidadAdmin($coddoc, $fecha, $hora) {
    try {
        // Verificar si ya existe cita
        $sql = "SELECT COUNT(*) as total FROM appointment 
               WHERE coddoc = ? AND dates = ? AND hour = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$coddoc, $fecha, $hora]);
        $existe = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($existe['total'] > 0) {
            // Buscar horarios disponibles alternativos
            $sqlAlternativos = "SELECT DISTINCT hour FROM appointment 
                               WHERE coddoc = ? AND dates = ? 
                               AND hour NOT IN (
                                   SELECT hour FROM appointment 
                                   WHERE coddoc = ? AND dates = ? AND hour = ?
                               )
                               ORDER BY hour";
            $stmt = $this->db->prepare($sqlAlternativos);
            $stmt->execute([$coddoc, $fecha, $coddoc, $fecha, $hora]);
            $alternativos = $stmt->fetchAll(PDO::FETCH_COLUMN);

            return [
                'disponible' => false,
                'alternativos' => $alternativos
            ];
        }

        return ['disponible' => true];
        
    } catch (PDOException $e) {
        error_log("Error en verificarDisponibilidadAdmin: " . $e->getMessage());
        return ['disponible' => false, 'alternativos' => []];
    }
}
  
  
  

	
	public function llenardoctor(){



    try{
      $consulta="SELECT * FROM doctor";
      $smt=$this->db->prepare($consulta);
      $smt->execute();
      return $smt->fetchAll(PDO::FETCH_OBJ);


    }catch(Exception $e){


    }

    }
    public function lastInsertId() {
      return $this->db->lastInsertId();
  }
   
	
	
  public function actualizar($tabla, $data, $condicion) {
    $consulta = "UPDATE $tabla SET $data WHERE $condicion";
    $resultado = $this->db->query($consulta);
    return $resultado ? true : false;
    }
  public function eliminar($tabla,$condicion){
      $consulta="DELETE FROM $tabla WHERE $condicion";
      $resultado=$this->db->query($consulta);
      if($resultado){
          return true;
      }else{
          return false;
      }
  }
}

 ?>
