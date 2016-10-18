<?php 
use app\components\NavigationUserWidget;
use app\components\LeftMenuMessageWidget;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>

<?= NavigationUserWidget::widget(['active' => 'message']) ?>
<div class="wrap cf mt20">
	<?= LeftMenuMessageWidget::widget(['active' => 'send']) ?>
    <div class='message-content'>
        <?php 
            if (is_null($subject)&&is_null($user_name)) {
                $form = ActiveForm::begin([  
                    'action'=>'/message/send',     
                    'method'=>'POST'     
                ]); 
            } else {
                $form = ActiveForm::begin([  
                    'action'=>'/message/send?message_id='.$message_id.'&receive='.$receive,     
                    'method'=>'POST'     
                ]); 
            }
        ?>
            <div class="subject">
                <?php if (is_null($subject)) { ?>
                    <?= $form->field($message, 'subject')->textInput(['maxlength' => 255, 'class' => 'full-width']) ?>
                <?php } else { ?>
                    <div class="form-group field-subject required">
                        <label class="control-label full-width" for="header-to_id">Subject</label>
                        <input type="text" id="subject" class="form-control full-width" name="Message[subject]" maxlength="255" value="<?=$subject?>" readonly>
                    </div>
                <?php } ?>
            </div>
            <div class="user_receive">
            	<div class="form-group field-user_receive required">
					<label class="control-label" for="header-to_id">To user</label>
                    <?php if (is_null($user_name)) { ?>
    					<input type="text" id="user_receive" class="form-control full-width" name="user_receive" maxlength="255" placeholder="username">
                        <div class="help-block" style="clear:both"></div>
                    <?php } else { ?>
                        <input type="text" id="user_receive" class="form-control full-width" name="user_receive" maxlength="255" value="<?=$user_name?>" readonly>
                    <?php } ?>
				</div>
            </div> 
            <div class="content">
                <?= $form->field($message, 'body')->textArea(['rows' => '6', 'class' => 'full-width', 'placeholder'=>'content']) ?>
            </div>
            <div class="send_fields">
                <div class="form-group field-user_receive required">
                    <?php if (is_null($user_name)) { ?>
                        <input type="submit" name="send" value="Send" tabindex="14" disabled />
                    <?php } else { ?>
                        <input type="submit" name="send" value="Send" tabindex="14" />
                    <?php } ?>
                </div>
            </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>
<script type="text/javascript">
    var j = jQuery.noConflict();
    j(document).ready(function(){
        j("#user_receive").on('change',function(){
            _username = j(this).val();
            j.ajax({
                url: '/message/check-user-receive',
                method: 'POST',
                data:{
                    user_name: _username
                },
                success: function(response){
                    if (response.found) {
                        j('.user_receive').append( "<input type='hidden' name='user_receive_id' value='"+response.user_receive_id+"' />" );
                        j('.user_receive .help-block').empty();
                        j('.send_fields input[type=submit]').prop("disabled", false);
                    } else{
                        j('.user_receive input[name=user_receive_id]').remove();
                        j('.user_receive .help-block').text(response.error);
                        j('.send_fields input[type=submit]').prop("disabled", true);
                    };
                }
            });
        });
    });
</script>