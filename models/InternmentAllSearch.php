<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Internment;

/**
 * InternacaoAllSearch represents the model behind the search form about `app\models\Internacao`.
 */
class InternmentAllSearch extends Internment
{

    public $date_initial ;
    public $date_final;

     /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'operator_id', 'patient_id', 'hospital_applicant_id', 'professional_id', 'hospital_requested_id', 'quantity_daily_requested', 'quantity_daily_authorized', 'hospital_authorized_id'], 'integer'],
            [['authorization_date', 'created_at'],  'date'],
            [['number_form_assigned_operator', 'provider_form_number', 'authorization_date', 'password', 'expiry_date_password', 'suggested_hospitalization_date', 'service_character', 'regime', 'opme_usage_forecast', 'chemotherapy_usage_forecast', 'clinical_indication', 'cid10_1', 'cid10_2', 'cid10_3', 'cid10_4', 'accident_indication', 'hospital_admission_date', 'authorized_accommodation_type', 'type_name','cnes_code', 'note', 'request_date', 'created_at', 'updated_at', 'deleted_at','patient_name', 'operator_name'], 'safe'],
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
        $query = Internment::find()->orderBy(['id' => SORT_DESC]);
    
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
