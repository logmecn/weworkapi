<?php /*
 * Copyright (C) 2017 All rights reserved.
 *   
 * @File OauthTest.php
 * @Brief 
 * @Author abelzhu, abelzhu@tencent.com
 * @Version 1.0
 * @Date 2017-12-26
 *
 */

use WeWorkApi\CorpAPI;
use WeWorkApi\Utils\ParameterError;

//include_once("../src/CorpAPI.php");
//include_once("../src/api/ServiceCorpApi.php");
//include_once("../src/api/ServiceProviderApi.php");

$config = require('./config.php');
// 
$agentId = $config['APP_ID'];
try {
    $api = new CorpAPI($config['CORP_ID'], $config['APP_SECRET']);
} catch (ParameterError $e) {
    echo $e->getMessage() . "\n";
}

try {
    $UserInfoByCode = $api->GetUserInfoByCode("IPzWnFmIQVf2wJFlJrln9-P-wqu7jeQsKyUKol1TWeU"); 
    var_dump($UserInfoByCode);

    $userDetailByUserTicket = $api->GetUserDetailByUserTicket($UserInfoByCode->user_ticket); 
    var_dump($userDetailByUserTicket);

} catch (Exception $e) { 
    echo $e->getMessage() . "\n";
}
