<?php

namespace Visermort\TypiMultiInput\Lib;

use TranslatableBootForm;
use BootForm;

class CellVarchar extends CellBase
{

    protected function renderTranslatable($value = null, $language = false)
    {

        if ($language) {
            return BootForm::text($this->title.' ('.$language.')', $this->attributeName.'['.$language.']')
                ->data('translatable', 1)->data('language', $language)->value($value);
        }
        return BootForm::text($this->title, $this->attributeName)->value($value);
    }

}