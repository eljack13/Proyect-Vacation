<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\TblPersonal $model */

$this->title = 'Create Tbl Personal';
$this->params['breadcrumbs'][] = ['label' => 'Tbl Personals', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tbl-personal-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
