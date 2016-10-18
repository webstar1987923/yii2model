<?php

namespace app\controllers;

use Yii;
use app\models\User;
use app\models\Like;
use yii\filters\AccessControl;
use yii\web\Controller;
use app\controllers\FController;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\ChangePassForm;
use yii\helpers\Url;
use app\models\Videos;

class SiteController extends FController
{
    /*
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
                
                'only' => ['login', 'logout', 'register'],
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['login', 'register'],
                        'roles' => ['?'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['logout'],
                        'roles' => ['@'],
                    ],
                ],
            ],
           
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
           
        ];
    }
    */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionIndex()
    {
        $videos = Videos::find()->where(['is_puslish'=>1])->orderBy('id DESC')->limit(16)->all();

        $newestVideo = Videos::find()->where(['is_puslish'=>1])->orderBy('id DESC')->limit(1)->one();
        return $this->render('home', [
            'videos' => $videos,
            'newestVideo' => $newestVideo,
        ]);
    }

    public function actionRegister()
    {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        
        $model = new LoginForm();
        $user = new User(['scenario' => 'register']);
        $pData = Yii::$app->request->post();
        if(count($pData)) {
            $pData['User']['role']=User::USER;

            if($user->load($pData)) {
                $user->token = md5(uniqid());
                $user->active = 0 ;
                if ($user->save()) {
                    $fromAdmin = Yii::$app->params['adminEmail'];
                    Yii::$app->mailer->compose(['html' => '@app/mail/register'], ['user' => $user])
                     ->setFrom($fromAdmin)
                     ->setTo($user->email)
                     ->setSubject('Please confirm your email to use account on our website')
                     ->send();

                    Yii::$app->session->setFlash('registerSuccessfully', 'You have registered on our site, please go your email to active account.');
                    return $this->refresh();
                }

            } else {
                // validation failed: $errors is an array containing error messages
                $errors = $user->errors;
            }
        }
        return $this->render('login', [
            'model' => $model,
            'user' => $user,
        ]);
    }
    //  Confirm email before use account on website
    public function actionConfirm($token)
    {
        $user = User::findOne(['token'=> $token]);
        if ($user) {
            $user->active = 1;
            $user->token = '';
            unset($user->password); // do not encrypt password again
            $user->save(false);
            Yii::$app->session->setFlash('registerSuccessfully', 'You can login our website now.');
            return $this->redirect('/site/login'); 
        }else{ 
            echo 'Your token is not valid. Each token only use once';
            exit();
        }
    }

    

    public function actionLogin()
    {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $model = new LoginForm();
        $user = new User(['scenario' => 'register']);
        $pData = Yii::$app->request->post();
        if (count($pData)) {
            if (array_key_exists("rememberMe",$pData)) {
                $pData['LoginForm']['rememberMe'] = true;
            } else {
                $pData['LoginForm']['rememberMe'] = false;
            }
        }
        if ($model->load($pData) && $model->login()) {
            //return $this->goBack();
            return $this->goHome();
        } else {
            return $this->render('login', [
                'model' => $model,
                'user' => $user,
            ]);
        }
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();
        return $this->goHome();
    }

    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }

    public function actionAbout()
    {
        return $this->render('about');
    }

    public function actionTest()
    {
        /*$videos = Videos::find()->select(['videos.*', 'COUNT( likes.video_id ) AS countlike'])->leftJoin('likes', '`likes`.`video_id` = `videos`.`id`')->groupBy(['videos.id'])->orderBy('countlike')->all();*/
        $user = User::findOne(['id' => 1]);

        echo '<pre>';
        var_dump($user);
        exit();

        $videos = Videos::find()->where(['is_puslish'=>1]);
        $videos = $videos->select(['videos.*', 'COUNT( likes.video_id ) AS countlike'])
            ->leftJoin('likes', '`likes`.`video_id` = `videos`.`id`')
            ->groupBy(['videos.id'])
            ->orderBy(['countlike' => SORT_DESC])
            ->asArray()
            ->all();

        echo '<pre>';
        var_dump($videos);
        exit();

        $db = new yii\db\Connection([
            'dsn' => 'mysql:host=localhost;dbname=urknack',
            'username' => 'root',
            'password' => '',
        ]);

        // return a set of rows. each row is an associative array of column names and values.
        // an empty array is returned if no results
        $posts = $db->createCommand('SELECT videos.*, COUNT( likes.video_id ) AS countlike
            FROM videos LEFT JOIN likes ON videos.id = likes.video_id
            GROUP BY videos.id
            ORDER BY countlike DESC
            Limit 6')->queryAll();
        echo '<pre>';
        var_dump( $posts );
        exit();


    }

    public function actionForgot()
    {
        if (Yii::$app->request->isAjax) {
            $pData = Yii::$app->request->post();
            if (count($pData)) {
                $user = User::findOne(['email'=>$pData['email']]);

                if (count($user)) {
                    $user->token = md5(uniqid());
                    $user->save();
                    $from = Yii::$app->params['adminEmail'];
                    $to = $pData['email'];
                    $subbject = 'Reset password';
                    $url = \yii\helpers\Url::home(true);
                    $url = $url.'site/resetpassword?token='.$user->token;
                    $htmlBody = '<p>Please click on the link below to set new password</p><a href="'.$url.'">click here</a>';
                    $this->sendEmail($from, $to, $subbject, $htmlBody);
                    return json_encode([
                        'type'=>'success',
                        'message'=>'A message has been sent to your email containing a link to reset your password'
                        ]);
                } else {
                    return json_encode([
                        'type'=>'error',
                        'message'=>'Email address is incorrect'
                        ]);
                }
            }
        }
    }
    //
    public function actionResetpassword($token = null)
    {
        $user = User::findOne(['token'=> $token]);
        if ($user) {
            $model = new ChangePassForm();

            if ( $model->load(Yii::$app->request->post() ) && $model->validate() ) {
                $user->token = null;
                $user->password = Yii::$app->request->post()['ChangePassForm']['password'];
                $user->save(false);
                Yii::$app->session->setFlash('registerSuccessfully', 'Your passwors has been changed. You can use new password to login now');

               return $this->redirect('/site/login'); 
            } else {
                return $this->render('changepass', [
                    'model' => $model,
                ]);
            }
            
        }else{
            echo "Please show 404 error";
            exit();
        }
    }
    public function sendEmail($from, $to, $subbject, $htmlBody)
    {
        Yii::$app->mailer->compose()
             ->setFrom($from)
             ->setTo($to)
             ->setSubject($subbject)
             ->setHtmlBody($htmlBody)
             ->send();
    }
    public function actionTestsendemail()
    {
        $token = '123fdfdnfgkdgdlgmdlg';

        Yii::$app->mailer->compose(['html' => '@app/mail/register'], ['token' => $token])
             ->setFrom('from@domain.com')
             ->setTo('congkhuong1308@gmail.com')
             ->setSubject('Advanced email from Yii2-SwiftMailer')
             ->send();

        exit('123123');
    }

}
