<?php
    $configs_dir = VENDOR_DIR.'/config/';

    $configincludes = scandir($configs_dir);		 

    // Loading all configurations
    for($i=0;$i<count($configincludes);$i++){
        $includer = $configincludes[$i];
        if(!is_dir($configs_dir.$includer)){				
            require_once($configs_dir.$includer);
        }
    }
    
    foreach($_CONFIG as $configkey => $configvalue){
        $key = 'CONFIG_'.strtoupper($configkey);        
        define($key, $configvalue);
    }
   
    foreach($_USER as $userconstkey => $userconstvalue){
        define('USERCONST_'.strtoupper($userconstkey),$userconstvalue);
    }

    $libraries_dir = CONFIG_LIBRARIES;

    $autoloadLibraries = $autoload['libraries'];

    for($i=0;$i<count($autoloadLibraries);$i++){
		$library = $libraries_dir.'/'.$autoloadLibraries[$i].EXT;
		if(file_exists($library)){
			require_once($library);
		}
    }
    
    if(CONFIG_CUSTOM_SERVER_SETTINGS==1){
		save_server_settings($_SETTINGS);
	}
	
	if(CONFIG_SESSION_ENABLE==1){
		session_start();
		$_SESSION['session_enable'] = 1;
    }
    
    $system_dir = VENDOR_DIR.'/system/';


    require_once($system_dir.'application.php');

    $systemcludes = scandir($system_dir);		 

  
    for($i=0;$i<count($systemcludes);$i++){
        $includer = $systemcludes[$i];
        if(!is_dir($system_dir.$includer)){	
            if($includer!='application.php'){                		
                require_once($system_dir.$includer);
            }	
        }
    }

   
    require_once(VENDOR_DIR.'/routing.php');



?>