<?php
namespace WeWorkApi\DataStructure\Pay;

//查询付款记录
class QueryWwSptrans2PocketReq
{
    public $sign = null; // string
    public $partner_trade_no = null; // string
    public $mch_id = null; // string
    public $appid = null; // string
    public $nonce_str = null; // string
}