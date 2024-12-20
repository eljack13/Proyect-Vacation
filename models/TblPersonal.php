<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "tbl_personal".
 *
 * @property int $tbl_personal_Id
 * @property int $tbl_personal_personaid
 * @property string $tbl_personal_nombre
 * @property string $tbl_personal_fecha_inicio_laboral
 * @property int $tbl_personal_dias_disponibles
 * @property string $tbl_personal_tipo
 * @property int $tbl_personal_periodo
 * @property string $tbl_personal_fecha_inicio
 * @property string $tbl_personal_fecha_final
 *
 * @property TblIntermedia $tblPersonalPeriodo
 * @property TblRegistroPersonal $tblPersonalPersona
 * @property TblTipoPersona $tblPersonalTipo
 */
class TblPersonal extends \yii\db\ActiveRecord
{       
    public $estado_vacaciones; 
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_personal';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            //  [['tbl_personal_personaid', 'tbl_personal_nombre', 'tbl_personal_fecha_inicio_laboral', 'tbl_personal_dias_disponibles', 'tbl_personal_tipo', 'tbl_personal_periodo', 'tbl_personal_fecha_inicio', 'tbl_personal_fecha_final'], 'required'],
            [['tbl_personal_personaid', 'tbl_personal_dias_disponibles', 'tbl_personal_periodo'], 'integer'],
            [['tbl_personal_nombre'], 'string'],
            [['tbl_personal_fecha_inicio_laboral', 'tbl_personal_fecha_final'], 'safe'],
            [['tbl_personal_tipo', 'tbl_personal_fecha_inicio'], 'string', 'max' => 255],
            [['tbl_personal_periodo'], 'exist', 'skipOnError' => true, 'targetClass' => TblIntermedia::class, 'targetAttribute' => ['tbl_personal_periodo' => 'tbl_intermedia_id']],
            [['tbl_personal_personaid'], 'exist', 'skipOnError' => true, 'targetClass' => TblRegistroPersonal::class, 'targetAttribute' => ['tbl_personal_personaid' => 'tbl_registro_personal_id']],
            [['tbl_personal_tipo'], 'exist', 'skipOnError' => true, 'targetClass' => TblTipoPersona::class, 'targetAttribute' => ['tbl_personal_tipo' => 'tbl_tipo_persona_contrato']],
            [['estado_vacaciones'], 'default', 'value' => 'Esperando solicitud'],
            [['estado_vacaciones'], 'in', 'range' => ['Pendiente', 'Aprobado', 'Cancelado']],
        ];
    }   

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'tbl_personal_Id' => 'Tbl Personal ID',
            'tbl_personal_personaid' => 'Tbl Personal Personaid',
            'tbl_personal_nombre' => 'Tbl Personal Nombre',
            'tbl_personal_fecha_inicio_laboral' => 'Tbl Personal Fecha Inicio Laboral',
            'tbl_personal_dias_disponibles' => 'Tbl Personal Dias Disponibles',
            'tbl_personal_tipo' => 'Tbl Personal Tipo',
            'tbl_personal_periodo' => 'Tbl Personal Periodo',
            'tbl_personal_fecha_inicio' => 'Tbl Personal Fecha Inicio',
            'tbl_personal_fecha_final' => 'Tbl Personal Fecha Final',
            'estado_vacaciones' => 'Estado de Vacaciones',

        ];
    }

    /**
     * Gets query for [[TblPersonalPeriodo]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTblPersonalPeriodo()
    {
        return $this->hasOne(TblIntermedia::class, ['tbl_intermedia_id' => 'tbl_personal_periodo']);
    }

    /**
     * Gets query for [[TblPersonalPersona]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTblPersonalPersona()
    {
        return $this->hasOne(TblRegistroPersonal::class, ['tbl_registro_personal_id' => 'tbl_personal_personaid']);
    }

    /**
     * Gets query for [[TblPersonalTipo]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTblPersonalTipo()
    {
        return $this->hasOne(TblTipoPersona::class, ['tbl_tipo_persona_contrato' => 'tbl_personal_tipo']);
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
    }
}
