<?php

namespace Visermort\TypiMultiInput\Lib;

use BootForm;

class CellCheckBox extends CellBase
{

    public function renderTranslatable($value = null, $language = false)
    {
        if ($language) {
            $element =  BootForm::checkbox($this->title.' ('.$language.')', $this->attributeName.'['.$language.']');
        } else {
            $element =  BootForm::checkbox($this->title, $this->attributeName)->value($value);
        }
        if ($value) {
            $element->check();
        }
        return $element;
    }


}