<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
$this->title = 'Signup';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-signup">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Please fill out the following fields to signup:</p>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>

                <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

                <?= $form->field($model, 'student_name') ?>

                <?= $form->field($model, 'guardian_name') ?>

                <?= $form->field($model, 'email') ?>

                <?= $form->field($model, 'password')->passwordInput() ?>

                <?= $form->field($model, 'gender')->radioList( [ 0 => 'Male', 1 => 'Female'] ) ?>

                <?= $form->field($model, 'date_of_birth') ?>

                <?= $form->field($model, 'address')->textarea(['rows' => '6']) ?>

                <?= $form->field($model, 'street') ?>

                <?= $form->field($model, 'city') ?>

                <?= $form->field($model, 'district') ?>

                <?= $form->field($model, 'state') ?>

                <?= $form->field($model, 'pin_code') ?>

                <?= $form->field($model, 'mobile') ?>

                <?= $form->field($model, 'blood_group') ?>

                <?= $form->field($model, 'aadhar_number') ?>                

                <div class="form-group">
                    <?= Html::submitButton('Signup', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
