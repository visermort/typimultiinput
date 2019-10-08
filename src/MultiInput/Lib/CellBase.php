<?php

namespace Visermort\TypiMultiInput\Lib;

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
        if (!empty($this->config['translatable']) && is_object($this->value)) {
            $locale = App::getLocale();
            if (property_exists($this->value, $locale)) {
                $out = $this->value->$locale;
                return $out;
            }
        }
        return $this->value;
    }

    public function getValue()
    {
        return is_object($this->value) || is_array($this->value) ? json_encode($this->value) : $this->value;
    }
}