<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "professional".
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $council
 * @property string|null $council_number
 * @property string|null $uf
 * @property string|null $cbo_code
 * @property string|null $type
 */
class Professional extends \yii\db\ActiveRecord
{
    
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'professional';
    }

    public static function  getTypesList()
    {
        $list = [
            'MC' => 'Médico Clínico', 
            'MP' => 'Médico Psiquiatra', 
            'TERA' => 'Médico Psiquiatra', 
            'PSI' => 'Médico Psiquiatra' 
        ];

        return $list;
    }

    public static function getTypeLabel(string $value){
        $enum = Professional::getTypesList();
        return isset($enum[$value])  ? $enum[$value] : 'desconhecido';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name','council', 'uf', 'type'], 'required', 'message' => 'Campo {attribute} não pode ser vazio!'],
            [['name'], 'string', 'max' => 50, 'message' => '{attribute} deve ter tamanho máximo de 50 caracteres!'],
            [['council'], 'string', 'max' => 30, 'message' => '{attribute} deve ter tamanho máximo de 30 caracteres!'],
            [['council_number'], 'string', 'max' => 20, 'message' => '{attribute} deve ter tamanho máximo de 20 caracteres!'],
            [['uf', 'type'], 'string', 'max' => 5, 'message' => '{attribute} deve ter tamanho máximo de 5 caracteres!'],
            [['cbo_code'], 'string', 'max' => 25, 'message' => '{attribute} deve ter tamanho máximo de 25 caracteres!'],
            [['council_number','cbo_code'], 'integer', 'message' => '{attribute} deve ser um número inteiro!'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Nome'),
            'council' => Yii::t('app', 'Conselho'),
            'council_number' => Yii::t('app', 'Número do Conselho'),
            'uf' => Yii::t('app', 'UF'),
            'cbo_code' => Yii::t('app', 'Código CBO'),
            'type' => Yii::t('app', 'Tipo de Profissional'),
        ];
    }
}
