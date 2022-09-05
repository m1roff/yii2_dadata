<?php

namespace mirkhamidov\dadata;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * data module definition class
 *
 * @property string $urlCitySuggest
 * @property string $urlCitizenshipSuggest
 * @property string $urlAddressSuggest
 * @method string getUrlCitySuggest(array $params)
 * @method string getUrlCitizenshipSuggest(array $params)
 * @method string getUrlAddressSuggest(array $params)
 *
 * @property string $language
 */
class Module extends \yii\base\Module
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'mirkhamidov\dadata\controllers';
    
    /**
     * @var string The prefix for user module URL.
     *
     * @See [[GroupUrlRule::prefix]]
     */
//    public $urlPrefix = '7rd22';
    public $urlPrefix = 'dadata';
    
    public $token;
    public $secret;
    public $timeout = 12;
    
    public $urlRules = [
        /** @var array The rules to be used in URL management. */
//        '<action:(city|citizenship)>/<term>' => 'suggest/<action>',
        '<action>/<term>' => 'suggest/<action>',
        '<action>' => 'suggest/<action>',
    ];
    
    const AVAILABLE_LANGUAGES = ['ru', 'en'];
    const DEFAULT_LANGUAGE = 'en';
    
    private $_urlShortcuts = [
        'urlCitySuggest' => [
            'route' => 'suggest/city',
        ],
        'urlCitizenshipSuggest' => [
            'route' => 'suggest/citizenship',
        ],
        'urlAddressSuggest' => [
            'route' => 'suggest/address',
        ],
    ];
    
    /** @inheritdoc */
    public function __call($name, $args)
    {
        $_name = lcfirst(substr($name, 3));
        $_prefix = substr($name, 0, 3);
        if (isset($this->_urlShortcuts[$_name]) && $_prefix == 'get') {
            return $this->createRouteFor($_name, $args[0]);
        } else {
            return parent::__call($name, $args);
        }
    }
    
    
    /** @inheritdoc */
    public function __get($name)
    {
        if (isset($this->_urlShortcuts[$name])) {
            return $this->createRouteFor($name);
        } else {
            return parent::__get($name);
        }
    }
    
    public function getLanguage()
    {
        $_sysLng = substr(Yii::$app->language,0,2);
        if (!in_array($_sysLng, self::AVAILABLE_LANGUAGES)) {
            return self::DEFAULT_LANGUAGE;
        }
        return $_sysLng;
    }
    
    private function createRouteFor($name, array $args = [])
    {
        $_route = [$this->urlPrefix . '/' . $this->_urlShortcuts[$name]['route']];
        if (!empty($args)) {
            $_route = ArrayHelper::merge($_route, $args);
        }
        
        return Yii::$app->urlManager->createUrl($_route);
    }
    
    
}
