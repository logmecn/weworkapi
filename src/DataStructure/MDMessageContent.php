<?php
/*
 * 新增几个新加企业微信发送消息的功能，原基础库中没有。
 * "msgtype" : "interactive_taskcard", 任务卡片消息
 *  "msgtype" : "miniprogram_notice", 小程序通知消息
 * "msgtype": "markdown",markdown消息
 * author ywq
 * date: 2021/07/15
 */
namespace WeWorkApi\DataStructure;
use WeWorkApi\Utils\QyApiError;
use WeWorkApi\Utils\Utils;

include_once(__DIR__ . "/../Utils/Error.php");
include_once(__DIR__ . "/../Utils/Utils.php");

/*
 * MD文档消息类型
 */
class MDMessageContent
{
    public $msgtype = "markdown";
    private $content = null; // string

    public function __construct($content=null)
    {
        $this->content = $content;
    }

    /**
     * @throws QyApiError
     */
    public function CheckMessageSendArgs()
    {
        if (mb_detect_encoding($this->content, 'UTF-8') != 'UTF-8') {
            throw new QyApiError("invalid MarkDown is not UTF-8");
        }
        $len = strlen($this->content);
        if ($len == 0 || $len > 2048) {
            throw new QyApiError("invalid MarkDown content length " . $len);
        }
    }

    public function MessageContent2Array(&$arr)
    {
        Utils::setIfNotNull($this->msgtype, "msgtype", $arr);

        $contentArr = array("content" => $this->content);
        Utils::setIfNotNull($contentArr, $this->msgtype, $arr);
    }
}

