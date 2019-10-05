<?php

namespace visermort\typimultiinput\lib;

use TranslatableBootForm;

class CellText extends CellBase
{

    public function render()
    {
        return TranslatableBootForm::textarea($this->title, $this->attributeName)->rows(4);
    }


}