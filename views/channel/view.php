<?php 
use app\components\NavigationFollowWidget;
use app\components\VideoListWidget;
use app\models\User;
?>
<div class="wrap cf">
    <div class="section-follower">
        <div class="section-user">
            <a href="/channel/view?id=<?= $user->id ?>"> 
            <?php if($user->avatar): ?>
                <img id="image" src="/<?= $user->avatar; ?>">
            <?php else: ?>
                <img id="image" src="/fassets/images/default-user-avatar.png">
            <?php endif; ?>
                <?= $user->user_name ?>
            </a>
        </div><!-- end .section-content -->
        <div class="" style="float:right">
            <?php if(!Yii::$app->user->isGuest): ?>

                <div id="" class="social-share">
                
                    <a href="javascript:void(0)" id="follow" class="follow <?= $user->isfollow ? 'displaynone': '' ?>" data-via="" data-lang="en" data-id="<?= $user->id ?>">Follow</a>
                    
                    <a href="javascript:void(0)" id="unfollow" class="unfollow <?= (!$user->isfollow) ? 'displaynone': '' ?>" data-via="" data-lang="en" data-id="<?= $user->id ?>">Unfollow</a>
                    
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
<?= NavigationFollowWidget::widget(['active' => 'video', 'user_id' => $user->id]) ?>
<div class="wrap cf">
    <div class="cat-featured wall">
        <div class="hori-wrap">
            <div class="section-box">
                <div class="section-content grid-mini">
                    <div class="nag cf">    
                        <?= VideoListWidget::widget(['videos' => $videos]) ?>
                    </div>
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