<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\User;
use app\models\UserMessage;
use app\models\Message;
use yii\data\Pagination;
use yii\web\NotFoundHttpException;
class MessageController extends FController
{
    public function actionInbox() 
    {
        $userMessages = UserMessage::find()->where(['user_id'=>Yii::$app->user->id,'placeholder'=>UserMessage::INBOX])->orderBy('update_at DESC')->all();
        return $this->render('inbox', [
            'userMessages'=>$userMessages
        ]);
    }

    public function actionOutbox() 
    {
        $userMessages = UserMessage::find()->where(['user_id'=>Yii::$app->user->id,'placeholder'=>UserMessage::OUTBOX])->orderBy('update_at DESC')->all();
        return $this->render('outbox', [
            'userMessages'=>$userMessages
        ]);

    }

    public function actionCheckUserReceive() 
    {
        $pData = Yii::$app->request->post();
        if (count($pData)) {
            $user = User::findOne(['user_name'=>$pData['user_name']]);
            if (count($user)) {
                if ($user->id==Yii::$app->user->id) {
                    $response = [
                        'found'=>false,
                        'error'=>"You can't send message to yourself"
                    ];
                } else {
                    $response = [
                        'found'=>true,
                        'user_receive_id'=>$user->id
                    ];
                }
            } else {
                $response = [
                    'found'=>false,
                    'error'=>'No user found'
                ];
            }
            \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            return $response;
        }
    }

    public function actionSend($message_id = null, $receive = null) 
    {
        if (is_null($message_id)) {
            $subject = null;
        } else {
            $subject = Message::findOne($message_id)->subject;
        }
        if (is_null($receive)) {
            $user_name = null;
        } else {
            $user_name = User::findOne($receive)->user_name;
        }
        $message = new Message();
        $pData = Yii::$app->request->post();
        if(count($pData)) {
            if($message->load($pData)) {
                $message->author_id = Yii::$app->user->id;
                $message->parent_id = $message_id;
                if ($message->save()) {
                    if (is_null($message_id)) {
                        $message_id = $message->id;
                    }
                    $userMessagesCount = UserMessage::find()->where(['message_id'=>$message_id])->count();
                    if ($userMessagesCount<=2) {
                        $userMessage1 = new UserMessage();
                        $userMessage1->message_id = $message_id;
                        $userMessage1->read = UserMessage::UNREAD;
                        $userMessage1->placeholder = UserMessage::OUTBOX;
                        $userMessage1->user_id = Yii::$app->user->id;
                        $userMessage1->save();
                        $userMessage2 = new UserMessage();
                        $userMessage2->message_id = $message_id;
                        $userMessage2->read = UserMessage::UNREAD;
                        $userMessage2->placeholder = UserMessage::INBOX;
                        if (is_null($receive)) {
                            $userMessage2->user_id = $pData['user_receive_id'];
                        } else {
                            $userMessage2->user_id = $receive;
                        }
                        $userMessage2->save();
                    }else{
                        $userMessages = UserMessage::find()->where(['message_id'=>$message_id])->all();
                        foreach ($userMessages as $userMessage) {
                            if ($userMessage->user_id!==Yii::$app->user->id && $userMessage->placeholder==UserMessage::INBOX) {
                                $userMessage->read = UserMessage::UNREAD;
                                $userMessage->save();
                            }elseif ($userMessage->user_id==Yii::$app->user->id && $userMessage->placeholder==UserMessage::OUTBOX) {
                                $userMessage->save();
                            }
                        }
                    }
                    return $this->redirect(['inbox']);
                }

            } else {
                // validation failed: $errors is an array containing error messages
                $errors = $message->errors;
            }
        }
         return $this->render('send', [
            'message'=>$message,
            'subject'=>$subject,
            'user_name'=>$user_name,
            'message_id'=>$message_id,
            'receive'=>$receive,
        ]);
    }

    public function actionView($message_id=null)
    {
        $messages = Message::find()
        ->where(['id'=>$message_id])
        ->orWhere(['parent_id'=>$message_id])
        ->all();
        $userMessage = UserMessage::findOne([
                            'message_id'=>$message_id,
                            'user_id'=>Yii::$app->user->id,
                            'placeholder'=>UserMessage::INBOX,
                            'read'=>UserMessage::UNREAD,
                            ]);
        if (count($userMessage)) {
            $userMessage->detachBehaviors();
            $userMessage->read = UserMessage::READ;
            $userMessage->save();
        }
        return $this->render('view', [
            'messages'=>$messages
        ]);
    }

	public function actionDelete($message_id=null, $placeholder=null)
    {
        $userMessages = UserMessage::find()
                        ->where([
                            'message_id'=>$message_id,
                            'user_id'=>Yii::$app->user->id,
                            'placeholder'=>$placeholder,
                            ])
                        ->all();
        foreach ($userMessages as $userMessage) {
            $userMessage->placeholder = UserMessage::DELETED;
            $userMessage->save();
        }
        return json_encode('ok');
        //return $this->redirect(['inbox']);
    }
    
}
