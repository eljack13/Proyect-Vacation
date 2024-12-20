<?php

use kartik\date\DatePicker;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\web\JsExpression;
use app\assets\NpmAsset;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;

/** @var yii\web\View $this */
/** @var app\models\TblPersonal $model */
/** @var ActiveForm $form */

$this->registerCssFile('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css');
$this->registerCssFile('https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css');
$this->registerCssFile('https://cdn.jsdelivr.net/npm/sweetalert2@11.7.32/dist/sweetalert2.min.css');
$this->registerJsFile('https://cdn.jsdelivr.net/npm/sweetalert2@11.7.32/dist/sweetalert2.all.min.js');
NpmAsset::register($this);
$urlToRedirect = Url::to(['tbl-personal/tbl-personal'], true);
?>

        <style>
            body {
                background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            }
        
            .tbl-personal {
                max-width: 800px;
                margin: 0 auto;
            }
        
            .card {
                border: none;
                border-radius: 15px;
                overflow: hidden;
                transition: all 0.3s ease;
            }
        
            .card:hover {
                transform: translateY(-5px);
                box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
            }
        
            .card-header {
                border-radius: 15px 15px 0 0;
            }
        
            .form-control, .form-select {
                border-radius: 0 8px 8px 0;
            }
        
            .bold {
                font-weight: bold;
            }
        
            .input-group-text {
                border-radius: 8px 0 0 8px;
                background-color: #f8f9fa;
            }
        
            .btn-primary {
                border-radius: 8px;
                padding: 10px 30px;
                font-weight: bold;
                transition: all 0.3s ease;
            }
        
            .btn-primary:hover {
                transform: scale(1.05);
            }
        
            .form-floating > .form-control:focus ~ label,
            .form-floating > .form-control:not(:placeholder-shown) ~ label,
            .form-floating > .form-select ~ label {
                opacity: .65;
                transform: scale(.85) translateY(-.5rem) translateX(.15rem);
            }
        
            .invalid-tooltip {
                position: absolute;
                top: 100%;
                z-index: 5;
                display: none;
                max-width: 100%;
                padding: .25rem .5rem;
                margin-top: .1rem;
                font-size: .875rem;
                line-height: 1.5;
                color: #fff;
                background-color: rgba(220, 53, 69, .9);
                border-radius: .25rem;
            }
        </style>
