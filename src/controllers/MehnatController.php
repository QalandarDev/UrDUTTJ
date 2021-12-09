<?php

namespace app\controllers;

use DOMDocument;
use simple_html_dom;
use Yii;
use yii\helpers\VarDumper;
use yii\httpclient\Client;
use yii\rest\Controller;
use yii\web\Response;

class MehnatController extends Controller
{
    public function actionIndex()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        libxml_use_internal_errors(false);
        $client = new Client();
        $response = $client->createRequest()
            ->setMethod("GET")
            ->setUrl("http://ish.mehnat.uz/vacancy/index")
            ->setData(
                [
                    "VacancySearch[region_id]" => 16,
                    "VacancySearch[city_id]"=>127
                ])
            ->send();
        $html= new simple_html_dom();
        $html->load($response->content);
        return $html->find('table');

    }

}
