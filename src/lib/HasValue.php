<?php

namespace visermort\typimultiinput\lib;

use visermort\typimultiinput\Multiinput;

trait HasValue
{
    public $title;
    public $data;
    public $value;
    public $attributeName;
    public $config;
    public $cssClassName;

    protected function initValueOwner($title, $value, $attributeName, $config, $cssClassName)
    {
        $this->title = $title;
        $this->cssClassName = $cssClassName;
        $this->data = json_encode($value);
        $this->value = $value;
        $this->attributeName = $attributeName;
        $this->config = $config;
    }

}