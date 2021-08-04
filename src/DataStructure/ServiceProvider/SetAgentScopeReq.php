<?php

namespace WeWorkApi\DataStructure\ServiceProvider;
use WeWorkApi\Utils\Utils;



class SetAgentScopeReq
{
    public $agentid = null; // uint
    public $allow_user = null; // string array
    public $allow_party = null; // uint array
    public $allow_tag = null; // uint array

    public function FormatArgs()
    {
        $args = array();

        Utils::setIfNotNull($this->agentid, "agentid", $args);
        Utils::setIfNotNull($this->allow_user, "allow_user", $args);
        Utils::setIfNotNull($this->allow_party, "allow_party", $args);
        Utils::setIfNotNull($this->allow_tag, "allow_tag", $args);

        return $args;
    }
}