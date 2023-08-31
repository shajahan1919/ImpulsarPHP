<?php

    error_reporting(E_ALL);

    ini_set('display_errors', 1);

    define('FRAMEWORK_DIRECTORY',str_replace('/','',str_replace($_SERVER['DOCUMENT_ROOT'],'',dirname(__FILE__))));

    define('API_NOTATION','api');

    define('ROOT_DIR',__DIR__);

    define('API_ROOT_DIR',ROOT_DIR.'/api');

    define('EXT','.php');

    define('DS','/');

    define('VENDOR_DIR',ROOT_DIR.'/vendor');

    define('ENVIRONMENT','production');


    require_once(VENDOR_DIR.'/configurations.php');


?>
