<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Canciones;

/**
 * CancionesBuscar represents the model behind the search form about `backend\models\Canciones`.
 */
class CancionesBuscar extends Canciones
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Id', 'IdUsuario', 'Megusta'], 'integer'],
            [['Titulo', 'Audio', 'Letra', 'detalle', 'Fecha', 'Genero'], 'safe'],
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
        $query = Canciones::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'Id' => $this->Id,
            'IdUsuario' => $this->IdUsuario,
            'Fecha' => $this->Fecha,
            'Megusta' => $this->Megusta,
        ]);

        $query->andFilterWhere(['like', 'Titulo', $this->Titulo])
            ->andFilterWhere(['like', 'Audio', $this->Audio])
            ->andFilterWhere(['like', 'Letra', $this->Letra])
            ->andFilterWhere(['like', 'detalle', $this->detalle])
            ->andFilterWhere(['like', 'Genero', $this->Genero]);

        return $dataProvider;
    }
}
