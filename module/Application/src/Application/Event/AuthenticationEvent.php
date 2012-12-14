<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
namespace Application\Event;
/**
 * Description of Authentication
 *
 * @author cawa
 */

use Zend\Mvc\MvcEvent as MvcEvent;
use Application\Controller\Plugin\UserAuthentication as AuthPlugin;
use Application\Auth\ApplicationAcl as AclClass;


class AuthenticationEvent
{
    //put your code here

    protected $_userAuth = null;
    protected $_aclClass = null;

    public function preDispatch(MvcEvent $event)
    {
        //@todo - Should we really use here and Controller Plugin?
        $userAuth = $this->getUserAuthenticationPlugin();
        $acl = $this->getAclClass();
        //$role = AclClass::DEFAULT_ROLE;
        $routeMatch = $event->getRouteMatch();
        $controller = $routeMatch->getParam('controller');
        $action = $routeMatch->getParam('action');

        if($userAuth->hasIdentity()){
            $member = $userAuth->getIdentity();
            $role = 'user';
            //$c = new \Zend\Session\Container();
            //$c->offsetSet('auth',true);
            setcookie("auth",$userAuth->getIdentity(),time()+3600);
        }  else {
            $role = 'guest';
        }
        if (!$acl->hasResource($controller)) {
            throw new \Exception('Resource ' . $controller . ' not defined');
        }
        if (!$acl->isAllowed($role, $controller, $action)) {
            $url = $event->getRouter()->assemble(array(), array('name' => 'user'));
            $loc =  new \Zend\Http\Header\Location();
            $loc->setUri($url);
            $header = new \Zend\Http\Headers();
            $header->addHeader($loc);
            $response = $event->getResponse();
            $response->setStatusCode(402);
            $response->setHeaders($header);
            $response->sendHeaders();
            return $response;
        }
    }

    public function setUserAuthenticationPlugin(AuthPlugin $userAuthenticationPlugin)
    {
        $this->_userAuth = $userAuthenticationPlugin;

        return $this;
    }

    public function getUserAuthenticationPlugin() {
        if ($this->_userAuth === null) {
            $this->_userAuth = new AuthPlugin();
        }

        return $this->_userAuth;
    }

    public function setAclClass(AclClass $aclClass)
    {
        $this->_aclClass = $aclClass;

        return $this;
    }

    public function getAclClass()
    {
        if ($this->_aclClass === null) {
            $this->_aclClass = new AclClass();
        }

        return $this->_aclClass;
    }
}
