<?php
   $functionsDir = __DIR__.FRAMEWORK_DIRECTORY_SEPARATOR.'functions'.FRAMEWORK_DIRECTORY_SEPARATOR;
   foreach (glob($functionsDir . '*.php') as $file) {
       require_once $file;
   }

?>