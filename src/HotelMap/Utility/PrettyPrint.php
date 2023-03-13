<?php
namespace App\HotelMap\Utility;

class PrettyPrint
{
    /**
     * Print out the room array in a readable format.
     * 
     * @param array $roomCollection
     * @return void
     */
    public static function printRoomArray(array $roomCollection)
    {
        if (isset($roomCollection) && empty($roomCollection)) {
            throw new \Exception("No rooms to print");
        }

        foreach ($roomCollection as $room) {
            echo $room['room_name'] . " - " . implode(", ", $room['rates']) . "\n";
        }
    }
}