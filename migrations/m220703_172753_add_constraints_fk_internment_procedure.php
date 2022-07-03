<?php

use yii\db\Migration;

/**
 * Class m220703_172753_add_constraints_fk_internment_procedure
 */
class m220703_172753_add_constraints_fk_internment_procedure extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addForeignKey('fk-internment-procedure_procedure-id', 'internment_procedure', 'procedure_id', 'procedure', 'id');
        $this->addForeignKey('fk-internment-procedure_internment-id', 'internment_procedure', 'internment_id', 'internment', 'id', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-internment-procedure_procedure-id','internment');
        $this->dropForeignKey('fk-internment-procedure_internment-id','internment');

        return true;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220703_172753_add_constraints_fk_internment_procedure cannot be reverted.\n";

        return false;
    }
    */
}
