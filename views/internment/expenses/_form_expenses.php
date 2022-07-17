<?php
use wbraganca\dynamicform\DynamicFormWidget;
use kartik\date\DatePicker;
use yii\helpers\Url;
use kartik\depdrop\DepDrop;
use yii\helpers\Html;

?>
<style>
    .panel-body .form-group {
        padding: 10px;
    }

    .panel-default > .panel-heading {
        color: #fff;
        background-color: #8D8D8D;
        border-color: #ddd;
        text-transform: uppercase;
    }
</style>
<!--INICIO CODIGO PARA  inserir procedimento-->
<script>
    var despesas_code = [];
</script>
<div class="row">
    <h3><a href="#" onclick="return false;" id="update-despesa" class=" pull-right btn btn-success ">
            <i class="fa fa-refresh"></i> Atualizar </a></h3>
</div>
<br/>
<br/>
<?php
DynamicFormWidget::begin([
    'widgetContainer' => 'dynamicform_wrapper', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
    'widgetBody' => '.container-items', // required: css class selector
    'widgetItem' => '.item', // required: css class
    'limit' => 999, // the maximum times, an element can be cloned (default 999)
    'min' => 1, // 0 or 1 (default 1)
    'insertButton' => '.add-item', // css class
    'deleteButton' => '.remove-item', // css class
    'model' => $expenseModelList[0],
    'formId' => 'dynamic-form',
    'formFields' => [
        'cd',
        'start_time',
        'end_time',
        'amount',
        'despesa_code'
    ],
]);

?>

<div class="panel panel-gray-2">
    <div class="panel-heading">
        <i class="fa fa-file-o"></i> Despesas
        <div class="clearfix"></div>
    </div>
    <div class="panel-body container-items"><!-- widgetContainer -->
        <?php foreach ($expenseModelList as $index => $expenseModel): ?>
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

            <div class="item panel panel-gray "><!-- widgetBody -->
                <div class="panel-body">
                    <div class="row gx-0">
                        <div class="col-1 ">
                            <?php $list = ['2' => '2', '3' => '3', '5' => '5']; ?>
                            <?= $form->field($expenseModel, "[{$index}]cd")->dropDownList($list, ['id' => "cd-{$index}-id"]) ?>
                        </div>
                        <div class="col-2">
                        <?php echo Html::hiddenInput("{$index}-old-val", $expenseId, ['id' => "{$index}-old-val"]); ?>
                        <?= $form->field($expenseModel, "[{$index}]despesa_code")->widget(DepDrop::classname(), [
                                'options' => ['id' => "cd-{$index}-despesa-id"],
                                'type' => DepDrop::TYPE_SELECT2,

                                'pluginOptions' => [
                                    'depends' => ["cd-{$index}-id"],
                                    'placeholder' => '-- SELECIONE --',
                                    'url' => Url::to(['/internment/expense-list']),
                                    'params' => ["{$index}-old-val"],
                                    'loadingText' => 'Carregando...',
                                ]
                            ]); ?>
                        </div>
                        <div class="col-2">
                        <?php $expenseModel->date = date('d/m/Y', strtotime($expenseModel->date)); ?>    
                        <?php $form->field($expenseModel, 'date')->widget(DatePicker::class, [
                                'convertFormat' => true,
                                'pluginOptions' => [
                                    'autoclose' => true
                                ]
                            ]); ?>
                        </div>
                        <div class="col-2">
                            <?= $form->field($expenseModel, "[{$index}]start_time")->textInput() ?>
                        </div>
                        <div class="col-2">
                            <?= $form->field($expenseModel, "[{$index}]end_time")->textInput() ?>
                        </div>

                        <div class="col-2">
                            <?= $form->field($expenseModel, "[{$index}]amount")->textInput() ?>
                        </div>
                        <div class="col-1"  style="align-self: center;">
                            <button type="button" class="pull-right remove-item btn btn-danger "><i class="fa fa-trash"></i></button>
                        </div>
                        
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    <div class="panel-footer" style="min-height: 50px">
        <button type="button" class="pull-right add-item btn btn-success btn-xs"><i
                class="fa fa-plus"></i>
            Adicionar despesa
        </button>
    </div>
</div>
<?php DynamicFormWidget::end(); ?>

<!--FIM do CODIGO PARA inserir procedimento-->


<script>
    var cont = ' <?= empty($expenseModel) ? 0 : 10 ?>';

    update_codigo_despesa = function () {
        console.log('update....')
        for (var i = 0; i < cont; i++) {
            $('#cd-' + i + '-id').trigger('change');

        }
    };

    init_codigo_despesa_ = function () {

        for (var i = 0; i < cont; i++) {
            if ($('#cd-0-despesa-id').attr('disabled') == 'disabled') {
                console.log('iniciando....')
                $('#cd-' + i + '-id').trigger('change');
            }
        }
    };


    window.addEventListener('DOMContentLoaded', function () {
        $('#update-despesa').bind('click', function () {
            update_codigo_despesa()
        });


        $(".dynamicform_wrapper").on('afterInsert', function (e, item) {
            $(item).find('select').trigger('change');
            var datePickers = $('html').find('[data-krajee-kvdatepicker]');

            datePickers.each(function (index, el) {
                $(this).parent().removeData().kvDatepicker('remove');
                $(this).parent().kvDatepicker(eval($(this).attr('data-krajee-kvdatepicker')));
            });

            /*date*/
            $('.krajee-datepicker').bind('change', function () {
                var date = $(this).val();
                var id = $(this).attr('id').replace("-data-disp", "");

                var newdate = date.split("-").reverse().join("-");

                $('#' + id + '-data').val(newdate);
            });
        });
    }, true);


    setInterval(init_codigo_despesa_, 500);
</script>
