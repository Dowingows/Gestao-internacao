<?php

use yii\db\Migration;

/**
 * Class m220702_231345_add_constraint_fk_diagnostic_professional_requesting
 */
class m220702_231345_add_constraint_fk_diagnostic_professional_requesting extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addForeignKey('fk-diagnostic-professiona_requesting-id', 'diagnostic', 'professional_id', 'professional', 'id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey(
            'fk-diagnostic-professiona_requesting-id',
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
        echo "m220702_231345_add_constraint_fk_diagnostic_professional_requesting cannot be reverted.\n";

        return false;
    }
    */
}
