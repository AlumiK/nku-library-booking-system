<?php

use frontend\models\SignupForm;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model SignupForm */

$this->title = '注册';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="site-signup">
    <h1><?= Html::encode($this->title); ?></h1>
    <p>请填写以下信息：</p>
    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>

            <?= $form->field($model, 'student_id')->textInput(['autofocus' => true]); ?>

            <?= $form->field($model, 'username'); ?>

            <?= $form->field($model, 'email')->textInput(['spellcheck' => false]); ?>

            <?= $form->field($model, 'password')->passwordInput(['maxlength' => true]); ?>

            <?= $form->field($model, 'password2')->passwordInput(['maxlength' => true]); ?>

            <div class="form-group">
                <?= Html::submitButton('注册', ['class' => 'btn btn-primary', 'name' => 'signup-button']); ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
