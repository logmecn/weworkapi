<?php
namespace WeWorkApi\DataStructure\ServiceCorp;
use WeWorkApi\Utils\ParameterError;
use WeWorkApi\Utils\Utils;

include_once(__DIR__ . "/../../Utils/Utils.php");

class SetSessionInfoReq {
    public $pre_auth_code = null; // string
    public $session_info = null; // SessionInfo

    public function FormatArgs()
    {
        try {
            Utils::checkNotEmptyStr($this->pre_auth_code, "pre_auth_code");
        } catch (ParameterError $e) {
            return $e->getMessage();
        }

        $args = array();

        $args["pre_auth_code"] = $this->pre_auth_code;
        $args["session_info"] = $this->session_info->FormatArgs();

        return $args;
    }
}