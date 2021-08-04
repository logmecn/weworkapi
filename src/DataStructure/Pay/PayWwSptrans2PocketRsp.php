<?php

namespace WeWorkApi\DataStructure\Pay;

class PayWwSptrans2PocketRsp
{
    public $return_code = null; // string
    public $return_msg = null; // string
    public $appid = null; // string
    public $mch_id = null; // string
    public $device_info = null; // string
    public $nonce_str = null; // string
    public $result_code = null; // string
    public $partner_trade_no = null; // string
    public $payment_no = null; // string
    public $payment_time = null; // string
}