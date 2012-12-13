<?php

/**
 * @namespace
 */
namespace Application\Controller\Plugin;

use Zend\Mvc\Controller\Plugin\AbstractPlugin;
use Zend\Authentication\AuthenticationService;
use Zend\Authentication\Adapter\DbTable as AuthAdapter;
use Application\Auth\AuthStorage;

class UserAuthentication extends AbstractPlugin
{
    /**
     * @var AuthAdapter
     */
    protected $_authAdapter = null;

    /**
     * @var AuthenticationService
     */
    protected $_authService = null;


    protected $_dbAdapter = null;

    /**
     * Check if Identity is present
     *
     * @return bool
     */
    public function hasIdentity()
    {
        return $this->getAuthService()->hasIdentity();
    }

    /**
     * Return current Identity
     *
     * @return mixed|null
     */
    public function getIdentity()
    {
        return $this->getAuthService()->getIdentity();
    }

    /**
     * Sets Auth Adapter
     *
     * @param \Zend\Authentication\Adapter\DbTable $authAdapter
     * @return UserAuthentication
     */
    public function setAuthAdapter(AuthAdapter $authAdapter)
    {
        $this->_authAdapter = $authAdapter;

        return $this;
    }

    /**
     * Returns Auth Adapter
     *
     * @return \Zend\Authentication\Adapter\DbTable
     */
    public function getAuthAdapter()
    {
        if ($this->_authAdapter === null) {
            $this->setAuthAdapter($this->dbAuthAdapter());
        }

        return $this->_authAdapter;
    }

    public function dbAuthAdapter()
    {
        $db = new \Zend\Db\Adapter\Adapter((array(
                    'driver' => 'Pdo_Mysql',
                    //'database' => 'test',
                    'username' => 'root',
                    'dsn' => 'mysql:dbname=test;host=localhost;charset=cp1251',
                    'password' => 'cawa123azs'
                        )));
        $authAdapter = new AuthAdapter($db);
        return $authAdapter;
    }

    /**
     * Sets Auth Service
     *
     * @param \Zend\Authentication\AuthenticationService $authService
     * @return UserAuthentication
     */
    public function setAuthService()
    {
       if(!isset($this->_authService)){
       $authService = new  AuthenticationService();
       $this->_authService = $authService;}
       return $this;
    }

    /**
     * Gets Auth Service
     *
     * @return \Zend\Authentication\AuthenticationService
     */
    public function getAuthService()
    {
        if ($this->_authService === null) {
            $this->setAuthService();
        }

        return $this->_authService;
    }

}
