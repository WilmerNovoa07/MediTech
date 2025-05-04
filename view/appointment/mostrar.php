<?php
session_start();

// Validación de administrador
if (!isset($_SESSION['cargo']) || $_SESSION['cargo'] != 1) {
    header('location: ../login.php');
    exit();
}

// Mostrar SweetAlert si existe mensaje - DEBE ESTAR ANTES DE CUALQUIER HTML
if (isset($_SESSION['swal'])) {
    echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>';
    echo '<script>
    document.addEventListener("DOMContentLoaded", function() {
        Swal.fire({
            icon: "'.$_SESSION['swal']['icon'].'",
            title: "'.$_SESSION['swal']['title'].'",
            text: "'.$_SESSION['swal']['text'].'",
            '. (isset($_SESSION['swal']['timer']) ? 'timer: '.$_SESSION['swal']['timer'].',' : '' ).'
            '. (isset($_SESSION['swal']['showConfirmButton']) ? 'showConfirmButton: '.$_SESSION['swal']['showConfirmButton'].',' : '' ).'
        }).then(function() {
            '. (isset($_SESSION['swal']['redirect']) ? 'window.location = "'.$_SESSION['swal']['redirect'].'";' : '' ).'
        });
    });
    </script>';
    unset($_SESSION['swal']);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>

	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<title>Citas</title>
	<meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
	<link rel="icon" href="../assets/img/icon.ico" type="image/x-icon" />

	<!-- Fonts and icons -->
	<script src="../assets/js/plugin/webfont/webfont.min.js"></script>
	<script>
		WebFont.load({
			google: { "families": ["Lato:300,400,700,900"] },
			custom: { "families": ["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands", "simple-line-icons"], urls: ['../assets/css/fonts.min.css'] },
			active: function () {
				sessionStorage.fonts = true;
			}
		});
	</script>

	<!-- CSS Files -->
	<link rel="stylesheet" href="../assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="../assets/css/atlantis.min.css">

	<!-- CSS Just for demo purpose, don't include it in your project -->
	<link rel="stylesheet" href="../assets/css/demo.css">
</head>

<body>

	<div class="wrapper">
		<div class="main-header">

			<div class="logo-header" data-background-color="blue" justify-content=center full>

				<button class="navbar-toggler sidenav-toggler ml-auto" type="button" data-toggle="collapse"
					data-target="collapse" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon">
						<i class="icon-menu"></i>
					</span>
				</button>
				<button class="topbar-toggler more"><i class="icon-options-vertical"></i></button>
				<div class="nav-toggle">
					<button class="btn btn-toggle toggle-sidebar">
						<i class="icon-menu"></i>
					</button>
				</div>
			</div>
			<!-- End Logo Header -->

			<!-- Navbar Header -->
			<nav class="navbar navbar-header navbar-expand-lg" data-background-color="blue2">

				<div class="container-fluid">
					<div class="collapse" id="search-nav">
						<form class="navbar-left navbar-form nav-search mr-md-3">
							<div class="input-group">
								<div class="input-group-prepend">
									<button type="submit" class="btn btn-search pr-1">
										<i class="fa fa-search search-icon"></i>
									</button>
								</div>
								<input type="text" placeholder="Search ..." class="form-control">
							</div>
						</form>
					</div>
					<ul class="navbar-nav topbar-nav ml-md-auto align-items-center">
						<li class="nav-item toggle-nav-search hidden-caret">
							<a class="nav-link" data-toggle="collapse" href="#search-nav" role="button"
								aria-expanded="false" aria-controls="search-nav">
								<i class="fa fa-search"></i>
							</a>
						</li>
						<li class="nav-item dropdown hidden-caret">
							<a class="nav-link dropdown-toggle" href="#" id="messageDropdown" role="button"
								data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<i class="fa fa-envelope"></i>
							</a>
							<ul class="dropdown-menu messages-notif-box animated fadeIn"
								aria-labelledby="messageDropdown">
								<li>
									<div class="dropdown-title d-flex justify-content-between align-items-center">
										Messages
										<a href="#" class="small">Mark all as read</a>
									</div>
								</li>
								<li>
									<div class="message-notif-scroll scrollbar-outer">
										<div class="notif-center">
											<a href="#">
												<div class="notif-img">
													<img src="../assets/img/jm_denis.jpg" alt="Img Profile">
												</div>
												<div class="notif-content">
													<span class="subject">Jimmy Denis</span>
													<span class="block">
														How are you ?
													</span>
													<span class="time">5 minutes ago</span>
												</div>
											</a>
											<a href="#">
												<div class="notif-img">
													<img src="../assets/img/chadengle.jpg" alt="Img Profile">
												</div>
												<div class="notif-content">
													<span class="subject">Chad</span>
													<span class="block">
														Ok, Thanks !
													</span>
													<span class="time">12 minutes ago</span>
												</div>
											</a>
											<a href="#">
												<div class="notif-img">
													<img src="../assets/img/mlane.jpg" alt="Img Profile">
												</div>
												<div class="notif-content">
													<span class="subject">Jhon Doe</span>
													<span class="block">
														Ready for the meeting today...
													</span>
													<span class="time">12 minutes ago</span>
												</div>
											</a>
											<a href="#">
												<div class="notif-img">
													<img src="../assets/img/talha.jpg" alt="Img Profile">
												</div>
												<div class="notif-content">
													<span class="subject">Talha</span>
													<span class="block">
														Hi, Apa Kabar ?
													</span>
													<span class="time">17 minutes ago</span>
												</div>
											</a>
										</div>
									</div>
								</li>
								<li>
									<a class="see-all" href="javascript:void(0);">See all messages<i
											class="fa fa-angle-right"></i> </a>
								</li>
							</ul>
						</li>
						<li class="nav-item dropdown hidden-caret">
							<a class="nav-link dropdown-toggle" href="#" id="notifDropdown" role="button"
								data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<i class="fa fa-bell"></i>
								<span class="notification">0</span>
							</a>
							<ul class="dropdown-menu notif-box animated fadeIn" aria-labelledby="notifDropdown">
								<li>
									<div class="dropdown-title">You have 0 new notification</div>
								</li>
								<li>

								</li>
								<li>
									<a class="see-all" href="javascript:void(0);">See all notifications<i
											class="fa fa-angle-right"></i> </a>
								</li>
							</ul>
						</li>

						<li class="nav-item dropdown hidden-caret">
							<a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#"
								aria-expanded="false">
								<div class="avatar-sm">
									<img src="../assets/img/pngwing.com.png" alt="..."
										class="avatar-img rounded-circle">
								</div>
							</a>
							<ul class="dropdown-menu dropdown-user animated fadeIn">
								<div class="dropdown-user-scroll scrollbar-outer">
									<li>
										<div class="user-box">
											<div class="avatar-lg"><img src="../assets/img/pngwing.com.png"
													alt="image profile" class="avatar-img rounded"></div>
											<div class="u-text">
												<h4>
													<?php echo ucfirst($_SESSION['nombre']); ?>
												</h4>
												<p class="text-muted">Administrador</p><a href="profile.html">
											</div>
										</div>
									</li>
									<li>


										<div class="dropdown-divider"></div>
										<a class="dropdown-item" href="../cerrarSesion.php">Cerrar Sesion</a>
									</li>
								</div>
							</ul>
						</li>
					</ul>
				</div>
			</nav>
			<!-- End Navbar -->
		</div>

		<!-- Sidebar -->
		<div class="sidebar sidebar-style-2">
			<div class="sidebar-wrapper scrollbar scrollbar-inner">
				<div class="sidebar-content">
					<div class="user">
						<div class="avatar-sm float-left mr-2">
							<img src="../assets/img/pngwing.com.png" alt="..." class="avatar-img rounded-circle">
						</div>
						<div class="info">
							<a data-toggle="collapse" href="#collapseExample" aria-expanded="true">
								<span>
									<?php echo ucfirst($_SESSION['nombre']); ?>
									<span class="user-level">Administrador</span>

								</span>
							</a>
							<div class="clearfix"></div>

							<div class="collapse in" id="collapseExample">

							</div>
						</div>
					</div>
					<ul class="nav nav-primary">
						<li class="nav-item">

							<a data-toggle="collapse" href="#base1">
								<i class="fas fa-home"></i>
								<p>Inicio</p>
								<span class="caret"></span>
							</a>
							<div class="collapse" id="base1">
								<ul class="nav nav-collapse">
									<li>
										<a href="../view/admin/admin.php">
											<span class="sub-item">Mostrar</span>
										</a>
									</li>
								</ul>
							</div>

						</li>
						<li class="nav-section">
							<span class="sidebar-mini-icon">
								<i class="fa fa-ellipsis-h"></i>
							</span>

						</li>
						<li class="nav-item active">
							<a data-toggle="collapse" href="#base">
								<i class="fas fa-layer-group"></i>
								<p>Citas</p>
								<span class="caret"></span>
							</a>
							<div class="collapse" id="base">
								<ul class="nav nav-collapse">


									<li>
										<a href="../folder/appointment.php">
											<span class="sub-item">Mostrar</span>
										</a>
									</li>
								</ul>
							</div>
						</li>
						<li class="nav-item">
							<a data-toggle="collapse" href="#sidebarLayouts">
								<i class="fas fa-male"></i>
								<p>Pacientes</p>
								<span class="caret"></span>
							</a>
							<div class="collapse" id="sidebarLayouts">
								<ul class="nav nav-collapse">
									<li>
										<a href="../folder/customers.php">
											<span class="sub-item">Mostrar</span>
										</a>
									</li>



								</ul>
							</div>
						</li>
						<li class="nav-item">
							<a data-toggle="collapse" href="#forms">
								<i class="fas fa-user-md"></i>
								<p>Médicos</p>
								<span class="caret"></span>
							</a>
							<div class="collapse" id="forms">
								<ul class="nav nav-collapse">
									<li>
										<a href="../folder/doctor.php">
											<span class="sub-item">Mostrar</span>
										</a>
									</li>
								</ul>
							</div>
						</li>
						<li class="nav-item">
							<a data-toggle="collapse" href="#tables">
								<i class="fas fa-table"></i>
								<p>Áreas médicas</p>
								<span class="caret"></span>
							</a>
							<div class="collapse" id="tables">
								<ul class="nav nav-collapse">
									<li>
										<a href="specialty.php">
											<span class="sub-item">Mostrar</span>
										</a>
									</li>

								</ul>
							</div>
						</li>

						<li class="nav-item">
							<a data-toggle="collapse" href="#calendar">
								<i class="fas fa-calendar-alt"></i>
								<p>Horarios</p>
								<span class="caret"></span>
							</a>
							<div class="collapse" id="calendar">
								<ul class="nav nav-collapse">
									<li>
										<a href="horario.php">
											<span class="sub-item">Mostrar</span>
										</a>
									</li>

								</ul>
							</div>
						</li>


						<li class="nav-item">
							<a data-toggle="collapse" href="#user">
								<i class="fas fa-user"></i>
								<p>Usuarios</p>
								<span class="caret"></span>
							</a>
							<div class="collapse" id="user">
								<ul class="nav nav-collapse">
									<li>
										<a href="usuarios.php">
											<span class="sub-item">Mostrar</span>
										</a>
									</li>

								</ul>
							</div>
						</li>


					</ul>
				</div>
			</div>
		</div>
		<!-- End Sidebar -->

		<div class="main-panel">
			<div class="content">
				<div class="page-inner">
					<div class="page-header">
						<h4 class="page-title">Citas</h4>
						<ul class="breadcrumbs">
							<li class="nav-home">
								<a href="../view/admin/admin.php">
									<i class="flaticon-home"></i>
								</a>
							</li>
							<li class="separator">
								<i class="flaticon-right-arrow"></i>
							</li>


							<li class="nav-item">
								<a href="#">Mostrar</a>
							</li>
						</ul>
					</div>
					<div class="row">

						<div class="col-md-12">
							<div class="card">
								<div class="card-header">
									<div class="d-flex align-items-center">
										<h4 class="card-title">Mostrar</h4>

										<a href="#addRowModal" class="btn btn-primary btn-round ml-auto"
											data-toggle="modal">Nuevo</a>
										<?php include('AgregarModal.php'); ?>
									</div>
									<!-- <div class="card-tools">
										<a href="../view/appointment/reporte.php"
											class="btn btn-info btn-border btn-round btn-sm mr-2">
											<span class="btn-label">
												<i class="fa fa-pencil"></i>
											</span>
											Export
										</a>

									</div> -->
									<div class="card-body">


										<div class="table-responsive">
											<table id="add-row" class="display table table-striped table-hover">
												<thead>
													<tr>
														<th>#</th>
														<th>Fecha</th>
														<th>Hora</th>
														<th>Paciente</th>
														<th>Médico</th>
														<th>Consultorio</th>
														<th>Estado</th>

														<th style="width: 2%">Action</th>
													</tr>
												</thead>
												<tfoot>
													<tr>
														<th>#</th>
														<th>Fecha</th>
														<th>Hora</th>
														<th>Paciente</th>
														<th>Médico</th>
														<th>Consultorio</th>
														<th>Estado</th>
														<th>Action</th>
													</tr>
												</tfoot>


												<tbody>
													<?php
													foreach ($dato as $key => $value) {
														foreach ($value as $va) { ?>
															<tr>
																<td><?php echo $va['codcit']; ?></td>
																<td><?php echo $va['dates']; ?></td>
																<td><?php echo $va['hour']; ?></td>
																<td><?php echo $va['nombrep']; ?></td>
																<td><?php echo $va['nomdoc']; ?></td>
																<td><?php echo $va['nombrees']; ?></td>

																<td>
																	<?php if ($va['estado'] == 1) { ?>
																		<form method="get" action="javascript:activo('<?php echo $va['codcit']; ?>')">
																			<span class="text-success pl-3">Atendido</span>
																		</form>
																	<?php } else { ?>
																		<form method="get" action="javascript:inactivo('<?php echo $va['codcit']; ?>')">
																			<button type="submit" class="btn btn-danger btn-xs">Pendiente</button>
																		</form>
																	<?php } ?>
																</td>

																<td>
																	<div class="form-button-action">
																		<!-- Botón Editar -->
																		<button class="btn btn-link btn-primary btn-lg" 
																				data-toggle="modal" 
																				data-target="#editRowModal<?php echo $va['codcit']; ?>">
																			<i class="fa fa-edit"></i>
																		</button>
																		
																		<!-- Botón Eliminar -->
																		<button class="btn btn-link btn-danger btn-lg"
																				data-toggle="modal"
																				data-target="#deleteRowModal<?php echo $va['codcit']; ?>">
																			<i class="fa fa-trash"></i>
																		</button>
																	</div>
																</td>

																<?php include('editar.php'); ?>
															</tr>
															<?php
														}
													}
													?>
												</tbody>



											</table>
										</div>


									</div>
								</div>


							</div>
						</div>
					</div>

				</div>
			</div>

		</div>

	</div>
	<!--   Core JS Files   -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
	<script src="../assets/js/functions4.js"></script>
	<script src="../assets/js/functions5.js"></script>
	<script src="../assets/js/core/jquery.3.2.1.min.js"></script>
	<script src="../assets/js/core/popper.min.js"></script>
	<script src="../assets/js/core/bootstrap.min.js"></script>
	<!-- jQuery UI -->
	<script src="../assets/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>
	<script src="../assets/js/plugin/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js"></script>

	<!-- jQuery Scrollbar -->
	<script src="../assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>
	<!-- Datatables -->
	<script src="../assets/js/plugin/datatables/datatables.min.js"></script>
	<!-- Atlantis JS -->
	<script src="../assets/js/atlantis.min.js"></script>
	<!-- Atlantis DEMO methods, don't include it in your project! -->
	<script src="../assets/js/setting-demo2.js"></script>
	<script>
		$(document).ready(function () {
			$('#basic-datatables').DataTable({
			});

			$('#multi-filter-select').DataTable({
				"pageLength": 5,
				initComplete: function () {
					this.api().columns().every(function () {
						var column = this;
						var select = $('<select class="form-control"><option value=""></option></select>')
							.appendTo($(column.footer()).empty())
							.on('change', function () {
								var val = $.fn.dataTable.util.escapeRegex(
									$(this).val()
								);

								column
									.search(val ? '^' + val + '$' : '', true, false)
									.draw();
							});

						column.data().unique().sort().each(function (d, j) {
							select.append('<option value="' + d + '">' + d + '</option>')
						});
					});
				}
			});

			// Add Row
			$('#add-row').DataTable({
				"pageLength": 5,
			});

			var action = '<td> <div class="form-button-action"> <button type="button" data-toggle="tooltip" title="" class="btn btn-link btn-primary btn-lg" data-original-title="Edit Task"> <i class="fa fa-edit"></i> </button> <button type="button" data-toggle="tooltip" title="" class="btn btn-link btn-danger" data-original-title="Remove"> <i class="fa fa-times"></i> </button> </div> </td>';

			$('#addRowButton').click(function () {
				$('#add-row').dataTable().fnAddData([
					$("#addName").val(),
					$("#addPosition").val(),
					$("#addOffice").val(),
					action
				]);
				$('#addRowModal').modal('hide');

			});
		});
	</script>

	<script>
		function activo(codcit) {
			var id = codcit;
			$.ajax({
				type: "GET",
				url: "../assets/ajax/editar_estado_activo_cita.php?id=" + id,
			}).done(function (data) {
				window.location.href = '../folder/appointment.php';
			})

		}

		// Editar estado inactivo
		function inactivo(codcit) {
			var id = codcit;
			$.ajax({
				type: "GET",
				url: "../assets/ajax/editar_estado_inactivo_cita.php?id=" + id,
			}).done(function (data) {
				window.location.href = '../folder/appointment.php';
			})
		}


	</script>

	<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>


	<!--------------------------------script nuevo--------------------------------------------------->

	<?php
if (isset($_POST["agregar"])) {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "trabajo_grado";

    // Creamos la conexión
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Revisamos la conexión
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $dates = $_POST['dates'];
    $hour = $_POST['hour'];
    $codpaci = $_POST['codpaci'];
    $coddoc = $_POST['coddoc'];
    $codespe = $_POST['codespe'];

    // Validación de disponibilidad del doctor en esa fecha y hora
    $dayOfWeek = date('N', strtotime($dates)); // Obtén el día de la semana (1-7)
    $sqlCheck = "SELECT * FROM horario 
                 WHERE coddoc = ? 
                 AND dia = ? 
                 AND ? BETWEEN hora_inicio AND hora_fin";
    $stmtCheck = $conn->prepare($sqlCheck);
    $stmtCheck->bind_param("iis", $coddoc, $dayOfWeek, $hour);
    $stmtCheck->execute();
    $resultCheck = $stmtCheck->get_result();

    if ($resultCheck->num_rows > 0) {
        // Si el doctor está disponible, verifica que no exista una cita en el mismo horario para el mismo paciente
        $sql = "SELECT * FROM appointment WHERE dates = ? AND hour = ? AND codpaci = ? AND coddoc = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssii", $dates, $hour, $codpaci, $coddoc);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            // Si ya existe una cita con esos datos, muestra un mensaje de error
            echo "<script>
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Ya existe una cita para este doctor, paciente, fecha y hora.'
                    });
                  </script>";
        } else {
            // Inserta la cita en caso de disponibilidad y no duplicidad
            $sql2 = "INSERT INTO appointment(dates, hour, codpaci, coddoc, codespe, estado)
                     VALUES (?, ?, ?, ?, ?, '0')";
            $stmtInsert = $conn->prepare($sql2);
            $stmtInsert->bind_param("ssiii", $dates, $hour, $codpaci, $coddoc, $codespe);

            if ($stmtInsert->execute()) {
                echo "<script>
                        Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: 'Agregado correctamente',
                            showConfirmButton: false,
                            timer: 1500
                        }).then(function () {
                            window.location = '../folder/appointment.php';
                        });
                      </script>";
            } else {
                echo "<script>
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'No se pudo guardar!'
                        });
                      </script>";
            }
        }
    } else {
        // Mensaje de error si el doctor no está disponible
        echo "<script>
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'El doctor no está disponible en la fecha y hora seleccionadas'
                });
              </script>";
    }

    // Cerramos la conexión
    $conn->close();
}
?>

</body>

</html>