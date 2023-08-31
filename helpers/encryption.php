<?php
    function encrypt($string,$enctryption_key){
        return hash("sha512", $string.$enctryption_key);
    }
?>
