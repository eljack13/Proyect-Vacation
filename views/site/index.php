<?php
/** @var yii\web\View $this */
$this->registerCssFile('https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css');
$this->registerCssFile('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css');
$this->registerCssFile('https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css');
$this->registerJsFile('https://unpkg.com/aos@2.3.1/dist/aos.js');
$this->registerCssFile('https://unpkg.com/aos@2.3.1/dist/aos.css');
$this->title = 'Vacation App';

// Registrar CSS personalizado
$this->registerCss("
    .site-index {
        position: relative;
        z-index: 1;
    }
    
    .custom-jumbotron {
        background: rgba(255, 255, 255, 0.9);
        border-radius: 15px;
        padding: 2rem;
        box-shadow: 0 8px 32px rgba(31, 38, 135, 0.37);
        backdrop-filter: blur(4px);
        border: 1px solid rgba(255, 255, 255, 0.18);
    }
    
    .feature-card {
        background: rgba(255, 255, 255, 0.95);
        border-radius: 12px;
        padding: 1.5rem;
        transition: all 0.3s ease;
        border: none;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
    }
    
    .feature-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
    }
    
    .custom-btn {
        border-radius: 30px;
        padding: 0.5rem 1.5rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 1px;
        transition: all 0.3s ease;
        background: linear-gradient(45deg, #2563eb, #1e40af);
        border: none;
    }
    
    .custom-btn:hover {
        transform: scale(1.05);
        box-shadow: 0 5px 15px rgba(76, 175, 80, 0.4);
    }
    
    .card-icon {
        font-size: 3rem;
        margin-bottom: 1rem;
      background: linear-gradient(45deg, #0077be, #005c91);

        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }
    
    .section-title {
        background: linear-gradient(45deg, #2196F3, #4CAF50);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        font-weight: 700;
    }
");

// Registrar JS personalizado
$this->registerJs("
    AOS.init({
        duration: 1000,
        once: true,
        mirror: false
    });
    
    // Configuración de particles.js
    particlesJS('particles-js', {
        particles: {
            number: {
                value: 80,
                density: {
                    enable: true,
                    value_area: 800
                }
            },
            color: {
                value: '#4CAF50'
            },
            shape: {
                type: 'circle'
            },
            opacity: {
                value: 0.5,
                random: true
            },
            size: {
                value: 3,
                random: true
            },
            line_linked: {
                enable: true,
                distance: 150,
                color: '#4CAF50',
                opacity: 0.4,
                width: 1
            },
            move: {
                enable: true,
                speed: 3,
                direction: 'none',
                random: true,
                straight: false,
                out_mode: 'out',
                bounce: false
            }
        },
        interactivity: {
            detect_on: 'canvas',
            events: {
                onhover: {
                    enable: true,
                    mode: 'grab'
                },
                onclick: {
                    enable: true,
                    mode: 'push'
                },
                resize: true
            }
        },
        retina_detect: true
    });
");
?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/@mdi/font@7.4.47/css/materialdesignicons.min.css" rel="stylesheet">

<!-- Particles.js container -->
<div id="particles-js" style="position: fixed; top: 0; left: 0; width: 100%; height: 100%; z-index: 0;"></div>

<div class="site-index">
    <div class="jumbotron custom-jumbotron text-center mt-2 mb-5" data-aos="zoom-in-up">
        <h1 class="display-4 section-title mb-2">Bienvenido a la aplicación de vacaciones</h1>
        <p class="lead">Esta es una aplicación de prueba para el control de vacaciones de los empleados</p>
        <hr class="my-1">
        <p class="mb-2">Para comenzar, seleccione una de las opciones del menú de navegación</p>
    </div>

    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-md-4 mb-4" data-aos="zoom-in" data-aos-delay="100">
                <div class="feature-card text-center">
                    <i class="mdi mdi-file-account card-icon"></i>
                    <h5 class="card-title">Ingresar Archivos</h5>
                    <p class="card-text mb-4">En este apartado se pueden subir archivos</p>
                    <a href="<?= \yii\helpers\Url::to(['/tbl-sata/index']) ?>" class="btn btn-primary custom-btn">
                        Ingresar <span class="mdi mdi-file-account ml-2"></span>
                    </a>
                </div>
            </div>

            <div class="col-md-4 mb-4" data-aos="zoom-in" data-aos-delay="200">
                <div class="feature-card text-center">
                    <i class="mdi mdi-account-plus-outline card-icon"></i>
                    <h5 class="card-title">Agregar Empleado</h5>
                    <p class="card-text mb-4">En esta sección podrá agregar nuevos empleados</p>
                    <a href="<?= \yii\helpers\Url::to(['/tblregistropersonal/index']) ?>"
                       class="btn btn-primary custom-btn">
                        Agregar <span class="mdi mdi-account-plus-outline ml-2"></span>
                    </a>
                </div>
            </div>

            <div class="col-md-4 mb-4" data-aos="zoom-in" data-aos-delay="300">
                <div class="feature-card text-center">
                    <i class="mdi mdi-format-list-checkbox card-icon"></i>
                    <h5 class="card-title">Lista de Empleados</h5>
                    <p class="card-text mb-4">En esta sección podrá listar todos los empleados</p>
                    <a href="<?= \yii\helpers\Url::to(['/tblregistropersonal/list']) ?>"
                       class="btn btn-primary custom-btn">
                        Listar <span class="mdi mdi-format-list-checkbox ml-2"></span>
                    </a>
                </div>
            </div>
            <!---Recuerda esconder esta madre para que solamente el jefe lo pueda ver alv --->
            <div class="col-md-4 mb-4" data-aos="zoom-in" data-aos-delay="100">
                <div class="feature-card text-center">
                    <i class="mdi mdi-calendar-plus card-icon"></i>
                    <h5 class="card-title"> Panel de Control de las Vacaciones</h5>
                    <p class="card-text mb-4">En este apartado se pueden hacer en control de la validacion de las vacaciones</p>
                    <a href="<?= \yii\helpers\Url::to(['/tbl-sata/index']) ?>" class="btn btn-primary custom-btn">
                        Ingresar <span class="mdi mdi-calendar-plus ml-2"></span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>






<!---Hecho por eljack13

https://github.com/eljack13
--->