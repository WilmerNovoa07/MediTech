<?php

session_start();

// Validamos que exista una session y ademas que el cargo que exista sea igual a 1 (Administrador)
if (!isset($_SESSION['cargo']) || $_SESSION['cargo'] != 2) {
	/*
												   Para redireccionar en php se utiliza header,
												   pero al ser datos enviados por cabereza debe ejecutarse
												   antes de mostrar cualquier informacion en el DOM es por eso que inserto este
												   codigo antes de la estructura del html, espero haber sido claro
												 */
	header('location: ../../login.php');
}
$id = $_SESSION['id'];
?>



<!DOCTYPE html>
<html lang="en">

<head>

	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<title>Citas médicas</title>
	<meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
	<link rel="icon" href="" type="image/x-icon" />

	<!-- Fonts and icons -->
	<script src="../../assets/js/plugin/webfont/webfont.min.js"></script>
	<script>
		WebFont.load({
			google: { "families": ["Lato:300,400,700,900"] },
			custom: { "families": ["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands", "simple-line-icons"], urls: ['../../assets/css/fonts.min.css'] },
			active: function () {
				sessionStorage.fonts = true;
			}
		});
	</script>

	<!-- CSS Files -->
	<link rel="stylesheet" href="../../assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="../../assets/css/atlantis.min.css">

	<!-- CSS Just for demo purpose, don't include it in your project -->
	<link rel="stylesheet" href="../../assets/css/demo.css">
</head>

