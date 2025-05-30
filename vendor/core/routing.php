<?php
    $appurlpath = array();
    $urlpath_string = rtrim(WEBPATH,URL_DIRECTORY_SEPARATOR);
    if($urlpath_string!=''){        
        $appurlpath = explode(URL_DIRECTORY_SEPARATOR, $urlpath_string);
    }

	$appurlsize = count($appurlpath);

    if(APP_LOADER=='WEB'){
        
        require_once ROOT_DIR.FRAMEWORK_DIRECTORY_SEPARATOR._ENV_['APP_DIR'].FRAMEWORK_DIRECTORY_SEPARATOR.'routes'.FRAMEWORK_DIRECTORY_SEPARATOR.'web.php';

        if($appurlsize==0){
            $controller = _ENV_['DEFAULT_CONTROLLER'];
            $appMethod = _ENV_['INDEX_METHOD'];
        } else{
            $flag = false;

            foreach($_URL as $key=>$value){			
                $keycount = count(explode(URL_DIRECTORY_SEPARATOR,rtrim($key,URL_DIRECTORY_SEPARATOR)));
                $urlcount = count(explode(URL_DIRECTORY_SEPARATOR,rtrim(WEBPATH,URL_DIRECTORY_SEPARATOR)));
                $bl = (int) parseWebURL($key,rtrim(WEBPATH,URL_DIRECTORY_SEPARATOR));
                $blt = (int) true;
                
                if(parseWebURL($key,rtrim(WEBPATH,URL_DIRECTORY_SEPARATOR)) && ($keycount==$urlcount)){
                    $flag = true;
                    $keyurl = $key;
                }
            }
            
            if($flag){
                $ctrl = explode('@',$_URL[$keyurl]);
                $controller = $ctrl[0];
                $appMethod = $ctrl[1];
            } else{ 
                if(array_key_exists(URL_DIRECTORY_SEPARATOR,$_URL)){			
                    $ctrl = explode('@',$_URL[URL_DIRECTORY_SEPARATOR]);
                    $controller = $ctrl[0];
                    $appMethod = $ctrl[1];
                } else{
                    $controller = _ENV_['DEFAULT_404_CONTROLLER'];
                    $appMethod = _ENV_['INDEX_METHOD'];
                }
                
            }
        }

        $controllersDir = ROOT_DIR.FRAMEWORK_DIRECTORY_SEPARATOR._ENV_['APP_DIR'].FRAMEWORK_DIRECTORY_SEPARATOR.'controller'.FRAMEWORK_DIRECTORY_SEPARATOR;

        $modelsDir = ROOT_DIR.FRAMEWORK_DIRECTORY_SEPARATOR._ENV_['APP_DIR'].FRAMEWORK_DIRECTORY_SEPARATOR.'model'.FRAMEWORK_DIRECTORY_SEPARATOR;

        $ctrlfile = $controllersDir.$controller._ENV_['DEFAULT_EXTENSION'];
        $mdlfile = $modelsDir.$controller._ENV_['DEFAULT_EXTENSION'];
        
        $ctrlparts = explode(URL_DIRECTORY_SEPARATOR,$controller);
        $appClass = $ctrlparts[count($ctrlparts)-1];
        
        define('APP_ROUTER_CLASS',$appClass);
        
        if(file_exists($ctrlfile)){

            require_once($ctrlfile);

            if(file_exists($mdlfile)){
                
                require_once($mdlfile);
            }

            $controllerClass = $appClass."Ctrl";
            
            if(class_exists($controllerClass)){

                $controllerobj = new $controllerClass();

                if(method_exists($controllerobj,$appMethod)){
                    $controllerobj->$appMethod();				
                } else{	
                    error_message('Unable to find method <b>'.$appMethod.'</b> of <i>'.$appClass.'</i> class in '.$ctrlfile,'Routing Error');
                    exit;
                }
            } else{
                error_message('Unable to find class <b>'.$controllerClass.'</b> class in '.$ctrlfile,'Routing Error');
                exit;
            }
            
        } else{
            error_message('Controller file <b>'.$ctrlfile.'</b> does not exist.','Routing Error');
            exit;
        }

        
    } else{
      

        require_once ROOT_DIR.FRAMEWORK_DIRECTORY_SEPARATOR._ENV_['APP_DIR'].FRAMEWORK_DIRECTORY_SEPARATOR.'routes'.FRAMEWORK_DIRECTORY_SEPARATOR.'api.php';

        if($appurlsize==0){
            $request_url = SITE_URL.WEBPATH;
            error_message("Requested API URL <b>$request_url</b> not found","Invalid Request.");
            exit;
        }
       
        
        $flag = false;
            
        foreach($_URL as $key=>$value){
            $urlpattern = ltrim($key,URL_DIRECTORY_SEPARATOR);
            $apipath = ltrim(WEBPATH,URL_DIRECTORY_SEPARATOR);
            $keycount = count(explode(URL_DIRECTORY_SEPARATOR,$urlpattern));
            $urlcount = count(explode(URL_DIRECTORY_SEPARATOR,$apipath));
            
            if(parseWebURL(rtrim($urlpattern,URL_DIRECTORY_SEPARATOR),rtrim($apipath,URL_DIRECTORY_SEPARATOR)) && ($keycount==$urlcount)){
                $flag = true;
                $keyurl = $key;
            }				
        }
        
        if($flag){
           $apiparts = explode('@',$_URL[$keyurl]);
           $classPath = $apiparts[0];
           $apiMethod = $apiparts[1];
        } else{ 
            if(array_key_exists(URL_DIRECTORY_SEPARATOR,$_URL)){			
                $apiparts = explode('@',$_URL[URL_DIRECTORY_SEPARATOR]);
                $classPath = $apiparts[0];
                $apiMethod = $apiparts[1];
            } else{
                $request_url = SITE_URL.WEBPATH;
                error_message("Requested API URL <b>$request_url</b> not found","Invalid Request."); 
                exit;
            }
            
        }

        
        $apiDir = ROOT_DIR.FRAMEWORK_DIRECTORY_SEPARATOR._ENV_['APP_DIR'].FRAMEWORK_DIRECTORY_SEPARATOR.'api'.FRAMEWORK_DIRECTORY_SEPARATOR;

        $apifile = $apiDir.$classPath._ENV_['DEFAULT_EXTENSION'];
     
        
       // $apifile = API_ROOT_DIR.DS."$classPath".EXT;
        
        $apipathparts = explode(URL_DIRECTORY_SEPARATOR,$classPath);
        $apiClass = $apipathparts[count($apipathparts)-1];
        
        if(file_exists($apifile)){
    
            require($apifile);
            
            if(class_exists($apiClass)){
    
                $apiobj = new $apiClass();
    
                if(method_exists($apiobj,$apiMethod)){
                    $apiobj->$apiMethod();				
                } else{	
                    error_message("Request Method <b>$apiMethod</b> of <b>$apiClass</b> Class does not exist in <b>$apifile</b>","Invalid Request");
                    exit;
                }
            } else{
                error_message("Request API Class <b>$apiClass</b> does not exist in <b>$apifile</b>","Invalid Request");
                exit;
            }
            
        } else{	
            error_message("File <b>$apifile</b> does not exist","File Not Found");
            exit;
        }
    }
?>