<!--Esta parte del codigo me va a generar cancer alv---->
    <div class="tbl-personal container mt-2 animate__animated animate__fadeIn">
        <div class="card shadow mt-5">
            <div class="card-body">
                <h2 class="p-3 text-center bold animate__animated animate__bounceIn"><i class="mr-2"></i>Registro
                    Vacacional</h2>
                <?php $form = ActiveForm::begin([
                   'method' => 'post',
                   'action' => ['tbl-personal/tbl-personal'], // Adjust route as needed
                   'options' => [
                       'class' => 'needs-validation',
                       'novalidate' => true
                   ]
               ]); ?>

                <div class="row">
                    <div class="col-md-6">
                        <div class="input-group mb-3">
                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                            <?= $form->field($model, 'tbl_personal_nombre', [
                                'options' => ['class' => 'form-floating'],
                                'template' => '{input}{label}{error}',
                                'errorOptions' => ['class' => 'invalid-tooltip'],
                            ])->textInput(['placeholder' => 'Nombre completo', 'class' => 'form-control', 'disabled' => true])->label('Nombre') ?>
                        </div>

                        <div class="input-group mb-3">
                            <span class="input-group-text"><i class="fas fa-calendar-day"></i></span>
                            <?= $form->field($model, 'tbl_personal_dias_disponibles', [
                                'options' => ['class' => 'form-floating'],
                                'template' => '{input}{label}{error}',
                                'errorOptions' => ['class' => 'invalid-tooltip']
                            ])->dropDownList(
                                $arrDatosDias,
                                ['prompt' => 'Seleccione días disponibles', 'class' => 'form-select', 'id' => 'dias-disponibles-dropdown',  ]
                            )->label('Días Disponibles') ?>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="input-group mb-3">
                            <span class="input-group-text"><i class="fas fa-file-contract"></i></span>
                            <?= $form->field($model, 'tbl_personal_tipo', [
                                'options' => ['class' => 'form-floating'],
                                'template' => '{input}{label}{error}',
                                'errorOptions' => ['class' => 'invalid-tooltip']
                            ])->textInput(['placeholder' => 'Nombre completo', 'class' => 'form-control', 'disabled' => true])->label('Tipo de Contrato') ?>
                        </div>

                        <div class="input-group mb-3">
                            <span class="input-group-text"><i class="fas fa-calendar-week"></i></span>
                            <?= $form->field($model, 'tbl_personal_periodo', [
                                'options' => ['class' => 'form-floating'],
                                'template' => '{input}{label}{error}',
                                'errorOptions' => ['class' => 'invalid-tooltip']
                            ])->dropDownList(
                                $arrDatosPeriodo,
                                ['prompt' => 'Seleccione un periodo', 'class' => 'form-select', 'id' => 'periodo-dropdown']
                            )->label('Periodo') ?>
                        </div>
                    </div>
                </div>

                <div>
                    <div class="col-12">
                        <div class="input-group mb-3">
                            <?= $form->field($model, 'tbl_personal_fecha_inicio', [
                                'errorOptions' => ['class' => 'invalid-tooltip']
                            ])->widget(DatePicker::class, [
                                'language' => 'es',
                                'options' => ['placeholder' => 'Fechas de vacaciones',
                                    'template' => '{input}{label}{error}',
                                    'errorOptions' => ['class' => 'invalid-tooltip']],

                                'pluginOptions' => [
                                    'format' => 'mm/dd/yyyy',
                                    'multidate' => true,
                                    'multidateSeparator' => ',',
                                    'daysOfWeekDisabled' => [0, 6],
                                    'todayHighlight' => true,
                                ]
                            ])->label('Fechas de Vacaciones') ?>
                        </div>
                    </div>
                </div>

                <div class="form-group text-center mt-4">
                    <?= Html::submitButton('Guardar', ['class' => 'btn btn-primary btn-lg animate__animated animate__pulse animate__infinite']) ?>
                </div>

                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>

    <script>
        // funcion para autocompletar los datos de dias con el combobox de periodo
        document.addEventListener('DOMContentLoaded', (event) => {
            // obtenemos los elementos del DOM
            // obtenemos el id y lo que contiene dentro del combobox de días disponibles y periodo
            const diasDisponibles = document.getElementById('dias-disponibles-dropdown');
            const periodo = document.getElementById('periodo-dropdown');
            periodo.addEventListener('change', function () {
                // obtenemos el índice seleccionado
                const selectedIndex = periodo.selectedIndex;
                // obtenemos el valor del índice seleccionado y lo asignamos al combobox de días disponibles
                diasDisponibles.selectedIndex = selectedIndex !== -1 ? selectedIndex : 0;
            });
        });
        </script>





<?php
$js = <<<JS
document.addEventListener('DOMContentLoaded', (event) => {
    AOS.init();
    
    const form = document.getElementById('registro-vacacional-form');
    const inputs = form.querySelectorAll('.form-control, .form-select');

    inputs.forEach(input => {
        input.addEventListener('focus', function() {
            this.closest('.input-group').classList.add('animate__animated', 'animate__headShake');
        });

        input.addEventListener('blur', function() {
            this.closest('.input-group').classList.remove('animate__animated', 'animate__headShake');
        });
    });
    
    form.addEventListener('submit', function(e) {
        if (!form.checkValidity()) {
            e.preventDefault();
            e.stopPropagation();
        }
        form.classList.add('was-validated');
    });
});
JS;
?>