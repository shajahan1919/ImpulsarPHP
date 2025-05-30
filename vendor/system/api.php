<?php
/*
|--------------------------------------------------------------------------
| Author : Shajahan Basha Syed
| Class : Model
| Description : This class is a parent class for all apis.
|--------------------------------------------------------------------------
| 
*/
	class API extends Application{
		
		private static $instance;
			
		var $session;
		
		var $cookie;
		
		function __Construct(){					
			
			self::$instance = &$this;
		}
		
		function get_instance(){
			return self::$instance;
		}

		function generateJSONResponse($response){ 

			header('Content-Type:application/json');

			echo json_encode($response,JSON_FORCE_OBJECT);

		} 

		function generateXMLResponse($array, $rootElement = null, $xml = null) { 
			$_xml = $xml; 
			  
			// If there is no Root Element then insert root 
			if ($_xml === null) { 
				$_xml = new SimpleXMLElement($rootElement !== null ? $rootElement : '<root/>'); 
			} 
			  
			// Visit all key value pair 
			foreach ($array as $k => $v) { 
				  
				// If there is nested array then 
				if (is_array($v)) {  
					  
					// Call function for nested array 
					$this->arrayToXml($v, $k, $_xml->addChild($k));  
					} 
					  
				else { 
					  
					// Simply add child element.  
					$_xml->addChild($k, $v); 
				} 
			} 
			  
			header('Content-Type:application/xml');
			
			echo $_xml->asXML(); 

		} 

		function arrayToXml($array, $rootElement = null, $xml = null) { 
			$_xml = $xml; 
			  
			// If there is no Root Element then insert root 
			if ($_xml === null) { 
				$_xml = new SimpleXMLElement($rootElement !== null ? $rootElement : '<root/>'); 
			} 
			  
			// Visit all key value pair 
			foreach ($array as $k => $v) { 
				  
				// If there is nested array then 
				if (is_array($v)) {  
					  
					// Call function for nested array 
					$this->arrayToXml($v, $k, $_xml->addChild($k)); 
				} 
					  
				else { 
					  
					// Simply add child element.  
					$_xml->addChild($k, $v); 
				} 
			} 
			  
			return $_xml->asXML(); 
		} 
		

		function getJSONResponse($response){

			return json_encode($response);

		}

		function website_url($url=''){

			$website_url = rtrim($this->site_url(),_ENV_['API_ROOT_URL'].URL_DIRECTORY_SEPARATOR) ;

			return $website_url.URL_DIRECTORY_SEPARATOR.$url;

		}
		
	} 
?>