<?php

use WeWorkApi\CorpAPI;
use WeWorkApi\Utils\ParameterError;

include_once("../src/Api/CorpAPI.class.php");
//include_once("../src/api/ServiceCorpAPI.class.php");
//include_once("../src/api/ServiceProviderAPI.class.php");

$config = require('./config.php');

// 需启用 "管理工具" -> "通讯录同步", 并使用该处的secret, 才能通过API管理通讯录
//
try {
    $api = new CorpAPI($config['CORP_ID'], $config['CONTACT_SYNC_SECRET']);
} catch (ParameterError $e) {
    echo $e->getMessage() . "\n";
}

$departmentList = $api->DepartmentList();
var_dump($departmentList);