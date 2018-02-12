<?php
/**
 * @author Samantha Jayasinghe
 *
 * Http Request Test
 */

namespace Tests\Client;

use \PHPUnit_Framework_TestCase;
use APIExplorer\Client\Client;
use APIExplorer\Client\HTTPRequest;

class ClientTest extends PHPUnit_Framework_TestCase
{

    public function testHTTPGetWithoutAuthorization() {
        $client   = new Client('https://httpbin.org/');
        $response = $client->get(new HTTPRequest('get', array()));
        $this->assertEquals(200, $response->getStatusCode());
    }
}
