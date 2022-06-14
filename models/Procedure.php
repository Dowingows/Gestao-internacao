<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "procedure".
 *
 * @property int $id
 * @property string|null $table
 * @property int|null $procedure_code
 * @property string|null $description
 * @property float|null $price
 */
class Procedure extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'procedure';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['description', 'price','procedure_code'], 'required', 'message' => 'Campo {attribute} não pode ser vazio!'],
            [['procedure_code'], 'default', 'value' => null],
            [['procedure_code'], 'integer', 'message' => '{attribute} deve ser um número inteiro!'],
            [['procedure_code'], 'string', 'max' => 255, 'message' => '{attribute} deve ter tamanho máximo de 255 caracteres!'],
            [['description'], 'string', 'message' => '{attribute} deve ser um texto!'],
            [['price'], 'number', 'message' => '{attribute} deve ser um número decimal!'],
            [['table'], 'string', 'max' => 255, 'message' => '{attribute} deve ter tamanho máximo de 255!'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'table' => 'Tabela',
            'procedure_code' => 'Código do Procedimento',
            'description' => 'Descrição',
            'price' => 'Preço',
        ];
    }
}
