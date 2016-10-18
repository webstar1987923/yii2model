<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
$this->title = 'About';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="wrap cf mt20">
	<h2 class="section-title">
		<span class="name"> <?php echo $page->title ; ?> </span>
	</h2>
	<?php echo $page->description; ?>
</div>
