<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "medicine".
 *
 * @property int $id
 * @property string|null $cod_tiss
 * @property string|null $um_vr
 * @property string|null $und
 * @property string|null $description
 * @property string|null $cod_tnumm
 * @property string|null $cod_brasindice
 * @property string|null $cod_tiss_2
 * @property string|null $cod_agend
 * @property string|null $cod_agend_cob
 * @property float|null $price
 */
class Medicine extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'medicine';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['description'], 'string'],
            [['price'], 'number', 'message' => '{attribute} deve ser um número decimal!'],
            [['cod_tiss', 'cod_tnumm', 'cod_tiss_2', 'cod_agend', 'cod_agend_cob'], 'integer', 'message' => '{attribute} deve ser um número inteiro!'],
            [['cod_tiss', 'um_vr', 'und', 'cod_tnumm', 'cod_brasindice', 'cod_tiss_2', 'cod_agend', 'cod_agend_cob'], 'string', 'max' => 50, 'message' => '{attribute} deve ter tamanho máximo de 255 caracteres!'],
            [['cod_tiss', 'um_vr', 'und', 'description', 'cod_brasindice', 'cod_tiss_2', 'price'], 'required', 'message' => 'Campo {attribute} não pode ser vazio!'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'cod_tiss' => 'Cod Tiss',
            'um_vr' => 'Um Vr',
            'und' => 'Und',
            'description' => 'Descrição',
            'cod_tnumm' => 'Cod Tnumm',
            'cod_brasindice' => 'Cod Brasindice',
            'cod_tiss_2' => 'Cod Tiss  2',
            'cod_agend' => 'Cod Agend',
            'cod_agend_cob' => 'Cod Agend Cob',
            'price' => 'Preço'
        ];
    }
}
