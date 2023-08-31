<?php

if (!function_exists('array_key_first')) {
	function array_key_first(array $arr) {

		foreach($arr as $key => $unused) {
			return $key;
		}

		return NULL;
	}
}
	function checkForAPI($key,$url){

		$key = (!is_null($key)) ? $key : '';

		$url = (!is_null($url)) ? $url : '';

		if(strtolower(substr(trim($url),0,strlen(trim($key))))==strtolower(trim($key))){
			return true;
		} else{
			return false;
		}

	}

	function save_server_settings($settings){

		foreach($settings as $key => $value){
			if($key=='DISPLAY_ERRORS'){
				if($value){
					error_reporting(E_ALL);
				} else{
					error_reporting(0);
				}
			} else{
				ini_set($key,$value);
			}
		}

	}

	function parseWebURL($urlpattern,$url){

		$urlpattern = trimCornerSlashes($urlpattern);
		$url = trimCornerSlashes($url);

		$urlptrnar = explode("/",ltrim($urlpattern,"/"));
		$urlar = explode("/",ltrim($url,"/"));
		$ptrsize = count($urlptrnar);
		$urlsize = count($urlar);


		if($urlsize>=$ptrsize){
			$flag = 0;
			for($index=0;$index<$ptrsize;$index++){
				$pstr=trim($urlptrnar[$index]);
				$ustr=trim($urlar[$index]);
				if(substr($pstr,0,1)=="{"){
					$flag++;
				} else{
					if($pstr==$ustr){
						$flag++;
					}
				}
			}
			if($flag==$ptrsize){
				return true;
			} else{
				return false;
			}
		}else{
			return false;
		}
	}


    function getURLS()
    {
        $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
				$domainName = $_SERVER['HTTP_HOST'].URL_PATH.'/';
				return $protocol.$domainName;
    }

    function getDomain()
    {
       if(HOSTED_DIR==''){
            $domainName = $_SERVER['HTTP_HOST'];
        } else{
            $domainName = $_SERVER['HTTP_HOST'].URL_PATH;
        }

        return $domainName;
    }


    function trimCornerSlashes($string, $position='both'){

        if($position=="both"){
            if(substr($string,0,1)==DS){
                $string = substr($string,1,strlen($string)-1);
            }
            if(substr($string,strlen($string)-1,1)==DS){
                $string = substr($string,0,strlen($string)-1);
            }
        } else if($position=="left"){
            if(substr($string,0,1)==DS){
                $string = substr($string,1,strlen($string)-1);
            }
        } else{
            $string = substr($string,0,strlen($string)-1);
        }

        return $string;
	}

	function set_header($headers){
		if(!headers_sent()){
			header($headers);
		}
	}

?>
