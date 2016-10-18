
<?php 
use app\components\NavigationUserWidget;
use app\components\VideoListWidget;
?>
<?= NavigationUserWidget::widget(['active' => 'myvideo']) ?>
<div class="wrap cf">
    <div class="cat-featured wall">
    	<div class="hori-wrap">
			<div class="section-box">
				<?php if (\Yii::$app->session->hasFlash('error')) {?>
					<div class='message error'><?=\Yii::$app->session->getFlash('error')?></div>
				<?php }elseif (\Yii::$app->session->hasFlash('success')){ ?>
					<div class='message success'><?=\Yii::$app->session->getFlash('success')?></div>
				<?php } ?>
				<div class="section-content grid-mini">
					<?php if($videos) : ?>
					<div class="nag cf">
						<?= VideoListWidget::widget([
							'videos' => $videos,
							'canedit' => true,
						]) ?>
					</div>
					<?php else : ?>
						<p class="messageError">
		                    You do not have any videos. Add it if you want
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