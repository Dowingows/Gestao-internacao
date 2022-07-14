<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

/**
 * This is the model class for table "internment".
 *
 * @property int $id
 * @property int $operator_id
 * @property string|null $number_form_assigned_operator
 * @property string|null $provider_form_number
 * @property string|null $authorization_date
 * @property string|null $password
 * @property string|null $expiry_date_password
 * @property int $patient_id
 * @property int $hospital_applicant_id
 * @property int $professional_id
 * @property int $hospital_requested_id
 * @property string|null $suggested_hospitalization_date
 * @property string|null $service_character
 * @property string|null $regime
 * @property int|null $quantity_daily_requested
 * @property string|null $opme_usage_forecast
 * @property string|null $chemotherapy_usage_forecast
 * @property string|null $clinical_indication
 * @property string|null $cid10_1
 * @property string|null $cid10_2
 * @property string|null $cid10_3
 * @property string|null $cid10_4
 * @property string|null $accident_indication
 * @property string|null $hospital_admission_date
 * @property int|null $quantity_daily_authorized
 * @property string|null $authorized_accommodation_type
 * @property int $hospital_authorized_id
 * @property string|null $cnes_code
 * @property string|null $note
 * @property string|null $request_date
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 */
class Internment extends \yii\db\ActiveRecord
{
    
    public $operator_name;
    public $patient_name;
    public $type_name;
    
    public $dateFields = [
        'authorization_date', 
        'expiry_date_password', 
        'request_date', 
        'suggested_hospitalization_date',
        'hospital_admission_date'
    ];

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::class,
                'value' => new Expression('NOW()'),
            ]
        ];
    }
    
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'internment';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['operator_id', 'patient_id', 'hospital_applicant_id', 'professional_id', 'hospital_requested_id', 'hospital_authorized_id'], 'required'],
            [['operator_id', 'patient_id', 'hospital_applicant_id', 'professional_id', 'hospital_requested_id', 'quantity_daily_requested', 'quantity_daily_authorized', 'hospital_authorized_id'], 'default', 'value' => null],
            [['operator_id', 'patient_id', 'hospital_applicant_id', 'professional_id', 'hospital_requested_id', 'quantity_daily_requested', 'quantity_daily_authorized', 'hospital_authorized_id'], 'integer'],
            [['authorization_date', 'expiry_date_password', 'suggested_hospitalization_date', 'hospital_admission_date', 'request_date', 'created_at', 'updated_at', 'deleted_at', 'internment_id', 'operator_justification', 'requested_accommodation_type', 'type_name'], 'safe'],
            [['clinical_indication', 'note'], 'string'],
            [['number_form_assigned_operator'], 'string', 'max' => 11],
            [['provider_form_number', 'password', 'service_character', 'regime', 'opme_usage_forecast', 'chemotherapy_usage_forecast', 'cid10_1', 'cid10_2', 'cid10_3', 'cid10_4', 'accident_indication', 'authorized_accommodation_type', 'cnes_code'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'operator_id' => 'Operadora',
            'operator_name' => 'Operadora',
            'type_name' => 'Tipo',
            'number_form_assigned_operator' => 'Nº Guia Atribuido pela Operadora',
            'provider_form_number' =>  'Nº Guia do prestador',
            'authorization_date' =>  'Data de Autorizacão',
            'password' => 'Senha',
            'expiry_date_password' =>'Data de Validade da Senha',
            'patient_id' => 'Paciente',
            'patient_name' => 'Paciente',
            'hospital_applicant_id' => 'Hospital Solicitante',
            'professional_id' => 'Profissional',
            'hospital_requested_id' => 'Hospital Solicitado',
            'suggested_hospitalization_date' => 'Data Sugerida para Internação',
            'service_character' => 'Caráter de Atendimento',
            'regime' => 'Regime de Internação',
            'quantity_daily_requested' => 'Quantidade Diária Solicitada',
            'opme_usage_forecast' => 'Previsão Uso OPME',
            'chemotherapy_usage_forecast' => 'Previsão Uso Quimioterapia',
            'clinical_indication' => 'Indicação Clínica',
            'cid10_1' => 'CID 10 Principal (Opcional)',
            'cid10_2' => 'CID 10 (2) (Opcional)',
            'cid10_3' => 'CID 10 (3) (Opcional)',
            'cid10_4' => 'CID 10 (4) (Opcional)',
            'accident_indication' => 'Indicação de Acidente (acidente ou doenca relacionada)',
            'hospital_admission_date' => 'Data da Admissão Hospitalar',
            'quantity_daily_authorized' => 'Quantidade de Diárias Autorizada',
            'authorized_accommodation_type' => 'Tipo da Acomodacão Autorizada',
            'hospital_authorized_id' => 'Hospital Autorizado',
            'cnes_code' => 'Código CNES',
            'note' => 'Observação',
            'request_date' => 'Data da Solicitação',
            'created_at' => 'Criado em',
            'updated_at' => 'Atualizado em',
            'deleted_at' => 'Removido em',
            'operator_justification' => 'Justificativa da Operadora',
            'requested_accommodation_type' => 'Tipo de Acomodação Solicitada'
        ];
    }

    public function beforeSave($insert) {
        
        $fields = $this->dateFields;

        foreach($fields as $field){
            if(!empty($this->{$field})){
                $this->{$field} = implode("-", array_reverse(explode("/", $this->{$field})));
            }  
        }
         
        return parent::beforeSave($insert);
    }

    public function isExtension()
    {
        return $this->internment_id != null;
    }

    public function getTypeName()
    {
        return $this->internment_id != null ? 'Prorrogada' : 'Normal';
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParent()
    {
        return $this->hasOne(Internment::class, ['id' => 'internment_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getExtensions()
    {
        return $this->hasMany(Internment::class, ['internment_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOperator()
    {
        return $this->hasOne(Operator::class, ['id' => 'operator_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPatient()
    {
        return $this->hasOne(Patient::class, ['id' => 'patient_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProfessional()
    {
        return $this->hasOne(Professional::class, ['id' => 'professional_id']);
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHospitalApplicant()
    {
        return $this->hasOne(Hospital::class, ['id' => 'hospital_applicant_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHospitalRequested()
    {
        return $this->hasOne(Hospital::class, ['id' => 'hospital_requested_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHospitalAuthorized()
    {
        return $this->hasOne(Hospital::class, ['id' => 'hospital_authorized_id']);
    }

     /**
     * @return \yii\db\ActiveQuery
     */
    public function getInternmentProcedure()
    {
        return $this->hasMany(InternmentProcedure::class, ['internment_id' => 'id']);
    }
    

    
}
