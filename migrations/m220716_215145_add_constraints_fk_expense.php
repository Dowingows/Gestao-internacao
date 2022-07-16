<?php

use yii\db\Migration;

/**
 * Class m220716_215145_add_constraints_fk_expense
 */
class m220716_215145_add_constraints_fk_expense extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addForeignKey('fk-expense-internment_id', 'expense', 'internment_id', 'internment', 'id');
        $this->addForeignKey('fk-expense-supply_id', 'expense', 'supply_id', 'supply', 'id');
        $this->addForeignKey('fk-expense-medicine_id', 'expense', 'medicine_id', 'medicine', 'id');
        $this->addForeignKey('fk-expense-procedure_id', 'expense', 'procedure_id', 'procedure', 'id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-expense-internment_id','expense');
        $this->dropForeignKey('fk-expense-supply_id','expense');
        $this->dropForeignKey('fk-expense-medicine_id','expense');
        $this->dropForeignKey('fk-expense-procedure_id','expense');
        
        
        return true;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220716_215145_add_constraints_fk_expense cannot be reverted.\n";

        return false;
    }
    */
}
