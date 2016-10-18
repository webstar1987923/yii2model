<?php 
use app\components\NavigationUserWidget;
use app\components\LeftMenuMessageWidget;
?>

<?= NavigationUserWidget::widget(['active' => 'message']) ?>
<div class="wrap cf mt20">
	<?= LeftMenuMessageWidget::widget(['active' => 'inbox']) ?>
    <div class='message-content'>
    	<table>
    		<thead>
    			<th>From user</th>
    			<th>Subject</th>
    			<th>Time</th>
    			<th>Action</th>
    		</thead>
    		<tbody>
    			<?php if (count($userMessages)) { ?>
	    			<?php foreach ($userMessages as $userMessage) { ?>
			    		<tr class="<?= ($userMessage->read)? 'read': 'unread';?>">
			    			<td><?php 
				    				echo $userMessage->author->user_name; 
				    				if (count($userMessage->messages)) {
				    					echo "(".count($userMessage->messages).")";
				    				}
					    		?>
			    			</td>
			    			<td><?= $userMessage->lastMessageIn->subject ?></td>
			    			<td><?= $userMessage->update_at ?></td>
			    			<td class='action'>
			    				<a href="/message/view?message_id=<?= $userMessage->message_id ?>">View</a>
			    				<a class='delete_button' href="/message/delete?message_id=<?= $userMessage->message_id ?>&placeholder=1">Delete</a>
			    			</td>
			    		</tr>
		    		<?php } ?>
					<script>
						var j = jQuery.noConflict();
						j(document).ready(function(){
							j('.delete_button').on('click', function(e){
								e.preventDefault();
								var _this = j(this);
								var _href = j(this).attr('href');
								var _record = j(this).parent().parent();
								if (confirm("Are you sure?")) {
									j.ajax({
										url:_href,
										method:'POST',
										success:function(response){
											console.log(_record);
          									_record.remove();
										}
									});
							    }
							    return false;
							});
						});
					</script>
	    		<?php } ?>
    		</tbody>
    	</table>
    </div>
</div>