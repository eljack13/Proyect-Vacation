<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\TblSata $model */

$this->title = 'Update Tbl Sata: ' . $model->tbl_sata_id;
$this->params['breadcrumbs'][] = ['label' => 'Tbl Satas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->tbl_sata_id, 'url' => ['view', 'tbl_sata_id' => $model->tbl_sata_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="tbl-sata-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
