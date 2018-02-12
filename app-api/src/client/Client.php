<?php
/**
 * @author Samantha Jayasinghe
 *
 * Http Client interface
 */

namespace QuickBook\Client;

use GuzzleHttp\Client as HttpClient;
use GuzzleHttp\Exception\RequestException;

class Client implements IClient
{

    /**
     * @var string
     */
    private $domain = '';

    /**
     * @var string
     */
    private $clientId = 0;

    /**
     * @var string
     */
    private $clientSecret = '';

    /**
     * @var HttpClient
     */
    private $httpClient = null;

    /**
     * @var Grant Type string
     */
    private $grantType = 'client_credentials';

    /**
     * Client constructor.
     *
     * @param $domain
     * @param $clientId
     * @param $clientSecret
     */
    public function __construct($domain, $clientId = '', $clientSecret = '')
    {
        $this->setDomain($domain)
            ->setClientId($clientId)
            ->setClientSecret($clientSecret)
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
     * @return Client
     */
    public function getClientId()
    {
        return $this->clientId;
    }

    /**
     * @param $clientId
     *
     * @return $this
     */
    private function setClientId($clientId)
    {
        $this->clientId = $clientId;

        return $this;
    }

    /**
     * @return Client
     */
    public function getClientSecret()
    {
        return $this->clientSecret;
    }

    /**
     * @param $clientSecret
     *
     * @return $this
     */
    private function setClientSecret($clientSecret)
    {
        $this->clientSecret = $clientSecret;

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
     * @return Grant
     */
    public function getGrantType()
    {
        return $this->grantType;
    }

    /**
     * @param Grant $grantType
     */
    public function setGrantType($grantType)
    {
        $this->grantType = $grantType;
    }

    public function get(HTTPRequest $request)
    {
        try {
            $request->setBasePath($this->getDomain());
            $data = [
                'headers' => [
                    'Authorization' => 'Bearer ' . $request->getToken(),
                ],
            ];
            $response = $this->getHttpClient()
                ->get($request->getFormatEndPoint(), $data);
            $httpResponse = new HTTPResponse($response);

            return $httpResponse;
        } catch (RequestException $e) {
            return $this->handleErrorsResponse($e);
        }
    }

    public function post(HTTPRequest $request)
    {
        // TODO: Implement post() method.
    }

    public function put(HTTPRequest $request)
    {
        // TODO: Implement put() method.
    }

    public function delete(HTTPRequest $request)
    {
        // TODO: Implement delete() method.
    }

    /**
     * @param HTTPRequest $request
     *
     * @return HTTPResponse $response
     */
    public function getToken(HTTPRequest $request)
    {
        $request->setBasePath($this->getDomain());
        $result = $this->getHttpClient()
            ->post(
                $request->getFormatEndPoint(),
                [
                    'form_params' =>
                        [
                            'client_id'     => $this->getClientId(),
                            'client_secret' => $this->getClientSecret(),
                            'grant_type'    => $this->getGrantType(),
                        ],
                ]
            );

        return new HTTPResponse($result);
    }

    /**
     * @param RequestException $e
     *
     * @return HTTPResponse
     */
    private function handleErrorsResponse(RequestException $e)
    {
        if ($e->hasResponse()) {
            $httpResponse = new HTTPResponse($e);
            $httpResponse->setStatusCode($e->getCode());

            return $httpResponse;
        } else {
            throw $e;
        }
    }

}
