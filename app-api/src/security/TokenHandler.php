<?php

/**
 * @author Samantha Jayasinghe
 *
 * TokenHandler
 */

namespace APIExplorer\Security;

class TokenHandler
{

    /**
     * @var string
     * The cipher method
     */
    private $encryptMethod = 'AES-256-CBC';

    /**
     * @var string
     * The key.
     */
    private $secretKey = '';

    /**
     * @var string
     *
     * A non-NULL Initialization Vector.
     */
    private $secretIv = '';

    /**
     * TokenHandler constructor.
     *
     * @param string $secretKey
     * @param string $secretIv
     */
    public function __construct($secretKey, $secretIv)
    {
        $this->setSecretKey($secretKey)
            ->setSecretIv($secretIv);
    }

    /**
     * @return string
     */
    public function getSecretKey()
    {
        return $this->secretKey;
    }

    /**
     * @param $secretKey
     *
     * @return $this
     */
    private function setSecretKey($secretKey)
    {
        $this->secretKey = hash('sha256', $secretKey);

        return $this;
    }

    /**
     * @return string
     */
    public function getSecretIv()
    {
        return $this->secretIv;
    }

    /**
     * @param $secretIv
     *
     * @return $this
     */
    public function setSecretIv($secretIv)
    {
        $this->secretIv = substr(hash('sha256', $secretIv), 0, 16);

        return $this;
    }

    /**
     * @param $string
     *
     * @return string
     */
    public function encrypt($string)
    {
        $output = openssl_encrypt($string, $this->encryptMethod, $this->getSecretKey(), 0, $this->getSecretIv());

        return base64_encode($output);
    }

    /**
     * @param $string
     *
     * @return string
     */
    public function decrypt($string)
    {
        return openssl_decrypt(base64_decode($string), $this->encryptMethod, $this->getSecretKey(), 0,
            $this->getSecretIv());
    }
}
