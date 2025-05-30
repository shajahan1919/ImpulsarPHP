<?php
/*
|--------------------------------------------------------------------------
| Author : Shajahan Basha Syed
| Class : session
| Description : This contains all methods to work with sessions
|--------------------------------------------------------------------------
|
*/

	class session{

	    public  $sessionkey;
		
		function __Construct($key=''){
		
			if(_ENV_['SESSION_PREFIX']==1){
				$_SESSION['session_enable'] = 1;
			}
			if($key==''){
				
				if(_ENV_['SESSION_PREFIX']==""){
					$this->sessionkey = 'session_';
				} else{
					$this->sessionkey = _ENV_['SESSION_PREFIX'];
				}
			} else{
				$this->sessionkey = $key;
			}

			
			
		}

		function isEnable(){
			if(isset($_SESSION['session_enable']) && _ENV_['ENABLE_SESSION']==true){
				return true;
			} else{
				return false;
			}
		}

		function setData($sess){
			if($this->isEnable()){
				foreach($sess as $key => $val){
					$_SESSION[$this->getKey($key)] = $val;
				}
			} else{
				exit('Session is not set. Please set session again');
			}
		}

		function getData($key){
			if(isset($_SESSION[$this->getKey($key)])){
				return $_SESSION[$this->getKey($key)];
			} else{
				return "";
			}
		}

		function getAllData(){

			$session = array();

			foreach($_SESSION as $key => $val){
				if($key!="session_enable"){
					$session[$this->getKey($key)] = $val;
				}
			}

			return $session;
		}

		function remove($key){
			unset($_SESSION[$this->getKey($key)]);
		}

		function destroy(){ 
			foreach($_SESSION as $key => $val){
				if($key!="session_enable"){
					unset($_SESSION[$this->getKey($key)]);
				}
			}
			$this->destroyAll();
		}

		function destroyAll(){
			session_destroy();
		}
		
		function getKey($key){	
			
			$session_key = $this->sessionkey.$key;
			return $session_key;
		}
	}
?>
