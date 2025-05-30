<?php
    if (!defined('PHP_VERSION_ID')) {

    $version = explode('.', PHP_VERSION);

    define('PHP_VERSION_ID', ($version[0] * 10000 + $version[1] * 100 + $version[2]));
    }

    if (PHP_VERSION_ID < 50600) {

    $err = 'Composer 2.3.0 dropped support for autoloading on PHP <5.6 and you are running '.PHP_VERSION.', please upgrade PHP or use Composer 2.2 LTS via "composer self-update --2.2". Aborting.'.PHP_EOL;

    error_message($err);
    exit;

    }

    define('DS',URL_DIRECTORY_SEPARATOR);

    $url_webpath =  trimCornerSlashes(array_key_first($_GET));

    if(checkForAPI(_ENV_['API_ROOT_URL'],$url_webpath)){
        define('APP_LOADER','API');
    } else{
        define('APP_LOADER','WEB');
    }

    define('APP_HOST_DIR',ROOT_DIR) ;

    if(ROOT_DIR==SERVER_ROOT_DIR){
        define("HOSTED_DIR",'');
        define('URL_PATH','');
    } else{
        if(APP_LOADER=='WEB'){
            $hosted_dir = str_replace(SERVER_ROOT_DIR,'',ROOT_DIR);
            define("HOSTED_DIR",$hosted_dir);
            define('URL_PATH','');
        } else{
            $hosted_dir = str_replace(SERVER_ROOT_DIR,'',ROOT_DIR);
            define("HOSTED_DIR",'');
            define('URL_PATH',HOSTED_DIR.URL_DIRECTORY_SEPARATOR.'api');
        }

    }

    define('SITE_URL',getURLS());

    $url_webpath = (!is_null($url_webpath)) ? $url_webpath : '';

    if(APP_LOADER=='WEB'){ 
        define('WEBPATH',rtrim($url_webpath,URL_DIRECTORY_SEPARATOR));
    } else{
        define('WEBPATH',rtrim(ltrim($url_webpath,trim(_ENV_['API_ROOT_URL'])),URL_DIRECTORY_SEPARATOR));
    }
	
	if(_ENV_['ENABLE_SESSION']==true || _ENV_['ENABLE_SESSION']=='true'){
		session_start();
		$_SESSION['session_enable'] = 1;
    }

   // autoLoadFiles(ROOT_DIR.FRAMEWORK_DIRECTORY_SEPARATOR.'config'.FRAMEWORK_DIRECTORY_SEPARATOR);

    $configDir = ROOT_DIR.FRAMEWORK_DIRECTORY_SEPARATOR.'config'.FRAMEWORK_DIRECTORY_SEPARATOR;

    foreach (glob($configDir . '*.php') as $configFIle) {
        require_once $configFIle;
    }
   
    if(_ENV_['ENABLE_SERVER_SETTINGS']==true || _ENV_['ENABLE_SERVER_SETTINGS']=='true'){
		save_server_settings($_SETTINGS);
	}
   
    foreach($_USER as $userconstkey => $userconstvalue){
        define('USERCONST_'.strtoupper($userconstkey),$userconstvalue);
    }

    //autoLoadFiles(ROOT_DIR.FRAMEWORK_DIRECTORY_SEPARATOR.'vendor'.FRAMEWORK_DIRECTORY_SEPARATOR.'library'.FRAMEWORK_DIRECTORY_SEPARATOR);

    require_once ROOT_DIR.FRAMEWORK_DIRECTORY_SEPARATOR.'vendor'.FRAMEWORK_DIRECTORY_SEPARATOR.'system'.FRAMEWORK_DIRECTORY_SEPARATOR.'application.php';

    $systemDir = ROOT_DIR.FRAMEWORK_DIRECTORY_SEPARATOR.'vendor'.FRAMEWORK_DIRECTORY_SEPARATOR.'system'.FRAMEWORK_DIRECTORY_SEPARATOR;

    foreach (glob($systemDir . '*.php') as $systemfile) {        
        if(str_replace($systemDir,'',$systemfile)!='application.php'){                		
            require_once $systemfile;
        }
    }

    require_once ROOT_DIR.FRAMEWORK_DIRECTORY_SEPARATOR.'vendor'.FRAMEWORK_DIRECTORY_SEPARATOR.'core'.FRAMEWORK_DIRECTORY_SEPARATOR.'routing.php';
?>