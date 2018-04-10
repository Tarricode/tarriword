<?php

namespace backend\models;

use Yii;

class Likes extends \yii\db\ActiveRecord
{

    public static function tableName()
    {
        return 'likes';
    }

    public function rules()
    {
        return [
            [['Id_Usuario','Id_Caciones'], 'safe']
        ];
    }
}
