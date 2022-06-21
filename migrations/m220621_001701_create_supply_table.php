<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%supply}}`.
 */
class m220621_001701_create_supply_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%supply}}', [
            'id' => $this->primaryKey(),
            'cod_simpro' => $this->string(25),
            'un_vr' => $this->string(10),
            'und' => $this->string(10),
            'description' => $this->text(),
            'cod_tnumm' => $this->string(25),
            'cod_padrao' => $this->string(25),
            'cod_agend' => $this->string(25),
            'cod_agend_cob' => $this->string(25),
            'nature' => $this->string(50),
            'price' => $this->double(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%supply}}');
    }
}
