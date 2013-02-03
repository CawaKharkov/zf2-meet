<?php

namespace Application\Service;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Application\Provider\Role\UserProvider as Doctrine;

class RoleProviderService implements FactoryInterface
{
    /**
     * {@inheritDoc}
     *
     * @return \BjyAuthorize\Provider\Role\Doctrine
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        /* @var $objectManager \Doctrine\ORM\EntityManager */
        $objectManager = $serviceLocator->get('doctrine.entitymanager.orm_default');

        return new Doctrine(array(), $objectManager);
    }
}
