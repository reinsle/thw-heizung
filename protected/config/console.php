<?php

require_once('_common.inc');

return array(
    'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
    'name' => 'My Console Application',
    // preloading 'log' component
    'preload' => array('log'),
    // autoloading model and component classes
    'import' => array(
        'application.models.*',
        'application.components.*',
        'ext.giix.components.*',
    ),
    // application components
    'components' => array(
        'db' => require(dirname(__FILE__) . '/db.php'),
        // uncomment the following to use a MySQL database
        /*
        'db' => array(
            'connectionString' => 'pgsql:host=10.4.3.30;dbname=heizung',
            'emulatePrepare' => true,
            'username' => 'heizung',
            'password' => 'ni.xd.ol',
            'charset' => 'utf8',
        ),
         */
        'log' => array(
            'class' => 'CLogRouter',
            'routes' => array(
                array(
                    'class' => 'CFileLogRoute',
                    'levels' => 'error, warning',
                ),
            ),
        ),
    ),
    'params' => $commonParams
);
