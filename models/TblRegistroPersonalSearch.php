<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\TblRegistroPersonal;

/**
 * TblRegistroPersonalSearch represents the model behind the search form of `app\models\TblRegistroPersonal`.
 */
class TblRegistroPersonalSearch extends TblRegistroPersonal
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tbl_registro_personal_id'], 'integer'],
            [['tbl_registro_personal_nombre', 'tbl_registro_personal_clave', 'tbl_registro_personal_puesto', 'tbl_registro_personal_funcion', 'tbl_registro_personal_area', 'tbl_registro_personal_dep', 'tbl_registro_personal_tarjeta_asis', 'tbl_registro_personal_jornada', 'tbl_registro_personal_contraseña', 'tbl_registro_personal_correo'], 'safe'],
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
        $query = TblRegistroPersonal::find();

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
            'tbl_registro_personal_id' => $this->tbl_registro_personal_id,
        ]);

        $query->andFilterWhere(['like', 'tbl_registro_personal_nombre', $this->tbl_registro_personal_nombre])
            ->andFilterWhere(['like', 'tbl_registro_personal_clave', $this->tbl_registro_personal_clave])
            ->andFilterWhere(['like', 'tbl_registro_personal_puesto', $this->tbl_registro_personal_puesto])
            ->andFilterWhere(['like', 'tbl_registro_personal_funcion', $this->tbl_registro_personal_funcion])
            ->andFilterWhere(['like', 'tbl_registro_personal_area', $this->tbl_registro_personal_area])
            ->andFilterWhere(['like', 'tbl_registro_personal_dep', $this->tbl_registro_personal_dep])
            ->andFilterWhere(['like', 'tbl_registro_personal_tarjeta_asis', $this->tbl_registro_personal_tarjeta_asis])
            ->andFilterWhere(['like', 'tbl_registro_personal_jornada', $this->tbl_registro_personal_jornada])
            ->andFilterWhere(['like', 'tbl_registro_personal_contraseña', $this->tbl_registro_personal_contraseña])
            ->andFilterWhere(['like', 'tbl_registro_personal_correo', $this->tbl_registro_personal_correo]);

        return $dataProvider;
    }
}
