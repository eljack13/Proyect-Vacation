<?php

namespace app\controllers;

use app\models\TblIntermedia;
use app\models\TblPersonal;
use app\models\TblPersonalSearch;
use app\models\TblRegistroPersonal;
use Codeception\Command\Console;
use SebastianBergmann\Type\NullType;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Url;
use yii;
use yii\helpers\ArrayHelper;

/**
 * TblPersonalController implements the CRUD actions for TblPersonal model.
 */
class TblPersonalController extends Controller
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
     * Lists all TblPersonal models.
     *
     * @return string
     */
    public function actionList()
    {
        $model = new TblPersonal();

        $traedatos = $model->find()->all();
        $traedatosRegistroPersonal = TblRegistroPersonal::find()->all();


        $searchModel = new TblPersonalSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        $periodos = $this->getPeriodos($tbl_registro_personal_id);
        $diasDisponibles = $this->getDiasDisponibles($tbl_personal_personaid);

        return $this->render('list', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'traedatos' => $traedatos,
            'traedatosRegistroPersonal' => $traedatosRegistroPersonal,
            'periodos' => $periodos,
            'diasDisponibles' => $diasDisponibles,
        ]);
    }


    public function actionDashboard()
    {
        $modelRegistro = new TblRegistroPersonal();
        $modelTblIntermedia = new TblIntermedia();
        
        $searchModel = new TblPersonalSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);
        
        if (Yii::$app->request->isPost) {
            $postData = Yii::$app->request->post();
            

            $registroPersonal = TblRegistroPersonal::findOne($postData['tbl_personal_Id']);
            $intermedia = TblIntermedia::findOne($postData['tbl_personal_Id']);


            $model = TblRegistroPersonal::findOne($id);
        
            // Recuperar el perro parametro estado_vacaciones de la solicitud POST
            $estadoVacaciones = Yii::$app->request->post('estado_vacaciones');
            
            // Lógica de aprobación
            if ($model) {
                // Validar el estado recibido que no se ve por ningun lado alv
                if ($estadoVacaciones && in_array($estadoVacaciones, ['Pendiente', 'Solicitado', 'Aprobado'])) {
                    // Realizar operaciones basadas en el estado
                    $model->estado_vacaciones = 'Aprobado';
                    $model->save();
                    
                    // Puedes hacer un registro del estado original
                    Yii::$app->session->setFlash('success', "Vacaciones aprobadas. Estado anterior: $estadoVacaciones");
                }
            }

           if ($registroPersonal && $intermedia) {
            return $this->redirect([ 
                'tbl-personal/view', 
                'tbl_personal_Id' => $postData['tbl_personal_Id'],
                'personal_clave' => $registroPersonal->tbl_registro_personal_clave,
                'personal_puesto' => $registroPersonal->tbl_registro_personal_puesto,
                'personal_funcion' => $registroPersonal->tbl_registro_personal_funcion,
                'personal_area' => $registroPersonal->tbl_registro_personal_area,
                'personal_dep' => $registroPersonal->tbl_registro_personal_dep,
                'personal_tarjeta_asis' => $registroPersonal->tbl_registro_personal_tarjeta_asis,
                'personal_jornada' => $registroPersonal->tbl_registro_personal_jornada,
                'personal_correo' => $registroPersonal->tbl_registro_personal_correo,
                'personal_contrato' => $registroPersonal->tbl_registro_personal_contrato,
                'Persona_id' => $registroPersonal->tbl_registro_personal_id,
                'Persona_periodo' => $intermedia->Persona_periodo,
                'Persona_año' => $intermedia->Persona_año,
                'Persona_diasrestantes' => $intermedia->Persona_diasrestantes, 
                'estado_vacaciones' => $postData['estado_vacaciones']
            ]);
        }
        }
        
       //calcula las perras bombas estadisticas del coño 
        $totalEmployees = count($modelRegistro->find()->all());
        
        
        $dataWithPeriodos = [];
        foreach ($dataProvider->models as $model) {
            $intermediaRecord = TblIntermedia::findOne($model->tbl_personal_Id);
            
            $periodos = $this->getPeriodos($model->tbl_personal_personaid);
            $diasDisponibles = $this->getDiasDisponibles($model->tbl_personal_personaid);
            
            $dataWithPeriodos[] = [
                'model' => $model,
                'periodos' => $periodos,
                'diasDisponibles' => $diasDisponibles,
                'Persona_periodo' => $intermediaRecord ? $intermediaRecord->Persona_periodo : null
            ];
        }
        
        return $this->render('dashboard', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'modelRegistro' => $modelRegistro,
            'totalEmployees' => $totalEmployees,
            'modelTblIntermedia' => $modelTblIntermedia,
            'dataWithPeriodos' => $dataWithPeriodos,
            'arrDatosPeriodo' => $this->getPeriodos(null),
            'arrDatosDias' => $this->getDiasDisponibles(null) 
        ]);
    }

        public function actionCancelVacation($id)
        {
            $model = TblPersonal::findOne($id);
            if ($model !== null) {
                $model->estado_vacaciones = 'Cancelado';
                if ($model->save()) {
                    Yii::$app->session->setFlash('success', 'Vacaciones canceladas con éxito.');
                } else {
                    Yii::$app->session->setFlash('error', 'Error al cancelar las vacaciones.');
                }
            } else {
                Yii::$app->session->setFlash('error', 'Empleado no encontrado.');
            }
            return $this->redirect(['dashboard']);
        }
  

    /**
     * Displays a single TblPersonal model.
     * @param int $tbl_personal_Id Tbl Personal ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */


     
     

     public function actionView()
{
    $request = Yii::$app->request;
    
  //Verifica si la perra mamada de los parametros es post alv 
    if (!$request->isPost) {
        throw new \yii\web\ForbiddenHttpException('Solo acepto post alv ');
    }

    // Get all parameters from the POST request
    $postParams = $request->post();
    
    // Find the main employee record
    $modelPerso = TblPersonal::findOne(['tbl_personal_Id' => $postParams['tbl_personal_Id']]);
    if (!$modelPerso) {
        throw new NotFoundHttpException('Employee not found');
    }

    // Prepare parameters for the view
    $viewParams = [
        'model' => $modelPerso,
        'urlToDelete' => Url::to(['tbl-personal/delete'], true),

        // Personal Details
        'personal_clave' => $postParams['personal_clave'] ?? 'N/A',
        'personal_puesto' => $postParams['personal_puesto'] ?? 'N/A',
        'personal_funcion' => $postParams['personal_funcion'] ?? 'N/A',
        'personal_area' => $postParams['personal_area'] ?? 'N/A',
        'personal_dep' => $postParams['personal_dep'] ?? 'N/A',
        'personal_tarjeta_asis' => $postParams['personal_tarjeta_asis'] ?? 'N/A',
        'personal_jornada' => $postParams['personal_jornada'] ?? 'N/A',
        'personal_correo' => $postParams['personal_correo'] ?? 'N/A',
        'personal_contrato' => $postParams['personal_contrato'] ?? 'N/A',

        // Vacation Details
        'Persona_id' => $postParams['Persona_id'] ?? null,
        'Persona_periodo' => $postParams['Persona_periodo'] ?? 'N/A',
        'Persona_año' => $postParams['Persona_año'] ?? 'N/A',
        'Persona_diasrestantes' => $postParams['Persona_diasrestantes'] ?? 'N/A',
        'estado_vacaciones' => $postParams['estado_vacaciones'] ?? 'No solicitado',
    ];

    return $this->render('view', $viewParams);
}
    public function obtenerdatos()
    {
        $request = Yii::$app->request;
        if ($request->isPost) {

          $model = new TblPersonal();
            $obtenerparametros = $request->post();
            //obtener todos los parametros que se envian por post
            $model->tbl_personal_nombre = $obtenerparametros['nombre'];
            $model->tbl_personal_tipo = $obtenerparametros['tipo'];
            $model->tbl_personal_periodo = $obtenerparametros['periodo'];
            $model->tbl_personal_fecha_inicio = $obtenerparametros['fechas'];
            $model->tbl_personal_personaid = $obtenerparametros['personaid'];
            $model->estado_vacaciones = 'Solicitado';

            $model->save();
            // Procesa los parámetros recibidos
            return $this->asJson([
                'success' => true,
               
            ]);
        }

        return $this->asJson(['success' => false, 'message' => 'Only POST requests are allowed.']);
    }



    /**
     * Obtiene los periodos y días disponibles en una sola consulta
     */
    protected function getPeriodosYDias($personalId)
    {
        $query = TblIntermedia::find()
            ->where(['Persona_id' => $personalId]);

        // Obtener datos para periodos
        $periodos = ArrayHelper::map(
            $query->select([
                'value' => new \yii\db\Expression("CONCAT(Persona_periodo, ' ', Persona_año)"),
                'label' => 'Persona_periodo',
                'id' => 'tbl_intermedia_id'
            ])
                ->asArray()
                ->all(),
            'id',
            'value'
        );

        // Obtener datos para días
        $dias = ArrayHelper::map(
            $query->select([
                'value' => 'Persona_diasrestantes',
                'label' => 'Persona_diasrestantes',
                'id' => 'tbl_intermedia_id'
            ])
                ->asArray()
                ->all(),
            'id',
            'value'
        );

        return [
            'periodos' => $periodos,
            'dias' => $dias
        ];
    }


    /**
     * Creates a new TblPersonal model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {

        $model = new TblPersonal();

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {

                $model->save();
                return $this->redirect(['view', 'tbl_personal_Id' => $model->tbl_personal_Id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing TblPersonal model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $tbl_personal_Id Tbl Personal ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($tbl_personal_Id, $periodo = null, $fechas = null)
    {

        $modelUsuarioQuePideVacacion = TblRegistroPersonal::findOne($tbl_personal_Id);


        $model = new TblPersonal();
        $model->tbl_personal_nombre = $modelUsuarioQuePideVacacion->tbl_registro_personal_nombre;
        $model->tbl_personal_tipo = $modelUsuarioQuePideVacacion->tbl_registro_personal_contrato;

        if ($periodo != null && $fechas != null) {
            $model->tbl_personal_periodo = $periodo;
            $model->tbl_personal_fecha_inicio = $fechas;
        }


        if ($model->load(Yii::$app->request->post())) {
            if ($model->load($this->request->post()) && $model->save()) {


                $periodos = $this->getarrayperiodo($modelUsuarioQuePideVacacion);
                $dias = $this->getarraydias($modelUsuarioQuePideVacacion);


                return $this->redirect([
                    'view',
                    'tbl_personal_Id' => $model->tbl_personal_Id,
                    'personal_clave' => $modelUsuarioQuePideVacacion->tbl_registro_personal_clave,
                    'personal_puesto' => $modelUsuarioQuePideVacacion->tbl_registro_personal_puesto,
                    'personal_funcion' => $modelUsuarioQuePideVacacion->tbl_registro_personal_funcion,
                    'personal_area' => $modelUsuarioQuePideVacacion->tbl_registro_personal_area,
                    'personal_dep' => $modelUsuarioQuePideVacacion->tbl_registro_personal_dep,
                    'personal_tarjeta_asis' => $modelUsuarioQuePideVacacion->tbl_registro_personal_tarjeta_asis,
                    'personal_jornada' => $modelUsuarioQuePideVacacion->tbl_registro_personal_jornada,
                    'personal_correo' => $modelUsuarioQuePideVacacion->tbl_registro_personal_correo,
                    'personal_contrato' => $modelUsuarioQuePideVacacion->tbl_registro_personal_contrato,

                ]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('update', [
            'model' => $model,
            'tbl_personal_Id' => $tbl_personal_Id,
            'obtenerperiodo' => $periodos,
        ]);
    }


    /**
     * Deletes an existing TblPersonal model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $tbl_personal_Id Tbl Personal ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete()
    {

        $request = Yii::$app->request;
        $id = $request->post('tbl_personal_Id');

        $this->findModel($id)->delete();

        //return $this->redirect(['index']);
        return true;
    }

    /**
     * Finds the TblPersonal model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $tbl_personal_Id Tbl Personal ID
     * @return TblPersonal the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($tbl_personal_Id)
    {
        if (($model = TblPersonal::findOne(['tbl_personal_Id' => $tbl_personal_Id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionTblPersonal()
    {
       //Verifica si la perra mamada de los parametros es post alv 
        if (!Yii::$app->request->isPost) {
            throw new \yii\web\ForbiddenHttpException('Solo acepto post alv ');
        }
    
       
        $postParams = Yii::$app->request->post();
    
        // Validaciones más exhaustivas
        $requiredParams = [
            'tbl_personal_Id', 
            'tbl_personal_personaid', 
           ];

        //Guardar los datos en una variable 
        $guardar = $requiredParams;

     

        // Verificar que todos los parámetros requeridos estén presentes
        foreach ($requiredParams as $param) {
            if (!isset($postParams[$param])) {
                Yii::$app->session->setFlash('error', "Falta el parámetro: $param");
                return $this->redirect(['view']);
            }
        }
    
        // Obtener identificadores
        $tbl_personal_Id = $postParams['tbl_personal_Id'];
        $tbl_personal_personaid = $postParams['tbl_personal_personaid'];
    
        // Cargar modelos relacionados con validación adicional
        $registroPersonal = $this->loadRegistroPersonal($tbl_personal_Id);
        if (!$registroPersonal) {
            Yii::$app->session->setFlash('error', 'No se encontró el registro de personal.');
            return $this->redirect(['dashboard']);
        }
    
        $intermedia = $this->loadIntermedia($tbl_personal_personaid);
        if (!$intermedia) {
            Yii::$app->session->setFlash('error', 'No se encontraron datos intermedios.');
            return $this->redirect(['dashboard']);
        }
    
        // Preparar modelo para solicitud de vacaciones
        $model = new TblPersonal([
            'tbl_personal_nombre' => $registroPersonal->tbl_registro_personal_nombre,
            'tbl_personal_tipo' => $registroPersonal->tbl_registro_personal_contrato,
            'tbl_personal_personaid' => $registroPersonal->tbl_registro_personal_id
        ]);
    
        // Configuración de escenario si es necesario
        $model->scenario = 'vacation_request';
    
        // Cargar datos del formulario
        if ($model->load($postParams)) {
            // Establecer estado de vacaciones
            $model->estado_vacaciones = 'Solicitado';
    
            // Validar y procesar solicitud de vacaciones
            if ($this->validateVacationRequest($model, $intermedia) && 
                $this->procesarSolicitudVacaciones($model, $intermedia)) {
                
                // Preparar datos para envío POST
                $viewParams = [
                    'tbl_personal_Id' => $model->tbl_personal_Id,
                    'personal_clave' => $registroPersonal->tbl_registro_personal_clave,
                    'personal_puesto' => $registroPersonal->tbl_registro_personal_puesto,
                    'estado_vacaciones' => $model->estado_vacaciones,
                    'personal_funcion' => $registroPersonal->tbl_registro_personal_funcion,
                    'personal_area' => $registroPersonal->tbl_registro_personal_area,
                    'personal_dep' => $registroPersonal->tbl_registro_personal_dep,
                    'personal_tarjeta_asis' => $registroPersonal->tbl_registro_personal_tarjeta_asis,
                    'personal_jornada' => $registroPersonal->tbl_registro_personal_jornada,
                    'personal_correo' => $registroPersonal->tbl_registro_personal_correo,
                    'personal_contrato' => $registroPersonal->tbl_registro_personal_contrato,
                    'Persona_id' => $intermedia->Persona_id,
                    'Persona_periodo' => $intermedia->Persona_periodo,
                    'Persona_año' => $intermedia->Persona_año,
                    'Persona_diasrestantes' => $intermedia->Persona_diasrestantes,
                ];
    
                // Renderizar directamente la vista con método POST
                return $this->render('view', $viewParams);
            }
        }
    
        // Preparar los perros estupidos datos para dropdowns y renderizar vista
        $periodos = $this->getPeriodos($tbl_personal_personaid);
        $diasDisponibles = $this->getDiasDisponibles($tbl_personal_personaid);
    
        return $this->render('tbl-personal', [
            'model' => $model,
            'tbl_personal_Id' => $tbl_personal_Id,
            'arrDatosPeriodo' => $periodos,
            'arrDatosDias' => $diasDisponibles,
            'Persona_diasrestantes' => $intermedia->Persona_diasrestantes,
            'Persona_periodo' => $intermedia->Persona_periodo,
        ]);
    }
    
    // New validation method
    protected function validateVacationRequest($model, $intermedia)
    {
        // Contar días seleccionados
        $diasSolicitados = count(explode(',', $model->tbl_personal_fecha_inicio));
    
        // Validar que no se soliciten más días de los disponibles
        if ($diasSolicitados > $intermedia->Persona_diasrestantes) {
            Yii::$app->session->setFlash('error', 'No tiene suficientes días disponibles.');
            return false;
        }
    
        return true;
    }
    
    // Modify procesarSolicitudVacaciones to return boolean and set estado_vacaciones
    protected function procesarSolicitudVacaciones($model, $intermedia)
    {
        // Contar días solicitados
        $diasSolicitados = count(explode(',', $model->tbl_personal_fecha_inicio));
    
        // Establecer estado de vacaciones
        $model->estado_vacaciones = 'Solicitado';
    
        // Guardar modelo de vacaciones
        if (!$model->save(false)) {
            Yii::$app->session->setFlash('error', 'No se pudo guardar la solicitud de vacaciones.');
            return false;
        }
    
        // Actualizar días restantes
        $intermedia->Persona_diasrestantes -= $diasSolicitados;
    
        if (!$intermedia->save()) {
            Yii::$app->session->setFlash('error', 'No se pudo actualizar los días restantes.');
            return false;
        }
    
        Yii::$app->session->setFlash('success', 'Solicitud de vacaciones enviada correctamente.');
        return true;
    }
    /**
     * Carga el modelo de registro personal
     */
    protected function loadRegistroPersonal($id)
    {
        return TblRegistroPersonal::findOne($id);
    }

    /**
     * Carga el modelo intermedia
     */
    protected function loadIntermedia($id)
    {
        return TblIntermedia::findOne($id);
    }

    /**
     * Obtiene los períodos disponibles
     */
    protected function getPeriodos($personaId)
    {
        $data = TblIntermedia::find()
            ->select([
                'value' => new \yii\db\Expression("CONCAT(Persona_periodo, ' ', Persona_año)"),
                'label' => 'Persona_periodo',
                'id' => 'tbl_intermedia_id'
            ])
            ->where(['Persona_id' => $personaId])
            ->asArray()
            ->all();
        return ArrayHelper::map($data, 'id', 'value');
    }

    protected function getDiasDisponibles($personaId)
    {
        $data = TblIntermedia::find()
            ->select([
                'value' => new yii\db\Expression("Persona_diasrestantes"),
                'label' => 'Persona_diasrestantes',
                'id' => 'tbl_intermedia_id'
            ])
            ->where(['Persona_id' => $personaId])
            ->asArray()
            ->all();
        return ArrayHelper::map($data, 'id', 'value');
    }

    /**
     * Procesa la solicitud de vacaciones
     */
    protected function procesarSolicitudVacacionses($model)
    {
        if (!$model->save(false)) {
            return false;
        }

        $intermedia = TblIntermedia::findOne($model->tbl_personal_periodo);
        if (!$intermedia) {
            return false;
        }

        // Calcular días solicitados
        $diasSolicitados = count(explode(',', $model->tbl_personal_fecha_inicio));

        // Actualizar días restantes
        $intermedia->Persona_diasrestantes -= $diasSolicitados;

        return $intermedia->save();
    }

    /**
     * Redirección después de guardar exitosamente
     */
    protected function redirectSuccess($model, $registroPersonal, $intermedia)
    {
        return $this->redirect([
            'view',
            'tbl_personal_Id' => $model->tbl_personal_Id,
            'personal_clave' => $registroPersonal->tbl_registro_personal_clave,
            'personal_puesto' => $registroPersonal->tbl_registro_personal_puesto,
            'personal_funcion' => $registroPersonal->tbl_registro_personal_funcion,
            'personal_area' => $registroPersonal->tbl_registro_personal_area,
            'personal_dep' => $registroPersonal->tbl_registro_personal_dep,
            'personal_tarjeta_asis' => $registroPersonal->tbl_registro_personal_tarjeta_asis,
            'personal_jornada' => $registroPersonal->tbl_registro_personal_jornada,
            'personal_correo' => $registroPersonal->tbl_registro_personal_correo,
            'personal_contrato' => $registroPersonal->tbl_registro_personal_contrato,
            'Persona_id' => $intermedia->Persona_id,
            'Persona_periodo' => $intermedia->Persona_periodo,
            'Persona_año' => $intermedia->Persona_año,
            'Persona_diasrestantes' => $intermedia->Persona_diasrestantes,
            'periodos' => $this->getPeriodos($intermedia->Persona_id),
            'diasDisponibles' => $this->getDiasDisponibles($intermedia->Persona_id),
        ]);
    }

    public function actionContarDias()
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $fechas = Yii::$app->request->post('fechas');
        return ['totalDias' => $this->contarDias($fechas)];
    }

    private function contarDias($fechasString)
    {
        $fechas = explode(';', $fechasString);
        $fechas = array_map('trim', $fechas);
        $tiemposFechas = array_map(function ($fecha) {
            return strtotime($fecha);
        }, $fechas);
        $tiemposUnicos = array_unique($tiemposFechas);
        sort($tiemposUnicos);
        return count($tiemposUnicos);
    }

  
    public function actionGetDiasDisponibles($periodo)
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        try {
            // Consulta ajustada para obtener datos de Personas_diasrestantes
            $dias = \Yii::$app->db->createCommand("
            SELECT DISTINCT Personas_diasrestantes as dias_disponibles 
            FROM personas 
            WHERE Personas_periodo = :periodo
        ")
                ->bindValue(':periodo', $periodo)
                ->queryAll();

            if (empty($dias)) {
                return [['dias_disponibles' => '0']]; // Valor por defecto si no hay datos
            }

            return $dias;

        } catch (\Exception $e) {
            \Yii::error("Error al obtener días disponibles: " . $e->getMessage());
            throw new \yii\web\BadRequestHttpException('Error al obtener los días disponibles');
        }
    }


}
