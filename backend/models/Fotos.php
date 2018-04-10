<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "fotos".
 *
 * @property integer $Id
 * @property string $Titulo
 * @property string $Url
 * @property string $Tipo
 */
class Fotos extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'fotos';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Titulo', 'Url', 'Tipo'], 'required'],
            [['Url'], 'string'],
            [['Titulo'], 'string', 'max' => 50],
            [['Tipo'], 'string', 'max' => 30],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Id' => 'ID',
            'Titulo' => 'Titulo',
            'Url' => 'Url',
            'Tipo' => 'Tipo',
        ];
    }
}
