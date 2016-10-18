<?php 
use app\components\NavigationUserWidget;
use app\components\LeftMenuMessageWidget;
?>

<?= NavigationUserWidget::widget(['active' => 'message']) ?>
<div class="wrap cf mt20">
	<?= LeftMenuMessageWidget::widget() ?>
    <div class='message-content'>
    	<ul class="message-container">
			<?php if (count($messages)) { ?>
    			<?php foreach ($messages as $message) { ?>
		    		<li>
		    			<span class="mleft cf">
		    				<a href="javascript:void(0)">
		    					<?php if (isset($message->author->avatar) ) : ?>

		    						<img src="/<?= $message->author->avatar; ?>" class="imageresponsive" alt="<?=$message->author->user_name; ?>">
		    					<?php else: ?>	
		    						<img src="/uploads/users/default-user-avatar.png" class="imageresponsive" alt="No-image">
		    					<?php endif; ?>	
		    					<span class="author"> <?=$message->author->user_name; ?> </span>
		    				</a>
		    			</span>

		    			<div class="mright">
			    			<div class='content'>
			                    <?php foreach (explode("\n", $message->body) as $line) { ?>
			                        <p><?= $line ?></p>
			                    <?php } ?>
			    			</div>
			    			<div class='reply'>
		    					<?php 
			    					if ($message->author->id==\Yii::$app->user->id) {
			    						$receive = $message->userReceive->id;
			    					} else {
			    						$receive = $message->author->id;
			    					}
			    					if (is_null($message->parent_id)) {
			    						$message_id = $message->id;
			    					} else {
			    						$message_id = $message->parent_id;
			    					}
			    					
		    					?>
		    					<a href="/message/send?message_id=<?=$message_id?>&receive=<?=$receive?>">Reply</a>
		    				</div>
			    				
			    			<p class="mt20">
			    				<?= date('F d Y H:i:s', strtotime($message->date)); ?>
			    			</p>
		    			</div>

		    			<!--div class="right">
		    				<div class='subject'>
		    					<?=$message->subject?>
			    			</div>
			    			<div class='header'>
			    				<div class='user'>
			    					<span class='from'>From: <?=$message->author->user_name?></span>
			    					<span class='to'>To: <?=$message->userReceive->user_name?></span>
			    				</div>
			    				<div class='time'>
			    					<?=$message->date?>
			    				</div>
			    				<div class='reply'>
			    					<?php 
				    					if ($message->author->id==\Yii::$app->user->id) {
				    						$receive = $message->userReceive->id;
				    					} else {
				    						$receive = $message->author->id;
				    					}
				    					if (is_null($message->parent_id)) {
				    						$message_id = $message->id;
				    					} else {
				    						$message_id = $message->parent_id;
				    					}
				    					
			    					?>
			    					<a href="/message/send?message_id=<?=$message_id?>&receive=<?=$receive?>">Reply</a>
			    				</div>
			    			</div>
			    			<div class='content'>
		    					<?=$message->body?>
			    			</div>
		    			</div-->
		    			
		    		</li>
	    		<?php } ?>
    		<?php } ?>
    	</ul>
    </div>
</div>