<?php

namespace Visermort\TypiMultiInput\Lib;

use TranslatableBootForm;
use BootForm;

class CellDate extends CellBase
{

    public function render()
    {
        if (empty($this->config['translatable'])) {
            return BootForm::date($this->title, $this->attributeName);
        }
        return TranslatableBootForm::date($this->title, $this->attributeName);
    }

}