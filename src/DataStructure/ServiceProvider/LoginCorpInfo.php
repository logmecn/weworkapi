<?php

namespace WeWorkApi\DataStructure\ServiceProvider;
use WeWorkApi\Utils\Utils;



class LoginCorpInfo
{
    public $corpid = null; // string

    static public function ParseFromArray($arr)
    {
        $info = new LoginCorpInfo();

        $info->corpid = Utils::arrayGet($arr, "corpid");

        return $info;
    }
}