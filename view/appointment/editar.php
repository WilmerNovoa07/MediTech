<!-- Modal para editar fecha y hora -->
<div class="modal fade" id="editRowModal<?php echo $va['codcit']; ?>" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Editar Cita #<?php echo $va['codcit']; ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="../view/appointment/obtener.php?id=<?php echo $va['codcit']; ?>">
                <div class="modal-body">
                    <div class="form-group">
                        <label>Fecha</label>
                        <input type="date" class="form-control" name="dates" value="<?php echo $va['dates']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Hora</label>
                        <input type="time" class="form-control" name="hour" value="<?php echo $va['hour']; ?>" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    <button type="submit" name="editar" class="btn btn-primary">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- Delete -->
<div class="modal fade" id="deleteRowModal<?php echo $va['codcit']; ?>" tabindex="-1" role="dialog"
	aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<center>
					<h4 class="modal-title" id="myModalLabel"></h4>
				</center>
			</div>
			<div class="modal-body">
				<p class="text-center">¿Esta seguro de borrar está cita?</p>
				<h2 class="text-center">
					<?php echo $va['dates']; ?>
				</h2>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal"><span
						class="glyphicon glyphicon-remove"></span> Cancelar</button>
				<a href="../view/appointment/BorrarRegistro.php?codcit=<?php echo $va['codcit']; ?>"
					class="btn btn-danger"><span class="fa fa-times"></span> Eliminar</a>
			</div>

		</div>
	</div>
</div>

<!-- Delete -->
<div class="modal fade" id="updateRowModal<?php echo $va['codcit']; ?>" tabindex="-1" role="dialog"
	aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<center>
					<h4 class="modal-title" id="myModalLabel"></h4>
				</center>
			</div>
			<div class="modal-body">
				<p class="text-center">¿Esta seguro activar el estado?</p>
				<h2 class="text-center">
					<?php echo $va['estado']; ?>
				</h2>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal"><span
						class="glyphicon glyphicon-remove"></span> Cancelar</button>

				<a href="../view/appointment/desactivar.php?codcit=<?php echo $va['codcit']; ?>"
					class="btn btn-success"><span class="fa fa-times"></span> Activar</a>
			</div>

		</div>
	</div>
</div>