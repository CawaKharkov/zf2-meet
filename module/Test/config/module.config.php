<?php

namespace Test;

return array(
    'controllers' => array(
        'invokables' => array(
            'Test\Controller\Test' => 'Test\Controller\TestController',
            'test' => 'Test\Controller\TestController',
            'adv' => 'Test\Controller\AdvController',
        ),
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            'test' => __DIR__ . '/../view',
        ),
    ),
    'view_helpers' => array(
        'invokables' => array(
            'datatable' => 'DataTables\View\Helper\DataTable'
        )
    ),
    'router' => array(
        'routes' => array(
            'test' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/test[/[:controller[/[:action]]]]',
                    'constraints' => array(
                        'controller' => '[a-zA-Z][a-zA-Z0-9_-]*/?',
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*/?',
                    ),
                    'defaults' => array(
                        'controller' => 'Test\Controller\Test',
                        'action' => 'index',
                    ),
                ),
                'may_terminate' => true,
            ),
        ),
    ),
    'doctrine' => array(
        'driver' => array(
            __NAMESPACE__ . '_driver' => array(
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'array',
                'paths' => array(__DIR__ . '/../src/' . __NAMESPACE__ . '/Entity')
            ),
            'orm_default' => array(
                'drivers' => array(
                    __NAMESPACE__ . '\Entity' => __NAMESPACE__ . '_driver'
                )
            )
        ),
    )
);