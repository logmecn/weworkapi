<?php
namespace WeWorkApi\DataStructure\Invoice;

class InvoiceUserInfo
{
    public $fee = null; // string
    public $title = null; // string
    public $billing_time = null; // string
    public $billing_no = null; // string
    public $billing_code = null; // string
    public $info = null; // BillingInfo array
    public $fee_without_tax = null; // string
    public $tax = null; // string
    public $detail = null; // string
    public $pdf_url = null; // string
    public $reimburse_status = null; // string
    public $order_id = null; // string
    public $check_code = null; // string
    public $buyer_number = null; // string
}