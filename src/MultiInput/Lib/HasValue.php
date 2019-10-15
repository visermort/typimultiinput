<?php

namespace Visermort\TypiMultiInput\Lib;

use Lang;

trait HasValue
{
    public $title;
    public $value;
    public $attributeName;
    public $config;
    public $cssClassName;
    public $rules;

    protected function initValueOwner($title, $value, $attributeName, $config, $cssClassName)
    {
        $this->title = $title;
        $this->cssClassName = $cssClassName;
        $this->value = $value;
        $this->attributeName = $attributeName;
        $this->config = $config;
        $this->rules = $this->makeRules($config);

    }

    public function getTitle()
    {
        return Lang::get('db.'.$this->title);
    }

    protected function makeRules($config)
    {
        if (empty($config['rules'])) {
            return;
        }
        $out = [];
        $rules = explode('|', $config['rules']);
        foreach ($rules as $rule) {
            $ruleArr = explode(':', $rule);
            if (!empty(trim($ruleArr[0]))) {
                $data = !empty($ruleArr[1]) ? explode(',', trim($ruleArr[1])) : 1;
                $out[trim($ruleArr[0])] = is_array($data) && count($data) == 1 ? $data[0] : $data;
            }
        }
        return  $out;
    }

}