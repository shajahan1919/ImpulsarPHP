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

		var $app_title = _ENV_['APP_NAME'];

		var $model;

		//var $application = new Application();

		function __Construct(){

		}

		function load_view($filename,$params = array()){

			$viewsDir = ROOT_DIR.FRAMEWORK_DIRECTORY_SEPARATOR._ENV_['APP_DIR'].FRAMEWORK_DIRECTORY_SEPARATOR.'view'.FRAMEWORK_DIRECTORY_SEPARATOR;

			$filepath = $viewsDir.$filename._ENV_['DEFAULT_EXTENSION'];

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

		function getModel($modelName,$module=''){

			$modelsDir = ROOT_DIR.FRAMEWORK_DIRECTORY_SEPARATOR._ENV_['APP_DIR'].FRAMEWORK_DIRECTORY_SEPARATOR.'model'.FRAMEWORK_DIRECTORY_SEPARATOR;

			if($module==''){
				$mdlfile = $modelsDir.$modelName.EXT;
			} else{
				$mdlfile = APPLICATION_DIR.$module.DS.'Models'.DS.$modelName._ENV_['DEFAULT_EXTENSION'];
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
