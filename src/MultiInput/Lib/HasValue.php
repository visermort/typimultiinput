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

    protected function initValueOwner($title, $value, $attributeName, $config, $cssClassName)
    {
        $this->title = $title;
        $this->cssClassName = $cssClassName;
        $this->value = $value;
        $this->attributeName = $attributeName;
        $this->config = $config;
    }

    public function getTitle()
    {
        return Lang::get('db.'.$this->title);
    }

}