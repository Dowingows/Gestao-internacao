<?php

use yii\db\Migration;

/**
 * Class m220703_135914_add_constraints_fk_internment
 */
class m220703_135914_add_constraints_fk_internment extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addForeignKey('fk-internment-operator-id', 'internment', 'operator_id', 'operator', 'id');
        $this->addForeignKey('fk-internment-patient-id', 'internment', 'patient_id', 'patient', 'id');
        $this->addForeignKey('fk-internment-professional-id', 'internment', 'professional_id', 'professional', 'id');

        $this->addForeignKey('fk-internment-hospital-applicant-id', 'internment', 'hospital_applicant_id', 'hospital', 'id');
        $this->addForeignKey('fk-internment-hospital-requested-id', 'internment', 'hospital_requested_id', 'hospital', 'id');
        $this->addForeignKey('fk-internment-hospital-authorized-id', 'internment', 'hospital_authorized_id', 'hospital', 'id');


    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-internment-operator-id','internment');
        $this->dropForeignKey('fk-internment-patient-id','internment');
        $this->dropForeignKey('fk-internment-professional-id','internment');

        $this->dropForeignKey('fk-internment-hospital-applicant-id','internment');
        $this->dropForeignKey('fk-internment-hospital-requested-id','internment');
        $this->dropForeignKey('fk-internment-hospital-authorized-id','internment');
        

        return true;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220703_135914_add_constraints_fk_internment cannot be reverted.\n";

        return false;
    }
    */
}
