<?php

    class welcome extends API{

        var $response = array();

        function __Construct(){

        }

        function welcome(){
           
            $my_array = array ( 
                'status' => 1, 
                'message' => 'success'
            ); 
    
            $this->response = $my_array;

            $this->generateJSONResponse($this->response);

        }

        
      
    }
?>