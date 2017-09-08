<?php

namespace mirkhamidov\dadata;

use Yii;
use Exception;

trait ModuleTrait
{
    /**
     * @var null|Module
     */
    private $_module = null;
    
    /**
     * @return null|Module
     * @throws \Exception
     */
    protected function getModule()
    {
        if ($this->_module == null) {
            $this->_module = \Yii::$app->getModule('dadata');
        }
        
        if (!$this->_module) {
            throw new Exception(Yii::t('app', 'Module not found. Add "dadata" module to config file.'));
        }
        
        return $this->_module;
    }
}
