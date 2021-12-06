<?php

namespace app\controllers;

use app\components\web\MathCaptchaAction;
use app\controllers\base\Controller;
use app\models\forms\ContactForm;
use app\models\forms\LoginForm;
use app\models\BotAnticorMeta;
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
    public function getValue($index,$id){
        return Json::decode(file_get_contents("../uploads/app.js"), true)['1']['key'][$index][$id]??"-";

    }
    public function actionDown(){
        $this->text = Json::decode(file_get_contents("../uploads/app.js"), true)['1'];
        $cols=[
            [
                'attribute' => '#',
                'value'=>function (BotAnticorMeta $model){

                    return $model->UserID;
                }
            ],
            [
                'attribute' => 'Til:',
                'value'=>function (BotAnticorMeta $model){
                    $keys = [
                        1 => "UZ",
                        2 => "RU",
                    ];
                    return $keys[$model->column_13]??'-';
                }

            ],
            [
                'attribute' => 'Ijtimoiy mavqeyi',
                'value'=>function (BotAnticorMeta $model){
                    $value=$this->getValue(1,$model->column_1);
                    return $value;
                }

            ],
            [
                'attribute' => "Ta'lim shakli",
                'value'=>function (BotAnticorMeta $model){
                    $value=$this->getValue(2,$model->column_2);
                    return $value;
                }

            ],
            [
                'attribute' => 'Fakulteti',
                'value'=>function (BotAnticorMeta $model){
                    $value=$this->getValue(3,$model->column_3);
                    return $value;
                }

            ],
            [
                'attribute' => 'Jinsi',
                'value'=>function (BotAnticorMeta $model){
                    $value=$this->getValue(4,$model->column_4);
                    return $value;
                }

            ],
            [
                'attribute' => 'Yoshi',
                'value'=>function (BotAnticorMeta $model){
                    $value=$this->getValue(5,$model->column_5);
                    return $value;
                }

            ],
            [
                'attribute' => 'Yashash hududi',
                'value'=>function (BotAnticorMeta $model){
                    $value=$this->getValue(6,$model->column_6);
                    return $value;
                }

            ],
            [
                'attribute' => 'Korrupsiya bu..',
                'value'=>function (BotAnticorMeta $model){
                    $value=$this->getValue(7,$model->column_7);
                    return $value;
                }

            ],
            [
                'attribute' => 'Taklif etish mumkin...',
                'value'=>function (BotAnticorMeta $model){
                    $value=$this->getValue(8,$model->column_8);
                    return $value;
                }

            ],
            [
                'attribute' => "To'xtatib qoladigan sabab...",
                'value'=>function (BotAnticorMeta $model){
                    $value=$this->getValue(9,$model->column_9);
                    return $value;
                }

            ],
            [
                'attribute' => 'Duch kelganmisiz?',
                'value'=>function (BotAnticorMeta $model){
                    $value=$this->getValue(10,$model->column_10);
                    return $value;
                }

            ],
            [
                'attribute' => "Eng ko'p holat ...",
                'value'=>function (BotAnticorMeta $model){
                    $value=$this->getValue(11,$model->column_11);
                    return $value;
                }

            ],
            [
                'attribute' => 'Xabardormisiz?',
                'value'=>function (BotAnticorMeta $model){
                    $value=$this->getValue(12,$model->column_12);
                    return $value;
                }

            ],



        ];
        $exporter = (new Spreadsheet([
            'title'=>"Umumiy",
            'dataProvider' => new ActiveDataProvider([
                'query' => BotAnticorMeta::find(),
            ]),
            'columns' => $cols,
        ]))->render();
        $exporter->configure([
            'title'=>"O'zbek",
            'dataProvider' => new ActiveDataProvider([
                'query' => BotAnticorMeta::find()->andWhere(['column_13'=>1]),
            ]),
            'columns' => $cols,
        ])->render();
        $exporter->configure([
            'title'=>"Rus",
            'dataProvider' => new ActiveDataProvider([
                'query' => BotAnticorMeta::find()->andWhere(['column_13'=>2]),
            ]),
            'columns' => $cols,
        ])->render();
        foreach ($this->text['key'][3] as $item=>$value){
            $exporter->configure([ // update spreadsheet configuration
                'title' => substr($value,0,25)."...",
                'dataProvider' => new ActiveDataProvider([
                    'query' => BotAnticorMeta::find()->andWhere(['column_3' => $item]),
                ]),
                'columns' => $cols,
            ])->render();
        }
        return $exporter->send('statstika.xls');
    }
    public function FormatPercentValue($value){
        $val=number_format($value,4)*100;
        return $val." %";
    }
    public function actionDep(){
        $this->text = Json::decode(file_get_contents("../uploads/app.js"), true)['1'];
        $models=[];
        $full=[
            1=>1270,
            2=>1967,
            3=>1851,
            4=>1525,
            5=>2215,
            6=>1179,
            7=>2390,
            8=>1218,
            9=>2618,
            10=>1750,
            11=>2974,
            12=>1679,
            13=>1042,
            14=>558,
            15=>1346,
            16=>14079
        ];
        for ( $i=1;$i<=16;$i++){
            if($i>14){
                $models[]=[
                    'key'=>$i,
                    'name'=>$this->getValue(2,$i-13),
                    'full'=>$full[$i],
                ];
            }
            elseif($i>12){
                $models[]=[
                    'key'=>$i,
                    'name'=>$this->getValue(1,$i-12),
                    'full'=>$full[$i],
                ];
            }else{
                $models[]=[
                    'key'=>$i,
                    'name'=>$this->getValue(3,$i),
                    'full'=>$full[$i],
                ];
            }

        }

        $exporter = (new Spreadsheet([
            'dataProvider' => new ArrayDataProvider([
                'allModels' => $models
            ]),
            'columns' => [
                [
                    'class' => \yii2tech\spreadsheet\SerialColumn::class,
                ],
                [
                    'attribute' => 'Fakultetlar',
                    'contentOptions' => [
                        'alignment' => [
//                            'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                            'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                            'width'=>'auto',
                        ],
                        'fill' => [
                            'startColor' => ['rgb' => 'FFB266'],
                        ],
                        'width'=>'auto'
                    ],
//                    'width'=>'auto',
                    'value'=>function($models){
                        return $models['name'];
                    }
                ],
                [
                    'attribute' => 'Jami',
                    'value'=>function($models){
                        return $models['full'];
                    }
                ],
                [
                    'attribute' => "to'ldirilgan",
                    'value'=>function($models){
                        if($models['key']>14){
                            return BotAnticorMeta::find()->where(['column_2'=>$models['key']-13])->count();
                        }
                        if($models['key']>12){
                            return BotAnticorMeta::find()->where(['column_1'=>$models['key']-12])->count();
                        }
                        return BotAnticorMeta::find()->where(['column_3'=>$models['key'],'column_2'=>1])->count();
                    }
                ],
                [
                    'attribute' => "Muvaffaqiyatli",
                    'value'=>function($models){
                        if($models['key']>14){
                            return BotAnticorMeta::find()->where(['column_2'=>$models['key']-13])->andWhere(['not', ['column_12' => null]])->count();
                        }
                        if($models['key']>12){
                            return BotAnticorMeta::find()->where(['column_1'=>$models['key']-12])->andWhere(['not', ['column_12' => null]])->count();
                        }
                        return BotAnticorMeta::find()->where(['column_3'=>$models['key'],'column_2'=>1])->andWhere(['not', ['column_12' => null]])->count();
                    }
                ],
                [
                    'attribute' => "Yakunlanmagan",
                    'value'=>function($models){
                        if($models['key']>14){
                            return BotAnticorMeta::find()->where(['column_2'=>$models['key']-13,'column_12'=>null])->count();
                        }
                        if($models['key']>12){
                            return BotAnticorMeta::find()->where(['column_1'=>$models['key']-12,'column_12'=>null])->count();
                        }
                        return BotAnticorMeta::find()->where(['column_3'=>$models['key'],'column_12'=>null,'column_2'=>1])->count();
                    }
                ],
                [
                    'attribute' => "Foizlarda",
                    'value'=>function($models){
                        if($models['key']>14){
                            return $this->FormatPercentValue(BotAnticorMeta::find()->where(['column_2'=>$models['key']-13])->andWhere(['not', ['column_12' => null]])->count()/$models['full']);
                        }
                        if($models['key']>12){
                            return $this->FormatPercentValue(BotAnticorMeta::find()->where(['column_1'=>$models['key']-12])->andWhere(['not', ['column_12' => null]])->count()/$models['full']);
                        }
                        return $this->FormatPercentValue(BotAnticorMeta::find()->where(['column_3'=>$models['key'],'column_2'=>1])->andWhere(['not', ['column_12' => null]])->count()/$models['full']);
                    }
                ],
            ],
        ]))->render();
        date_default_timezone_set('Asia/Tashkent');
        return $exporter->send(date('Y-m-d H_i_s').'-stat.xls');
    }

}
