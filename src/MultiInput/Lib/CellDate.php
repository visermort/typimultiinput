<?php

namespace Visermort\TypiMultiInput\Lib;

//use TranslatableBootForm;
use BootForm;

class CellDate extends CellBase
{

    protected function renderTranslatable($value = null, $language = false)
    {
        if ($language) {
            return BootForm::date($this->title.' ('.$language.')', $this->attributeName.'['.$language.']')
                ->value($value);
        }
        return BootForm::date($this->title, $this->attributeName)->value($value);
    }

}