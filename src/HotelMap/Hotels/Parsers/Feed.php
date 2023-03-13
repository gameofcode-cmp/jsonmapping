<?php
namespace App\HotelMap\Hotels\Parsers;

class Feed
{
    public $data = '';
    public $feedOfRooms = [];

    /**
     * Load in the feed data.
     *
     * @param string $source
     * @return void
     */
    public function loadFeed(string $source)
    {
        if (!file_exists($source)) {
            throw new \Exception("File does not exist");
        }

        $this->data = file_get_contents($source);
    }

    /**
     * Sort the room rates in ascending order.
     *
     * @return void
     */
    public function sortRooms()
    {
        if (empty($this->feedOfRooms)) {
            throw new \Exception("No rooms to sort");
        }

        // Sort feedOfRooms.  Ensure that the rates element are sorted in ascending order.
        
    }

    /**
     * Add a new room with room name and array of rates
     *
     * @param string $roomName
     * @param array $rates
     * @return void
     */
    public function addRoom(string $roomName, array $rates)
    {
        if (empty($roomName) || empty($rates)) {
            throw new \Exception("Room name and rates are required");
        }
        $this->feedOfRooms[] = [
            "room_name" => $roomName,
            "rates" => $rates
        ];
    }

    /**
     * Return an array of rooms, sorted in ascending order.
     *
     * @return array
     */
    public function getFeedOfRooms(): array
    {
        $this->sortRooms();
        return $this->feedOfRooms;
    }
}