<?php

namespace admin\controllers;

use  Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use common\models\User;

class SettingsController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index', 'change-email', 'change-password'],
                'rules' => [
                    // allow authenticated users
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionChangeEmail() 
    {
        if(Yii::$app->request->isPost) {
            if(User::changeAdminEmailAddress(Yii::$app->user->identity->username,Yii::$app->request->post('admin_email'))) {
                return $this->redirect('index');
            }
        } else {
            return $this->render('change_email',[
                'email' => Yii::$app->user->identity->email
            ]);
        }
      
    }

    public function actionChangePassword()
    {
        if(Yii::$app->request->isPost) {
            $request = Yii::$app->request;
            $current_p = $request->post('current_p');
            $new_p = $request->post('new_p');
            $retyped_p = $request->post('p_agin'); 
            $admin = new User;
            if($admin->changeUserPassword($current_p,$new_p,$retyped_p)) {
                return $this->redirect('index');
            }
        } else {
            return $this->render('change_password');
        }
    }
}
