<?php

namespace app\controllers;

use app\components\web\MathCaptchaAction;
use app\controllers\base\Controller;
use app\models\forms\ContactForm;
use app\models\forms\LoginForm;
use app\models\BotAnticorMeta;
use JetBrains\PhpStorm\ArrayShape;
use JetBrains\PhpStorm\Pure;
use yii\data\ArrayDataProvider;
use yii2tech\spreadsheet\Spreadsheet;
use Throwable;
use Yii;
use yii\data\ActiveDataProvider;
use yii\db\Connection;
use yii\db\Exception;
use yii\filters\AccessControl;
use yii\helpers\Json;
use yii\web\Request;
use yii\web\Response;
use yii\filters\VerbFilter;
use yii\web\ErrorAction;
use yii\web\Session;
use yii\captcha\CaptchaAction;
use yii\web\User;

class SiteController extends Controller
{

    public $text;
    public $layout='sidebar';
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
    public function actionList($pin){
        $connection = Yii::$app->getDb();
        $cmd=$connection->createCommand(
            "
            select 
	
	CONCAT_WS(' ',st.second_name,st.first_name,st.third_name) as FIO,
 	c.name as country,
	g.name as gender,
	n.name as nationality,
	ct.name as citizenship,
	pr.name as province,
	ds.name as district,
	sc.name as social_category,
	ed_type.name as education_type,
	ed_form.name as education_form,
	dp.name as department,
	cr.name as course,
	gr.name as group,
	pf.name as payment_form,
	st.birth_date,
	st.student_id_number,
	st.passport_number,
	st.passport_pin,
	st.home_address,
	st.current_address
from e_student as st
LEFT JOIN h_country as c ON st._country=c.code
LEFT JOIN h_gender as g ON st._gender=g.code
LEFT JOIN h_nationality as n ON st._nationality=n.code
LEFT JOIN h_citizenship_type as ct ON st._citizenship=ct.code
LEFT JOIN h_soato as ds ON st._district=ds.code
LEFT JOIN h_soato as pr ON st._province=pr.code
LEFT JOIN h_social_category as sc ON st._social_category=sc.code
LEFT JOIN e_student_meta as meta ON st.id=meta._student
LEFT JOIN h_education_type as ed_type ON meta._education_type=ed_type.code
LEFT JOIN h_education_form as ed_form ON meta._education_form=ed_form.code
LEFT JOIN e_department as dp ON meta._department=dp.id
LEFT JOIN h_course as cr ON meta._level=cr.code
LEFT JOIN e_group as gr ON meta._group=gr.id
LEFT JOIN h_payment_form as pf ON meta._payment_form=pf.code
WHERE 
	meta.active=true AND
	meta._student_status='11' AND 
    st.passport_pin='$pin'  
limit 1;"
        );
        $result=$cmd->queryOne();
        dd($result);
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
    public function actionQ(){

        return $this->render('about');
    }
}
