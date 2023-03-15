<?php
namespace App\HotelMap\Utility\Mongo;
use MongoDB;

class Import
{
    private $client;
    /**
     * Initialise a mongo db with initial data
     *
     */
    public function importData(array $data) :bool
    {
        try {
            $this->client = new MongoDB\Client('mongodb://mongodb:27017');

            if ($this->exists()) return true;
            $collection = $this->client->hotelMap->rooms;
            $result = $collection->insertMany($data);

            return true;
        }
        catch (MongoDB\Driver\Exception\ConnectionTimeoutException $e) {
            return false;
        }
        return false;
    }

    private function exists(string $collectionName = 'rooms') : bool {
        $collectionList = $this->client->hotelMap->listCollectionNames();
        if (in_array($collectionName, iterator_to_array($collectionList))) {
            //echo 'db created already';
            return true;
        }
        return false;
    }
}
