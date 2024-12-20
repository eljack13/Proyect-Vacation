<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\TblIntermediaSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="tbl-intermedia-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'Persona_id') ?>

    <?= $form->field($model, 'Persona_periodo') ?>

    <?= $form->field($model, 'Persona_año') ?>

    <?= $form->field($model, 'Persona_diasrestantes') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
