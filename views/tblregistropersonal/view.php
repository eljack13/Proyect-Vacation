<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\TblRegistroPersonal $model */

$this->title = $model->tbl_registro_personal_id;
$this->params['breadcrumbs'][] = ['label' => 'Tbl Registro Personals', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="tbl-registro-personal-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'tbl_registro_personal_id' => $model->tbl_registro_personal_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'tbl_registro_personal_id' => $model->tbl_registro_personal_id], [
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
            'tbl_registro_personal_id',
            'tbl_registro_personal_nombre',
            'tbl_registro_personal_clave',
            'tbl_registro_personal_puesto',
            'tbl_registro_personal_funcion',
            'tbl_registro_personal_area',
            'tbl_registro_personal_dep',
            'tbl_registro_personal_tarjeta_asis',
            'tbl_registro_personal_jornada',
            'tbl_registro_personal_contraseña',
            'tbl_registro_personal_correo',
        ],
    ]) ?>

</div>
