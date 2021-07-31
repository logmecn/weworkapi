<?php

//include_once "./src/CorpApi.php";


use WeWorkApi\CorpAPI;
use WeWorkApi\DataStructure\ExtattrItem;
use WeWorkApi\DataStructure\ExtattrList;
use WeWorkApi\DataStructure\User;
use WeWorkApi\Utils\ParameterError;

$config = require('./config.php');
// 需启用 "管理工具" -> "通讯录同步", 并使用该处的secret, 才能通过API管理通讯录
//
try {
    $api = new CorpAPI($config['CORP_ID'], $config['CONTACT_SYNC_SECRET']);
} catch (ParameterError $e) {
    print("Init CorpApi failed! ".$e->getMessage());
}


try {
    //
    $user = new User();
    {
        $user->userid = "userid";
        $user->name = "name";
        $user->mobile = "131488888888";
        $user->email = "sbzhu@ipp.cas.cn";
        $user->department = array(1);

        $ExtattrList = new ExtattrList();
        $ExtattrList->attrs = array(new ExtattrItem("s_a_2", "aaa"), new ExtattrItem("s_a_3", "bbb"));
        $user->extattr = $ExtattrList;
    }
    $api->UserCreate($user);

    //
    $user = $api->UserGet("userid");
    var_dump($user);

    //
    $user->mobile = "1219887219873";
    $api->UserUpdate($user);

    //
    $userList = $api->userSimpleList(1, 0);
    var_dump($userList);

    //
    $userList = $api->UserList(1, 0);
    var_dump($userList);

    //
    $openId = null;
    $api->UserId2OpenId("ZhuShengBen", $openId);
    echo "openid: $openId\n";

    //
    $userId = null;
    $api->openId2UserId($openId, $userId);
    echo "userid: $userId\n";

    //
    $api->UserAuthSuccess("userid");

    //
    $api->UserBatchDelete(array("userid", "aaa"));

    //
    $api->UserDelete("userid");
} catch (Exception $e) {
    echo $e->getMessage() . "\n";
    try {
        $api->UserDelete("userid");
    } catch (ParameterError $e) {
        echo $e->getMessage();
    }
}
