<?php
/**
 * @author Samantha Jayasinghe
 *
 * Http Client
 */

namespace APIExplorer\Client;

use GuzzleHttp\Client as HttpClient;
use Prophecy\Exception\Exception;

class Client implements IClient
{

    /**
     * @var string
     */
    private $domain = '';

    /**
     * @var HttpClient
     */
    private $httpClient = null;

    /**
     * Client constructor.
     *
     * @param $domain
     */
    public function __construct($domain)
    {
        $this->setDomain($domain)
            ->setHttpClient(new HttpClient(['base_uri' => $this->getDomain(), 'Content-Type' => 'application/json']));
    }

    /**
     * @return Domain
     */
    public function getDomain()
    {
        return $this->domain;
    }

    /**
     * @param $domain
     *
     * @return $this
     */
    private function setDomain($domain)
    {
        $this->domain = $domain;

        return $this;
    }

    /**
     * @return HttpClient
     */
    public function getHttpClient()
    {
        return $this->httpClient;
    }

    /**
     * @param $httpClient
     *
     * @return $this
     */
    private function setHttpClient($httpClient)
    {
        $this->httpClient = $httpClient;

        return $this;
    }

    /**
     * @param HTTPRequest $request
     *
     * @return HTTPResponse
     */
    public function get(HTTPRequest $request)
    {
        try {
            $request->setBasePath($this->getDomain());
            $data = [
                'headers' => [
                    'Accept'        => 'application/json',
                    'Authorization' => 'Bearer ' . $request->getToken(),
                ],
            ];
            $endPoint = $request->getFormatEndPoint();
            $response = $this->getHttpClient()
                ->get($endPoint, $data);
            $httpResponse = new HTTPResponse($response);
            $httpResponse->setEndPoint($endPoint);

            return $httpResponse;
        } catch (\Exception $e) {
            $httpResponse = new HTTPResponse($e->getResponse());
            $httpResponse->setEndPoint($endPoint);

            return $httpResponse;
        }
    }

    public function post(HTTPRequest $request)
    {
        throw new \Exception("method not implemented");
    }

    public function put(HTTPRequest $request)
    {
        throw new \Exception("method not implemented");
    }

    public function delete(HTTPRequest $request)
    {
        throw new \Exception("method not implemented");
    }
}
