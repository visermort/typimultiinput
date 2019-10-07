<?php

namespace Visermort\TypiMultiInput\Lib;

use TypiCMS\Modules\Files\Models\File;
use Visermort\TypiMultiInput\Multiinput;

class CellFile extends CellBase
{

    public function render()
    {
        $file = null;
        if ($this->value > 0) {
            $file = File::find($this->value);
        }
        $templates = Multiinput::getTemplates();
        return view($templates['file'], ['attribute' => $this->attributeName, 'value' => $file]);
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