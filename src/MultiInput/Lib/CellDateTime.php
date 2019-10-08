<?php

namespace Visermort\TypiMultiInput\Lib;

use BootForm;

class CellDateTime extends CellBase
{

    protected function renderTranslatable($value = null, $language = false)
    {
        if ($language) {
            return BootForm::datetimelocal($this->title.' ('.$language.')', $this->attributeName.'['.$language.']')
                ->value($value);
        }
        return BootForm::datetimelocal($this->title, $this->attributeName)->value($value);
    }

}