<?php

use app\models\Expense;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\utils\Formatter;

/* @var $this yii\web\View */
/* @var $model app\models\Despesa */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="despesa-form">

    <?php $form = ActiveForm::begin(['id' => 'dynamic-form']); ?>

    <?= $form->field($internment, 'id')->hiddenInput()->label(false); ?>
    <div class="form-group">
        <div class="table-responsive">
            <table class="table table-striped">
                <tbody>
                    <tr>
                        <td><b>Operadora</b></td>
                        <td><?= $internment->operator->name; ?></td>
                        <td><b>Executante</b></td>
                        <td><?= $internment->hospitalAuthorized->name; ?></td>
                    </tr>
                    
                </tbody>
            </table>
        </div>
        <div class="row">
            <div class="col">
                <?= $this->render('_form_expenses', [
                    'model' => $model,
                    'internment' => $internment,
                    'expenseModel' => new Expense(),
                    'form' => $form
                ]) ?>
            </div>

        </div>
        
        <br/>
        <h3>Lista de Despesas Cadastradas </h3>
        <h4>
            Total: <?= !empty($expenseModel) ? Formatter::money(array_reduce($expenseModel, function ($carry, $item) {
                        $carry += $item->totalPrice;
                        return $carry;
                    })) : Formatter::money(0) ?>
        </h4>
        <div class="row">
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead>
                        <th> Item </th>
                        <th>Data</th>
                        <th>Hora inicial</th>
                        <th>Hora final</th>
                        <th>Quantidade</th>
                        <th>Preço Unitário</th>
                        <th>Preço Total</th>
                        <th>#</th>
                    </thead>
                    <tbody>
                        <?php if (!empty($expenseModel)) : ?>
                            <?php foreach ($expenseModel as $row) : ?>
                                <tr>
                                    <td><?= $row->itemName; ?></td>
                                    <td><?= Formatter::date($row->date); ?></td>
                                    <td><?= $row->start_time; ?></td>
                                    <td><?= $row->end_time; ?></td>
                                    <td><?= $row->amount; ?></td>
                                    <td><?= Formatter::money($row->unit_price); ?></td>
                                    <td><?= Formatter::money($row->totalPrice); ?></td>
                                    <td class="text-danger">
                                        
                                        <?= Html::a('<i class="fa fa-trash"></i>', ['delete-expense', 'id' => $row->id], [
                                            'class' => 'text-danger',
                                        ]) ?>
                                    </td>
                                </tr>
                            <?php endforeach ?>
                        <?php else : ?>
                            <td colspan="9" class="text-center "><b>Sem registros</b></td>
                        <?php endif; ?>

                    </tbody>
                </table>
            </div>
        </div>
        <?php ActiveForm::end(); ?>
    </div>