<body>

	<div class="wrapper">
		<div class="main-header">
			<!-- Logo Header -->
			<div class="logo-header" data-background-color="blue">

				<a href="/user/user.php" class="logo">

				</a>
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
							<a class="nav-link dropdown-toggle" href="#" id="notifDropdown" role="button"
								data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<i class="fa fa-bell"></i>
								<span class="notification">0</span>
							</a>
							<ul class="dropdown-menu notif-box animated fadeIn" aria-labelledby="notifDropdown">
								<li>
									<div class="dropdown-title">Tienes 0 notificaciones</div>
								</li>
								<li>


								</li>
								<li>
									<a class="see-all" href="javascript:void(0);">Leer todas las notificaciones<i
											class="fa fa-angle-right"></i> </a>
								</li>
							</ul>
						</li>


						<li class="nav-item dropdown hidden-caret">
							<a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#"
								aria-expanded="false">
								<div class="avatar-sm">
									<img src="../../assets/img/pngwing.com.png" alt="..."
										class="avatar-img rounded-circle">
								</div>
							</a>
							<ul class="dropdown-menu dropdown-user animated fadeIn">
								<div class="dropdown-user-scroll scrollbar-outer">
									<li>
										<div class="user-box">

											<div class="avatar-lg"><img src="../../assets/img/pngwing.com.png"
													alt="image profile" class="avatar-img rounded"></div>
											<div class="u-text">
												<h4>
													<?php echo ucfirst($_SESSION['nombre']); ?>
												</h4>
												<p class="text-muted">Clientes</p>
											</div>
										</div>
									</li>
									<li>
										<div class="dropdown-divider"></div>
										<a class="dropdown-item" href="">Mi perfil</a>

										<div class="dropdown-divider"></div>
										<a class="dropdown-item" href="../../cerrarSesion.php">Cerrar Sesion</a>
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
							<img src="../../assets/img/pngwing.com.png" alt="..." class="avatar-img rounded-circle">
						</div>
						<div class="info">
							<a data-toggle="collapse" href="#collapseExample" aria-expanded="true">
								<span>
									<?php echo ucfirst($_SESSION['nombre']); ?>
									<span class="user-level">Clientes</span>
									<span class="caret"></span>
								</span>
							</a>
							<div class="clearfix"></div>

							<div class="collapse in" id="collapseExample">
								<ul class="nav">
									<li>
										<a href="../user/user.php">
											<span class="link-collapse">Mi Perfil</span>
										</a>
									</li>

									<li>
										<a href="../../cerrarSesion.php">
											<span class="link-collapse">Cerrar sesion</span>

										</a>
									</li>
								</ul>
							</div>
						</div>
					</div>
					<ul class="nav nav-primary">
						<li class="nav-item active">
							<a data-toggle="collapse" href="#dashboard" class="collapsed" aria-expanded="false">
								<i class="fas fa-home"></i>
								<p>Inicio</p>
								<span class="caret"></span>
							</a>

						<li class="nav-item">
							<a data-toggle="collapse" href="#base">
								<i class="fas fa-layer-group"></i>
								<p>Citas</p>
								<span class="caret"></span>
							</a>
							<div class="collapse" id="base">
								<ul class="nav nav-collapse">

									<li>
										<a href="../user_app/mostrar.php">
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
				<div class="panel-header bg-primary-gradient">
					<div class="page-inner py-5">
						<div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
							<div>
								<h2 class="text-white pb-2 fw-bold">Perfil del cliente</h2>

							</div>

						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-md-8">
						<div class="card card-with-nav">
							<div class="card-header">
								<div class="row row-nav-line">
									<ul class="nav nav-tabs nav-line nav-color-secondary w-100 pl-3" role="tablist">


										<li class="nav-item submenu"> <a class="nav-link active" data-toggle="tab"
												href="#profile" role="tab" aria-selected="false">Perfil</a> </li>

									</ul>
								</div>
							</div>
							<?php
							function connect()
							{
								return new mysqli("localhost", "root", "", "trabajo_grado");
							}
							$con = connect();

							$sql = "SELECT * FROM customers  WHERE codpaci= '$id'";

							$query = $con->query($sql);
							$data = array();
							if ($query) {
								while ($r = $query->fetch_object()) {
									$data[] = $r;
								}
							}

							?>
							<?php if (count($data) > 0): ?>
								<?php foreach ($data as $d): ?>
									<div class="card-body">
										<div class="row mt-3">
											<div class="col-md-4">
												<div class="form-group form-group-default">
													<label>DNI</label>
													<input type="text" class="form-control" value="<?php echo $d->dnipa; ?>"
														name="dnipa" placeholder="DNI" placeholder="77764664">
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group form-group-default">
													<label>Nombres</label>
													<input type="email" class="form-control" value="<?php echo $d->nombrep; ?>"
														name="nombrep" placeholder="Nombre">
												</div>
											</div>
										</div>
										<div class="row mt-3">
											<div class="col-md-4">
												<div class="form-group form-group-default">
													<label>Apellidos</label>
													<input type="text" class="form-control" value="<?php echo $d->apellidop; ?>"
														name="apellidop" placeholder="Apellido">
												</div>
											</div>
											<div class="col-md-4">
												<div class="form-group form-group-default">
													<label>Seguro</label>
													<select class="form-control" value="<?php echo $d->seguro; ?>" name="seguro"
														id="seguro">
														<option value="<?php echo $d->seguro; ?>">
															<?php echo $d->seguro; ?>
														</option>
														<option value="Si">Si</option>
														<option value="No">No</option>
													</select>
												</div>
											</div>
											<div class="col-md-4">
												<div class="form-group form-group-default">
													<label>Sexo</label>
													<select class="form-control" value="<?php echo $d->sexo; ?>" name="sexo"
														id="sexo">
														<option value="<?php echo $d->sexo; ?>">
															<?php echo $d->sexo; ?>
														</option>
														<option>Female</option>
													</select>
												</div>
											</div>
											<div class="col-md-4">
												<div class="form-group form-group-default">
													<label>Teléfono</label>
													<input type="text" class="form-control" value="<?php echo $d->tele; ?>"
														name="tele" placeholder="Phone">
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group form-group-default">
													<label>Usuario</label>
													<input type="text" class="form-control" value="<?php echo $d->usuario; ?>"
														name="usuario" placeholder="Usuario">
												</div>
											</div>
										</div>



									</div>

								<?php endforeach; ?>

							<?php else: ?>
								<p class="alert alert-warning">No hay datos</p>
							<?php endif; ?>
						</div>
					</div>
					<div class="col-md-4">
						<div class="card card-profile">
							<div class="card-header" style="background-image: url('../assets/img/blogpost.jpg')">
								<div class="profile-picture">
									<div class="avatar avatar-xl">
										<img src="../../assets/img/avatar.png" alt="..."
											class="avatar-img rounded-circle">
									</div>
								</div>
							</div>
							<div class="card-body">
								<div class="user-profile text-center">
									<div class="name">
										<?php echo $d->nombrep; ?>
									</div>
									<div class="job">Cliente</div>

									<div class="social-media">
										<a class="btn btn-info btn-twitter btn-sm btn-link" href="#">
											<span class="btn-label just-icon"><i class="flaticon-twitter"></i> </span>
										</a>
										<a class="btn btn-danger btn-sm btn-link" rel="publisher" href="#">
											<span class="btn-label just-icon"><i class="flaticon-google-plus"></i>
											</span>
										</a>
										<a class="btn btn-primary btn-sm btn-link" rel="publisher" href="#">
											<span class="btn-label just-icon"><i class="flaticon-facebook"></i> </span>
										</a>
										<a class="btn btn-danger btn-sm btn-link" rel="publisher" href="#">
											<span class="btn-label just-icon"><i class="flaticon-dribbble"></i> </span>
										</a>
									</div>

								</div>
							</div>



						</div>
					</div>
				</div>

			</div>

		</div>

