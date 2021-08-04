<?php

namespace WeWorkApi\DataStructure\ServiceProvider;


class LoginAuthInfo
{
    public $department = null; // PartyInfo Array

    static public function ParseFromArray($arr)
    {
        $info = new LoginAuthInfo();

        foreach($arr["department"] as $item) {
            $info->department[] = PartyInfo::ParseFromArray($item);
        }
        return $info;
    }
}