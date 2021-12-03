<?php

namespace app\components\web;

use Exception;
use Yii;
use yii\base\InvalidConfigException;
use yii\captcha\CaptchaAction;
use yii\helpers\Url;
use yii\web\Response;

class MathCaptchaAction extends CaptchaAction
{

    public const RANDOM_ARRAY = [
        1 => [
            'title' => 4,
            'items' => [2, 2],
        ],
        2 => [
            'title' => 6,
            'items' => [2, 3],
        ],
        3 => [
            'title' => 8,
            'items' => [2, 4],
        ],
        4 => [
            'title' => 9,
            'items' => [3, 3],
        ],
        5 => [
            'title' => 10,
            'items' => [2, 5],
        ],
        6 => [
            'title' => 12,
            'items' => [2, 3, 4, 6],
        ],
        7 => [
            'title' => 14,
            'items' => [2, 7],
        ],
        8 => [
            'title' => 15,
            'items' => [3, 5],
        ],
        9 => [
            'title' => 16,
            'items' => [2, 4, 8],
        ],
        10 => [
            'title' => 18,
            'items' => [2, 3, 6, 9],
        ],
        11 => [
            'title' => 20,
            'items' => [2, 4, 5, 10],
        ],
        12 => [
            'title' => 21,
            'items' => [3, 7],
        ],
        13 => [
            'title' => 22,
            'items' => [2, 11],
        ],
        14 => [
            'title' => 24,
            'items' => [2, 3, 4, 6, 8, 12],
        ],
        15 => [
            'title' => 25,
            'items' => [5,5],
        ],
        16 => [
            'title' => 26,
            'items' => [2, 13],
        ],
        17 => [
            'title' => 27,
            'items' => [3, 9],
        ],
        18 => [
            'title' => 28,
            'items' => [2, 4, 7, 14],
        ],
        19 => [
            'title' => 30,
            'items' => [2, 3, 5, 6, 10, 15],
        ],
        20 => [
            'title' => 32,
            'items' => [2, 4, 8, 16],
        ],
        21 => [
            'title' => 33,
            'items' => [3, 11],
        ],
        22 => [
            'title' => 34,
            'items' => [2, 17],
        ],
        23 => [
            'title' => 35,
            'items' => [5, 7],
        ],
        24 => [
            'title' => 36,
            'items' => [ 4, 6, 9],
        ],
        25 => [
            'title' => 38,
            'items' => [2, 19],
        ],
        26 => [
            'title' => 39,
            'items' => [3, 13],
        ],
        27 => [
            'title' => 40,
            'items' => [2, 4, 5, 8, 10, 20],
        ],
        28 => [
            'title' => 42,
            'items' => [2, 3, 6, 7, 14, 21],
        ],
        29 => [
            'title' => 44,
            'items' => [2, 4, 11, 22],
        ],
        30 => [
            'title' => 45,
            'items' => [3, 5, 9, 15],
        ],
        31 => [
            'title' => 46,
            'items' => [2, 23],
        ],
        32 => [
            'title' => 48,
            'items' => [2, 3, 4, 6, 8, 12, 16, 24],
        ],
        33 => [
            'title' => 49,
            'items' => [7,7],
        ],
        34 => [
            'title' => 50,
            'items' => [2, 5, 10, 25],
        ],
//        35 => [
//            'title' => 51,
//            'items' => [3, 17],
//        ],
//        36 => [
//            'title' => 52,
//            'items' => [2, 4, 13, 26],
//        ],
//        37 => [
//            'title' => 54,
//            'items' => [2, 3, 6, 9, 18, 27],
//        ],
//        38 => [
//            'title' => 55,
//            'items' => [5, 11],
//        ],
//        39 => [
//            'title' => 56,
//            'items' => [2, 4, 7, 8, 14, 28],
//        ],
//        40 => [
//            'title' => 57,
//            'items' => [3, 19],
//        ],
//        41 => [
//            'title' => 58,
//            'items' => [2, 29],
//        ],
//        42 => [
//            'title' => 60,
//            'items' => [2, 3, 4, 5, 6, 10, 12, 15, 20, 30],
//        ],
//        43 => [
//            'title' => 62,
//            'items' => [2, 31],
//        ],
//        44 => [
//            'title' => 63,
//            'items' => [3, 7, 9, 21],
//        ],
//        45 => [
//            'title' => 64,
//            'items' => [2, 4, 8, 16, 32],
//        ],
//        46 => [
//            'title' => 65,
//            'items' => [5, 13],
//        ],
//        47 => [
//            'title' => 66,
//            'items' => [2, 3, 6, 11, 22, 33],
//        ],
//        48 => [
//            'title' => 68,
//            'items' => [2, 4, 17, 34],
//        ],
//        49 => [
//            'title' => 69,
//            'items' => [3, 23],
//        ],
//        50 => [
//            'title' => 70,
//            'items' => [2, 5, 7, 10, 14, 35],
//        ],
//        51 => [
//            'title' => 72,
//            'items' => [2, 3, 4, 6, 8, 9, 12, 18, 24, 36],
//        ],
//        52 => [
//            'title' => 74,
//            'items' => [2, 37],
//        ],
//        53 => [
//            'title' => 75,
//            'items' => [3, 5, 15, 25],
//        ],
//        54 => [
//            'title' => 76,
//            'items' => [2, 4, 19, 38],
//        ],
//        55 => [
//            'title' => 77,
//            'items' => [7, 11],
//        ],
//        56 => [
//            'title' => 78,
//            'items' => [2, 3, 6, 13, 26, 39],
//        ],
//        57 => [
//            'title' => 80,
//            'items' => [2, 4, 5, 8, 10, 16, 20, 40],
//        ],
//        58 => [
//            'title' => 81,
//            'items' => [3, 9, 27],
//        ],
//        59 => [
//            'title' => 82,
//            'items' => [2, 41],
//        ],
//        60 => [
//            'title' => 84,
//            'items' => [2, 3, 4, 6, 7, 12, 14, 21, 28, 42],
//        ],
//        61 => [
//            'title' => 85,
//            'items' => [5, 17],
//        ],
//        62 => [
//            'title' => 86,
//            'items' => [2, 43],
//        ],
//        63 => [
//            'title' => 87,
//            'items' => [3, 29],
//        ],
//        64 => [
//            'title' => 88,
//            'items' => [2, 4, 8, 11, 22, 44],
//        ],
//        65 => [
//            'title' => 90,
//            'items' => [2, 3, 5, 6, 9, 10, 15, 18, 30, 45],
//        ],
//        66 => [
//            'title' => 91,
//            'items' => [7, 13],
//        ],
//        67 => [
//            'title' => 92,
//            'items' => [2, 4, 23, 46],
//        ],
//        68 => [
//            'title' => 93,
//            'items' => [3, 31],
//        ],
//        69 => [
//            'title' => 94,
//            'items' => [2, 47],
//        ],
//        70 => [
//            'title' => 95,
//            'items' => [5, 19],
//        ],
//        71 => [
//            'title' => 96,
//            'items' => [2, 3, 4, 6, 8, 12, 16, 24, 32, 48],
//        ],
//        72 => [
//            'title' => 98,
//            'items' => [2, 7, 14, 49],
//        ],
//        73 => [
//            'title' => 99,
//            'items' => [3, 9, 11, 33],
//        ],
//        74 => [
//            'title' => 100,
//            'items' => [2, 4, 5, 10, 20, 25, 50],
//        ],
    ];
    public const RANDOM_DIV = [
        4 => [
            2,2
        ],
        6 => [
            2, 3
        ],
        8 => [
            2, 4,
        ],
        9 => [
            3,3
        ],
        10 => [
            2, 5,
        ],
        12 => [
            2, 3, 4, 6,
        ],
        14 => [
            2, 7,
        ],
        15 => [
            3, 5,
        ],
        16 => [
            2, 4, 8,
        ],
        18 => [
            2, 3, 6, 9,
        ],
        20 => [
            2, 4, 5, 10,
        ],
        21 => [
            3, 7,
        ],
        22 => [
            2, 11,
        ],
        24 => [
            2, 3, 4, 6, 8, 12,
        ],
        25 => [
            5,5
        ],
        26 => [
            2, 13,
        ],
        27 => [
            3, 9,
        ],
        28 => [
            2, 4, 7, 14,
        ],
        30 => [
            2, 3, 5, 6, 10, 15,
        ],
        32 => [
            2, 4, 8, 16,
        ],
        33 => [
            3, 11,
        ],
        34 => [
            2, 17,
        ],
        35 => [
            5, 7,
        ],
        36 => [
            2, 3, 4, 6, 9, 12, 18,
        ],
        38 => [
            2, 19,
        ],
        39 => [
            3, 13,
        ],
        40 => [
            2, 4, 5, 8, 10, 20,
        ],
        42 => [
            2, 3, 6, 7, 14, 21,
        ],
        44 => [
            2, 4, 11, 22,
        ],
        45 => [
            3, 5, 9, 15,
        ],
        46 => [
            2, 23,
        ],
        48 => [
            2, 3, 4, 6, 8, 12, 16, 24,
        ],
        49 => [
            7,7
        ],
        50 => [
            2, 5, 10, 25,
        ],
        51 => [
            3, 17,
        ],
        52 => [
            2, 4, 13, 26,
        ],
        54 => [
            2, 3, 6, 9, 18, 27,
        ],
        55 => [
            5, 11,
        ],
        56 => [
            2, 4, 7, 8, 14, 28,
        ],
        57 => [
            3, 19,
        ],
        58 => [
            2, 29,
        ],
        60 => [
            2, 3, 4, 5, 6, 10, 12, 15, 20, 30,
        ],
        62 => [
            2, 31,
        ],
        63 => [
            3, 7, 9, 21,
        ],
        64 => [
            2, 4, 8, 16, 32,
        ],
        65 => [
            5, 13,
        ],
        66 => [
            2, 3, 6, 11, 22, 33,
        ],
        68 => [
            2, 4, 17, 34,
        ],
        69 => [
            3, 23,
        ],
        70 => [
            2, 5, 7, 10, 14, 35,
        ],
        72 => [
            2, 3, 4, 6, 8, 9, 12, 18, 24, 36,
        ],
        74 => [
            2, 37,
        ],
        75 => [
            3, 5, 15, 25,
        ],
        76 => [
            2, 4, 19, 38,
        ],
        77 => [
            7, 11,
        ],
        78 => [
            2, 3, 6, 13, 26, 39,
        ],
        80 => [
            2, 4, 5, 8, 10, 16, 20, 40,
        ],
        81 => [
            3, 9, 27,
        ],
        82 => [
            2, 41,
        ],
        84 => [
            2, 3, 4, 6, 7, 12, 14, 21, 28, 42,
        ],
        85 => [
            5, 17,
        ],
        86 => [
            2, 43,
        ],
        87 => [
            3, 29,
        ],
        88 => [
            2, 4, 8, 11, 22, 44,
        ],
        90 => [
            2, 3, 5, 6, 9, 10, 15, 18, 30, 45,
        ],
        91 => [
            7, 13,
        ],
        92 => [
            2, 4, 23, 46,
        ],
        93 => [
            3, 31,
        ],
        94 => [
            2, 47,
        ],
        95 => [
            5, 19,
        ],
        96 => [
            2, 3, 4, 6, 8, 12, 16, 24, 32, 48,
        ],
        98 => [
            2, 7, 14, 49,
        ],
        99 => [
            3, 9, 11, 33,
        ],
        100 => [
            2, 4, 5, 10, 20, 25, 50,
        ],
    ];
    public $minLength = 1;
    public $maxLength = 34;

