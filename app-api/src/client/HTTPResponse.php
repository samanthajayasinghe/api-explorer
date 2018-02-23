<?php
/**
 * @author Samantha Jayasinghe
 *
 * Http Response
 */

namespace APIExplorer\Client;

use GuzzleHttp\Psr7\Response as GuzzleResponse;

class HTTPResponse
{

    /**
     * @var HTTPRequest
     */
    private $response = null;
    /**
     * @var int
     */
    private $statusCode = 200;
    /**
     * @var array
     */
    private $result = array();

    /**
     * @var string
     */
    private $endPoint = '';

    /**
     * @var array
     */
    private $extraData = array();

    /**
     * HTTPResponse constructor.
     *
     * @param GuzzleResponse $response
     */
    public function __construct($response)
    {
        $this->response = $response;
        $this->statusCode = $response->getStatusCode();
    }

    /**
     * @return null
     */
    public function getStatusCode()
    {
        return $this->statusCode;
    }

    /**
     * @return string
     */
    public function getEndPoint()
    {
        return $this->endPoint;
    }

    /**
     * @param string $endPoint
     */
    public function setEndPoint($endPoint)
    {
        $this->endPoint = $endPoint;
    }

    /**
     * @return array
     */
    public function getExtraData()
    {
        return $this->extraData;
    }

    /**
     * @param array $extraData
     */
    public function setExtraData($extraData)
    {
        $this->extraData = $extraData;
    }

    /**
     * @return array
     */
    public function getResult()
    {
        if (empty($this->result)) {
            if (empty($this->getResponse()->getBody())) {
                return null;
            }
            $this->result = json_decode($this->getResponse()->getBody()->getContents(), true);
        }

        return $this->result;
    }

    /**
     * @return GuzzleResponse
     */
    private function getResponse()
    {
        return $this->response;
    }

    /**
     * Format headers
     * @return array
     */
    public function getFormatHeader()
    {
        $data = array();
        foreach ($this->getResponse()->getHeaders() as $name => $values) {
            $data[$name] = implode(', ', $values);
        }

        return $data;
    }

    /**
     *
     * @return array
     */
    public function toArray()
    {
        $data = array();
        $data['body'] = $this->getResult();
        $data['statusCode'] = $this->getStatusCode();
        $data['header'] = $this->getFormatHeader();
        $data['endpont'] = $this->getEndPoint();

        return array_merge($this->getExtraData(), $data);
    }
}
