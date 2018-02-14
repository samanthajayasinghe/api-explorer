<?php

/**
 * @author Samantha Jayasinghe
 *
 * Adapter interface
 */

namespace APIExplorer\Adapter;
use APIExplorer\Client\HTTPRequest;
use APIExplorer\Client\HTTPResponse;

interface IAdapter
{

    /**
     * @return get Access token
     */
    public function getAuthorizationUrl();

    /**
     * @param HTTPRequest $request
     * @param string      $httpMethod
     *
     * @return HTTPResponse
     */
    public function executeHTTPRequest(HTTPRequest $request, $httpMethod ='get');

    /**
     * @param $type
     * @param $params
     *
     * @return mixed
     */
    public function getAccessToken($type, $params=array());
}
