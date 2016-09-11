<?php

use yeesoft\helpers\Html;
use yeesoft\trip\models\Trip;
use yeesoft\widgets\inputs\RadioToggle;
use yii\jui\DatePicker;
use yeesoft\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model yeesoft\trip\models\Trip */
/* @var $form yeesoft\widgets\ActiveForm */

$js = <<<JS
    $('a.btn[data-toggle="radiotab-triptype"]').click(function(){
        var tripType = $(this).find('input[type="radio"]').val();
        if(tripType === '1'){
            $('.field-trip-schedule').hide();
            $('.field-trip-date').show();
        } else {
            $('.field-trip-date').hide();
            $('.field-trip-schedule').show();
        }
    });
JS;

$this->registerJs($js);
?>

<div class="trip-form">

    <?php
    $form = ActiveForm::begin([
        'id' => 'trip-form',
        'validateOnBlur' => false,
    ])
    ?>

    <div class="row">
        <div class="col-md-9">

            <div class="panel panel-default">
                <div class="panel-body">

                    <?= $form->field($model, 'type')->widget(RadioToggle::className(), ['items' => Trip::getTypes()]) ?>

                    <?php
                    $dateOptions = ($model->type == 2) ? ['options' => ['style' => 'display:none']] : [];
                    $scheduleOptions = ($model->type == 1) ? ['options' => ['style' => 'display:none']] : [];
                    ?>
                    
                    <?= $form->field($model, 'date', $dateOptions)->widget(DatePicker::className(), ['dateFormat' => 'yyyy-MM-dd', 'options' => ['class' => 'form-control']]) ?>

                    <?= $form->field($model, 'schedule', $scheduleOptions)->textarea(['rows' => 3]) ?>

                    <?= $form->field($model, 'city_from')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($model, 'city_to')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($model, 'city_between')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($model, 'vehicle')->widget(RadioToggle::className(), ['items' => Trip::getVehicles()]) ?>

                    <?= $form->field($model, 'vehicle_model')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($model, 'contacts')->textarea(['rows' => 2]) ?>

                    <?= $form->field($model, 'details')->textarea(['rows' => 3]) ?>

                </div>

            </div>
        </div>

        <div class="col-md-3">

            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="record-info">

                        <?= $form->field($model, 'price')->input(['maxlength' => true]) ?>

                        <?= $form->field($model, 'luggage')->dropDownList(Trip::getLuggages()) ?>

                        <?= $form->field($model, 'conditioner')->checkbox() ?>

                        <?= $form->field($model, 'wifi')->checkbox() ?>

                        <?= $form->field($model, 'fridge')->checkbox() ?>

                    </div>
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="record-info">
                        <?= $form->field($model, 'status')->dropDownList(Trip::getStatusList()) ?>

                        <?php if (!$model->isNewRecord): ?>

                            <div class="form-group clearfix">
                                <label class="control-label"
                                       style="float: left; padding-right: 5px;"><?= $model->attributeLabels()['id'] ?>
                                    : </label>
                                <span><?= $model->id ?></span>
                            </div>

                            <div class="form-group clearfix">
                                <label class="control-label" style="float: left; padding-right: 5px;">
                                    <?= $model->attributeLabels()['created_at'] ?> :
                                </label>
                                <span><?= $model->createdDatetime ?></span>
                            </div>

                            <div class="form-group clearfix">
                                <label class="control-label" style="float: left; padding-right: 5px;">
                                    <?= $model->attributeLabels()['updated_at'] ?> :
                                </label>
                                <span><?= $model->updatedDatetime ?></span>
                            </div>

                            <div class="form-group clearfix">
                                <label class="control-label" style="float: left; padding-right: 5px;">
                                    <?= $model->attributeLabels()['updated_by'] ?> :
                                </label>
                                <span><?= $model->updatedBy->username ?></span>
                            </div>

                        <?php endif; ?>

                        <div class="form-group">
                            <?php if ($model->isNewRecord): ?>
                                <?= Html::submitButton(Yii::t('yee', 'Create'), ['class' => 'btn btn-primary']) ?>
                                <?= Html::a(Yii::t('yee', 'Cancel'), ['/trip/default/index'], ['class' => 'btn btn-default']) ?>
                            <?php else: ?>
                                <?= Html::submitButton(Yii::t('yee', 'Save'), ['class' => 'btn btn-primary']) ?>
                                <?=
                                Html::a(Yii::t('yee', 'Delete'), ['/trip/default/delete', 'id' => $model->id], [
                                    'class' => 'btn btn-default',
                                    'data' => [
                                        'confirm' => Yii::t('yii', 'Are you sure you want to delete this item?'),
                                        'method' => 'post',
                                    ],
                                ])
                                ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
