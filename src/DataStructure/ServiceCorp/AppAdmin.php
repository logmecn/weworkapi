<?php
namespace WeWorkApi\DataStructure\ServiceCorp;
use WeWorkApi\Utils\Utils;

include_once(__DIR__ . "/../../Utils/Utils.php");



class AppAdmin
{
    public $userid = null; // string
    public $auth_type = null; // uint, 该管理员对应用的权限：0=发消息权限，1=管理权限

    static public function ParseFromArray($arr)
    {
        $info = new AppAdmin();

        $info->userid = Utils::arrayGet($arr, "userid");
        $info->auth_type = Utils::arrayGet($arr, "auth_type");

        return $info;
    }
}