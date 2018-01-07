<?php

namespace App\Service;
use App\Model\Hotel;
use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Criteria;

class HotelService
{

    /** @var ArrayCollection $hotels  */
    private $hotels;

    /** @var Criteria $criteria */
    private $criteria;

    private $sortOptions = ['name', 'price'];
    /**
     * @var HotelMapper
     */
    private $hotelMapper;

    /**
     * HotelService constructor.
     * @param HotelMapper $hotelMapper
     */
    public function __construct(HotelMapper $hotelMapper)
    {
        $this->hotelMapper = $hotelMapper;
        $this->hotels = $hotelMapper->getHotels();
    }


    /**
     * @param array $options
     * @return array
     */
    public function search(array $options)
    {

        $this->criteria = Criteria::create();

        if(!empty($options['available_from']) && !empty($options['available_to'])) {
            $this->searchByAvailability($options['available_from'], $options['available_to']);
        }

        if(!empty($options['name'])) {
            $this->searchByName($options['name']);
        }

        if(!empty($options['city'])) {
            $this->searchByCity($options['city']);
        }

        if(!empty($options['price_from']) && !empty($options['price_to'])) {
            $this->searchByPriceRange($options['price_from'], $options['price_to']);
        }

        if(!empty($options['sort_by'])) {
            $this->sortBy($options['sort_by']);
        }

        $result = $this->hotels->matching($this->criteria);
        return $this->hotelMapper->convertCollectionToArray($result);
    }

    /**
     * @return ArrayCollection
     */
    public function getHotels(): ArrayCollection
    {
        return $this->hotels;
    }

    /**
     * @param string $name
     */
    private function searchByName(string $name)
    {
        $expr = Criteria::expr()->eq('name', $name);
        $this->criteria->andWhere($expr);
    }

    /**
     * @param string $city
     */
    private function searchByCity(string $city)
    {
        $expr = Criteria::expr()->eq('city', $city);
        $this->criteria->andWhere($expr);
    }

    /**
     * @param float $from
     * @param float $to
     */
    private function searchByPriceRange(float $from, float $to)
    {
        $expr1 = Criteria::expr()->gte('price', $from);
        $expr2 = Criteria::expr()->lte('price', $to);
        $this->criteria->andWhere($expr1)->andWhere($expr2);
    }

    /**
     * @param DateTime $from
     * @param DateTime $to
     */
    private function searchByAvailability(DateTime $from, DateTime $to)
    {
        $this->hotels = $this->getHotels()->filter(function (Hotel $hotel) use ($from, $to) {

            $from = $from->getTimestamp();
            $to = $to->getTimestamp();

            foreach ($hotel->getAvailability() as $availability) {
                $hotelAvailableFrom = strtotime($availability['from']);
                $hotelAvailableTo = strtotime($availability['to']);

                if ($from > $to) {
                    return null;
                }

                if ($from >= $hotelAvailableFrom && $from < $hotelAvailableTo
                    && $to > $hotelAvailableFrom && $to <= $hotelAvailableTo) {
                    return $hotel;
                }
            }

            return null;
        });
    }

    /**
     * @param string $sortBy
     */
    private function sortBy(string $sortBy)
    {
        if(in_array($sortBy, $this->sortOptions)) {
            $this->criteria->orderBy([$sortBy => Criteria::DESC]);
        }
    }


    /**
     * @param ArrayCollection $hotels
     */
    public function setHotels(ArrayCollection $hotels)
    {
        $this->hotels = $hotels;
    }


}