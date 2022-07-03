<?php

use yii\db\Migration;
use yii\db\Expression;

/**
 * Handles the creation of table `{{%internment}}`.
 */
class m220703_130851_create_internment_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%internment}}', [
            'id' => $this->primaryKey(),
            'operator_id' => $this->integer()->notNull(),
            'number_form_assigned_operator'=> $this->string(11),
            'provider_form_number' => $this->string(50),
            'authorization_date' => $this->date(),
            'password' => $this->string(50),
            'expiry_date_password' => $this->date(),
            'patient_id' => $this->integer()->notNull(),
            'hospital_applicant_id' => $this->integer()->notNull() ,
            'professional_id' => $this->integer()->notNull(),
            'hospital_requested_id' => $this->integer()->notNull() ,
            'suggested_hospitalization_date' => $this->date(),
            'service_character' => $this->string(50),
            'regime' => $this->string(50),
            'quantity_daily_requested' => $this->integer(),
            'opme_usage_forecast' =>  $this->string(50),
            'chemotherapy_usage_forecast' =>  $this->string(50),
            'clinical_indication' =>  $this->text(),
            'cid10_1' => $this->string(50),
            'cid10_2' => $this->string(50),
            'cid10_3' => $this->string(50),
            'cid10_4' => $this->string(50),
            'accident_indication' => $this->string(50),
            'hospital_admission_date' => $this->date(),
            'quantity_daily_authorized' => $this->integer(),
            'authorized_accommodation_type' => $this->string(50),
            'hospital_authorized_id' => $this->integer()->notNull(),
            'cnes_code'  => $this->string(50),
            'note'  => $this->text(),
            'request_date' => $this->date(),
            'created_at' => $this->dateTime()->notNull()->defaultValue(new Expression('NOW()')),
            'updated_at' => $this->dateTime()->notNull()->defaultValue(new Expression('NOW()')),
            'deleted_at' => $this->dateTime()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%internment}}');
    }
}
