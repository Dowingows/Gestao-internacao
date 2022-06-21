<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "supply".
 *
 * @property int $id
 * @property string|null $cod_simpro
 * @property string|null $un_vr
 * @property string|null $und
 * @property string|null $description
 * @property string|null $cod_tnumm
 * @property string|null $cod_padrao
 * @property string|null $cod_agend
 * @property string|null $cod_agend_cob
 * @property string|null $nature
 * @property float|null $price
 */
class Supply extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'supply';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['cod_simpro', 'un_vr', 'und', 'description', 'price'], 'required', 'message' => 'Campo {attribute} não pode ser vazio!'],
            [['description'], 'string'],
            [['price'], 'number', 'message' => '{attribute} deve ser um número decimal!'],
            [['cod_simpro', 'cod_tnumm', 'cod_padrao', 'cod_agend', 'cod_agend_cob'], 'string', 'max' => 25, 'message' => '{attribute} deve ter tamanho máximo de 25 caracteres!'],
            [['un_vr', 'und'], 'string', 'max' => 10, 'message' => '{attribute} deve ter tamanho máximo de 10 caracteres!'],
            [['nature'], 'string', 'max' => 50, 'message' => '{attribute} deve ter tamanho máximo de 50 caracteres!'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'cod_simpro' => 'Cod Simpro',
            'un_vr' => 'Un Vr',
            'und' => 'Und',
            'description' => 'Descrição',
            'cod_tnumm' => 'Cod Tnumm',
            'cod_padrao' => 'Cod Padrao',
            'cod_agend' => 'Cod Agend',
            'cod_agend_cob' => 'Cod Agend Cob',
            'nature' => 'Natureza do Material',
            'price' => 'Preço',
        ];
    }
}
