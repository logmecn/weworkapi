<?php
namespace WeWorkApi\DataStructure\Pay;

class SendWorkWxRedpackRsp
{
    public $return_code = null; // string
    public $return_msg = null; // string
    public $sign = null; // string
    public $result_code = null; // string
    public $mch_billno = null; // string
    public $mch_id = null; // string
    public $wxappid = null; // string
    public $re_openid = null; // string
    public $total_amount = null; // int
    public $send_listid = null; // string
    public $sender_name = null; // string
    public $sender_header_media_id = null; // string
}