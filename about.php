            <!DOCTYPE html>
            <html lang="es">

            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Sobre Nosotros - ArchiPlan Store</title>
                <!-- Bootstrap CSS -->
                <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
                <!-- Estilos personalizados -->
                <style>
                    /* Fondo de la página */
                    body {
                        font-family: 'Arial', sans-serif;
                        background-color: #f3f4f6;
                        color: #333;
                        overflow-x: hidden;
                    }

                    /* Encabezado estilizado */
                    header {
                        background: linear-gradient(135deg, #1c1f24, #343a40);
                        color: #ffffff;
                        padding: 30px 0;
                        text-align: center;
                        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
                        position: relative;
                        overflow: hidden;
                    }

                    header h1 {
                        font-size: 2.5rem;
                        font-weight: 700;
                        margin: 0;
                        animation: fadeInDown 1.5s ease;
                    }

                    /* Navbar */
                    nav a {
                        color: #ffffff !important;
                        margin: 0 15px;
                        font-weight: 500;
                        text-transform: uppercase;
                        transition: color 0.3s ease, border-bottom 0.3s ease;
                        font-size: 1.1rem;
                        border-bottom: 2px solid transparent;
                    }

                    nav a:hover {
                        color: #00c4cc !important;
                        text-decoration: none;
                        border-bottom: 2px solid #00c4cc;
                    }

                    /* Contenido principal */
                    main {
                        padding: 50px 20px;
                        max-width: 900px;
                        margin: 50px auto;
                        background: #ffffff;
                        border-radius: 15px;
                        box-shadow: 0 8px 30px rgba(0, 0, 0, 0.1);
                        animation: fadeIn 1.5s ease;
                    }

                    main h2 {
                        color: #1c1f24;
                        font-size: 2rem;
                        margin-bottom: 20px;
                        text-align: center;
                        font-weight: 600;
                        animation: fadeInDown 1.5s ease;
                    }

                    main p {
                        line-height: 1.8;
                        font-size: 1.1rem;
                        color: #555;
                        text-align: justify;
                    }

                    /* Imagen estilizada */
                    .about-image {
                        display: block;
                        max-width: 100%;
                        height: auto;
                        margin: 30px auto;
                        border-radius: 12px;
                        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
                        animation: fadeIn 1.5s ease;
                        transform: scale(1.02);
                        transition: transform 0.3s ease;
                    }

                    .about-image:hover {
                        transform: scale(1.05);
                    }

                    /* Accordion */
                    .accordion-button {
                        transition: background-color 0.3s ease;
                        font-weight: bold;
                    }

                    .accordion-button:not(.collapsed) {
                        background-color: #1c1f24;
                        color: #fff;
                    }

                    .accordion-button:hover {
                        background-color: #343a40;
                        color: #fff;
                    }

                    /* Sección adicional */
                    .benefits-list {
                        animation: fadeIn 1.5s ease;
                    }

                    /* Botones */
                    .btn-custom {
                        background-color: #00c4cc;
                        color: #fff;
                        transition: background-color 0.3s ease, transform 0.3s ease;
                        padding: 10px 20px;
                        border-radius: 50px;
                        font-size: 1rem;
                        font-weight: bold;
                    }

                    .btn-custom:hover {
                        background-color: #008c8c;
                        transform: scale(1.05);
                    }

                    /* Footer */
                    footer {
                        text-align: center;
                        padding: 20px 0;
                        background: #1c1f24;
                        color: #ffffff;
                        font-size: 0.9rem;
                    }

                    /* Animaciones */
                    @keyframes fadeIn {
                        0% {
                            opacity: 0;
                            transform: translateY(20px);
                        }

                        100% {
                            opacity: 1;
                            transform: translateY(0);
                        }
                    }

                    @keyframes fadeInDown {
                        0% {
                            opacity: 0;
                            transform: translateY(-20px);
                        }

                        100% {
                            opacity: 1;
                            transform: translateY(0);
                        }
                    }
                </style>
            </head>

            <body>
                <!-- Encabezado -->
                <header>
                    <h1>Sobre ArchiPlan Store</h1>
                    <nav class="d-flex justify-content-center">
                        <a href="index.php" class="nav-link">Inicio</a>
                        <a href="contact.php" class="nav-link">Contacto</a>
                        <a href="index.php" class="nav-link">Regresar</a>
                    </nav>
                </header>

                <!-- Contenido principal -->
                <main class="container">
                    <h2 class="text-center">¿Qué deseas saber sobre ArchiPlan Store?</h2>
                    <img src="https://th.bing.com/th/id/OIF.b6rbvk1zG9FBwAQQPqIsZg?w=222&h=200&c=7&r=0&o=5&dpr=1.3&pid=1.7"
                        alt="ArchiPlan Store" class="about-image img-fluid">
                    <div class="accordion" id="accordionExample">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingOne">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne"
                                    aria-expanded="true" aria-controls="collapseOne">
                                    Nuestra Historia
                                </button>
                            </h2>
                            <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    ArchiPlan Store fue fundada en 2024 con la misión de ofrecer soluciones arquitectónicas accesibles
                                    para todos. Nuestro catálogo cuenta con una amplia variedad de planos que se adaptan a todo tipo
                                    de proyectos.
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingTwo">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    Nuestras Políticas de la Compra
                                </button>
                            </h2>
                            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    En ArchiPlan Store, queremos asegurarnos de que estés completamente satisfecho con tu compra. Todos
                                    nuestros planos son entregados en formato digital y no se realizan reembolsos una vez que el
                                    plano ha sido descargado. Por favor, asegúrate de verificar todos los detalles antes de
                                    finalizar tu compra.
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingThree">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                    Nuestros Términos y Condiciones
                                </button>
                            </h2>
                            <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    Al utilizar ArchiPlan Store, aceptas nuestros términos y condiciones. Todos los derechos sobre los
                                    planos vendidos en nuestra tienda pertenecen a sus respectivos creadores. No está permitido
                                    revender ni distribuir los planos sin el consentimiento del autor. El incumplimiento de estas
                                    reglas puede llevar a la cancelación de tu cuenta.
                                </div>
                            </div>
                        </div>
                    </div>

            <!-- Bootstrap CSS and Animate.css -->
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
            <style>
                .btn-custom {
                    transition: background-color 0.3s ease, transform 0.3s ease;
                }
                .btn-custom:hover {
                    background-color: #0056b3;
                    transform: scale(1.05);
                }
                .card {
                    border-radius: 15px;
                }
                .card-title {
                    font-weight: bold;
                    font-size: 1.5rem;
                }
                .card-text {
                    font-size: 1rem;
                    margin-bottom: 1.5rem;
                }
            </style>

                    <div class="text-center my-4">
                        <a href="index.php" class="btn btn-custom">Regresar</a>
                    </div>
                </main>

                <!-- Footer -->
                <footer>
                    <p>&copy; 2024 ArchiPlan Store. Todos los derechos reservados.</p>
                </footer>

                <!-- Bootstrap JS Bundle with Popper -->
                <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
            </body>

            </html>
