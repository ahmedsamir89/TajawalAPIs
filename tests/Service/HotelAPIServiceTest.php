<?php

namespace App\Tests\Service;


use App\Service\HotelAPIService;
use Symfony\Bundle\FrameworkBundle\Tests\TestCase;

class HotelAPIServiceTest extends TestCase
{
    /** @var HotelAPIService $hotelAPIService */
    private $hotelAPIService;
    private $hotelAPIServiceReflection;

    protected function setUp()
    {
        $this->hotelAPIService = new HotelAPIService();
        $this->hotelAPIServiceReflection = new \ReflectionClass(HotelAPIService::class);
    }

    public function testGetURL()
    {
        $method = $this->hotelAPIServiceReflection->getMethod('getURL');
        $method->setAccessible(true);
        $url = $method->invokeArgs($this->hotelAPIService, []);
        $this->assertEquals($url, 'https://api.myjson.com/bins/tl0bp');
    }

    public function testResponse()
    {
        $response = $this->hotelAPIService->getResponseAsJSON();
        $this->assertJson($response);
    }
}