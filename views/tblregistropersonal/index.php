<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\assets\NpmAsset;

/** @var yii\web\View $this */
/** @var app\models\TblRegistroPersonal $model */
/** @var ActiveForm $form */
$this->registerCssFile('https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css');
$this->registerCssFile('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css');
$this->registerCssFile('https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css');
$this->registerJsFile('https://unpkg.com/aos@2.3.1/dist/aos.js');
$this->registerCssFile('https://unpkg.com/aos@2.3.1/dist/aos.css');

NpmAsset::register($this);
?>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.all.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.all.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

<div class="tblregistropersonal-index">
    <div class="container py-2">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card shadow-lg animate__animated animate__fadeInUp" data-aos="fade-up"
                     data-aos-duration="1000">
                    <div class="card-body p-5">
                        <h2 class="text-center mb-5" data-aos="fade-down" data-aos-delay="200">Registro de Empleado</h2>

                        <?php $form = ActiveForm::begin([
                            'id' => 'registroForm',
                            'options' => ['autocomplete' => 'off'],
                        ]); ?>

                        <div class="row g-4">
                            <?php
                            $fields = [
                                'tbl_registro_personal_nombre' => ['Nombre', 'fa-user'],
                                'tbl_registro_personal_clave' => ['Clave', 'fa-key'],
                                'tbl_registro_personal_puesto' => ['Puesto', 'fa-briefcase'],
                                'tbl_registro_personal_funcion' => ['Función', 'fa-tasks'],
                                'tbl_registro_personal_area' => ['Área', 'fa-building'],
                                'tbl_registro_personal_dep' => ['Departamento', 'fa-sitemap'],
                                'tbl_registro_personal_tarjeta_asis' => ['Tarjeta', 'fa-id-card'],
                                'tbl_registro_personal_correo' => ['Correo', 'fa-envelope'],
                                'tbl_registro_personal_contraseña' => ['Contraseña', 'fa-lock'],
                            ];

                            $delay = 0;
                            foreach ($fields as $field => $info):
                                list($label, $icon) = $info;
                                $delay += 100;
                                ?>
                                <div class="col-md-6" data-aos="fade-up" data-aos-delay="<?= $delay ?>">
                                    <div class="form-floating">
                                        <div class="input-group">
                                            <span class="input-group-text bg-primary text-white"><i
                                                        class="fas <?= $icon ?>"></i></span>
                                            <?= $form->field($model, $field, [
                                                'options' => ['class' => 'form-floating flex-grow-1'],
                                                'template' => "{input}\n{label}\n{error}",
                                            ])->textInput(['placeholder' => $label, 'class' => 'form-control border-start-0']) ?>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>

                        <div class="row g-4 mt-2">
                            <div class="col-md-6" data-aos="fade-up"
                                 data-aos-delay="<?= $delay += 100 ?>">
                                <div class="form-floating">
                                    <?= $form->field($model, 'tbl_registro_personal_jornada', [
                                        'options' => ['class' => 'form-floating'],
                                        'template' => "{input}\n{label}\n{error}",
                                    ])->dropDownList(
                                        ['0' => 'Diurna', '1' => 'Mixta'],
                                        ['prompt' => 'Seleccione la Jornada', 'class' => 'form-select']
                                    )->label('Jornada') ?>
                                </div>
                            </div>
                            <div class="col-md-6" data-aos="fade-up"
                                 data-aos-delay="<?= $delay += 100 ?>">
                                <div class="form-floating">
                                    <?= $form->field($model, 'tbl_registro_personal_contrato', [
                                        'options' => ['class' => 'form-floating'],
                                        'template' => "{input}\n{label}\n{error}",
                                    ])->dropDownList(
                                        ['Base' => 'Base', 'Contrato' => 'Contrato'],
                                        ['prompt' => 'Seleccione el tipo de contrato', 'class' => 'form-select']
                                    )->label('Contrato') ?>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 mt-5" data-aos="fade-up"
                        data-aos-delay="<?= $delay += 100 ?>">
                            <div class="form-floating">
                            <?= $form->field($model, 'roles', [
                                 'options' => ['class' => 'form-floating'],
                                 'template' => "{input}\n{label}\n{error}",
                            ])->dropDownList(
                                $model->getRoleOptions(), 
                                ['prompt' => 'Seleccione un Rol']
                            ) ?>

                            </div>
                        </div>

                        <div class="form-group text-center mt-2">
                            <?= Html::submitButton('Registrar', ['class' => 'btn btn-primary btn-lg px-5 animate__animated animate__pulse animate__infinite', 'id' => 'submitBtn']) ?>
                        </div>

                        <?php ActiveForm::end(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    body {
        background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
        min-height: 100vh;
        font-family: 'Roboto', sans-serif;
    }

    .card {
        border-radius: 15px;
        overflow: hidden;
        transition: all 0.3s ease;
    }

    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
    }

    .input-group-text {
        border-right: none;
    }

    .form-control {
        border-left: none;
    }

    .form-floating > .form-control:focus ~ label,
    .form-floating > .form-control:not(:placeholder-shown) ~ label,
    .form-floating > .form-select ~ label {
        opacity: .65;
        transform: scale(.85) translateY(-.5rem) translateX(.15rem);
    }

    .btn-primary {
        background-color: #4e73df;
        border-color: #4e73df;
        border-radius: 30px;
        padding: 12px 30px;
        font-weight: bold;
        text-transform: uppercase;
        letter-spacing: 1px;
        transition: all 0.3s ease;
    }

    .btn-primary:hover {
        background-color: #2e59d9;
        border-color: #2e59d9;
        transform: translateY(-2px);
        box-shadow: 0 10px 20px rgba(46, 89, 217, 0.2);
    }

    h2 {
        color: #333;
        font-weight: bold;
        text-transform: uppercase;
        letter-spacing: 2px;
    }

    .form-control, .form-select {
        border-radius: 0 5px 5px 0;
    }

    .input-group-text {
        border-radius: 5px 0 0 5px;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', (event) => {
        AOS.init();

        const form = document.getElementById('registroForm');
        const submitBtn = document.getElementById('submitBtn');
        const inputs = document.querySelectorAll('.form-control, .form-select');

        inputs.forEach(input => {
            input.addEventListener('focus', function () {
                this.closest('.form-floating').classList.add('focused');
            });

            input.addEventListener('blur', function () {
                if (this.value === '') {
                    this.closest('.form-floating').classList.remove('focused');
                }
            });
        });

        form.addEventListener('submit', function (e) {
            e.preventDefault();

            if (form.checkValidity()) {
                submitBtn.disabled = true;
                submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Procesando...';

                // Simular envío de formulario
                setTimeout(() => {
                    Swal.fire({
                        title: '¡Registro Exitoso!',
                        text: 'El empleado ha sido registrado correctamente',
                        icon: 'success',
                        confirmButtonText: 'Aceptar'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.reset();
                            submitBtn.disabled = false;
                            submitBtn.innerHTML = 'Registrar';
                        }
                    });
                }, 2000);
            } else {
                Swal.fire({
                    title: 'Error',
                    text: 'Por favor, complete todos los campos requeridos correctamente.',
                    icon: 'error',
                    confirmButtonText: 'Entendido'
                });
            }
        });
    });


    document.addEventListener('DOMContentLoaded', (event) => {
    const form = document.getElementById('registroForm');

    form.addEventListener('submit', function (e) {
        e.preventDefault();

        // Check form validity first
        if (form.checkValidity()) {
            // Show success message with SweetAlert
            Swal.fire({
                title: '¡Registro Exitoso!',
                text: 'El formulario se ha enviado correctamente',
                icon: 'success',
                confirmButtonText: 'Aceptar'
            }).then(() => {
                // Optional: reset form after confirmation
                form.reset();
            });
        } else {
            // Show error if form is invalid
            Swal.fire({
                title: 'Error',
                text: 'Por favor, complete todos los campos requeridos',
                icon: 'error',
                confirmButtonText: 'Entendido'
            });
        }
    });
});
</script>