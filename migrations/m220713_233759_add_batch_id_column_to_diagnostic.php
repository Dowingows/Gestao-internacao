<?php

use yii\db\Migration;

/**
 * Class m220713_233759_add_batch_id_column_to_diagnostic
 */
class m220713_233759_add_batch_id_column_to_diagnostic extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%diagnostic}}', 'batch_id', $this->integer());
        $this->addForeignKey('fk-batch-diagnostic_id', 'diagnostic', 'batch_id', 'batch', 'id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-batch-diagnostic_id','diagnostic');
        $this->dropColumn('{{%diagnostic}}', 'batch_id');
        return true;
    }
}
