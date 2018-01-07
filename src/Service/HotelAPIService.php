<?php

namespace App\Service;

/**
 * Class HotelAPI
 * @package App\Service
 */
class HotelAPIService
{

    /**
     * @return string
     */
    private function getURL()
    {
        return "https://api.myjson.com/bins/tl0bp";
    }

    /**
     * @return bool|string
     */
    public function getResponseAsJSON()
    {
        return file_get_contents($this->getURL());
    }


}