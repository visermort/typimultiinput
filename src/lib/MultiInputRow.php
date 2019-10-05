<?php

namespace visermort\typimultiinput\lib;

use visermort\typimultiinput\MultiInput;

class MultiInputRow
{
    public $attributeName;
    public $columns;
    public $parent;

    protected $config;
    protected $value;
    protected $index;

    protected $cellTypes = [
        'varchar' => CellVarchar::class,
        'text' => CellText::class,
        'dropdown' => CellDropdown::class,
        'date' => CellDate::class,
        'multiinput' => CellMultiinput::class,
        'image' => CellImage::class,
        'file' => CellFile::class,
    ];

    public function __construct($parent, $config, $index, $value)
    {
        $this->parent = $parent;
        $this->config = $config;
        $this->value = $value;
        $this->index = $index;
        $this->attributeName = $parent->attributeName.'['.$index.']';
        foreach ($config as $key => $column) {
            $columnType = strtolower($column['type']);
            $columnValue = $value && property_exists($value, $key) ? $value->$key : null;
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
                'value' => $cell->data,
                'attribute' => $cell->attributeName,
            ]);
        }
        return $out;
    }
}