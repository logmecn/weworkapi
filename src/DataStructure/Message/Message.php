<?php
namespace WeWorkApi\DataStructure\Message;

use WeWorkApi\Utils\QyApiError;
use WeWorkApi\Utils\Utils;

include_once ("FileMessageContent.php");
include_once ("ImageMessageContent.php");
include_once ("MpNewsArticle.php");
include_once ("MpNewsMessageContent.php");
include_once ("NewsArticle.php");
include_once ("NewsMessageContent.php");
include_once ("TextMessageContent.php");
include_once ("TextCardMessageContent.php");
include_once ("VideoMessageContent.php");
include_once ("VoiceMessageContent.php");

class Message
{
    public $sendToAll = false; // bool, 是否全员发送, 即文档所谓 @all
    public $touser = array(); // string array
    public $toparty = array(); // uint array
    public $totag = array(); // uint array
    public $agentid = null; // uint
    public $safe = null; // uint, 表示是否是保密消息，0表示否，1表示是，默认0
    public $messageContent = null; // xxxMessageContent
    public $enable_id_trans = 0; // 表示是否开启id转译，0表示否，1表示是，默认0
    public $enable_duplicate_check = 0; //	表示是否开启重复消息检查，0表示否，1表示是，默认0
    public $duplicate_check_interval = 1800; //表示是否重复消息检查的时间间隔，默认1800s，最大不超过4小时

    /**
     * @throws QyApiError
     */
    public function CheckMessageSendArgs()
    {
        if (count($this->touser) > 1000) throw new QyApiError("touser should be no more than 1000");
        if (count($this->toparty) > 100) throw new QyApiError("toparty should be no more than 100");
        if (count($this->totag) > 100) throw new QyApiError("toparty should be no more than 100");

        if (is_null($this->messageContent)) throw new QyApiError("messageContent is empty");
        $this->messageContent->CheckMessageSendArgs();
    }

    public function Message2Array()
    {
        $args = array();

        if (true == $this->sendToAll) {
            Utils::setIfNotNull("@all", "touser", $args);
        } else {
            //
            $touser_string = null;
            foreach($this->touser as $item) {
                $touser_string = $touser_string . $item . "|";
            }
            Utils::setIfNotNull($touser_string, "touser", $args);

            //
            $toparty_string = null;
            foreach($this->toparty as $item) {
                $toparty_string = $toparty_string . $item . "|";
            }
            Utils::setIfNotNull($toparty_string, "toparty", $args);

            //
            $totag_string = null;
            foreach($this->totag as $item) {
                $totag_string = $totag_string . $item . "|";
            }
            Utils::setIfNotNull($totag_string, "totag", $args);
        }

        Utils::setIfNotNull($this->agentid, "agentid", $args);
        Utils::setIfNotNull($this->safe, "safe", $args);

        Utils::setIfNotNull($this->enable_id_trans, "enable_id_trans", $args);
        Utils::setIfNotNull($this->enable_duplicate_check, "enable_duplicate_check", $args);
        Utils::setIfNotNull($this->duplicate_check_interval, "duplicate_check_interval", $args);

        $this->messageContent->MessageContent2Array($args);

        return $args;
    }
}
