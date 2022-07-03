<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "internment_procedure".
 *
 * @property int $id
 * @property int $internment_id
 * @property int $procedure_id
 * @property int $quantity_authorized
 * @property int $quantity_requested
 * @property float $procedure_price
 * @property int $is_accountable
 *
 * @property Internment $internment
 * @property Procedure $procedure
 */
class InternmentProcedure extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'internment_procedure';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['internment_id', 'procedure_id', 'quantity_authorized', 'quantity_requested', 'procedure_price', 'is_accountable'], 'required'],
            [['internment_id', 'procedure_id', 'quantity_authorized', 'quantity_requested', 'is_accountable'], 'default', 'value' => null],
            [['internment_id', 'procedure_id', 'quantity_authorized', 'quantity_requested', 'is_accountable'], 'integer'],
            [['procedure_price'], 'number'],
            [['internment_id'], 'exist', 'skipOnError' => true, 'targetClass' => Internment::className(), 'targetAttribute' => ['internment_id' => 'id']],
            [['procedure_id'], 'exist', 'skipOnError' => true, 'targetClass' => Procedure::className(), 'targetAttribute' => ['procedure_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'internment_id' => 'Internação',
            'procedure_id' => 'Procedimento',
            'quantity_authorized' => 'Quantidade Autorizada',
            'quantity_requested' => 'Quantidade Solicitada',
            'procedure_price' => 'Valor',
            'is_accountable' => 'Contabilizar',
        ];
    }

    /**
     * Gets query for [[Internment]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getInternment()
    {
        return $this->hasOne(Internment::class, ['id' => 'internment_id']);
    }

    /**
     * Gets query for [[Procedure]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProcedure()
    {
        return $this->hasOne(Procedure::class, ['id' => 'procedure_id']);
    }
}
