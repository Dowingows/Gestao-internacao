<?php

namespace app\models;

use Yii;

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
            [['authorization_date', 'expiry_date_password', 'request_date'], 'safe'],
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
            'operator_id' => 'Operator ID',
            'accident_indication' => 'Accident Indication',
            'ans_code' => 'Ans Code',
            'number_form_main' => 'Number Form Main',
            'authorization_date' => 'Authorization Date',
            'expiry_date_password' => 'Expiry Date Password',
            'number_form_assigned_operator' => 'Number Form Assigned Operator',
            'patient_id' => 'Patient ID',
            'professional_id' => 'Professional ID',
            'service_character' => 'Service Character',
            'request_date' => 'Request Date',
            'clinical_indication' => 'Clinical Indication',
            'contractor_name' => 'Contractor Name',
            'contracted_operator_code' => 'Contracted Operator Code',
            'executor_contractor_name' => 'Executor Contractor Name',
            'cod_operator_executing' => 'Cod Operator Executing',
            'service_type' => 'Service Type',
            'type_medical_appointment' => 'Type Medical Appointment',
            'provider_form_number' => 'Provider Form Number',
            'reason_closing_service' => 'Reason Closing Service',
            'contractor_applicant_id' => 'Contractor Applicant ID',
            'contractor_executor_id' => 'Contractor Executor ID',
            'note' => 'Note',
        ];
    }
}
