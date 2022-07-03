<?php

use yii\db\Migration;

/**
 * Class m220702_233551_add_constraint_fk_diagnostic_procedure_procedure
 */
class m220702_233551_add_constraint_fk_diagnostic_procedure_procedure extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addForeignKey('fk-diagnostic-procedure_procedure-id', 'diagnostic_procedure', 'procedure_id', 'procedure', 'id');
        $this->addForeignKey('fk-diagnostic-procedure_diagnostic-id', 'diagnostic_procedure', 'diagnostic_id', 'diagnostic', 'id', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey(
            'fk-diagnostic-procedure_procedure-id',
            'diagnostic_procedure'
        );
        $this->dropForeignKey(
            'fk-diagnostic-procedure_diagnostic-id',
            'diagnostic_procedure'
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
        echo "m220702_233551_add_constraint_fk_diagnostic_procedure_procedure cannot be reverted.\n";

        return false;
    }
    */
}
