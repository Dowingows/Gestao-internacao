<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%expense}}`.
 */
class m220716_213350_create_expense_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%expense}}', [
            'id' => $this->primaryKey(),
            'cd' => $this->string(11)->notNull(), 
            'date' => $this->date()->notNull(),
            'start_time' => $this->time()->notNull(), 
            'end_time' => $this->time(), 
            'amount' => $this->integer(), 
            'unit_price' => $this->double()->notNull(), 
            'internment_id' => $this->integer()->notNull(), 
            'supply_id' => $this->integer(), 
            'medicine_id' => $this->integer(), 
            'procedure_id' => $this->integer() 
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%expense}}');
    }
}