    /**
     * @inheritdoc
     * @throws Exception
     */
    protected function generateVerifyCode(): int|string
    {

        return self::RANDOM_ARRAY[(int)random_int((int)$this->minLength, (int)$this->maxLength)]['title'];
    }

    /**
     * @inheritdoc
     * @throws Exception
     */
    protected function renderImage($code): string
    {
        return parent::renderImage($this->getText($code));
    }

    /**
     * @throws Exception
     */
    protected function getText($code): string
    {
        $code = (int)$code;
        $div = self::RANDOM_DIV[$code];
        $rand = random_int(0, count(self::RANDOM_DIV[$code]) - 1);
        return $code / $div[$rand] . '*' . $div[$rand];

    }

    public function generateValidationHash($code): int|string
    {
        $code = (string)$code;
        for ($h = 0, $i = strlen($code) - 1; $i >= 0; --$i) {
            $h += ord($code[$i]);
        }

        return $h;
    }

    /**
     * Runs the action.
     * @throws InvalidConfigException
     */
    public function run(): array|string
    {
        if (Yii::$app->request->getQueryParam(self::REFRESH_GET_VAR) !== null) {
            // AJAX request for regenerating code
            $code = $this->getVerifyCode(true);
            Yii::$app->response->format = Response::FORMAT_JSON;
            return [
                'hash1' => $this->generateValidationHash($code),
                'hash2' => $this->generateValidationHash($code),
                // we add a random 'v' parameter so that FireFox can refresh the image
                // when src attribute of image tag is changed
                'url' => Url::to([$this->id, 'v' => uniqid('', true)]),
            ];
        }

        $this->setHttpHeaders();
        Yii::$app->response->format = Response::FORMAT_RAW;

        return $this->renderImage($this->getVerifyCode());
    }

    /**
     * Validates the input to see if it matches the generated code.
     * @param string $input user input
     * @param bool $caseSensitive whether the comparison should be case-sensitive
     * @return bool whether the input is valid
     */
    public function validate($input, $caseSensitive)
    {

//        dd("salom");
        $code = $this->getVerifyCode();
        $valid = $caseSensitive ? ($input === $code) : strcasecmp($input, $code) === 0;
        $session = Yii::$app->getSession();
        $session->open();
        $name = $this->getSessionKey() . 'count';
        $session[$name] += 1;
        if ($valid || ($session[$name] > $this->testLimit && $this->testLimit > 0)) {
            $this->getVerifyCode(true);
        }

        return $valid;
    }
}
