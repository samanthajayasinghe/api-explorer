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
     * HTTPResponse constructor.
     *
     * @param GuzzleResponse $response
     */
    public function __construct($response)
    {
        $this->response = $response;
    }

    /**
     * @return null
     */
    public function getStatusCode()
    {
        return $this->statusCode;
    }

    /**
     * @param null $statusCode
     * @return $this;
     */
    public function setStatusCode($statusCode)
    {
        $this->statusCode = $statusCode;
        return $this;
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
     * Extract Token
     * @return mixed
     */
    public function getToken()
    {
        $result = $this->getResult();
        if (isset($result['access_token'])) {
            return $result['access_token'];
        }
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
        if(!$this->hasError()){
            $data['body'] = $this->getResult();
        }else{
            $data['body'] = $this->getError();
        }
        $data['statusCode'] = $this->getStatusCode();
        $data['header'] = $this->getFormatHeader();
        return $data;
    }

}
