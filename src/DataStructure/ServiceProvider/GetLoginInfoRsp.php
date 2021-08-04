<?php
namespace WeWorkApi\DataStructure\ServiceProvider;
use WeWorkApi\Utils\Utils;

include_once(__DIR__ . "/../../Utils/Utils.php");

class GetLoginInfoRsp
{
    public $usertype = null; // uint
    public $user_info = null; // LoginUserInfo
    public $corp_info = null; // LoginCorpInfo
    public $agent = null; // LoginAgentInfo array
    public $auth_info = null; // LoginAuthInfo

    static public function ParseFromArray($arr)
    {
        $info = new GetLoginInfoRsp();

        $info->usertype = Utils::arrayGet($arr, "usertype");

        if (array_key_exists("user_info", $arr)) {
            $info->user_info = LoginUserInfo::ParseFromArray($arr["user_info"]);
        }
        if (array_key_exists("corp_info", $arr)) {
            $info->corp_info = LoginCorpInfo::ParseFromArray($arr["corp_info"]);
        }
        foreach($arr["agent"] as $item) {
            $info->agent[] = LoginAgentInfo::ParseFromArray($item);
        }
        if (array_key_exists("auth_info", $arr)) {
            $info->auth_info = LoginAuthInfo::ParseFromArray($arr["auth_info"]);
        }

        return $info;
    }
}