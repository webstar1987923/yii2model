<?php 
use app\components\SiderbarCategoryWidget;
use app\models\User;
use app\components\StatVideos;
use yii\helpers\Url;

$this->params['facebook']['title'] = $video['title'];
$this->params['facebook']['image'] = Url::to(['/' ], true) . $video->ulr_image;
$this->params['facebook']['type'] = 'article';
$this->params['facebook']['description'] = $video['description'] ;
$this->params['facebook']['url'] = Url::to(['/videos/show/'. $video['slug'] ], true);
?>


<!--meta property="og:image" content="<?= Url::to(['/' ], true) . $video->ulr_image; ?>"/>
<meta property="og:title" content="Vi tester Sony PlayStation Vita - Review" />
<meta property="og:site_name" content="TechStorm" />
<meta property="og:description" content="Ventetiden var lang, men endelig så kommer den nye håndholdte konsollen fra Sony, PS Vita, til Norge. PlayStation Vita, som allerede i desember 2011 ble lansert i Japan, skal…" />
<meta property="og:type" content="article" />
<meta property="og:url" content="https://www.google.com/?gws_rd=ssl" /-->


<!--meta property="og:image" content="https://www.google.com/?gws_rd=ssl"/-->

<div id="main"><div class="wrap cf single single-post postid-116 single-format-standard full-wrap">
    <div id="content" role="main">
                
        <div class="post-52 post type-post status-publish format-standard has-post-thumbnail hentry category-animation" id="post-52">
        
        <div id="video">
            <?php
                $parts = explode('.', $video['ulr_video']);
                $file_extension = end($parts);
                if ($file_extension=='flv') {
                    $file_extension= 'x-flv';
                }
            ?>
            <div class="screen fluid-width-video-wrapper">
              <video id="example_video_1" class="video-js vjs-default-skin" autoplay controls preload='none' width="870" height="489"
                  poster="<?= $video['ulr_image'] ?>"
                  data-setup="{}">
                <source src="<?= $video['ulr_video'] ?>" type="video/<?=$file_extension?>" />
              </video>
            </div>
        </div><!-- end #video-->
        <div class="clear"></div>
        <div class="entry-header cf">
            <div class="inner cf">
                <h1 class="entry-title"><?= $video['title'] ?></h1>
            <div class="entry-meta">
                <span class="author"> <a href="<?=  (isset($video->user)) ? '/channel/view?id='. $video->user->id : '' ?>" title="Posts by admin" rel="author"><?=  (isset($video->user)) ? $video->user->user_name : '' ?></a>
                </span>
                <span class="time"><?= date('F d Y', strtotime($video['created_at'])); ?>
                </span>
                <span class="stats">
                    <span class="views"><i class="count"><?=$video['view_count']?></i> <span class="suffix"></span></span>
                    <span class="comments"><i class="count"><?= (isset($video->comments)) ? count($video->comments) : '0' ?></i> <span class="suffix"></span></span>
                    <span class="jtheme-post-likes likes">
                        
                        <span class="suffix"></span>
                    </span>
                </span>                          
            </div>

            <div class="" style="float:left">

                <a href="javascript:void(0);" id="make_like" class="like-icon" data-id="<?= $video->id ?>">Like</a>
                <i class="count likecount<?= $video->id; ?>" data-pid="<?= $video->id; ?>"><?= (isset($video->likes)) ? count($video->likes) : '0' ?></i> 

                
                <a href="javascript:void(0);" id="make_dis_like" class="dslike-icon" data-id="<?= $video->id ?>">Dislike</a>
                <i class="count dislikecount<?= $video->id; ?>" data-pid="<?= $video->id; ?>"><?= (isset($video->dislikes)) ? count($video->dislikes) : '0' ?></i> 

                <a target="_blank" href="/flag/create/<?=$video->slug?>"  id="make_flag" class="flag-icon"></a>
            </div>

            <div class="" style="float:left">
                <?php if(!Yii::$app->user->isGuest): ?>
                    <div id="" class="social-share">
                        <a href="javascript:void(0)" class="subscribe <?= ($video->issubscribe)? 'displaynone' : '' ?> " data-via="" data-lang="en" data-id="<?= $video->id ?>">Subscribe </a>
                    
                        <a href="javascript:void(0)" class="unsubscribe <?= (!$video->issubscribe)? 'displaynone' : '' ?>" data-via="" data-lang="en" data-id="<?= $video->id ?>">UnSubscribe </a>
                    </div>
                <?php endif; ?>
            </div>

            <!--div class="entry-actions">
                <span class="jtheme-like-post"><a class="like" href="javascript:void(0);" data-pid="52">Like?</a></span>        
            </div-->
                <div id="social-share" style="clear:both;">                     
                    <div id="" class="social-share">
                        <div class="fb-share-button" data-href="<?= Url::to(['/videos/show/'. $video['slug'] ], true); ?>" data-type="button_count"></div>
                        <!--div class="fb-share-button" data-href="https://www.google.com/?gws_rd=ssl" data-type="button_count"></div-->
                    </div>
                    <div id="" class="social-share">
                        <div style="height:5px;"></div>
                        <a href="https://twitter.com/intent/tweet?url=<?= Url::to(['/videos/show/'. $video['slug'] ], true); ?>" class="twitter-share-button" data-via="" data-lang="en" data-counturl="<?= Url::to(['/videos/show/'. $video['slug'] ], true); ?>">Tweet</a>
                    </div>
                    <div id="" class="social-share">
                        <div style="height:5px;"></div>
                        <div class="g-plus" data-action="share" data-annotation="bubble"></div>
                    </div>
                    
                    <div class="clear"></div>
                </div>
                            
            </div><!-- end .entry-header>.inner -->
        </div><!-- end .entry-header -->
        <div id="details" class="section-box">
            <div class="section-content">
            <div id="info" class="more-less" style="height: 100px;">
                

                <div class="entry-content rich-content">
                    <?php foreach (explode("\n", $video['description']) as $line) { ?>
                        <p><?= $line ?></p>
                    <?php } ?>
                </div><!-- end .entry-content -->
                <div id="extras">
                    <div>
                        <h4>Category:</h4> <a href="/category/<?=$category['slug']?>" rel="category tag"><?=$category['name']?></a>             
                    </div>
                </div>
                
            </div><!-- end #info -->
            </div><!-- end .section-content -->
            
            <div class="info-toggle">
                <a href="#" class="info-toggle-button info-more-button">
                    <span class="more-text">Show more</span> 
                    <span class="less-text">Show less</span>
                </a>
            </div>
        </div><!--end #deatils-->
        
    </div><!-- end #post-52 -->
        
    <div class='user_comments'>
        <?php if (!\Yii::$app->user->isGuest): ?>
        <form class='post_comment_area' method='post' action='/videos/comment'>
            <input id='video_id' value='<?=$video['id']?>' type='hidden'>
            <input id='user_id' value='<?=\Yii::$app->user->id?>' type='hidden'>
            <textarea placeholder='Add a comment...'></textarea>
            <div class='post'>
                <a href="/user/profile/view?id=<?=\Yii::$app->user->id?>"><?=\Yii::$app->user->identity->user_name?></a>
                <button type='submit'>Comment</button>
            </div>
        </form>
        <?php endif; ?>
        <div class='comments_container'>
            <?php if (count($comments)) { 
                foreach ($comments as $comment) {?>
                <div class='comment'>
                    <a class='user' href="/user/profile/view?id=<?=$comment->user->id?>"><?=$comment->user->user_name?> </a>
                    <p class='content'>
                        <span><?=$comment->content?></span>
                        <?php if (!is_null($comment->updated_at)) { ?>
                            <span class='time_edit'>Last edit: <?=$comment->updated_at?></span>
                        <?php } ?>
                    </p>
                    <span class='time_comment'><?=$comment->created_at?></span>
                    <?php if (\Yii::$app->user->id==$comment->user_id||\Yii::$app->user->identity->role==User::ADMIN) { ?>
                    <div class='actions'>
                        <a class='kbtn success-kbtn edit' href="/videos/editcomment?id=<?=$comment->id?>">Edit</a>
                        <a class='kbtn error-kbtn delete' href="/videos/deletecomment?id=<?=$comment->id?>">Delete</a>
                    </div>
                    <?php } ?>
                </div>
            <?php }} ?>
        </div>
        <?php if($loadmore){ ?>
        <div class='loadmorecomment' style="text-align: center;">
            <a href="/videos/loadcomment?id=<?= $video->id; ?>" class="load">Load more</a>
        </div>
        <?php } ?>
    </div>       
    <?= StatVideos::widget([
            'currentCatId'   => $video['category_id'],
            '_orderBy'       => 'likes',
            '_orderByOption' => 'DESC',
            'quantity'       => 4,
            'viewFile'       => 'stat-videos-3',
            'widgetTitle'    => 'You may also like',
            'gridType'       => 'grid-mini'
        ]) ?>

