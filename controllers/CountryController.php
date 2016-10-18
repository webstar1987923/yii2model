<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use app\controllers\FController;
use yii\filters\VerbFilter;
use app\models\Country;
use app\models\State;

use app\models\Category;
class CountryController extends FController
{
    
	public function actionState()
    {
       	$country_id = $_GET['country_id'];
       	$state_id = isset($_GET['state_id']) ? $_GET['state_id'] : '' ;
       	$states = State::find()->where(['country_id' => $country_id])->orderBy('name')->all();

       	return $this->renderPartial('state', [
            'states' => $states,
            'state_id' => $state_id
        ]);
    }
    

}
