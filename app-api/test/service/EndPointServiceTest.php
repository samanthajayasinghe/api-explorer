<?php

/**
 * @author Samantha Jayasinghe
 *
 * End Point Service Test
 */

namespace Tests\Service;

use \PHPUnit_Framework_TestCase;
use APIExplorer\Service\EndPointService;

class EndPointServiceTest extends PHPUnit_Framework_TestCase
{
    public function testGetEndPoints() {
        $endPointService = new EndPointService();
        $result = $endPointService->getEndPoints();
        $this->assertArrayHasKey('endpoint',$result[0]);
        $this->assertArrayHasKey('name',$result[0]);
    }
}
