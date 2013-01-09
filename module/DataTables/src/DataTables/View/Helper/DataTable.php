<?php

namespace DataTables\View\Helper;

use DataTables\Source\Source;
use Zend\View\Helper\AbstractHtmlElement;
use Sp\Exception\InvalidArgumentException;

class DataTable extends AbstractHtmlElement
{
    protected static $_loaded = false;
    protected $_source;
    protected $_attributes;
    protected $_tableId;
    protected $_fnInitComplete = '';
    protected $_class = 'table table-striped table-bordered';
    protected $_dtOptions = array ('bProcessing'     => true,
                                  'bServerSide'     => true,
                                  'sPaginationType' => 'bootstrap',
                                  'bAutoWidth'      => false,
                                 );

    public function __invoke(array $source = array(), array $dtOptions = array(), $tableId = null, array $attributes = array())
    {
        $this->load();

        if ($source instanceof Source) {
            $this->_source = $source;
        } else {
            $this->_source = new Source($source);
        }

        $this->_tableId = (!is_null($tableId)) ? $tableId : 'data-table-' . time();
        $this->_attribties = $attributes;
        if (!isset($this->_attribties['class'])) {
            $this->_attribties['class'] = $this->_class;
        }
        $this->_dtOptions = array_merge($this->_dtOptions, $dtOptions);

        return $this;
    }

    public function __toString()
    {
        return $this->render();
    }

    protected function load()
    {
        if (self::$_loaded) {
            return;
        }

        $this->view->headScript()->appendFile('/js/jquery.dataTables.js');
        $this->view->headScript()->appendFile('/js/dataTables.bootstrap.js');

        self::$_loaded = true;

    }

    public function setCssClass($class)
    {
        if (is_string($class)) {
            $this->_attribties['class'] = $class;
        }
        return $this;
    }

    public function setBProcessing($bProcessing)
    {
        if (is_bool($bProcessing)) {
            $this->_dtOptions['bProcessing'] = $bProcessing;
        }
        return $this;
    }

    public function setServerSide($serverSide)
    {
        if (is_bool($serverSide)) {
            $this->_dtOptions['bServerSide'] = $serverSide;
        }
        return $this;
    }

    public function setDisplayColumns(array $columns)
    {
        if (!empty($columns)) {
            $this->_source->addColumns($columns);
        }
        return $this;
    }

    public function addButtonsColumn($action, $target = '')
    {
        $this->_source->addColumn(\DataTables\Column\AbstractColumn::factory(array('name' => '',
                                                                            'type'=>'button',
                                                                            'attributes'=>array('action' => $action,
                                                                                                'target' => $target))));
        return $this;
    }

    public function addCheckboxColumn($checkAllId = 'check-all')
    {
        $this->_source->addColumn(\DataTables\Column\AbstractColumn::factory(array('name' => '',
                                                                            'type'=>'checkbox',
                                                                            'attributes'=>array('check-all'=> $checkAllId))));
        return $this;
    }

    public function render()
    {
        // dtOptions has the data table final options
        $columns = $this->_source->getColumns();

        // If the source is server-side then our job is simple
        $this->_dtOptions['aaData'] = $this->_source->getRawData();
        //var_dump($this->_dtOptions['aaData']);die();
        // Setup column data

        foreach ($columns as $column) {
            if (method_exists($column, 'getForInitComplete')) {
                $this->_fnInitComplete .= $column->getForInitComplete();
            }
            $this->_dtOptions['aoColumns'][] = array_merge(array(
                'sTitle' => $column->name,
                'sClass' => $column->getClass(),
                'mData' => $column->mData,
                'bSearchable'    => $column->searchable,
                'bSortable'      => $column->sortable,
                'mRender'        => (!is_null($column->getMRender())) ? $column->getMRender() : ''
                    ), $column->getAttributes());
        }

        $this->_dtOptions['fnInitComplete'] = $this->getFnInitCompete();

        $js =  "$(document).ready(function(){";
        $js .= sprintf('$("#%s").dataTable(%s);', $this->_tableId,  \Zend\Json\Json::encode($this->_dtOptions,false, array(
                                    'enableJsonExprFinder' => true)));
        $js .="});";

        $this->view->inlineScript()->appendScript($js);

        // Force ID attribute.
        $this->_attribties['id'] = $this->_tableId;

        return sprintf('<table%s></table>', $this->htmlAttribs($this->_attribties));
    }

    public function addNewRowButton(array $options)
    {
        if (!isset($options['title'])) {
            throw new InvalidArgumentException('Option \'title\' is required for AddRow button');
        }
        if (!isset($options['href'])) {
            throw new InvalidArgumentException('Option \'href\' is required for AddRow button');
        }

        $this->_fnInitComplete .= "$('.additional-buttons').append('<a class=\'btn\' data-target=\'".$options['modal']."\' data-toggle=\'modal\' href=\'" . $options['href'] . "\'>" . $options['title'] . "</a>');";

        return $this;
    }

    protected function getFnInitCompete()
    {
        $code = new \Zend\Json\Expr("function (oSettings, json) {
                    var oTable = $('#$this->_tableId').dataTable();

                    /*oSettings.bServerSide = true;
                    oSettings.sAjaxSource = '/admin/test/get';
                    alert(oSettings.sAjaxSource);
                    oTable.fnDraw();*/
                    $this->_fnInitComplete
                    }");
        return $code;
    }
}
