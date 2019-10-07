<?php

namespace Visermort\TypiMultiInput\Lib;

use TranslatableBootForm;

class CellText extends CellBase
{

    public function render()
    {
        return TranslatableBootForm::textarea($this->title, $this->attributeName)->rows(4);
    }


}