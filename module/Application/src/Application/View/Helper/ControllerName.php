<?php
namespace Application\View\Helper;

use Zend\View\Helper\AbstractHelper;

class ControllerName extends AbstractHelper
{

protected $routeMatch;

    public function __construct($routeMatch)
    {
        $this->routeMatch = $routeMatch;
    }

    public function __invoke()
    {
        $controller = $this->routeMatch->getParam('controller');
        $controllerName = array_pop(explode('\\',$controller));
        if($controllerName === 'Index'){
            $controllerName = 'Home';
        }
        return $controllerName;
    }
}