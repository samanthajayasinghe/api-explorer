<?php
/**
 * @author Samantha Jayasinghe
 *
 * API Service
 */

namespace APIExplorer\Service;

use APIExplorer\Client\HTTPRequest;
use APIExplorer\Adapter\IAdapter;

class APIService
{

    /**
     * @var IAdapter
     */
    public $apiAdapter = null;

    /**
     * @return IAdapter
     */
    public function getApiAdapter()
    {
        return $this->apiAdapter;
    }

    /**
     * @param IAdapter $apiAdapter
     */
    public function setApiAdapter(IAdapter $apiAdapter)
    {
        $this->apiAdapter = $apiAdapter;
    }

    /**
     * @param HTTPRequest $request
     * @param string      $httpMethod
     *
     * @return \APIExplorer\Client\HTTPResponse
     */
    public function executeHTTPRequest(HTTPRequest $request, $httpMethod ='get'){
        return $this->getApiAdapter()->executeHTTPRequest($request, $httpMethod);
    }

}
