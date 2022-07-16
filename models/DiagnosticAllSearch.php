<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Diagnostic;

/**
 * InternacaoAllSearch represents the model behind the search form about `app\models\Internacao`.
 */
class DiagnosticAllSearch extends Diagnostic
{

    public $date_initial ;
    public $date_final;

     /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [[['date_initial', 'date_final'], 'safe']];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function attributeLabels()
    {
        return array_merge(parent::attributeLabels(), [
            'date_initial' => 'Data Inicial',
            'date_final' => 'Data Final'
        ]);
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
        $query = Diagnostic::find()->orderBy(['id' => SORT_DESC]);;

        // add conditions that should always apply here
        
        $this->load($params);

        $this->date_initial = empty($params['date_initial']) ? '01'.date('/m/Y'): $params['date_initial'];
        $this->date_final = empty($params['date_final']) ? date('d/m/Y'): $params['date_final'];
        
        
        if (!$this->validate()) {
            return $query;
        }

       
        $this->comparisonDates($query);

        return $query->all();
    }

    public function comparisonDates(&$query)
    {
        $formatDate = function ($date){
            return implode("-", array_reverse(explode("/", $date)));
        };
        
        if (!empty($this->date_initial) && !empty($this->date_final)) {
            $query->andFilterWhere(['between', 'authorization_date', $formatDate($this->date_initial), $formatDate($this->date_final)]);
        }

        if (!empty($this->date_initial)) {
            $query->andFilterWhere(['>=', 'authorization_date', $formatDate($this->date_initial)]);
        }

        if (!empty($this->date_final)) {

            $query->andFilterWhere(['<=', 'authorization_date', $formatDate($this->date_final)]);
        }
    }
}
