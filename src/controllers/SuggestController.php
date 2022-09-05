<?php

namespace mirkhamidov\dadata\controllers;

use mirkhamidov\dadata\models\GeoCountry;
use mirkhamidov\dadata\ModuleTrait;
use Yii;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\Response;

/**
 * Class SuggestController
 * @package mirkhamidov\dadata\controllers
 *
 * @mixin ModuleTrait
 */
class SuggestController extends Controller
{
    use ModuleTrait;
    
    public function actionCitizenship($term)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        
        $term = mb_strtolower(trim($term), 'UTF-8');
        
        $_attrName = 'name_' . $this->getModule()->language;
        
        $q = GeoCountry::find();
        $q->select(['value' => $_attrName]);
        $q->andWhere(['like', $_attrName, $term]);
        
        return $q->asArray()->all();
    }
    
    public function actionCity($term, $limit = 10)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        
        // https://confluence.hflabs.ru/pages/viewpage.action?pageId=529793266
        $params = [
            'from_bound' => ['value' => 'city'],
            'to_bound' => ['value' => 'city'],
        ];
    
        return $this->query($term, $limit, $params);
    }
    
    public function actionAddress($term, $limit = 10, array $params = [])
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        
        return $this->query($term, $limit, $params);
    }
    
//    public function actionStreet($term, $city, $limit = 10)
//    {
//        Yii::$app->response->format = Response::FORMAT_JSON;
//
//        $params = [
//            'from_bound' => ['value' => 'street'],
//            'to_bound' => ['value' => 'street'],
//            'locations' => [
//                ['city_fias_id' => $city]
//            ],
//            'restrict_value' => true,
//        ];
//
//        return $this->query($term, $limit, $params);
//    }
//
//    public function actionHouse($term, $region, $limit = 10)
//    {
//        Yii::$app->response->format = Response::FORMAT_JSON;
//
//        $params = [
//            'from_bound' => ['value' => 'house'],
//            'locations' => [
//                ['street_fias_id' => $region]
//            ],
//            'restrict_value' => true,
//        ];
//
//        return $this->query($term, $limit, $params);
//    }
    
    /**
     * Выполнить запрос
     * @param $q
     * @param $limit
     * @param array $_params
     * @return array
     */
    private function query($q, $limit, array $_params = [])
    {
        $params = ArrayHelper::merge([
            'query' => $q,
            'count' => $limit,
        ], $_params);
        
        $response = \Yii::$app->dadataSuggestApi->send('/rs/suggest/address', $params);
        $out = [];
        
        if (!empty($response->data['suggestions'])) {
            return $response->data['suggestions'];
        }
        
        return $out;
    }
}
