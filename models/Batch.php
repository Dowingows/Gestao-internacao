<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "batch".
 *
 * @property int $id
 * @property string|null $hash
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Diagnostic[] $diagnostics
 * @property Internment[] $internments
 */
class Batch extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'batch';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['created_at', 'updated_at'], 'safe'],
            [['hash'], 'string', 'max' => 32],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'hash' => 'Hash',
            'created_at' => 'Criado em',
            'updated_at' => 'Atualizado em',
        ];
    }

    /**
     * Gets query for [[Diagnostics]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDiagnostics()
    {
        return $this->hasMany(Diagnostic::class, ['batch_id' => 'id']);
    }

    /**
     * Gets query for [[Internments]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getInternments()
    {
        return $this->hasMany(Internment::class, ['batch_id' => 'id']);
    }
}
