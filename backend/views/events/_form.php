<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\datepicker\DatePicker;

/* @var $this yii\web\View */
/* @var $model backend\models\Events */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="events-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'event_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'event_description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'venue')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'event_date')->textInput()->widget(
                    DatePicker::className(), [
                        'inline'=>false,
                        'clientOptions'=>[
                            'autoclose'=>true,
                            'format'=>'dd-mm-yyyy'
                        ]
                    ]

                    ) ?>

    <?= $form->field($model, 'registration_date')->textInput() ->widget(
                    DatePicker::className(), [
                        'inline'=>false,
                        'clientOptions'=>[
                            'autoclose'=>true,
                            'format'=>'dd-mm-yyyy'
                        ]
                    ]

                ) ?>

    <?= $form->field($model, 'registration_index')->dropDownList([ 'not_registered' => 'Not registered', 'registered' => 'Registered', 'approved' => 'Approved', 'not_approved' => 'Not approved', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'cordinator_id')->textInput() ?>

    <?= $form->field($model, 'event_image')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
