<?php

namespace app\controllers;

use app\components\web\MathCaptchaAction;
use app\controllers\base\Controller;
use app\models\forms\ContactForm;
use app\models\forms\LoginForm;
use JetBrains\PhpStorm\ArrayShape;
use JetBrains\PhpStorm\Pure;
use Throwable;
use Yii;
use yii\db\Connection;
use yii\db\Exception;
use yii\filters\AccessControl;
use yii\web\Request;
use yii\web\Response;
use yii\filters\VerbFilter;
use yii\web\ErrorAction;
use yii\web\Session;
use yii\captcha\CaptchaAction;
use yii\web\User;

class SiteController extends Controller
{

    public function behaviors(): array
    {
        return [
            'access' => [
                'class' => AccessControl::class,
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
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions(): array
    {
        return [
            'error' => [
                'class' => ErrorAction::class,
            ],
            'captcha' => [
                'class' => CaptchaAction::class,
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex(): string
    {
        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @param Request $request
     * @param User $user
     * @return Response|string
     */
    public function actionLogin(Request $request, User $user): Response|string
    {
        if (!$user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load($request->post()) && $model->login()) {
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
     * @param User $user
     * @return Response
     */
    public function actionLogout(User $user): Response
    {
        $user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @param Request $request
     * @return Response|string
     */
    public function actionContact(Request $request): Response|string
    {
        $model = new ContactForm();
        if ($model->load($request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
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
    public function actionAbout(): string
    {
        return $this->render('about');
    }

}
