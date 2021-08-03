<?php
/*
 * Copyright (C) 2017 All rights reserved.
 *   
 * @File ServiceCorpApi.php
 * @Brief : 为服务商开放的接口, 使用应用授权的token
 * @Author abelzhu, abelzhu@tencent.com
 * @Version 1.0
 * @Date 2017-12-26
 *
 */
namespace WeWorkApi\Api;
use WeWorkApi\CorpAPI;
use WeWorkApi\DataStructure\GetAdminListRsp;
use WeWorkApi\DataStructure\GetAuthInfoRsp;
use WeWorkApi\DataStructure\GetPermanentCodeRsp;
use WeWorkApi\DataStructure\GetUserDetailBy3rdRsp;
use WeWorkApi\DataStructure\GetUserinfoBy3rdRsp;
use WeWorkApi\DataStructure\SetSessionInfoReq;
use WeWorkApi\Utils\HttpUtils;
use WeWorkApi\Utils\ParameterError;
use WeWorkApi\Utils\QyApiError;
use WeWorkApi\Utils\Utils;

include_once(__DIR__ . "/../Utils/Utils.php");
include_once(__DIR__ . "/../Utils/HttpUtils.php");
include_once(__DIR__ . "/../Utils/Error.php");
include_once(__DIR__ . "/../Datastructure/ServiceCorp.php");
include_once(__DIR__ . "/API.php");

class ServiceCorpAPI extends CorpAPI 
{
    private $suite_id = null; // string
    private $suite_secret = null; // string 
    private $suite_ticket = null; // string 

    private $authCorpId = null; // string 
    private $permanentCode = null; // string 

    private $suiteAccessToken = ""; // string

    public function __construct(
        $suite_id=null, 
        $suite_secret=null, 
        $suite_ticket=null, 
        $authCorpId=null, 
        $permanentCode=null)
    {
        $this->suite_id = $suite_id;
        $this->suite_secret = $suite_secret;
        $this->suite_ticket = $suite_ticket;

        // 调用 CorpAPI 的function， 需要设置这两个参数
        $this->authCorpId = $authCorpId;
        $this->permanentCode = $permanentCode;
    }

    /**
     * @brief RefreshAccessToken : override CorpAPI的函数，使用三方服务商的get_corp_token
     *
     * @return void : string
     * @throws ParameterError
     * @throws QyApiError
     */
    protected function RefreshAccessToken()
    {
        Utils::checkNotEmptyStr($this->authCorpId, "auth_corpid");
        Utils::checkNotEmptyStr($this->permanentCode, "permanent_code");
        $args = array(
            "auth_corpid" => $this->authCorpId, 
            "permanent_code" => $this->permanentCode
        ); 
        $url = HttpUtils::MakeUrl("/cgi-bin/service/get_corp_token?suite_access_token=SUITE_ACCESS_TOKEN");
        $this->_HttpPostParseToJson($url, $args, false);
        $this->_CheckErrCode();

        $this->accessToken = $this->rspJson["access_token"];
    }

    /**
     * @brief GetSuiteAccessToken : 获取第三方应用凭证
     *
     * @link https://work.weixin.qq.com/api/doc#10975/获取第三方应用凭证
     *
     * @note 调用者不用关心，本类会自动获取、更新
     *
     * @return  string
     * @throws ParameterError
     * @throws QyApiError
     */
    protected function GetSuiteAccessToken()
    { 
        if ( ! Utils::notEmptyStr($this->suiteAccessToken)) {
            $this->RefreshSuiteAccessToken();
        } 
        return $this->suiteAccessToken;
    }

    /**
     * @throws ParameterError
     * @throws QyApiError
     */
    protected function RefreshSuiteAccessToken()
    {
        Utils::checkNotEmptyStr($this->suite_id, "suite_id");
        Utils::checkNotEmptyStr($this->suite_secret, "suite_secret");
        Utils::checkNotEmptyStr($this->suite_ticket, "suite_ticket");
        $args = array(
            "suite_id" => $this->suite_id, 
            "suite_secret" => $this->suite_secret,
            "suite_ticket" => $this->suite_ticket,
        ); 
        $url = HttpUtils::MakeUrl("/cgi-bin/service/get_suite_token");
        $this->_HttpPostParseToJson($url, $args, false);
        $this->_CheckErrCode();

        $this->suiteAccessToken= $this->rspJson["suite_access_token"];
    }

    // ---------------------- 第三方开放接口 ----------------------------------
    //
    //
    /**
     * @brief GetPreAuthCode : 获取预授权码
     *
     * @link https://work.weixin.qq.com/api/doc#10975/获取预授权
     * @throws ParameterError
     * @throws QyApiError
     */
    public function GetPreAuthCode()
    { 
        self::_HttpCall(self::GET_PRE_AUTH_CODE, 'GET', null); 
        return $this->rspJson["pre_auth_code"];
    }

