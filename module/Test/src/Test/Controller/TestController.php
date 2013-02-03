<?php

namespace Test\Controller;

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

/**
 * Description of IndexController
 *
 * @author cawa
 */
class TestController extends AbstractActionController
{

    public function indexAction()
    {
        return new ViewModel();
    }

}
