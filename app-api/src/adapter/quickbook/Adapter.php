<?php

namespace APIExplorer\Adapter\QuickBook;

use APIExplorer\Adapter\get;
use APIExplorer\Adapter\IAdapter;
use \League\OAuth2\Client\Provider\GenericProvider;

class Adapter implements IAdapter
{

    /**
     * @var stdclass
     */
    public $config = null;

    /**
     * @return stdclass
     */
    public function getConfig()
    {
        return $this->config;
    }

    /**
     * @param stdclass $config
     */
    public function setConfig($config)
    {
        $this->config = $config;
    }

    /**
     * @return GenericProvider
     */
    public function getAuthProvider()
    {
        return new GenericProvider([
            'clientId' => $this->getConfig()->clientId,
            'clientSecret' => $this->getConfig()->clientSecret,
            'redirectUri' => $this->getConfig()->redirectUri,
            'urlAuthorize' => $this->getConfig()->urlAuthorize,
            'urlAccessToken' => $this->getConfig()->urlAccessToken,
            'urlResourceOwnerDetails' => null,
            'scopes' => $this->getConfig()->scopes
        ]);
    }

    public function executeEndPoint()
    {
        // TODO: Implement executeEndPoint() method.
    }

    public function getAuthorizationUrl()
    {
        return $this->getAuthProvider()->getAuthorizationUrl();
    }

    public function getAccessToken($type, $params=array())
    {
        return $this->getAuthProvider()->getAccessToken($type, $params);
    }

}
