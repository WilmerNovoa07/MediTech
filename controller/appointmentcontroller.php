<?php
require_once '../model/modelappointment.php';
class appointmentcontroller{

    public $model;
  public function __construct() {
        $this->model=new Modelo();
    }
    function mostrar(){
        $appointment=new Modelo();

        $dato=$appointment->mostrar("appointment", "1");
        require_once '../view/appointment/mostrar.php';
    }


    //INSERTAR
  public  function nuevo(){
        require_once '../view/appointment/AgregarModal.php';
    }
    
    //aca ando haciendo
    public function recibir() {
        // Iniciar sesión para SweetAlert
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    
        // Conexión a la base de datos
        include "../config/conex.php";
    
        try {
            $coddoc = $_POST['coddoc'];
            $dates = $_POST['dates'];
            $hour = $_POST['hour'];
            $codpaci = $_POST['codpaci'];
            $codespe = $_POST['codespe'];
            $estado = $_POST['estado'] ?? 'pendiente';
    
            // 1. Primero verificar disponibilidad
            $sql_verificar = "SELECT COUNT(*) as total FROM appointment 
                             WHERE coddoc = ? AND dates = ? AND hour = ?";
            $stmt = $conex->prepare($sql_verificar);
            $stmt->bind_param("sss", $coddoc, $dates, $hour);
            $stmt->execute();
            $result = $stmt->get_result()->fetch_assoc();
    
            if ($result['total'] > 0) {
                // Buscar horarios disponibles alternativos
                $sql_alternativos = "SELECT hour FROM appointment 
                                   WHERE coddoc = ? AND dates = ? AND hour != ?
                                   ORDER BY hour";
                $stmt = $conex->prepare($sql_alternativos);
                $stmt->bind_param("sss", $coddoc, $dates, $hour);
                $stmt->execute();
                $alternativos = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
                
                // Preparar mensaje con horarios alternativos
                $horarios = array_column($alternativos, 'hour');
                $mensaje = "Ya existe una cita para el Dr. en esta fecha y hora.";
                
                if (!empty($horarios)) {
                    $mensaje .= "\n\nHorarios disponibles ese día: " . implode(", ", $horarios);
                }
    
                $_SESSION['swal'] = [
                    'icon' => 'error',
                    'title' => 'Cita no disponible',
                    'text' => $mensaje,
                    'footer' => 'Intente con otro horario'
                ];
                
                header("Location: appointment.php");
                exit();
            }
    
            // 2. Si está disponible, insertar
            $sql_insertar = "INSERT INTO appointment (dates, hour, codpaci, coddoc, codespe, estado) 
                            VALUES (?, ?, ?, ?, ?, ?)";
            $stmt = $conex->prepare($sql_insertar);
            $stmt->bind_param("ssssss", $dates, $hour, $codpaci, $coddoc, $codespe, $estado);
            
            if ($stmt->execute()) {
                $_SESSION['swal'] = [
                    'icon' => 'success',
                    'title' => '¡Éxito!',
                    'text' => 'Cita agendada correctamente',
                    'timer' => 2000,
                    'showConfirmButton' => false
                ];
            } else {
                throw new Exception("Error al insertar la cita");
            }
    
        } catch (mysqli_sql_exception $e) {
            if (strpos($e->getMessage(), 'Duplicate entry') !== false) {
                echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>';
                echo '<script>
                document.addEventListener("DOMContentLoaded", function() {
                    Swal.fire({
                        icon: "error",
                        title: "Cita duplicada",
                        text: "El horario seleccionado ya está ocupado",
                        confirmButtonText: "Entendido"
                    });
                });
                </script>';
            }
            exit(); // Detener ejecución
        }
    
        
    

            //ELIMINAR
            function eliminar(){
                $codcit=$_REQUEST['codcit'];
                $condicion="codcit=$codcit";
                $appointment=new Modelo();
                $dato=$appointment->eliminar("appointment", $condicion);
                header("location:appointment.php");
            }

    }
    public function actualizar() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    
        if(isset($_POST['editar'])){
            include "../config/conex.php";
            
            try {
                $codcit = $_POST['codcit'];
                $coddoc = $_POST['coddoc'];
                $dates = $_POST['dates'];
                $hour = $_POST['hour'];
                
                // 1. Verificar disponibilidad (excluyendo la cita actual)
                $sql_verificar = "SELECT COUNT(*) as total FROM appointment 
                                WHERE coddoc = ? AND dates = ? AND hour = ? AND codcit != ?";
                $stmt = $conex->prepare($sql_verificar);
                $stmt->bind_param("ssss", $coddoc, $dates, $hour, $codcit);
                $stmt->execute();
                $result = $stmt->get_result()->fetch_assoc();
    
                if ($result['total'] > 0) {
                    // Buscar horarios disponibles alternativos
                    $sql_alternativos = "SELECT hour FROM appointment 
                                       WHERE coddoc = ? AND dates = ? AND hour != ? AND codcit != ?
                                       ORDER BY hour";
                    $stmt = $conex->prepare($sql_alternativos);
                    $stmt->bind_param("ssss", $coddoc, $dates, $hour, $codcit);
                    $stmt->execute();
                    $alternativos = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
                    
                    // Preparar mensaje con horarios alternativos
                    $horarios = array_column($alternativos, 'hour');
                    $mensaje = "Ya existe otra cita para este doctor en la fecha y hora seleccionada.";
                    
                    if (!empty($horarios)) {
                        $mensaje .= "\n\nHorarios disponibles ese día: " . implode(", ", $horarios);
                    }
    
                    $_SESSION['swal'] = [
                        'icon' => 'error',
                        'title' => 'Horario no disponible',
                        'text' => $mensaje,
                        'footer' => 'Intente con otro horario'
                    ];
                    
                    header("Location: ../view/appointment/mostrar.php");
                    exit();
                }
    
                // 2. Si está disponible, actualizar
                $sql_actualizar = "UPDATE appointment SET 
                                 dates = ?, 
                                 hour = ? 
                                 WHERE codcit = ?";
                $stmt = $conex->prepare($sql_actualizar);
                $stmt->bind_param("sss", $dates, $hour, $codcit);
                
                if ($stmt->execute()) {
                    $_SESSION['swal'] = [
                        'icon' => 'success',
                        'title' => '¡Éxito!',
                        'text' => 'Cita actualizada correctamente',
                        'timer' => 2000,
                        'showConfirmButton' => false
                    ];
                } else {
                    throw new Exception("Error al actualizar la cita");
                }
    
                header("Location: ../view/appointment/mostrar.php");
                exit();
    
            } catch (mysqli_sql_exception $e) {
                $_SESSION['swal'] = [
                    'icon' => 'error',
                    'title' => 'Error',
                    'text' => 'Ocurrió un error al actualizar la cita: ' . $e->getMessage()
                ];
                header("Location: ../view/appointment/mostrar.php");
                exit();
            }
        }
    }
}