<script type="text/javascript">
    var j = jQuery.noConflict();
    j('.loadmorecomment').on('click','a.load',function(e) {
        e.preventDefault();
        var _href = j(this).attr('href');
        j.ajax({
            url: _href,
            method:'POST',
            success: function (response) {
                j('.user_comments .comments_container').html(response.html).on('click','.actions a',function(e){
                    e.preventDefault();
                    action(j(this));
                });
                if (response.loadmore) {
                    j('.loadmorecomment').show();
                } else{
                    j('.loadmorecomment').hide();
                };
            }
        });
    });
    j('.user_comments .post_comment_area').on('click','button',function(e){
        e.preventDefault();
        var _url = j('.user_comments .post_comment_area').attr('action');
        var _content = j(".user_comments .post_comment_area textarea").val();
        var _video_id = j(".user_comments .post_comment_area #video_id").val();
        var _user_id = j(".user_comments .post_comment_area #user_id").val();
        j.ajax({
            url: _url,
            method:'POST',
            data: {
                video_id:_video_id,
                user_id:_user_id,
                content:_content
            },
            success: function (response) {
                j('.user_comments .post_comment_area')[0].reset();
                var comment = response.comment;
                var user_name = response.user_name;
                var html = "<div class='comment'><a class='user' href='/user/profile/view?id="+comment.user_id+"'>"+user_name+":</a><p class='content'><span>"+comment.content+"</span></p><span class='time_comment'>"+comment.created_at+"</span><div class='actions'><a class='kbtn success-kbtn edit' href='/videos/editcomment?id="+comment.id+"'>Edit</a><a class='kbtn error-kbtn delete' href='/videos/deletecomment?id="+comment.id+"'>Delete</a></div></div>";
                j('.user_comments .comments_container').prepend(html).on('click','.actions a',function(e){
                    e.preventDefault();
                    action(j(this));
                });
            }
        });
    });
    j('.comments_container .actions').on('click','a',function(e){
        e.preventDefault();
        action(j(this));
    });
    function action(_this) {
        var _url = _this.attr('href');
        var _content = null;
        var content_element = _this.closest('.comment').find('.content');
        if (_this.hasClass('edit')) {
            var old_html = content_element.html();
            var _content = content_element.find('span').eq(0).text();
            content_element.html('<textarea>'+_content+'</textarea><a class="kbtn success-kbtn editcomment" href="javascript:void(0)">Ok</a><a class="kbtn primary-kbtn editcancel" href="javascript:void(0)">Cancel</a>');
            content_element.on('click', '.editcancel', function(){
                content_element.html(old_html);
            });

            content_element.on('click', '.editcomment', function(){
                var _content = j(this).parent().find('textarea').val();
                j.ajax({
                    url: _url,
                    method:'POST',
                    data: {content:_content},
                    success: function (response) {
                        var _html = "<span>"+response.content+"</span><span class='time_edit'>Last edit: "+response.updated_at+"</span>";
                        content_element.html(_html);
                    }
                });
            });
        }else{
            if (confirm("Are you sure for this action?")) {
                j.ajax({
                    url: _url,
                    method:'POST',
                    success: function (response) {
                        content_element.parent().remove();
                    }
                });
            };
            
        };
    }
