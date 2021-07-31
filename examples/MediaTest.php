<?php

use WeWorkApi\CorpAPI;
use WeWorkApi\Utils\ParameterError;

include_once("../src/CorpAPI.php");
include_once("../src/Api/ServiceCorpApi.php");
include_once("../src/Api/ServiceProviderApi.php");

/*
 * Copyright (C) 2017 All rights reserved.
 *   
 * @File MediaTest.php
 * @Brief 
 * @Author abelzhu, abelzhu@tencent.com
 * @Version 1.0
 * @Date 2017-12-26
 *
 */
 
$config = require('./config.php');

try {
    $api = new CorpAPI($config['CORP_ID'], $config['APP_SECRET']);
} catch (ParameterError $e) {
    echo $e->getMessage() . "\n";
}
try {
    //
    $mediaId = $api->MediaUpload("TestConfig.php", "file");
    echo $mediaId."\n";

    //
    $data = $api->MediaGet($mediaId);
    var_dump($data);
} catch (Exception $e) { 
    echo $e->getMessage() . "\n";
}
