<?php

namespace app\controllers;

use Yii;
use app\models\User;
use app\models\Setting;
use app\models\Subscription;
use app\models\Videos;
use app\models\Like;
use app\models\VideosSearch;
use app\models\Category;
use app\models\Comment;
use yii\filters\AccessControl;
use yii\web\Controller;
use app\controllers\FController;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\data\Pagination;
use yii\web\Response;
class VideosController extends FController
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    public function actionShow( $slug = null )
    { 
        Yii::$app->session->remove('limit');
        $setting = Setting::findOne(['id'=>1]);

        $video = Videos::findOne(['slug'=>$slug]);
        $video['view_count'] = $video['view_count'] + 1;
        $video->save();
        $limit = 10;
        $comments = Comment::find()->where(['video_id'=>$video['id']])->orderBy('id DESC'); 
        if ($comments->count()>$limit) {
           $loadmore = true;
        } else {
           $loadmore = false;
        }
        $comments = $comments->limit($limit)->all();
        $category = Category::findOne($video['category_id']);
        return $this->render('view', [
            'video' => $video,
            'category' => $category,
            'comments' => $comments,
            'setting' => $setting,
            'loadmore' => $loadmore,
        ]);
    }

    public function actionLoadcomment( $id = null )
    { 
        if (Yii::$app->request->isAjax) {
            if (Yii::$app->session->has('limit'))
            {
                $_limit = Yii::$app->session->get('limit') + 10;
            }else $_limit = 20;
            Yii::$app->session->set('limit', $_limit);
            $video = Videos::findOne($id);
            $comments = Comment::find()->where(['video_id'=>$video['id']])->orderBy('id DESC');
            if ($comments->count()>$_limit) {
               $loadmore = true;
            } else {
               $loadmore = false;
            }
            $comments = $comments->limit($_limit)->all();
            $html = '';
            foreach ($comments as $comment) {
                $html .= "<div class='comment'><a class='user' href='/user/profile/view?id=".$comment->user_id."'>".$comment->user->user_name.":</a><p class='content'><span>".$comment->content."</span></p><span class='time_comment'>".$comment->created_at."</span><div class='actions'><a class='kbtn success-kbtn edit' href='/videos/editcomment?id=".$comment->id."'>Edit</a><a class='kbtn error-kbtn delete' href='/videos/deletecomment?id=".$comment->id."'>Delete</a></div></div>";
            }
            \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            return [
                'html'=>$html,
                'loadmore'=>$loadmore,
            ];
        }
    }

    public function actionComment()
    { 
        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->post();
            $comment = new Comment();
            $comment->video_id = $data['video_id'];
            $comment->user_id = $data['user_id'];
            $comment->content = $data['content'];
            $comment->created_at = date("Y-m-d H:i:s");
            $comment->save();
            $user_name = $comment->user->user_name;
            //$comments = Comment::find()->where(['video_id'=>$comment->video_id])->all();
            \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            return [
                'comment'=>$comment,
                'user_name'=>$user_name
            ];
        }  
    }

    public function actionEditcomment( $id = null )
    { 
        $comment = Comment::findOne($id);
        if (Yii::$app->user->id == $comment['user_id'] || Yii::$app->user->identity->role == User::ADMIN) {
            $data = Yii::$app->request->post();
            $comment['content'] = $data['content'];
            $comment['updated_at'] = date("Y-m-d H:i:s");
            $comment->save();
            \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            return $comment;
        }else return $this->goHome();
    }

    public function actionDeletecomment( $id = null )
    { 
        $comment = Comment::findOne($id);
        if (Yii::$app->user->id == $comment['user_id'] || Yii::$app->user->identity->role == User::ADMIN) {
            $comment->delete();
            \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            return [
                'status'=>'deleted'
            ];
        }else return $this->goHome();
    }
    
    /**
     * Lists all Videos models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new VideosSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Videos model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Videos model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Videos();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Videos model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id = null)
    {
        $video = $this->findModel($id);
        if (Yii::$app->user->id!=$video->user_id) {
            Yii::$app->getSession()->setFlash('error', "You can't edit video #".$id.".");
            return $this->redirect('/user/myvideo');
        }
        $pData = \Yii::$app->request->post();
        if (count($pData)) {
            if ($video->load($pData) && $video->save()) {
                Yii::$app->getSession()->setFlash('success', "Your video #".$video->id." was edit successful.");
                return $this->redirect('/user/myvideo');
            }else throw new NotFoundHttpException('Edit error.');
        }
        $categories = Category::find()->where(['parent_id'=>null])->orWhere(['parent_id'=>''])->all();
        return $this->render('update', [
            'video' => $video,
            'categories' => $categories,
        ]);
    }

    /**
     * Deletes an existing Videos model.
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
     * Finds the Videos model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Videos the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Videos::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * Upload video
     * @return video
     */
    public function actionUpload()
    {
        if (\Yii::$app->user->isGuest) {
            return $this->redirect(['/site/login']);
        }
        $video = new Videos();
        if (Yii::$app->request->isPost) {
            $pData=Yii::$app->request->post();
            $model = $this->findModel($pData['Videos']['id']);
            $model->title = $pData['Videos']['title'];
            $model->description = $pData['Videos']['description'];
            $model->category_id = $pData['Videos']['category_id'];
            $model->is_puslish = $pData['Videos']['is_puslish'];
            $model->save();
        }
        $categories = Category::find()->where(['parent_id'=>null])->orWhere(['parent_id'=>''])->all();
        return $this->render('upload', [
            'video' => $video,
            'categories' => $categories,
            ]);
    }

    /**
     * Upload video
     * @return video
     */
    public function actionAjaxupload()
    {
        if (\Yii::$app->user->isGuest) {
            return $this->redirect(['/site/login']);
        }
        $user_id = Yii::$app->user->id;
        $rootPath = pathinfo(Yii::$app->request->scriptFile);
        $upload_dir = '/uploads/videos/'.$user_id.'/';
        $output_dir = $rootPath['dirname'].$upload_dir;
        $thumb_dir = $upload_dir.'thumb/';
        $image_dir = $rootPath['dirname'].$thumb_dir;
        $ffmpeg = $rootPath['dirname'].'\ffmpeg-20150601-git-d8bbb99-win64-static\bin\ffmpeg';
        if (is_dir($output_dir) === false) {
            mkdir($output_dir);
        }
        if (is_dir($image_dir) === false) {
            mkdir($image_dir);
        }
        if(isset($_FILES["myfile"]))
        {
            $ret = array();

            $error =$_FILES["myfile"]["error"];
            //You need to handle  both cases
            //If Any browser does not support serializing of multiple files using FormData() 
            if(!is_array($_FILES["myfile"]["name"])) //single file
            {
                $fileName = $_FILES["myfile"]["name"];
                $fileInfo = pathinfo($fileName);
                $fileType = $fileInfo['extension'];
                // Khuong fix file name, avoid bug when filename is complex
                $fileName = date("YmdHis"). '-'.uniqid();
                move_uploaded_file($_FILES["myfile"]["tmp_name"],$output_dir.$fileName.'.'.$fileType);
                
                if (Yii::$app->params['env'] == 'local') {
                    $cmd = $ffmpeg." -i " . $output_dir.$fileName.'.'.$fileType . " -ss 00:00:02.435 -f image2 -vframes 1 " . $image_dir.$fileName.'.jpg' . "";
                }else {
                    $cmd = "ffmpeg -i " . $output_dir.$fileName.'.'.$fileType . " -ss 00:00:02.435 -f image2 -vframes 1 " . $image_dir.$fileName.'.jpg' . "";
                }
                
                shell_exec($cmd);
                $video = new Videos();
                $video->title = $fileInfo['filename'];
                $video->ulr_video = $upload_dir.$fileName.'.'.$fileType;
                $video->ulr_image = $thumb_dir.$fileName.'.jpg';
                $video->is_puslish = 2;
                $video->user_id = $user_id;
                $video->created_at = date("Y-m-d H:i:s");
                $video->save();
                $ret[] = [
                    'id'=>$video->id
                ];
            }
            else  //Multiple files, file[]
            {
              $fileCount = count($_FILES["myfile"]["name"]);
              for($i=0; $i < $fileCount; $i++)
              {
                $fileName = $_FILES["myfile"]["name"][$i];
                move_uploaded_file($_FILES["myfile"]["tmp_name"][$i],$output_dir.$fileName);
                $ret[]= $fileName;
              }
            
            }
            echo json_encode($ret);
         }
    }

    /**
     * Like or Dislike video .
     * @param integer $id: Video Id
     * @param integer $type 1 OR -1
     * @method POST
     * @return result
     */
    public function actionLike() { 
        Yii::$app->response->format = Response::FORMAT_JSON;
        if(Yii::$app->user->isGuest){
            return  [
                "status" => false,
                "message" => "You must login to like or dislike this video"
            ];
        }
        $id = $_POST['id'];
        $type = $_POST['type'];

        $like = Like::find()->where(['user_id' => Yii::$app->user->identity->id, 'video_id' => $id])->one();

        if ($like) {
            if ($like->type == Like::LIKE) {
                if ($type == Like::LIKE) {
                    return [
                        "status" => false,
                        "message" => "You like this video before"
                    ];
                }else{
                    $like->delete();
                    return [
                        "status" => false,
                        "change" => true,
                        "message" => "You just change like to dislike this video. Please like or dislike again"
                    ];
                }
            }else {
                if ($type == Like::LIKE) {
                    $like->delete();
                    return [
                        "status" => false,
                        "change" => true,
                        "message" => "You just change dislike to like this video. Please like or dislike again"
                    ];
                }else{
                    return [
                        "status" => false,
                        "message" => "You dislike this video before"
                    ];
                }
            }
        }else{
            $newLike = new Like();
            $newLike->user_id = Yii::$app->user->identity->id;
            $newLike->video_id = $id;
            $newLike->type = $type;
            $newLike->save();
            if ($type == Like::LIKE) {
                return [
                    "status" => true,
                    "message" => "You just like this video"
                ];
            }else {
                return [
                    "status" => true,
                    "message" => "You just dislike this video"
                ];
            }
        }

    }
    /**
     * Subscribe or UnSubscribe function .
     * @param integer $id: Video Id
     * @param string $type subscribe OR unsubscribe
     * @return result
     */
    
    public function actionSubscribe()
    {   
        Yii::$app->response->format = Response::FORMAT_JSON;
        if(Yii::$app->user->isGuest){
            return  [
                "status" => false,
                "message" => "You must login to subscribe this video"
            ];
        }

        $id = $_POST['id'];
        $type = $_POST['type'];
        if (Yii::$app->user->isGuest) {
            return false;
        }
        $subscription = Subscription::find()->where(['user_id' => Yii::$app->user->identity->id, 'video_id' => $id])->one();

        if ($subscription) {
            if ($type == Subscription::SUBSCRIBE) {
                return [
                    "status" => false
                ];
            }else {
                $subscription->delete();
                return [
                    "status" => true
                ];
            }
        }else{
            if ($type == Subscription::SUBSCRIBE) {
                $newsubscription =  new Subscription;
                $newsubscription->user_id = Yii::$app->user->identity->id;
                $newsubscription->video_id = $id;
                $newsubscription->save();
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
     * Searching function .
     * @param integer $state_id
     * @param integer $category_id
     * @param string  $keyword
     * @return mixed
     */
    public function actionSearch()
    {
        $state_id = $_GET['state_id'];
        $category_id = $_GET['category_id'];
        $keyword = $_GET['keyword'];

        $query = Videos::find();
        //  Search by state
        if (!empty($state_id)) {
            $query = $query->joinWith([
                'user' => function ($query) use ($state_id ) {
                    $query->andWhere(['state_id' => $state_id ]);
                },
            ]);
        }
        //  Only get video with is_puslish == 1
        $query = $query->where(['is_puslish' => Videos::IS_PUSLISH]);
        //  Search by category
        if (!empty($category_id)) {
            $query = $query->where(['category_id' => $category_id]);
        }
        //  Search by keyword
        if (!empty($keyword)) {
            $query = $query->where(['like', 'title', $keyword]);
        }
        
        //  Pagination
        $countQuery = clone $query;
        $pages = new Pagination(['totalCount' => $countQuery->count(), 'pageSize'=>4]);

        //  Get videos list
        $videos = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->all();

        return $this->render('search', [
            'keyword' => $keyword,
            'pages' => $pages,
            'videos' => $videos
        ]);
    }
}
