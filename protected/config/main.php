<?php

return array(
    'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
    'name' => 'THW Heizung',

    // preloading 'log' component
    'preload' => array('log'),

    'aliases' => array(
        'bootstrap' => realpath(__DIR__ . '/../extensions/bootstrap'),
    ),

    // autoloading model and component classes
    'import' => array(
        'application.models.*',
        'application.components.*',
        'bootstrap.helpers.TbHtml',
        'ext.giix.components.*',
    ),

    'modules' => array(
        // uncomment the following to enable the Gii tool
        'gii' => array(
            'class' => 'system.gii.GiiModule',
            'password' => 'ni.xd.ol',
            // If removed, Gii defaults to localhost only. Edit carefully to taste.
            'ipFilters' => array('127.0.0.1', '::1', '10.4.5.124'),
            'generatorPaths' => array(
                'bootstrap.gii',
                'ext.giix.generators',
            ),
        ),
    ),

    // application components
    'components' => array(
        'format' => array(
            'datetimeFormat' => 'd.m.Y H:i',
            'dateFormat' => 'd.m.Y',
            'numberFormat' => array(
                'decimals' => '2',
                'decimalSeparator' => ',',
                'thousandSeparator' => '.'
            ),
        ),
        'user' => array(
            // enable cookie-based authentication
            'allowAutoLogin' => true,
        ),
        // uncomment the following to enable URLs in path-format
        'urlManager' => array(
            'urlFormat' => 'path',
            'rules' => array(
                '<controller:\w+>/<id:\d+>' => '<controller>/view',
                '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
                '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
            ),
        ),
        'db' => require(dirname(__FILE__) . '/db.php'),
        'errorHandler' => array(
            'errorAction' => 'site/error',
        ),
        'log' => array(
            'class' => 'CLogRouter',
            'routes' => array(
                array(
                    'class' => 'CFileLogRoute',
                    'levels' => 'error, warning',
                ),
                // uncomment the following to show log messages on web pages
                array(
                    'class' => 'CWebLogRoute',
                    'class' => 'CFileLogRoute',
                    'levels' => 'error, warning, info',
                ),
            ),
        ),
        'bootstrap' => array(
            'class' => 'bootstrap.components.TbApi',
        ),
        'messages' => array(
            'extensionPaths' => array(
                'giix' => 'ext.giix.messages',
            ),
        ),
    ),

    'params' => require(dirname(__FILE__) . '/params.php'),
);
