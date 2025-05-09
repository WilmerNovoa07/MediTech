<!-- Agregar Nuevos Registros -->
<div class="modal fade" id="addRowModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <center><h4 class="modal-title" id="myModalLabel">Nuevo Registro</h4></center>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="card-body">
                        <form method="POST" autocomplete="off" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group form-group-default">
                                        <label>DNI</label>
                                        <input name="dnidoc" required type="text" class="form-control" maxlength="10" placeholder="Ingrese dni" onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;">
                                    </div>
                                </div>
                                <div class="col-md-6 pr-0">
                                    <div class="form-group form-group-default">
                                        <label>Nombre</label>
                                        <input name="nomdoc" required type="text" class="form-control" placeholder="Ingrese nombre">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group form-group-default">
                                        <label>Apellidos</label>
                                        <input name="apedoc" required type="text" class="form-control" placeholder="Ingrese apellidos">
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group form-group-default">
                                        <label>Especialidad</label>
                                        <select class="form-control" id="doctor" name="codespe">
                                            <!-- Opciones de especialidades -->
                                        </select>
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group form-group-default">
                                        <label>Sexo</label>
                                        <select class="form-control" name="sexo">
                                            <option value="Masculino">Masculino</option>
                                            <option value="Femenino">Femenino</option>
                                        </select>
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group form-group-default">
                                        <label>Teléfono</label>
                                        <input name="telefo" required type="text" class="form-control" maxlength="10" placeholder="Ingrese teléfono" onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;">
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group form-group-default">
                                        <label>Fecha nacimiento</label>
                                        <input name="fechanaci" type="date" class="form-control" placeholder="Ingrese fecha">
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group form-group-default">
                                        <label>Correo</label>
                                        <input name="correo" required type="email" class="form-control" placeholder="Ingrese correo">
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group form-group-default">
                                        <label>Nacionalidad</label>
                                        <select class="form-control" name="naciona">
                                            <option value="Peruana(o)">Peruana(o)</option>
                                            <option value="Colombiana(o)">Colombiana(o)</option>
                                            <option value="Venezolana(o)">Venezolana(o)</option>
                                            <option value="Argentina(o)">Argentina(o)</option>
                                            <option value="Ecuatoriana(o)">Ecuatoriana(o)</option>
                                            <option value="Uruguaya(o)">Uruguaya(o)</option>
                                        </select>
                                    </div>
                                </div>
                                
                                <!-- Campos para usuario y contraseña -->
                                <div class="col-md-6">
                                    <div class="form-group form-group-default">
                                        <label>Usuario</label>
                                        <input name="usuario" type="text" class="form-control" required placeholder="Ingrese usuario">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group form-group-default">
                                        <label>Contraseña</label>
                                        <input name="clave" type="password" class="form-control" required placeholder="Ingrese contraseña">
                                    </div>
                                </div>
                                <!-- Campo oculto para el cargo (3 = doctor) -->
                                <input type="hidden" name="cargo" value="3">
                            </div>
                            
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">
                                    <span class="glyphicon glyphicon-remove"></span> Cancelar
                                </button>
                                <button type="submit" name="agregar" class="btn btn-primary">
                                    <span class="glyphicon glyphicon-floppy-disk"></span> Guardar Registro
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>