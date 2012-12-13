<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
namespace Application\Controller;
/**
 * Description of User
 *
 * @author cawa
 */
class UserController extends AbstractController
{
    //put your code here

    public function indexAction()
    {
        $dbAdapter = new \Zend\Db\Adapter\Adapter((array(
                    'driver' => 'Pdo_Mysql',
                    //'database' => 'test',
                    'username' => 'root',
                    'dsn' => 'mysql:dbname=test;host=localhost;charset=cp1251',
                    'password' => 'cawa123azs'
                        )));
        $uAuth = $this->getServiceLocator()->get('UserAuthenticationPlugin');
        //@todo - We must use PluginLoader $this->userAuthentication()!!
        $authAdapter = $uAuth->getAuthAdapter($dbAdapter);

        $authAdapter->setTableName('identy')
                    ->setIdentityColumn('user')
                    ->setCredentialColumn('pass');
        $c = new \Zend\Session\Container('user');
        var_dump($c->offsetGet('auth'));
        if($c->offsetGet('auth')==true){die('sucsess');}
        $user = isset($_GET['u'])? $_GET['u']:'no';
        $password = isset($_GET['p'])?$_GET['p']:'no';

        $authAdapter->setIdentity($user)
                    ->setCredential($password);
        $uAuth->getAuthService()->authenticate($authAdapter);
        //var_dump();
    }

}

