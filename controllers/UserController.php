<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use app\controllers\AuthController;
use yii\filters\VerbFilter;
use app\models\Country;
use app\models\State;
use app\models\Videos;
use app\models\User;
use yii\data\Pagination;
use app\models\Category;
use app\models\Follower;
use app\models\Subscription;
use yii\helpers\ArrayHelper;
use yii\web\UploadedFile;
use yii\web\Response;

class UserController extends AuthController
{
    public function actionProfile() {
        $user = User::findOne(Yii::$app->user->identity->id);

       
        $oldAvatar = $user->avatar;

        if ($user->load(Yii::$app->request->post()) ) {

            $user->avatar = UploadedFile::getInstance($user, 'avatar');
            //  Upload Avatar
            if ($user->validate()) {
                if ($user->avatar) {     
                    $fileName =   'uploads/users/' . $user->avatar->baseName .time(). '.' . $user->avatar->extension;
                    $user->avatar->saveAs( $fileName );
                    $user->avatar = $fileName;
                }else{
                    $user->avatar = $oldAvatar;
                }
                if ($user->password == "") {
                    unset($user->password);
                }
                $user->save();
                Yii::$app->session->setFlash('updateUserSuccess', 'You just updated your profile');
                return $this->refresh();
            }
        } 

        return $this->render('profile', [
            'user' => $user
        ]);
    }

    public function actionMyvideo() {
        $query = Videos::find()->where(['user_id' => Yii::$app->user->identity->id]);
        $countQuery = clone $query;

        $pages = new Pagination(['totalCount' => $countQuery->count(), 'pageSize'=>12]);
        $videos = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->all();

        return $this->render('myvideo', [
            'pages' => $pages,
            'videos' => $videos
        ]);

    }

    public function actionSubscription() {
        $subscriptions = Subscription::find()->select(['video_id'])->where(['user_id' => Yii::$app->user->identity->id])->asArray()->all();

        $video_ids = ArrayHelper::getColumn($subscriptions, 'video_id');


        $query = Videos::find()->where(['id' => $video_ids])->orderBy('created_at DESC');
        $countQuery = clone $query;


        $pages = new Pagination(['totalCount' => $countQuery->count(), 'pageSize'=>12]);
        $videos = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->all();

         return $this->render('subscription', [
            'pages' => $pages,
            'videos' => $videos
        ]);
    }

    /**
     * Creates a new Follower model.
     * @param id
     * @param type
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionFollow()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $id = $_POST['id'];
        $type = $_POST['type'];
        if (Yii::$app->user->isGuest) {
            return [
                "status" => false
            ];
        }
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

	public function actionState()
    {
       	
    }
    
}
