<?php

namespace Visermort\TypiMultiInput\Lib;

use TranslatableBootForm;

class CellDropdown extends CellBase
{

    public function render()
    {
        return TranslatableBootForm::select($this->title, $this->attributeName, $this->config['items']);
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