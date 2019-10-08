<?php

namespace Visermort\TypiMultiInput\Lib;

use TranslatableBootForm;
use BootForm;

class CellNumber extends CellBase
{

    public function render()
    {
        return BootForm::number($this->title, $this->attributeName)->rows(4);
    }


}