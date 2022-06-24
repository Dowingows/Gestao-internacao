<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "hospital".
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $trade_name
 * @property string|null $cnpj
 * @property string|null $logo_base64
 */
class Hospital extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'hospital';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'cnpj'], 'required', 'message' => 'Campo {attribute} não pode ser vazio!'],
            [['logo_base64'], 'string'],
            [['name', 'trade_name'], 'string', 'max' => 50],
            [['cnpj'], 'string', 'max' => 15],
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
            'trade_name' => 'Nome Fantasia',
            'cnpj' => 'CNPJ',
            'logo_base64' => 'Logo',
        ];
    }
}
