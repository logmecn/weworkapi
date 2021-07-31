<?php /*
 * Copyright (C) 2017 All rights reserved.
 *   
 * @File CheckinTest.php
 * @Brief 
 * @Author abelzhu, abelzhu@tencent.com
 * @Version 1.0
 * @Date 2017-12-26
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
    $api = new CorpAPI($config['CORP_ID'], $config['CHECKIN_APP_SECRET']);
} catch (ParameterError $e) {
    echo $e->getMessage() . "\n";
}

try { 
    //
    $checkinOption = $api->CheckinOptionGet(1513760113, array("ZhuShengBen"));
    var_dump($checkinOption);

    //
    $checkinDataList = $api->CheckinDataGet(1, 1513649733, 1513770113, array("ZhuShengBen"));
    var_dump($checkinDataList);
} catch (Exception $e) { 
    echo $e->getMessage() . "\n";
}

