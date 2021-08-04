<?php
namespace WeWorkApi\DataStructure\ServiceCorp;
use WeWorkApi\DataStructure\ServiceCorp\AppAdmin;

include_once(__DIR__ . "/../../Utils/Utils.php");



class GetAdminListRsp
{
    public $admin = null; // AppAdmin array

    static public function ParseFromArray($arr)
    {
        $info = new GetAdminListRsp();

        foreach($arr["admin"] as $item) {
            $info->admin[] = AppAdmin::ParseFromArray($item);
        }

        return $info;
    }
}