<?php
/*
|--------------------------------------------------------------------------
| Author : Shajahan Basha Syed
| Class : Cookie
| Description : It contains all methods to work with cookies
|--------------------------------------------------------------------------
|
*/
	class Cookie{
		
		var $cookiekey;
		function __Construct($key=''){
			
			if($key==''){
				if(_ENV_['COOKIE_PREFIX']==""){
					$this->cookiekey = 'cookie_';
				} else{
					$this->cookiekey = _ENV_['COOKIE_PREFIX'];
				}
			} else{
				$this->cookiekey = $key;
			}

		}

		function setData($cookies, $expire = 0, $path = "", $domain = "", $secure = false,$httponly = false){
			foreach($cookies as $key => $value){
				setcookie ($this->getKey($key), $value, $expire, $path, $domain, $secure, $httponly);
			}
		}

		function getData($key){

			if(isset($_COOKIE[$this->getKey($key)])){
				return $_COOKIE[$this->getKey($key)];
			} else{
				return "";
			}
		}

		function remove($key, $path = "", $domain = "",$secure = false,$httponly = false){
			$expire = time()-3600;
			$value = '';
			setcookie($this->getKey($key), $value, $expire, $path, $domain, $secure, $httponly);
		}

		function destroy($expire = 0, $path = "", $domain = "",$secure = false,$httponly = false){

			$expire = time()-3600*10;
			$value = '';

			foreach($_COOKIE as $key => $val){

				setcookie ($this->getKey($key), $value, $expire, $path, $domain, $secure, $httponly);

			}
		}

		function destroyAll(){
			$expire = time()-3600*10;
			$value = '';
			
			foreach($_COOKIE as $key=>$val){
				setcookie ($key, $value, $expire, $path, $domain, $secure, $httponly);
			}
		}

		function getKey($key){			
			
			$cookie_key = $this->cookiekey.$key;
			return $cookie_key;
		}
	}

?>
