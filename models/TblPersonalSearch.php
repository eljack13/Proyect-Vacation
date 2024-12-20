<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\TblPersonal;

/**
 * TblPersonalSearch represents the model behind the search form of `app\models\TblPersonal`.
 */
class TblPersonalSearch extends TblPersonal
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tbl_personal_Id', 'tbl_personal_dias_disponibles'], 'integer'],
            [['tbl_personal_nombre', 'tbl_personal_fecha_inicio_laboral', 'tbl_personal_tipo', 'tbl_personal_periodo', 'tbl_personal_fecha_inicio', 'tbl_personal_fecha_final'], 'safe'],
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
        $query = TblPersonal::find();

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
            'tbl_personal_Id' => $this->tbl_personal_Id,
            'tbl_personal_fecha_inicio_laboral' => $this->tbl_personal_fecha_inicio_laboral,
            'tbl_personal_dias_disponibles' => $this->tbl_personal_dias_disponibles,
            'tbl_personal_fecha_inicio' => $this->tbl_personal_fecha_inicio,
            'tbl_personal_fecha_final' => $this->tbl_personal_fecha_final,
        ]);

        $query->andFilterWhere(['like', 'tbl_personal_nombre', $this->tbl_personal_nombre])
            ->andFilterWhere(['like', 'tbl_personal_tipo', $this->tbl_personal_tipo])
            ->andFilterWhere(['like', 'tbl_personal_periodo', $this->tbl_personal_periodo]);

        return $dataProvider;
    }
}
