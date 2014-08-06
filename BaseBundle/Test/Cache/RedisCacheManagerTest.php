<?php

namespace PHPOrchestra\CMSBundle\Test\cache;

use Phake;
use PHPOrchestra\BaseBundle\Cache\RedisCacheManager;

/**
 * Unit tests of RedisCacheManager
 */
class RedisCacheManagerTest extends \PHPUnit_Framework_TestCase
{
    protected $keyStore;
    protected $redisCacheManager;

    /**
     * Set up the test
     */
    public function setUp()
    {
        $this->keyStore = Phake::mock('Snc\RedisBundle\Client\Phpredis\Client');

        $this->redisCacheManager = new RedisCacheManager($this->keyStore);
    }
    
    /**
     * @param string  $expectedValue
     * @param string  $key
     * @param string  $value
     * @param boolean $isHash
     *
     * @dataProvider getData
     */
    public function testGet($expectedValue, $key, $value, $isHash)
    {
        if ($isHash) {
            Phake::when($this->keyStore)->get(Phake::anyParameters())->thenReturn(null);
            Phake::when($this->keyStore)->hGetall(Phake::anyParameters())->thenReturn($value);
        } else {
            Phake::when($this->keyStore)->get(Phake::anyParameters())->thenReturn($value);
        }
        
        $result = $this->redisCacheManager->get($key);
        
        $this->assertEquals($expectedValue, $result);
        if ($isHash) {
            Phake::verify($this->keyStore)->get($key);
            Phake::verify($this->keyStore)->hGetall($key);
        } else {
            Phake::verify($this->keyStore)->get($key);
            Phake::verify($this->keyStore, Phake::never())->hGetall($key);
        }
    }
    
    /**
     * @param string  $key
     * @param string  $value
     * @param boolean $isHash
     *
     * @dataProvider setData
     */
    public function testSet($key, $value, $isHash)
    {
        $this->redisCacheManager->set($key, $value);

        if ($isHash) {
            Phake::verify($this->keyStore)->hmSet($key, $value);
        } else {
            Phake::verify($this->keyStore)->set($key, $value);
        }
    }

    /**
     * test delete keys
     */
    public function testDeleteKeys()
    {
        $this->redisCacheManager->deleteKeys('somePatternToDelete');

        Phake::verify($this->keyStore)->keys(Phake::anyParameters());
        Phake::verify($this->keyStore)->del(Phake::anyParameters());
    }

    /**
     * @return array
     */
    public function getData()
    {
        return array(
            array('value1', 'key1', 'value1', false),
            array('value2', 'key2', 'value2', true),
            array('value3', 'key3', 'value3', false),
            array('value4', 'key4', 'value4', true),
        );
    }

    /**
     * @return array
     */
    public function setData()
    {
        return array(
            array('key1', 'value1',                  false),
            array('key2', array('value2', 'value2'), true),
        );
    }
}
