<?php 
use app\components\NavigationUserWidget;
use app\components\VideoListWidget;
?>
<?= NavigationUserWidget::widget(['active' => 'follower']) ?>
<div class="wrap cf">
    <div class="cat-featured wall">
    	<div class="section-follower">
        	<div class="section-user">
				<div class="follower">
					<?php foreach( $users as $user): ?>
					<a href="/user/myvideo"> 
					<?php if($user->avatar): ?>
                        <img id="image" src="/<?= $user->avatar; ?>">
                    <?php else: ?>

                        <img id="image" src="/fassets/images/Hydrangeas.jpg">
                    <?php endif; ?>
						<?= $user->user_name ?>
					</a>
					<?php endforeach; ?>
				</div><!-- end .section-content -->
			</div><!-- end .section-box -->
		</div>
	</div>
</div>