<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Professional;

/**
 * ProfessionalSearch represents the model behind the search form of `app\models\Professional`.
 */
class ProfessionalSearch extends Professional
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['name', 'council', 'council_number', 'uf', 'cbo_code', 'type'], 'safe'],
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
        $query = Professional::find();

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
        ]);

        $query->andFilterWhere(['ilike', 'name', $this->name])
            ->andFilterWhere(['ilike', 'council', $this->council])
            ->andFilterWhere(['ilike', 'council_number', $this->council_number])
            ->andFilterWhere(['ilike', 'uf', $this->uf])
            ->andFilterWhere(['ilike', 'cbo_code', $this->cbo_code])
            ->andFilterWhere(['ilike', 'type', $this->type]);

        return $dataProvider;
    }
}
