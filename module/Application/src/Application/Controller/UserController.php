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
use Application\Form\PhotoUploadForm;
use Zend\Validator\File\Size;



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

        $em = $this->getEntityManager();
        $repository = $em->getRepository('\Application\Entity\UserNew');
        //$repositoryG = $this->getEntityManager()->getRepository('\Application\Entity\GrpNew');
        //$users   = $repository->findAll();

        //$gr = $em->getRepository('\Application\Entity\GrpNew')->findOneBy(['group_name'=>'GROUP']);
        //$user = $this->zfcUserAuthentication()->getIdentity();
        //var_dump($this->isAllowed(get_class($this),'guest'));// echo '1';
        //echo $user->getRealName().PHP_EOL;
        //$gr = $user->getGroup();
        //var_dump($user->getGroup()->getGroupName());


        //var_dump($gr->getGroupName());
        $user = $repository->findAll();
        /*$gr = new \Application\Entity\GrpNew();
        $gr->setGroupName('GROUP');
        $user = new \Application\Entity\User();
        $user->setGropu($gr);
        $user->setName('TEST');
        $em->persist($user);
        $em->flush();*/
        //$group = $repositoryG->findAll();

        //var_dump($group);
        $viewModel->users = $user;
        return $viewModel;
        //die('end');
    }

    public function infoAction()
    {

        $email = $this->params()->fromQuery('email',null);
        $repository = $this->getEntityManager()->getRepository('\Application\Entity\UserNew');
        $user = $repository->findBy(['email'=>$email]);
        $viewModel = new ViewModel();
        $viewModel->user = $user[0];
        $path = PUBLIC_PATH.'/images/users/'.$user[0]->getId().'/';
        $images = glob($path . "*.jpg");
        foreach ($images as $img){
            $imgN[] = strstr($img,'/images');
        }
        
        var_dump($imgN);
        $viewModel->images = $imgN;
        return $viewModel;
    }


    public function newAction()
    {
        $xhr = $this->request->isXmlHttpRequest();
        $viewModel = new ViewModel();
        //var_dump($xhr);
        if(!$xhr){
            echo '1';
            $this->redirect()->toRoute('application/default');}
        $viewModel->setTerminal($xhr);
        //var_dump($i);
        $viewModel->registerForm = $this->getServiceLocator()->get('zfcuser_register_form');
        $viewModel->user = $this->zfcUserAuthentication()->getIdentity();
        //var_dump($this->getServiceLocator()->get('zfcuser_module_options'));
        $viewModel->setTemplate('zfc-user/user/register.phtml');
        return $viewModel;
    }

    public function uploadAction() 
            {
        $xhr = $this->request->isXmlHttpRequest();
        $viewModel = new ViewModel();
        $id = $this->zfcUserAuthentication()->getIdentity()->getId();
        //if(!$xhr){   return false;}
         $viewModel->setTerminal($xhr);
        $path = PUBLIC_PATH.'/images/users/'.$id.'/';
        if(!dir($path)){  mkdir($path);}
        $form = new PhotoUploadForm();
        $request = $this->getRequest();
        if ($request->isPost()) {

            //   $profile = new Profile();
            //    $form->setInputFilter($profile->getInputFilter());

            $nonFile = $request->getPost()->toArray();
            $File = $this->params()->fromFiles('photoUpload');
            $data = array_merge(
                    $nonFile, //POST
                    array('photoUpload' => $File['name']) //FILE...
            );
            //set data post and file ...   
            $form->setData($data);

            if ($form->isValid()) {

                $size = new Size(array('min' => 2000,'max'=>200000)); //minimum bytes filesize

                $adapter = new \Zend\File\Transfer\Adapter\Http();
                //validator can be more than one...
                $adapter->setValidators(array($size), $File['name']);

                if (!$adapter->isValid()) {
                    $dataError = $adapter->getMessages();
                    $error = array();
                    foreach ($dataError as $key => $row) {
                        $error[] = $row;
                    } //set formElementErrors
                    $form->setMessages(array('photoUpload' => $error));
                } else {
                    $adapter->setDestination($path);
                    if ($adapter->receive($File['name'])) {
                        return $viewModel;
                    }
                }
            }
        }$viewModel->form = $form;
        return $viewModel;
    }
}
