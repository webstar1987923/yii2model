<?php 
    use yii\helpers\Html;
    use yii\widgets\ActiveForm;
    use app\components\NavigationUserWidget;
?>

<?= NavigationUserWidget::widget(['active' => 'profile']) ?>

<div class="wrap cf ">
    <div class="login-container profile-container">  
        <div class="login">
            <h2 class="form-heading">PROFILE</h2>
             <p class="messageSuccess">
                <?= Yii::$app->session->getFlash('updateUserSuccess'); ?>
            </p> 
            <?php $form = ActiveForm::begin([        
                'options'    =>  [
                    'class' =>  'wp-user-form',     
                    'enctype' => 'multipart/form-data'    
                ],
                'action'=>'/user/profile'     
            ]); ?>

                <div class="form-group chance-image">
                    <?php if($user->avatar): ?>
                        <img id="image" src="/<?= $user->avatar; ?>">
                    <?php else: ?>

                        <img id="image" src="/fassets/images/Hydrangeas.jpg">
                    <?php endif; ?>
                    <?= $form->field($user, 'avatar', ['template' => '{input}{error}'])->fileInput(['id' => 'upload', 'class' => 'visibility', 'accept' => 'image/*']) ?>
                    <!--input accept="image/*" type="file" id="upload" name="upload" style="visibility: hidden; width: 1px; height: 1px" / -->
                    <a href="" onclick="changePicture(); return false">Change Picture</a>
                </div>
                <div class="form-group">
                    <?= $form->field($user, 'user_name')->textInput(['maxlength' => 255]) ?>
                </div>
                <div class="form-group">
                    <?= $form->field($user, 'email')->textInput(['maxlength' => 255]) ?>
                </div>

                <div class="password">
                    <?= $form->field($user, 'password')->passwordInput(['maxlength' => 255, 'value' => '']) ?>
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
                                        if ($country->id == $user->country_id) :
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
                        </select>
                    </div>
                    <?= $form->field($user, 'state_id', ['template' => '{error}'])->textInput(); ?>
                </div>

                <div class="login_fields">
                    <input type="submit" name="user-submit" value="Update" tabindex="14" class="user-submit" />
                </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
<script>
    function changePicture() {
    //open the open file dialog
        document.getElementById('upload').click();
        document.getElementById('upload').onchange = function() {
            var file = this.files[0];
            var url = window.URL.createObjectURL(file);
            document.getElementById('image').src = url;
        };
    }
</script>     
<script>
    var j = jQuery.noConflict();
    j(document).ready(function(){
        var country_id = <?= json_encode($user->country_id); ?> ;
        var state_id = <?= json_encode($user->state_id); ?> ;
        
        getStateList('#selectState2', country_id, state_id);

        function getStateList(container, country_id, state_id ) {
            j.ajax({
                url: "/country/state", 
                type: "html",
                method : "GET",
                data : {
                    country_id : country_id,
                    state_id : state_id
                },
                success: function(result) {
                    j(container).html(result);
                }
            });
        }
    });
</script>     
