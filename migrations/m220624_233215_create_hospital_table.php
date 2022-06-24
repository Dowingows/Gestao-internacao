<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%hospital}}`.
 */
class m220624_233215_create_hospital_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%hospital}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(50),
            'trade_name' => $this->string(50),
            'cnpj' => $this->string(15),
            'logo_base64' => $this->text()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%hospital}}');
    }
}
