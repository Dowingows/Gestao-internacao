<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%diagnostic}}`.
 */
class m220627_000538_create_diagnostic_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%diagnostic}}', [
            'id' => $this->primaryKey(),
            'operator_id' => $this->integer()->notNull(),
            'accident_indication' => $this->string(50),
            'ans_code' => $this->string(50),
            'number_form_main' => $this->string(11),
            'authorization_date' => $this->date(),
            'expiry_date_password' => $this->date(),
            'number_form_assigned_operator' => $this->string(11),
            'patient_id' => $this->integer()->notNull(),
            'professional_id' => $this->integer()->notNull(),
            'service_character' => $this->string(50),
            'request_date' => $this->date(),
            'clinical_indication' => $this->string(100),
            'contractor_name' => $this->string(50),
            'contracted_operator_code' => $this->string(50),
            'executor_contractor_name' => $this->string(),
            'cod_operator_executing' => $this->string(50),
            'service_type' => $this->string(50),
            'type_medical_appointment' => $this->string(50),
            'provider_form_number' => $this->string(50),
            'reason_closing_service' => $this->string(50),
            'contractor_applicant_id' => $this->integer()->notNull(),
            'contractor_executor_id' => $this->integer()->notNull(),
            'note' => $this->text(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%diagnostic}}');
    }
}
