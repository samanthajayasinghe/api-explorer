<?php

namespace Tests\Adapter\QuickBook;

use APIExplorer\Adapter\QuickBook\Adapter;
use APIExplorer\Client\Client;
use \PHPUnit_Framework_TestCase;
use APIExplorer\Client\HTTPRequest;
use GuzzleHttp\Psr7;
use GuzzleHttp\Psr7\Response;

class QuickBookAdapterTest extends PHPUnit_Framework_TestCase
{

    /**
     * @var Adapter
     */
    private $quickBookAdapter = null;

    public function setUp()
    {
        $this->quickBookAdapter = new Adapter();
        $this->quickBookAdapter->setConfig($this->getConfig());
    }

    public function testFormatHTTPRequest()
    {
        $httpRequest = new HTTPRequest(
            '/company/:companyId/entity/:entityId',
            [['name' => 'companyId', 'value' => '123456'], ['name' => 'entityId', 'value' => '1']]
        );
        $formatHttpRequest = $this->quickBookAdapter->formatHTTPRequest($httpRequest);
        $this->assertEquals('/company/123456/entity/1', $formatHttpRequest->getEndPoint());
    }

    public function testGetHttpClient() {
        $this->quickBookAdapter->setHttpClient(new Client('https://httpbin.org/'));
        $this->assertInstanceOf('APIExplorer\Client\Client', $this->quickBookAdapter->getHttpClient());
    }

    public function testGetAuthProvider()
    {
        $authUrl = $this->quickBookAdapter->getAuthorizationUrl();
        $this->assertContains('https://appcenter.intuit.com/connect/oauth2', $authUrl);
    }

    public function testExecuteHTTPRequest()
    {
        $stream = Psr7\stream_for(json_encode(['id'=>1,'name'=>'samantha']));
        $response = new Response(200, ['Content-Type' => 'application/json'], $stream);

        $adapterStub = $this->getMockBuilder('APIExplorer\Adapter\QuickBook\Adapter')
                                ->getMock();
        $adapterStub->method('executeHTTPRequest')
                ->willReturn($response);

        $result = $adapterStub->executeHTTPRequest(new HTTPRequest('/account',[]));
        $this->assertEquals(200, $result->getStatusCode());
    }

    public function testExecuteHTTPRequestForInvalidHost()
    {
        $this->quickBookAdapter->setHttpClient(new Client('https://httpbin.org/'));
        $result = $this->quickBookAdapter->executeHTTPRequest(new HTTPRequest('get',[]));
        $this->assertEquals(404, $result->getStatusCode());
    }
    public function testGetAccessToken()
    {
        $adapterStub = $this->getMockBuilder('APIExplorer\Adapter\QuickBook\Adapter')
            ->getMock();
        $adapterStub->method('getAccessToken')
            ->willReturn(['token'=>'asdg36158635dgad']);

        $token = $adapterStub->getAccessToken('authorization_code',[]);

        $this->assertEquals('asdg36158635dgad', $token['token']);
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
}
