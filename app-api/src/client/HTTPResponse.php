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
     * @return bool
     */
    public function hasError()
    {
        if ($this->getStatusCode() != 200) {
            return true;
        } else {
            $result = $this->getResult();
            if (isset($result['error'])) {
                return true;
            }
        }
    }

    /**
     * @return array
     */
    public function getError()
    {
        $result = $this->getResult();
        if (isset($result['error'])) {
            return $result['error']['text'];
        }
    }

    /**
     * Format headers
     * @return array
     */
    public function getFormatHeader(){
        $data = array();
        foreach ($this->getResponse()->getHeaders() as $name => $values) {
            $data[$name] = implode(', ', $values);
        }
        return $data;
    }

    /**
     * Covert response to array
     * @return array
     */
    public function toArray(){
        $data = array();
        $data['body'] = $this->getResult();
        $data['statusCode'] = $this->getStatusCode();
        $data['header'] = $this->getFormatHeader();
        $data['endpont'] = $this->getEndPoint();
        return $data;
    }

}
