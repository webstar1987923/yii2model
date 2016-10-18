<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Flag */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="flag-form">
     <p class="messageSuccess">
        <?= Yii::$app->session->getFlash('flagSuccessfully'); ?>
    </p>   
    
    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'full_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ulr_video')->textInput(['disabled' => true, 'maxlength' => true, 'value' => Yii::$app->request->referrer]) ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'comment')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'contact')
        ->radioList(
            [1 => 'Yes', 0 => 'No'],
            [
                'item' => function($index, $label, $name, $checked, $value) {

                    $return = '<label class="modal-radio">';
                    $return .= '<input type="radio" name="' . $name . '" value="' . $value . '" tabindex="3">';
                    $return .= '<i></i>';
                    $return .= '<span>' . ucwords($label) . '</span>';
                    $return .= '</label>';

                    return $return;
                }
            ]
        )
    ->label('Contact me');
    ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
