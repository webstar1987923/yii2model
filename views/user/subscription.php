<?php 
use app\components\NavigationUserWidget;
use app\components\VideoListWidget;
?>


<?= NavigationUserWidget::widget(['active' => 'subscription']) ?>
<div class="wrap cf">
    <div class="cat-featured wall">
    	<div class="hori-wrap">
			<div class="section-box">
				<div class="section-content grid-mini">
					<?php if($videos) : ?>
					<div class="nag cf">	
						<?= VideoListWidget::widget(['videos' => $videos]) ?>
					</div>
					<?php else : ?>
						<p class="messageError">
		                    You did not subcribe any video before.
		                </p>   
					<?php endif; ?>




					
				</div><!-- end .section-content -->
				<div class='pagination-container'>
					<?php 
					echo \yii\widgets\LinkPager::widget([
					    'pagination' => $pages,
					]);
					?>
				</div>
			</div><!-- end .section-box -->
		</div>
	</div>
</div>