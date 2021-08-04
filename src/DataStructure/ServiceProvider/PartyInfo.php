<?php

namespace WeWorkApi\DataStructure\ServiceProvider;
use WeWorkApi\Utils\Utils;


class PartyInfo
{
    public $id = null; // uint
    public $writable = null; // bool

    static public function ParseFromArray($arr)
    {
        $info = new PartyInfo();

        $info->id= Utils::arrayGet($arr, "id");
        $info->writable = Utils::arrayGet($arr, "writable");

        return $info;
    }
}