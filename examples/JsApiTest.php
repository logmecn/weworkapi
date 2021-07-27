<?php /*
 * Copyright (C) 2017 All rights reserved.
 *   
 * @File JsApiTest.php
 * @Brief 
 * @Author abelzhu, abelzhu@tencent.com
 * @Version 1.0
 * @Date 2017-12-26
 *
 */

use WeWork\CorpAPI;

include_once("../src/CorpAPI.class.php");
include_once("../src/api/ServiceCorpAPI.class.php");
include_once("../src/api/ServiceProviderAPI.class.php");
// 
$config = require('./config.php');
// 
try {
    $api = new CorpAPI($config['CORP_ID'], $config['APP_SECRET']);
} catch (\WeWork\Utils\ParameterError $e) {
    echo $e->getMessage() . "\n";
}

try {
    //
    $ticket = $api->TicketGet();
    echo $ticket . "\n";

    //
    $ticket = $api->JsApiTicketGet();
    echo $ticket . "\n";
} catch (Exception $e) { 
    echo $e->getMessage() . "\n";
}

