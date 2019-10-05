<?php

namespace visermort\typimultiinput\lib;

class CellMultiinput extends CellBase
{
    use HasRows;

    public function __construct($parent, $config, $value)
    {
        parent::__construct($parent, $config, $value);
        $this->makeRows($this->config['columns'], $this->value, $this);
    }

    public function render()
    {
        return $this->view();
    }

    public function publish($key = false)
    {
        return $this->rows;
    }
}