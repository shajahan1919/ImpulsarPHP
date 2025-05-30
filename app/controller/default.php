<?php

    class defaultCtrl extends Controller{

        var $cache;
        var $userCache;
        var $geoLocation;

        function __Construct(){
            $this->geoLocation = $this->load('library','geoLocation'); /* Loading getoLocation Library */
            $this->cache = $this->load('redisCache','default'); /* Loading redisCache for default instance */
            $this->userCache = $this->load('redisCache','user');  /* Loading redisCache for user instance */
        }

        function index(){

            $this->load_view('welcome');

        }

        function info(){
            $this->cache->set('Name', 'Shajahan Basha Syed', 3600);
            $this->userCache->set('Age', '30', 3600);
            $this->load_view('home');
        }
    }

?>
