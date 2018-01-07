<?php

namespace App\Service;


use Doctrine\Common\Collections\ArrayCollection;
use JMS\Serializer\Annotation as Serializer;
use JMS\Serializer\SerializerBuilder;

class HotelMapper
{

    /**
     * @var ArrayCollection
     * @Serializer\SerializedName("hotels")
     * @Serializer\Type(name="ArrayCollection<App\Model\Hotel>")
     */
    private $hotels;
    /** @var Serializer $serializer */
    private $serializer;

    public function __construct(HotelAPIService $hotelAPI)
    {
        $jsonResponse = $hotelAPI->getResponseAsJSON();
        $this->serializer  = SerializerBuilder::create()->build();
        $this->hotels = $this->serializer->deserialize($jsonResponse, HotelMapper::class, 'json')->hotels;
    }

    /**
     * @return ArrayCollection
     */
    public function getHotels(): ArrayCollection
    {
        return $this->hotels;
    }

    /**
     * @param ArrayCollection $collection
     * @return mixed|string
     */
    public function convertCollectionToArray(ArrayCollection $collection)
    {
        return array_values(json_decode($this->serializer->serialize($collection, 'json'), true));
    }
}