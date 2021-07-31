<?php /*
 * Copyright (C) 2017 All rights reserved.
 *   
 * @File AgentTest.php
 * @Brief 
 * @Author abelzhu, abelzhu@tencent.com
 * @Version 1.0
 * @Date 2017-12-26
 *
 */

use WeWorkApi\CorpAPI;
use WeWorkApi\DataStructure\Agent;
use WeWorkApi\Utils\ParameterError;

include_once("../src/CorpAPI.php");
include_once("../src/Api/ServiceCorpApi.php");
include_once("../src/Api/ServiceProviderApi.php");

$config = require('./config.php');

//
try {
    $api = new CorpAPI($config['CORP_ID'], $config['APP_SECRET']);
} catch (ParameterError $e) {
    echo $e->getMessage();
}

// ------------------------- 应用管理 --------------------------------------
try {
    //
    $agent = new Agent();
    {
        $agent->agentid = $config['APP_ID'];
        $agent->description = "I'm description";
    }
    $api->AgentSet($agent);

    //
    $agent = $api->AgentGet($config['APP_ID']);
    var_dump($agent);

    //
    $agentList = $api->AgentGetList();
    var_dump($agentList);

} catch (Exception $e) { 
    echo $e->getMessage() . "\n";
}
