<?php
/**
 * @author Samantha Jayasinghe
 *
 * API Service Test
 */

namespace Tests\Service;

use APIExplorer\Adapter\QuickBook\Adapter as QuickBookAdapter;
use APIExplorer\Service\APIService;
use \PHPUnit_Framework_TestCase;

class APiServiceTest extends PHPUnit_Framework_TestCase
{

    /**
     * @var APIService
     */
    private $apiService = null;

    public function setUp()
    {
        $this->apiService = new APIService();
        $quickBookAdapter = new QuickBookAdapter();
        $quickBookAdapter->setConfig($this->getConfig());
        $this->apiService->setApiAdapter($quickBookAdapter);
    }

    public function testGetAuthorizationUrl()
    {

        $result = $this->apiService->getApiAdapter()->getAuthorizationUrl();
        $this->assertContains('scope=com.intuit.quickbooks.accounting&response_type=code', $result);
    }

    private function getConfig()
    {
        $config = new \stdClass();
        $config->clientId = '';
        $config->clientSecret = '';
        $config->redirectUri = 'http://cl-tech.local/app-api/public/index.php/callback';
        $config->urlAuthorize = 'https://appcenter.intuit.com/connect/oauth2';
        $config->urlAccessToken = 'https://oauth.platform.intuit.com/oauth2/v1/tokens/bearer';
        $config->scopes = ['com.intuit.quickbooks.accounting'];

        return $config;
    }

    public function testGetAllEndPoints()
    {

        $result = $this->apiService->getAllEndPoints();
        $this->assertArrayHasKey('endpoint', $result[0]);
        $this->assertArrayHasKey('name', $result[0]);
    }
}
