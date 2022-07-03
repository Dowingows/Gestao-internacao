<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

/**
 * This is the model class for table "diagnostic".
 *
 * @property int $id
 * @property int $operator_id
 * @property string|null $accident_indication
 * @property string|null $ans_code
 * @property string|null $number_form_main
 * @property string|null $authorization_date
 * @property string|null $expiry_date_password
 * @property string|null $password
 * @property string|null $number_form_assigned_operator
 * @property int $patient_id
 * @property int $professional_id
 * @property string|null $service_character
 * @property string|null $request_date
 * @property string|null $clinical_indication
 * @property string|null $contractor_name
 * @property string|null $contracted_operator_code
 * @property string|null $executor_contractor_name
 * @property string|null $cod_operator_executing
 * @property string|null $service_type
 * @property string|null $type_medical_appointment
 * @property string|null $provider_form_number
 * @property string|null $reason_closing_service
 * @property int $contractor_applicant_id
 * @property int $contractor_executor_id
 * @property string|null $note
 */
class Diagnostic extends \yii\db\ActiveRecord
{
    public $operator_name;
    public $patient_name;

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
        return 'diagnostic';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['operator_id', 'patient_id', 'professional_id', 'contractor_applicant_id', 'contractor_executor_id'], 'required'],
            [['operator_id', 'patient_id', 'professional_id', 'contractor_applicant_id', 'contractor_executor_id'], 'default', 'value' => null],
            [['operator_id', 'patient_id', 'professional_id', 'contractor_applicant_id', 'contractor_executor_id'], 'integer'],
            [['authorization_date', 'expiry_date_password', 'password','request_date'], 'safe'],
            [['note'], 'string'],
            [['accident_indication', 'ans_code', 'service_character', 'contractor_name', 'contracted_operator_code', 'cod_operator_executing', 'service_type', 'type_medical_appointment', 'provider_form_number', 'reason_closing_service'], 'string', 'max' => 50],
            [['number_form_main', 'number_form_assigned_operator'], 'string', 'max' => 11],
            [['clinical_indication'], 'string', 'max' => 100],
            [['executor_contractor_name'], 'string', 'max' => 255],
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
            'accident_indication' => 'Indicador de Acidente',
            'ans_code' => 'Registro ANS',
            'number_form_main' => 'Nº Guia Principal',
            'authorization_date' => 'Data de Autorizacão',
            'password' => 'Senha',
            'expiry_date_password' => 'Data de Validade da Senha',
            'number_form_assigned_operator' => 'Nº Guia Atribuido pela Operadora',
            'patient_id' => 'Paciente',
            'patient_name' => 'Paciente',
            'professional_id' => 'Profissional',
            'service_character' => 'Caráter de Atendimento',
            'request_date' => 'Data de Solicitacão',
            'clinical_indication' => 'Indicacão Clínica',
            'contractor_name' => 'Nome do Contratado',
            'contracted_operator_code' => 'Codigo Operadora Contratado',
            'executor_contractor_name' => 'Nome Contratado Executante',
            'cod_operator_executing' => 'Codigo Operador Executante',
            'service_type' => 'Tipo de Atendimento',
            'type_medical_appointment' => 'Tipo Consulta',
            'provider_form_number' => 'Nº Guia do prestador',
            'reason_closing_service' => 'Motivo de encerramento do Atendimento',
            'contractor_applicant_id' => 'Contratado Solicitante',
            'contractor_executor_id' => 'Contratado Executante',
            'note' => 'Observação',
        ];
    }

    public function beforeSave($insert) {
        $fields = ['authorization_date', 'expiry_date_password', 'request_date'];
        foreach($fields as $field){
            if(!empty($this->{$field})){
                $this->{$field} = implode("-", array_reverse(explode("/", $this->{$field})));
            }  
        }
         
        return parent::beforeSave($insert);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDiagnosticProcedure()
    {
        return $this->hasMany(DiagnosticProcedure::class, ['diagnostic_id' => 'id']);
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
    public function getProfessional()
    {
        return $this->hasOne(Professional::class, ['id' => 'professional_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getContratadoExecutante()
    {
        return $this->hasOne(Hospital::class, ['id' => 'contratado_executante_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getContractorExecutor()
    {
        return $this->hasOne(Hospital::class, ['id' => 'contractor_executor_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPatient()
    {
        return $this->hasOne(Patient::class, ['id' => 'patient_id']);
    }


}
