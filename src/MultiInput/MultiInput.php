<?php

namespace Visermort\TypiMultiInput;

use Illuminate\Support\Facades\App;
use TypiCMS\Modules\Files\Models\File;
use Visermort\TypiMultiInput\Lib\HasRows;
use Visermort\TypiMultiInput\Lib\HasValue;

class MultiInput
{
    use HasRows;
    use HasValue;

    public $errors = [];

    public static $attribute;
    public static $admin = true;
    public static $templates = [
        'admin' => [
            'directory' => 'vendor.multiinput.admin.',
            'main' => 'main',
            'body' => 'body',
            'element' => 'element',
            'file' => 'file',
            'image' => 'image',
        ],
        'public' => [
            'directory' => 'vendor.multiinput.public.',
            'main' => 'main',
            'item' => 'item',
            'file' => 'file',
            'image' => 'image',
        ],
    ];

    /**
     * on admin form
     *
     * @param $attribute
     * @param $configName
     * @param $model
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public static function render($attribute, $configName, $model, $configUpdate = [])
    {
        $self = self::make($attribute, $configName, $model, $configUpdate);
        if (!empty($self->errors)) {
            return implode(', ', $self->errors);
        }
        return $self->view();
    }

    /**
     * in front
     *
     * @param $attribute
     * @param $configName
     * @param $model
     * @param array $options
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|string
     */
    public static function publish($attribute, $configName, $model, $configUpdate = [], $options = [])
    {
        self::$admin = false;
        $self = self::make($attribute, $configName, $model, $configUpdate);
        if ($self->errors || !$self->value) {
            return '';
        }
        self::$templates['public']['directory'] =
            self::$templates['public']['directory'] . $attribute . '.';//default directory  multi-input.public.<attribute>.
        if (!empty($options['templates'])) {
            foreach ($options['templates'] as $key => $value) {
                self::$templates['public'][$key] = $value;
            }
        }
        if (isset($options['title'])) {
            $self->title = $options['title'];
        }
        if (isset($options['class-name'])) {
            $self->className = $options['class-name'];
        }
        return $self->viewPublic();
    }

    public function viewPublic()
    {
        $templates = self::getTemplates();
        $rows = '';
        foreach ($this->rows as $row) {
            $rows .= view($templates['item'], ['row' => $row]);
        }
        return view($templates['main'], [
            'title' => $this->getTitle(),
            'rows' => $rows,
            'className' => 'multiinput',
        ]);
    }

    public static function getTemplates()
    {
        $key = self::$admin ? 'admin' : 'public';
        $templates = self::$templates[$key];
        foreach ($templates as $key => &$template) {
            if ($key != 'directory') {
                $template = $templates['directory'] . $template;
            }
        }
        return  $templates;
    }

    /**
     * create self instance
     *
     * @param $attribute
     * @param $configName
     * @param $model
     * @return MultiInput
     */
    public static function make($attribute, $configName, $model, $configUpdate)
    {
        self::$attribute = $attribute;
        $self = new self();
        $config = $self->getConfig($configName);
        $config = array_merge_recursive(
            is_array($config) ? $config : [],
            is_array($configUpdate) ? $configUpdate : []
        );
        if (empty($config)) {
            return null;
        }
        $self->initValueOwner(
            __(isset($self->config['title']) ? $self->config['title'] : ucfirst($attribute)), //title
            $model->$attribute ? $model->$attribute : false, //values
            $attribute, //full attributa
            $config, //config
            'multiinput multiinput-' . $attribute// css class
        );
        $self->root = true;
        $self->makeRows($self->config['columns'], $self->value, $self);
        return $self;
    }

    protected function getConfig($configName)
    {
        $config = Config('multiinput.'.$configName);
        if (!$config) {
            $this->errors[] = 'Config not found or not valid - '.$configName;
            return ;
        }
        $config['columns']= $this->writeColumnKeys($config['columns']);
        return $config;
    }

    protected function writeColumnKeys($columns)
    {
        $out = [];
        foreach ($columns as $column) {
            if (isset($column['columns'])) {
                $column['columns'] = $this->writeColumnKeys($column['columns']);
            }
            $out[$column['name']] = $column;
        }
        return $out;
    }
}