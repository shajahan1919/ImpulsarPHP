<?php

require_once __DIR__.DIRECTORY_SEPARATOR.'.'.DIRECTORY_SEPARATOR.'predis'.DIRECTORY_SEPARATOR.'src'.DIRECTORY_SEPARATOR.'Autoloader.php';

class RedisCache
{
    /** @var Redis */
    private $redis;

    /** @var string */
    private $prefix;


    /** @var array */
    private $options;

    /**
     * Constructor to initialize and connect to the Redis server.
     *
     * @param string $projectNameOrId A unique identifier for the project.
     * @param string $host
     * @param int $port
     * @param int $timeout
     * @throws Exception if connection fails.
     */
    public function __construct($projectNameOrId, $dbPrefix, $scheme = 'tcp', $host = '127.0.0.1', $port = 6379, $timeout = 3600, $username='', $password='')
    {
        Predis\Autoloader::register();

        $this->timeout = $timeout;

        $this->options = [
            'scheme' => $scheme,
            'host'   => $host,
            'port'   => $port,
            'timeout' => $timeout  // Timeout in seconds
        ];

        if($username!='' || $password!=''){
            $this->options['username'] = $username;
            $this->options['password'] = $password;
        }

        $this->redis = new Predis\Client($this->options);

        //$this->redis = new Redis();

        try {
            $this->redis = new Predis\Client($this->options);
        } catch (RedisException $e) {
            throw new Exception("Failed to connect to Redis: " . $e->getMessage());
        }

        $this->prefix = $projectNameOrId.$dbPrefix;
    }

    /**
     * Generate a key with the project prefix.
     *
     * @param string $key
     * @return string
     */
    private function getPrefixedKey($key)
    {
        return $this->prefix . $key;
    }

    /**
     * Set a value in the cache.
     *
     * @param string $key
     * @param mixed $value
     * @param int|null $ttl Time-to-live in seconds (optional).
     * @return bool
     */
    public function set($key, $value, $ttl = null)
    {
        $key = $this->getPrefixedKey($key);
        if ($ttl) {
            return $this->redis->setex($key, $ttl, $value);
        }
        return $this->redis->set($key, $value);
    }

    /**
     * Get a value from the cache.
     *
     * @param string $key
     * @return mixed|null Returns the value or null if key does not exist.
     */
    public function get($key)
    {
        $key = $this->getPrefixedKey($key);
        $value = $this->redis->get($key);
        return $value !== false ? $value : null;
    }

    /**
     * Delete a key from the cache.
     *
     * @param string $key
     * @return bool
     */
    public function delete($key)
    {
        $key = $this->getPrefixedKey($key);
        return $this->redis->del($key) > 0;
    }

    /**
     * Check if a key exists in the cache.
     *
     * @param string $key
     * @return bool
     */
    public function exists($key)
    {
        $key = $this->getPrefixedKey($key);
        return $this->redis->exists($key) > 0;
    }

    /**
     * Set a value only if the key does not already exist.
     *
     * @param string $key
     * @param mixed $value
     * @return bool
     */
    public function setIfNotExists($key, $value)
    {
        $key = $this->getPrefixedKey($key);
        return $this->redis->setnx($key, $value);
    }

    /**
     * Increment a key's value by a given amount.
     *
     * @param string $key
     * @param int $amount
     * @return int The new value.
     */
    public function increment($key, $amount = 1)
    {
        $key = $this->getPrefixedKey($key);
        return $this->redis->incrBy($key, $amount);
    }

    /**
     * Decrement a key's value by a given amount.
     *
     * @param string $key
     * @param int $amount
     * @return int The new value.
     */
    public function decrement($key, $amount = 1)
    {
        $key = $this->getPrefixedKey($key);
        return $this->redis->decrBy($key, $amount);
    }

    /**
     * Clear all cache data for the current project.
     *
     * @return bool
     */
    public function clearAllCache()
    {
        $keys = $this->redis->keys($this->prefix . '*');
        if (!empty($keys)) {
            return $this->redis->del($keys) > 0;
        }
        return true;
    }

    /**
     * Close the Redis connection.
     */
    public function close()
    {
        $this->redis->disconnect();
    }

    public function __destruct(){
        $this->close();
    }
}

?>