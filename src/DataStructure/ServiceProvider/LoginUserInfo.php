<?php

namespace WeWorkApi\DataStructure\ServiceProvider;
use WeWorkApi\Utils\Utils;



class LoginUserInfo
{
    public $userid = null; // string
    public $name = null; // string
    public $avatar = null; // string
    public $email = null; // string

    static public function ParseFromArray($arr)
    {
        $info = new LoginUserInfo();

        $info->userid = Utils::arrayGet($arr, "userid");
        $info->name = Utils::arrayGet($arr, "name");
        $info->avatar = Utils::arrayGet($arr, "avatar");
        $info->email = Utils::arrayGet($arr, "email");

        return $info;
    }
}