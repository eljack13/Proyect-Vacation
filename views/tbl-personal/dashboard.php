<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\grid\ActionColumn;
use app\models\TblRegistroPersonal;
use app\models\TblIntermedia;
$this->title = 'Dashboard de Personal y Vacaciones';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tbl-personal-dashboard">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <h1><?= Html::encode($this->title) ?></h1>

    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h2 class="card-title">Total de Empleados</h2>
                    <p class="card-text">Total: <?= $totalEmployees ?></p>
                </div>
            </div>
        </div>
      
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h2 class="card-title">Solicitudes Aprobadas</h2>
                    <p class="card-text">Total: </p>
                </div>
            </div>
        </div>
    </div>

    <?php Pjax::begin(); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'tbl_personal_nombre:ntext',
            'tbl_personal_fecha_inicio', 
           // 'tbl_personal_dias_disponibles',
            [
                'attribute' => 'estado_vacaciones',
                'value' => function ($model) {
                    return $model->estado_vacaciones ?? 'Esperando solicitud';
                },
                'filter' => ['Pendiente' => 'Pendiente', 'Aprobado' => 'Aprobado', 'Cancelado' => 'Cancelado'],
            ],
            [
                'class' => ActionColumn::className(),
                'template' => '{approve} {cancel} {vervacaciones} {crearvacacionn} ',	
                'buttons' => [

             /*     'vervacaciones' => function ($url, TblRegistroPersonal $model, $key) {
                        $url = Url::to(['tblintermedia/view', 'tbl_registro_personal_id' => $model->tbl_registro_personal_id]);
                        return Html::a('<i class="fas fa-eye">Hola</i>', $url, [
                        'title' => 'Ver Vacaciones',
                         'class' => 'btn btn-outline-secondary btn-action btn-sm',
                          'data-toggle' => 'tooltip','data-placement' => 'top',]);
                    },
                    */

                    //esta perra mamada que no funciona alv 
                           'approve' => function ($url, $model, $key) {    
    if ($model->estado_vacaciones !== '') {
        return Html::a('<span class="glyphicon glyphicon-ok">Aprobar</span>', 
            ['view', 'id' => $model->tbl_personal_Id],
            [
                'title' => 'Aprobar Vacaciones',
                'data-pjax' => '0',
                'class' => 'btn btn-xs btn-success',
                'data-confirm' => '¿Estás seguro de que quieres aprobar estas vacaciones?',
                'onclick' => new \yii\web\JsExpression("
                    $.ajax({
                        url: '" . \yii\helpers\Url::to(['view', 'id' => $model->tbl_personal_Id]) . "',
                        type: 'POST',
                        data: { 
                            approve: true,
                            estado_vacaciones: '" . $model->estado_vacaciones . "',
                            additional_data: {
                                nombre: '" . $model->tbl_personal_nombre . "',
                                fecha_inicio: '" . $model->tbl_personal_fecha_inicio . "'
                            }
                        },
                        success: function(response) {
                            // Recargar o actualizar vista si es necesario
                            $.pjax.reload({container: '#w0'});
                        }
                    });
                    return false;
                ")
            ]
        );
    }
},
           'cancel' => function ($url, $model, $key) {
                        if ($model->estado_vacaciones !== 'Cancelado') {
                            return Html::a('<span class="glyphicon glyphicon-remove">Cancelar</span>', ['cancel-vacation', 'id' => $model->tbl_personal_Id], [
                                'title' => 'Cancelar Vacaciones',
                                'data-pjax' => '0',
                                'class' => 'btn btn-xs btn-danger',
                                'data-confirm' => '¿Estás seguro de que quieres cancelar estas vacaciones?',
                            ]);
                        }
                    },
                   
                    'vervacaciones' => function ($url, $model, $key) {
    $registroPersonal = TblRegistroPersonal::findOne($model->tbl_personal_Id);
    $intermedia = TblIntermedia::findOne($model->tbl_personal_Id);
    
    if (!$intermedia) {
        return Html::a('Ver', '#', ['class' => 'btn btn-xs btn-secondary disabled']);
    }
    
    // no se como coño funciona esta madre pero funciona 
    //no lo muevan alv si no saben lo que hacen 
    $form = Html::beginForm(['tbl-personal/view'], 'post', ['style' => 'display:inline;']);
    
    // Pass all parameters as hidden inputs
    $form .= Html::hiddenInput('tbl_personal_Id', $model->tbl_personal_Id);
    $form .= Html::hiddenInput('personal_clave', $registroPersonal->tbl_registro_personal_clave);
    $form .= Html::hiddenInput('personal_puesto', $registroPersonal->tbl_registro_personal_puesto);
    $form .= Html::hiddenInput('personal_funcion', $registroPersonal->tbl_registro_personal_funcion);
    $form .= Html::hiddenInput('personal_area', $registroPersonal->tbl_registro_personal_area);
    $form .= Html::hiddenInput('personal_dep', $registroPersonal->tbl_registro_personal_dep);
    $form .= Html::hiddenInput('personal_tarjeta_asis', $registroPersonal->tbl_registro_personal_tarjeta_asis);
    $form .= Html::hiddenInput('personal_jornada', $registroPersonal->tbl_registro_personal_jornada);
    $form .= Html::hiddenInput('personal_correo', $registroPersonal->tbl_registro_personal_correo);
    $form .= Html::hiddenInput('personal_contrato', $registroPersonal->tbl_registro_personal_contrato);
    
    // Vacation-related parameters
    $form .= Html::hiddenInput('Persona_id', $registroPersonal->tbl_registro_personal_id);
    $form .= Html::hiddenInput('Persona_periodo', $intermedia->Persona_periodo);
    $form .= Html::hiddenInput('Persona_año', $intermedia->Persona_año);
    $form .= Html::hiddenInput('Persona_diasrestantes', $intermedia->Persona_diasrestantes);
    $form .= Html::hiddenInput('estado_vacaciones', $model->estado_vacaciones);
    
    $form .= Html::submitButton('Ver', ['class' => 'btn btn-xs btn-primary']);
    $form .= Html::endForm();
    
    return $form;

    /* 
  'vervacaciones' => function ($url, $model, $key) {
 
    $registroPersonal = TblRegistroPersonal::findOne($model->tbl_personal_Id);
    $TlbIntermedia = TblIntermedia::findOne($model->tbl_personal_Id);
    
    if (!$registroPersonal) {
        return Html::a('Ver', '#', [
            'title' => 'No disponible',
            'class' => 'btn btn-xs btn-secondary disabled'
        ]);
    }


    //return Html::a('Ver',['tbl-personal/view', 'id' => $model->tbl_personal_Id], ['class' => 'btn btn-xs btn-primary']);

  return Html::a('Ver', [
        'tbl-personal/view',
        'tbl_personal_Id' => $model->tbl_personal_Id,
        'personal_clave' => $registroPersonal->tbl_registro_personal_clave ?? 'N/A',
        'personal_puesto' => $registroPersonal->tbl_registro_personal_puesto ?? 'N/A',
        'personal_funcion' => $registroPersonal->tbl_registro_personal_funcion ?? 'N/A',
        'personal_area' => $registroPersonal->tbl_registro_personal_area ?? 'N/A',
        'personal_dep' => $registroPersonal->tbl_registro_personal_dep ?? 'N/A',
        'personal_tarjeta_asis' => $registroPersonal->tbl_registro_personal_tarjeta_asis ?? 'N/A',
        'personal_jornada' => $registroPersonal->tbl_registro_personal_jornada ?? 'N/A',
        'personal_correo' => $registroPersonal->tbl_registro_personal_correo ?? 'N/A',
        'personal_contrato' => $registroPersonal->tbl_registro_personal_contrato ?? 'N/A',
        'Persona_id' => $registroPersonal->tbl_registro_personal_id ?? null,
        'estado_vacaciones' => $model->estado_vacaciones ?? 'No solicitado',
        'Persona_periodo' => $TlbIntermedia->tbl_intermedia_periodo ?? 'N/A',
        'Persona_dias' => $TlbIntermedia->tbl_intermedia_dias ?? 'N/A',
        'Persona_año' => $TlbIntermedia->tbl_intermedia_año ?? 'N/A',
        'Persona_diasrestantes' => $TlbIntermedia->tbl_intermedia_diasrestantes ?? 'N/A',
    ], [
        'title' => 'Ver Vacaciones',    
        'data-pjax' => '0',
        'class' => 'btn btn-xs btn-primary',
    ]);

    */
}

                ],
            ],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.0/font/bootstrap-icons.min.css"
      rel="stylesheet">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</div>