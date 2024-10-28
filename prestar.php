                <?php

                session_start();

                // Verifica si la variable de sesión 'usuario' está definida
                //$usuario = isset($_SESSION['usuario']) ? $_SESSION['usuario'] : 'Invitado';

                date_default_timezone_set('America/Cancun');

                $conn = new mysqli("localhost", "root", "", "planos");

                if ($conn->connect_error) {
                    die("Conexión fallida: " . $conn->connect_error);
                }

                $compra_exitosa = false; 
                $error_msg = ""; 

                // Verificar si se seleccionó un plano o condominio
                if (isset($_GET['id_plano'])) {
                    $id_plano = intval($_GET['id_plano']);

                    $sql = "SELECT * FROM Planos_Residenciales WHERE id_planos = ?";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("i", $id_plano);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    $plano = $result->fetch_assoc();
                    if (!$plano) {
                        die("Plano no encontrado.");
                    }
                } 
                
                elseif (isset($_GET['id_condominio'])) {
                    $id_condominio = intval($_GET['id_condominio']);

                    $sql = "SELECT * FROM condominios_horizontales WHERE id_condominio = ?";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("i", $id_condominio);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    $condominio = $result->fetch_assoc();
                    if (!$condominio) {
                        die("Condominio no encontrado.");
                    }
                } 
                
                elseif (isset($_GET['id_departamento'])) {
                    $id_departamento = intval($_GET['id_departamento']);

                    $sql = "SELECT * FROM Departamentos WHERE id_departamento = ?";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("i", $id_departamento);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    $departamento = $result->fetch_assoc();
                    if (!$departamento) {
                        die("Departamento no encontrado.");
                    }
                } else {
                    die("ID de plano, condominio o departamento no proporcionado.");
                }

                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    $metodo_pago = $_POST['metodo_pago'];
                    $email_usuario = $_POST['email_usuario']; 
                    $fecha_hora = date("Y-m-d H:i:s"); 

                    if ($metodo_pago === 'Seleccionar') {
                        $error_msg = 'Por favor seleccione la forma de pago.';
                    } elseif (!filter_var($email_usuario, FILTER_VALIDATE_EMAIL)) {
                        $error_msg = 'Por favor ingrese un correo electrónico válido.';
                    } else {
                        session_start();
                        //$id_usuario = $_SESSION['id_usuario'];

                        // Registro de compra para planos
                        if (isset($plano)) {
                            $precio_plano = floatval($plano['precio']);
                            $sql = "INSERT INTO Historial_Compras (tipo_plano, precio_plano, metodo_pago, fecha_hora, email_usuario, id_usuario) 
                                    VALUES (?, ?, ?, ?, ?, ?)";
                            $stmt = $conn->prepare($sql);
                            $stmt->bind_param("sdsssi", $plano['nombre'], $precio_plano, $metodo_pago, $fecha_hora, $email_usuario, $id_usuario);

                            if ($stmt->execute()) {
                                $compra_exitosa = true; 
                            } else {
                                $error_msg = "Error al procesar la compra del plano: " . $conn->error;
                            }
                        } 

                        // Registro de compra para departamentos
                        elseif (isset($departamento)) {
                            $precio_departamento = floatval($departamento['precio']);
                            $sql = "INSERT INTO historial_departamento (id_usuario, tipo_departamento, precio_departamento, metodo_pago, fecha_hora) 
                                    VALUES (?, ?, ?, ?, ?)";
                            $stmt = $conn->prepare($sql);
                            $stmt->bind_param("issss", $id_usuario, $departamento['tipo_departamento'], $precio_departamento, $metodo_pago, $fecha_hora);

                            if ($stmt->execute()) {
                                $compra_exitosa = true; 
                            } else {
                                $error_msg = "Error al procesar la compra del departamento: " . $conn->error;
                            }
                        } 
                        
                        // Registro de compra para condominios
                        elseif (isset($condominio)) {
                            $precio_condominio = floatval($condominio['precio']);
                            $sql = "INSERT INTO Historial_Condominio (id_usuario, nombre_condominio, precio_condominio, metodo_pago, fecha_hora) 
                                    VALUES (?, ?, ?, ?, ?)";
                            $stmt = $conn->prepare($sql);
                            $stmt->bind_param("issss", $id_usuario, $condominio['nombre_condominio'], $precio_condominio, $metodo_pago, $fecha_hora);

                            if ($stmt->execute()) {
                                $compra_exitosa = true; 
                            } else {
                                $error_msg = "Error al procesar la compra del condominio: " . $conn->error;
                            }
                        }
                    }
                }
                
                ?>

        <!DOCTYPE html>
        <html lang="es">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">

            <title>Formulario de Compra</title>

            <!-- Enlace a Bootstrap 5 y Font Awesome -->
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
            <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

            <style>

                body {
                    background-color: #f4f6f9;
                    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
                }

                .form-container {
                    margin: 40px auto;
                    padding: 40px;
                    border-radius: 15px;
                    box-shadow: 0 6px 30px rgba(0, 0, 0, 0.1);
                    background-color: #ffffff;
                    max-width: 600px;
                }
                
                h1 {
                    color: #343a40;
                    font-weight: bold;
                    margin-bottom: 25px;
                }

                .btn-custom {
                    background-color: #28a745;
                    color: #fff;
                    font-size: 18px;
                    padding: 10px 20px;
                    border-radius: 50px;
                    transition: background-color 0.3s ease;
                }

                .btn-custom:hover {
                    background-color: #218838;
                }

                .success {
                    background-color: #d4edda;
                    color: #155724;
                    padding: 15px;
                    border: 1px solid #c3e6cb;
                    border-radius: 10px;
                    margin-top: 20px;
                    font-weight: bold;
                    text-align: center;
                }
                
                .error {
                    background-color: #f8d7da;
                    color: #721c24;
                    padding: 15px;
                    border: 1px solid #f5c6cb;
                    border-radius: 10px;
                    margin-top: 20px;
                    font-weight: bold;
                    text-align: center;
                }

                .form-text {
                    font-size: 0.9em;
                    color: #6c757d;
                }

                .payment-details {
                    border: 1px solid #ddd;
                    border-radius: 8px;
                    padding: 20px;
                    background-color: #f8f9fa;
                    margin-top: 30px;
                }

                .form-group label {
                    font-weight: bold;
                }

                .form-group i {
                    color: #007bff;
                    margin-right: 8px;
                }

                .input-group-text {
                    background-color: #e9ecef;
                    border-radius: 0.25rem;
                }

                body {
            background-color: #f4f6f9;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .form-container {
            margin: 40px auto;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 6px 30px rgba(0, 0, 0, 0.1);
            background-color: #ffffff;
            max-width: 600px;
        }
        h1 {
            color: #343a40;
            font-weight: bold;
            margin-bottom: 25px;
        }
        .btn-custom {
            background-color: #28a745;
            color: #fff;
            font-size: 18px;
            padding: 10px 20px;
            border-radius: 50px;
            transition: background-color 0.3s ease;
        }
        .btn-custom:hover {
            background-color: #218838;
        }
        .success, .error {
            padding: 15px;
            border-radius: 10px;
            margin-top: 20px;
            font-weight: bold;
            text-align: center;
        }
        .success { background-color: #d4edda; color: #155724; }
        .error { background-color: #f8d7da; color: #721c24; }
        .form-text { font-size: 0.9em; color: #6c757d; }
        .payment-details { padding: 20px; background-color: #f8f9fa; margin-top: 30px; }
        .navbar-brand img { width: 30px; height: 30px; }
        footer { background-color: #f8f9fa; padding: 15px 0; }
        .social-icons a { margin: 0 10px; font-size: 20px; color: #007bff; }
        .social-icons a:hover { color: #0056b3; }

            </style>

        </head>

        <body>

        <!-- Barra de navegación -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="about.php">
                <img src="https://u-static.fotor.com/images/text-to-image/result/PRO-886967f1cd4f48f79be8d0b4a41e867e.jpg" alt="Logo">
                ArchiPlan Store
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item"><a class="nav-link" href="index.php">🏡 Inicio</a></li>
                    <li class="nav-item"><a class="nav-link" href="contact.php">📞 Contáctanos</a></li>
                    <li class="nav-item"><a class="nav-link" href="nosotros.php"><i class="fas fa-gift"></i> Beneficios</a></li>
                    <li class="nav-item"><a class="nav-link" href="about.php">📋 Acerca de Nosotros</a></li>
                    <!--<li class="nav-item"><a class="nav-link" href="renders.php">⬅️ Regresar</a></li>
                </ul>
                <ul class="navbar-nav">
                    <li class="nav-item profile-link">
                        <a class="nav-link" href="profile.php">👤<?php echo htmlspecialchars($usuario); ?></a>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="logout.php">🚪 Cerrar Sesión</a></li>
                --></ul>
            </div>
        </div>
    </nav>

        <div class="container form-container">
            <h1 class="text-center">Formulario para Pagar</h1>

            <!-- Mensaje de error -->
            <?php if ($error_msg): ?>
                <div class="error"><?php echo $error_msg; ?></div>
            <?php endif; ?>

            <!-- Formulario de compra -->
            <form method="post">

                <div class="form-group mb-3">

                    <label for="tipo_plano"><i class="fas fa-file-alt"></i> Nombre</label>

                    <input type="text" class="form-control" id="tipo_plano" 
                        value="<?php echo isset($plano) ? $plano['nombre'] : (isset($condominio) ? $condominio['nombre_condominio'] : $departamento['tipo_departamento']); ?>" 
                        disabled>

                    <small class="form-text">Es un:

                        <strong>

                            <?php
                            if (isset($plano)) {
                                echo "Renders";
                            } elseif (isset($condominio)) {
                                echo "Condominio";
                            } else {
                                echo "Departamento";
                            }
                            ?>

                        </strong>

                    </small>

                </div>

                <div class="form-group mb-3">

                    <label for="precio_plano"><i class="fas fa-dollar-sign"></i> Precio</label>

                    <input type="text" class="form-control" id="precio_plano" 
                        value="$<?php echo isset($plano) ? number_format($plano['precio'], 2) : (isset($condominio) ? number_format($condominio['precio'], 2) : number_format($departamento['precio'], 2)); ?>" 
                        disabled>

                </div>

                <div class="form-group mb-3">
                    <label for="email_usuario"><i class="fas fa-envelope"></i> Correo Electrónico</label>
                    <input type="email" class="form-control" id="email_usuario" name="email_usuario" placeholder="Ingresa tu correo electrónico" required>
                </div>

                <div class="form-group mb-3">

                    <label for="metodo_pago"><i class="fas fa-credit-card"></i> Método de Pago</label>

                    <select class="form-control" id="metodo_pago" name="metodo_pago" required onchange="mostrarFormularioPago()">

                        <option value="">Seleccione una forma de pago</option>
                        <option value="Tarjeta de Debito">Tarjeta de Débito</option>
                        <option value="Tarjeta de Crédito">Tarjeta de Crédito</option>
                        <option value="PayPal">PayPal</option>
                        <option value="Mercado Pago">Mercado Pago</option>

                    </select>

                </div>

                <!-- Formulario para tarjetas -->
                <div id="form-tarjeta" class="payment-details" style="display:none;">

                    <h3>Detalles de la Tarjeta</h3>

                    <div class="form-group mb-3">
                        <label for="numero_tarjeta"><i class="fas fa-credit-card"></i> Número de Tarjeta</label>
                        <input type="text" class="form-control" id="numero_tarjeta" placeholder="Ingresa tu número de tarjeta" oninput="detectarBanco()" required>
                        <div id="banco-tarjeta" class="mt-2"></div>
                    </div>

                    <div class="form-group mb-3">
                        <label for="nombre_titular"><i class="fas fa-user"></i> Nombre del Titular</label>
                        <input type="text" class="form-control" id="nombre_titular" placeholder="Ingresa tu nombre" required>
                    </div>

                    <div class="form-group mb-3">
                        <label for="fecha_expiracion"><i class="fas fa-calendar-alt"></i> Fecha de Vencimiento</label>
                        <input type="month" class="form-control" id="fecha_expiracion" required>
                    </div>

                    <div class="form-group mb-3">
                        <label for="codigo_seguridad"><i class="fas fa-lock"></i> CVC</label>
                        <input type="password" class="form-control" id="codigo_seguridad" required>
                    </div>

                </div>

                <button type="submit" class="btn btn-custom btn-block">Comprar</button>

            </form>

        </div>

            <!-- Pie de página -->
    <footer class="bg-light text-center py-4">
        <p>&copy; 2024 ArchiPlan Store. Todos los derechos reservados.</p>
        <div class="social-icons">
            <p>Síguenos en:</p>
            <a href="https://www.facebook.com/" target="_blank" class="fab fa-facebook"></a>
            <a href="https://www.twitter.com/" target="_blank" class="fab fa-twitter"></a>
            <a href="https://www.instagram.com/" target="_blank" class="fab fa-instagram"></a>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

        <script>

            function mostrarFormularioPago() {
                var metodoPago = document.getElementById('metodo_pago').value;
                var forms = document.querySelectorAll('.payment-details');
                forms.forEach(function(form) {
                    form.style.display = 'none';
                });

                if (metodoPago === 'Tarjeta de Debito' || metodoPago === 'Tarjeta de Crédito') {
                    document.getElementById('form-tarjeta').style.display = 'block';
                }
            }

            function detectarBanco() {
                var numeroTarjeta = document.getElementById('numero_tarjeta').value;
                var bancoElemento = document.getElementById('banco-tarjeta');
                bancoElemento.textContent = ''; 

                if (numeroTarjeta.startsWith('4')) {
                    bancoElemento.textContent = 'El Banco es: Visa';
                } else if (numeroTarjeta.startsWith('5')) {
                    bancoElemento.textContent = 'El Banco es: MasterCard';
                } else if (numeroTarjeta.startsWith('3')) {
                    bancoElemento.textContent = 'El Banco es: American Express';
                } else if (numeroTarjeta.startsWith('6')) {
                    bancoElemento.textContent = 'El Banco es: Discover';
                } else {
                    bancoElemento.textContent = 'Banco Desconocido, Favor de escribir Correctamente su Numero de Tarjeta.'; 
                }
            }

        </script>

        </body>
        </html>