<!-- Contenedor del chatbot -->
<div class="chatbot-container">
    <div id="chatbot" class="chatbot">
        <div class="chatbot-header">
            <h3>Chatbot</h3>
        </div>
        <div id="chatbot-messages" class="chatbot-messages"></div>
        <div class="chatbot-input-container">
            <input id="chatbot-input" type="text" placeholder="Escribe tu mensaje aquí..." />
            <button id="chatbot-send" class="btn btn-primary">Enviar</button>
        </div>
    </div>
</div>

<!-- Estilos del chatbot (añadir en la sección <head> o en tu archivo CSS) -->
<style>
    .chatbot-container {
        position: fixed;
        bottom: 20px;
        right: 20px;
        width: 300px;
        z-index: 1000;
    }
    .chatbot {
        background-color: #fff;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        display: flex;
        flex-direction: column;
    }
    .chatbot-header {
        background-color: blue; /* Color de fondo azul para el encabezado */
        color: white; /* Color de texto blanco */
        padding: 10px; /* Espaciado */
        text-align: center; /* Centrar el texto */
    }
    .chatbot-messages {
        height: 300px;
        padding: 10px;
        overflow-y: auto;
        border-bottom: 1px solid #ddd;
    }
    .chatbot-input-container {
        display: flex;
    }
    #chatbot-input {
        flex-grow: 1;
        border: none;
        padding: 10px;
    }
    #chatbot-send {
        padding: 10px;
    }
	/* Estilos para los mensajes */
#chatbot-messages {
    max-height: 400px;
    overflow-y: auto;
    padding: 10px;
    background-color: #f5f5f5;
    border-radius: 8px;
    margin-bottom: 10px;
}

.user-message {
    background-color: #e3f2fd;
    color: #0d47a1;
    padding: 8px 12px;
    border-radius: 18px 18px 0 18px;
    margin: 5px 0;
    max-width: 80%;
    margin-left: auto;
    word-wrap: break-word;
    box-shadow: 0 1px 1px rgba(0,0,0,0.1);
}

.bot-message {
    background-color: #f1f1f1;
    color: #333;
    padding: 8px 12px;
    border-radius: 18px 18px 18px 0;
    margin: 5px 0;
    max-width: 80%;
    margin-right: auto;
    word-wrap: break-word;
    box-shadow: 0 1px 1px rgba(0,0,0,0.1);
}

/* Mejora visual para el input */
#chatbot-input {
    width: calc(100% - 70px);
    padding: 10px;
    border: 1px solid #ddd;
    border-radius: 20px;
    outline: none;
}

#chatbot-send {
    width: 60px;
    padding: 10px;
    background-color: #4CAF50;
    color: white;
    border: none;
    border-radius: 20px;
    cursor: pointer;
    margin-left: 5px;
}

#chatbot-send:hover {
    background-color: #45a049;
}
</style>


