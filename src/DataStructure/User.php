<?php
namespace WeWorkApi\DataStructure;

use WeWorkApi\Utils\ParameterError;
use WeWorkApi\Utils\QyApiError;
use WeWorkApi\Utils\Utils;

include_once(__DIR__ . "/../Utils/Utils.php");

class ExtattrItem
{
	public $name = null;
	public $value = null;

	public function __construct($name = null, $value = null)
	{
		$this->name = $name;
		$this->value = $value;
	}
}

class ExtattrList
{
    public $attrs = null; // ExtattrItem array
}

class User
{
	public $userid = null;  // string 
	public $name = null;  // string
	public $english_name = null;  // string
	public $mobile = null;  // string
	public $department = null;  // uint array
	public $order = null;  // uint array
	public $position = null;  // string
	public $gender = null;  // uint [bug]
	public $email = null;  // string
	public $telephone = null;  // string
	public $isleader = null; // uint
	public $avatar_mediaid = null;  // string
	public $enable = null; // uint
	public $extattr = null;  // ExtattrList
    public $status = null; // uint, 激活状态: 1=已激活，2=已禁用，4=未激活。已激活代表已激活企业微信或已关注微信插件。未激活代表既未激活企业微信又未关注微信插件。

	static public function Array2User($arr)
	{
		$user = new User();

        $user->userid = Utils::arrayGet($arr, "userid");
        $user->name = Utils::arrayGet($arr, "name");
        $user->english_name = Utils::arrayGet($arr, "english_name");
        $user->mobile = Utils::arrayGet($arr, "mobile");
        $user->department = Utils::arrayGet($arr, "department");
        $user->order = Utils::arrayGet($arr, "order");
        $user->position = Utils::arrayGet($arr, "position");
        $user->gender = Utils::arrayGet($arr, "gender");
        $user->email = Utils::arrayGet($arr, "email");
        $user->telephone = Utils::arrayGet($arr, "telephone");
        $user->isleader = Utils::arrayGet($arr, "isleader");
        $user->avatar_mediaid = Utils::arrayGet($arr, "avatar_mediaid");
        $user->enable = Utils::arrayGet($arr, "enable");
        $user->status = Utils::arrayGet($arr, "status");

        if (array_key_exists("extattr", $arr)) { 
            $attrs = $arr["extattr"]["attrs"];
            if (is_array($attrs)) {
                $user->extattr = new ExtattrList();
                foreach ($attrs as $item) {
                    $name = $item["name"];
                    $value = $item["value"];
                    $user->extattr->attrs[] = new ExtattrItem($name, $value);
                }
            }
        }

		return $user;
	}

	static public function Array2UserList($arr)
	{
        $userList = $arr["userlist"];

        $retUserList = array();
        if (is_array($userList)) {
            foreach ($userList as $item) {
                $user = User::Array2User($item);
                $retUserList[] = $user;
            }
        }
        return $retUserList;
	}

    /**
     * @param $user
     * @throws \WeWorkApi\Utils\ParameterError
     */
    static public function CheckUserCreateArgs($user)
    {
        try {
            Utils::checkNotEmptyStr($user->userid, "userid");
        } catch (ParameterError $e) {
            echo $e->getMessage();
        }
        try {
            Utils::checkNotEmptyStr($user->name, "name");
        } catch (ParameterError $e) {
            echo $e->getMessage();
        }
        try {
            Utils::checkNotEmptyArray($user->department, "department");
        } catch (ParameterError $e) {
            echo $e->getMessage();
        }
    }

    static public function CheckUserUpdateArgs($user)
    {
        try {
            Utils::checkNotEmptyStr($user->userid, "userid");
        } catch (ParameterError $e) {
            echo $e->getMessage();
        }
    }

    /**
     * @param $userIdList
     * @throws QyApiError
     */
    static public function CheckuserBatchDeleteArgs($userIdList)
    {
        try {
            Utils::checkNotEmptyArray($userIdList, "userid list");
        } catch (ParameterError $e) {
            echo $e->getMessage();
        }
        foreach ($userIdList as $userId) {
            try {
                Utils::checkNotEmptyStr($userId, "userid");
            } catch (ParameterError $e) {
                echo $e->getMessage();
            }
        }
        if (count($userIdList) > 200) {
            throw new QyApiError("no more than 200 userid once");
        }
    }

}
