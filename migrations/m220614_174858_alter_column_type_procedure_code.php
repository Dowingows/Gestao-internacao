<?php

use yii\db\Migration;

/**
 * Class m220614_174858_alter_column_type_procedure_code
 */
class m220614_174858_alter_column_type_procedure_code extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->alterColumn('{{%procedure}}', 'procedure_code', $this->string());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m220614_174858_alter_column_type_procedure_code cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220614_174858_alter_column_type_procedure_code cannot be reverted.\n";

        return false;
    }
    */
}
