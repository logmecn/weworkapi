<?php /*
 * Copyright (C) 2017 All rights reserved.
 *   
 * @File DepartmentTest.php
 * @Brief 
 * @Author abelzhu, abelzhu@tencent.com
 * @Version 1.0
 * @Date 2017-12-26
 *
 */

use WeWork\CorpAPI;
use WeWork\DataStructure\Department;
use WeWork\Utils\ParameterError;

include_once("../src/CorpAPI.class.php");
include_once("../src/api/ServiceCorpAPI.class.php");
include_once("../src/api/ServiceProviderAPI.class.php");

$config = require('./config.php');

// 需启用 "管理工具" -> "通讯录同步", 并使用该处的secret, 才能通过API管理通讯录
//
try {
    $api = new CorpAPI($config['CORP_ID'], $config['CONTACT_SYNC_SECRET']);
} catch (ParameterError $e) {
    echo $e->getMessage() . "\n";
}


try { 
    //
    $department = new Department();
    {
        $department->name = "department_1";
        $department->parentid = 1;
        $department->id = 9;
    }
    $departmentId = $api->DepartmentCreate($department);
    echo $departmentId . "\n";

    //
    $department->name = "department_2";
    $api->DepartmentUpdate($department);

    //
    $departmentList = $api->DepartmentList();
    var_dump($departmentList);

    //
    $api->DepartmentDelete($departmentId);
} catch (Exception $e) { 
    echo $e->getMessage() . "\n";
    $api->DepartmentDelete($departmentId);
}
