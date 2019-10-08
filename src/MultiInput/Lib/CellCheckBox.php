<?php

namespace Visermort\TypiMultiInput\Lib;

use BootForm;

class CellCheckBox extends CellBase
{

    public function render()
    {
        return BootForm::checkbox($this->title, $this->attributeName);
    }


}