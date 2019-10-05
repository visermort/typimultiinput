<?php

namespace visermort\typimultiinput\lib;

use TranslatableBootForm;

class CellDate extends CellBase
{

    public function render()
    {
        return TranslatableBootForm::date($this->title, $this->attributeName);
    }

}