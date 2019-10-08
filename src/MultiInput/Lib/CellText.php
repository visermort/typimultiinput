<?php

namespace Visermort\TypiMultiInput\Lib;

use TranslatableBootForm;
use BootForm;

class CellText extends CellBase
{

    public function render()
    {
        if (empty($this->config['translatable'])) {
            return BootForm::textarea($this->title, $this->attributeName)->rows(4);
        }
        return TranslatableBootForm::textarea($this->title, $this->attributeName)->rows(4);
    }


}