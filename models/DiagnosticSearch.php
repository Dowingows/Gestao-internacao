<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Diagnostic;

/**
 * DiagnosticSearch represents the model behind the search form of `app\models\Diagnostic`.
 */
class DiagnosticSearch extends Diagnostic
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'operator_id', 'patient_id', 'professional_id', 'contractor_applicant_id', 'contractor_executor_id'], 'integer'],
            [['authorization_date'],  'date'],
            [['accident_indication', 'ans_code', 'number_form_main', 'authorization_date', 'expiry_date_password', 'number_form_assigned_operator', 'service_character', 'request_date', 'clinical_indication', 'contractor_name', 'contracted_operator_code', 'operator_name','patient_name', 'executor_contractor_name', 'cod_operator_executing', 'service_type', 'type_medical_appointment', 'provider_form_number', 'reason_closing_service', 'note'], 'safe'],
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
        $query = Diagnostic::find()->andWhere(['is', 'deleted_at', new \yii\db\Expression('null') ]);
        $query->joinWith(['operator']);
        $query->joinWith(['patient']);
        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        // Important: here is how we set up the sorting
        // The key is the attribute name on our "TourSearch" instance
        $dataProvider->sort->attributes['operator_name'] = [
            // The tables are the ones our relation are configured to
            // in my case they are prefixed with "tbl_"
            'asc' => ['operator.name' => SORT_ASC],
            'desc' => ['operator.name' => SORT_DESC],
        ];
        // Important: here is how we set up the sorting
        // The key is the attribute name on our "TourSearch" instance
        $dataProvider->sort->attributes['patient_name'] = [
            // The tables are the ones our relation are configured to
            // in my case they are prefixed with "tbl_"
            'asc' => ['patient.name' => SORT_ASC],
            'desc' => ['patient.name' => SORT_DESC],
        ];


        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }
        
       

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'operator_id' => $this->operator_id,
            'authorization_date' =>  implode("-", array_reverse(explode("/", $this->authorization_date))) ,
            'expiry_date_password' => $this->expiry_date_password,
            'patient_id' => $this->patient_id,
            'professional_id' => $this->professional_id,
            'request_date' => $this->request_date,
            'contractor_applicant_id' => $this->contractor_applicant_id,
            'contractor_executor_id' => $this->contractor_executor_id
        ]);

        $query->andFilterWhere(['ilike', 'accident_indication', $this->accident_indication])
            ->andFilterWhere(['ilike', 'ans_code', $this->ans_code])
            ->andFilterWhere(['ilike', 'number_form_main', $this->number_form_main])
            ->andFilterWhere(['ilike', 'number_form_assigned_operator', $this->number_form_assigned_operator])
            ->andFilterWhere(['ilike', 'service_character', $this->service_character])
            ->andFilterWhere(['ilike', 'clinical_indication', $this->clinical_indication])
            ->andFilterWhere(['ilike', 'contractor_name', $this->contractor_name])
            ->andFilterWhere(['ilike', 'contracted_operator_code', $this->contracted_operator_code])
            ->andFilterWhere(['ilike', 'executor_contractor_name', $this->executor_contractor_name])
            ->andFilterWhere(['ilike', 'cod_operator_executing', $this->cod_operator_executing])
            ->andFilterWhere(['ilike', 'service_type', $this->service_type])
            ->andFilterWhere(['ilike', 'type_medical_appointment', $this->type_medical_appointment])
            ->andFilterWhere(['ilike', 'provider_form_number', $this->provider_form_number])
            ->andFilterWhere(['ilike', 'reason_closing_service', $this->reason_closing_service])
            ->andFilterWhere(['ilike', 'note', $this->note])
            ->andFilterWhere(['like', 'operator.name', $this->operator_name])
            ->andFilterWhere(['like', 'patient.name', $this->patient_name])
            ;

        return $dataProvider;
    }
}