</script>

        <div class="single-banner">
            <a href='<?=\yii\helpers\Url::home(true)?>'> <img src='/fassets/wp-content/uploads/2014/04/bottom-etc.png' /> </a>        
        </div>
    </div><!-- end #content -->

    
    <div id="sidebar" role="complementary" class="">
        <div class="border-sep widget widget_border masonry-brick" style="margin:0px"></div>
        <div id="jtheme-single-post-stats-2" class="widget widget-single-post-stats">
            <div class="widget-header">
                <h3 class="widget-title">Post Stats</h3>
            </div>
            <span class="views">
                <i class="count"><?=$video['view_count']?></i> 
                <span class="suffix"></span>
            </span>
            <span class="comments">
                <i class="count"><?= (isset($video->comments)) ? count($video->comments) : '0' ?></i> <span class="suffix"></span>
            </span>
            <span class="jtheme-post-likes likes">
                <i class="count klikecount<?= $video->id; ?>" data-pid="<?= $video->id; ?>"><?= (isset($video->likes)) ? count($video->likes) : '0' ?></i> <span class="suffix"></span>
            </span>
        </div>
        
        <?= SiderbarCategoryWidget::widget(['currentCatId' => $category['id']]) ?>
    </div><!--end #sidebar-->
</div>

</div><!-- end #main -->
<script src="/fassets/wp-content/themes/beetube/js/horizental/jquery.cbpQTRotator.js"></script>
<!-- Chang URLs to wherever Video.js files will be hosted -->
<link href="/fassets/video-js/video-js.css" rel="stylesheet" type="text/css">
<!-- video.js must be in the <head> for older IEs to work. -->
<script src="/fassets/video-js/video.js"></script>

