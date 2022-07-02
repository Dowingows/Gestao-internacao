<?php

use yii\db\Migration;

/**
 * Class m220702_224549_add_constraint_fk_diagnostic_operator
 */
class m220702_224549_add_constraint_fk_diagnostic_operator extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addForeignKey('fk-diagnostic-operator-id', 'diagnostic', 'operator_id', 'operator', 'id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey(
            'fk-diagnostic-operator-id',
            'diagnostic'
        );

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220702_224549_add_constraint_fk_diagnostic_operator cannot be reverted.\n";

        return false;
    }
    */
}
