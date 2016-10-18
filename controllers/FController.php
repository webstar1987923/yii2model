<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\Country;
use app\models\State;
use app\models\Category;
use app\models\Blockip;
use yii\base\Widget;

class FController extends Controller
{
    public $layout = 'frontend';
    public function init(){
    	//	Block Ip
    	$session = Yii::$app->session;
		if (isset($session['block'])) {
			if ($session['block'] == true) {
				exit('Your account has been locked');
			}
    	} else {
    		$ip = Blockip::find()->where(['ip' => Yii::$app->request->getUserIP()])->count();
    		if($ip) {
    			$session->set('block', true);
    			exit('Your account has been locked');
    		} else {
    			$session->set('block', false);
    		}
    	}
        //Yii::app()->theme = 'front-end';
        
    	//	get countries list
		$countries = Country::find()->orderBy('country')->all();
		Yii::$app->view->params['country_k'] =  $countries;

		//	get state list
		$states = State::find()->where(['country_id' => 840])->orderBy('name')->all();
		$statesBuffer = '';
		foreach ($states as $key => $state) {
			$statesBuffer .= '<option value="'.$state->id.'">'.$state->name.'</option>';
		}
		Yii::$app->view->params['state_k'] =  $statesBuffer;

		//	get categories list
		
		$categories = Category::find()->orderBy('order')->all();
		$categoriesBuffer = '';
		foreach ($categories as $key => $category) {
			$categoriesBuffer .= '<option value="'.$category->id.'">'.$category->name.'</option>';
		}
		Yii::$app->view->params['category_k'] =  $categoriesBuffer;

        parent::init();
    }

    

}
