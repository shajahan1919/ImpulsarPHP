<?php
/*
|--------------------------------------------------------------------------
| Author : Shajahan Basha Syed
| Class : session
| Description : This contains all methods to work with curl
|--------------------------------------------------------------------------
|
*/
 class ajax{ 

    function __Construct(){
       
    }

    function getResponsecURL($url)
    {
        ini_set("display_errors",1);
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
        $curl_response = curl_exec($curl);
        // Check for errors and display the error message
        if($errno = curl_errno($curl)) {
            $error_message = curl_strerror($errno);
            echo "cURL error ({$errno}):\n {$error_message}";
        }
        curl_close($curl);
        //echo $curl_response;
        return $curl_response;//$curl_response['groupReport'];
    }


    function getPostResponsecURL($url,$data)
    {
        ini_set("display_errors",1);
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        $curl_response = curl_exec($curl);
        
        // Check for errors and display the error message
        if($errno = curl_errno($curl)) {
            $error_message = curl_strerror($errno);
            echo "cURL error ({$errno}):\n {$error_message}";
        }
        curl_close($curl);
        //echo $curl_response;
        return $curl_response;//$curl_response['groupReport'];
    }
}
