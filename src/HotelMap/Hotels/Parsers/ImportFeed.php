<?php
namespace App\HotelMap\Hotels\Parsers;

use App\HotelMap\Hotels\Parsers\Feed;
use App\HotelMap\Hotels\Parsers\FeedInterface;
use MongoDB;

class ImportFeed extends Feed implements FeedInterface
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
        //    $data = json_decode($this->data, true);

// Recursive function to get all keys and values from a nested array
        function get_array_keys_and_values_recursive($array, &$result, $parent_key = null) {
            foreach ($array as $key => $value) {
                $nested_key = $parent_key ? "{$parent_key}.{$key}" : $key;
                $result[$nested_key] = $value;
                if (is_array($value)) {
                    get_array_keys_and_values_recursive($value, $result, $nested_key);
                }
            }
        }

// Decode JSON data dump into an associative array
        $data = json_decode($this->data, true, 512, JSON_OBJECT_AS_ARRAY);

// Get array of keys and values representing the structure of the JSON data dump
        $result = [];
        get_array_keys_and_values_recursive($data, $result);

// Output array of keys and values
        //       print_r($result);

        //   // Connect to MongoDB
        $mongoClient = new MongoDB\Client('mongodb://mongo:27017');

// Select database and collection
        $collection = $mongoClient->myDatabase->myCollection;

// Read JSON data from a file or HTTP request
        //     $jsonData = file_get_contents('path/to/json/file.json');

// Decode JSON data into an associative array
        //      $data = json_decode($jsonData, true);

// Insert JSON data into MongoDB
        $result = $collection->insertMany($data);


        //[['$match' => ['rooms.room_name' => 'Apartment, 1 Bedroom']], ['$unwind' => '$rooms'], ['$match' => ['rooms.room_name' => 'Apartment, 1 Bedroom']], ['$unwind' => '$rooms.rates'], ['$sort' => ['rooms.rates.occupancy_pricing.2-9,9.totals.inclusive.billable_currency.value' => 1]]]

        echo 'dsfsdf';
        foreach ($data as $property) {
            echo 'property:' . $property['property_id']  . '<br />';

            foreach ($property['rooms'] as $room) {
                echo 'room:' . $room['room_name'] . '<br />';

                foreach ($room['rates'] as $rate) {
                    echo 'rate:' . $rate['id'] . '<br />';
                }
            }
            //  print_r($record);

        }
        die();
    }
}
