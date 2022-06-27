<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%diagnostic}}`.
 */
class m220627_011247_add_password_column_to_diagnostic_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%diagnostic}}', 'password', $this->string(50));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%diagnostic}}', 'password');
    }
}
