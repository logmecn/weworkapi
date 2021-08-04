<?php
namespace WeWorkApi\DataStructure;
use WeWorkApi\Utils\Utils;

include_once(__DIR__ . "/../Utils/Utils.php");

class UserInfoByCode 
{
	public $UserId = null; // string
	public $DeviceId = null; // string
	public $user_ticket = null; // string
	public $expires_in = null; // uint 
	public $OpenId = null; // string

    static public function Array2UserInfoByCode($arr)
    {
        $info = new UserInfoByCode();

        $info->UserId = Utils::arrayGet($arr, "UserId");
        $info->DeviceId = Utils::arrayGet($arr, "DeviceId");
        $info->user_ticket = Utils::arrayGet($arr, "user_ticket");
        $info->expires_in = Utils::arrayGet($arr, "expires_in");
        $info->OpenId = Utils::arrayGet($arr, "OpenId");

        return $info;
    }
}

