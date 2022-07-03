<?php

use yii\db\Migration;

/**
 * Class m220702_235622_add_constraint_fk_diagnostic_hospital
 */
class m220702_235622_add_constraint_fk_diagnostic_hospital extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addForeignKey('fk-diagnostic-hospital-id', 'diagnostic', 'contractor_executor_id', 'hospital', 'id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey(
            'fk-diagnostic-hospital-id',
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
        echo "m220702_235622_add_constraint_fk_diagnostic_hospital cannot be reverted.\n";

        return false;
    }
    */
}
