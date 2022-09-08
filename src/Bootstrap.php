<?php

namespace m1roff\dadata;

use Yii;
use yii\base\BootstrapInterface;


class Bootstrap implements BootstrapInterface
{
    /** @inheritdoc */
    public function bootstrap($app)
    {
        /** @var $module Module */
        if ($app->hasModule('dadata') && ($module = $app->getModule('dadata')) instanceof Module) {
            
            // url routes config
            $configUrlRule = [
                'prefix' => $module->urlPrefix,
                'rules'  => $module->urlRules,
            ];
            $configUrlRule['class'] = 'yii\web\GroupUrlRule';
            $rule = Yii::createObject($configUrlRule);
    
            $app->urlManager->addRules([$rule], false);
            // END url routes config
            
            
            // add dadataSuggestApi
            $dadataSuggestApi = $app->get('dadataSuggestApi', false);
            if (!$dadataSuggestApi) {
                $app->set('dadataSuggestApi', [
                    'class'                 => 'skeeks\yii2\dadataSuggestApi\DadataSuggestApi',
                    'authorization_token'   => $module->token,
                    'timeout'               => $module->timeout,
                ]);
            }
            // END add dadataSuggestApi
        }
        
    }
}
