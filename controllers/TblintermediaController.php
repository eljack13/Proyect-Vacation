<?php

namespace app\controllers;

use app\models\TblIntermedia;
use app\models\TblIntermediaSearch;
use app\models\TblRegistroPersonalSearch;
use app\models\TblRegistroPersonal;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use Yii;

/**
 * TblintermediaController implements the CRUD actions for TblIntermedia model.
 */
class TblintermediaController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all TblIntermedia models.
     *
     * @return string
     */
    public function actionIndex($tbl_personal_Id, $id)
    {
        $searchModel = new TblIntermediaSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);
        $modelPersonal = TblRegistroPersonal::findOne($tbl_personal_Id);

        $models = TblIntermedia::find()
        ->where(['Persona_id' => $id])
        ->with('personaRelation')
        ->all();

        return $this->render('index', [
            'searchModel' => $searchModel, 
            'dataProvider' => $dataProvider,
            'modelPersonal' => $modelPersonal, 
            'models' => $models

        ]);
    }

    /**
     * Displays a single TblIntermedia model.
     * @param int $Persona_id Persona ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($Persona_id)
    {

        $models = TblIntermedia::find()
        ->where(['Persona_id' => $Persona_id])
        ->with('personaRelation')
        ->all();

        return $this->render('view', [
            'model' => $this->findModel($Persona_id),
            'models' => $models
        ]);
    }

    /**
     * Creates a new TblIntermedia model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate($Persona_id)
    {
        $model = new TblIntermedia();
        $model->Persona_id = $Persona_id; 

        
        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'Persona_id' => $model->Persona_id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing TblIntermedia model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $Persona_id Persona ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($Persona_id)
    {
        $model = $this->findModel($Persona_id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'Persona_id' => $model->Persona_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing TblIntermedia model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $Persona_id Persona ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($Persona_id)
    {
        $this->findModel($Persona_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the TblIntermedia model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $Persona_id Persona ID
     * @return TblIntermedia the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($Persona_id)
    {
        if (($model = TblIntermedia::findOne(['Persona_id' => $Persona_id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
