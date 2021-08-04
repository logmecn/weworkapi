<?php

namespace WeWorkApi\DataStructure\Message;

use WeWorkApi\Utils\Utils;



class VideoMessageContent
{
    public $msgtype = "video";
    public $media_id = null; // string
    public $title = null; // string
    public $description = null; // string

    public function __construct($media_id=null, $title=null, $description=null)
    {
        $this->media_id = $media_id;
        $this->title = $title;
        $this->description = $description;
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
            Utils::setIfNotNull($this->title, "title", $contentArr);
            Utils::setIfNotNull($this->description, "description", $contentArr);
        }
        Utils::setIfNotNull($contentArr, $this->msgtype, $arr);
    }
}