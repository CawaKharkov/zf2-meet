<?php

namespace DataTables\Column;

class Checkbox extends AbstractColumn
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
        $this->mRender = new \Zend\Json\Expr("function(data, type, full){
                         var chk = \"<input type='checkbox' value='\"+full['id']+\"'>\";
                         return chk;}");
        return $this->mRender;
    }

    public function getForInitComplete()
    {
        return "$('#" . $this->attributes['check-all'] . "').click( function() {
                        $('input', oTable.fnGetNodes()).attr('checked',this.checked);
                        });";
    }

    public function setAttributes($attributes)
    {
        $this->attributes = $attributes;
        $this->name = "<input type='checkbox' id = '" . $this->attributes['check-all'] . "'/>";
    }
}
