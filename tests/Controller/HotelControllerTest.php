<?php

namespace App\Tests;


use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class HotelControllerTest extends WebTestCase
{
    public function testHotelSearch()
    {
        $client = static::createClient();
        $client->request(Request::METHOD_GET, '/api/hotels');
        /** @var Response $response */
        $response = $client->getResponse();
        $this->assertEquals($response->getStatusCode(), Response::HTTP_OK);
        $this->assertTrue($response->headers->contains('Content-Type', 'application/json'));
    }
}