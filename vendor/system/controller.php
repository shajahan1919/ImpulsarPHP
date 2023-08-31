<?php
/*
|--------------------------------------------------------------------------
| Author : Shajahan Basha Syed
| Class : Controller
| Description : This class is a parent class for all controllers.
|				It Contains all controller functionality
|--------------------------------------------------------------------------
|
*/
	class Controller extends Application{

		var $site_url = SITE_URL.DS;

		var $app_title = CONFIG_APP_TITLE;

		var $model;

		//var $application = new Application();

		function __Construct(){

		}

		function load_view($filename,$params = array()){

			$filepath = CONFIG_VIEWS.'/'.$filename.EXT;

			if(count($params)>0){
				foreach($params as $key=>$value){
					$$key = $value;
				}
			}
			if(file_exists($filepath)){
				require($filepath);
			} else{
				error_message('Could not find view file <b>'.$filepath.'</b>','Unable to load view');
				exit;
			}
		}


		function load_module_view($fileloc,$params = array()){
			$module = $fileloc[0];
			$filename = $fileloc[1];

			$filepath = APPLICATION_DIR.$module.DS.'Views'.DS.$filename.EXT;

			if(count($params)>0){
				foreach($params as $key=>$value){
					$$key = $value;
				}
			}
			if(file_exists($filepath)){
				require($filepath);
			} else{
				error_message('Unable to load view');
				exit;
			}
		}

		function getModel($modelName,$module=''){
			if($module==''){
				$mdlfile = CONFIG_MODEL.$modelName.EXT;
			} else{
				$mdlfile = APPLICATION_DIR.$module.DS.'Models'.DS.$modelName.EXT;
			}

			require($mdlfile);

			$modelClass = $modelName."Mdl";

			if(class_exists($modelClass)){
				return $model = new $modelClass();
			} else{
				error_message('Unable to load model '.$modelName);
				exit;
			}
		}

	}


?>
