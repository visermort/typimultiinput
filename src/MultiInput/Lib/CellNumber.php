<?php

namespace Visermort\TypiMultiInput\Lib;

//use TranslatableBootForm;
use BootForm;

class CellNumber extends CellBase
{

    public function renderTranslatable($value = null, $language = false)
    {
        if ($language) {
            return BootForm::number($this->title.' ('.$language.')', $this->attributeName.'['.$language.']')
                ->data('translatable', 1)->data('language', $language)->value($value);
        }
        return BootForm::number($this->title, $this->attributeName)->value($value);
    }


}