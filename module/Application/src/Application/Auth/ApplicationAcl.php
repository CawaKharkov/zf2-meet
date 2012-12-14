<?php


namespace Application\Auth;


use Zend\Permissions\Acl\Acl;
use Zend\Permissions\Acl\Role\GenericRole as Role;
use Zend\Permissions\Acl\Resource\GenericResource as Resource;

class ApplicationAcl extends Acl
{

    public function __construct()
    {
        $this->addRole(new Role('guest'));
        $this->addRole(new Role('user'));
        $this->addRole(new Role('administrator'));

        $this->addResource(new Resource('Application\Controller\Index'));
        $this->addResource(new Resource('Application\Controller\UserController'));
        $this->addResource(new Resource('Test\Controller\Test'));

        $this->allow('guest','Application\Controller\UserController');
        $this->allow('guest','Application\Controller\Index');
        $this->deny('guest','Test\Controller\Test');

        $this->allow('user','Application\Controller\UserController');
        $this->allow('user','Application\Controller\Index');
        $this->allow('user','Test\Controller\Test');
    }

}
