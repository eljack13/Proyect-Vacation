<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "tbl_intermedia".
 *
 * @property int $Persona_id
 * @property int $tbl_intermedia_id
 * @property string $Persona_periodo
 * @property string $Persona_año
 * @property int $Persona_diasrestantes
 *
 * @property TblRegistroPersonal $persona , $clave
 */
class TblIntermedia extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_intermedia';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['Persona_id', 'Persona_periodo', 'Persona_año', 'Persona_diasrestantes'], 'required'],
            [['Persona_id', 'Persona_diasrestantes'], 'integer'],
            [['Persona_periodo', 'Persona_año'], 'string', 'max' => 60],
            [['Persona_id'], 'exist', 'skipOnError' => true, 'targetClass' => TblRegistroPersonal::class, 'targetAttribute' => ['Persona_id' => 'tbl_registro_personal_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'Persona_id' => 'Persona ID',
            'tbl_intermedia_id' => 'Tbl Intermedia ID',
            'Persona_periodo' => 'Persona Periodo',
            'Persona_año' => 'Persona Año',
            'Persona_diasrestantes' => 'Persona Diasrestantes',
        ];
    }

    /**
     * Gets query for [[Persona]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPersona()
    {
        return $this->hasOne(TblRegistroPersonal::class, ['tbl_registro_personal_id' => 'Persona_id']);
    }

    /**
     * Obtiene el nombre de la persona desde la relación
     * @return string
     */
    public function getNombrePersona()
    {
        return $this->persona ? $this->persona->tbl_registro_personal_nombre : 'No disponible';
    }

    /**
     * Obtiene el periodo completo
     * @return string
     */
    public function getPeriodoCompleto()
    {
        return $this->Persona_periodo . ' ' . $this->Persona_año;
    }

    public function getPersonaRelation()
    {
        return $this->hasOne(TblIntermedia::class, ['Persona_id' => 'Persona_id']);
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
}
