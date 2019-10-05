<?php

namespace visermort\typimultiinput\lib;

use TranslatableBootForm;

class CellVarchar extends CellBase
{

    public function render()
    {
        return TranslatableBootForm::text($this->title, $this->attributeName);
    }

}