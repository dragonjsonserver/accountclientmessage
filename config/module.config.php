<?php
/**
 * @link http://dragonjsonserver.de/
 * @copyright Copyright (c) 2012-2014 DragonProjects (http://dragonprojects.de/)
 * @license http://license.dragonprojects.de/dragonjsonserver.txt New BSD License
 * @author Christoph Herrmann <developer@dragonprojects.de>
 * @package DragonJsonServerAccountclientmessage
 */

/**
 * @return array
 */
return [
	'service_manager' => [
		'invokables' => [
            '\DragonJsonServerAccountclientmessage\Service\Accountclientmessage' => '\DragonJsonServerAccountclientmessage\Service\Accountclientmessage',
		],
	],
	'doctrine' => [
		'driver' => [
			'DragonJsonServerAccountclientmessage_driver' => [
				'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
				'cache' => 'array',
				'paths' => [
					__DIR__ . '/../src/DragonJsonServerAccountclientmessage/Entity'
				],
			],
			'orm_default' => [
				'drivers' => [
					'DragonJsonServerAccountclientmessage\Entity' => 'DragonJsonServerAccountclientmessage_driver'
				],
			],
		],
	],
];
