<?php

namespace Visermort\TypiMultiInput\Lib;

use TranslatableBootForm;
use BootForm;

class CellVarchar extends CellBase
{

    public function render()
    {
        if (empty($this->config['translatable'])) {
            return BootForm::text($this->title, $this->attributeName);
        }
        return TranslatableBootForm::text($this->title, $this->attributeName);
    }

}