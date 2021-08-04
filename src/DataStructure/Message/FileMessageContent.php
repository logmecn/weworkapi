<?php

namespace WeWorkApi\DataStructure\Message;

use WeWorkApi\Utils\Utils;



class FileMessageContent
{
    public $msgtype = "file";
    public $media_id = null; // string

    public function __construct($media_id=null)
    {
        $this->media_id = $media_id;
    }

    public function CheckMessageSendArgs()
    {
        Utils::checkNotEmptyStr($this->media_id, "media_id");
    }

    public function MessageContent2Array(&$arr)
    {
        Utils::setIfNotNull($this->msgtype, "msgtype", $arr);

        $contentArr = array();
        {
            Utils::setIfNotNull($this->media_id, "media_id", $contentArr);
        }
        Utils::setIfNotNull($contentArr, $this->msgtype, $arr);
    }
}