<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\TblSataSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="tbl-sata-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'tbl_sata_id') ?>

    <?= $form->field($model, 'tbl_sata_nombre') ?>

    <?= $form->field($model, 'tbl_sata_date') ?>

    <?= $form->field($model, 'tbl_sata_dateint') ?>

    <?= $form->field($model, 'pdf_path') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
