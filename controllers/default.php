<?php

    class defaultCtrl extends Controller{

        function __Construct(){
          
        }

        function index(){

            $this->load_view('welcome');

        }
    }

?>
