<?php

namespace Visermort\TypiMultiInput\Lib;

use BootForm;
use Lang;

class CellDropdown extends CellBase
{

    protected function renderTranslatable($value = null, $language = false)
    {
        if ($language) {
            return BootForm::select(
                $this->title.' ('.$language.')',
                $this->attributeName.'['.$language.']',
                $this->config['items']
            )->data('translatable', 1)->data('language', $language)->select($value);
        }
        return BootForm::select($this->title, $this->attributeName, $this->config['items'])->select($value);
    }

    public function publish($key = false)
    {
        $id = parent::publish($key);
        if ($key) {
            return $id;
        }
        if (isset($this->config['items'][$id])) {
            return Lang::get('db.'.$this->config['items'][$id]);
        }
        return $id;
    }
}