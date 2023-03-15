<?php
namespace App\HotelMap\Utility\Mongo;
use MongoDB;

class Query
{
    private $client;
    /**
     * Initialise a mongo db with initial data
     *
     */
    private function connect() : bool{
        try {
            $this->client = new MongoDB\Client('mongodb://mongodb:27017');
            return true;
        }
        catch (MongoDB\Driver\Exception\ConnectionTimeoutException $e) {
            return false;
        }
        return false;
    }

    public function getRoomRates (string $room = 'Apartment, 1 Bedroom') : array{

        $this->connect();

        $pipeline = [
            ['$unwind' => '$rooms'],
            ['$match' => ['rooms.room_name' => $room]],
            ['$unwind' => '$rooms.rates'],
            ['$addFields' => ['RoomTotal' => ['$round' => [['$toDouble' => '$rooms.rates.occupancy_pricing.2-9,9.totals.inclusive.billable_currency.value'], 2]]]],
            ['$sort' => ['RoomTotal' => 1]],
            ['$project' => [
                '_id' => 0,
                'value' => '$RoomTotal'
            ]]
        ];

        $results = $this->client->hotelMap->rooms->aggregate($pipeline);


        $values = [];
        foreach ($results as $result) {
            $values[] = $result['value'];
        }

        return $values;
    }

    public function getAllRoomRates () : array{

        $this->connect();

        $pipeline = [
            ['$unwind' => '$rooms'],
            ['$unwind' => '$rooms.rates'],
            ['$addFields' => ['RoomTotal' => ['$round' => [['$toDouble' => '$rooms.rates.occupancy_pricing.2-9,9.totals.inclusive.billable_currency.value'], 2]]]],
            ['$sort' => ['RoomTotal' => 1]],
            ['$project' => [
                '_id' => 0,
                'value' => '$RoomTotal'
            ]]
        ];

        $results = $this->client->hotelMap->rooms->aggregate($pipeline);

        $values = [];
        foreach ($results as $result) {
            $values[] = $result['value'];
        }

        return $values;
    }
}
