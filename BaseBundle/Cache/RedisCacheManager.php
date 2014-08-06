<?php

namespace PHPOrchestra\BaseBundle\Cache;

use Snc\RedisBundle\Client\Phpredis\Client;

/**
 * Class RedisCacheManager
 */
class RedisCacheManager implements CacheManagerInterface
{
    protected $keystoreService;

    /**
     * @param Client $keystoreService
     */
    public function __construct(Client $keystoreService)
    {
        $this->keystoreService = $keystoreService;
    }

    /**
     * @param string $key
     *
     * @return mixed
     */
    public function get($key)
    {
        $value = $this->keystoreService->get($key);

        if (empty($value)) {
            $value = $this->keystoreService->hGetall($key);
        }

        return $value;
    }

    /**
     * @param string       $key
     * @param array|string $value
     */
    public function set($key, $value)
    {
        if (is_array($value)) {
            $this->keystoreService->hmSet($key, $value);
        } else {
            $this->keystoreService->set($key, $value);
        }
    }

    /**
     * @param string $pattern
     *
     * @return mixed
     */
    public function deleteKeys($pattern)
    {
        $keys = $this->keystoreService->keys($pattern);

        return $this->keystoreService->del($keys);
    }
}
