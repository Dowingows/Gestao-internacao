<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%diagnostic_procedure}}`.
 */
class m220627_234602_create_diagnostic_procedure_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%diagnostic_procedure}}', [
            'id' => $this->primaryKey(),
            'diagnostic_id' => $this->integer()->notNull(),
            'procedure_id' => $this->integer()->notNull(),
            'quantity_authorized' => $this->integer()->notNull(),
            'quantity_requested' => $this->integer()->notNull(),
            'procedure_price' => $this->double()->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%diagnostic_procedure}}');
    }
}
