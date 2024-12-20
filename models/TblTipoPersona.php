<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_tipo_persona".
 *
 * @property int $tbl_tipo_persona_Id
 * @property string $tbl_tipo_persona_contrato
 * @property string $tbl_tipo_persona_base
 *
 * @property TblPersonal[] $tblPersonals
 */
class TblTipoPersona extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_tipo_persona';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tbl_tipo_persona_contrato', 'tbl_tipo_persona_base'], 'required'],
            [['tbl_tipo_persona_contrato', 'tbl_tipo_persona_base'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'tbl_tipo_persona_Id' => 'Tbl Tipo Persona ID',
            'tbl_tipo_persona_contrato' => 'Tbl Tipo Persona Contrato',
            'tbl_tipo_persona_base' => 'Tbl Tipo Persona Base',
        ];
    }

    /**
     * Gets query for [[TblPersonals]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTblPersonals()
    {
        return $this->hasMany(TblPersonal::class, ['tbl_personal_tipo' => 'tbl_tipo_persona_contrato']);
    }
}
