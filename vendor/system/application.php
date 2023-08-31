<?php
/*
|--------------------------------------------------------------------------
| Author : Shajahan Basha Syed
| Class : Application
| Description : This class contains all general functions of application.
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

		function __Construct(){
			$this->site_url = $this->getURL();

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

		function load_cookie($param=''){
			$this->cookie = new Cookie($param);
			return true;
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

		function load_database($dbinstance=''){

			include VENDOR_DIR."/config/database".EXT;

			if($dbinstance==''){
				include VENDOR_DIR."/config/environment".EXT;
				$dbinstance = $_environment[ENVIRONMENT]['database'];
			}

			if(array_key_exists($dbinstance,$database)){
				$dbi = $database[$dbinstance];

				$dbdriver = $dbi['dbdriver'];
				if($dbdriver=="mysql"){
					$dbclassName = 'Database';
				} else{
					$dbclassName = 'Databaselite';
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


		function load_smtpMailer(){

			$smtpMailer = new smtpMailer();

			return $smtpMailer;

		}

		function load($function,$param=''){

			$methodName = "load_$function";

			return $this->$methodName($param);


		}

		function load_helper($filename){

			$filepath = CONFIG_HELPERS.'/'.$filename.EXT;

			if(file_exists($filepath)){
				require($filepath);
			} else{
				error_message('Could not find helper file <b>'.$filepath.'</b>','Unable to load helper');
				exit;
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

		function loadModel($model=""){
			if($model==""){
				$modelClass = APP_ROUTER_CLASS."Mdl";
			} else{

				$mdlfile = CONFIG_MODELS_DIR.'/'.$model.EXT;
				$modelparts = explode('/',$model);
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

		function load_library($libraryname){

			include CONFIG_LIBRARIES.'/'.$libraryname.'.php';

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
				echo "<script type='text/javascript'>window.location.href='$rurl';</script>";
			}


		}

		function site_url($url=''){

			$literal='';

			if(FRAMEWORK_DIRECTORY!=''){
					$literal = FRAMEWORK_DIRECTORY.'/';
			}
			$siteUrl = getURLS().$literal;

			if($url!=''){
					$siteUrl = $siteUrl.$url;
			}

			return $siteUrl;
		}


		function site_title(){
			return CONFIG_APP_TITLE;
		}

		function page_url(){
			return rtrim(WEBPATH,'/').'/';
		}

		function clean($string) {
			$string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.
			$string = str_replace('/', '-', $string); // Replaces all backslashes with hyphens.
			$string = str_replace('&', 'and', $string); // Replaces all spaces with hyphens.
			$string = preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
			$string = preg_replace('/-{2,}/','-',$string); 
			$string = strtolower($string); // Convert to lowercase
			return $string;
		}


		function root_dir(){

			return $this->root_dir;
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

		function generateStringToURL($name){
			$name = str_replace(' ','-',$name);
			$name = str_replace('_','-',$name);
			$name = preg_replace('/[^a-zA-Z0-9_.-]/','', $name);
			$name = preg_replace('/-{2,}/','-',$name);
			return strtolower($name);
		}


		function language($input='',$language=CONFIG_DEFAULT_LANGUAGE){
			$languagestring = '';
			if($input!=''){
				$langData = explode('.',$input);
				if(count($langData)==3){
					$filepath = CONFIG_LANGUAGES.'/'.$language.'/'.$langData[0].EXT;
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
			return $languagestring;
		}

		function check_file_included($filepath){

			$included_files = get_included_files();

			$flag = false;

			foreach ($included_files as $filename) {

				if(ltrim($filepath,'/')==ltrim($filename,'/')){
					$flag = true;
				}

			}
			return $flag;
		}
		
		function guid(){
			if (function_exists('com_create_guid') === true)
			{
				return trim(com_create_guid(), '{}');
			}

			return sprintf('%04X%04X-%04X-%04X-%04X-%04X%04X%04X', mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(16384, 20479), mt_rand(32768, 49151), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535));
		}

		function getRootDir(){
			return ROOT_DIR;
		}

		function getPath($filePath){
			if($filePath=="" || $filePath=="/"){
				return ROOT_DIR;
			} else{
				return ROOT_DIR."/".rtrim(ltrim($filePath,"/"),"/");
			}
		}
		function getUserConstant($variable_name){
			try{
				eval('$constant_name = USERCONST_'.$variable_name.';');
				return $constant_name;
			} catch(Exception $e){
				$constant_name='';
				return $constant_name;
			}
			
			
		}


	}

?>