    /**
     * @brief SetSessionInfo : 设置授权配置
     *
     * @link https://work.weixin.qq.com/api/doc#10975/设置授权配置
     *
     * @param SetSessionInfoReq $SetSessionInfoReq
     * @throws ParameterError
     * @throws QyApiError
     */
    public function SetSessionInfo(SetSessionInfoReq $SetSessionInfoReq)
    { 
        $args = $SetSessionInfoReq->FormatArgs();
        self::_HttpCall(self::SET_SESSION_INFO, 'POST', $args);
    }

    /**
     * @brief GetPermanentCode : 获取企业永久授权码
     *
     * @link https://work.weixin.qq.com/api/doc#10975/获取企业永久授权码
     *
     * @param $temp_auth_code : string 临时授权码
     *
     * @return GetPermanentCodeRsp : GetPermanentCodeRsp
     * @throws ParameterError
     * @throws QyApiError
     */
    public function GetPermanentCode($temp_auth_code)
    { 
        $args = array("auth_code" => $temp_auth_code); 
        self::_HttpCall(self::GET_PERMANENT_CODE, 'POST', $args);
        return GetPermanentCodeRsp::ParseFromArray($this->rspJson);
    }

    /**
     * @brief GetAuthInfo : 获取企业授权信息
     *
     * @link https://work.weixin.qq.com/api/doc#10975/获取企业授权信息
     *
     * @param $auth_corpid : string
     * @param $permanent_code : 永久授权码
     *
     * @return GetAuthInfoRsp : GetAuthInfoRsp
     * @throws ParameterError
     * @throws QyApiError
     */
    public function GetAuthInfo($auth_corpid, $permanent_code)
    { 
        Utils::checkNotEmptyStr($auth_corpid, "auth_corpid");
        Utils::checkNotEmptyStr($permanent_code, "permanent_code");
        $args = array(
            "auth_corpid" => $auth_corpid,
            "permanent_code" => $permanent_code
        ); 
        self::_HttpCall(self::GET_AUTH_INFO, 'POST', $args);
        return GetAuthInfoRsp::ParseFromArray($this->rspJson);
    }

    /**
     * @brief GetAdminList : 获取应用的管理员列表
     *
     * @link https://work.weixin.qq.com/api/doc#10975/获取应用的管理员列表
     *
     * @param $auth_corpid : string
     * @param $agentid : uint
     *
     * @return GetAdminListRsp : GetAdminListRsp
     * @throws ParameterError
     * @throws QyApiError
     */
    public function GetAdminList($auth_corpid, $agentid)
    { 
        Utils::checkNotEmptyStr($auth_corpid, "auth_corpid");
        Utils::checkIsUInt($agentid, "agentid");
        $args = array(
            "auth_corpid" => $auth_corpid,
            "agentid" => $agentid
        ); 
        self::_HttpCall(self::GET_ADMIN_LIST, 'POST', $args);
        return GetAdminListRsp::ParseFromArray($this->rspJson);
    }

    /**
     * @brief GetUserinfoBy3rd :第三方根据code获取企业成员信息
     *
     * @link https://work.weixin.qq.com/api/doc#10975/第三方根据code获取企业成员信息
     *
     * @param $code : string
     *
     * @return GetUserinfoBy3rdRsp : GetUserinfoBy3rdRsp
     * @throws ParameterError
     * @throws QyApiError
     */
    public function GetUserinfoBy3rd($code)
    { 
        self::_HttpCall(self::GET_USER_INFO_BY_3RD, 'GET', array('code'=>$code)); 
        return GetUserinfoBy3rdRsp::ParseFromArray($this->rspJson);
    }

    /**
     * @brief GetUserDetailBy3rd : 第三方使用user_ticket获取成员详情
     *
     * @link https://work.weixin.qq.com/api/doc#10975/第三方使用user_ticket获取成员详情
     *
     * @param $user_ticket : string
     *
     * @return GetUserDetailBy3rdRsp : GetUserDetailBy3rdRsp
     * @throws ParameterError
     * @throws QyApiError
     */
    public function GetUserDetailBy3rd($user_ticket)
    { 
        Utils::checkNotEmptyStr($user_ticket, "user_ticket");
        $args = array("user_ticket" => $user_ticket); 
        self::_HttpCall(self::GET_USER_DETAIL_BY_3RD, 'POST', $args);
        return GetUserDetailBy3rdRsp::ParseFromArray($this->rspJson);
    }

}
