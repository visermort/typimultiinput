<?php

namespace Visermort\TypiMultiInput\Lib;

//use TranslatableBootForm;
use BootForm;

class CellDropdown extends CellBase
{

    protected function renderTranslatable($value = null, $language = false)
    {
        if ($language) {
            return BootForm::select(
                $this->title.' ('.$language.')',
                $this->attributeName.'['.$language.']',
                $this->config['items']
            )->select($value);
        }
        return BootForm::select($this->title, $this->attributeName, $this->config['items'])->select($value);
    }

    public function publish($key = false)
    {
        $out = parent::publish($key);
        if (!$key && isset($this->config['items'][$out])) {
            $out = $this->config['items'][$out];
        }
        return $out;
    }
}