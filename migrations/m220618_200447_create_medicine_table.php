<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%medicine}}`.
 */
class m220618_200447_create_medicine_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%medicine}}', [
            'id' => $this->primaryKey(),
            'cod_tiss' => $this->string(),
            'um_vr' => $this->string(),
            'und' => $this->string(),
            'description' => $this->text(),
            'cod_tnumm' => $this->string(),
            'cod_brasindice' => $this->string(),
            'cod_tiss_2' => $this->string(),
            'cod_agend' => $this->string(),
            'cod_agend_cob' => $this->string(),
            'price' => $this->double(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%medicine}}');
    }
}
