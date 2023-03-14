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
        $data = json_decode($this->data, true);

        //get all room name variations
        //$room_names = array_column($data[0]['rooms'], 'room_name');

        //get all rates
        foreach ($data as $property) {
            foreach ($property['rooms'] as $room) {
                $rates = [];
                foreach ($room['rates'] as $rate) {
                    $rates[] = $rate['occupancy_pricing']['2-9,9']['totals']['inclusive']['billable_currency']['value'];
                }
                $this->addRoom($room['room_name'], $rates);
            }
        }

    }
}
