<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Supply;

/**
 * SupplySearch represents the model behind the search form of `app\models\Supply`.
 */
class SupplySearch extends Supply
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['cod_simpro', 'un_vr', 'und', 'description', 'cod_tnumm', 'cod_padrao', 'cod_agend', 'cod_agend_cob', 'nature'], 'safe'],
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
        $query = Supply::find();

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

        $query->andFilterWhere(['ilike', 'cod_simpro', $this->cod_simpro])
            ->andFilterWhere(['ilike', 'un_vr', $this->un_vr])
            ->andFilterWhere(['ilike', 'und', $this->und])
            ->andFilterWhere(['ilike', 'description', $this->description])
            ->andFilterWhere(['ilike', 'cod_tnumm', $this->cod_tnumm])
            ->andFilterWhere(['ilike', 'cod_padrao', $this->cod_padrao])
            ->andFilterWhere(['ilike', 'cod_agend', $this->cod_agend])
            ->andFilterWhere(['ilike', 'cod_agend_cob', $this->cod_agend_cob])
            ->andFilterWhere(['ilike', 'nature', $this->nature]);

        return $dataProvider;
    }
}
