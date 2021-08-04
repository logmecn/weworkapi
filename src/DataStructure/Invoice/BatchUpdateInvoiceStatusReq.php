<?php
namespace WeWorkApi\DataStructure;


class BatchUpdateInvoiceStatusReq
{
    public $openid = null; // string
    public $reimburse_status = null; // string
    public $invoice_list = null; // InvoiceItem array
}