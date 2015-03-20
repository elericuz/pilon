<?php
return array(
    'doctrine' => array(
        'driver' => array(
            'Application_driver' => array(
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
			    'cache' => 'array',
			    'paths' => array(__DIR__ . '/../src/Application/Entity')
			),
			'orm_default' => array(
			    'drivers' => array(
			        'Application\Entity' =>  'Application_driver'
			    ),
			),
        ),
        'connection' => array(
            'orm_default' => array(
                'driverClass' => 'Doctrine\DBAL\Driver\PDOMySql\Driver',
                'params' => array(
					'host' => 'localhost',
					'port' => '3306',
					'dbname' => 'beaker',
					'user' => 'devuser',
					'password' => 'password',
                ),
            ),
        ),
    ),
);
?>