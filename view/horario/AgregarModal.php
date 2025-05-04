<!-- Formulario para agregar horarios específicos -->
<form method="POST" action="horario.php?op=insertar" autocomplete="off" enctype="multipart/form-data">
    <div class="row">
        <div class="col-md-6 pr-0">
            <div class="form-group form-group-default">
                <label>Día</label>
                <select name="dia" class="form-control" required>
                    <option value="Lunes">Lunes</option>
                    <option value="Martes">Martes</option>
                    <option value="Miércoles">Miércoles</option>
                    <option value="Jueves">Jueves</option>
                    <option value="Viernes">Viernes</option>
                    <option value="Sábado">Sábado</option>
                    <option value="Domingo">Domingo</option>
                </select>
            </div>
        </div>
        
        <div class="col-md-3">
            <div class="form-group form-group-default">
                <label>Hora Inicio</label>
                <input type="time" name="hora_inicio" required class="form-control">
            </div>
        </div>
        
        <div class="col-md-3">
            <div class="form-group form-group-default">
                <label>Hora Fin</label>
                <input type="time" name="hora_fin" required class="form-control">
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group form-group-default">
                <label>Médicos</label>
                <select class="form-control" id="doctor" required name="coddoc">
                    <?php
                    // Conectar a la base de datos
                    $conn = new mysqli("localhost", "root", "", "trabajo_grado");

                    // Verificar conexión
                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }

                    // Consulta para obtener doctores activos
                    $sql = "SELECT coddoc, nomdoc FROM doctor WHERE estado = 1";
                    $result = $conn->query($sql);

                    // Verificar si hay resultados
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<option value='" . $row['coddoc'] . "'>" . $row['nomdoc'] . "</option>";
                        }
                    } else {
                        echo "<option value=''>No hay doctores disponibles</option>";
                    }

                    // Cerrar conexión
                    $conn->close();
                    ?>
                </select>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
        <button type="submit" name="agregar" class="btn btn-primary">Guardar Registro</button>
    </div>
</form>