<!-- JavaScript del chatbot -->
<script>
const pacienteId = <?php echo json_encode($id); ?>;
let chatStep = 0; // Control de pasos en la conversación
let appointmentData = {}; // Guardar los datos de la cita
let specialties = []; // Almacenar las especialidades disponibles
let doctors = []; // Almacenar los doctores disponibles
let availableDates = []; // Almacenar las fechas disponibles

document.getElementById('chatbot-send').addEventListener('click', async function () {
    let userMessage = document.getElementById('chatbot-input').value;
    if (userMessage.trim() !== '') {
        addMessageToChat(userMessage, 'user');
        document.getElementById('chatbot-input').value = '';
        const botResponse = await generateBotResponse(userMessage); // Usa await aquí
        addMessageToChat(botResponse, 'bot');
    }
});
// Enviar mensaje al presionar Enter
document.getElementById('chatbot-input').addEventListener('keypress', function(e) {
    if (e.key === 'Enter') {
        document.getElementById('chatbot-send').click(); // Simula clic en el botón de enviar
    }
});
function addMessageToChat(message, sender) {
    const messagesContainer = document.getElementById('chatbot-messages');
    const messageElement = document.createElement('div');
    messageElement.classList.add(sender === 'user' ? 'user-message' : 'bot-message');
    messageElement.textContent = message;
    messagesContainer.appendChild(messageElement);
    messagesContainer.scrollTop = messagesContainer.scrollHeight;
}

