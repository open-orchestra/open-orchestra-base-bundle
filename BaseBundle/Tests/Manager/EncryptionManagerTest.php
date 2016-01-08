<?php

namespace OpenOrchestra\BaseBundle\Tests\Manager;

use OpenOrchestra\BaseBundle\Manager\EncryptionManager;
use OpenOrchestra\BaseBundle\Tests\AbstractTest\AbstractBaseTestCase;

/**
 * Class EncryptionManagerTest
 */
class EncryptionManagerTest extends AbstractBaseTestCase
{
    /**
     * @var EncryptionManager
     */
    protected $manager;

    protected $key = 'SecretKey';

    /**
     * Set up the test
     */
    public function setUp()
    {
        $this->manager = new EncryptionManager($this->key);
    }

    /**
     * @param string $token
     *
     * @dataProvider provideToken
     */
    public function testEncryptAndDecrypt($token)
    {
        $encryptedToken = $this->manager->encrypt($token);
        $this->assertNotSame($encryptedToken, $token);
        $decryptedToken = $this->manager->decrypt($encryptedToken);
        $this->assertSame($token, $decryptedToken);
    }

    /**
     * @return array
     */
    public function provideToken()
    {
        return array(
            array('test'),
            array('token'),
        );
    }
}
