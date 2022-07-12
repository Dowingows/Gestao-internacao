<?php

use yii\db\Migration;

/**
 * Class m220712_205607_add_constraints_fk_internment_id
 */
class m220712_205607_add_constraints_fk_internment_id extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addForeignKey('fk-internment-internment_id', 'internment', 'internment_id', 'internment', 'id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-internment-internment_id','internment');
        return true;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220712_205607_add_constraints_fk_internment_id cannot be reverted.\n";

        return false;
    }
    */
}
