<?php

namespace app\controllers;

use Yii;
use app\controllers\FController;
use app\models\Contact;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ContactController implements the CRUD actions for Contact model.
 */
class ContactController extends FController
{
    /**
     * Creates a new Contact model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Contact();
        $pData = Yii::$app->request->post();

        if ($model->load($pData)){
            $model->isread = 0;
            if ($model->save()) {

                $toAdmin = Yii::$app->params['adminEmail'];
                    Yii::$app->mailer->compose(['html' => '@app/mail/contact'], ['model' => $model])
                        ->setFrom($model->email)
                        ->setTo($toAdmin)
                        ->setSubject($model->subject)
                        ->send();

                Yii::$app->session->setFlash('contactSuccessfully', 'You have successfully contact. we will consider and resolve');
                return $this->refresh();
            } 
        } 
        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Finds the Contact model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Contact the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Contact::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
