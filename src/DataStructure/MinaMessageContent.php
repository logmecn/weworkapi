<?php
namespace WeWorkApi\DataStructure;
/*
 * 小程序消息类型
 */

use WeWorkApi\Utils\QyApiError;
use WeWorkApi\Utils\Utils;

class MinaMessageContent
{
    public $msgtype = "miniprogram_notice";

    public function __construct($appid=null, $page=null, $title=null,
                                $description=null, bool $emphasis_first_item=true, array $content_item=[])
    {
        $this->appid = $appid;
        $this->page = $page;
        $this->title = $title;
        $this->description = $description;
        $this->emphasis_first_item = $emphasis_first_item; //是否放大第一个content_item(default true)
        $this->content_item = $content_item;
    }

    /**
     * @throws QyApiError
     */
    public function CheckMessageSendArgs()
    {
        $len_title = strlen($this->title);
        $len_desc = strlen($this->description);
        if (($len_title<4 || $len_title>24) || ($len_desc<4 ||$len_desc>24)) {
            throw new QyApiError("Mina Title or Desc len is not allowed!");
        }
        if(count($this->content_item)>10){
            throw new QyApiError("Mina content_item is big than 10");
        }
        foreach ($this->content_item as $k => $v){
            if (strlen($k)>10 || strlen($v)>30){
                throw new QyApiError("Mina key or value more than 10 or 30". $k);
            }
        }
    }

    public function MessageContent2Array(&$arr)
    {
        Utils::setIfNotNull($this->msgtype, "msgtype", $arr);
        $contentArr = array();
        {
            Utils::setIfNotNull($this->appid, "appid", $contentArr);
            Utils::setIfNotNull($this->page,"page",$contentArr);
            Utils::setIfNotNull($this->title, "title", $contentArr);
            Utils::setIfNotNull($this->description, "description", $contentArr);
            Utils::setIfNotNull($this->emphasis_first_item, "emphasis_first_item", $contentArr);
            Utils::setIfNotNull($this->content_item, "content_item", $contentArr);
        }
        Utils::setIfNotNull($contentArr, $this->msgtype, $arr);
    }
}