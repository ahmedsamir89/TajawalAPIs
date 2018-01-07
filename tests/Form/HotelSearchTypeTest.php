<?php


use App\Form\HotelSearchType;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class HotelSearchTypeTest extends KernelTestCase
{
    /** @var \Symfony\Component\Form\FormFactory $formFactory */
    private $formFactory;

    public function setUp()
    {
        static::bootKernel();
        $kernel = static::$kernel;
        $this->formFactory = $kernel->getContainer()->get('form.factory');
    }

    public function testSubmitWithName()
    {
        $searchForm = $this->formFactory->create(HotelSearchType::class);
        $searchForm->submit([
            'name' => 'test'
        ]);
        $this->assertTrue($searchForm->isValid());
    }

    public function testSubmitWithCity()
    {
        $searchForm = $this->formFactory->create(HotelSearchType::class);
        $searchForm->submit([
            'city' => 'test'
        ]);
        $this->assertTrue($searchForm->isValid());
    }


    public function testSubmitWithValidPrice()
    {
        $searchForm = $this->formFactory->create(HotelSearchType::class);
        $searchForm->submit([
            'price_from' => 12,
            'price_to' => 13,
        ]);
        $this->assertTrue($searchForm->isValid());
    }



    public function testSubmitWithNotValidPrice()
    {
        $searchForm = $this->formFactory->create(HotelSearchType::class);
        $searchForm->submit([
            'price_from' => 'sss',
            'price_to' => 'ss',
        ]);
        $this->assertNotTrue($searchForm->isValid());
    }


    public function testSubmitWithValidAvailability()
    {
        $searchForm = $this->formFactory->create(HotelSearchType::class);
        $searchForm->submit([
            'available_from' => '12-10-2020',
            'available_to' => '20-10-2020',
        ]);
        $this->assertTrue($searchForm->isValid());
    }

    public function testSubmitWithNotValidAvailability()
    {
        $searchForm = $this->formFactory->create(HotelSearchType::class);
        $searchForm->submit([
            'available_from' => 'ssssd',
            'available_to' => 'sdsad',
        ]);
        $this->assertNotTrue($searchForm->isValid());
    }

}