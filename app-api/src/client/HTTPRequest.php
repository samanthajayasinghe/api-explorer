<?php
/**
 * @author Samantha Jayasinghe
 *
 * Http Request
 */

namespace APIExplorer\Client;

class HTTPRequest
{

    /**
     * @var string EndPoint
     */
    private $endPoint = null;
    /**
     * @var Params
     */
    private $params = array();

    /**
     * @var string
     */
    private $apiVersion = '';
    /**
     * @var string
     */
    private $basePath = '';

    /**
     * @var string
     */
    private $token = '';

    /**
     * HTTPRequest constructor.
     *
     * @param null $endPoint
     * @param null $params
     */
    public function __construct($endPoint = null, $params = null)
    {
        $this->setEndPoint($endPoint)
            ->setParams($params);
    }

    /**
     * @return string
     */
    public function getEndPoint()
    {
        return $this->endPoint;
    }

    /**
     * @param $endPoint
     *
     * @return $this
     */
    public function setEndPoint($endPoint)
    {
        $this->endPoint = $endPoint;

        return $this;
    }

    /**
     * @return Params
     */
    public function getParams()
    {
        return $this->params;
    }

    /**
     * @param $params
     *
     * @return $this
     */
    private function setParams($params)
    {
        $this->params = $params;

        return $this;
    }

    /**
     * @return string
     */
    public function getApiVersion()
    {
        return $this->apiVersion;
    }

    /**
     * @param string $apiVersion
     */
    public function setApiVersion($apiVersion)
    {
        $this->apiVersion = $apiVersion;
    }

    /**
     * @return string
     */
    public function getBasePath()
    {
        return $this->basePath;
    }

    /**
     * @param string $basePath
     */
    public function setBasePath($basePath)
    {
        $this->basePath = $basePath;
    }

    /**
     * @return string
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * @param string $token
     */
    public function setToken($token)
    {
        $this->token = $token;
    }

    /**
     * @return string
     */
    public function getFormatEndPoint()
    {
        $path = $this->getBasePath();
        if (!empty($this->getApiVersion())) {
            $path .= $this->getApiVersion() ;
        }

        return $path . $this->getEndPoint();
    }
}
