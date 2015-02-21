<?php

namespace OpenOrchestra\BaseBundle\Manager;

/**
 * Class EncryptionManager
 */
class EncryptionManager
{
    protected $key;

    /**
     * @param string $encryptionKey
     */
    public function __construct($encryptionKey)
    {
        $this->key = $encryptionKey;
    }

    /**
     * @param string $token
     *
     * @return string
     */
    public function encrypt($token)
    {
        return base64_encode($token);

    }

    /**
     * @param $encryptedToken
     *
     * @return string
     */
    public function decrypt($encryptedToken)
    {
        return base64_decode($encryptedToken);
    }
}
