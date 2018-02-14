<?php


namespace Tests\Adapter\QuickBook;

use APIExplorer\Adapter\QuickBook\Adapter;
use \PHPUnit_Framework_TestCase;
use APIExplorer\Client\HTTPRequest;

class QuickBookAdapterTest extends PHPUnit_Framework_TestCase
{

    /**
     * @var Adapter
     */
    private $quickBookAdapter = null;

    public function setUp()
    {
        $this->quickBookAdapter = new Adapter();
    }

    public function testFormatHTTPRequest() {
        $httpRequest = new HTTPRequest(
            '/company/:companyId/entity/:entityId',
            [['name'=>'companyId','value'=>'123456'],['name'=>'entityId','value'=>'1']]
        );
        $formatHttpRequest = $this->quickBookAdapter->formatHTTPRequest($httpRequest);
        $this->assertEquals('/company/123456/entity/1',$formatHttpRequest->getEndPoint());
    }

}
