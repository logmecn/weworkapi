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

use WeWorkApi\CorpAPI;

include_once("../src/CorpAPI.php");
include_once("../src/Api/ServiceCorpApi.php");
include_once("../src/Api/ServiceProviderApi.php");
// 
$config = require('./config.php');
// 
try {
    $api = new CorpAPI($config['CORP_ID'], $config['APP_SECRET']);
} catch (\WeWorkApi\Utils\ParameterError $e) {
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

