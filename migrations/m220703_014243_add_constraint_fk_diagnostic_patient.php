<?php

use yii\db\Migration;

/**
 * Class m220703_014243_add_constraint_fk_diagnostic_patient
 */
class m220703_014243_add_constraint_fk_diagnostic_patient extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addForeignKey('fk-diagnostic-patient-id', 'diagnostic', 'patient_id', 'patient', 'id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey(
            'fk-diagnostic-patient-id',
            'diagnostic'
        );

        return true;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220703_014243_add_constraint_fk_diagnostic_patient cannot be reverted.\n";

        return false;
    }
    */
}
