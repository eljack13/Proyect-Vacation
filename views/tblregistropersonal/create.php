<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\TblRegistroPersonal $model */

$this->title = 'Create Tbl Registro Personal';
$this->params['breadcrumbs'][] = ['label' => 'Tbl Registro Personals', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tbl-registro-personal-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
