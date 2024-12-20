<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_periodo".
 *
 * @property int $tbl_periodo_Id
 * @property string $tbl_periodo_1er_periodo
 * @property string $tbl_periodo_2ndo_periodo
 *
 * @property TblPersonal[] $tblPersonals
 */
class TblPeriodo extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_periodo';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tbl_periodo_1er_periodo', 'tbl_periodo_2ndo_periodo'], 'required'],
            [['tbl_periodo_1er_periodo', 'tbl_periodo_2ndo_periodo'], 'string', 'max' => 225],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'tbl_periodo_Id' => 'Tbl Periodo ID',
            'tbl_periodo_1er_periodo' => 'Tbl Periodo 1er Periodo',
            'tbl_periodo_2ndo_periodo' => 'Tbl Periodo 2ndo Periodo',
        ];
    }

    /**
     * Gets query for [[TblPersonals]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTblPersonals()
    {
        return $this->hasMany(TblPersonal::class, ['tbl_personal_periodo' => 'tbl_periodo_1er_periodo']);
    }
}
