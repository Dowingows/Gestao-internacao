<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Procedure;

/**
 * ProcedureSearch represents the model behind the search form of `app\models\Procedure`.
 */
class ProcedureSearch extends Procedure
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'procedure_code'], 'integer'],
            [['table', 'description'], 'safe'],
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
        $query = Procedure::find();

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
            'procedure_code' => $this->procedure_code,
            'price' => $this->price,
        ]);

        $query->andFilterWhere(['ilike', 'table', $this->table])
            ->andFilterWhere(['ilike', 'description', $this->description]);

        return $dataProvider;
    }
}
