<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Notificaciones;

/**
 * NotificacioneBuscador represents the model behind the search form of `frontend\models\Notificaciones`.
 */
class NotificacioneBuscador extends Notificaciones
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Id', 'Visto'], 'integer'],
            [['Tipo', 'Descripcion', 'Id_Usuario', 'Id_Item', 'Area', 'Fecha_Creacion', 'Fecha_De_Visto'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Notificaciones::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'Id' => $this->Id,
            'Fecha_Creacion' => $this->Fecha_Creacion,
            'Fecha_De_Visto' => $this->Fecha_De_Visto,
            'Visto' => $this->Visto,
        ]);

        $query->andFilterWhere(['like', 'Tipo', $this->Tipo])
            ->andFilterWhere(['like', 'Descripcion', $this->Descripcion])
            ->andFilterWhere(['like', 'Id_Usuario', $this->Id_Usuario])
            ->andFilterWhere(['like', 'Id_Item', $this->Id_Item])
            ->andFilterWhere(['like', 'Area', $this->Area]);

        return $dataProvider;
    }
}
