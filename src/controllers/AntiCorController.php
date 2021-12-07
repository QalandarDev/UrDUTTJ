<?php

namespace app\controllers;

use aki\telegram\Telegram;
use aki\telegram\types\CallbackQuery;
use aki\telegram\types\InlineKeyboardMarkup;
use aki\telegram\types\Message;
use app\models\BotAnticor;
use app\models\BotAnticorMeta;
use Yii;
use yii\base\InvalidConfigException;
use yii\helpers\Json;
use yii\helpers\Url;
use yii\helpers\VarDumper;
use yii\httpclient\Client;
use yii\httpclient\Exception;
use yii\rest\Controller;
use yii\web\Response;

error_reporting(0);

class AntiCorController extends Controller
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

    const AUTHOR = "<a href='https://linktr.ee/QalandarDev/'>QalandarDev</a>";

    const BOT_NAME = "@UrDUAntiCorBot";

    const CHANNEL = "@korrupsiyasizUrDU";
    public static $TEXT;
    public static $LANG = '2';

    /**
     * @return int|string
     * @throws Exception
     * @throws InvalidConfigException
     */
    public function actionIndex()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $this->bot = Yii::$app->urduanticorbot;
        self::$TEXT = Json::decode(file_get_contents(Yii::getAlias('@uploads')."/app.js") ,true);
        if ($this->getMessage()) {
            if ($this->message->text == "/start") {
                if (!$this->getUser()) $this->AddUser();
                if (self::getStep($this->message->getFrom()->id)!=1) {
                    $result = $this->bot->sendMessage([
                        'chat_id' => $this->message->getFrom()->id,
                        "text" => self::$TEXT['/start'] . self::getFooter(),
                        'reply_markup' => json_encode(self::LanguageButtons()),
                        "parse_mode"=>"HTML",
                        "disable_web_page_preview"=>true,

                    ]);
                    $this->AddStep($this->message->getFrom()->id, '1');
                } else {
                    self::getLang($this->message->getFrom()->id);
                    $this->bot->sendMessage([
                        'chat_id' => $this->message->getFrom()->id,
                        'text' => self::$TEXT[self::$LANG]['warning'] . self::getFooter(),
                        "parse_mode"=>"HTML",
                        "disable_web_page_preview"=>true,

                    ]);
                }
            }
        } elseif ($this->getCallbackQuery()) {
            $data = Json::decode($this->callback_query->data, true);
            $this->SetMeta($this->callback_query->from['id'], $data['data']);
            self::getLang($this->callback_query->from['id']);
            $this->bot->editMessageText([
                'message_id'=>$this->callback_query->message['message_id'],
                'chat_id' => $this->callback_query->from['id'],
                'text' => self::$TEXT[self::$LANG]['step' . $data['step']] . self::getFooter(),
                'reply_markup' => Json::encode(self::Buttons(intval($data['step']))),
                "parse_mode"=>"HTML",
                "disable_web_page_preview"=>true,

            ]);
        }
    }

    static function getLang($id)
    {
        $model = BotAnticorMeta::find()->select('column_13')->where(['UserID' => $id])->andWhere(['not', ['column_13' => null]])->count();
        if ($model = 0) {
            self::$LANG = 1;
        } else {
            $model = BotAnticorMeta::find()->select('column_13')->where(['UserID' => $id])->one()??1;
            self::$LANG = $model->column_13;
        }
    }
    static function getStep($id){
        $model=BotAnticor::find()->select('Step')->where(['UserID'=>$id])->one();
        return $model->Step;
    }
    /**
     * @return bool
     */
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
            "\n\n©️"
            . self::AUTHOR
            . "\n🤖 " . self::BOT_NAME
            . "\n✅ " . self::CHANNEL;
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
     * @return bool
     */
    public function getUser()
    {
        $query = BotAnticor::find()->where(['UserID' => $this->message->getFrom()->id])->count();
        return boolval($query);
    }
    public function AddUser(): void
    {
        if (!$this->getUser()) {
            $model = new BotAnticor();
            $model->FirstName = $this->message->getFrom()->first_name;
            $model->UserID = $this->message->getFrom()->id;
            $model->save();
        }
    }
    public function AddStep($id, $step)
    {
        $model = BotAnticor::find()->where(['UserID' => $id])->one();
        $model->Step = $step;
        $model->save();
    }
    public function actionSet()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $client = new Client();
        $response = $client->createRequest()
            ->setMethod('GET')
            ->setUrl('https://api.telegram.org/bot' . Yii::$app->urduanticorbot->botToken . '/setwebhook')
            ->setData(['url' => Url::base(true) . "/anti-cor"])
            ->send();
        return $response->data;
    }
    public function actionUpdate()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $this->bot = Yii::$app->urduanticorbot;
        return $this->bot->getUpdates();
    }
    public function SetMeta($id, $data)
    {
        $son = BotAnticorMeta::find()->where(['UserID' => $id])->count();
        if (!boolval($son)) {
            $model = new BotAnticorMeta();
            $model->UserID = $id;
        } else {
            $model = BotAnticorMeta::find()->where(['UserID' => $id])->one();
        }
        $model->{$data['name']} = $data['value'];
        $model->save();
        echo 'Hello';
    }
    static function Buttons($id)
    {
        if($id!=13) $keys = self::$TEXT[self::$LANG]['key'][$id];
        $rows=[];
        if ($id == 1) {
            $rows = [
                self::KeyboardRow($keys['1'], Json::encode([
                    'step' => 3,
                    'data' => [
                        'name' => 'column_1',
                        'value' => 1
                    ]
                ])),
                self::KeyboardRow($keys['2'], Json::encode([
                    'step' => 4,
                    'data' => [
                        'name' => 'column_1',
                        'value' => 2
                    ]
                ])),
                self::KeyboardRow($keys['3'], Json::encode([
                    'step' => 2,
                    'data' => [
                        'name' => 'column_1',
                        'value' => 3
                    ]
                ])),
            ];
        }
        elseif($id==13){
            $rows=[
                self::KeyboardRow("Kanalga qo'shiling",'',"https://t.me/korrupsiyasizUrDU")
            ];
        }
        else{
            foreach ($keys as $key => $item) {
                $rows[] = self::KeyboardRow($item, Json::encode([
                    'step' => $id+1,
                    'data' => [
                        'name' => 'column_'.$id,
                        'value' => $key
                    ]
                ]));
            }
        }
        return new InlineKeyboardMarkup(
            [
                'inline_keyboard' => $rows
            ]
        );
    }
    static function LanguageButtons()
    {
        $keys = [
            "1" => "🇺🇿 O‘zbek tili",
            "2" => "🇷🇺 русский язык",
        ];
        foreach ($keys as $key => $item) {
            $rows[] = self::KeyboardRow($item, Json::encode([
                'step' => 1,
                'data' => [
                    'name' => 'column_13',
                    'value' => $key
                ]
            ]));
        }
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
