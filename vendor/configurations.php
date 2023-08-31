<?php

    define('FRAMEWORK_VERSION',1);

    define('SERVER_ROOT_DIR',$_SERVER["DOCUMENT_ROOT"]);

    $core = VENDOR_DIR.'/core/';

    $corefiles = scandir($core);

    foreach($corefiles as $coreincluder){

        $spath = $core.$coreincluder;

        if(!is_dir($spath)){
            include "$spath";
        }
    }

    $url_webpath =  array_key_first($_GET);

    if(checkForAPI(API_NOTATION,$url_webpath)){
        define('APP_LOADER','API');
    } else{
        define('APP_LOADER','WEB');
    }

    /*if(APP_LOADER=='WEB'){
        define('APP_HOST_DIR',ROOT_DIR) ;
    } else{
        define('APP_HOST_DIR',rtrim(ROOT_DIR,"/api")) ;
    }*/
    define('APP_HOST_DIR',ROOT_DIR) ;
    
    if(ROOT_DIR==SERVER_ROOT_DIR){
        define("HOSTED_DIR",'');
        define('URL_PATH','');
    } else{
        if(APP_LOADER=='WEB'){
            $hosted_dir = str_replace(SERVER_ROOT_DIR,'',APP_HOST_DIR);
            define("HOSTED_DIR",$hosted_dir);
            define('URL_PATH','');
        } else{
            $hosted_dir = str_replace(SERVER_ROOT_DIR,'',APP_HOST_DIR);
            define("HOSTED_DIR",'');
            define('URL_PATH',HOSTED_DIR.'/api');
        }

    }

    if (!defined('PHP_VERSION_ID')) {
        $version = explode('.', PHP_VERSION);

        define('PHP_VERSION_ID', ($version[0] * 10000 + $version[1] * 100 + $version[2]));
    }

    if(PHP_VERSION_ID<50600){
        error_message('This frameworks needs to be a <b>minimum version</b> of <b>PHP 5.6.0</b>','VERSION IN COMPATABLE ERROR');
        exit;
    }

    $web_site_url = getURLS();

    define('SITE_URL',$web_site_url);

    $url_webpath = (!is_null($url_webpath)) ? $url_webpath : '';

    if(APP_LOADER=='WEB'){ 
        define('WEBPATH',rtrim($url_webpath,DS));
    } else{
        define('WEBPATH',rtrim(ltrim($url_webpath,trim(API_NOTATION)),DS));
    }


  require_once(VENDOR_DIR.'/includers.php');


?>
