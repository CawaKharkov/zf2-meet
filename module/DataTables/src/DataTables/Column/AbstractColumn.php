<?php

namespace DataTables\Column;

use InvalidArgumentException;

abstract class AbstractColumn
{
    public static $typemap = array(
        'closure'  => 'DataTables\Column\Closure',
        'link'     => 'DataTables\Column\Link',
        'token'    => 'DataTables\Column\Token',
        'property' => 'DataTables\Column\Property',
        'text'     => 'DataTables\Column\Text',
        'button'   => 'DataTables\Column\Button',
        'checkbox' => 'DataTables\Column\Checkbox',
    );

    protected $name;

    protected $mData;

    protected $searchable = true;

    protected $sortable = true;

    protected $mRender = null;

    protected $config = array();

    protected $attributes = array();

    public static function factory(array $spec)
    {
        if (!isset($spec['name'])) {
            throw new InvalidArgumentException('A name is required for all columns');
        }

        $spec['type']        = isset($spec['type']) ? strtolower(trim($spec['type'])) : 'property';
        $spec['config']      = isset($spec['config']) ? $spec['config'] : array();
        $spec['attributes']  = isset($spec['attributes']) ? $spec['attributes'] : array();

        if (isset(self::$typemap[$spec['type']])) {
            $class = self::$typemap[$spec['type']];
        } elseif (class_exists($spec['type'])) {
            $class = $spec['type'];
        } else {
            throw new InvalidArgumentException(sprintf(
                'Failed to load column for type "%s"',
                $spec['type']
            ));
        }

        $column = new $class;

        $column->setName($spec['name']);
        $column->setConfig($spec['config']);
        $column->setAttributes($spec['attributes']);

        return $column;
    }

    abstract public function parse(array $data);

    public function __get($property)
    {
        $method = 'get' . ucfirst($property);

        if (method_exists($this, $method)) {
            return $this->{$method}();
        } elseif (property_exists(__CLASS__, $property)) {
            return $this->{$property};
        }
        throw new \UnexpectedValueException(sprintf('Property %s does not exist', $property));
    }

    public function __set($property, $value)
    {
        $method = 'set' . ucfirst($property);

        if (method_exists($this, $method)) {
            return $this->{$method}($value);
        } elseif (property_exists(__CLASS__, $property)) {
            return $this->{$property} = $value;
        }
        throw new \UnexpectedValueException(sprintf('Property %s does not exist', $property));
    }

    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setSortable($sortable)
    {
        $this->sortable = $sortable;
        return $this;
    }

    public function getSortable()
    {
        return $this->sortable;
    }

    public function setSearchable($searchable)
    {
        $this->searchable = $searchable;
        return $this;
    }

    public function getSearchable()
    {
        return $this->searchable;
    }

    public function getMData()
    {
        return $this->mData;
    }

    public function setMData($prop)
    {
        $this->mData =$prop;
        return $this;
    }

    public function setAttributes($attributes)
    {

        $this->attributes = $attributes;
        return $this;
    }

    public function getAttributes()
    {
        return $this->attributes;
    }

    public function setConfig($config)
    {
        $this->config = $config;
        return $this;
    }

    public function getConfig()
    {
        return $this->config;
    }


    public function getMRender()
    {
         return $this->mRender;
    }

    public function getClass()
    {
        return (isset($this->attributes['class'])) ? $this->attributes['class'] : null;
    }
}
