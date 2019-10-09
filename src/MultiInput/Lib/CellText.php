<?php

namespace Visermort\TypiMultiInput\Lib;

//use TranslatableBootForm;
use BootForm;

class CellText extends CellBase
{

    public function renderTranslatable($value = null, $language = false)
    {
        if ($language) {
            return BootForm::textarea($this->title.' ('.$language.')', $this->attributeName.'['.$language.']')
                ->data('translatable', 1)->data('language', $language)->rows(4)->value($value);
        }
        return BootForm::textarea($this->title, $this->attributeName)->rows(4)->value($value);
    }


}