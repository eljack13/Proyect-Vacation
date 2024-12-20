<?php
use kartik\date\DatePicker;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\TblPersonal $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="tbl-personal-form">
<div class="tbl-personal container mt-5" data-aos="fade-up-right"  data-aos-duration="2000" >
    <div class="card shadow">
        <div class="card-header bg-pp text-white text-center">
            <h2 class="mb-0"><i class="mr-2"></i>Registro Vacacional</h2>
        </div>
        <div class="card-body">
            <?php $form = ActiveForm::begin([
                'options' => ['class' => 'needs-validation', 'novalidate' => true],
                'errorCssClass' => 'is-invalid',
                'successCssClass' => 'is-valid',
                'validationStateOn' => ActiveForm::VALIDATION_STATE_ON_INPUT
            ]); ?>
 
            <div class="row"  data-aos="fade-up"  data-aos-duration="2000">
                <div class="col-md-6">
                    <?= $form->field($model, 'tbl_personal_nombre', [
                        'options' => ['class' => 'form-group'],
                        'template' => '{label}{input}{error}',
                        'errorOptions' => ['class' => 'invalid-tooltip']
                        
                    ])->textInput(['placeholder' => 'Nombre completo', 'class' => 'form-control mb-3'])->label('Nombre') ?>

                    <?= $form->field($model, 'tbl_personal_fecha_inicio_laboral', [
                        'options' => ['class' => 'form-group'],
                        'template' => '{label}{input}{error}',
                        'errorOptions' => ['class' => 'invalid-tooltip']
                    ])->widget(DatePicker::class, [
                        'language' => 'es',
                        'options' => ['placeholder' => 'Fecha de inicio laboral (YYYY-MM-DD)'],
                        'pluginOptions' => [
                            'todayHighlight' => true,
                            'format' => 'yyyy-mm-dd',
                            'autoclose' => true,
                        ]
                    ])->label('Fecha de Inicio Laboral') ?>

                    <?= $form->field($model, 'tbl_personal_dias_disponibles', [
                        'options' => ['class' => 'form-group'],
                        'template' => '{label}{input}{error}',
                        'errorOptions' => ['class' => 'invalid-tooltip']
                    ])->textInput(['type' => 'number', 'min' => '0', 'id' => 'dias-disponibles'])->label('Días Disponibles') ?>
                </div>

                <div class="col-md-6">
                    <?= $form->field($model, 'tbl_personal_tipo', [
                        'options' => ['class' => 'form-group'],
                        'template' => '{label}{input}{error}',
                        'errorOptions' => ['class' => 'invalid-tooltip']
                    ])->dropDownList(
                        [
                            'Contrato' => 'Contrato',
                            'Base' => 'Base',
                        ],
                        ['prompt' => 'Seleccione un tipo', 'class' => 'form-control mb-3']
                    )->label('Tipo de Contrato') ?>

                    <?= $form->field($model, 'tbl_personal_periodo', [
                        'options' => ['class' => 'form-group'],
                        'template' => '{label}{input}{error}',
                        'errorOptions' => ['class' => 'invalid-tooltip']
                    ])->dropDownList(
                        [
                            'Enero/Junio' => 'Enero/Junio',
                            'Julio/Diciembre' => 'Julio/Diciembre'
                        ],
                        ['prompt' => 'Seleccione un periodo', 'class' => 'form-control mb-3']
                    )->label('Periodo') ?>
                </div>
                
                <?= $form->field($model, 'tbl_personal_fecha_inicio', [ 
                    'options' => ['class' => 'form-group'], 
                'template' => '{label}{input}{error}',
                'errorOptions' => ['class' => 'invalid-tooltip']
                ])->widget(DatePicker::class, [
                    'language' => 'es',
                    'options' => ['placeholder' => 'Fecha de inicio laboral (YYYY-MM-DD)'],'pluginOptions' => [
                        'format' => 'mm/dd/yyyy',
                        'multidate' => true,
                        'multidateSeparator' => ',',
                        'daysOfWeekDisabled' => [0, 6],
                        'autocomplete' => true, 
                        ]
                        ])->label( 'Fechas de Vacaciones'); ?>
                </div>
            </div>
            
            <div id="dias-seleccionados" class="alert alert-info mt-3" style="display: none;">
                Días seleccionados: <span id="dias-count"></span>
            </div>
            
            <div class="form-group text-center mt-4">
                <?= Html::submitButton('Guardar', ['class' => 'btn bg-pp btn-lg text-white']) ?>
            </div>
            
            <?php ActiveForm::end(); ?>
        </div>
        </div>
    </div>
</div>

<style>
    .tbl-personal {
        max-width: 1000px;
        margin: 0 auto;
    }
    .card {
        border: none;
        border-radius: 15px;
    }
    .card-header {
        border-radius: 15px 15px 0 0;
    }
    .form-control {
        border-radius: 8px;
    }
    .bg-pp{ 
        background-color: #2b95c8;
    }
    .btn:hover{ 
        background-color: #20619a;
    }
    .btn-success {
        border-radius: 15px;
        padding: 10px 30px;
    }
    .form-group {
        position: relative;
    }
    .invalid-tooltip {
        position: absolute;
        top: 100%;
        z-index: 5;
        display: none;
        max-width: 100%;
        padding: .25rem .5rem;
        margin-top: .1rem;
        font-size: .875rem;
        line-height: 1.5;
        color: #fff;
        background-color: rgba(220, 53, 69, .9);
        border-radius: .25rem;
    }
</style>

<?php
$js = <<<JS
AOS.init();




$('form').on('afterValidate', function (event, messages, errorAttributes) {
    $('.is-invalid').each(function() {
        var input = $(this);
        var errorMessage = input.next('.invalid-tooltip').text();
        input.tooltip({'trigger':'manual', 'title': errorMessage});
        input.tooltip('show');
    });
    
    $('.is-valid').each(function() {
        $(this).tooltip('dispose');
    });
});

$('form').on('beforeSubmit', function(event) {
    $('.is-invalid').each(function() {
        $(this).tooltip('dispose');
    });
    
  
});

$('input, select').on('change', function() {
    $(this).tooltip('dispose');
});

// Ejecutar cálculo inicial
//alcularDiasVacaciones();

// Recalcular cuando cambie la fecha de inicio
//$('#fechaInicio').on('change', calcularDiasVacaciones);



JS;

$this->registerJs($js);
?>

</div>
