<?php
namespace App\HotelMap\Hotels\Parsers;

use App\HotelMap\Hotels\Parsers\Feed;
use App\HotelMap\Hotels\Parsers\FeedInterface;

class JsonFeed extends Feed implements FeedInterface
{
    /**
     * Parse data into a series of rooms and a series of rates associated with each room.
     * 
     */
    public function parseData()
    {
        // Utilise $this->data to parse the data
        // The data is in JSON format
        // Using the data, parse into a series of rooms with a series of rates 
        // $this->addRoom("double room", [123,654,232]);
        $data = json_decode($this->data, true);
        
    }
}