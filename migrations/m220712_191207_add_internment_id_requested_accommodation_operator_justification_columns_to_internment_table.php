<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%internment}}`.
 */
class m220712_191207_add_internment_id_requested_accommodation_operator_justification_columns_to_internment_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%internment}}', 'internment_id', $this->integer());
        $this->addColumn('{{%internment}}', 'requested_accommodation_type', $this->text());
        $this->addColumn('{{%internment}}', 'operator_justification', $this->text());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%internment}}', 'internment_id');
        $this->dropColumn('{{%internment}}', 'requested_accommodation_type');
        $this->dropColumn('{{%internment}}', 'operator_justification');
    }
}
