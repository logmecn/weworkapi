<?php

namespace WeWorkApi\DataStructure\ServiceProvider;
use WeWorkApi\Utils\Utils;




class GetRegisterInfoRsp
{
    public $corpid = null; // string
    public $contact_sync = null; // ContactSync
    public $auth_user_info = null; // RegisterAuthUserInfo

    static public function ParseFromArray($arr)
    {
        $info = new GetRegisterInfoRsp();

        $info->corpid = Utils::arrayGet($arr, "corpid");

        if (array_key_exists("contact_sync", $arr)) {
            $info->contact_sync = ContactSync::ParseFromArray($arr["contact_sync"]);
        }
        if (array_key_exists("auth_user_info", $arr)) {
            $info->auth_user_info = RegisterAuthUserInfo::ParseFromArray($arr["auth_user_info"]);
        }

        return $info;
    }
}