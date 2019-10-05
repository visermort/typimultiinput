<?php

namespace visermort\typimultiinput\lib;

use visermort\typimultiinput\Multiinput;

trait HasRows
{
    public $rows = [];

    public function makeRows($columnsConfig, $values, $parent)
    {
        if (!$values || !count($values)) {
            $this->rows[] = new MultiInputRow($parent, $columnsConfig, 0, null);
        } else {
            $index = 0;
            foreach ($values as $value) {
                $this->rows[] = new MultiInputRow($parent, $columnsConfig, $index++, $value);
                if (!empty($parent->config['single_row'])) {
                    break;
                }
            }
        }
    }

    public function view()
    {
        $templates = Multiinput::getTemplates();
        $rows = [];
        foreach ($this->rows as $row) {
            $rows[] = $row->render();
        }
        $body = view($templates['body'], ['rows' => $rows]);
        return view($templates['main'], [
            'title' => $this->title,
            'body' => $body,
            'className' => $this->cssClassName,
            'attribute' => $this->attributeName,
        ]);
    }

}