<!-- Unless using the CDN hosted version, update the URL to the Flash SWF -->
<script>
videojs.options.flash.swf = "/fassets/video-js/video-js.swf";
</script>
    

    <div id="fb-root"></div>
    <script>
    
    (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        var fb_app_id =  <?php echo json_encode((String) $setting->fb_app_id ); ?>;

      if (d.getElementById(id)) return;
      js = d.createElement(s); js.id = id;
      js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&appId=" +fb_app_id+ "&version=v2.3";
      fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
    </script>

<!-- Place this tag after the last share tag. -->
<script type="text/javascript">
  (function() {
    var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
    po.src = 'https://apis.google.com/js/platform.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
  })();
</script>
    
<script type="text/javascript">
(function($) {
    $('.jtheme-like-post .like, .jtheme-like-post .liked').on('click', function() {
        el = $(this);

        actionType = el.hasClass('liked') ? 'remove_like' : 'like';
        
        var data = {
            action: 'like_post', 
            action_type: actionType, 
            like_id: el.attr('data-lid'),
            post_id: el.attr('data-pid'), 
            user_id: el.attr('data-uid'),
            label: el.text(),
            nonce: '354b3bc435'
        };
        console.log(data);
        
        $.ajax({
            url: '/fassets/wp-admin/admin-ajax.php',
            type: 'POST',
            data: data,
            dataType: 'json',
            beforeSend: function(){
                el.addClass('liking');
            }
        })
        .fail(function(xhr, status, error){
            //console.log('fail');
            //console.log(xhr);
            //console.log(status);
            //console.log(error);
            alert('Something error. please try again later!');
            el.removeClass('liking');
        })
        .done(function(r, status, xhr){
            //console.log('done');
            //console.log(r);
            //console.log(status);
            //console.log(xhr);

            if(r.error != '') {
                alert(r.error);
                return false;
            }
                
            if(actionType == 'like')
                el.stop().attr('data-lid', r.id).removeClass('like').addClass('liked');
            else if(actionType == 'remove_like')
                el.stop().removeAttr('data-lid').removeClass('liked').addClass('like');
                
            $('.jtheme-post-likes').each(function(){
                var count = $(this).find('.count');
                if(count.attr('data-pid') == el.attr('data-pid'))
                    $(count).text(r.likes);
            });
                
            el.removeClass('liking').text(r.label);
        })
        .always(function(xhr, status){
            //console.log('always');
            //console.log(xhr);
            //console.log(status);
        });
        
        return false;
    });
})(jQuery);
</script>
<script type='text/javascript'>
/* <![CDATA[ */
var _wpcf7 = {"loaderUrl":"http:\/\/beetube.me\/wp-content\/plugins\/contact-form-7\/images\/ajax-loader.gif","sending":"Sending ..."};
/* ]]> */
</script>
