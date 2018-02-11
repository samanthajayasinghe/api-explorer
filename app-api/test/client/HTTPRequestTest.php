<?php
/**
 * @author Samantha Jayasinghe
 *
 * Http Request Test
 */

namespace Tests\Client;

use \PHPUnit_Framework_TestCase;
use \QuickBook\Client\HTTPRequest;

class HTTPRequestTest extends PHPUnit_Framework_TestCase
{

    public function testGetEndPoint()
    {
        $request = new HTTPRequest('account/', array());
        $this->assertEquals('account/', $request->getEndPoint());
    }

    public function testGetParameters()
    {
        $request = new HTTPRequest('account/', array('id' => '123456'));
        $this->assertEquals('123456', $request->getParams()['id']);
    }
}
