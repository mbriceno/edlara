<?php

/**
 *  --------------------------------------------------------------
 *  | You can create a local config file with the content below. |
 *  --------------------------------------------------------------
 *  If environment variable 'APPLICATION_ENV' is defined 
 *  and your model $config is 'default',we use APPLICATION_ENV as the section name.
 */
return array(

   /* Configuration section name*/
	'default' => array(
		'connection' => array(
			'hostnames' => '127.0.0.1:27018',
			'database'  => 'laraveltest3',
// 			'username'  => '',
// 			'password'  => '',
		)
	),
	'development' => array(
		'connection' => array(
			'hostnames' => 'localhost',
			'database'  => 'development_db',
// 			'username'  => '',
// 			'password'  => '',
		)
	),
	'testing' => array(
		'connection' => array(
			'hostnames' => 'localhost,192.168.1.2',
			'database'  => 'test_db',
// 			'username'  => '',
// 			'password'  => '',
		)
	),
	'production' => array(
			'connection' => array(
				'hostnames' => 'localhost',
				'database'  => 'production_db',
// 				'username'  => '',
// 				'password'  => '',
			)
	)
);

