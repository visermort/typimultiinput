<?php

namespace visermort\typimultiinput\lib;

use Illuminate\Support\Facades\App;

abstract class CellBase
{
    use HasValue;

    protected $parent;

    public function __construct($parent, $config, $value)
    {
        $this->parent = $parent;
        $attributeName = $parent->attributeName.'['.$config['name'].']';
        $cssClassName = $parent->parent->cssClassName.'-'.$config['name'];
        $this->initValueOwner($config['title'], $value, $attributeName, $config, $cssClassName);
    }

    abstract public function render();

    /**
     * @param bool $key - returns original value if true
     * @return string
     */
    public function publish($key = false)
    {
        if (empty($this->value)) {
            return '';
        }
        $locale = App::getLocale();
        if (is_object($this->value) && property_exists($this->value, $locale)) {
            $out = $this->value->$locale;
            return $out;
        }
        return $this->value;
    }
}