<?php

use app\models\TblSata;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\TblSataSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Tabla de Archivos';

?>
<div class="tbl-sata-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Cargar Documento', ['create'], ['class' => 'btn btn-outline-primary w-50']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'tbl_sata_id',
            'tbl_sata_nombre',
            'tbl_sata_dateint',
            'pdf_path',
            [
                'attribute' => 'pdf_path',
                'format' => 'raw',
                'value' => function ($model) {
                    if ($model->pdf_path) {
                        $pdfFilePath = Yii::getAlias('@web') . '/uploads/pdfs/' . $model->pdf_path;
                        return Html::a(
                            'Ver',
                            $pdfFilePath,
                            ['target' => '_blank']
                        );
                    } else {
                        return '-';
                    }
                }
            ],
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, TblSata $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'tbl_sata_id' => $model->tbl_sata_id]);
                }
            ],
        ],
    ]); ?>

</div>