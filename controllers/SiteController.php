<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\helpers\VarDumper;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\Test;
use app\models\Questions;
use app\models\Answers;
use app\models\ContactForm;
use app\models\Users;
use app\models\UserAnswers;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
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
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
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

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $model = new Test;
//        $model->getArray();
        $a = $model->getArray();
        return $this->render('index', ['a' => $a]);
    }

    public function actionUsers()
    {
//        $model = new Users;
//        $model->getArray();
        $a = Users::find()->asArray()->all();
        return $this->render('users', ['a' => $a]);
    }

    public function actionChangeuser(){
        $session = Yii::$app->session;
        $session->open();
        $_SESSION['user'] = $_GET['User'];
        return $this->redirect(['site/test', 'test' => $_GET['test'], 'Question' => $_GET['Question']]);
    }

    public function actionTest()
    {
        $questions = Questions::find()->where(['test_id' => $_GET['test']])->asArray()->all();
        $answers = array();
        foreach ($questions as $question){
            $a = Answers::find()->where(['questions_id' => $question['id']])->asArray()->all();
            $answers[]=$a;
        }
        $useranswers = UserAnswers::find()->asArray()->all();
        if (YII::$app->request->isAjax){
            $que2 = Answers::find()->where(['id' => $_POST['ans']])->asArray()->one();
            $save = new UserAnswers;
            $save->user_id = $_POST['usr'];
            $save->questions_id = $_POST['que'];
            $save->answer_id = $_POST['ans'];
            $save->save(false);
            if ($que2['Correct'] == 1){
                \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

                $c = true;
                return [$c,$_POST['ans']];
            }else{
                \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
                $c = false;
                return [$c,$_POST['ans']];
            }
            };

        return $this->render('test', ['questions' => $questions, 'answers' => $answers, 'useranswers' => $useranswers]);
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }
}