async function generateBotResponse(message) {
    message = message.toLowerCase();

    switch (chatStep) {
        case 0:
            chatStep++;
            return '¡Hola! ¿Te gustaría agendar una cita? (responde con "si" o "no")';

        case 1:
            if (message === 'sí' || message === 'si') {
                chatStep++;
                addMessageToChat('Perfecto, estoy obteniendo las especialidades disponibles. Por favor espera un momento...', 'bot');
                const specialtiesMessage = await fetchSpecialties();
                return specialtiesMessage;
            } else if (message === 'no') {
                chatStep = 0;
                return 'Está bien. Si necesitas algo más, estaré aquí para ayudarte.';
            } else {
                return 'Por favor, responde con "sí" o "no".';
            }

			case 2:
			let selectedSpecialty;
			
			// Verificar si el usuario ingresó un número
			if (/^\d+$/.test(message)) {
				const index = parseInt(message) - 1;
				if (index >= 0 && index < specialties.length) {
					selectedSpecialty = specialties[index];
				}
			} else {
				// Buscar por nombre (insensible a mayúsculas y acentos)
				selectedSpecialty = specialties.find(s => 
					s.nombrees.toLowerCase().normalize("NFD").replace(/[\u0300-\u036f]/g, "") === 
					message.toLowerCase().normalize("NFD").replace(/[\u0300-\u036f]/g, "")
				);
			}

			if (selectedSpecialty) {
				appointmentData.codespe = selectedSpecialty.codespe;
				chatStep++;
				addMessageToChat(`Has seleccionado ${selectedSpecialty.nombrees}. Estoy obteniendo los doctores disponibles. Por favor espera un momento...`, 'bot');
				const doctorsMessage = await fetchDoctorsBySpecialty(selectedSpecialty.codespe);
				return doctorsMessage;
			} else {
				const specialtiesList = specialties.map((s, index) => `${index + 1}. ${s.nombrees}`).join('\n');
				return `Lo siento, no encontré esa especialidad. Por favor selecciona una de estas opciones:\n${specialtiesList}\n\nPuedes escribir el número o el nombre.`;
			}

        

			case 3:
			let selectedDoctor;
			
			// Verificar si el usuario ingresó un número
			if (/^\d+$/.test(message)) {
				const index = parseInt(message) - 1;
				if (index >= 0 && index < doctors.length) {
					selectedDoctor = doctors[index];
				}
			} else {
				// Buscar por nombre (insensible a mayúsculas y acentos)
				const searchName = message.toLowerCase().normalize("NFD").replace(/[\u0300-\u036f]/g, "");
				selectedDoctor = doctors.find(d => {
					const doctorName = `${d.nomdoc} ${d.apedoc}`.toLowerCase().normalize("NFD").replace(/[\u0300-\u036f]/g, "");
					return doctorName.includes(searchName);
				});
			}

			if (selectedDoctor) {
				appointmentData.coddoc = selectedDoctor.coddoc;
				appointmentData.doctor = `${selectedDoctor.nomdoc} ${selectedDoctor.apedoc}`;
				chatStep++;
				addMessageToChat(`Has seleccionado al doctor ${selectedDoctor.nomdoc} ${selectedDoctor.apedoc}. Estoy obteniendo las fechas disponibles. Por favor espera un momento...`, 'bot');
				availableDates = await fetchAvailableDates(selectedDoctor.coddoc);
				if (availableDates.length > 0) {
					return `Estas son las fechas disponibles:\n${availableDates.join('\n')}\n\nPor favor escribe la fecha que prefieres (ejemplo: 2023-12-15).`;
				} else {
					return 'Lo siento, no hay fechas disponibles para el doctor seleccionado. Por favor selecciona otro doctor.';
				}
			} else {
				const doctorsList = doctors.map((d, index) => `${index + 1}. ${d.nomdoc} ${d.apedoc}`).join('\n');
				return `Lo siento, no encontré ese doctor. Por favor selecciona uno de estos:\n${doctorsList}\n\nPuedes escribir el número o el nombre.`;
			}

			case 4:
			// Normalizar la fecha ingresada
			const datePattern = /(\d{2})[\/\-](\d{2})[\/\-](\d{4})|(\d{4})[\/\-](\d{2})[\/\-](\d{2})/;
			const match = message.match(datePattern);
			let selectedDate;
			
			if (match) {
				// Convertir a formato YYYY-MM-DD
				if (match[4]) { // Formato YYYY-MM-DD o similar
					selectedDate = `${match[4]}-${match[5]}-${match[6]}`;
				} else { // Formato DD-MM-YYYY o similar
					selectedDate = `${match[3]}-${match[2]}-${match[1]}`;
				}
			} else {
				selectedDate = message; // Intentar con el formato original
			}

			if (availableDates.includes(selectedDate)) {
				appointmentData.date = selectedDate;
				chatStep++;
				return `Has seleccionado la fecha ${appointmentData.date}. ¿Qué horario prefieres? (Formato: HH:MM)`;
			} else {
				return `Lo siento, esa fecha no está disponible. Por favor selecciona una de estas:\n${availableDates.join('\n')}`;
			}

        case 5:
            appointmentData.time = message;
            chatStep++;
            const available = await checkAvailability(appointmentData.coddoc, appointmentData.date, appointmentData.time); // Usa await aquí
            if (available) {
                return `Has seleccionado las ${appointmentData.time}. Tu cita será el ${appointmentData.date} a las ${appointmentData.time} con el doctor ${appointmentData.doctor}. ¿Es correcto? (responde con "sí" o "no")`;
            } else {
                chatStep--; // Volver al paso anterior
                return 'Lo siento, ese horario ya no está disponible. Por favor selecciona otro horario.';
            }

			case 6: // Confirmación de cita
    if (message === 'sí' || message === 'si') {
        try {
            const result = await saveAppointment(appointmentData);
            
            // Éxito
            return `✅ Cita agendada para el ${result.data.date} a las ${result.data.time}. ¿Necesitas algo más?`;
            
        } catch (error) {
            // Manejar específicamente conflictos de horario
            if (error.message.includes('horario seleccionado ya está ocupado')) {
                chatStep = 4; // Volver al paso de selección de hora
                return `⚠️ ${error.message}\n\nEstas son las fechas disponibles:\n${availableDates.join('\n')}\n\nPor favor elige otra hora:`;
            }
            
            chatStep = 0; // Reiniciar flujo
            return 'Hubo un error. ¿Deseas intentar agendar otra cita?';
        }
    }
    break;
    
    }
}

async function fetchSpecialties() {
    try {
        const response = await fetch('/Meditech/controller/getspecialtiescontroller.php');
        specialties = await response.json();
        // Formatear el mensaje con números
        const specialtiesList = specialties.map((s, index) => `${index + 1}. ${s.nombrees}`).join('\n');
        return `Estas son las especialidades disponibles:\n${specialtiesList}\n\nPuedes escribir el número o el nombre de la especialidad.`;
    } catch (error) {
        console.error('Error al obtener las especialidades:', error);
        return 'Lo siento, hubo un error al obtener las especialidades. Por favor intenta de nuevo.';
    }
}

