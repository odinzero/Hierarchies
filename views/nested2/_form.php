<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\NestedCategory */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="nested-category-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'lft')->textInput(['value' => $id + 1, 'disabled' => true]) ?>

    <?= $form->field($model, 'rgt')->textInput(['value' => $id + 2, 'disabled' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
