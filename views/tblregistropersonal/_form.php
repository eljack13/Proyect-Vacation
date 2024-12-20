<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\TblRegistroPersonal $model */
/** @var yii\widgets\ActiveForm $form */
$this->registerCssFile('https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css');
$this->registerCssFile('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css');


?>

<div class="tbl-registro-personal-form">




<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.all.min.js"></script>
<div class="tblregistropersonal-index">
    <div class="container py-1">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card animate__animated animate__fadeIn">
                    <div class="card-body p-3">
                        <h2 class="text-center mb-4 animate__animated animate__bounceIn">Registro de Empleado</h2>

                        <?php $form = ActiveForm::begin([
                            'id' => 'registroForm',
                            'options' => ['autocomplete' => 'off'],

                        ]); ?>

                        <div class="row g-3">
                            <?php
                            $fields = [
                                'tbl_registro_personal_nombre' => ['Nombre', 'fa-user'],
                                'tbl_registro_personal_clave' => ['Clave', 'fa-key'],
                                'tbl_registro_personal_puesto' => ['Puesto', 'fa-briefcase'],
                                'tbl_registro_personal_funcion' => ['Función', 'fa-tasks'],
                                'tbl_registro_personal_area' => ['Área', 'fa-building'],
                                'tbl_registro_personal_dep' => ['Departamento', 'fa-sitemap'],
                                'tbl_registro_personal_tarjeta_asis' => ['Tarjeta', 'fa-id-card'],
                                // 'tbl_registro_personal_jornada' => ['Jornada', 'fa-clock'],
                                'tbl_registro_personal_correo' => ['Correo', 'fa-envelope'],
                                'tbl_registro_personal_contraseña' => ['Contraseña', 'fa-lock'],
                                // 'tbl_registro_personal_contrato' => ['Contrato', 'fa-file-contract']
                            ];

                            foreach ($fields as $field => $info):
                                list($label, $icon) = $info;
                            ?>
                                <div class="col-md-6 animate__animated animate__fadeInUp" data-aos-delay="12">
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas <?= $icon ?>"></i></span>
                                        <?= $form->field($model, $field, [
                                            'options' => ['class' => 'form-floating'],
                                            'template' => "{input}\n{label}\n{error}",
                                        ])->textInput(['placeholder' => $label, 'class' => 'form-control']) ?>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <div class="col-md-8 animate__animated animate__fadeInUp" data-aos-delay="12">
                            <div class="">

                                <div class="input-group mb-3 mt-3">
                                    <span class="input-group-text"><i class="fa fa-search"></i></span>
                                    <?= $form->field($model, 'tbl_registro_personal_jornada', [
                                        'options' => ['class' => 'form-floating'],
                                        'template' => '{input}{label}{error}',
                                        'errorOptions' => ['class' => 'invalid-tooltip']
                                    ])->dropDownList(
                                        ['0' => 'Duirna', '1' => 'Mixta'],
                                        ['prompt' => 'Seleccione la Jornada', 'class' => 'form-select']
                                    )->label('Periodo') ?>

                                </div>
                                <div class="input-group mb-3 ">
                                    <span class="input-group-text"><i class="fas fa-file-contract"></i></span>
                                    <?= $form->field($model, 'tbl_registro_personal_contrato', [
                                        'options' => ['class' => 'form-floating'],
                                        'template' => '{input}{label}{error}',
                                        'errorOptions' => ['class' => 'invalid-tooltip']
                                    ])->dropDownList(
                                        ['Base' => 'Base', 'Contrato' => 'Contrato'],
                                        ['prompt' => 'Seleccione el tipo de contrato', 'class' => 'form-select']
                                    )->label('Periodo') ?>
                                </div>
                            </div>
                            
                        </div>
                        <div class="form-group text-center mt-4">
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
    }

    .card {
        width: 100%;
        max-width: 800px;
        margin: 0 auto;
        background-color: #ffffff;
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
        border-radius: 20px;
        overflow: hidden;
        transition: all 0.3s ease;
    }

    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2);
    }

    .input-group-text {
        background-color: #f8f9fa;
        border-right: none;
    }

    .form-control {
        border-left: none;
    }

    .form-floating>.form-control:focus~label,
    .form-floating>.form-control:not(:placeholder-shown)~label {
        opacity: .65;
        transform: scale(.185) translateY(-.5rem) translateX(.15rem);
    }

    .btn-primary {
        background-color: #007bff;
        border-color: #007bff;
        border-radius: 10px;
        padding: 12px 30px;
        font-weight: bold;
        transition: all 0.3s ease;
    }

    .btn-primary:hover {
        background-color: #0056b3;
        border-color: #0056b3;
        transform: scale(1.05);
    }

    h2 {
        color: #333;
        font-weight: bold;
    }

    .animate__animated {
        animation-duration: 1s;
    }
</style>

<?php
$this->registerJs("

");
?>

<script>

AOS.init();
document.addEventListener('DOMContentLoaded', (event) => {
    const form = document.getElementById('registroForm');
    const submitBtn = document.getElementById('submitBtn');
    const inputs = document.querySelectorAll('.form-control');

    inputs.forEach(input => {
        input.addEventListener('focus', function() {
            this.closest('.input-group').classList.add('animate__animated', 'animate__headShake');
        });

        input.addEventListener('blur', function() {
            this.closest('.input-group').classList.remove('animate__animated', 'animate__headShake');
        });
    });

if (form.validate()) {
    Swal.fire({
        title: '¡Registro Exitoso!',
        text: 'El empleado ha sido registrado correctamente',
        icon: 'success',
        confirmButtonText: 'Aceptar'
    });
}
});
 
</script>
