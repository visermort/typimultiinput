<?php

namespace Visermort\TypiMultiInput\Lib;

use TranslatableBootForm;

class CellVarchar extends CellBase
{

    public function render()
    {
        return TranslatableBootForm::text($this->title, $this->attributeName);
    }

}