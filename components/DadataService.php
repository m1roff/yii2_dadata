<?php

namespace mirkhamidov\dadata\components;

use Dadata\Client;
use Dadata\Response\Name;
use yii\base\Component;
use yii\base\ErrorException;

/**
 * Class DadataService
 * @package common\components
 *
 *
 *
 * Configuration: in main-config file
 *  $config = [
 *      ...,
 *      'components' => [
 *          ...,
 *          'dadataService' => [
 *              'class' => 'common\components\DadataService',
 *              'token' => TOKEY_KEY,
 *              'secret' => SECRET_KEY,
 *          ],
 *          ...,
 *      ],
 *      ...,
 *  ];
 */

class DadataService extends Component
{
    public $token;
    
    public $secret;
    
    const GENDER_MALE = 2;
    const GENDER_FEMALE = 1;
    const GENDER_UNKNOWN = 0;
    
    /**
     * @var Client
     */
    private $client;
    
    public function init()
    {
        if (empty($this->token)) {
            throw new ErrorException('Необходимо указать token');
        }
        
        if (empty($this->secret)) {
            throw new ErrorException('Необходимо указать secret');
        }
        
        parent::init();
        $this->client = new Client(new \GuzzleHttp\Client(), [
            'token' => $this->token,
            'secret' => $this->secret,
        ]);
    }
    
    /**
     * @param $name string
     * @return int 0|1|2
     */
    public function getGenderByName($name)
    {
        /** @var Name $response */
        $response = $this->client->cleanName($name);
        
        if ($response instanceof Name) {
            if ($response->gender == Name::GENDER_FEMALE) {
                return self::GENDER_FEMALE;
            } elseif ($response->gender == Name::GENDER_MALE) {
                return self::GENDER_MALE;
            }
        }
        
        return self::GENDER_UNKNOWN;
    }
}
