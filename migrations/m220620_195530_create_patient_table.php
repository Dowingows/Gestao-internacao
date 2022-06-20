<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%patient}}`.
 */
class m220620_195530_create_patient_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%patient}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
            'card_id_number'=> $this->string(),
            'card_expiration_date' => $this->date(),
            'card_health_national' => $this->string()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%patient}}');
    }
}
