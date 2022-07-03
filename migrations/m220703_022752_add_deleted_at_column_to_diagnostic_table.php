<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%diagnostic}}`.
 */
class m220703_022752_add_deleted_at_column_to_diagnostic_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%diagnostic}}', 'deleted_at', $this->dateTime());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%diagnostic}}', 'deleted_at');
    }
}
