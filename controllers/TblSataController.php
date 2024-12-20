<?php

namespace app\controllers;

use app\models\TblSata;
use app\models\TblSataSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii; 
use yii\web\UploadedFile;
use yii\helpers\Filehelper;
/**
 * TblSataController implements the CRUD actions for TblSata model.
 */
class TblSataController extends Controller
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
     * Lists all TblSata models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new TblSataSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single TblSata model.
     * @param int $tbl_sata_id Tbl Sata ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($tbl_sata_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($tbl_sata_id),
        ]);
    }

    /**
     * Creates a new TblSata model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new TblSata();
    
        if ($model->load(Yii::$app->request->post())) {
            // Obtener el archivo
            $file = UploadedFile::getInstance($model, 'pdfFile');
    
            if ($file) {
                try {
                    // Crear directorio si no existe
                    $uploadPath = Yii::getAlias('@webroot') . '/uploads/pdfs/';
                    if (!file_exists($uploadPath)) {
                        FileHelper::createDirectory($uploadPath, 0777, true);
                    }
    
                    // Generar nombre único
                    $fileName = 'pdf_' . time() . '_' . uniqid() . '.' . $file->extension;
                    $filePath = $uploadPath . $fileName;
    
                    // Verificar si es un PDF válido
                    if ($file->type === 'application/pdf') {
                        if ($file->saveAs($filePath)) {
                            $model->pdf_path = $fileName;
                            if ($model->save()) {
                                Yii::$app->session->setFlash('success', 'Archivo PDF guardado correctamente');
                                return $this->redirect(['view', 'tbl_sata_id' => $model->tbl_sata_id]);
                            } else {
                                Yii::$app->session->setFlash('error', 'Error al guardar el modelo');
                            }
                        } else {
                            Yii::$app->session->setFlash('error', 'Error al guardar el archivo');
                        }
                    } else {
                        Yii::$app->session->setFlash('error', 'El archivo debe ser PDF');
                    }
                } catch (\Exception $e) {
                    Yii::error('Error al subir archivo: ' . $e->getMessage());
                    Yii::$app->session->setFlash('error', 'Error al procesar el archivo: ' . $e->getMessage());
                }
            }
    
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    
        return $this->render('create', [
            'model' => $model,
        ]);
    }
    /**
     * Updates an existing TblSata model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $tbl_sata_id Tbl Sata ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($tbl_sata_id)
    {
        $model = $this->findModel($tbl_sata_id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'tbl_sata_id' => $model->tbl_sata_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing TblSata model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $tbl_sata_id Tbl Sata ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($tbl_sata_id)
    {
        $this->findModel($tbl_sata_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the TblSata model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $tbl_sata_id Tbl Sata ID
     * @return TblSata the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($tbl_sata_id)
    {
        if (($model = TblSata::findOne(['tbl_sata_id' => $tbl_sata_id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
