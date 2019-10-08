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

    public function render()
    {
        $languages = config('translatable-bootforms.locales');
        $out = [];
        if (!empty($this->config['translatable'])) {
            foreach ($languages as $language) {
                $value = !empty($this->value)  && property_exists($this->value, $language) ? $this->value->$language : false;
                $element = $this->renderTranslatable($value, $language);
                $out[] = $element;
            }
        } else {
            $value = is_array($this->value) ? print_r($this->value, 1) : $this->value;//todo test
            $out = $this->renderTranslatable($value);
            $out = [$out];
        }
        return implode('
         ', $out);
    }

    abstract protected function renderTranslatable($value = null, $language = false);

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

}