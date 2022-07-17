<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "expense".
 *
 * @property int $id
 * @property string $cd
 * @property string $date
 * @property string $start_time
 * @property string|null $end_time
 * @property int|null $amount
 * @property float $unit_price
 * @property int $internment_id
 * @property int|null $supply_id
 * @property int|null $medicine_id
 * @property int|null $procedure_id
 *
 * @property Internment $internment
 * @property Medicine $medicine
 * @property Procedure $procedure
 * @property Supply $supply
 */
class Expense extends \yii\db\ActiveRecord
{
    public $despesa_code;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'expense';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['cd', 'date', 'start_time', 'unit_price', 'internment_id'], 'required'],
            [['date', 'start_time', 'end_time'], 'safe'],
            [['amount', 'internment_id', 'supply_id', 'medicine_id', 'procedure_id'], 'default', 'value' => null],
            [['amount', 'internment_id', 'supply_id', 'medicine_id', 'procedure_id'], 'integer'],
            [['unit_price'], 'number'],
            [['cd'], 'string', 'max' => 11],
            [['internment_id'], 'exist', 'skipOnError' => true, 'targetClass' => Internment::class, 'targetAttribute' => ['internment_id' => 'id']],
            [['medicine_id'], 'exist', 'skipOnError' => true, 'targetClass' => Medicine::class, 'targetAttribute' => ['medicine_id' => 'id']],
            [['procedure_id'], 'exist', 'skipOnError' => true, 'targetClass' => Procedure::class, 'targetAttribute' => ['procedure_id' => 'id']],
            [['supply_id'], 'exist', 'skipOnError' => true, 'targetClass' => Supply::class, 'targetAttribute' => ['supply_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'cd' => 'CD',
            'date' => 'Data',
            'start_time' => 'Hora Início',
            'end_time' => 'Hora Fim',
            'amount' => 'Quantidade',
            'unit_price' => 'Preço Unitário',
            'internment_id' => 'Internação',
            'supply_id' => 'Material',
            'medicine_id' => 'Medicamento',
            'procedure_id' => 'Procedimento',
            'despesa_code' => 'Despesa'
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
     * Gets query for [[Medicine]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMedicine()
    {
        return $this->hasOne(Medicine::class, ['id' => 'medicine_id']);
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

    /**
     * Gets query for [[Supply]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSupply()
    {
        return $this->hasOne(Supply::class, ['id' => 'supply_id']);
    }

    public function getItemName(){

        if($this->medicine_id != null){
            return $this->medicine->name;
        }else if($this->supply_id != null){
            return $this->supply->name;
        }else if ($this->procedure_id != null){
            return $this->procedure->description;
        }

        return '-';
    }

    public function getItemPrice(){

        if($this->medicine_id != null){
            return $this->medicine->price;
        }else if($this->supply_id != null){
            return $this->supply->price;
        }else if ($this->procedure_id != null){
            return $this->procedure->description;
        }

        return '-';
    }

    public function getTotalPrice()
    {
        return $this->unit_price * $this->amount;
    }
}
