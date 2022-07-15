<?php

use yii\db\Migration;

/**
 * Class m220713_233357_add_batch_id_column_to_internment
 */
class m220713_233357_add_batch_id_column_to_internment extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%internment}}', 'batch_id', $this->integer());
        $this->addForeignKey('fk-batch-internment_id', 'internment', 'batch_id', 'batch', 'id', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-batch-internment_id','internment');
        $this->dropColumn('{{%internment}}', 'batch_id');
        return true;
    }
}
