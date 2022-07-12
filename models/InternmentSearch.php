<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Internment;

/**
 * InternmentSearch represents the model behind the search form of `app\models\Internment`.
 */
class InternmentSearch extends Internment
{
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

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Internment::find()->andWhere(['is', 'deleted_at', new \yii\db\Expression('null') ]);
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

        $dataProvider->sort->attributes['type_name'] = [
            // The tables are the ones our relation are configured to
            // in my case they are prefixed with "tbl_"
            'asc' => ['internment_id' => SORT_ASC],
            'desc' => ['internment_id' => SORT_DESC],
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
            'authorization_date' => implode("-", array_reverse(explode("/", $this->authorization_date))),
            'expiry_date_password' => $this->expiry_date_password,
            'patient_id' => $this->patient_id,
            'hospital_applicant_id' => $this->hospital_applicant_id,
            'professional_id' => $this->professional_id,
            'hospital_requested_id' => $this->hospital_requested_id,
            'suggested_hospitalization_date' => $this->suggested_hospitalization_date,
            'quantity_daily_requested' => $this->quantity_daily_requested,
            'hospital_admission_date' => $this->hospital_admission_date,
            'quantity_daily_authorized' => $this->quantity_daily_authorized,
            'hospital_authorized_id' => $this->hospital_authorized_id,
            'request_date' => implode("-", array_reverse(explode("/", $this->request_date))),
        ]);

        
        if ($this->type_name != 0){
            if ($this->type_name  == '1'){
                $query->andFilterWhere(['is', 'internment_id', new \yii\db\Expression('null')]);
            }else{
                $query->andFilterWhere(['is not', 'internment_id', new \yii\db\Expression('null')]);
            } 
        }
        

        $query->andFilterWhere(['ilike', 'number_form_assigned_operator', $this->number_form_assigned_operator])
            ->andFilterWhere(['ilike', 'provider_form_number', $this->provider_form_number])
            ->andFilterWhere(['ilike', 'password', $this->password])
            ->andFilterWhere(['ilike', 'service_character', $this->service_character])
            ->andFilterWhere(['ilike', 'regime', $this->regime])
            ->andFilterWhere(['ilike', 'opme_usage_forecast', $this->opme_usage_forecast])
            ->andFilterWhere(['ilike', 'chemotherapy_usage_forecast', $this->chemotherapy_usage_forecast])
            ->andFilterWhere(['ilike', 'clinical_indication', $this->clinical_indication])
            ->andFilterWhere(['ilike', 'cid10_1', $this->cid10_1])
            ->andFilterWhere(['ilike', 'cid10_2', $this->cid10_2])
            ->andFilterWhere(['ilike', 'cid10_3', $this->cid10_3])
            ->andFilterWhere(['ilike', 'cid10_4', $this->cid10_4])
            ->andFilterWhere(['ilike', 'accident_indication', $this->accident_indication])
            ->andFilterWhere(['ilike', 'authorized_accommodation_type', $this->authorized_accommodation_type])
            ->andFilterWhere(['ilike', 'cnes_code', $this->cnes_code])
            ->andFilterWhere(['ilike', 'note', $this->note])
            ->andFilterWhere(['like', 'operator.name', $this->operator_name])
            ->andFilterWhere(['like', 'patient.name', $this->patient_name]);

        return $dataProvider;
    }
}
