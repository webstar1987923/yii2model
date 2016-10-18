<?php
    use yii\widgets\ActiveForm;
    use yii\helpers\ArrayHelper; // load classes
    use app\models\Category;
    use app\components\NavigationUserWidget;
?>

<?= NavigationUserWidget::widget(['active' => 'upload']) ?>

<div class='user-container'>
<div id="singleupload1">Upload</div>

<div id="status"></div>
    <div class="videos-view">
        <?php $form = ActiveForm::begin([
            'options' => [
                'class' =>  'upload-form',  
                'enctype' => 'multipart/form-data'
            ]
            ]); ?>
            <input name='Videos[id]' value type='hidden' id='video_id'>
        <div class='title field-group'>
            <?= $form->field($video, 'title')->textInput(['maxlength' => 255, 'placeholder'=>'Title']) ?>
        </div>
        <div class='description field-group'>
            <?= $form->field($video, 'description')->textArea(['rows' => '6', 'placeholder'=>'Description']) ?>
        </div>
        <div class="categories field-group">
            <div class="form-group field-videos-category_id">
                <label class="control-label" for="videos-category_id">Category</label>
                <select id="videos-category_id" class="form-control" name="Videos[category_id]">
                <option value="">-Categories-</option>
                <?php if ($categories) { ?>
                    <?php foreach ($categories as $category) { ?>
                    <option value="<?=$category->id?>"><?=$category->name?></option>
                    <?php 
                        $subs = $category->subCategories;
                        if (count($subs)) {
                    ?>
                            <?php foreach ($subs as $sub) { ?>
                                <option value="<?=$sub->id?>">-- <?=$sub->name?></option>
                            <?php } ?>
                        <?php } ?>
                    <?php } ?>
                <?php } ?>
                </select>

                <div class="help-block"></div>
            </div>        
        </div>
        <div class='publish field-group'>
            <?php
                $publishList=[
                                '1'=>'Public',
                                '2'=>'Private'
                                ];
            ?>
            <?= $form->field($video, 'is_puslish')->dropDownList($publishList) ?>
        </div>
        <button id='submit_upload' disabled>Publish</button>

        <?php ActiveForm::end(); ?>
    </div>
</div>