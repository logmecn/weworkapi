<?php
namespace WeWorkApi\DataStructure\ServiceCorp;
use WeWorkApi\Utils\Utils;

include_once(__DIR__ . "/../../Utils/Utils.php");


class AuthUserInfo
{
    public $email = null; // string
    public $mobile = null; // string
    public $userid = null; // string
    public $name = null; // string
    public $avatar = null; // string

    static public function ParseFromArray($arr)
    {
        $info = new AuthUserInfo();

        $info->email = Utils::arrayGet($arr, "email");
        $info->mobile = Utils::arrayGet($arr, "mobile");
        $info->userid = Utils::arrayGet($arr, "userid");
        $info->name = Utils::arrayGet($arr, "name");
        $info->avatar = Utils::arrayGet($arr, "avatar");

        return $info;
    }
}