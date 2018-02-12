<?php
/**
 * @author Samantha Jayasinghe
 *
 * Http Response Test
 */

namespace Tests\Client;

use \PHPUnit_Framework_TestCase;
use \APIExplorer\Client\HTTPResponse;
use GuzzleHttp\Psr7;
use GuzzleHttp\Psr7\Response;

class HTTPResponseTest extends PHPUnit_Framework_TestCase
{
    public function testStatusCode() {
        $response = new HTTPResponse($this->getMockHTTPResponse(['id'=>1,'name'=>'samantha']));
        $this->assertEquals(200, $response->getStatusCode());
    }

    public function testGetResult() {
        $response = new HTTPResponse($this->getMockHTTPResponse(['id'=>1,'name'=>'samantha']));
        $this->assertEquals(['id'=>1,'name'=>'samantha'], $response->getResult());
    }

    private function getMockHTTPResponse($data, $statusCode=200) {
        $stream = Psr7\stream_for(json_encode($data));
        return new Response($statusCode, ['Content-Type' => 'application/json'], $stream);
    }
}
