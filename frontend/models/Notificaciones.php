<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "notificaciones".
 *
 * @property integer $Id
 * @property string $Tipo
 * @property string $Descripcion
 * @property string $Id_Usuario
 * @property string $Id_Item
 * @property string $Area
 * @property string $Fecha_Creacion
 * @property string $Fecha_De_Visto
 * @property integer $Visto
 */
class Notificaciones extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'notificaciones';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Descripcion', 'Id_Usuario', 'Id_Item', 'Area', 'Fecha_Creacion', 'Fecha_De_Visto'], 'required'],
            [['Fecha_Creacion', 'Fecha_De_Visto'], 'safe'],
            [['Visto'], 'integer'],
            [['Tipo'], 'string', 'max' => 30],
            [['Descripcion'], 'string', 'max' => 100],
            [['Id_Usuario', 'Id_Item', 'Area'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Id' => 'ID',
            'Tipo' => 'Tipo',
            'Descripcion' => 'Descripcion',
            'Id_Usuario' => 'Id  Usuario',
            'Id_Item' => 'Id  Item',
            'Area' => 'Area',
            'Fecha_Creacion' => 'Fecha  Creacion',
            'Fecha_De_Visto' => 'Fecha  De  Visto',
            'Visto' => 'Visto',
        ];
    }
}
