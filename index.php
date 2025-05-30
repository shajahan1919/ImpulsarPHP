<?php

/**
 * Impulsar - A PHP Framework For Web Artisans
 *
 * @package  Impulsar
 * @author   Shajahan Basha Syed <shajahanbasha.syed@gmail.com>
 */
 define('URL_DIRECTORY_SEPARATOR','/');
 
 define('FRAMEWORK_DIRECTORY_SEPARATOR',DIRECTORY_SEPARATOR);

 define('ROOT_DIR',__DIR__);

 define('SERVER_ROOT_DIR',$_SERVER["DOCUMENT_ROOT"]);

 define('APP_DIRECTORY',str_replace('/','',str_replace(trim(str_replace('\\',URL_DIRECTORY_SEPARATOR,$_SERVER['DOCUMENT_ROOT']),'/'),'',str_replace('\\',URL_DIRECTORY_SEPARATOR,__DIR__))));

 define('_ENV_', parse_ini_file(ROOT_DIR.FRAMEWORK_DIRECTORY_SEPARATOR.'.env'));

 define('APP_ENVIRONMENT',_ENV_['APP_ENV']);

 require_once __DIR__.DIRECTORY_SEPARATOR.'vendor'.DIRECTORY_SEPARATOR.'autoload.php';

?>