<?php
return array(
    //view manager
	'view_manager'	=> array(
		'template_path_stack'	=> array(
			__DIR__ . '/../view',
		)
	),
    'doctrine' => array(
    	'driver' => array(
			'repository_entities' => array(
				'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
				'cache' => 'array',
			    'paths' => array(__DIR__ . '/../src/Repository/Entity')
			),
			'orm_default' => array(
				'drivers' => array(
						'Repository\Entity' =>  'repository_entities'
				),
			),
    	),
    ),
);