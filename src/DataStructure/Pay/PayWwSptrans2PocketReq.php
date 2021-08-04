<?php

namespace WeWorkApi\DataStructure\Pay;

class PayWwSptrans2PocketReq
{
    public $appid = null; // string
    public $mch_id = null; // string
    public $device_info = null; // string
    public $nonce_str = null; // string
    public $sign = null; // string
    public $partner_trade_no = null; // string
    public $openid = null; // string
    public $check_name = null; // string
    public $re_user_name = null; // string
    public $amount = null; // int
    public $desc = null; // string
    public $spbill_create_ip = null; // string
    public $workwx_sign = null; // string
    public $ww_msg_type = null; // string
    public $act_name = null; // string
}