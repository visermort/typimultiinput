<?php

namespace Visermort\TypiMultiInput\Lib;

use BootForm;

class CellDateTime extends CellBase
{

    public function render()
    {
        return BootForm::datetimelocal($this->title, $this->attributeName);
    }

}