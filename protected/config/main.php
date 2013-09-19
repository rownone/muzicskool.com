<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'Muzic\'skool.com',

	// preloading 'log' component
	'preload'=>array('log'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
	),

	'modules'=>array(
		// uncomment the following to enable the Gii tool
		
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'gii',
			// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','::1'),
		),
		
	),

	// application components
	'components'=>array(
		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
            'class' => 'WebUser',
		),
		// uncomment the following to enable URLs in path-format
		/*
		'urlManager'=>array(
                        'urlFormat'=>'path',
			'showScriptName'=>false,
			'rules'=>array(
                                'site/page/<view:\w+>'=>'site/page',
				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
			),
         
            //'rules'=>array(
                //'<controller:\w+>/<id:\d+>'=>'<controller>/view',
                //'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>', // this is the rule you absolutely need for update to work
                //'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
                //'<action>'=>'site/<action>'
            //),

		),
		*/
		/*'db'=>array(
			'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
		),*/
		// uncomment the following to use a MySQL database
		
		'db'=>array(
			'connectionString' => 'mysql:host=localhost;dbname=app',
			'emulatePrepare' => true,
			'username' => 'root',
			'password' => '',
			'charset' => 'utf8',
		),
		
		'errorHandler'=>array(
			// use 'site/error' action to display errors
			'errorAction'=>'site/error',
		),
        
		/*'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				
				array(
					'class'	=> 'CFileLogRoute',
					'categories' => 'system.*',
                    'levels' => 'error, warning, trace, info, debug',
                    'logFile' => 'application.log',  
				),
				
				array(
					'class' => 'CWebLogRoute',
					'categories' => 'system.db.CDbCommand',
					'showInFireBug' => true,
				),
				// uncomment the following to show log messages on web pages
				
				//array(
					//'class'=>'CWebLogRoute',
				//),
				
			),
		),*/
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
        'defaultPageSize'=>100,
		// this is used in contact page
		'adminEmail'=>'row_none@yahoo.com',
        'individual'=>1,
        'group'=>2,
        'band'=>3,
        'ongoing'=>'On-going',
        'finished'=>'Finished',
        'completeStr'=>'Complete',
        'ongoingStr'=>'On-going',
        'finishedStr'=>'Finished',
        'done'=>'Done',
        'close'=>1,
        'open'=>0,
        'forSchedule'=>0,
        'onGoing'=>2,
        'complete'=>1,
        'unPaid'=>0,
        'withBalance'=>2,
        'fullyPaid'=>1,
        'isGroupCourse'=>1,
        'isNotGroupCourse'=>0
	),
);