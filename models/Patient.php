<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "patient".
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $card_id_number
 * @property string|null $card_expiration_date
 * @property string|null $card_health_national
 */
class Patient extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'patient';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['card_expiration_date'],'date', 'format' => 'php:Y-m-d', 'message' => '{attribute} não é uma data válida!'],
            [['card_id_number'], 'integer', 'message' => '{attribute} deve ser um número inteiro!'],
            [['name', 'card_id_number', 'card_health_national'], 'string', 'max' => 50, 'message' => '{attribute} deve ter tamanho máximo de 255 caracteres!'],
            [['name', 'card_id_number', 'card_health_national'], 'required', 'message' => 'Campo {attribute} não pode ser vazio!'],
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
            'card_id_number' => 'Número da carteira',
            'card_expiration_date' =>'Validade da Carteira',
            'card_health_national' => 'Cartão Nacional de Saúde',
        ];
    }
}
