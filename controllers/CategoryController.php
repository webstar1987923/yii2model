<?php

namespace app\controllers;

use Yii;
use app\models\User;
use app\models\Category;
use app\models\Videos;
use app\models\VideosSearch;
use yii\filters\AccessControl;
use yii\web\Controller;
use app\controllers\FController;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\helpers\Url;
use yii\data\Pagination;
class CategoryController extends FController
{
    /**
     * Lists all Videos models.
     * @return mixed
     */
    public function actionIndex( $slug = null )
    {
        $category = $this->findModel($slug);

        $query = Videos::find()->where(['category_id' => $category->id, 'is_puslish'=>1]);
        $countQuery = clone $query;
        $pages = new Pagination(['totalCount' => $countQuery->count(), 'pageSize'=>12]);
        $gData = Yii::$app->request->get();
        $orderby = NULL;
        $order = 'desc';
        if (count($gData)) {
            if (array_key_exists('orderby', $gData)) {
                $orderby = $gData['orderby'];
                switch ($orderby) {
                    case 'date':
                        $query = $query->orderBy(['created_at' => SORT_DESC]);
                        break;
                    case 'views':
                        $query = $query->orderBy(['view_count' => SORT_DESC]);
                        break;
                    case 'title':
                        $query = $query->orderBy(['title' => SORT_DESC]);
                        break;
                    case 'likes':
                        # code...
                        $query = $query->select(['videos.*', 'COUNT( likes.video_id ) AS countlike'])
                            ->leftJoin('likes', '`likes`.`video_id` = `videos`.`id` AND `likes`.`type` = 1')
                            ->groupBy(['videos.id'])
                            ->orderBy(['countlike' => SORT_DESC]);
                        break;
                    case 'comments':
                        $query = $query->select(['videos.*', 'COUNT( comments.video_id ) AS countcomment'])
                            ->leftJoin('comments', '`comments`.`video_id` = `videos`.`id`')
                            ->groupBy(['videos.id'])
                            ->orderBy(['countcomment' => SORT_DESC]);
                        break;

                    default:
                        $query = $query->orderBy(['title' => SORT_DESC]);
                        break;
                }
            }else {
                $query = $query->orderBy('title');
            }
        }
        $videos = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->all();
        return $this->render('index', [
            'order' => $order,
            'orderby' => $orderby,
            'pages' => $pages,
            'category' => $category,
            'videos' => $videos
        ]);

    }

    /**
     * Finds the Category model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Category the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($slug)
    {
        if (( $model = Category::find()->where(['slug' => $slug])->one() )  !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
