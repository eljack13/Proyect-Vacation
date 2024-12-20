<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\TblIntermedia $model */

$this->title = 'Update Tbl Intermedia: ' . $model->Persona_id;
$this->params['breadcrumbs'][] = ['label' => 'Tbl Intermedia', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->Persona_id, 'url' => ['view', 'Persona_id' => $model->Persona_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="tbl-intermedia-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
