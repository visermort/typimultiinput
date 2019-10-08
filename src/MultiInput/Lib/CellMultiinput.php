<?php

namespace Visermort\TypiMultiInput\Lib;

class CellMultiinput extends CellBase
{
    use HasRows;

    public function __construct($parent, $config, $value)
    {
        parent::__construct($parent, $config, $value);
        $this->makeRows($this->config['columns'], $this->value, $this);
    }

    protected function renderTranslatable($value = null, $language = false)
    {
        return $this->view();
    }

    public function publish($key = false)
    {
        return $this->rows;
    }
}