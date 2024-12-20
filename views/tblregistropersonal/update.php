<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\TblRegistroPersonal $model */

$this->title = 'Update Tbl Registro Personal: ' . $model->tbl_registro_personal_id;
$this->params['breadcrumbs'][] = ['label' => 'Tbl Registro Personals', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->tbl_registro_personal_id, 'url' => ['view', 'tbl_registro_personal_id' => $model->tbl_registro_personal_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="tbl-registro-personal-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
