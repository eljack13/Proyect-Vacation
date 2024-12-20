<?php

namespace app\controllers;

use app\models\TblRegistroPersonal;
use app\models\TblRegistroPersonalSearch;
use app\models\TblPersonal;
use app\models\TblPersonalSearch;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * TblregistropersonalController implements the CRUD actions for TblRegistroPersonal model.
 */
class TblregistropersonalController extends Controller
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


    public function actionList()
    {
        $model = new TblRegistroPersonal(); 
        $searchModel = new TblRegistroPersonalSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);
      
        return $this->render('list', [            
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,

        ]);
    }

    /**
     * Lists all TblRegistroPersonal models.
     *
     * @return string
     */
    public function actionIndex()
{
    $model = new TblRegistroPersonal();

    if ($this->request->isPost) {
        if ($model->load($this->request->post())) {
            
            // Hashear contraseña
            $model->tbl_registro_personal_contraseña = Yii::$app->getSecurity()->generatePasswordHash($model->tbl_registro_personal_contraseña);

            if ($model->save()) {
                $auth = Yii::$app->authManager;

                // Cambios importantes aquí
                if (!empty($model->roles)) {
                    $role = $auth->getRole($model->roles);
                    if ($role) {
                        $auth->assign($role, $model->tbl_registro_personal_id);
                    }
                }
                Yii::$app->session->setFlash('success', 'Usuario registrado exitosamente');
                return $this->redirect(['index']); 
            }
        }
    } else {
        $model->loadDefaultValues();
    }

    return $this->render('index', [
        'model' => $model,
    ]);
}
    /**
     * Displays a single TblRegistroPersonal model.
     * @param int $tbl_registro_personal_id Tbl Registro Personal ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($tbl_registro_personal_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($tbl_registro_personal_id),
        ]);
    }

    /**
     * Creates a new TblRegistroPersonal model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate($Persona_id)
    {
        $model = new TblRegistroPersonal();
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
     * Updates an existing TblRegistroPersonal model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $tbl_registro_personal_id Tbl Registro Personal ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($tbl_registro_personal_id)
    {
        $model = $this->findModel($tbl_registro_personal_id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'tbl_registro_personal_id' => $model->tbl_registro_personal_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing TblRegistroPersonal model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $tbl_registro_personal_id Tbl Registro Personal ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($tbl_registro_personal_id)
    {
        $this->findModel($tbl_registro_personal_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the TblRegistroPersonal model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $tbl_registro_personal_id Tbl Registro Personal ID
     * @return TblRegistroPersonal the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($tbl_registro_personal_id)
    {
        if (($model = TblRegistroPersonal::findOne(['tbl_registro_personal_id' => $tbl_registro_personal_id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
