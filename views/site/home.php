<?php 
use app\components\HelloWidget;
use app\components\VideoItemWidget;
use app\components\StatVideos;
?>
<div class="cat-featured wall">
    <div class="hori-wrap">
		<div class="frame cycleitems fcarousel" id="cycleitems">
			<ul class="clearfix carousel-list">
			<?php if(count($videos)) { ?>
				<?php foreach($videos as $video) { ?>
					<li class="item-video">
						<div class="thumb">
							<a class="clip-link" data-id="<?= $video->id; ?>" title="<?= $video->title; ?>" href="/videos/show/<?= $video->slug; ?>">
								<span class="clip">
									<img src="<?= $video->ulr_image; ?>" alt="<?= $video->title; ?>" /><span class="vertical-align"></span>
								</span>
												
								<span class="overlay"></span>
							</a>
						</div> 
						<div class="hori-title">
							<a href="/videos/show/<?= $video->slug; ?>"><?= $video->title; ?></a>
						</div>
					</li>
				<?php } ?>
			<?php } ?>			
			</ul>
		</div>
	</div>
</div>
<div id="main" class="home-temp">
<div class="wrap cf home-content">
	<div id="content">
		<div class="section-box">
			<div class="section-header">
				<h2 class="section-title">
					<span class="name">Newest Videos</span>
				</h2>
			</div>
			<div class="section-content list-large">
				<div class="nag cf">
					<?= VideoItemWidget::widget(['video' => $newestVideo]) ?>	
				</div>
			</div>
		</div>
		<?= StatVideos::widget([
			'_orderBy'       => 'view_count',
			'_orderByOption' => 'DESC',
			'quantity'       => 6,
			'viewFile'       => 'stat-videos-3',
			'widgetTitle'    => 'Most Viewed',
			'gridType'		 => 'grid-small'
		]) ?>
		<?= StatVideos::widget([
			'_orderBy'       => 'likes',
			'_orderByOption' => 'DESC',
			'quantity'       => 6,
			'viewFile'       => 'stat-videos-3',
			'widgetTitle'    => 'Most Liked',
			'gridType'		 => 'grid-mini'
		]) ?>
		
		<?= StatVideos::widget([
			'_orderBy'       => 'comments',
			'_orderByOption' => 'DESC',
			'quantity'       => 4,
			'viewFile'       => 'stat-videos-3',
			'widgetTitle'    => 'Most Comment',
			'gridType'		 => 'grid-medium'
		]) ?>

		
		<!--div class="section-box">
			<div class="section-header">
				<h2 class="section-title"><span class="name">Most Liked</span></h2></div>
				<div class="section-content grid-mini">
				<div class="nag cf">	
					<div id="post-455" class="item clearfix cf item-video post-455 post type-post status-publish format-standard has-post-thumbnail hentry category-animation category-hd category-random category-slow-motion tag-hosted tag-self tag-videos">
			
						<div class="thumb">
							<a class="clip-link" data-id="455" title="Self Hosted Video Post With Custom Player" href="http://beetube.me/self-hosted-video-post-with-custom-player/">
								<span class="clip">
									<img src="http://beetube.me/wp-content/uploads/2014/03/animals_widewallpaper_mouse-with-hat_62210-320x180.jpg" alt="Self Hosted Video Post With Custom Player"><span class="vertical-align"></span>
								</span>
												
								<span class="overlay"></span>
							</a>
							<div class="hori-like">
								<p class="stats"><span class="views"><i class="count">29.06K</i> <span class="suffix"></span></span><span class="comments"><i class="count">0</i> <span class="suffix"></span></span><span class="jtheme-post-likes likes"><i class="count" data-pid="455">434</i> <span class="suffix"></span></span></p>
							</div>
						</div>			
						<div class="data">
							<h2 class="entry-title"><a href="http://beetube.me/self-hosted-video-post-with-custom-player/" rel="bookmark" title="Permalink to Self Hosted Video Post With Custom Player">Self Hosted Video Post With Custom Player</a></h2>
							
							<p class="entry-meta">
								<span class="author vcard">
								<a class="url fn n" href="http://beetube.me/author/admin/" title="View all posts by admin" rel="author">admin</a>				</span>
								
								<time class="entry-date" datetime="25th Jan, 2014">25th Jan, 2014</time>
				                <span class="stats"><span class="views"><i class="count">29.06K</i> <span class="suffix">Views</span></span></span>
							</p>
									
							<p class="stats"><span class="views"><i class="count">29.06K</i> <span class="suffix"></span></span><span class="comments"><i class="count">0</i> <span class="suffix"></span></span><span class="jtheme-post-likes likes"><i class="count" data-pid="455">434</i> <span class="suffix"></span></span></p>

							<p class="entry-summary">
								Duis sed odio sit amet nibh vulputate cursus a sit amet mauris. Morbi accumsan ipsum velit. Nam nec tellus a odio tincidunt auctor a ornare odio. Sed non&nbsp; mauris vitae erat consequat &nbsp; auctor eu in el...</p>
						</div>
					</div>
				</div>
				<div class="view-all">
					<a class="more-link" href="http://beetube.me/category/slow-motion/"><span>View All </span></a>
				</div>
			</div>
		</div-->
	</div>
	<div id="sidebar" role="complementary" class="">
		<div class="border-sep widget widget_border"></div>
		<?= StatVideos::widget([
			'_orderBy'       => 'view_count',
			'_orderByOption' => 'DESC',
			'quantity'       => 4,
			'viewFile'       => 'stat-videos-1',
			'widgetTitle'    => 'Most Viewed',
			'gridType'		 => 'grid-medium',
			'listType'		 => 'post-list-full',
		]) ?>
	
		<!--div id="jtheme-widget-posts-5" class="widget widget-posts">		
			<div class="widget-header"><h3 class="widget-title">Recent Videos</h3></div>		
			<ul class="post-list">
				<li class="item cf item-video">
					<div class="thumb">
						<a class="clip-link" data-id="223" title="Video From Youtube" href="http://beetube.me/video-from-vimeo/">
							<span class="clip">
								<img src="http://beetube.me/wp-content/uploads/2014/03/tumblr_ms9n0ted0Z1st5lhmo1_1280-160x90.jpg" alt="Video From Youtube"><span class="vertical-align"></span>
							</span>
											
							<span class="overlay"></span>
						</a>
					</div>				
					<div class="data">
						<h4 class="entry-title"><a href="http://beetube.me/video-from-vimeo/" title="Video From Youtube">Video From Youtube</a></h4>
					
						<p class="meta">
							<span class="author">Added by <a href="http://beetube.me/author/admin/" title="Posts by admin" rel="author">admin</a></span>
							<span class="time">1 year ago</span>
						</p>
						
						<p class="stats"><span class="views"><i class="count">22.47K</i> <span class="suffix"></span></span><span class="comments"><i class="count">0</i> <span class="suffix"></span></span><span class="jtheme-post-likes likes"><i class="count" data-pid="223">326</i> <span class="suffix"></span></span></p>
					</div>
				</li>		
			</ul>
		</div-->		
		<div id="tag_cloud-3" class="widget widget_tag_cloud"></div>
	</div>
</div>
</div>