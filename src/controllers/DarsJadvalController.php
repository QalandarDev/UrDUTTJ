<?php

namespace app\controllers;

use aki\telegram\Telegram;
use aki\telegram\types\CallbackQuery;
use aki\telegram\types\InlineKeyboardMarkup;
use aki\telegram\types\Message;
use app\models\BotDarsjadval;
use Yii;
use yii\base\InvalidConfigException;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Json;
use yii\helpers\Url;
use yii\helpers\VarDumper;
use yii\httpclient\Client;
use yii\httpclient\Exception;
use yii\rest\Controller;
use yii\web\Response;

class DarsJadvalController extends Controller
{
    /**
     * @var Telegram
     */
    public $bot;
    /**
     * @var Message
     */
    public $message;
    /**
     * @var CallbackQuery
     */
    public $callback_query;
    public $enableCsrfValidation = false;

    const AUTHOR = "QalandarDev";

    const BOT_NAME = "@UrDUDarsJadvaliBot";
    /**
     * @return int|string
     * @throws Exception
     * @throws InvalidConfigException
     */
    public function actionIndex()
    {
        setlocale(LC_TIME, "uz");
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $this->bot = Yii::$app->darsjadvalbot;
        if ($this->getMessage()) {
            if (!$this->getUser()) $this->AddUser();
            $result = $this->bot->sendMessage([
                'chat_id' => $this->message->getFrom()->id,
                "text" => "Assalomu alaykum UrDUDarsJadvalBotga hush kelibsiz",
                'reply_markup' => json_encode(self::DepartmentButtons())
            ]);

        } elseif ($this->getCallbackQuery()) {
            $data = Json::decode($this->callback_query->data,true);
            switch ($data['step']){
                case -1:
                    $this->bot->editMessageText([
                        'message_id'=>$this->callback_query->message['message_id'],
                        'chat_id' => $this->callback_query->from['id'],
                        'text' => "Fakultetni" . self::getFooter(),
                        'reply_markup' => json_encode(self::DepartmentButtons())
                    ]);
                    break;
                case 1:
                    $this->bot->editMessageText([
                        'message_id'=>$this->callback_query->message['message_id'],
                        'chat_id' => $this->callback_query->from['id'],
                        'text' => "Ta'lim bosqichini tanlang" . self::getFooter(),
                        'reply_markup' => json_encode(self::CourseButtons($data[0]['dep']))
                    ]);
                    break;
                case 2:
                    $this->bot->editMessageText([
                        'message_id'=>$this->callback_query->message['message_id'],
                        'chat_id' => $this->callback_query->from['id'],
                        'text' => "Ta'lim yo'nalishini tanlang" . self::getFooter(),
                        'reply_markup' => json_encode(self::GetGroups($data[0]['dep'],$data[0]['level'],$data[0]['page'])),
                        'parse_mode'=>'html'
                    ]);
                    break;
                case 3:
                    $this->bot->editMessageText([
                        'message_id'=>$this->callback_query->message['message_id'],
                        'chat_id' => $this->callback_query->from['id'],
                        'text' => self::getSchedule($data[0]['dep'],$data[0]['group'],$data[0]['day']) . self::getFooter(),
                        'parse_mode'=>'html',
                        'reply_markup' => json_encode(self::WeekdayButtons($data[0]['dep'],$data[0]['level'],$data[0]['group']))
                    ]);
                    break;

            }
        }
    }
    /**
     * @return bool
     */
    public function actionSet()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $client = new Client();
        $response = $client->createRequest()
            ->setMethod('GET')
            ->setUrl('https://api.telegram.org/bot' . Yii::$app->darsjadvalbot->botToken . '/setwebhook')
            ->setData(['url' => Url::base(true) . "/dars-jadval"])
            ->send();
        return $response->data;
    }
    public function getMessage()
    {
        $this->message = $this->bot->input->message;
        return boolval($this->message);
    }
    /**
     * @return string
     */
    static function getFooter()
    {
        return
            "\n\n©️" . self::AUTHOR
            . "\n🤖" . self::BOT_NAME;
    }
    /**
     * @return bool
     */
    public function getCallbackQuery()
    {
        $this->callback_query = $this->bot->input->callback_query;
        return boolval($this->callback_query);
    }
    /**
     * @return string
     */
    public function actionUpdate()
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $this->bot = Yii::$app->darsjadvalbot;
        return $this->bot->getUpdates();
    }

    /**
     * @param $dep
     * @param int $level
     * @param int $page
     * @return InlineKeyboardMarkup|int
     * @throws Exception
     * @throws InvalidConfigException
     */
    public function GetGroups($dep, $level=11,$page = 1)
    {
        $client = new Client();
        $response = $client->createRequest()
            ->setMethod("GET")
            ->setUrl("https://talim.urdu.uz/api/groups")
            ->setData(["dep" => $dep,"level"=>$level])
            ->send();
        if ($response->isOk and count($response->data)>0) {
            $data = array_chunk($response->data, 8, true);
            $new_data = ArrayHelper::map($data[$page - 1], 'id', 'name');
//            VarDumper::dump(self::GroupButtons($new_data, $dep,$level,ceil(count($response->data)/8)));
//            exit();
            return self::GroupButtons($new_data, $dep,$level,ceil(count($response->data)/8));
        }else{
            $this->bot->answerCallbackQuery(
                [
                    'callbackquery_id'=>$this->callback_query->id,
                    'text'=>"Ma'lumot mavjud emas"
                ]
            );
            exit();
        }
    }
    public function AddUser():void
    {
        if (!$this->getUser()) {
            $model = new BotDarsjadval();
            $model->FirstName = $this->message->getFrom()->first_name;
            $model->UserID = $this->message->getFrom()->id;
            $model->save();
        }
    }
    /**
     * @return bool
     */
    public function getUser()
    {
        $query = BotDarsjadval::find()->where(['UserID' => $this->message->getFrom()->id])->count();
        return boolval($query);
    }
    /**
     * @param int $department
     * @param int $group
     * @param int $day
     * @return string
     * @throws Exception
     * @throws InvalidConfigException
     */
    static function getSchedule($department = 1, $group = 310,$day = 0,$week=false)
    {
        $client = new Client();
        $response = $client->createRequest()
            ->setMethod('GET')
            ->setUrl('https://talim.urdu.uz/api/schedule')
            ->setData(['ScheduleSearch[_department]' => $department, 'ScheduleSearch[_group]' => $group])
            ->send();
        if ($response->isOk) {
            if ($day > 0) $day = "this week monday +" . intval($day - 1) . " day";
            else $day = 'today';
            $date = date('Y-m-d', strtotime($day));
            if (!$week) $week = date('W', strtotime($day));
            return
                "📆 " . Html::tag('i', strftime('%A,%e-%B,%G-yil', strtotime($day))) . "\n" .
                "👥 [" . Html::tag('b', $response->data[$group]['name']) . "]\n\n"
                . self::ParseSubjects($response->data[$group][$week][$date]);
        }
    }
    /**
     * @param array $subjects
     * @return string
     */
    static function ParseSubjects(array $subjects): string
    {
        $text = [];
        $digits = [
            "❶", "❷", "❸", "❹"
        ];
        $i=0;
        foreach ($subjects as $time => $subject) {
            $tmp=[];
            foreach ($subject as $key=>$value){
                $begin="╔" . Html::tag('b', $digits[$i] . ".");
                $begin.=(count($subject)>1)?"$digits[$key]":"";
                        $tmp[]=$begin .$value['name']
            . "\n╠(" . Html::tag('u', $value['trainingType']) . ")"
            . "\n╠Dars vaqti: " . $time
            . "\n╠O'qituvchi: " . Html::tag('i', $value['employee'])
            . "\n╚Xona: " . Html::tag('u', $value['auditorium']);
            }
            $i++;
            $text[]=implode("\n\n",$tmp);
        }

        return implode("\n\n", $text);

    }
    /**
     * @return InlineKeyboardMarkup
     */
    static function DepartmentButtons()
    {
        $department = [
            '1' => 'Bioinjeneriya va oziq-ovqat xavfsizligi fakulteti',
            '2' => 'Fizika-matematika fakulteti',
            '3' => 'Jismoniy madaniyat fakulteti',
            '4' => 'Kimyoviy texnologiyalar fakulteti',
            '5' => "Pedagogika fakulteti",
            '6' => "San'atshunoslik fakulteti",
            '7' => "Tabiiy fanlar fakulteti",
            '8' => 'Tarix fakulteti',
            '9' => 'Texnika fakulteti',
            '10' => 'Iqtisodiyot fakulteti',
            '11' => 'Xorijiy filologiya fakulteti',
            '12' => 'Filologiya fakulteti',
            '76' => "Magistratura",
            '77' => "Sirtqi ta'lim"
        ];
        $rows = [];
        foreach ($department as $key => $item) {
            $rows[] = self::KeyboardRow($item, Json::encode(['step' => 1,['dep'=>$key]]));
        }
        return new InlineKeyboardMarkup(
            [
                'inline_keyboard' => $rows
            ]
        );
    }
    /**
     * @param $department
     * @param $group
     * @return InlineKeyboardMarkup
     */
    static function WeekdayButtons($department,$level, $group,$day='today')
    {
        $cols = [];
        $days = range(1, 13);
        $rows[] = self::KeyboardRow("Joriy hafta", Json::encode(['alert'=>'ThisWeek']));
        foreach ($days as $i) {
            if($i%7==0) {
                $rows[] = $cols;
                $rows[] = self::KeyboardRow("Keyingi hafta", Json::encode(['alert'=>'NextWeek']));
                $cols=[];
                continue;
            }
            $cols[] = self::KeyboardColumn($i%7, Json::encode(['step'=>3,['dep'=>$department,'level'=>$level,'group'=>$group,'day'=>$i]]));
        }
        $rows[] = $cols;
        $rows[] = self::KeyboardRow('Ortga', Json::encode(['step'=>2,['dep'=>$department,'level'=>$level]]));
        return new InlineKeyboardMarkup(
            [
                'inline_keyboard' => $rows
            ]
        );
    }
    /**
     * @param array $group
     * @param int $dep
     * @param int $max
     * @return InlineKeyboardMarkup
     */
    static function GroupButtons($group = [], $dep = 0,$level=11, $max = 1)
    {
        $rows = [];
        foreach ($group as $key => $item) {
            $rows[] = self::KeyboardRow($item, Json::encode(['step'=>3,['dep' => $dep, 'level'=>$level,'group' => $key,'day'=>0]]));
        }
        if($max>1) {
            $range = range(1, $max);
            $lastRow = [];
            foreach ($range as $item) {
                $lastRow[] = self::KeyboardColumn($item, Json::encode(['step' => 2, ['dep' => $dep, 'level' => $level, 'page' => $item]]));
            }
            if (count($lastRow) > 0) $rows[] = $lastRow;
        }
        $rows[] = self::KeyboardRow("Ortga", Json::encode(['step' => 1,['dep'=>$dep]]));
        return new InlineKeyboardMarkup(
            [
                'inline_keyboard' => $rows
            ]
        );
    }
    static function CourseButtons($dep){
        $rows[] = self::KeyboardRow('1-kurs', Json::encode(['step'=>2,['dep' => $dep, 'level' => 11,'page'=>1]]));
        $rows[] = self::KeyboardRow('2-kurs', Json::encode(['step'=>2,['dep' => $dep, 'level' => 12,'page'=>1]]));
        $rows[] = self::KeyboardRow('3-kurs', Json::encode(['step'=>2,['dep' => $dep, 'level' => 13,'page'=>1]]));
        $rows[] = self::KeyboardRow('4-kurs', Json::encode(['step'=>2,['dep' => $dep, 'level' => 14,'page'=>1]]));
        $rows[] = self::KeyboardRow('5-kurs', Json::encode(['step'=>2,['dep' => $dep, 'level' => 15,'page'=>1]]));
        $rows[] = self::KeyboardRow("Bosh sahifaga", Json::encode(['step' => -1]));
        return new InlineKeyboardMarkup(
            [
                'inline_keyboard' => $rows
            ]
        );

    }
    /**
     * @param string $text
     * @param string $data
     * @param string $url
     * @return array[]
     */
    public static function KeyboardRow($text, $data, $url = '')
    {
        return [
            [
                'text' => $text,
                'callback_data' => $data,
                'url' => $url
            ]
        ];
    }
    /**
     * @param $text
     * @param $data
     * @param string $url
     * @return array
     */
    public static function KeyboardColumn($text, $data, $url = '')
    {
        return
            [
                'text' => $text,
                'callback_data' => $data,
                'url' => $url

            ];
    }
}