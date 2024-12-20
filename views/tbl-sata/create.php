<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\TblSata $model */

$this->title = 'Subir Documento';
?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
<div class="tbl-sata-create">



    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
