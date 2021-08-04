<?php

namespace WeWorkApi\DataStructure\ServiceProvider;
use WeWorkApi\Utils\ParameterError;
use WeWorkApi\Utils\Utils;


class ContactSync
{
    public $access_token = null; // string
    public $expires_in = null; // uint

    static public function ParseFromArray($arr)
    {
        $info = new ContactSync();

        $info->access_token = Utils::arrayGet($arr, "access_token");
        $info->expires_in = Utils::arrayGet($arr, "expires_in");

        return $info;
    }
}