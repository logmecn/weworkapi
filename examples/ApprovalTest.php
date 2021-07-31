<?php /*
 * Copyright (C) 2017 All rights reserved.
 *   
 * @File ApprovalTest.php
 * @Brief 
 * @Author abelzhu, abelzhu@tencent.com
 * @Version 1.0
 * @Date 2017-12-27
 *
 */

use WeWorkApi\CorpAPI;
use WeWorkApi\Utils\ParameterError;

include_once("../src/CorpAPI.php");
include_once("../src/Api/ServiceCorpApi.php");
include_once("../src/Api/ServiceProviderApi.php");
// 
$config = require('./config.php');
// 
try {
    $api = new CorpAPI($config['CORP_ID'], $config['APPROVAL_APP_SECRET']);
} catch (ParameterError $e) {
    echo $e->getMessage();
}

try {
    $ApprovalDataList = $api->ApprovalDataGet(1513649733, 1513770113);
    var_dump($ApprovalDataList);
} catch (Exception $e) { 
    echo $e->getMessage() . "\n";
}

