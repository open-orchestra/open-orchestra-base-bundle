<?php

namespace PHPOrchestra\BaseBundle\Cache;

/**
 * Interface CacheManagerInterface
 */
interface CacheManagerInterface
{
    /**
     * Get value $key value from cache
     * 
     * @param string $key
     */
    public function get($key);

    /**
     * Associate in the cache $value to $key
     * 
     * @param string       $key
     * @param string|array $value
     */
    public function set($key, $value);
    
    /**
     * Delete all keys matching $pattern
     * 
     * @param string $pattern
     */
    public function deleteKeys($pattern);
}
