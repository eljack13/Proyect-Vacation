<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\TblPersonal $model */

$this->title = 'Update Tbl Personal: ' . $model->tbl_personal_Id;
$this->params['breadcrumbs'][] = ['label' => 'Tbl Personals', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->tbl_personal_Id, 'url' => ['view', 'tbl_personal_Id' => $model->tbl_personal_Id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="tbl-personal-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
