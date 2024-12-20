<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\TblRegistroPersonalSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="tbl-registro-personal-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'tbl_registro_personal_id') ?>

    <?= $form->field($model, 'tbl_registro_personal_nombre') ?>

    <?= $form->field($model, 'tbl_registro_personal_clave') ?>

    <?= $form->field($model, 'tbl_registro_personal_puesto') ?>

    <?= $form->field($model, 'tbl_registro_personal_funcion') ?>

    <?php // echo $form->field($model, 'tbl_registro_personal_area') ?>

    <?php // echo $form->field($model, 'tbl_registro_personal_dep') ?>

    <?php // echo $form->field($model, 'tbl_registro_personal_tarjeta_asis') ?>

    <?php // echo $form->field($model, 'tbl_registro_personal_jornada') ?>

    <?php // echo $form->field($model, 'tbl_registro_personal_contraseña') ?>

    <?php // echo $form->field($model, 'tbl_registro_personal_correo') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
