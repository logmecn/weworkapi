# About
此项目是Fork自https://github.com/sbzhu/weworkapi_php。原项目基本无后续开发，因此自己加了一些新功能进来。
主要增加的有：

1. 互联企业相关（注：小程序暂不支持互联企业用户，因为无法解code）：参考 api\examples\testLink.php
    * 互联企业消息推送
    * 互联企业的通讯录信息获取（成员、部门等）
1. 消息发送：增加了新进企业微信消息发送功能：
    * MarkDown消息发送；
    * 小程序消息发送；
    * 任务卡片消息发送（需要企业微信应用有回调功能支持）；
1. 增加使用Redis缓存。在 config 文件中修改配置。

本项目着重*重构了 composer 功能*，可使用 comopser update 添加到自己的项目中。

后续会继续增加丰富其功能。

### composer 安装方法：
composer require logmecn/weworkapi

或在 require 中添加以下，并执行 composer update
```$xslt
"logmecn/weworkapi":  "dev-master"
```

### Phalapi 框架的使用方法建议：
1. 配置文件：在 config/app.php 中增加企业微信相关的配置。比如：
    ```php
    return [
       'qywx'=>['corpid'=>'','agentId'=>'','secret'=>'']
    ];
    ```
2. 使用composer更新了代码后，在 Api/Site.php 中使用：
    ```php
       use Phalapi\API;
       use WeWorkApi\CorpAPI;
       use WeWorkApi\Utils\ParameterError;
       class Qywx extends API{
       public function Sendmsg(){
           $config = DI()->config->get("app.qywx");
           try {
               $api = new CorpAPI($config['corpid'], $config['secret']);
           } catch (ParameterError $e) {
               echo $e->getMessage() . "\n";
           }
           $user = $api->UserGet("userid");
           var_dump($user);
           //
           $user->mobile = "1219887219873";
           $api->UserUpdate($user); 
       }
   }
    ```

### 使用ThinkPHP的扩展更新示例：
1. 用 comopser 添加 "logmecn/weworkapi" 
1. 在config 中添加企业微信对应 的配置；
1. 在 application 对应的文件中，使用类似上面Phalapi的方法。

## 使用企业微信时注意以下几个概念：
1. 留意几个id： 
    * corpid ： 企业id，用于识别企业的唯一性。在 https://work.weixin.qq.com/wework_admin 扫码登录企业微信管理后台后， “我的企业、企业ID”获取。
    * agentid： 应用的id，是在企业微信管理后台的“应用管理、应用”中获取
    * appid： 企业微信中的应用，如果使用了小程序，则会有小程序的appid
    * userid： 使用企业微信接口获取到的用户唯一id标识。
1. 留意几个secret：
    * 通讯录secret：在企业微信管理后台的“管理工具、通讯录同步”中，可设置回调地址和密钥。
    * 应用 secret：对应上面应用中的 agentid 下面一行的secret
    * 客户群 secret：在企业微信管理后台的“客户工具、客户”右边，有一个API，点进去可查看到。
    * 会话存档密钥：在“管理工具、会话内容存档”中按提示设置。可以使用 open_ssl 生成一个公钥发给企业微信，生成的密钥放在服务器上对接收信息解密。
1. 关联企业和企业互联：这是两个不同的概念，不要混淆。
    * 关联企业：新添加的关联企业功能，需要有另外一个企业微信做设置。
通讯录之间没有上下级关系，是同级的。
    * 企业互联：两个不同的企业通讯录，有上下级关系。
    
# 以下原说明
weworkapi_php 是为了简化开发者对企业微信API接口的使用而设计的，API调用库系列之php版本    
包括企业API接口、消息回调处理方法、第三方开放接口等    
本库仅做示范用，并不保证完全无bug；  
另外，作者会不定期更新本库，但不保证与官方API接口文档同步，因此一切以[官方文档](https://work.weixin.qq.com/api/doc)为准。

更多来自个人开发者的其它语言的库推荐：   
python : https://github.com/sbzhu/weworkapi_python  abelzhu@tencent.com(企业微信团队)  
ruby ： https://github.com/mycolorway/wework  MyColorway(个人开发者)  
php : https://github.com/sbzhu/weworkapi_php  abelzhu@tencent.com(企业微信团队)  
golang : https://github.com/sbzhu/weworkapi_golang  ryanjelin@tencent.com(企业微信团队)  
golang : https://github.com/doubliekill/EnterpriseWechatSDK  1006401052yh@gmail.com(个人开发者)  

# Requirement
经测试，PHP 5.3.3 ~ 7.2.0 版本均可使用

# Director  
├── examples // API接口的测试用例   
└── src // API接口的关键逻辑   
│    ├── api // API 接口    
│    │   ├── datastructure // API接口需要使用到的一些数据结构   
│    ├── callback // 消息回调的一些方法   
│    ├── config.php    
│    ├── CorpApi.php  // 基础类    
│    ├── LinkpApi.php  // 关联企业等其他功能类      
│    └── utils // 一些基础方法    
├── composer.json     
└── README.md     

# Usage
将本项目下载到你的目录，既可直接引用相关文件  
```
//include_once("api/src/CorpAPI.php");
use WeWorkApi\CorpAPI;
// 实例化 API 类
$api = new CorpAPI($corpId='ww55ca070cb9b7eb22', $secret='ktmzrVIlUH0UW63zi7-JyzsgTL9NfwUhHde6or6zwQY');

try { 
    // 创建 User
    $user = new User();
    {
        $user->userid = "userid";
        $user->name = "name";
        $user->mobile = "131488888888";
        $user->email = "sbzhu@ipp.cas.cn";
        $user->department = array(1); 
    } 
    $api->UserCreate($user);

    // 获取User
    $user = $api->UserGet("userid");

    // 删除User
    $api->UserDelete("userid"); 
} catch {
    echo $e->getMessage() . "\n";
    $api->UserDelete("userid");
}
```
详细使用方法参考每个模块下的测试用例：example目录下对应的文件

# 关于token的缓存
token是需要缓存的，不能每次调用都去获取token，[否则会中频率限制](https://work.weixin.qq.com/api/doc#10013/%E7%AC%AC%E5%9B%9B%E6%AD%A5%EF%BC%9A%E7%BC%93%E5%AD%98%E5%92%8C%E5%88%B7%E6%96%B0access_token)  
在本库的设计里，token是以类里的一个变量缓存的  
比如api/src/CorpAPI.php 里的$accessToken变量  
在类的生命周期里，这个accessToken都是存在的， 当且仅当发现token过期，CorpAPI类会自动刷新token   
刷新机制在 api/src/API.php  
所以，使用时，只需要全局实例化一个CorpAPI类，不要析构它，就可一直用它调函数，不用关心 token  
```
$api = new CorpAPI(corpid, corpsecret);
$api->dosomething()
$api->dosomething()
$api->dosomething()
....
```
当然，如果要更严格的做的话，建议自行修改，```全局缓存token，比如存redis、存文件等```，失效周期设置为2小时。

# Contact us  
logme@foxmail.cn 
# 