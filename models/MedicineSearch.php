<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Medicine;

/**
 * MedicineSearch represents the model behind the search form of `app\models\Medicine`.
 */
class MedicineSearch extends Medicine
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['cod_tiss', 'um_vr', 'und', 'description', 'cod_tnumm', 'cod_brasindice', 'cod_tiss_2', 'cod_agend', 'cod_agend_cob'], 'safe'],
            [['price'], 'number'],
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
        $query = Medicine::find();

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
            'id' => $this->id,
            'price' => $this->price,
        ]);

        $query->andFilterWhere(['ilike', 'cod_tiss', $this->cod_tiss])
            ->andFilterWhere(['ilike', 'um_vr', $this->um_vr])
            ->andFilterWhere(['ilike', 'und', $this->und])
            ->andFilterWhere(['ilike', 'description', $this->description])
            ->andFilterWhere(['ilike', 'cod_tnumm', $this->cod_tnumm])
            ->andFilterWhere(['ilike', 'cod_brasindice', $this->cod_brasindice])
            ->andFilterWhere(['ilike', 'cod_tiss_2', $this->cod_tiss_2])
            ->andFilterWhere(['ilike', 'cod_agend', $this->cod_agend])
            ->andFilterWhere(['ilike', 'cod_agend_cob', $this->cod_agend_cob]);

        return $dataProvider;
    }
}
