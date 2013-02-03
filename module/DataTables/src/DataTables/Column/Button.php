<?php

namespace DataTables\Column;

class Button extends AbstractColumn
{
    public function __construct()
    {
        $this->sortable = false;
        $this->searchable = false;
        $this->mData = null;
    }

    public function parse(array $data)
    {
        //$label = isset($this->config['label']) ? $this->config['label'] : $this->getName();
        //return sprintf('<a id="%s" class="%s" href="%s?id=%s">%s</a>',$this->attributes['id'],$this->attributes['class'],parent::parse($data),$data['id'],$label);
    }
    public function getMRender()
    {
        if (isset($this->attributes['action'])) {
            $btn = $this->attributes['action'];
            $target = $this->attributes['target'];
            $iconN = strrpos($btn, '/');
            if ($iconN !== false) {
                $icon = substr($btn, $iconN + 1);
            } else {
                $icon = $btn;
            }
            $this->mRender = new \Zend\Json\Expr("function(data, type, full){
                         var btn = \"<a class='btn btn-small' data-target='#$target' data-toggle='modal' href='$btn?id=\"+full['id']+\"\'><i class='icon-$icon'></i></a>\";
                         return btn;}");
        }
        return $this->mRender;
    }
}
