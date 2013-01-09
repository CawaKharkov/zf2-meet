<?php

namespace DataTables\Column;

class Link extends Token
{
    public function parse(array $data)
    {
        $label = isset($this->config['label']) ? $this->config['label'] : $this->getName();

        return sprintf('<a class="%s" href="%s">%s</a>',$this->attributes['class'], parent::parse($data), $label);
    }
}
