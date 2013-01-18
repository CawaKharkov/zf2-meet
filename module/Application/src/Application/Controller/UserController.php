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
use Doctrine\ORM\EntityManager;


class UserController extends AbstractController
{
    protected $em;

    public function getEntityManager()
    {
    if (null === $this->em) {
        $this->em = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
    }
    return $this->em;
    }

    public function indexAction()
    {
        $viewModel = new ViewModel;
        //$repository = $this->getEntityManager()->getRepository('\Application\Entity\User');
        //$repositoryG = $this->getEntityManager()->getRepository('\Application\Entity\GrpNew');
        //$users   = $repository->findAll();
        $em = $this->getEntityManager();
        //$gr = $em->getRepository('\Application\Entity\GrpNew')->findOneBy(['group_name'=>'GROUP']);
        $user = $em->find('\Application\Entity\User',2);

        echo $user->getName().PHP_EOL;
        $gr = $user->getGroup();
        var_dump($user);
        var_dump($gr->getGroupName());
        //$user = $em->find('\Application\Entity\User','1');
        /*$gr = new \Application\Entity\GrpNew();
        $gr->setGroupName('GROUP');
        $user = new \Application\Entity\User();
        $user->setGropu($gr);
        $user->setName('TEST');
        $em->persist($user);
        $em->flush();*/
        //$group = $repositoryG->findAll();

        //var_dump($group);
        //$viewModel->users = $users;
        //return $viewModel;
        die('end');
    }

    public function infoAction()
    {

        $email = $this->params()->fromQuery('email',null);
        $repository = $this->getEntityManager()->getRepository('\ZfcUser\Entity\User');
        $user = $repository->findBy(['email'=>$email]);
        $viewModel = new ViewModel();
        $viewModel->user = $user[0];
        return $viewModel;
    }


    public function newAction()
    {
        $xhr = $this->request->isXmlHttpRequest();
        $viewModel = new ViewModel();
        $viewModel->setTerminal($xhr);


        //var_dump($i);
        $viewModel->registerForm = $this->getServiceLocator()->get('zfcuser_register_form');
        $viewModel->user = $this->zfcUserAuthentication()->getIdentity();
        //var_dump($this->getServiceLocator()->get('zfcuser_module_options'));
        $viewModel->setTemplate('zfc-user/user/register.phtml');
        return $viewModel;
    }
}
