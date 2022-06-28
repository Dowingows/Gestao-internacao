<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "operator".
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $ans_code
 * @property string|null $logo
 */
class Operator extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'operator';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name','ans_code'], 'required', 'message' => 'Campo {attribute} não pode ser vazio!'],
            [['logo'], 'string'],
            [['name', 'ans_code'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Nome',
            'ans_code' => 'Registro ANS',
            'logo' => 'Logo',
        ];
    }
}
