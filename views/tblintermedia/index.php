<?php

use app\models\TblIntermedia;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
/** @var yii\web\View $this */
/** @var app\models\TblIntermediaSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Tbl Intermedia';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tbl-intermedia-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Tbl Intermedia', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'Persona_id',
            'Persona_periodo',
            'Persona_año',
            'Persona_diasrestantes',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, TblIntermedia $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'Persona_id' => $model->Persona_id]);
                 }
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
