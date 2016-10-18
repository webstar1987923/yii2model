<?php 
use app\components\SiderbarCategoryWidget;
use app\components\StatVideos;
use app\components\VideoListWidget;
?>

<div class="wrap cf">
	<div id="content" role="main">
		<div class="loop-actions cf">
			<div class="sort">
				<span class="prefix sortby">
					<span>Sort By:</span>
				</span>
				<span class="orderby">
					<div class="top-arrow"></div> 
					<a href="/category/<?=$category->slug?>?orderby=date" title="Sort by Date" class="date <?= ($orderby == 'date') ? 'current' : '' ?>">
						<i>Date</i>
					</a>  
					<a href="/category/<?=$category->slug?>?orderby=title" title="Sort by Title" class="title <?= ($orderby == 'title') ? 'current' : '' ?>">
						<i>Title</i>
					</a>  
					<a href="/category/<?=$category->slug?>?orderby=views" title="Sort by Views" class="views <?= ($orderby == 'views') ? 'current' : '' ?>">
						<i>Views</i>
					</a>  
					<a href="/category/<?=$category->slug?>?orderby=likes" title="Sort by Likes" class="likes <?= ($orderby == 'likes') ? 'current' : '' ?>">
						<i>Likes</i>
					</a>  
					<a href="/category/<?=$category->slug?>?orderby=comments" title="Sort by Comments" class="comments <?= ($orderby == 'comments') ? 'current' : '' ?>"><i>Comments</i>
					</a>  
					<!--a href="/category/<?=$category->slug?>?orderby=rand" title="Sort Randomly" class="rand">
						<i>Random</i>
					</a--> 
				</span>
				<!-- end .orderby -->
				<select class="orderby-select">
					<option value="/category/<?=$category->slug?>?orderby=date" selected="selected">Date</option>
					<option value="/category/<?=$category->slug?>?orderby=title">Title</option>
					<option value="/category/<?=$category->slug?>?orderby=views">Views</option>
					<option value="/category/<?=$category->slug?>?orderby=likes">Likes</option>
					<option value="/category/<?=$category->slug?>?orderby=comments">Comments</option>
					<option value="/category/<?=$category->slug?>?orderby=rand">Random</option>
				</select>
				<span class="order">
					<a class="<?=$order?>" href="/category/<?=$category->slug?>?orderby=<?=(isset($orderby)) ? $orderby : 'title'?>&order=<?=$order?>" title="Sort <?=($order=='asc') ? 'Ascending' : 'Descending'?>">Sort <?=($order=='asc') ? 'Ascending' : 'Descending'?></a>
				</span>
				<!-- end .order -->
			</div>
			<!-- end .sort -->			
			<div class="topbanner">
				<a href="http://beetube.me/"> 
					<img src="http://beetube.me/wp-content/uploads/2014/04/top-etc.png"> 
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
			<!-- end .view -->
		</div>
		<!-- end .loop-actions -->	
	</div>
	<div id="content" role="main">
		<div class="loop-content-m">
			<div class="loop-content switchable-view grid-mini" data-view="grid-mini" data-ajaxload="1">
				<div class="loop-header">
					<h1 class="loop-title"><span class="prefix">Category</span> <span class="loop-subtitle"><?= $category->name; ?></span></h1>
					<span class="loop-desc"></span>
				</div><!-- end .loop-header -->	 
				<div class="nag cf">				
					<?= VideoListWidget::widget(['videos' => $videos]) ?>
				</div>
			</div><!-- end .loop-content -->
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
	
<div id="sidebar" role="complementary" class="">
	<div class="border-sep widget widget_border masonry-brick" style="margin:0px"></div>
		<?= SiderbarCategoryWidget::widget(['currentCatId' => $category->id]) ?>
		<?= StatVideos::widget([
			'currentCatId'   => $category->id,
			'_orderBy'       => 'view_count',
			'_orderByOption' => 'DESC',
			'quantity'       => 4,
			'viewFile'       => 'stat-videos-1',
			'widgetTitle'    => 'Most Viewed',
		]) ?>
		<!--div id="tag_cloud-2" class="widget widget_tag_cloud">
			<div class="widget-header"><h3 class="widget-title">Tags</h3></div>
			<div class="tagcloud">
				<a href="/tag/3d/" class="tag-link-3" title="1 topic" style="font-size: 8pt;">3d</a>
				<a href="/tag/animals/" class="tag-link-6" title="1 topic" style="font-size: 8pt;">Animals</a>
				<a href="/tag/animate/" class="tag-link-5" title="1 topic" style="font-size: 8pt;">animate</a>
			</div>
		</div-->
	</div>
</div>