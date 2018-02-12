<?php
/**
 * @author Samantha Jayasinghe
 *
 * Http Request Test
 */

namespace Tests\Client;

use \PHPUnit_Framework_TestCase;
use QuickBook\Client\Client;
use QuickBook\Client\HTTPRequest;

class ClientTest extends PHPUnit_Framework_TestCase
{

    public function testHTTPGetWithoutAuthorization() {
        $client   = new Client('https://httpbin.org/');
        $response = $client->get(new HTTPRequest('get', array()));
        $this->assertEquals(200, $response->getStatusCode());
    }

    public function testGetToken() {
        $result = $this->getToken();
        $this->assertEquals('bearer', $result['token_type']);
        $this->assertNotEmpty($result['access_token']);

    }

    private function getToken() {
        $client   = new Client(
            'https://oauth.platform.intuit.com/oauth2/',
            'Q0b8xrCz7fqmieyDzVBoTn3aloTMzfjn8K9ixLG9ZitmV7Z7LP',
            'urP4N4ZOgSClOq862FYkiybmf1UrgcCDoINcf7Hl'
        );
        $httpRequest = new HTTPRequest('tokens/bearer', array());
        $httpRequest->setApiVersion('v1');

        $response = $client->getToken($httpRequest);
        return $response->getResult();
    }
}
