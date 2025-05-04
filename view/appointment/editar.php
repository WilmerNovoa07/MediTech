<!-- Modal-edit -->
<div class="modal fade" id="editRowModal<?php echo $va['codcit']; ?>" aria-labelledby="myModalLabel" tabindex="-1"
	role="dialog" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header no-bd">
				<h5 class="modal-title">
					<span class="fw-mediumbold">
						Editar</span>

				</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">


				<form method="get" action="../view/appointment/obtenerclase.php">

					<input class="form-control" name="codcit" type="hidden" value="<?php echo $va->codcit; ?>">
					<div class="row">
						<div class="col-sm-12">
							<div class="form-group form-group-default">
								<label>Fecha</label>

								<input type="date" class="form-control" name="dates"
									value="<?php echo $va['dates']; ?>">
							</div>
						</div>

						<div class="col-sm-12">
							<div class="form-group form-group-default">
								<label>Hora</label>

								<input type="time" class="form-control" name="hour" value="<?php echo $va['hour']; ?>">
							</div>
						</div>


						<div class="col-sm-12">
							<div class="form-group form-group-default">
								<label>Paciente</label>



								<select class="form-control" name="nombrep">
									<option value="">
										<?php echo $va['nombrep']; ?>
									</option>

								</select>


							</div>
						</div>

						<div class="col-sm-12">
							<div class="form-group form-group-default">
								<label>Médico</label>



								<select class="form-control" name="nomdoc">
									<option value="">
										<?php echo $va['nomdoc']; ?>
									</option>

								</select>


							</div>
						</div>

						<div class="col-sm-12">
							<div class="form-group form-group-default">
								<label>Consultorio</label>



								<select class="form-control" name="nombrees">
									<option value="">
										<?php echo $va['nombrees']; ?>
									</option>

								</select>


							</div>
						</div>





						<div class="col-sm-12">
							<div class="form-group form-group-default">
								<label>Estado</label>


								<select class="form-control" name="estado">
									<option value="">
										<?php echo $va['estado']; ?>
									</option>
									<option value="Atendido">Atendido</option>
								</select>
							</div>
						</div>


					</div>


			</div>
			<div class="modal-footer no-bd">
				<button type="submit" class="btn btn-primary">Editar


				</button>
				<button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
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
<!-- Modal Editar -->
<div class="modal fade" id="editRowModal<?php echo $va['codcit']; ?>" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Editar Cita #<?php echo $va['codcit']; ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" action="../controller/appointmentcontroller.php?action=actualizar">
                <input type="hidden" name="codcit" value="<?php echo $va['codcit']; ?>">
                <div class="modal-body">
                    <div class="form-group">
                        <label>Fecha</label>
                        <input type="date" class="form-control" name="dates" value="<?php echo $va['dates']; ?>" required>
                    </div>
                    
                    <div class="form-group">
                        <label>Hora</label>
                        <input type="time" class="form-control" name="hour" value="<?php echo $va['hour']; ?>" required>
                    </div>
                    
                    <div class="form-group">
                        <label>Paciente</label>
                        <input type="text" class="form-control" value="<?php echo $va['nombrep']; ?>" readonly>
                    </div>
                    
                    <div class="form-group">
                        <label>Médico</label>
                        <input type="text" class="form-control" value="<?php echo $va['nomdoc']; ?>" readonly>
                    </div>
                    
                    <div class="form-group">
                        <label>Especialidad</label>
                        <input type="text" class="form-control" value="<?php echo $va['nombrees']; ?>" readonly>
                    </div>
                    
                    <div class="form-group">
                        <label>Estado</label>
                        <select class="form-control" name="estado" required>
                            <option value="1" <?php echo ($va['estado'] == 1) ? 'selected' : ''; ?>>Atendido</option>
                            <option value="0" <?php echo ($va['estado'] == 0) ? 'selected' : ''; ?>>Pendiente</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                </div>
            </form>
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