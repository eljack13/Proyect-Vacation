<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\TblSata;

/**
 * TblSataSearch represents the model behind the search form of `app\models\TblSata`.
 */
class TblSataSearch extends TblSata
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tbl_sata_id'], 'integer'],
            [['tbl_sata_nombre', 'tbl_sata_date', 'tbl_sata_dateint', 'pdf_path'], 'safe'],
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
        $query = TblSata::find();

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
            'tbl_sata_id' => $this->tbl_sata_id,
            'tbl_sata_dateint' => $this->tbl_sata_dateint,
        ]);

        $query->andFilterWhere(['like', 'tbl_sata_nombre', $this->tbl_sata_nombre])
            ->andFilterWhere(['like', 'tbl_sata_date', $this->tbl_sata_date])
            ->andFilterWhere(['like', 'pdf_path', $this->pdf_path]);

        return $dataProvider;
    }
}
