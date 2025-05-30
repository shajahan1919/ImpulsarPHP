<?php

    class welcome extends API{

        var $response = array();

        var $geoLocation;
        var $cache;
        var $userCache;

        function __Construct(){
            $this->geoLocation = $this->load('library','geoLocation'); /* Loading getoLocation Library */
            $this->cache = $this->load('redisCache','default'); /* Loading redisCache for default instance */
            $this->userCache = $this->load('redisCache','user');  /* Loading redisCache for user instance */
        }

        function welcomeJSON(){
           
            $my_array = array ( 
                'status' => 1,
                'Distance' => array(
                    'User1 Lat,Longs' => '17.3981833,78.4198291',
                    'User2 Lat,Longs' => '17.5159184,78.5205795',
                    'Distance from User1 to User2' => round($this->geoLocation->distanceByLatLong(17.5159184,78.5205795,17.3981833,78.4198291,'K'),2)." KM"
                ),
                'cache Data' => array(
                    'Name' => $this->cache->get('Name'),
                    'Age' => $this->userCache->get('Age')
                ),                
                'message' => 'success'
            ); 
    
            $this->response = $my_array;

            $this->generateJSONResponse($this->response);

        }

        function welcomeXML(){
           
            $my_array = array ( 
                'status' => 1,
                'Distance' => array(
                    'User1_lat_longs' => '17.3981833,78.4198291',
                    'User2_lat_longs' => '17.5159184,78.5205795',
                    'Distance_Calculated' => round($this->geoLocation->distanceByLatLong(17.5159184,78.5205795,17.3981833,78.4198291,'K'),2)." KM"
                ),
                'cacheData' => array(
                    'Name' => $this->cache->get('Name'),
                    'Age' => $this->userCache->get('Age')
                ),                
                'message' => 'success'
            ); 
    
            $this->response = $my_array;

            $this->generateXMLResponse($this->response);

        }

        
      
    }
?>