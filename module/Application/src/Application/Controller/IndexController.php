<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\Controller;

use Zend\View\Model\ViewModel;


class IndexController extends AbstractController
{


    public function indexAction()
    {
        /*$pubKey= '6Lfx2NsSAAAAAF1_MOV93YpJhIB2UW4hpq0lvfjX';
        $privKey= '6Lfx2NsSAAAAAA2mbAVw5fW94Nwoar78UjW3DswD';
        $recaptcha = new \ZendService\ReCaptcha\ReCaptcha($pubKey, $privKey);
        echo $recaptcha->getHTML();die();*/
        //var_dump(get_class_methods($this->zfcUserAuthentication()));
        return new ViewModel();
    }
}
