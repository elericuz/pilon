<?php
return array(
    'router' => array(
        'routes' => array(
            'my-repo' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/my-repo[/:folder]',
                    'constraints' => array(
                        'folder'  => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'Repository\Controller\Index',
                        'action' => 'index',
                    ),
                ),
            ),
            'view-file' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route' => '/my-repo/view',
                    'defaults' => array(
                        'controller' => 'Repository\Controller\Index',
                        'action' => 'view',
                    ),
                ),
            ),
        ),
    ),
);