async function fetchDoctorsBySpecialty(codespe) {
    try {
        const response = await fetch(`/Meditech/controller/getdoctorsbyspecialtycontroller.php?codespe=${codespe}`);
        doctors = await response.json();
        // Formatear el mensaje con números
        const doctorsList = doctors.map((d, index) => `${index + 1}. ${d.nomdoc} ${d.apedoc}`).join('\n');
        return `Estos son los doctores disponibles:\n${doctorsList}\n\nPuedes escribir el número o el nombre del doctor.`;
    } catch (error) {
        console.error('Error al obtener los doctores:', error);
        return 'Lo siento, hubo un error al obtener los doctores. Por favor intenta de nuevo.';
    }
}

async function fetchAvailableDates(coddoc) {
    try {
        const response = await fetch(`/Meditech/controller/getavailabledatescontroller.php?coddoc=${coddoc}`);
        if (!response.ok) throw new Error('Error en la respuesta del servidor');
        
        const data = await response.json();
        
        if (!Array.isArray(data)) {
            console.error('Respuesta inesperada:', data);
            throw new Error('Formato de datos incorrecto');
        }
        
        return data;
    } catch (error) {
        console.error('Error al obtener fechas:', error);
        // Mostrar mensaje útil al usuario
        addMessageToChat('Ocurrió un error al consultar disponibilidad. Por favor intenta nuevamente.', 'bot');
        return [];
    }
}

async function checkAvailability(coddoc, fecha, hora) {
    try {
        const response = await fetch(`/Meditech/controller/checkavailabilitycontroller.php?coddoc=${coddoc}&fecha=${fecha}&hora=${hora}`);
        const data = await response.json();
        return data.available;
    } catch (error) {
        console.error('Error al verificar la disponibilidad:', error);
        return false;
    }
}

async function updateAvailability(coddoc, fecha, hora) {
    try {
        const response = await fetch('/Meditech/controller/updateavailabilitycontroller.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ coddoc, fecha, hora })
        });
        
        return await response.json();
    } catch (error) {
        console.error('Error en updateAvailability:', error);
        return { success: false };
    }
}

function obtenerIdPaciente() {
    // Opción 1: Desde PHP (la mejor)
    const pacienteId = <?php echo json_encode($_SESSION['id'] ?? null); ?>;
    if (pacienteId) return pacienteId;
    
    // Opción 2: Desde localStorage (como respaldo)
    return localStorage.getItem('pacienteId') || prompt('Por favor ingrese su ID:');
}

async function saveAppointment(appointmentData) {
    try {
        console.log('Enviando:', JSON.stringify(appointmentData, null, 2));
        
        const response = await fetch('/Meditech/controller/saveappointmentcontroller.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            },
            body: JSON.stringify(appointmentData)
        });

        // Manejar respuesta no JSON
        const textResponse = await response.text();
        let result;
        
        try {
            result = JSON.parse(textResponse);
        } catch {
            throw new Error(`Respuesta inválida: ${textResponse.substring(0, 100)}...`);
        }

        if (!response.ok) {
            // Manejar específicamente conflictos de horario
            if (response.status === 409 && result.available_times) {
                const horarios = result.available_times.map(t => t.hora_inicio).join(', ');
                throw new Error(`El horario seleccionado no está disponible. Horarios disponibles: ${horarios}`);
            }
            throw new Error(result.message || 'Error en el servidor');
        }

        return result;

    } catch (error) {
        console.error('Error detallado:', error);
        
        // Mensaje amigable al usuario
        let userMessage = error.message;
        if (error.message.includes('Duplicate entry')) {
            userMessage = 'El horario seleccionado ya está ocupado. Por favor elige otra hora.';
        }
        
        addMessageToChat(`❌ ${userMessage}`, 'bot');
        
        // Si hay horarios alternativos, sugerirlos
        if (error.message.includes('Horarios disponibles')) {
            addMessageToChat('¿Te gustaría agendar en alguno de estos horarios disponibles?', 'bot');
        } else {
            addMessageToChat('Por favor intenta con otra fecha u hora.', 'bot');
        }
        
        throw error;
    }
}

