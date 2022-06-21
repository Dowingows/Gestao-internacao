<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%professional}}`.
 */
class m220620_224426_create_professional_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%professional}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(50),
            'council' => $this->string(30),
            'council_number' => $this->string(20),
            'uf' => $this->string(5),
            'cbo_code' => $this->string(25),
            'type' => $this->string(5)
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%professional}}');
    }
}
