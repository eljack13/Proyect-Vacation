<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use kartik\date\DatePicker;
$this->registerCssFile('https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css');
$this->registerCssFile('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css');
$this->registerCssFile('https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css');
$this->registerJsFile('https://unpkg.com/aos@2.3.1/dist/aos.js');
$this->registerCssFile('https://unpkg.com/aos@2.3.1/dist/aos.css');

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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    
    <div class="tbl-sata-form container card rounded shadow w-75 p-5" data-aos="zoom-in-up">
        <h1 class="text-center"data-aos="fade-up-right"> Subir Documento </h1>  
        <?php $form = ActiveForm::begin([
            'options' => [
                'enctype' => 'multipart/form-data',
                'class' => 'upload-form card-text',
                'data-aos' => 'zoom-in',
                'data-aos-delay' => '100',
                ]
            ]); ?>

        <?= $form->field($model, 'tbl_sata_nombre')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'tbl_sata_dateint', [
            'errorOptions' => ['class' => 'invalid-tooltip']
        ])->widget(DatePicker::class, [
            'language' => 'es',
            'options' => ['placeholder' => 'Fecha'],
            'pluginOptions' => [
                'format' => 'yyyy/mm/dd',
                'todayHighlight' => true,
                ]
        ])->label('Fecha') ?>


        <?= $form->field($model, 'pdfFile')->fileInput([
            'accept' => 'application/pdf',
            'class' => 'form-control'
        ])->hint('Seleccione un archivo PDF (máx. 10MB)') ?>

        <div class="form-group">
           <div class="d-flex">

               <?= Html::submitButton('Guardar', [
                   'class' => 'btn btn-outline-primary',
                   'id' => 'submit-button'
                   ]) ?>
        </div>
        <span> <a href="<?= Url::to(['tbl-sata/index']) ?>" class="btn btn-outline-primary float-sm-end"><- Regresar </a> </span> 
        
    </div> 
        <?php ActiveForm::end(); ?>
    </div>
    
    <?php
// Agregar JavaScript para validación básica del lado del cliente
$this->registerJs("
    $('#submit-button').on('click', function(e) {
        var fileInput = $('#" . Html::getInputId($model, 'pdfFile') . "')[0];
        if (fileInput.files.length > 0) {
            var file = fileInput.files[0];
            if (file.size > 10 * 1024 * 1024) {
                alert('El archivo es demasiado grande. Máximo 10MB permitido.');
                e.preventDefault();
                return false;
            }
            if (file.type !== 'application/pdf') {
                alert('Solo se permiten archivos PDF.');
                e.preventDefault();
                return false;
            }
        }
    });
");
?>