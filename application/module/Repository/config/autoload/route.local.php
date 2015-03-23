<?php
return array(
    'router' => array(
        'routes' => array(
            'my-repo' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route' => '/my-repo',
                    'defaults' => array(
                        'controller' => 'Repository\Controller\Index',
                        'action' => 'index',
                    ),
                ),
            ),
            'view-file' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/my-repo/view[/:filename]',
                    'constraints' => array(
                        'filename'  => '[a-zA-Z0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'Repository\Controller\Index',
                        'action' => 'view',
                    ),
                ),
            ),
            'create-folder' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route' => '/create-folder',
                    'defaults' => array(
                        'controller' => 'Repository\Controller\Folder',
                        'action' => 'create',
                    ),
                ),
            ),
            'add-file' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route' => '/add-file',
                    'defaults' => array(
                        'controller' => 'Repository\Controller\File',
                        'action' => 'add',
                    ),
                ),
            ),
            'download-file' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/download-file[/:filename]',
                    'constraints' => array(
                        'filename'  => '[a-zA-Z0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'Repository\Controller\File',
                        'action' => 'download',
                    ),
                ),
            ),
        ),
    ),
);