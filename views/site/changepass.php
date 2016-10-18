
<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>

<div class="wrap cf ">
    <div class="forgot-container displayblock">
        <div class="login-container right">         
            <div class="login">
                <h2 class="form-heading">FORGOT PASSWORD</h2>
                <p>Set Your New Password</p>
                <p class='forgot_message'></p>
                <?php $form = ActiveForm::begin([        
                    'options'    =>  [
                        'class' =>  'wp-user-form',      
                    ]   
                ]); ?>
                    <div class="username">

                        <?= $form->field($model, 'password')->passwordInput(['maxlength' => 255]) ?>

                    </div>
                    <div class="username">

                        <?= $form->field($model, 'repassword')->passwordInput(['maxlength' => 255]) ?>

                    </div>
                    <div class="login_fields">
                        <input type="submit" name="user-submit" value="Reset my password" class="user-submit forgot_submit" tabindex="1002" />
                    </div>
                </form><!-- 
                <p class="forget acti3">Visit your email to get New password! </p> -->
            </div>
        </div>
        <br clear="all" />  
    </div>
</div>