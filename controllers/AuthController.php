<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use app\controllers\FController;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\Country;
use app\models\State;

use app\models\Category;
class AuthController extends FController
{
    public function init(){
        parent::init();
        if(Yii::$app->user->isGuest){
        	return $this->redirect('/site/login'); 
        }
    }
}