<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\TblPersonalSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="tbl-personal-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'tbl_personal_Id') ?>

    <?= $form->field($model, 'tbl_personal_nombre') ?>

    <?= $form->field($model, 'tbl_personal_fecha_inicio_laboral') ?>

    <?= $form->field($model, 'tbl_personal_dias_disponibles') ?>

    <?= $form->field($model, 'tbl_personal_tipo') ?>

    <?php // echo $form->field($model, 'tbl_personal_periodo') ?>

    <?php // echo $form->field($model, 'tbl_personal_fecha_inicio') ?>

    <?php // echo $form->field($model, 'tbl_personal_fecha_final') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
