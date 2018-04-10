<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "canciones".
 *
 * @property integer $Id
 * @property integer $IdUsuario
 * @property string $Titulo
 * @property string $Audio
 * @property string $Letra
 * @property string $detalle
 * @property string $Fecha
 * @property string $Genero
 * @property integer $Megusta
 */
class Canciones extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public $Genero2;
    public $file;

    public static function tableName()
    {
        return 'canciones';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['IdUsuario', 'Titulo', 'Audio', 'Letra', 'detalle', 'Fecha', 'Genero', 'Megusta'], 'required'],
            [['IdUsuario', 'Megusta'], 'integer'],
            [['Letra'], 'string'],
            [['Fecha','Genero2'], 'safe'],
            [["file"], "file"],
            [['Titulo'], 'string', 'max' => 30],
            [['Audio'], 'string', 'max' => 120],
            [['detalle', 'Genero'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Id' => 'ID',
            'IdUsuario' => 'Id Usuario',
            'Titulo' => 'Titulo',
            'Audio' => 'Audio',
            'Letra' => 'Letra',
            'detalle' => 'Detalle',
            'Fecha' => 'Fecha',
            'Genero' => 'Genero',
            'Megusta' => 'Megusta',
        ];
    }
}
