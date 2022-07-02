<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "diagnostic_procedure".
 *
 * @property int $id
 * @property int $diagnostic_id
 * @property int $procedure_id
 * @property int $quantity_authorized
 * @property int $quantity_requested
 * @property float $procedure_price
 */
class DiagnosticProcedure extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'diagnostic_procedure';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['diagnostic_id', 'procedure_id', 'quantity_authorized', 'quantity_requested', 'procedure_price'], 'required'],
            [['diagnostic_id', 'procedure_id', 'quantity_authorized', 'quantity_requested'], 'default', 'value' => null],
            [['diagnostic_id', 'procedure_id', 'quantity_authorized', 'quantity_requested'], 'integer'],
            [['procedure_price'], 'number'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'diagnostic_id' => 'Diagnóstico',
            'procedure_id' => 'Procedimento',
            'quantity_authorized' => 'Quantidade Autorizada',
            'quantity_requested' => 'Quantidade Solicitada',
            'procedure_price' => 'Preço',
        ];
    }

    public function beforeSave($insert)
    {
        if(!empty($this->procedure_id)){
            $this->procedure_price = Procedure::findOne($this->procedure_id)->price;
        }
        return parent::beforeSave($insert);
    }

}
