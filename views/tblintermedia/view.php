<?php
use yii\widgets\DetailView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TblIntermedia */
?>

<div class="tbl-intermedia-view">


    <h1> Informacion de la persona</h1>
    <?php foreach ($models as $model): ?>
    <table class="table">
        <tr>
            <th  scope="col">TblIntermedia ID</th>
            <th  scope="col">Nombre de Persona</th>
            <th  scope="col">Periodo Completo</th>
            <th  scope="col">Año</th>
            <th  scope="col">Días Restantes</th>
        </tr>
        <tr>
            <td><?= $model->tbl_intermedia_id ?></td>
            <td><?= $model->nombrePersona ?></td>
            <td><?= $model->periodoCompleto ?></td>
            <td><?= $model->Persona_año ?></td>
            <td><?= $model->Persona_diasrestantes ?></td>
 
        </tr>
    </table>
<?php endforeach; ?>