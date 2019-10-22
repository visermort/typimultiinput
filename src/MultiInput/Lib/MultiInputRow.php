<?php

namespace Visermort\TypiMultiInput\Lib;

use Visermort\TypiMultiInput\MultiInput;

class MultiInputRow
{
    public $columns;
    public $parent;

    protected $attributeName;
    protected $config;
    protected $value;
    protected $index;

    protected $cellTypes = [
        'varchar' => CellVarchar::class,
        'text' => CellText::class,
        'number' => CellNumber::class,
        'dropdown' => CellDropdown::class,
        'date' => CellDate::class,
        'datetime' => CellDateTime::class,
        'image' => CellImage::class,
        'file' => CellFile::class,
        'boolean' => CellCheckBox::class,
        'multiinput' => CellMultiinput::class,
    ];

    public function __construct($parent, $config, $index, $value)
    {
        $this->parent = $parent;
        $this->config = $config;
        $this->value = $value;
        $this->index = $index;
        $this->attributeName = $parent->getAttributeName().'['.$index.']';
        foreach ($config as $key => $column) {
            $columnType = strtolower($column['type']);
            $columnValue = $value && in_array($key, array_keys($value)) ? $value[$key] : null;
            $cellClassName = isset($this->cellTypes[$columnType]) ?
                $this->cellTypes[$columnType] : CellVarchar::class;

            $cell = new $cellClassName($this, $column, $columnValue);

            $this->columns[] = $cell;
            $property = $column['name'];
            $this->{$property} = $cell;//as property
        }
    }

    public function render()
    {
        $templates = Multiinput::getTemplates();
        $out = '';
        foreach ($this->columns as $cell) {
            $out .= view($templates['element'], [
                'element' => $cell->render(),
                'attribute' => $cell->getAttributeName(),
                'rules' => $cell->getRules() ? json_encode($cell->getRules()) : false,
            ]);
        }
        return $out;
    }

    public function getAttributeName()
    {
        return $this->attributeName;
    }
}