# API.php
API抽象类，
# CorpAPI.php
为企业开放的接口
# ServiceCorpApi.php
为服务商开放的接口, 使用应用授权的token
# ServiceProviderApi.php
为服务商开放的接口, 使用服务商的token
# 以上API类，都会自动获取、刷新token，调用者不用关心token
