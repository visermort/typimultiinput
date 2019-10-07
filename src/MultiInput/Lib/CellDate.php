<?php

namespace Visermort\TypiMultiInput\Lib;

use TranslatableBootForm;

class CellDate extends CellBase
{

    public function render()
    {
        return TranslatableBootForm::date($this->title, $this->attributeName);
    }

}