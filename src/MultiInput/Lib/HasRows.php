<?php

namespace Visermort\TypiMultiInput\Lib;

use Visermort\TypiMultiInput\MultiInput;

trait HasRows
{
    public $rows = [];
    protected $root = false;
    protected $sortableTypes = ['varchar', 'text', 'dropdown', 'number', 'date', 'datetime', 'boolean'];

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
        if (!MultiInput::$admin) {
            $this->sort();
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
            'title' => $this->getTitle(),
            'body' => $body,
            'className' => $this->cssClassName,
            'attribute' => $this->attributeName,
            'root' => $this->root,
        ]);
    }

    private function sort()
    {
        if (empty($this->config['order']) || count($this->rows) < 2) {
            return ;
        }
        usort($this->rows, function ($row, $nextRow) {
            $orders = $this->config['order'];
            $sortResult = 0;
            foreach ($orders as $order => $direction) {
                $order = strtolower($order);
                $direction = strtolower($direction) == 'desc' ? 'desc' : 'asc';
                if (property_exists($row, $order) &&
                    in_array(strtolower($row->$order->config['type']), $this->sortableTypes)) {
                    $value = $row->$order->publish();
                    $nextValue = $nextRow->$order->publish();
                    if ($value > $nextValue) {
                        $sortResult = $direction == 'asc' ? 1 : -1;
                    } elseif ($value < $nextValue) {
                        $sortResult =  $direction == 'asc' ? -1 : 1;
                    }
                }
                if ($sortResult != 0) {
                    return $sortResult;
                }
            }
        });
    }

}