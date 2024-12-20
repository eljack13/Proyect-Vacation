<?php

namespace app\models;

use yii\web\UploadedFile;

use Yii;

/**
 * This is the model class for table "tbl_sata".
 *
 * @property int $tbl_sata_id
 * @property string $tbl_sata_nombre
 * @property string $tbl_sata_date
 * @property string $tbl_sata_dateint
 * @property string $pdf_path
 */
class TblSata extends \yii\db\ActiveRecord
{
    public $pdfFile;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_sata';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tbl_sata_nombre', 'tbl_sata_dateint', 'pdf_path'], 'required'],
            [['tbl_sata_dateint'], 'safe'],
            [['tbl_sata_nombre', 'tbl_sata_date'], 'string', 'max' => 200],
            [['pdfFile'], 'file',
                'skipOnEmpty' => true,
                'extensions' => 'pdf',
                'maxSize' => 1024 * 1024 * 10, // 10MB
                'tooBig' => 'El archivo no debe exceder 10MB',
                'wrongExtension' => 'Solo se permiten archivos PDF'
            ],
            [['pdf_path'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'tbl_sata_id' => 'ID',
            'tbl_sata_nombre' => 'Nombre del Documento ',
            'tbl_sata_date' => 'Fecha',
            'tbl_sata_dateint' => 'Tbl Sata Dateint',
            'pdfFile' => 'Documento en PDF',
            'pdf_path' => 'PDF PATH'
        ];
    }
}