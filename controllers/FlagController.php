<?php

namespace app\controllers;

use Yii;
use app\models\Flag;
use app\models\Videos;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * FlagController implements the CRUD actions for Flag model.
 */
class FlagController extends FController
{
    
    /**
     * Creates a new Flag model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate( $slug = null )
    {
        $video = Videos::findOne(['slug'=>$slug]);
        if ($video) {
            $model = new Flag();
            $model->contact = 0; // Default contact
            if ( $model->load(Yii::$app->request->post()) ) { 
                $model->status = $model::STATUS_UNACTIVE;
                $model->ulr_video = Yii::$app->request->referrer;
                
                if ( $model->save() ) {
                    Yii::$app->session->setFlash('flagSuccessfully', 'You have successfully flag. we will consider and resolve');
                    return $this->refresh();
                } 
            }
            return $this->render('create', [
                'model' => $model,
            ]);
        }else{
            echo "404 error";
            exit();
        }
    }

    /**
     * Finds the Flag model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Flag the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Flag::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
