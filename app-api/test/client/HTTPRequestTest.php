<?php
/**
 * @author Samantha Jayasinghe
 *
 * Http Request Test
 */

namespace Tests\Client;

use \PHPUnit_Framework_TestCase;
use \APIExplorer\Client\HTTPRequest;

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

    public function testGetFormatEndPoint()
    {
        $request = new HTTPRequest('account', array());
        $request->setBasePath('http://api.dev/');
        $this->assertEquals('http://api.dev/account', $request->getFormatEndPoint());
    }

    public function testGetApiVersion()
    {
        $request = new HTTPRequest('/account', array());
        $request->setBasePath('http://api.dev/');
        $request->setApiVersion('v2');
        $this->assertEquals('http://api.dev/v2/account', $request->getFormatEndPoint());
    }
}
