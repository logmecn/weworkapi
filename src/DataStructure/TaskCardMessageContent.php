<?php
namespace WeWorkApi\DataStructure;
/*
 * 任务卡片消息类型，其中的消息类型示例：
 *    "interactive_taskcard" : {
        "title" : "赵明登的礼物申请",
        "description" : "礼品：A31茶具套装\n用途：赠与小黑科技张总经理",
        "url" : "URL",
        "task_id" : "taskid123",
        "btn":[
            {
                "key": "key111",
                "name": "批准",
                "color":"red",
                "is_bold": true
            },
            {
                "key": "key222",
                "name": "驳回"
            }
        ]
   },
  其中：
btn:key	是	按钮key值，用户点击后，会产生任务卡片回调事件，回调事件会带上该key值，只能由数字、字母和“_-@”组成，最长支持128字节
btn:name	是	按钮名称，最长支持18个字节，超过则截断
btn:color	否	按钮字体颜色，可选“red”或者“blue”,默认为“blue”
btn:is_bold	否	按钮字体是否加粗，默认false
enable_id_trans	否	表示是否开启id转译，0表示否，1表示是，默认0
 */

use WeWorkApi\Utils\QyApiError;
use WeWorkApi\Utils\Utils;

class TaskCardMessageContent
{
    public $msgtype = "interactive_taskcard";

    public function __construct($title=null, $description=null,$url=null,
                                $task_id=null, array $btn=[])
    {
        $this->title = $title; //	标题，不超过128个字节，超过会自动截断（支持id转译）
        $this->description = $description; //描述，不超过512个字节，超过会自动截断（支持id转译）
        $this->url = $url; //点击后跳转的链接。最长2048字节，请确保包含了协议头(http/https)
        $this->task_id = $task_id; //任务id，同一个应用发送的任务卡片消息的任务id不能重复，只能由数字、字母和“_-@”组成，最长支持128字节
        $this->btn = $btn; //按钮列表，按钮个数为1~2个。
    }

    /**
     * @throws QyApiError
     */
    public function CheckMessageSendArgs()
    {
        $len_title = strlen($this->title);
        $len_desc = strlen($this->description);
        if ( $len_title>128 || $len_desc>512 || strlen($this->url)>2048) {
            throw new QyApiError("TaskCard Title or Desc or url len is not allowed!");
        }
        if(count($this->btn)>2){
            throw new QyApiError("TaskCard content_item is big than 2");
        }
        foreach ($this->btn as $k => $v){
            if (strlen($k)>128 || strlen($v)>30){
                throw new QyApiError("TaskCard key or value more than 10 or 30". $k);
            }
        }
    }

    public function MessageContent2Array(&$arr)
    {
        Utils::setIfNotNull($this->msgtype, "msgtype", $arr);
        $contentArr = array();
        {
            Utils::setIfNotNull($this->title, "title", $contentArr);
            Utils::setIfNotNull($this->description, "description", $contentArr);
            Utils::setIfNotNull($this->url, "url", $contentArr);
            Utils::setIfNotNull($this->task_id,"task_id",$contentArr);
            Utils::setIfNotNull($this->btn, "btn", $contentArr);
        }
        Utils::setIfNotNull($contentArr, $this->msgtype, $arr);
    }
}
