<?php 
use app\components\HeaderCategoryWidget;
use yii\helpers\Url;
use app\components\StatVideos;
?>
<!DOCTYPE html>
<!--[if IE 6]><html class="ie ie6 oldie" lang="en-US"><![endif]-->
<!--[if IE 7]><html class="ie ie7 oldie" lang="en-US"><![endif]-->
<!--[if IE 8]><html class="ie ie8 oldie" lang="en-US"><![endif]-->
<!--[if IE 9]><html class="ie ie9" lang="en-US"><![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--><html lang="en-US"><!--<![endif]-->
<head>
<!-- Meta Tags -->
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

<!-- Title, Keywords and Description -->
				<title>Urknack Video</title>
				<?php if(isset($this->params['facebook']['title'])): ?>
					<meta property="og:title" content="<?= $this->params['facebook']['title']; ?>" />
				<?php endif; ?>

				<?php if(isset($this->params['facebook']['image'])): ?>
					<meta property="og:image" content="<?= $this->params['facebook']['image']; ?>" />
				<?php endif; ?>

				<?php if(isset($this->params['facebook']['type'])): ?>
					<meta property="og:type" content="<?= $this->params['facebook']['type']; ?>" />
				<?php endif; ?>

				<?php if(isset($this->params['facebook']['description'])): ?>
					<meta property="og:description" content="<?= $this->params['facebook']['description']; ?>" />
				<?php endif; ?>

				<?php if(isset($this->params['facebook']['url'])): ?>
					<meta property="og:url" content="<?= $this->params['facebook']['url']; ?>" />
				<?php endif; ?>

	<!--meta name="description" content="Urknack" />
	<meta property="og:type" content="video" /-->  
  


<!-- <link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="shortcut icon" href="http://joinwebs.com/beetube/wp-content/themes/beetube/images/favicon.ico" />
<link rel="pingback" href="http://beetube.me/xmlrpc.php" /> -->

<!-- Generated CSS BEGIN -->
<style type='text/css'>
body{background:#EEE url("/fassets/wp-content/themes/beetube/images/bg-pattern.png") repeat center top fixed !important;}
.info-less{height:100px;}
</style>
<!-- Generated CSS END -->
<style>#main-nav {background:#444 !important;}#main-nav ul li ul{background:#444 !important}#top-nav {background: !important;}#header-search .search-text-div input[type="text"]{background: !important;}</style>	
<script>
subinsblogla=0;
setInterval(function(){
if(document.readyState!='complete'){
 document.documentElement.style.overflow="hidden";
 var subinsblog=document.createElement("div");
 subinsblog.id="subinsblogldiv";
 var polu=99*99*99999999*999999999;
 subinsblog.style.zIndex=polu;
 subinsblog.style.background="#f8f8f8 url(/fassets/wp-content/uploads/2014/05/loading.gif) 50% 50% no-repeat";
 subinsblog.style.backgroundPositionX="100%";
 subinsblog.style.backgroundPositionY="100%";
 subinsblog.style.position="fixed";
 subinsblog.style.right="0px";
 subinsblog.style.left="0px";
 subinsblog.style.top="0px";
 subinsblog.style.bottom="0px";
 if(subinsblogla==0){
  document.documentElement.appendChild(subinsblog);
  subinsblogla=1;
 }
}
},-1000);

</script>
	
<style>#back-top { position: fixed; bottom: 30px;right:0px;}#back-top  a { width: 108px; display: block; text-align: center; font: 11px/100% Arial, Helvetica, sans-serif; text-transform: uppercase; text-decoration: none; color: #bbb; -webkit-transition: 1s; -moz-transition: 1s; transition: 1s;}#back-top  a:hover { color: #000;}#back-top  span { width: 108px; height: 108px; display: block; margin-bottom: 7px; background: #ddd url(&#39;http://4.bp.blogspot.com/-0mlo-caVkrQ/Ub835FbxwKI/AAAAAAAACv4/y9bfGt2b1fs/s1600/0017.png&#39;) no-repeat center center; -webkit-border-radius: 15px; -moz-border-radius: 15px; border-radius: 15px; -webkit-transition: 1s; -moz-transition: 1s; transition: 1s;}#back-top  a:hover span{background-color: #777;}
	
</style>
<script type="text/javascript">
var ajaxurl = 'http://beetube.me/wp-admin/ajax.php',
	theme_ajaxurl = '/fassets/wp-content/themes/beetube/ajax.php',
	ajaxerror = "Something\'s error. Please try again later!";
</script>
<link rel="alternate" type="application/rss+xml" title="BeeTube Video WordPress Theme &raquo; Feed" href="http://beetube.me/feed/" />
<link rel="alternate" type="application/rss+xml" title="BeeTube Video WordPress Theme &raquo; Comments Feed" href="http://beetube.me/comments/feed/" />
<link rel="alternate" type="application/rss+xml" title="BeeTube Video WordPress Theme &raquo; Landing Page Template Comments Feed" href="http://beetube.me/landing-page-template/feed/" />
		<script type="text/javascript">
			window._wpemojiSettings = {"baseUrl":"http:\/\/s.w.org\/images\/core\/emoji\/72x72\/","ext":".png","source":{"concatemoji":"http:\/\/beetube.me\/wp-includes\/js\/wp-emoji-release.min.js?ver=4.2.2"}};
			!function(a,b,c){function d(a){var c=b.createElement("canvas"),d=c.getContext&&c.getContext("2d");return d&&d.fillText?(d.textBaseline="top",d.font="600 32px Arial","flag"===a?(d.fillText(String.fromCharCode(55356,56812,55356,56807),0,0),c.toDataURL().length>3e3):(d.fillText(String.fromCharCode(55357,56835),0,0),0!==d.getImageData(16,16,1,1).data[0])):!1}function e(a){var c=b.createElement("script");c.src=a,c.type="text/javascript",b.getElementsByTagName("head")[0].appendChild(c)}var f,g;c.supports={simple:d("simple"),flag:d("flag")},c.DOMReady=!1,c.readyCallback=function(){c.DOMReady=!0},c.supports.simple&&c.supports.flag||(g=function(){c.readyCallback()},b.addEventListener?(b.addEventListener("DOMContentLoaded",g,!1),a.addEventListener("load",g,!1)):(a.attachEvent("onload",g),b.attachEvent("onreadystatechange",function(){"complete"===b.readyState&&c.readyCallback()})),f=c.source||{},f.concatemoji?e(f.concatemoji):f.wpemoji&&f.twemoji&&(e(f.twemoji),e(f.wpemoji)))}(window,document,window._wpemojiSettings);
		</script>
		<style type="text/css">
img.wp-smiley,
img.emoji {
	display: inline !important;
	border: none !important;
	box-shadow: none !important;
	height: 1em !important;
	width: 1em !important;
	margin: 0 .07em !important;
	vertical-align: -0.1em !important;
	background: none !important;
	padding: 0 !important;
}
</style>
<link rel='stylesheet' id='ayvpp-admin-css'  href='/fassets/wp-content/plugins/automatic-youtube-video-posts/css/style.css?ver=4.2.2' type='text/css' media='all' />
<link rel='stylesheet' id='contact-form-7-css'  href='/fassets/wp-content/plugins/contact-form-7/includes/css/styles.css?ver=4.1.2' type='text/css' media='all' />
<link rel='stylesheet' id='jtheme-fonts-css'  href='http://fonts.googleapis.com/css?family=Oxygen&#038;ver=4.2.2' type='text/css' media='all' />
<link rel='stylesheet' id='jtheme-style-css'  href='/fassets/wp-content/themes/beetube/style.css?ver=1.4.3' type='text/css' media='all' />
<link rel='stylesheet' id='jtheme-mainstyle-css'  href='/fassets/wp-content/themes/beetube/css/stylesheet-red.css?ver=1.4.3' type='text/css' media='all' />
<link rel='stylesheet' id='jtheme-hori-css'  href='/fassets/wp-content/themes/beetube/css/horizontal.css?ver=1.4.3' type='text/css' media='all' />
<link rel='stylesheet' id='jtheme-component-css'  href='/fassets/wp-content/themes/beetube/css/component.css?ver=1.4.3' type='text/css' media='all' />
<link rel='stylesheet' id='jtheme-itotope-css'  href='/fassets/wp-content/themes/beetube/css/jquery.itoppage.css?ver=1.4.3' type='text/css' media='all' />
<link rel='stylesheet' id='jtheme-res-nav-css'  href='/fassets/wp-content/themes/beetube/css/responsive-nav.css?ver=1.4.3' type='text/css' media='all' />
<link rel='stylesheet' id='jtheme-responsive-css'  href='/fassets/wp-content/themes/beetube/responsive.css?ver=1.4.3' type='text/css' media='all' />
<link rel='stylesheet' id='custom-css'  href='/fassets/wp-content/themes/beetube/custom.css?ver=4.2.2' type='text/css' media='all' />

<!--Khuong add -->
<link rel='stylesheet' id='custom-css-khuong'  href='/fassets/custom/css/custom.css' type='text/css' media='all'/>

<script type="text/javascript">var ayvpp_root = "http://beetube.me";</script>
<script type='text/javascript' src='/fassets/wp-includes/js/jquery/jquery.js?ver=1.11.2'></script>
<script type='text/javascript' src='/fassets/wp-includes/js/jquery/jquery-migrate.min.js?ver=1.2.1'></script>
<script type='text/javascript' src='/fassets/wp-content/themes/beetube/js/modernizr.min.js?ver=2.6.2'></script>
<script type='text/javascript' src='/fassets/wp-content/themes/beetube/js/horizental/plugins.js?ver=2.6.2'></script>
<script type='text/javascript' src='/fassets/wp-content/themes/beetube/js/horizental/sly.js?ver=2.6.2'></script>
<script type='text/javascript' src='/fassets/wp-content/themes/beetube/js/horizental/horizontal.js?ver=2.6.2'></script>
<script type='text/javascript' src='/fassets/wp-content/themes/beetube/js/horizental/modernizr.custom.js?ver=2.6.2'></script>
<script type='text/javascript' src='/fassets/wp-content/themes/beetube/js/jquery.itoppage.js?ver=2.6.2'></script>
<script type='text/javascript' src='/fassets/wp-content/themes/beetube/js/responsive-nav.js?ver=2.6.2'></script>
<script type='text/javascript' src='/fassets/wp-content/themes/beetube/js/jquery.plugins.min.js?ver=1.4.6'></script>
<link rel="EditURI" type="application/rsd+xml" title="RSD" href="http://beetube.me/xmlrpc.php?rsd" />
<link rel="wlwmanifest" type="application/wlwmanifest+xml" href="http://beetube.me/wp-includes/wlwmanifest.xml" /> 
<meta name="generator" content="WordPress 4.2.2" />
<script type='text/javascript' src="/fassets/wp-content/themes/beetube/js/switcher.js"></script>

<link rel="stylesheet" href="/fassets/wp-content/themes/beetube/css/style-switch.css">
<link rel="stylesheet" href="/bassets/global/css/uploadfile.css">
<link rel="stylesheet" href="/fassets/custom/css/accordion.css">

<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-64284274-1', 'auto');
  ga('send', 'pageview');

</script>

</head>

<body class="home page page-id-245 page-template page-template-template-home page-template-template-home-php full-wrap">
<div id="page">
<header id="header">
	<div id="top-nav">
	<div class="wrap cf">
					 
                 <div id="header-search">
					<ul>
						<?php if(Yii::$app->user->isGuest): ?>				  
					  	<li class="acti1">
					  		<a href="/site/login/"><span>Are You New? </span> Register</a>
					  	</li>					
					  	<li class="acti2">
					  		<a href="/site/login/">Login</a>
					  	</li>
					  	<?php else : ?>	
					  		<li class="acti1">
						  		<a href="/user/profile/"> My profile </a>
						  	</li>
						  	<li class="acti1">
						  		<a href="/site/logout/"> Log out </a>
						  	</li>
					  	<?php endif; ?>						  
	   					<li class="search-toggle search-toggle-normal"></li>
					</ul>
					
					<div class="searchform-div">
						<form method="get" class="searchform" action="/videos/search">
							<div class="search-text-div">
								<input type="text" name="keyword" class="search-text" value="" placeholder="Search Your Keyword " />
								<select name="country_id" class="selectCountry" id="selectCountry">
									<option value="">Country</option>

									<?php 
										foreach ($this->params['country_k'] as $key => $country) :
											if ($country->country == "United States") :
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

								<select name="state_id" class="selectState" id="selectState">
									
								</select>

								<select name="category_id" class="selectCategory" id="selectCategory">
									<option value="">Category</option>
									<?= $this->params['category_k']; ?>
								</select>
								
								<input type="submit" class="search-input" value="Search" />
							</div>

							<div class="search-submit-div btn">
								<input type="submit" class="search-submit" value="Search" />
							</div>
						</form><!--end #searchform-->
					</div>
				</div>

				<div class="tnav">
					<nav class="nav-collapse">
						<ul id="menu-header" class="menu">
							<li id="menu-item-256" class="menu-item menu-item-type-custom menu-item-object-custom current-menu-item current_page_item menu-item-256">
								<a href="/">Home</a>
							</li>
							<li id="menu-item-260" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-260">
								<a href="/page/about-us">About Urknack </a>
							</li>
							<li id="menu-item-261" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-260">
								<a href="/page/privacy-policy">Privacy Policy </a>
							</li>
							<li id="menu-item-262" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-260">
								<a href="/page/terms-of-use">Terms of use </a>
							</li>
							<li id="menu-item-255" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-255">
								<a href="/contact/create">Contact Us</a>
							</li>
						</ul>
					</nav>
				</div><!-- end #Top-nav -->				
				<div class="clear"></div>
				</div></div>

<div class="header-secend">	
<div class="wrap cf">	
	<div id="branding" class="image-branding" role="banner">
					<h1 id="site-title"><a rel="home" href="http://beetube.me">BeeTube Video WordPress Theme</a></h1>
				
					<a id="site-logo" rel="home" href="/">
						<!--img src="/fassets/wp-content/uploads/2014/05/Untitled-1.png" alt="BeeTube Video WordPress Theme"/-->
						<img src="/fassets/images/logo.png" alt="Urknack Video">
					</a>
				
					<h2 id="site-description" class="hidden">BEETUBE</h2>
			</div><!-- end #branding -->
					<div class="headerbanner">
						<a href='/'> 
						<img src='/fassets/wp-content/uploads/2014/04/top-etc.png' /> </a>			</div>
				<div id="social-nav">
					<ul>
						<li class="facebook"><a target="_blank" href="http://facebook.com/" title="Become a fan on Facebook">Become a fan on Facebook</a></li>
						<li class="twitter"><a target="_blank" href="http://twitter.com/" title="Array">Array</a></li>
						<li class="vimeo"><a target="_blank" href="https://vimeo.com/" title="Follow us on vimeo">Follow us on vimeo</a></li>
						<li class="gplus"><a target="_blank" href="https://www.google.com/" title="Premium Wordpress Themes">Premium Wordpress Themes</a></li>
						<li class="lin"><a target="_blank" href="http://www.linkedin.com/" title="Premium Wordpress Themes">Premium Wordpress Themes</a></li>
						<li class="drib"><a target="_blank" href="http://dribbble.com/" title="Premium Wordpress Themes">Premium Wordpress Themes</a></li><li class="youtu"><a target="_blank" href="http://youtube.com/" title=""></a></li>
					</ul>
				</div><!-- end #social-nav -->			
	
	
</div>
</div>
</header><!-- end #header-->

<div id="main-nav"><div class="wrap cf">

	<ul id="menu-main" class="menu">
		<li id="menu-item-236" class="menu-item menu-item-type-custom menu-item-object-custom <?= (Url::current() == '/site/index') ? 'current-menu-item' : ''; ?> current_page_item menu-item-has-children menu-item-236"><a href="/">Home</a>
			<!-- <ul class="sub-menu">
				<li id="menu-item-2921" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-2921"><a href="http://beetube.me/boxed/">Boxed Layout</a></li>
				<li id="menu-item-240" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-240"><a href="/single-video-home-page/">Home Page v1</a></li>
				<li id="menu-item-244" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-244"><a href="/archive-page-template/">Home Page v2</a></li>
				<li id="menu-item-248" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-248"><a href="/landing-page-template/">Home Page v3</a></li>
				<li id="menu-item-559" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-559"><a href="http://beetube.me/fullwidth-home-page/">Fullwidth Home Page</a></li>
				<li id="menu-item-250" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-250"><a href="/doritos/">Single Video v2</a></li>
			</ul> -->
		</li>
		<?= HeaderCategoryWidget::widget([]) ?>
	</ul>
	</div></div><!-- end #main-nav -->



	<!--
	<div class="cat-featured wall">
		<div class="carousel fcarousel fcarousel-5 wrap cf">
		<div class="carousel-container">
			<div class="carousel-clip">
				<ul class="carousel-list"></ul>
			</div><!-- end .carousel-clip -->
			<!--
			<div class="carousel-prev"></div>
			<div class="carousel-next"></div>
		</div><!-- end .carousel-container -->
        
		<!--</div> end .carousel
	</div>  end .cat-featured -->

<!--
			<div class="controls center">
				<button disabled="disabled" class="btn prev disabled"><i class="icon-chevron-left"></i> prev</button>
				<button class="btn next">next <i class="icon-chevron-right"></i></button>
			</div>
            
		</div>
        </div>-->

	<div class="main-content" >
		
		<?= $content ?>

	</div>

		
	<footer id="footer">
		<div id="footbar" class="footbar-c4" data-layout="c4">
			<div class="wrap cf">
				<div id="footbar-inner" class="">
					<div id="text-2" class="widget widget_text">
						<div class="widget-header">
							<h3 class="widget-title">Text Widget</h3>
						</div>			
						<div class="textwidget">Urknack Video </div>
					</div>

					<?= StatVideos::widget([
						'_orderBy'       => 'view_count',
						'_orderByOption' => 'DESC',
						'quantity'       => 6,
						'viewFile'       => 'stat-videos-2',
						'widgetTitle'    => 'Views',
						'useCache'       => true,
					]) ?>
					<?= StatVideos::widget([
						'_orderBy'       => 'id',
						'_orderByOption' => 'DESC',
						'quantity'       => 2,
						'viewFile'       => 'stat-videos-1',
						'widgetTitle'    => 'Recent Posts',
					]) ?>	
		<div id="jtheme-tweets-widget-2" class="widget widget-tweets">
			<div class="widget-header"><h3 class="widget-title">Last Tweets</h3></div>
			<div id="cbp-qtrotator" class="cbp-qtrotator">
				<div class=" cbp-qtcontent">
					<span class="tweet-content"><span class="tweet-text">Pets life HTML Template - Mojo Themes: <a href="http://t.co/ufJVdpu6C2" class="twitter-link" >http://t.co/ufJVdpu6C2</a></span><span class="tweet-meta"><span class="tweet-timestamp" title="2015/01/03 06:10">Jan 03</span></span></span>
				</div>
				<div class=" cbp-qtcontent">
					<span class="tweet-content"><span class="tweet-text">Currently reading <a href="http://t.co/KdGXHBYomA" class="twitter-link" >http://t.co/KdGXHBYomA</a></span><span class="tweet-meta"><span class="tweet-timestamp" title="2014/08/28 12:30">Aug 28</span></span></span>
				</div>
				<div class=" cbp-qtcontent">
					<span class="tweet-content"><span class="tweet-text">BeeTube Video WordPress Theme -Show More Button (Hide or Show): <a href="http://t.co/GJZICyboYH" class="twitter-link" >http://t.co/GJZICyboYH</a> via @YouTube</span><span class="tweet-meta"><span class="tweet-timestamp" title="2014/08/09 12:12">Aug 09</span></span></span>
				</div>
				<div class=" cbp-qtcontent">
					<span class="tweet-content"><span class="tweet-text">I added a video to a <a href="http://twitter.com/YouTube" class="twitter-atreply" >@YouTube</a> playlist <a href="http://t.co/GJZICyboYH" class="twitter-link" >http://t.co/GJZICyboYH</a> BeeTube Video WordPress Theme -Show More Button (Hide or Show)</span><span class="tweet-meta"><span class="tweet-timestamp" title="2014/08/09 12:11">Aug 09</span></span></span>
				</div>
				<div class=" cbp-qtcontent">
					<span class="tweet-content"><span class="tweet-text">I added a video to a <a href="http://twitter.com/YouTube" class="twitter-atreply" >@YouTube</a> playlist <a href="http://t.co/9CM3h6ubnh" class="twitter-link" >http://t.co/9CM3h6ubnh</a> BeeTube Video WordPress Theme - Hide Big HomePage Slider</span><span class="tweet-meta"><span class="tweet-timestamp" title="2014/08/09 11:49">Aug 09</span></span></span>
				</div>
			</div>
			<div class="jtheme-link-user">
				<a href="http://twitter.com/joinwebs" >Follow Us</a>
			</div>
		</div>
				</div>
			</div>
		</div><!-- end #footbar -->
	</footer><!-- end #footer -->
</div><!-- end #page -->
 
<script src="/fassets/wp-content/themes/beetube/js/horizental/jquery.cbpQTRotator.js"></script>
<script>
      var navigation = responsiveNav(".nav-collapse", {
        animate: true,        // Boolean: Use CSS3 transitions, true or false
        transition: 250,      // Integer: Speed of the transition, in milliseconds
        label: "&nbsp;&nbsp;&nbsp;",        // String: Label for the navigation toggle
        insert: "before",      // String: Insert the toggle before or after the navigation
        customToggle: "",     // Selector: Specify the ID of a custom toggle
        openPos: "relative",  // String: Position of the opened nav, relative or static
        jsClass: "js",        // String: 'JS enabled' class which is added to <html> el
        init: function(){},   // Function: Init callback
        open: function(){},   // Function: Open callback
        close: function(){}   // Function: Close callback
      });
    </script>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="https://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
	<div id="fb-root"></div>


<!-- Place this tag after the last share tag. -->
<script type="text/javascript">
  (function() {
    var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
    po.src = 'https://apis.google.com/js/platform.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
  })();
</script>
	
<script type='text/javascript' src='/fassets/wp-content/themes/beetube/js/blog-infinitescroll.js?ver=4.2.2'></script>
<script type='text/javascript' src='/fassets/wp-content/plugins/contact-form-7/includes/js/jquery.form.min.js?ver=3.51.0-2014.06.20'></script>
<script type='text/javascript'>
/* <![CDATA[ */
var _wpcf7 = {"loaderUrl":"http:\/\/beetube.me\/wp-content\/plugins\/contact-form-7\/images\/ajax-loader.gif","sending":"Sending ..."};
/* ]]> */
</script>
<script type='text/javascript' src='/fassets/wp-content/plugins/contact-form-7/includes/js/scripts.js?ver=4.1.2'></script>
<script type='text/javascript' src='/fassets/wp-includes/js/masonry.min.js?ver=3.1.2'></script>
<script type='text/javascript' src='/fassets/wp-includes/js/jquery/jquery.masonry.min.js?ver=3.1.2'></script>
<script type='text/javascript' src='/fassets/wp-content/themes/beetube/js/jquery.fitvids.js?ver=1.0'></script>
<script type='text/javascript' src='/fassets/wp-content/themes/beetube/js/theme.js?ver=1.4.6'></script>
<script type='text/javascript' src='/fassets/wp-includes/js/comment-reply.min.js?ver=4.2.2'></script>


<script type='text/javascript' src='/fassets/wp-includes/js/jquery.uploadfile.min.js'></script>
<script>
	var j = jQuery.noConflict();
	j(document).ready(function(){
	    j("#singleupload1").uploadFile({
	     	url:"/videos/ajaxupload",
	     	allowedTypes : "mp4,flv,webm",
	     	fileName:"myfile",
	     	maxFileSize:1024*1024*100,
	     	onSuccess: function(files, data, xhr) {
	     		var obj = JSON.parse(data);
	     		j('#video_id').val(obj[0].id);
	     		j('#submit_upload').prop("disabled", false);
			}
	    });
	});
setInterval(function(){
	j(document).ready(function() {
 document.getElementById('subinsblogldiv').style.display="none";
 document.documentElement.style.overflow="auto";
	});
},1000);
</script>

<script type='text/javascript' src='/fassets/custom/js/jquery.noty.packaged.min.js'></script>

<script type='text/javascript' src='/fassets/wp-content/themes/beetube/js/custom.js'></script>
<script type='text/javascript' src='/fassets/custom/js/accordion.js'></script>


</body>
</html>