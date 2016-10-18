<?php

use yii\helpers\Html;
use app\components\NavigationUserWidget;
use app\components\VideoListWidget;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Contact */
$this->title = 'Create Contact';
$this->params['breadcrumbs'][] = ['label' => 'Contacts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="contact-create user-container">
    <div class="login-container">      
    	<div class="login">
            <h2 class="form-heading">Contact Us</h2>
            <p class="messageSuccess">
                <?= Yii::$app->session->getFlash('registerSuccessfully'); ?>
            </p>   
            <p class="messageError">
                <?= Yii::$app->session->getFlash('registerError'); ?>
            </p> 
            <?php $form = ActiveForm::begin(); ?>

            <?= $form->field($model, 'full_name')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'subject')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'message')->textarea(['rows' => 6]) ?>

            <div class="form-group">
                <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
