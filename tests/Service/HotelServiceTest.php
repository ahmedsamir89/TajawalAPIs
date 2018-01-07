<?php

namespace App\Service;
use App\Model\Hotel;
use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Criteria;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class HotelServiceTest extends WebTestCase
{
    /** @var HotelService $hotelService */
    private $hotelService;

    public function setUp()
    {
        static::bootKernel();
        $kernel = static::$kernel;
        $this->hotelService = $kernel->getContainer()->get('app.service.hotel');
    }

    public function testSearchByName()
    {
        $this->mockObjects();
        $hotels = $this->hotelService->search(['name' => 'Star']);
        $this->assertEquals($hotels[0]['name'], 'Star');
    }

    public function testSearchByPrice()
    {
        $this->mockObjects();
        $hotels = $this->hotelService->search(['price_from' => 49, 'price_to' => 52]);
        $this->assertEquals($hotels[0]['name'], 'Star');
    }


    private function mockObjects()
    {
        $hotels = new ArrayCollection();
        $hotel = new Hotel();
        $hotel->setName('Grand Hyatt');
        $hotel->setPrice(20);
        $hotel->setCity('Sharm');
        $hotel->setAvailability([
            [
                'from' => '10-10-2020',
                'to' => '15-10-2020'
            ],
            [
                'from' => '25-10-2020',
                'to' => '15-11-2020'
            ],[
                'from' => '10-12-2020',
                'to' => '15-12-2020'
            ],
        ]);
        $hotels->add($hotel);

        $hotel = new Hotel();
        $hotel->setName('Star');
        $hotel->setPrice(50);
        $hotel->setCity('Vienna');
        $hotel->setAvailability([
            [
                'from' => '10-10-2020',
                'to' => '15-10-2020'
            ],
            [
                'from' => '25-10-2020',
                'to' => '15-11-2020'
            ],[
                'from' => '10-12-2020',
                'to' => '15-12-2020'
            ],
        ]);
        $hotels->add($hotel);

        $this->hotelService->setHotels($hotels);
    }

}