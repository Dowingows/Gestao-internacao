<?php

use yii\db\Migration;

/**
 * Class m220703_014648_add_constraint_fk_diagnostic_hospital_c_applicant_id
 */
class m220703_014648_add_constraint_fk_diagnostic_hospital_c_applicant_id extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addForeignKey('fk-diagnostic-hospital-aplicant-id', 'diagnostic', 'contractor_applicant_id', 'hospital', 'id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey(
            'fk-diagnostic-hospital-aplicant-id',
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
        echo "m220703_014648_add_constraint_fk_diagnostic_hospital_c_applicant_id cannot be reverted.\n";

        return false;
    }
    */
}
