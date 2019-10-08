<?php

namespace Visermort\TypiMultiInput\Lib;

use TranslatableBootForm;
use BootForm;

class CellDropdown extends CellBase
{

    public function render()
    {
        if (empty($this->config['translatable'])) {
            return BootForm::select($this->title, $this->attributeName, $this->config['items']);
        }
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