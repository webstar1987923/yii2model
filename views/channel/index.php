<?php 
use app\components\NavigationUserWidget;
use app\components\VideoListWidget;
?>
<?= NavigationUserWidget::widget(['active' => 'channel']) ?>
<div class="wrap cf">
    <div class="cat-featured wall">
        <div class="section-follower channel-follow">
            <?php if ($follows): ?>
                <div class="section-user channel-user">
                    <?php foreach( $follows as $follow): ?>
                    <a href="/channel/view?id=<?= $follow->user->id ?>"> 
                    <?php if($follow->user->avatar): ?>
                        <img id="image" src="/<?= $follow->user->avatar; ?>">
                    <?php else: ?>
                        <img id="image" src="/fassets/images/default-user-avatar.png">
                    <?php endif; ?>
                        <?= $follow->user->user_name ?>
                    </a>
                    <?php endforeach; ?>
                </div>
            <?php else : ?>
                <p class="messageError">
                    Sorry, This 's empty page because you didn't folow any user before
                </p>   
            <?php endif; ?>           
            
        </div>
    </div>
</div>