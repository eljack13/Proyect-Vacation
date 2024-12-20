<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\TblIntermedia;

/**
 * TblIntermediaSearch represents the model behind the search form of `app\models\TblIntermedia`.
 */
class TblIntermediaSearch extends TblIntermedia
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['Persona_id', 'Persona_diasrestantes', 'tbl_intermedia_id'], 'integer'],
            [['Persona_periodo', 'Persona_año'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
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
        $query = TblIntermedia::find();

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
            'Persona_id' => $this->Persona_id,
            'Persona_diasrestantes' => $this->Persona_diasrestantes,
        ]);

        $query->andFilterWhere(['like', 'Persona_periodo', $this->Persona_periodo])
            ->andFilterWhere(['like', 'Persona_año', $this->Persona_año]);

        return $dataProvider;
    }
}
