<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%internment_procedure}}`.
 */
class m220703_164911_create_internment_procedure_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%internment_procedure}}', [
            'id' => $this->primaryKey(),
            'internment_id' => $this->integer()->notNull(),
            'procedure_id' => $this->integer()->notNull(),
            'quantity_authorized' => $this->integer()->notNull(),
            'quantity_requested' => $this->integer()->notNull(),
            'procedure_price' => $this->double()->notNull(),
            'is_accountable' => $this->tinyInteger()->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%internment_procedure}}');
    }
}
