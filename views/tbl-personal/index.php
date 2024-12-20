<?php

use app\models\TblPersonal;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\TblPersonalSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Tbl Personals';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tbl-personal-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Tbl Personal', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'tbl_personal_Id',
            'tbl_personal_nombre:ntext',
            'tbl_personal_fecha_inicio_laboral',
            'tbl_personal_dias_disponibles',
            'tbl_personal_tipo',
            //'tbl_personal_periodo',
            //'tbl_personal_fecha_inicio',
            //'tbl_personal_fecha_final',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, TblPersonal $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'tbl_personal_Id' => $model->tbl_personal_Id]);
                 }
            ],
        ],
    ]); ?>


</div>
