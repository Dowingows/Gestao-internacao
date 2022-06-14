<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%procedure}}`.
 */
class m220614_015306_create_procedure_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%procedure}}', [
            'id' => $this->primaryKey(),
            'table' => $this->string(),
            'procedure_code' => $this->integer(),
            'description' => $this->text(),
            'price' => $this->double(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%procedure}}');
    }
}
