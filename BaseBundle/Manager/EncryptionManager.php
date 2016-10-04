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
        return urlencode(base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5($this->key), $token, MCRYPT_MODE_CBC, md5(md5($this->key)))));
    }

    /**
     * @param $encryptedToken
     *
     * @return string
     */
    public function decrypt($encryptedToken)
    {
        $decryptedToken = rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, md5($this->key), base64_decode(urldecode($encryptedToken)), MCRYPT_MODE_CBC, md5(md5($this->key))), "\0");
        if (false === $decryptedToken || false === ctype_xdigit($decryptedToken)) {
            throw new \InvalidArgumentException('Invalid decrypted token. Check the encryption key');
        }

        return $decryptedToken;
    }
}
