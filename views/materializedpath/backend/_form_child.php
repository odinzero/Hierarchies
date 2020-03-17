<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\mp_Models\MpTree */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="mp-tree-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($newModel, 'name')->textInput(['maxlength' => true, 'value'=> "" ]) ?>

    <?= $form->field($newModel, 'path')->textInput(['maxlength' => true, 'value'=> $path, 'readonly'=>true]) ?>

    <?= $form->field($newModel, 'level')->textInput(['maxlength' => true, 'value'=> $level, 'readonly'=>true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
