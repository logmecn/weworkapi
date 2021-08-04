<?php
namespace WeWorkApi\DataStructure\ServiceCorp;
use WeWorkApi\Utils\Utils;

include_once(__DIR__ . "/../../Utils/Utils.php");


class GetPermanentCodeRsp
{
    public $access_token = null; // string
    public $expires_in = null; // uint
    public $permanent_code = null; // string
    public $auth_corp_info = null; // AuthCorpInfo
    public $auth_info = null; // AuthInfo
    public $auth_user_info = null; // AuthUserInfo

    static public function ParseFromArray($arr)
    {
        $info = new GetPermanentCodeRsp();

        $info->access_token = Utils::arrayGet($arr, "access_token");
        $info->expires_in = Utils::arrayGet($arr, "expires_in");
        $info->permanent_code = Utils::arrayGet($arr, "permanent_code");

        if (array_key_exists("auth_corp_info", $arr)) {
            $info->auth_corp_info = AuthCorpInfo::ParseFromArray($arr["auth_corp_info"]);
        }
        if (array_key_exists("auth_info", $arr)) {
            $info->auth_info = AuthInfo::ParseFromArray($arr["auth_info"]);
        }
        if (array_key_exists("auth_user_info", $arr)) {
            $info->auth_user_info = AuthUserInfo::ParseFromArray($arr["auth_user_info"]);
        }

        return $info;
    }
}