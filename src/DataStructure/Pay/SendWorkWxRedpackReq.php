<?php
namespace WeWorkApi\DataStructure\Pay;

class SendWorkWxRedpackReq
{ 
    public $nonce_str = null; // string
    public $sign = null; // string
    public $mch_billno = null; // string
    public $mch_id = null; // string
    public $wxappid = null; // string
    public $sender_name = null; // string
    public $agentid = null; // uint 
    public $sender_header_media_id = null; // string
    public $re_openid = null; // string
    public $total_amount = null; // int 
    public $wishing = null; // string
    public $act_name = null; // string
    public $remark = null; // string
    public $scene_id = null; // string
    public $workwx_sign = null; // string
}
