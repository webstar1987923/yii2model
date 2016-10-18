
<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>


<div class="wrap cf ">
    <div class="user-container">
        <div class="login-container left">          
            <div class="login">
                <h2 class="form-heading">LOGIN FORM</h2>
                <p class="messageSuccess">
                    <?= Yii::$app->session->getFlash('registerSuccessfully'); ?>
                </p>   
                <p class="messageError">
                    <?= Yii::$app->session->getFlash('registerError'); ?>
                </p>   

                <?php $form = ActiveForm::begin([        
                    'options'    =>  [
                        'class' =>  'wp-user-form',      
                    ],
                    'action'=>'/site/login'     
                ]); ?>

                    <div class="username">

                        <?= $form->field($model, 'user_name')->textInput(['maxlength' => 255]) ?>

                    </div>
                    <div class="password">
                        <?= $form->field($model, 'password')->passwordInput(['maxlength' => 255]) ?>
                    </div>      
                    <div class="rememberme">
                        <label for="rememberme">
                        <input type="checkbox" name="rememberMe" checked="checked" id="rememberme" tabindex="13" /> Remember me
                        </label>
                    </div>
                    <div class="login_fields">
                        <input type="submit" name="user-submit" value="Login" tabindex="14" class="user-submit" />
                        <input type="hidden" name="redirect_to" value="http://beetube.me" />
                        <input type="hidden" name="user-cookie" value="1" />
                    </div>
                
                <?php ActiveForm::end(); ?>
                <p class="forget acti3">
                    <a href="#">Forgot your password?</a>
                </p>
            </div>
        </div>
            
        <div class="login-container right">         
            <div class="login">
                <h2 class="form-heading">REGISTER FORM</h2>
                <p>Get Started with a new Account</p>
                
                <!--form method="post" action="/site/register" class="wp-user-form"-->
                <?php $form = ActiveForm::begin([        
                    'options'    =>  [
                        'class' =>  'form-horizontal'
                    ],
                    'action'=>'/site/register'     
                ]); ?>

                    <div class="username">

                        <?= $form->field($user, 'user_name')->textInput(['maxlength' => 255]) ?>

                    </div>
                    <div class="password">
                        <?= $form->field($user, 'email')->textInput(['maxlength' => 255]) ?>
                    </div>
                    <div class="password">
                        <?= $form->field($user, 'password')->passwordInput(['maxlength' => 255]) ?>
                    </div>
                    <div class="password">
                        <?= $form->field($user, 'repeat_password')->passwordInput(['maxlength' => 255]) ?>
                    </div>
                    <div class="password">
                        <div class="form-group field-user-repeat_password">
                            <label class="control-label" for="user-repeat_password"> Country </label>
                            <select name="User[country_id]" class="" id="selectCountry2" style="width:100%; height: 50px;">
                                <option value="">Country</option>
                                <?php 
                                    foreach ($this->params['country_k'] as $key => $country) :
                                        if ($country->country == "United States") :
                                ?>
                                        <option value="<?= $country->id ?>" selected><?= $country->country ?></option>
                                        <?php 
                                            else :
                                        ?>
                                        <option value="<?= $country->id ?>"><?= $country->country ?></option>
                                <?php 
                                        endif;
                                    endforeach;
                                ?>
                            </select>
                        </div>
                        <?= $form->field($user, 'country_id', ['template' => '{error}'])->textInput(); ?>
                    </div>

                    <div class="password">
                        <div class="form-group field-user-repeat_password">
                            <label class="control-label" for="user-repeat_password"> State </label>
                            <select name="User[state_id]" class="" id="selectState2" style="width:100%; height: 50px;">
                                <option value="">State</option>
                                <?= $this->params['state_k']; ?>
                            </select>
                        </div>
                        <?= $form->field($user, 'state_id', ['template' => '{error}'])->textInput(); ?>
                    </div>
                    <div class="login_fields">
                        <input type="submit" name="user-submit" value="Sign up!" class="user-submit" tabindex="103" />
                        <input type="hidden" name="redirect_to" value="" />
                        <input type="hidden" name="user-cookie" value="1" />
                    </div>
                
                <?php ActiveForm::end(); ?>
                
            </div>
        </div>
        <br clear="all" />
            
    </div>
           
    <div class="forgot-container">
        <div class="login-container right">         
            <div class="login">
                <h2 class="form-heading">FORGOT PASSWORD</h2>
                <p>Set Your New Password</p>
                <p class='forgot_message'></p>
                <form method="post" action="/site/forgot" class="wp-user-form">
                    <div class="username">
                        <label for="user_login">Email: </label>
                        <input type="email" name="email" value="" size="20" id="email" tabindex="1001" />
                    </div>
                    <div class="login_fields">
                        <input type="submit" name="user-submit" value="Reset my password" class="user-submit forgot_submit" tabindex="1002" />
                        <input type="hidden" name="redirect_to" value="/user-login/?reset=true" />
                        <input type="hidden" name="user-cookie" value="1" />
                    </div>
                </form><!-- 
                <p class="forget acti3">Visit your email to get New password! </p> -->
            </div>
        </div>
        <br clear="all" />  
    </div>
     <script type="text/javascript">
        var j = jQuery.noConflict();
        j('.forgot-container .login_fields').on('click','.forgot_submit',function(e){
            e.preventDefault();
            var _email = j('.forgot-container #email').val();
            j.ajax({
                method: "POST",
                url: "/site/forgot",
                data: { email: _email },
                success: function (response) {
                    var obj = JSON.parse(response);
                    if (obj.type=='success') {
                        j('.forgot-container .forgot_message').addClass('success');
                        j('.forgot-container .forgot_message').removeClass('error');
                    } else{
                        j('.forgot-container .forgot_message').addClass('error');
                        j('.forgot-container .forgot_message').removeClass('success');
                    };
                    j('.forgot-container .forgot_message').show();
                    j('.forgot-container .forgot_message').html(obj.message);
                }
            })
        });
     </script>
</div>