<?php

use app\models\TblIntermedia;
use app\models\TblRegistroPersonal;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\TblPersonalSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'TABLA';

?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
<div class="tbl-registropersonal-index container mt-5 ">
    <h1 class="text-center mb-2">Tabla de Usuarios</h1>
    <style>
        .table th {     
            background-color: #f8f9fa;
        }
        .btn-action {
            padding: 0.25rem 0.5rem;
            font-size: 0.875rem;
            line-height: 1.5;
            border-radius: 0.2rem;
        }
        .btn-action i {
            font-size: 0.75rem;
        }
    </style>
    <?= GridView::widget([ 
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
         //   'tbl_registro_personal_id',
            'tbl_registro_personal_nombre',
            'tbl_registro_personal_clave',
            'tbl_registro_personal_puesto',
            'tbl_registro_personal_funcion',
            'tbl_registro_personal_area',
            'tbl_registro_personal_correo',
            [
                'class' => ActionColumn::className(),
                'template' => '{update} {crearvacacion} {asignar} {vervacaciones}',
                'buttons' => [
                    'update' => function ($url, TblRegistroPersonal $model, $key) {
                        $url = Url::to(['tblregistropersonal/update', 'tbl_registro_personal_id' => $model->tbl_registro_personal_id]);
                        return Html::a('<i class="fas fa-pencil-alt"></i> ', $url, ['title' => 'Actualizar', 'class' => 'btn btn-outline-secondary btn-action btn-sm', 'data-toggle' => 'tooltip','data-placement' => 'top',]);
                    },
                    'vervacaciones' => function ($url, TblRegistroPersonal $model, $key) {
                        $url = Url::to(['tblintermedia/view', 'Persona_id' => $model->tbl_registro_personal_id]);
                        return Html::a('<i class="fas fa-eye"></i>', $url, ['title' => 'Ver Vacaciones', 'class' => 'btn btn-outline-secondary btn-action btn-sm', 'data-toggle' => 'tooltip','data-placement' => 'top',]);
                    },
                    'asignar' => function ($url, TblRegistroPersonal $model, $key) {
                        $url = Url::to(['tblintermedia/create', 'Persona_id' => $model->tbl_registro_personal_id]);
                        return Html::a('<i class="fas fa-plus-circle"></i>', $url, ['title' => 'Asignar Periodo', 'class' => 'btn btn-outline-secondary btn-action btn-sm', 'data-toggle' => 'tooltip','data-placement' => 'top',]);
                    },
                   'crearvacacion' => function ($url, TblRegistroPersonal $model, $key) {
    return Html::beginForm(['tbl-personal/tbl-personal'], 'post', ['class' => 'vacation-form']) .
        Html::hiddenInput('tbl_personal_Id', $model->tbl_registro_personal_id) .
        Html::hiddenInput('tbl_personal_personaid', $model->tbl_registro_personal_id) .
        Html::submitButton('<i class="fas fa-plus-circle"></i>', [
            'class' => 'btn btn-outline-secondary btn-action btn-sm',
            'title' => 'Crear Vacacion',
            'data-toggle' => 'tooltip',
            'data-placement' => 'top',
        ]) .
        Html::endForm();
}
                ],
            ],
        ],

        
    ]); 
   
    ?>
</div>


<td>

<script> 
$(function () {
  $('[data-toggle="tooltip"]').tooltip()
})

</script>
                         
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.0/font/bootstrap-icons.min.css"
      rel="stylesheet">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>