<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\TblSata $model */

$this->title = $model->tbl_sata_id;
$this->params['breadcrumbs'][] = ['label' => 'Tbl Satas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="tbl-sata-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'tbl_sata_id' => $model->tbl_sata_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'tbl_sata_id' => $model->tbl_sata_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'tbl_sata_id',
            'tbl_sata_nombre',
            'tbl_sata_dateint',
            'pdf_path',
        ],
    ]) ?>

</div>
