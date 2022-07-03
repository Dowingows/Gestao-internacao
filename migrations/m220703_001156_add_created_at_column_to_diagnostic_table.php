<?php

use yii\db\Expression;
use yii\db\Migration;

/**
 * Handles adding columns to table `{{%diagnostic}}`.
 */
class m220703_001156_add_created_at_column_to_diagnostic_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%diagnostic}}', 'created_at', $this->dateTime()->notNull()->defaultValue(new Expression('NOW()')));
        $this->addColumn('{{%diagnostic}}', 'updated_at', $this->dateTime()->notNull()->defaultValue(new Expression('NOW()')));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%diagnostic}}', 'created_at');
        $this->dropColumn('{{%diagnostic}}', 'updated_at');
    }
}
