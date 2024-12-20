<?php

namespace app\models;

use Yii;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "tbl_registro_personal".
 *
 * @property int $tbl_registro_personal_id
 * @property string $tbl_registro_personal_nombre
 * @property string $tbl_registro_personal_clave
 * @property string $tbl_registro_personal_puesto
 * @property string $tbl_registro_personal_funcion
 * @property string $tbl_registro_personal_area
 * @property string $tbl_registro_personal_dep
 * @property string $tbl_registro_personal_tarjeta_asis
 * @property string $tbl_registro_personal_jornada
 * @property string $tbl_registro_personal_contraseña
 * @property string $tbl_registro_personal_correo
 * @property string $tbl_registro_personal_contrato
 */
class TblRegistroPersonal extends \yii\db\ActiveRecord 
{
     
    public $roles; 
    /**
     * 
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_registro_personal';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tbl_registro_personal_nombre', 'tbl_registro_personal_clave', 'tbl_registro_personal_puesto', 'tbl_registro_personal_funcion', 'tbl_registro_personal_area', 'tbl_registro_personal_dep', 'tbl_registro_personal_tarjeta_asis', 'tbl_registro_personal_jornada', 'tbl_registro_personal_contraseña', 'tbl_registro_personal_correo', 'tbl_registro_personal_contrato'], 'required'],
            [['tbl_registro_personal_nombre', 'tbl_registro_personal_puesto', 'tbl_registro_personal_funcion', 'tbl_registro_personal_area', 'tbl_registro_personal_dep', 'tbl_registro_personal_tarjeta_asis', 'tbl_registro_personal_jornada'], 'string', 'max' => 200],
            [['tbl_registro_personal_clave'], 'string', 'max' => 255],
            [['tbl_registro_personal_contraseña', 'tbl_registro_personal_correo'], 'string', 'max' => 255],
            [['roles'], 'safe'],
            [['roles'], 'in', 'range' => array_keys($this->getRoleOptions())],

        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'tbl_registro_personal_id' => 'Tbl Registro Personal ID',
            'tbl_registro_personal_nombre' => 'Nombre',
            'tbl_registro_personal_clave' => 'Clave',
            'tbl_registro_personal_puesto' => 'Puesto',
            'tbl_registro_personal_funcion' => 'Función',
            'tbl_registro_personal_area' => 'Área',
            'tbl_registro_personal_dep' => 'Departamento',
            'tbl_registro_personal_tarjeta_asis' => 'Numero de Tarjeta de Asistencia',
            'tbl_registro_personal_jornada' => 'Jornada',
            'tbl_registro_personal_contraseña' => 'Contraseña',
            'tbl_registro_personal_correo' => 'Correo',
            'tbl_registro_personal_contrato' => 'Contrato',
        ];
    }
  public function getRoleOptions()
    {
        return [
            'User' => 'Usuario',
            'Admin' => 'Administrador', 
            'Owner' => 'Propietario',   
            'Jefe' => 'Jefe'
        ];
    }
}
