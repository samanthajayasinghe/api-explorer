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

    /**
     * @var Client
     */
    private $httpClient = null;

    public function setUp()
    {
        $this->httpClient = new Client('https://httpbin.org/');
    }

    public function testHTTPGetWithoutAuthorization() {

        $response = $this->httpClient->get(new HTTPRequest('get', array()));
        $this->assertEquals(200, $response->getStatusCode());
    }

    /**
     * @expectedException     Exception
     */
    public function testPost(){
        $this->httpClient->post(new HTTPRequest('post', array()));
    }

    /**
     * @expectedException     Exception
     */
    public function testPut(){
        $this->httpClient->put(new HTTPRequest('put', array()));
    }

    /**
     * @expectedException     Exception
     */
    public function testDelete(){
        $this->httpClient->delete(new HTTPRequest('delete', array()));
    }
}
