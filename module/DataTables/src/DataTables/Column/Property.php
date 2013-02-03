<?php

namespace DataTables\Column;

class Property extends AbstractColumn
{
    public function parse(array $data)
    {
        if (isset($data[$this->getName()])) {
            return $data[$this->getName()];
        }
        return null;
    }

    public function setName($name)
    {
        $this->name = $name;
        if (!isset($this->mData)) {
            $this->mData = $name;
        }
        return $this;
    }
}
