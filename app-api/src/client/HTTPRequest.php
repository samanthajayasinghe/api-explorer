<?php
/**
 * @author Samantha Jayasinghe
 *
 * Http Request
 */

namespace QuickBook\Client;

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
    private $apiVersion = 'v1';
    /**
     * @var string
     */
    private $basePath = '';

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
    private function setEndPoint($endPoint)
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
}
