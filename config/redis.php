<?php

    $redisCache = array(
        'default'=>array(
            'CACHE_SCHEME'=>'tcp',
            'CACHE_HOST'=>'127.0.0.1',
            'CACHE_PORT'=>6379,
            'USERNAME'=>'',
            'PASSWORD'=>'',
            'CACHE_TIMEOUT'=>3600 /* In seconds  1 Hour = 3600 Seconds*/
        ),
        'user'=>array(
            'CACHE_SCHEME'=>'tcp',
            'CACHE_HOST'=>'127.0.0.1',
            'CACHE_PORT'=>6379,
            'USERNAME'=>'',
            'PASSWORD'=>'',
            'CACHE_TIMEOUT'=>3600 /* In seconds  1 Hour = 3600 Seconds*/
        )
    );
?>