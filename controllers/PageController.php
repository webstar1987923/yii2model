<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use app\controllers\AuthController;
use yii\filters\VerbFilter;
use app\models\Page;
use yii\data\Pagination;
use app\models\Category;
use app\models\Follower;
use app\models\Subscription;
use yii\helpers\ArrayHelper;
use yii\web\UploadedFile;
use yii\web\Response;
class PageController extends FController
{
    
	public function actionShow( $slug = null )
    {
        $page = Page::findOne(['slug' => $slug]);
        if (!$page) {
            echo "show 404 error here";exit();
        }
        return $this->render('show', [
            'page' => $page,
        ]);
    }
    
}
