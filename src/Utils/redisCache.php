<?php

namespace WeWorkApi\Utils;

use Redis;

class redisCache implements Cache
{
    protected $redis;
    protected $auth;
    protected $prefix;

    /**
     * @param array $config  redis的参数配置
     */
    public function __construct($config) {
        $this->redis = new Redis();

        // 连接
        if (isset($config['type']) && $config['type'] == 'unix') {
            if (!isset($config['socket'])) {
                return ('redis config key [socket] not found');
            }
            $this->redis->connect($config['socket']);
        } else {
            $port = isset($config['port']) ? intval($config['port']) : 6379;
            $timeout = isset($config['timeout']) ? intval($config['timeout']) : 300;
            $this->redis->connect($config['host'], $port, $timeout);
        }

        // 验证
        $this->auth = isset($config['auth']) ? $config['auth'] : '';
        if ($this->auth != '') {
            $this->redis->auth($this->auth);
        }

        // 选择
        $dbIndex = isset($config['db']) ? intval($config['db']) : 0;
        $this->redis->select($dbIndex);

        $this->prefix = isset($config['prefix']) ? $config['prefix'] : 'phalapi:';
    }

    /**
     * 将value 的值赋值给key,生存时间为expire秒
     * @param $key
     * @param $value
     * @param int $expire
     */
    public function set($key, $value, $expire = 600) {
        $this->redis->setex($this->formatKey($key), $expire, $this->formatValue($value));
    }

    public function get($key) {
        $value = $this->redis->get($this->formatKey($key));
        return $value !== FALSE ? $this->unformatValue($value) : NULL;
    }

    public function delete($key) {
        return $this->redis->del($this->formatKey($key));
    }

    private function formatKey(string $key)
    {
        return $this->prefix . $key;
    }

    private function formatValue($value)
    {
        return @serialize($value);
    }

    private function unformatValue(bool $value)
    {
        return @unserialize($value);
    }
}


interface Cache {

    /**
     * 设置缓存
     * @param string $key 缓存key
     * @param mixed $value 缓存的内容
     * @param int $expire 缓存有效时间，单位秒，非时间戳
     */
    public function set($key, $value, $expire = 600);

    /**
     * 读取缓存
     * @param string $key 缓存key
     * @return mixed 失败情况下返回NULL
     */
    public function get($key);

    /**
     * 删除缓存
     * @param string $key
     */
    public function delete($key);
}
