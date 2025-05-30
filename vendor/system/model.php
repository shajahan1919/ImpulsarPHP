<?php
/*
|--------------------------------------------------------------------------
| Author : Shajahan Basha Syed
| Class : Model
| Description : This class is a parent class for all model.
|				It Contains all model functionality
|--------------------------------------------------------------------------
| 
*/
	class Model extends Application{
		
		private static $instance;
		
		
		var $session;
		
		var $cookie;
		
		function __Construct(){					
			
			self::$instance = &$this;
		}
		
		function get_instance(){
			return self::$instance;
		}
		
	}
?>