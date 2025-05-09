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
	<!-- Coloca esto en el <head> de tu HTML -->
	<script src="https://unpkg.com/compromise@14.8.0/builds/compromise.min.js"></script>
	<!-- Fonts and icons -->
	
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
														<label>Female</label>
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
const pacienteId = <?php echo isset($_SESSION['id']) ? json_encode($_SESSION['id']) : json_encode(null); ?>;
let chatStep = 0;
let appointmentData = {};
let specialties = [];
let doctors = [];
let availableDates = [];
let isCancelling = false;
let userAppointments = [];
let citasPendientes = [];

// Función para verificar si NLP está cargado
function isNlpLoaded() {
    return typeof window.nlp === 'function';
}

// Versión de emergencia si NLP no carga
function basicNLPFallback(text) {
    console.warn('Usando NLP básico de emergencia');
    return {
        dates: () => ({ out: () => [] }),
        match: () => ({ out: () => [] }),
        values: () => ({ toNumber: () => ({ out: () => [] }) }),
        has: () => false
    };
}

// Función para análisis de mensajes


// El resto de tus funciones permanecen igual, excepto por:


document.getElementById('chatbot-input').addEventListener('keypress', function(e) {
    if (e.key === 'Enter') {
        document.getElementById('chatbot-send').click();
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

// Función para análisis de mensajes

function analyzeMessage(message) {
    const nlp = isNlpLoaded() ? window.nlp : basicNLPFallback;
    const doc = nlp(message.toLowerCase());
    
    // Extracción mejorada de fechas
    let extractedDate = null;
    const dateFormats = [
        { regex: /(\d{4})-(\d{2})-(\d{2})/, format: 'YYYY-MM-DD' }, // 2025-05-09
        { regex: /(\d{2}) de (\w+) de (\d{4})/, format: 'DD de MMM de YYYY' }, // 09 de mayo de 2025
        { regex: /(\d{2})\/(\d{2})\/(\d{4})/, format: 'DD/MM/YYYY' } // 09/05/2025
    ];
    
    for (const format of dateFormats) {
        const match = message.match(format.regex);
        if (match) {
            if (format.format === 'YYYY-MM-DD') {
                extractedDate = match[0];
            } else if (format.format === 'DD de MMM de YYYY') {
                const months = {
                    'enero': '01', 'febrero': '02', 'marzo': '03', 'abril': '04',
                    'mayo': '05', 'junio': '06', 'julio': '07', 'agosto': '08',
                    'septiembre': '09', 'octubre': '10', 'noviembre': '11', 'diciembre': '12'
                };
                const day = match[1].padStart(2, '0');
                const month = months[match[2].toLowerCase()];
                const year = match[3];
                extractedDate = `${year}-${month}-${day}`;
            } else if (format.format === 'DD/MM/YYYY') {
                const [day, month, year] = match[0].split('/');
                extractedDate = `${year}-${month.padStart(2, '0')}-${day.padStart(2, '0')}`;
            }
            break;
        }
    }
    
    // Extracción mejorada de horas
    let extractedTime = null;
    const timeMatch = message.match(/(\d{1,2})(?::(\d{2}))?\s*(am|pm)?/i);
    if (timeMatch) {
        let hours = parseInt(timeMatch[1]);
        const minutes = timeMatch[2] || '00';
        const period = timeMatch[3] ? timeMatch[3].toLowerCase() : null;
        
        if (period === 'pm' && hours < 12) hours += 12;
        if (period === 'am' && hours === 12) hours = 0;
        
        extractedTime = `${hours.toString().padStart(2, '0')}:${minutes.padStart(2, '0')}`;
    }
    
    // Extracción de números
    const numberMatch = message.match(/\d+/);
    
    return {
        text: message,
        dates: extractedDate,
        times: extractedTime,
        numbers: numberMatch ? parseInt(numberMatch[0]) : null,
        intent: getBasicIntent(message.toLowerCase()),
        originalDoc: doc
    };
}

// Detección básica de intenciones
function getBasicIntent(message) {
    if (/(hola|buenos|buenas|saludos)/i.test(message)) return 'greeting';
    if (/(adi[óo]s|chao|hasta luego)/i.test(message)) return 'farewell';
    if (/(gracias|agradezco)/i.test(message)) return 'thanks';
    if (/(agendar|solicitar|reservar|cita)/i.test(message)) return 'schedule';
    if (/(cancelar|anular|eliminar|cita)/i.test(message)) return 'cancel';
    if (/(s[ií]|confirmo|correcto|ok)/i.test(message)) return 'confirm';
    if (/(no|negativo|cancelar)/i.test(message)) return 'deny';
    if (/(ayuda|help|no entiendo)/i.test(message)) return 'help';
    return 'unknown';
}

document.getElementById('chatbot-send').addEventListener('click', async function() {
    let userMessage = document.getElementById('chatbot-input').value;
    if (userMessage.trim() !== '') {
        addMessageToChat(userMessage, 'user');
        document.getElementById('chatbot-input').value = '';
        
        try {
            const botResponse = await generateBotResponse(userMessage);
            addMessageToChat(botResponse, 'bot');
        } catch (error) {
            console.error("Error en el chatbot:", error);
            addMessageToChat("Disculpa, estoy teniendo dificultades. Por favor intenta de nuevo más tarde.", 'bot');
        }
    }
});


async function generateBotResponse(message) {
    const analysis = analyzeMessage(message);
    console.log("Análisis NLP:", analysis); // Para depuración
    
    const handleUnexpected = () => {
        chatStep = 0;
        isCancelling = false;
        appointmentData = {};
        userAppointments = [];
        
        const prompts = [
            "Disculpa, no entendí. ¿Necesitas agendar o cancelar una cita?",
            "Puedo ayudarte con agendar o cancelar citas. ¿Qué necesitas?",
            "¿Te gustaría agendar una cita o cancelar una existente?"
        ];
        return prompts[Math.floor(Math.random() * prompts.length)];
    };

    // Manejar intenciones generales independientemente del paso
    if (analysis.intent === 'greeting' && chatStep === 0) {
        return '¡Hola! ¿En qué puedo ayudarte hoy? ¿Quieres agendar o cancelar una cita?';
    }
    
    if (analysis.intent === 'thanks') {
        return '¡De nada! ¿Hay algo más en lo que pueda ayudarte?';
    }
    
    if (analysis.intent === 'farewell') {
        return '¡Hasta luego! Que tengas un buen día.';
    }
    
    if (analysis.intent === 'help') {
        return getHelpResponse(chatStep);
    }

    switch (chatStep) {
        case 0:
            chatStep++;
            if (analysis.intent === 'schedule') {
                chatStep++;
                addMessageToChat('Perfecto, estoy obteniendo las especialidades disponibles...', 'bot');
                const specialtiesMessage = await fetchSpecialties();
                return specialtiesMessage;
            } else if (analysis.intent === 'cancel') {
                isCancelling = true;
                chatStep = 100;
                return await startCancellationProcess();
            }
            return '¡Hola! ¿Te gustaría agendar o cancelar una cita? (responde "agendar" o "cancelar")';

        case 1:
            if (analysis.intent === 'schedule' || message.includes('agendar')) {
                chatStep++;
                addMessageToChat('Perfecto, estoy obteniendo las especialidades disponibles...', 'bot');
                const specialtiesMessage = await fetchSpecialties();
                return specialtiesMessage;
            } else if (analysis.intent === 'cancel' || message.includes('cancelar')) {
                isCancelling = true;
                chatStep = 100;
                return await startCancellationProcess();
            } else {
                return handleUnexpected();
            }

        case 2:
            let selectedSpecialty;
            if (analysis.numbers) {
                const index = analysis.numbers - 1;
                if (index >= 0 && index < specialties.length) {
                    selectedSpecialty = specialties[index];
                }
            } else {
                const searchTerm = message.toLowerCase().normalize("NFD").replace(/[\u0300-\u036f]/g, "");
                selectedSpecialty = specialties.find(s => 
                    s.nombrees.toLowerCase().normalize("NFD").replace(/[\u0300-\u036f]/g, "").includes(searchTerm)
                );
            }

            if (selectedSpecialty) {
                appointmentData.codespe = selectedSpecialty.codespe;
                const doctorsMessage = await fetchDoctorsBySpecialty(selectedSpecialty.codespe);
                
                if (doctors.length === 0) {
                    chatStep = 2;
                    return `⚠️ No hay doctores disponibles para ${selectedSpecialty.nombrees}.\n\n${await fetchSpecialties()}`;
                }
                
                chatStep++;
                return doctorsMessage;
            } else {
                const specialtiesList = specialties.map((s, index) => `${index + 1}. ${s.nombrees}`).join('\n');
                return `Especialidad no válida. Opciones:\n${specialtiesList}\n(Escribe número o nombre)`;
            }

        case 3:
            let selectedDoctor;
            if (analysis.numbers) {
                const index = analysis.numbers - 1;
                if (index >= 0 && index < doctors.length) {
                    selectedDoctor = doctors[index];
                }
            } else {
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
                addMessageToChat(`Doctor: ${appointmentData.doctor}. Buscando fechas...`, 'bot');
                availableDates = await fetchAvailableDates(selectedDoctor.coddoc);
                return availableDates.length > 0 ? 
                    `Fechas disponibles:\n${availableDates.join('\n')}\n(Puedes escribir la fecha como "15 de diciembre" o "2023-12-15")` :
                    'No hay fechas disponibles. Elige otro doctor.';
            } else {
                const doctorsList = doctors.map((d, index) => `${index + 1}. ${d.nomdoc} ${d.apedoc}`).join('\n');
                return `Doctor no válido. Opciones:\n${doctorsList}\n(Escribe número o nombre)`;
            }

        case 4:
			let selectedDate = analysis.dates;
			
			// Si no se detectó fecha con NLP, intenta otros formatos
			if (!selectedDate) {
				// Formato "09 de mayo de 2025"
				const spanishDateMatch = message.match(/(\d{2}) de (\w+) de (\d{4})/);
				if (spanishDateMatch) {
					const months = {
						'enero': '01', 'febrero': '02', 'marzo': '03', 'abril': '04',
						'mayo': '05', 'junio': '06', 'julio': '07', 'agosto': '08',
						'septiembre': '09', 'octubre': '10', 'noviembre': '11', 'diciembre': '12'
					};
					const day = spanishDateMatch[1].padStart(2, '0');
					const month = months[spanishDateMatch[2].toLowerCase()];
					const year = spanishDateMatch[3];
					selectedDate = `${year}-${month}-${day}`;
				}
				// Si es un número, usa la selección por índice
				else if (analysis.numbers && availableDates.length >= analysis.numbers) {
					selectedDate = availableDates[analysis.numbers - 1];
				}
			}

			if (selectedDate && availableDates.includes(selectedDate)) {
				appointmentData.date = selectedDate;
				chatStep++;
				return `Fecha: ${selectedDate}. ¿Qué horario prefieres? (Ejemplos: "3 pm", "15:30", "4")`;
			} else {
				return `Fecha no válida o no disponible. Por favor selecciona una de estas opciones:\n${availableDates.map((d, i) => `${i+1}. ${d}`).join('\n')}\nPuedes escribir el número o la fecha completa.`;
			}

		case 5:
			let selectedTime = analysis.times;
			
			// Si no se detectó hora con NLP, intenta interpretar formatos simples
			if (!selectedTime) {
				// Formato "4pm" o "4 pm"
				const periodMatch = message.match(/(\d{1,2})\s*(am|pm)/i);
				if (periodMatch) {
					let hours = parseInt(periodMatch[1]);
					const period = periodMatch[2].toLowerCase();
					if (period === 'pm' && hours < 12) hours += 12;
					if (period === 'am' && hours === 12) hours = 0;
					selectedTime = `${hours.toString().padStart(2, '0')}:00`;
				}
				// Solo número (ej: "4")
				else if (analysis.numbers) {
					selectedTime = `${analysis.numbers.toString().padStart(2, '0')}:00`;
				}
			}

			if (selectedTime) {
				appointmentData.time = selectedTime;
				chatStep++;
				const available = await checkAvailability(appointmentData.coddoc, appointmentData.date, appointmentData.time);
				if (available) {
					return `Confirmación:\nFecha: ${appointmentData.date}\nHora: ${appointmentData.time}\nDoctor: ${appointmentData.doctor}\n¿Es correcto? (sí/no)`;
				} else {
					chatStep--; // Permite seleccionar otro horario
					return `El horario ${selectedTime} no está disponible. Por favor elige otro horario.`;
				}
			} else {
				return 'Por favor ingresa un horario válido. Ejemplos: "9:30", "2 pm" o simplemente "3" para las 3:00 pm.';
			}
        case 6:
            if (analysis.intent === 'confirm') {
                try {
                    const result = await saveAppointment(appointmentData);
                    chatStep = 0;
                    return `✅ Cita agendada! ${result.data.date} ${result.data.time}\n¿Necesitas algo más?`;
                } catch (error) {
                    chatStep = 0;
                    return '❌ Error al agendar. ¿Reintentar? (sí/no)';
                }
            }
            chatStep = 0;
            return 'Agendamiento cancelado. ¿Necesitas algo más?';

        case 100:
            try {
                citasPendientes = await fetchUserAppointments();
                
                if (citasPendientes.length === 0) {
                    isCancelling = false;
                    chatStep = 0;
                    return 'No tienes citas pendientes para cancelar.';
                }
                
                chatStep++;
                return `Tus citas activas:\n${formatAppointments(citasPendientes)}\nIngresa el número de la cita a cancelar (1-${citasPendientes.length}):`;
            } catch (error) {
                console.error('Error al obtener citas:', error);
                isCancelling = false;
                chatStep = 0;
                return 'Ocurrió un error al obtener tus citas. Por favor intenta nuevamente.';
            }

        case 101:
            try {
                const selectedIndex = analysis.numbers ? analysis.numbers - 1 : parseInt(message) - 1;
                
                if (isNaN(selectedIndex) || selectedIndex < 0 || selectedIndex >= citasPendientes.length) {
                    return `Número inválido. Por favor ingresa un número entre 1 y ${citasPendientes.length}:`;
                }
                
                appointmentData.citaSeleccionada = citasPendientes[selectedIndex];
                chatStep++;
                return `¿Confirmas cancelar la cita del ${appointmentData.citaSeleccionada.fecha} ${appointmentData.citaSeleccionada.hora} con ${appointmentData.citaSeleccionada.doctor}? (sí/no)`;
            } catch (error) {
                console.error('Error al procesar selección:', error);
                return 'Ocurrió un error al procesar tu selección. Por favor intenta nuevamente.';
            }

        case 102:
            if (analysis.intent === 'confirm') {
                addMessageToChat('Eliminando cita permanentemente...', 'bot');
                try {
                    const resultado = await cancelAppointment(appointmentData.citaSeleccionada.codcit);
                    
                    if (resultado.success) {
                        citasPendientes = await fetchUserAppointments();
                        chatStep = 0;
                        isCancelling = false;
                        return '✅ Cita eliminada permanentemente. ¿Necesitas algo más?';
                    } else {
                        throw new Error(resultado.message || 'Error al eliminar');
                    }
                } catch (error) {
                    console.error('Error al eliminar:', error);
                    return `❌ ${error.message}\n\n¿Quieres intentar con otra cita? (sí/no)`;
                }
            } else {
                chatStep = 0;
                isCancelling = false;
                return 'Operación cancelada. ¿Necesitas algo más?';
            }

        default:
            return handleUnexpected();
    }
}


// Funciones auxiliares
// Función de ayuda para mensajes contextuales
function getHelpResponse(currentStep) {
    const helpMessages = {
        0: "Puedo ayudarte a agendar o cancelar citas médicas. Solo dime 'agendar' para programar una nueva cita o 'cancelar' para eliminar una existente.",
        1: "Por favor indica si quieres 'agendar' una nueva cita o 'cancelar' una existente.",
        2: "Debes seleccionar una especialidad médica. Puedes escribir el número o el nombre de la especialidad que necesitas.",
        3: "Ahora elige un doctor. Escribe el número o nombre del profesional que prefieras.",
        4: "Selecciona una fecha disponible para tu cita. Puedes escribirla en formato '15 de marzo' o '2023-03-15'.",
        5: "Indica la hora para tu cita. Puedes usar formato 24h (14:30) o 12h (2:30 pm).",
        6: "Confirma si los datos de tu cita son correctos respondiendo 'sí' o 'no'.",
        100: "Estás en el proceso de cancelación. Primero necesito listar tus citas activas.",
        101: "Por favor ingresa el número de la cita que deseas cancelar.",
        102: "Confirma si deseas cancelar la cita seleccionada respondiendo 'sí' o 'no'."
    };
    
    return helpMessages[currentStep] || "Estoy aquí para ayudarte a agendar o cancelar citas médicas. ¿En qué paso necesitas ayuda?";
}


async function startCancellationProcess() {
    userAppointments = await fetchUserAppointments();
    if (userAppointments.length === 0) {
        isCancelling = false;
        chatStep = 0;
        return 'No tienes citas activas.';
    }
    return `Tus citas:\n${formatAppointments(userAppointments)}\nIngresa el número a cancelar:`;
}

async function fetchUserAppointments() {
    try {
        const response = await fetch('/Meditech/controller/getuserappointments.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ pacienteId: pacienteId })
        });

        if (!response.ok) {
            throw new Error(`Error HTTP: ${response.status}`);
        }

        const data = await response.json();
        
        if (!data.success) {
            throw new Error(data.error || 'Error al obtener citas');
        }

        // Procesar datos para consistencia
        return data.data.map(cita => ({
            codcit: cita.id || cita.codcit,
            fecha: cita.fecha || cita.dates,
            hora: cita.hora || cita.hour,
            doctor: cita.doctor || (cita.nomdoc ? `${cita.nomdoc} ${cita.apedoc}` : undefined),
            nombrees: cita.especialidad || cita.nombrees,
            estado: cita.estado
        }));

    } catch (error) {
        console.error('Error en fetchUserAppointments:', error);
        throw error; // Re-lanzar para manejar en el flujo principal
    }
}

function formatAppointments(appointments) {
    if (!appointments || appointments.length === 0) {
        return "No se encontraron citas.";
    }

    return appointments.map((appt, index) => {
        // Asegurar que todos los campos existan
        const fecha = appt.fecha || appt.dates || '--/--/----';
        const hora = appt.hora || appt.hour || '--:--';
        const doctor = appt.doctor || 
                      (appt.nomdoc && appt.apedoc ? `${appt.nomdoc} ${appt.apedoc}` : 'Doctor no disponible');
        const especialidad = appt.especialidad || appt.nombrees || 'Especialidad no disponible';

        return `${index + 1}. ${fecha} ${hora} - ${doctor} (${especialidad})`;
    }).join('\n');
}

function validateSelectedAppointment(input) {
    const index = parseInt(input) - 1;
    return userAppointments[index];
}

async function cancelAppointment(codcit) {
    try {
        const response = await fetch('/Meditech/controller/cancelappointment.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ codcit })
        });

        const result = await response.json();
        
        if (result.success) {
            // Actualizar la lista local eliminando la cita
            citasPendientes = citasPendientes.filter(cita => cita.codcit !== codcit);
            return result;
        } else {
            throw new Error(result.message || 'Error al eliminar la cita');
        }
    } catch (error) {
        console.error('Error al eliminar cita:', error);
        throw error;
    }
}

// Funciones existentes (fetchSpecialties, fetchDoctorsBySpecialty, etc.) se mantienen igual


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
	<script src="https://unpkg.com/compromise@14.8.0/builds/compromise.min.js"></script>
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