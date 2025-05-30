<?php
/*
|--------------------------------------------------------------------------
| Author : Shajahan Basha Syed
| Class : Application
| Description : This class contains all the functions related to the framework application methods.
|--------------------------------------------------------------------------
|
*/
	class Application{

		var $ajax;

		var $session;

		var $curl;

		var $cookie;

		var $site_url = SITE_URL.DS;

		var $root_dir = ROOT_DIR.DS;
		/**
		* Constructor: Initializes the application class.
		* Sets the site URL using getURL() method.
		*/
		function __Construct(){
			$this->site_url = $this->getURL();

		}
		
		/**
		* Loads various components of the application dynamically.
		* 
		* @param string $function - The function to be loaded.
		* @param mixed $param - Parameters required for the function.
		* @return mixed - Returns the result of the loaded function.
		* 
		* Example Usage:
		* $app->load('string_library/string_helper', '[string_helper_name / string_library_name], [parameters of helper / library]');
		*/
		function load(){

			$total_arguements = func_num_args();

			$args = func_get_args();

			if($total_arguements==3 && $args[0]=='library'){

				$function = $args[1];

				$param = $args[2];

			} else{

				$function = $args[0];

				$param = $args[1];

			}

			$methodName = "load_$function";

			return $this->$methodName($param);

		}

		/**
		* Loads a helper file.
		* 
		* @param string $filename - The helper file name.
		* @return void - Includes the helper file if it exists.
		* 
		* Example Usage:
		* $app->load_helper('string_helper');
		*/
		function load_helper($filename){

			$helperDir = $modelsDir = ROOT_DIR.FRAMEWORK_DIRECTORY_SEPARATOR.'helpers'.FRAMEWORK_DIRECTORY_SEPARATOR;

			$filePath = $helperDir.$filename._ENV_['DEFAULT_EXTENSION'];

			if(file_exists($filePath) && $this->check_file_included($filePath)!=true){
				require($filePath);
			} else{
				error_message('Could not find helper file <b>'.$filePath.'</b>','Unable to load helper');
				exit;
			}
		}

		/**
		* Loads a library.
		* 
		* @param string $libraryname - The library name.
		* @return object - Returns the library object if it exists.
		* 
		* Example Usage:
		* $db = $app->load_library('database');
		*/
		function load_library($libraryname){

			$libraryDir = ROOT_DIR.FRAMEWORK_DIRECTORY_SEPARATOR.'vendor'.FRAMEWORK_DIRECTORY_SEPARATOR.'library'.FRAMEWORK_DIRECTORY_SEPARATOR;

			$filePath = $libraryDir.$libraryname._ENV_['DEFAULT_EXTENSION'];

			if(file_exists($filePath) && $this->check_file_included($filePath)!=true){
				require_once $filePath;
			}

			$libraryClass = $libraryname;

			if(class_exists($libraryClass)){

				if($libraryname=="device"){
					$libobj = new $libraryClass(getDomain());
				} else{
					$libobj = new $libraryClass();
				}

				return $libobj;


			} else{
				error_message("Unable to load library $libraryname");
				exit;

			}
		}


		/**
		* Loads a SMTP library.
		* 
		* @param string $mailInstance - The mail instance name.
		* @return object - Returns a smtp mailer class object if successful.
		* 
		* Example Usage:
		* $db = $app->load_smtpMailer('string_mail_instance');
		*/
		function load_smtpMailer($mailInstance = ''){

			$filePath =  ROOT_DIR.FRAMEWORK_DIRECTORY_SEPARATOR.'config'.FRAMEWORK_DIRECTORY_SEPARATOR.'database'._ENV_['DEFAULT_EXTENSION'];

			include $filePath;

			$libraryDir = ROOT_DIR.FRAMEWORK_DIRECTORY_SEPARATOR.'vendor'.FRAMEWORK_DIRECTORY_SEPARATOR.'library'.FRAMEWORK_DIRECTORY_SEPARATOR;

			$libraryFilePath = $libraryDir.'SMTPMailer'._ENV_['DEFAULT_EXTENSION'];

			if(file_exists($libraryFilePath) && $this->check_file_included($libraryFilePath)!=true){
				require_once $libraryFilePath;
			}

			$key =  ($mailInstance=='') ? _ENV_['DEFAULT_MAIL_DRIVER'] : $mailInstance;

			if(isset($Mail[$key])){

				$eMail = $Mail[$key];

				$smtpMailer = new SMTPMailer($eMail['MAIL_HOST'],$eMail['MAIL_PORT'],$eMail['MAIL_USERNAME'],$eMail['MAIL_PASSWORD'],$eMail['MAIL_USE_TLS']);

				return $smtpMailer;

			} else{

				error_message($key.' mail settings are not defined in configuration.');
				exit;

			}

		}

		/**
		* Loads a redis cache library.
		* 
		* @param string $cacheInstance - The redis cache instance name.
		* @return object - Returns a redis cache class object if successful.
		* 
		* Example Usage:
		* $db = $app->load_redisCache('string_db_instance');
		*/
		function load_redisCache($cacheInstance = ''){

			$filePath =  ROOT_DIR.FRAMEWORK_DIRECTORY_SEPARATOR.'config'.FRAMEWORK_DIRECTORY_SEPARATOR.'redis'._ENV_['DEFAULT_EXTENSION'];

			include $filePath;

			$libraryDir = ROOT_DIR.FRAMEWORK_DIRECTORY_SEPARATOR.'vendor'.FRAMEWORK_DIRECTORY_SEPARATOR.'library'.FRAMEWORK_DIRECTORY_SEPARATOR;

			$libraryFilePath = $libraryDir.'RedisCache'._ENV_['DEFAULT_EXTENSION'];

			if(file_exists($libraryFilePath) && $this->check_file_included($libraryFilePath)!=true){
				require_once $libraryFilePath;
			}

			$key =  ($cacheInstance=='') ? _ENV_['DEFAULT_REDIS_CACHE_DRIVER'] : $cacheInstance;

			if(isset($redisCache[$key])){

				$cache = $redisCache[$key];

				$projectName = $this->removeSpecialChars(_ENV_['APP_NAME']);
				
				$dbDriver = $this->removeSpecialChars(_ENV_['DEFAULT_REDIS_CACHE_DRIVER']);

				
				$redisCacheObj = new RedisCache($projectName, $dbDriver, $cache['CACHE_SCHEME'], $cache['CACHE_HOST'], $cache['CACHE_PORT'], $cache['CACHE_TIMEOUT'], $cache['USERNAME'], $cache['PASSWORD']);

				return $redisCacheObj;

			} else{

				error_message($key.' Redis cache settings are not defined in configuration.');
				exit;

			}

		}

		/**
		* Loads a database library.
		* 
		* @param string $dbinstance - The database instance name.
		* @return object - Returns a database object if successful.
		* 
		* Example Usage:
		* $db = $app->load_database('string_db_instance');
		*/
		function load_database($dbinstance=''){
			
			$filePath =  ROOT_DIR.FRAMEWORK_DIRECTORY_SEPARATOR.'config'.FRAMEWORK_DIRECTORY_SEPARATOR.'database'._ENV_['DEFAULT_EXTENSION'];

			include $filePath;

			if($dbinstance==''){
				$key = 'DEFAULT_'.strtoupper(_ENV_['APP_ENV']).'_DATABASE';
				$dbinstance = _ENV_[$key];
			}
		

			if(array_key_exists($dbinstance,$database)){

				$dbi = $database[$dbinstance];

				$dbdriver = $dbi['dbdriver'];
				if($dbdriver=="mysqli"){
					$dbclassName = 'Databaselite';
				} else{
					$dbclassName = 'Database';
				}

				$libraryDir = ROOT_DIR.FRAMEWORK_DIRECTORY_SEPARATOR.'vendor'.FRAMEWORK_DIRECTORY_SEPARATOR.'library'.FRAMEWORK_DIRECTORY_SEPARATOR;

				$libraryFilePath = $libraryDir.$dbclassName._ENV_['DEFAULT_EXTENSION'];

				if(file_exists($libraryFilePath) && $this->check_file_included($libraryFilePath)!=true){
					require_once $libraryFilePath;
				}

				if(class_exists($dbclassName)){

					$dbobj = new $dbclassName($dbi['hostname'],$dbi['username'],$dbi['password'],$dbi['database']);

					if(!$dbobj){
						error_message($dbobj->error(),'Database connection error');
						exit;
					} else {
						if(!$dbobj->opendb()){
							error_message($dbobj->error(),'Opening database error');
							exit;

						} else{
							return $dbobj;
						}
					}
				} else{
					error_message('Database Class not exist. Please enable in autoload library settings','Database Error');
					exit;
				}
			} else{
				error_message('Invalid Database Instance','Database Error');
				exit;
			}
		}

		function load_date($param=''){
				$datelib = new libDate();
				return $datelib;
		}

		function load_cookie($param=''){
			$this->cookie = new Cookie($param);
			return true;
		}
		
		function load_session($param=''){
			if(class_exists('Session')){
				$this->session = new Session($param);
				return true;
			} else{
				error_message('Session class does not exist.');
				exit;
			}
		}

		function load_ajax(){
			if(class_exists('ajax')){
			 $this->ajax = new ajax();
			} else{
				error_message('Ajax class does not exist.');
				exit;
			}
		}
		
		function loadModel($model=""){
			if($model==""){
				$modelClass = APP_ROUTER_CLASS."Mdl";
			} else{

				$modelsDir = ROOT_DIR.FRAMEWORK_DIRECTORY_SEPARATOR._ENV_['APP_DIR'].FRAMEWORK_DIRECTORY_SEPARATOR.'model'.FRAMEWORK_DIRECTORY_SEPARATOR;
				
				$mdlfile = $modelsDir.$model._ENV_['DEFAULT_EXTENSION'];
				$modelparts = explode(URL_DIRECTORY_SEPARATOR,$model);
				$modelClassName = $modelparts[count($modelparts)-1];
				$modelClass = $modelClassName."Mdl";

				if(file_exists($mdlfile)){

					require($mdlfile);

				} else{
					error_message('Unable to load model');
					exit;
				}
			}

			if(class_exists($modelClass)){

				if($model==""){
					$this->model = new $modelClass();
				} else{
					return new $modelClass();
				}

			} else{

				error_message('Unable to load model');
				exit;

			}

		}

		function get($key,$urldecode=false){
			if(isset($_GET[$key])){
				if($urldecode){
					return urldecode($_GET[$key]);
				} else{
					return $_GET[$key];
				}
			} else{
				$val = '';
				return $val;
			}
		}

		function post($key,$urldecode=false){
			if($urldecode){
				return urldecode($_POST[$key]);
			} else{
				return $_POST[$key];
			}
		}

		function all($type='get'){

			$data = [];

			if(strtolower($type)=='get'){

				if(isset($_GET)){

					$data = $_GET;

				}
			}

			if(strtolower($type)=='post'){

				if(isset($_POST)){

					$data = $_POST;

				}
			}

			return $data;

		}

		function request($key){

			$param1 = isset($args[1]) ? $args[1] : null;
			
			$param2 = isset($args[2]) ? $args[2] : null;

			if(!is_null($param1) && !is_bool($param1)){
				$method = $param1;
			} else if(!is_null($param1) && is_bool($param1)){
				$urldecode = $param1;
			} else if(!is_null($param2) && !is_bool($param2)){
				$method = $param2;
			} else if(!is_null($param2) && is_bool($param2)){
				$urldecode = $param2;
			} else{
				$method='get';
				$urldecode=false;
			}

			if($urldecode){
				if($method=='get'){
					return urldecode($_GET[$key]);
				} else{
					return urldecode($_POST[$key]);
				}

			} else{
				if($method=='get'){
					return $_GET[$key];
				} else{
					return $_POST[$key];
				}
			}
		}
	
		function getURLSegment($index=0){

			$webpathelements =  explode(DS, rtrim(WEBPATH,DS));

			if(array_key_exists($index,$webpathelements)){
				return $webpathelements[$index];
			} else{
				return -1;
			}
		}

		function getURLSegmentLen(){

			$webpath = rtrim(WEBPATH,DS);

			$webpathelements =  explode(DS, $webpath);

			if($webpath==''){
				return 0;
			} else{
				return count($webpathelements);
			}

		}

		function site_title(){
			return _ENV_['APP_NAME'];
		}

		function redirect($url=''){

			if($url==''){
				$rurl = getURLS();
			} else{
				$rurl = $url;
			}
			//echo $rurl;
			if (!headers_sent()){
				header("Location:".$rurl);
			} else{
				echo "<script type='t_ENV_['DEFAULT_EXTENSION']/javascript'>window.location.href='$rurl';</script>";
			}


		}

		function site_url($url=''){

			$literal='';

			if(APP_DIRECTORY!=''){
				$literal = APP_DIRECTORY.URL_DIRECTORY_SEPARATOR;
			}
			$siteUrl = getURLS().$literal;

			if($url!=''){
					$siteUrl = $siteUrl.$url;
			}

			return $siteUrl;
		}		

		function page_url(){
			return rtrim(WEBPATH,URL_DIRECTORY_SEPARATOR).URL_DIRECTORY_SEPARATOR;
		}

		function clean($string) {
			$string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.
			$string = str_replace(URL_DIRECTORY_SEPARATOR, '-', $string); // Replaces all backslashes with hyphens.
			$string = str_replace('&', 'and', $string); // Replaces all spaces with hyphens.
			$string = preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
			$string = preg_replace('/-{2,}/','-',$string); 
			$string = strtolower($string); // Convert to lowercase
			return $string;
		}

		function encrypt($token,$key=''){

			$compbinetoken = implode("::",array($token.$key,time()));

			$crypted_token = base64_encode($compbinetoken);

			return $crypted_token;
		}

		function decrypt($crypted_token,$key=''){

			$decrypted_token = base64_decode($crypted_token);

			$tokenList = explode("::",$decrypted_token);

			$dtoken = str_replace($key,'',$tokenList[0]);

			return $dtoken;

		}

		function strnumgenerator($size,$number,$token=''){

			$len = strlen($number);

			if($len<$size){
				$sz = $size-$len;
				$nm = '';
				for($i=0;$i<$sz;$i++){
					$nm = $nm.'0';
				}
				$nm = $nm.$number;
			} else{
				$nm = $number;
				$sz = $len;
			}
			if($token==''){
				return $nm;
			} else{
				return $token.$nm;
			}
		}

		function textstrip($str){
			$removes = array("'",'"','`','=','+','*','&','^','','%','$','#','@','!','<','>','?');
			$replaces = array('[',']','{','}','(',')',' ',',',';',':','/','|');

			$text = preg_replace('/\s+/', '',$str);

			foreach($removes as $key){
				$text = str_replace($key,'',$text);
			}

			return $text;
		}

		function removeSpecialChars($input) {
			// Use a regular expression to remove anything that is not an alphabet or a number
			return preg_replace('/[^a-zA-Z0-9]/', '', $input);
		}

		function generateStringToURL($name){
			$name = str_replace(' ','-',$name);
			$name = str_replace('_','-',$name);
			$name = preg_replace('/[^a-zA-Z0-9_.-]/','', $name);
			$name = preg_replace('/-{2,}/','-',$name);
			return strtolower($name);
		}

		function language($input='',$language=_ENV_['DEFAULT_LANGUAGE']){

			$languagestring = '';

			$languagesDir = ROOT_DIR.FRAMEWORK_DIRECTORY_SEPARATOR._ENV_['APP_DIR'].FRAMEWORK_DIRECTORY_SEPARATOR.'languages'.FRAMEWORK_DIRECTORY_SEPARATOR;

			if(_ENV_['MULTI_LANGUAGE']==true || _ENV_['MULTI_LANGUAGE']=='true'){
				
				if($input!=''){
					$langData = explode('.',$input);
					if(count($langData)==3){
						$filepath = $languagesDir.$language.FRAMEWORK_DIRECTORY_SEPARATOR.$langData[0]._ENV_['DEFAULT_EXTENSION'];
						if(file_exists($filepath)){
							require($filepath);
							$variable_name = $langData[1];
							$languageArray = array();
							if(isset($$variable_name) && is_array($$variable_name)){
								$languageArray = $$variable_name;
							}
							$key = $langData[2];
							if(array_key_exists($key,$languageArray)){
								$languagestring = $languageArray[$key];
							}

						}
					}
				}
				
			}

			return $languagestring;
			
		}

		function check_file_included($filepath){

			return (in_array(realpath($filepath), get_included_files())) ? true : false;
			
		}
		
		function guid(){
			if (function_exists('com_create_guid') === true)
			{
				return trim(com_create_guid(), '{}');
			}

			return sprintf('%04X%04X-%04X-%04X-%04X-%04X%04X%04X', mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(16384, 20479), mt_rand(32768, 49151), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535));
		}

		function root_dir(){

			return $this->root_dir;
		}

		function getRootDir(){
			return ROOT_DIR;
		}

		function getPath($filePath){
			if($filePath=="" || $filePath==URL_DIRECTORY_SEPARATOR){
				return ROOT_DIR;
			} else{
				return ROOT_DIR.URL_DIRECTORY_SEPARATOR.rtrim(ltrim($filePath,URL_DIRECTORY_SEPARATOR),URL_DIRECTORY_SEPARATOR);
			}
		}
		
		function getUserConstant($variable_name){
			try{
				eval('$constant_name = defined("USERCONST_'.$variable_name.'") ? USERCONST_'.$variable_name.' : "";');
				return $constant_name;
			} catch(Exception $e){
				$constant_name='';
				return $constant_name;
			}
			
			
		}

		function getEnv($variable_name){
			return isset(_ENV_[$variable_name]) ? _ENV_[$variable_name] : '';
		}


	}

?>
