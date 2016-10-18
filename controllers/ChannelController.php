<?php

namespace app\controllers;

use Yii;
use app\models\Follower;
use app\models\Videos;
use app\models\User;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\Pagination;
use yii\web\Response;
/**
 * ChannelController implements the CRUD actions for Follower model.
 */
class ChannelController extends AuthController
{

    /**
     * Lists all Follower models.
     * @return mixed
     */
    public function actionIndex()
    {
        $follows = Follower::find()
            ->where(['follower_id'=>Yii::$app->user->id])
            ->all();

        $query = Follower::find()->where(['follower_id'=>Yii::$app->user->id]);
        $countQuery = clone $query;

        $pages = new Pagination(['totalCount' => $countQuery->count(), 'pageSize'=>27]);
        return $this->render('index', [
            'follows'=>$follows,
            'pages' => $pages
        ]);
    }

    /**
     * Displays a single Follower model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $user = User::find()
            ->where(['id' => $id])
            ->one();

        //echo "<pre>"; var_dump($isFollow ); echo "<br/>"; die('123');

        $query = Videos::find()->where(['user_id' => $id]);
        $countQuery = clone $query;

        $pages = new Pagination(['totalCount' => $countQuery->count(), 'pageSize'=>12]);
        $videos = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->all();

        return $this->render('view', [
            'pages' => $pages,
            'videos' => $videos,
            'user' => $user
        ]);

    }

    /**
     * Creates a new Follower model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionFollow()
    {
        /*Yii::$app->response->format = Response::FORMAT_JSON;
        if(Yii::$app->user->isGuest){
            return  [
                "status" => false,
                "message" => "You must login to subscribe this video"
            ];
        }*/

        $id = $_POST['id'];
        $type = $_POST['type'];
        if (Yii::$app->user->isGuest) {
            return [
                "status" => false
            ];
        }

        echo "<pre>"; var_dump(Yii::$app->user->identity->id.'--'.$id); echo "<br/>"; die('123');

        if (Yii::$app->user->identity->id == $id) {
            return [
                "status" => false,
                "message" => "You can't follow or unfollow yourself"
            ];
        }

        $followers = Follower::find()->where(['follower_id' => Yii::$app->user->identity->id, 'following_id' => $id])->one();

        if ($followers) {
            if ($type == Follower::FOLLOW) {
                return [
                    "status" => false
                ];
            }else {
                $followers->delete();
                return [
                    "status" => true
                ];
            }
        }else{
            if ($type == Follower::FOLLOW) {
                $newfollow =  new Follower;
                $newfollow->follower_id = Yii::$app->user->identity->id;
                $newfollow->following_id = $id;
                $newfollow->save();
                return [
                    "status" => true
                ];
            }else{
                return [
                    'status' => false
                ];
            }
        }
    }

    /**
     * Updates an existing Follower model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Follower model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Follower model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Follower the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Follower::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
