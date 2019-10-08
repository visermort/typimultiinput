<?php

namespace Visermort\TypiMultiInput\Lib;

use TypiCMS\Modules\Files\Models\File;
use Visermort\TypiMultiInput\Multiinput;

class CellFile extends CellBase
{

    protected function renderTranslatable($value = null, $language = false)
    {
        $templates = Multiinput::getTemplates();
        $file = null;
        if ($value) {
            $file = File::find($value);
        }
        //$title = $language ? $this->title.' ('.$language.')' : $this->title;
        $attribute = $language ? $this->attributeName.'['.$language.']' : $this->attributeName;
        return view(
            $templates['file'],
            [
                //'title' => $title,
                'attribute' => $attribute,
                'value' => $file
            ]
        );
    }

    public function publish($key = false)
    {
        if ($key) {
            return $this->value;
        }
        $file = File::find($this->value);
        if ($file) {
            $templates = Multiinput::getTemplates();
            return view($templates['file'], ['file' => $file]);
        }
    }
}