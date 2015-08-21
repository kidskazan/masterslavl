<?php

// comment out the following two lines when deployed to production
defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_ENV') or define('YII_ENV', 'dev');
define('DOMPDF_ENABLE_AUTOLOAD', false);

//1define('YII_ENABLE_ERROR_HANDLER', false);
//2define('YII_ENABLE_EXCEPTION_HANDLER', false); 

// Turn off all error reporting
// error_reporting(0);

// Report all errors except E_NOTICE
// This is the default value set in php.ini
//3error_reporting(E_ALL ^ E_NOTICE);

require(__DIR__ . '/../vendor/autoload.php');
require(__DIR__ . '/../vendor/yiisoft/yii2/Yii.php'); 

require(__DIR__ . '/../vendor/dompdf/dompdf/dompdf_config.inc.php'); 
$config = require(__DIR__ . '/../config/web.php');

(new yii\web\Application($config))->run();
