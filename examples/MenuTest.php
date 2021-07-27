<?php /*
 * Copyright (C) 2017 All rights reserved.
 *   
 * @File MenuTest.php
 * @Brief 
 * @Author abelzhu, abelzhu@tencent.com
 * @Version 1.0
 * @Date 2017-12-26
 *
 */

use WeWork\CorpAPI;
use WeWork\DataStructure\Menu;
use WeWork\DataStructure\PicWeixinMenu;
use WeWork\DataStructure\ScanCodePushMenu;
use WeWork\DataStructure\SubMenu;
use WeWork\DataStructure\viewMenu;
use WeWork\Utils\ParameterError;

//include_once("../src/CorpAPI.class.php");
//include_once("../src/api/ServiceCorpAPI.class.php");
//include_once("../src/api/ServiceProviderAPI.class.php");

$config = require('./config.php');
// 
$agentId = $config['APP_ID'];
try {
    $api = new CorpAPI($config['CORP_ID'], $config['APP_SECRET']);
} catch (ParameterError $e) {
    echo $e->getMessage() . "\n";
}

try { 
    //
    $subMenu = new SubMenu(
        "subMenu_1", 
        array(
            new viewMenu("viewMenu_1", "www.qq.com"), 
            new viewMenu("viewMenu_2", "www.baidu.com")
        )
    );
    $scanCodePushMenu = new ScanCodePushMenu(
        "ScanCodePushMenu", 
        null, 
        array(
            new viewMenu("viewMenu_3", "www.qq.com"), 
            new PicWeixinMenu( "PicWeixinMenu", "keykeykey", null),
        )
    );

    $menu = new Menu(
        array(
            $subMenu,
            $scanCodePushMenu
        )
    );
    $api->MenuCreate($agentId, $menu);

    //
    $menu = $api->MenuGet($agentId);
    var_dump($menu);

    //
    $api->MenuDelete($agentId);

} catch (Exception $e) { 
    echo $e->getMessage() . "\n";
}

