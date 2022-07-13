<?php

use yii\db\Migration;
use yii\db\Expression;

/**
 * Handles the creation of table `{{%batch}}`.
 */
class m220713_232946_create_batch_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%batch}}', [
            'id' => $this->primaryKey(),
            'hash' => $this->string(32),
            'created_at' => $this->dateTime()->notNull()->defaultValue(new Expression('NOW()')),
            'updated_at' => $this->dateTime()->notNull()->defaultValue(new Expression('NOW()'))
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%batch}}');
    }
}