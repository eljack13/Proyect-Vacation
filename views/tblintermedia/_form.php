<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\TblIntermedia $model */
/** @var yii\widgets\ActiveForm $form */
?>

<?php
$current_year = date('Y');
$current_year2 = date('Y') + 1;
$current_year3 = date('Y') - 1;

$periodo = 'Enero - Junio';
$periodo2 = 'Julio - Diciembre';


?>

<?php $form = ActiveForm::begin(); ?>

<div class="card shadow mt-5" style="background-color: whitesmoke;">
    <div class="card-text">
        <h2 class="p-3 text-center bold animate__animated animate__bounceIn"><i class="mr-2"></i>Asignacion Vacacional
        </h2>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">

                <?= $form->field($model, 'Persona_id')->textInput(['readonly' => true ]) ?>

                <?= $form->field($model, 'Persona_año', [
                ])->dropDownList([
                     $current_year3 => 'Año ' . $current_year3 , $current_year => 'Año ' . $current_year, $current_year2 => 'Año ' . $current_year2 
                ], ['class' => 'form-select'])->label('Año') ?>
            </div>
            <div class="col-md-6">

                <?= $form->field($model, 'Persona_periodo', [
                ])->dropDownList([
                    $periodo => 'Periodo: ' . $periodo, $periodo2 => 'Periodo: ' . $periodo2
                ], ['class' => 'form-select'])->label('Periodo') ?>

                <?= $form->field($model, 'Persona_diasrestantes', [
                ])->dropDownList([
                    '5' => '5', '10' => '10'
                ], ['class' => 'form-select'])->label('Días Disponibles') ?>
            </div>
        </div>


        <div class="form-group">
        <?= Html::submitButton('Registrar', ['class' => 'btn btn-primary px-5 animate__animated animate__pulse animate__infinite', 'id' => 'submitBtn']) ?>
        </div>
    </div>
</div>

<?php ActiveForm::end(); ?>

</div>