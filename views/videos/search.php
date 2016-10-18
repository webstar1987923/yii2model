<?php 
use app\components\SiderbarCategoryWidget;
use app\components\StatVideos;
use app\components\VideoListWidget;
?>
<div class="wrap cf">
	<div id="content" role="main">
		<div class="loop-actions cf">
			<!-- end .sort -->			
			<div class="topbanner">
				<a href="/"> 
					<img src="/fassets/wp-content/uploads/2014/04/top-etc.png"> 
				</a>			
			</div>
			<div class="view">
				<span class="prefix viewas">View As:</span>
				<div class="grid-view">
					<a href="#" title="Grid View with Mini Thumbnail" data-type="grid-mini" class="grid-mini-link current"><i></i>
					</a>
					<a href="#" title="Grid View with Small Thumbnail" data-type="grid-small" class="grid-small-link"><i></i></a>
					<a href="#" title="Grid View with Medium Thumbnail" data-type="grid-medium" class="grid-medium-link"><i></i></a>
					<a href="#" title="List View with Small Thumbnail" data-type="list-small" class="list-small-link"><i></i></a>
					<a href="#" title="List View with Medium Thumbnail" data-type="list-medium" class="list-medium-link"><i></i></a>
					<a href="#" title="List View with Large Thumbnail" data-type="list-large" class="list-large-link"><i></i></a>
				</div>
			</div>
		</div>
	</div>
	<div id="content" role="main">		
		<div class="loop-content-m">
			<div class="loop-content switchable-view grid-mini" data-view="grid-mini" data-ajaxload="1">
				<div class="loop-header">
					<h1 class="loop-title"><span class="prefix">Result search for keyword:</span> <span class="loop-subtitle"><?= $keyword; ?></span></h1>
					<span class="loop-desc"></span>
				</div><!-- end .loop-header -->	 
				<div class="nag cf">	
					<?= VideoListWidget::widget(['videos' => $videos]) ?>
				</div>
			</div>
					<br><br>    	
		</div>
		<div class='pagination-container'>
			<?php 
				echo \yii\widgets\LinkPager::widget([
				    'pagination' => $pages,
				]);
			?>
		</div>
	</div>
</div>