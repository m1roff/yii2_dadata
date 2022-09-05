<?php

namespace mirkhamidov\dadata\widgets;


use mirkhamidov\dadata\ModuleTrait;
use yii\helpers\ArrayHelper;
use yii\widgets\InputWidget;
use yii\jui\AutoComplete;

/**
 * Class SuggestWidget
 * @package mirkhamidov\dadata\widgets
 *
 * @mixin ModuleTrait
 */
class SuggestWidget extends InputWidget
{
    use ModuleTrait;
    
    const TYPE_CITY = 'city';
    const TYPE_CITIZENSHIP = 'citizenship';
    const TYPE_ADDRESS = 'address';
    
    public $type;
    
    public $dataParams = [];
    
    public $clientOptions = [];
    
    public function run()
    {
        return $this->renderWidget();
    }
    
    protected function renderWidget()
    {
        $_clientOptions = [
            'source' => $this->getSourceUrl(),
            'minLength' => 2,
        ];
        $_config = [
            'options' => ArrayHelper::merge(['class' => 'form-control'], $this->options),
            'clientOptions' => ArrayHelper::merge($_clientOptions, $this->clientOptions),
        ];
        
        if ($this->hasModel()) {
            $_config['model'] = $this->model;
            $_config['attribute'] = $this->attribute;
        } else {
            $_config['name'] = $this->name;
            $_config['value'] = $this->value;
        }
        
        return AutoComplete::widget($_config);
    }
    
    protected function getSourceUrl()
    {
        $_attr = [];
        
        if (!empty($this->dataParams)) {
            $_attr['params'] = $this->dataParams;
        }
        
        switch ($this->type) {
            case self::TYPE_CITY:
                return $this->getModule()->urlCitySuggest;
                
            case self::TYPE_CITIZENSHIP:
                return $this->getModule()->urlCitizenshipSuggest;
            
            case self::TYPE_ADDRESS:
                return $this->getModule()->getUrlAddressSuggest($_attr);
        }
        return null;
    }
}