</script>

		<!-- End Custom template -->
	</div>
	<!--   Core JS Files   -->
	<script src="../../assets/js/core/jquery.3.2.1.min.js"></script>
	<script src="../../assets/js/core/popper.min.js"></script>
	<script src="../../assets/js/core/bootstrap.min.js"></script>

	<!-- jQuery UI -->
	<script src="../../assets/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>
	<script src="../../assets/js/plugin/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js"></script>

	<!-- jQuery Scrollbar -->
	<script src="../../assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>


	<!-- Chart JS -->
	<script src="../../assets/js/plugin/chart.js/chart.min.js"></script>

	<!-- jQuery Sparkline -->
	<script src="../../assets/js/plugin/jquery.sparkline/jquery.sparkline.min.js"></script>

	<!-- Chart Circle -->
	<script src="../../assets/js/plugin/chart-circle/circles.min.js"></script>

	<!-- Datatables -->
	<script src="../../assets/js/plugin/datatables/datatables.min.js"></script>

	<!-- Bootstrap Notify -->


	<!-- jQuery Vector Maps -->
	<script src="../../assets/js/plugin/jqvmap/jquery.vmap.min.js"></script>
	<script src="../../assets/js/plugin/jqvmap/maps/jquery.vmap.world.js"></script>

	<!-- Sweet Alert -->
	<script src="../../assets/js/plugin/sweetalert/sweetalert.min.js"></script>

	<!-- Atlantis JS -->
	<script src="../../assets/js/atlantis.min.js"></script>

	<!-- Atlantis DEMO methods, don't include it in your project! -->
	<script src="../../assets/js/setting-demo.js"></script>
	<script src="../../assets/js/demo.js"></script>
	<script>
		Circles.create({
			id: 'circles-1',
			radius: 45,
			value: 60,
			maxValue: 100,
			width: 7,
			text: <?php echo $total; ?>,
			colors: ['#f1f1f1', '#FF9E27'],
			duration: 400,
			wrpClass: 'circles-wrp',
			textClass: 'circles-text',
			styleWrapper: true,
			styleText: true
		})

		Circles.create({
			id: 'circles-2',
			radius: 45,
			value: 70,
			maxValue: 100,
			width: 7,
			text: <?php echo $total2; ?>,
			colors: ['#f1f1f1', '#2BB930'],
			duration: 400,
			wrpClass: 'circles-wrp',
			textClass: 'circles-text',
			styleWrapper: true,
			styleText: true
		})

		Circles.create({
			id: 'circles-3',
			radius: 45,
			value: 40,
			maxValue: 100,
			width: 7,
			text: <?php echo $total3; ?>,
			colors: ['#f1f1f1', '#F25961'],
			duration: 400,
			wrpClass: 'circles-wrp',
			textClass: 'circles-text',
			styleWrapper: true,
			styleText: true
		})

		var totalIncomeChart = document.getElementById('totalIncomeChart').getContext('2d');

		var mytotalIncomeChart = new Chart(totalIncomeChart, {
			type: 'bar',
			data: {
				labels: ["S", "M", "T", "W", "T", "F", "S", "S", "M", "T"],
				datasets: [{
					label: "Total Income",
					backgroundColor: '#ff9e27',
					borderColor: 'rgb(23, 125, 255)',
					data: [6, 4, 9, 5, 4, 6, 4, 3, 8, 10],
				}],
			},
			options: {
				responsive: true,
				maintainAspectRatio: false,
				legend: {
					display: false,
				},
				scales: {
					yAxes: [{
						ticks: {
							display: false //this will remove only the label
						},
						gridLines: {
							drawBorder: false,
							display: false
						}
					}],
					xAxes: [{
						gridLines: {
							drawBorder: false,
							display: false
						}
					}]
				},
			}
		});

		$('#lineChart').sparkline([105, 103, 123, 100, 95, 105, 115], {
			type: 'line',
			height: '70',
			width: '100%',
			lineWidth: '2',
			lineColor: '#ffa534',
			fillColor: 'rgba(255, 165, 52, .14)'
		});
	</script>
</body>

</html>