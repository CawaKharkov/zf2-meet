<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application;

use Zend\Mvc\ModuleRouteListener;
use Zend\EventManager\EventInterface;
use Zend\ModuleManager\Feature\AutoloaderProviderInterface;

class Module
{



    public function onBootstrap(EventInterface $e)
    {
        $eventManager        = $e->getApplication()->getEventManager();
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);
        $eventManager->attach('render', array($this, 'initView'));
        $eventManager->getSharedManager()->attach(
            'Zend\Mvc\Application', 'render', array($this, 'setLayout')
        );
        $e->getApplication()->getServiceManager()->get('viewhelpermanager')->setFactory('controllerName', function($sm) use ($e) {
        $viewHelper = new View\Helper\ControllerName($e->getRouteMatch());
        return $viewHelper;
        });
    }

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }

    public function getServiceConfig()
    {
        return array(
                'factories' => array(
                     'zfcuser_register_form' => function ($sm) {
                    $options = $sm->get('zfcuser_module_options');
                    $form = new Form\RegisterForm(null, $options);
                    //$form->setCaptchaElement($sm->get('zfcuser_captcha_element'));
                    $form->setInputFilter(new \ZfcUser\Form\RegisterFilter(
                        new \ZfcUser\Validator\NoRecordExists(array(
                            'mapper' => $sm->get('zfcuser_user_mapper'),
                            'key'    => 'email'
                        )),
                        new \ZfcUser\Validator\NoRecordExists(array(
                            'mapper' => $sm->get('zfcuser_user_mapper'),
                            'key'    => 'username'
                        )),
                        $options
                    ));
                    return $form;
                },
                ));
    }



    public function initView(EventInterface $e)
    {
        $helperManager = $e->getApplication()->getServiceManager()->get('viewhelpermanager');
        $helperManager->setAlias('_', 'translate');

        $helperManager->get('headmeta')->setCharset('utf-8')
                                       ->setName('viewport', 'width=device-width, initial-scale=1.0');

        $helperManager->get('headtitle')->set('test');

        $helperManager->get('headlink')->appendStylesheet('//ajax.googleapis.com/ajax/libs/jqueryui/1.9.0/themes/base/jquery-ui.css')
                                       ->appendStylesheet('/css/foundation.min.css')
                                       ->appendStylesheet('/css/app.css')
                                       ->appendStylesheet('/css/main.css');

        $helperManager->get('headscript')->appendFile('//ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js')
                                         ->appendFile('/js/app.js')
                                         ->appendFile('/js/modernizr.foundation.js')
                                         ->appendFile('/js/foundation.min.js')
                                         ->appendFile('//ajax.googleapis.com/ajax/libs/jqueryui/1.9.0/jquery-ui.min.js')
                                         ->appendFile('/js/main.js');
    }


     public function setLayout(EventInterface $e)
    {
        $sm = $e->getApplication()->getServiceManager();
        $config = $sm->get('config');
        $viewHelperManager = $sm->get('viewhelpermanager');
        $routeMatch = $e->getRouteMatch();
        $routeName = !is_null($routeMatch) ? $routeMatch->getMatchedRouteName()
                                           : '';

        if ($routeName == 'admin' && isset($config['module_layouts']['admin'])) {
            $viewHelperManager->get('layout')->setTemplate($config['module_layouts']['admin']);
        } elseif ($routeName == 'home' && isset($config['module_layouts']['applicaion'])) {
            $viewHelperManager->get('layout')->setTemplate($config['module_layouts']['application']);
        } elseif ($routeName == 'test' && isset($config['module_layouts']['test'])) {
            $viewHelperManager->get('layout')->setTemplate($config['module_layouts']['test']);
        }

    }
}
