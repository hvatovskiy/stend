<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
	'language' => 'ru-RU', // русификация 
	'modules' => [
		'admin' => [
			'class' => 'mdm\admin\Module',
            'layout' => 'left-menu',//
		],
    ],
	/*'aliases' => [
		'@app' => '/frontend/web',
        '@admin' => '/backend/web',
    ], */
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-frontend',
			'baseUrl' => '',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-frontend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the frontend
            'name' => 'advanced-frontend',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
       
        'urlManager' => [
			'class' => 'yii\web\UrlManager',
            'enablePrettyUrl' => true,
			'enableStrictParsing' => false,
            'showScriptName' => false,
            'rules' => [
				''=>'site/index',
				//'<controller:\w+>/<id:\d+>' => '<controller>/view',
				'<controller:\w+>/<action:\w+>' => '<controller>/<action>',
				//'<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',				
				'<controller>/<action>' => '<controller>/<action>',				
            ],
        ],
		'authManager' => [
            'class' => 'yii\rbac\DbManager',
			//'defaultRoles' => ['guest'],
		],
		/* 'i18n' => [
        'translations' => [
            'app*' => [
                'class' => 'yii\i18n\PhpMessageSource',
                //'basePath' => '@app/messages',
				//'basePath' => 'frontend/messages',
                'sourceLanguage' => 'en-US',
                'fileMap' => [
                    'app'       => 'app.php',
                    'app/error' => 'error.php',
                ],
            ],
			'site*' => [
                'class' => 'yii\i18n\PhpMessageSource',
                //'basePath' => '@app/messages',
				//'basePath' => 'frontend/messages',
                'sourceLanguage' => 'en-US',
                'fileMap' => [
                    'site'       => 'app.php',
                    'site/error' => 'error.php',
                ],
            ],
        ],
    ], */		
    ],
	'as access' => [
        'class' => 'mdm\admin\components\AccessControl',
        'allowActions' => [
			//'some-controller/some-action',
            'site/*',
            'admin/*',
			'gii/*',
            'debug/*',
			//'article/*',
			//'agency/*',
			//'link/*',
			//'user/*',
            'message/*',
            'agency-article/*',
            'blog/*',
            // Действия , перечисленные здесь, будут разрешены всем, включая гостей.
            // Таким образом, 'admin/*', 'user/*', не должны появляться здесь в production-версии.
            // По окончании настройки RBAC оставить ТОЛЬКО 'site/*' !!!
        ],
    ],
    'params' => $params,
];
