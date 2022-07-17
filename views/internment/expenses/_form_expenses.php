<?php

use kartik\date\DatePicker;
use yii\helpers\Url;
use kartik\depdrop\DepDrop;
use yii\helpers\Html;

?>
<style>
    .highlight {
        background-color: #E9E9E9;
        padding: 20px;
        border-radius: 5px;
    }
</style>


<style>
    .panel-body .form-group {
        padding: 10px;
    }

    .panel-default>.panel-heading {
        color: #fff;
        background-color: #8D8D8D;
        border-color: #ddd;
        text-transform: uppercase;
    }
</style>
<!--INICIO CODIGO PARA  inserir procedimento-->


<br />


<div class="panel panel-gray-2 ">
    <div class="panel-heading">
        <h3>Cadastrar Nova Despesa </h3>
    </div>
    <div class="panel-body container-items highlight">
        <!-- widgetContainer -->

        <?php
        $expenseId = 0;
        if (!empty($expenseModel->medicine_id)) {
            $expenseId = $expenseModel->medicine_id;
        } else if ($expenseModel->supply_id) {
            $expenseId = $expenseModel->supply_id;
        } else if ($expenseModel->procedure_id) {
            $expenseId = $expenseModel->procedure_id;
        }
        ?>
      
        <?= $form->field($expenseModel, 'internment_id')->hiddenInput(['value'=> $internment->id])->label(false); ?>
        <div class="item panel panel-gray ">
            <!-- widgetBody -->
            <div class="panel-body">
                <div class="row gx-0">
                    <div class="col-1 ">
                        <?php $list = ['2' => '2', '3' => '3', '5' => '5']; ?>
                        <?= $form->field($expenseModel, "cd")->dropDownList($list, ['id' => "cd-id",'prompt'=> '---'] ) ?>
                    </div>
                    <div class="col-3">
                        <?php echo Html::hiddenInput("old-val", $expenseId, ['id' => "old-val"]); ?>
                        <?= $form->field($expenseModel, "despesa_code")->widget(DepDrop::classname(), [
                            'options' => ['id' => "cd-despesa-id"],
                            'type' => DepDrop::TYPE_SELECT2,

                            'pluginOptions' => [
                                'depends' => ["cd-id"],
                                'placeholder' => '-- SELECIONE --',
                                'url' => Url::to(['/internment/expense-list']),
                                'params' => ["old-val"],
                                'loadingText' => 'Carregando...',
                            ]
                        ]); ?>
                    </div>
                    <div class="col-2">
                        <?php $expenseModel->date = empty($expenseModel->date) ? '' : date('d/m/Y', strtotime($expenseModel->date)); ?>
                        <?= $form->field($expenseModel, 'date')->widget(DatePicker::class, [
                            'convertFormat' => true,
                            'pluginOptions' => [
                                'autoclose' => true
                            ]
                        ]); ?>
                    </div>
                    <div class="col-2">
                        <?= $form->field($expenseModel, "start_time")->textInput() ?>
                    </div>
                    <div class="col-2">
                        <?= $form->field($expenseModel, "end_time")->textInput() ?>
                    </div>

                    <div class="col-2">
                        <?= $form->field($expenseModel, "amount")->textInput() ?>
                    </div>

                </div>
            </div>
            <div class="form-group">
                <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
            </div>
        </div>

    </div>

</div>


<!--FIM do CODIGO PARA inserir procedimento-->


<script>
    var cont = ' <?= empty($expenseModel) ? 0 : 10 ?>';

    update_codigo_despesa = function() {
        console.log('update....')
        for (var i = 0; i < cont; i++) {
            $('#cd-' + i + '-id').trigger('change');

        }
    };

    init_codigo_despesa_ = function() {

        for (var i = 0; i < cont; i++) {
            if ($('#cd-0-despesa-id').attr('disabled') == 'disabled') {
                console.log('iniciando....')
                $('#cd-' + i + '-id').trigger('change');
            }
        }
    };


    window.addEventListener('DOMContentLoaded', function() {
        $('#update-despesa').bind('click', function() {
            update_codigo_despesa()
        });


        $(".dynamicform_wrapper").on('afterInsert', function(e, item) {
            $(item).find('select').trigger('change');
            var datePickers = $('html').find('[data-krajee-kvdatepicker]');

            datePickers.each(function(index, el) {
                $(this).parent().removeData().kvDatepicker('remove');
                $(this).parent().kvDatepicker(eval($(this).attr('data-krajee-kvdatepicker')));
            });

            /*date*/
            $('.krajee-datepicker').bind('change', function() {
                var date = $(this).val();
                var id = $(this).attr('id').replace("-data-disp", "");

                var newdate = date.split("-").reverse().join("-");

                $('#' + id + '-data').val(newdate);
            });
        });
    }, true);


    setInterval(init_codigo_despesa_, 500);
</script>