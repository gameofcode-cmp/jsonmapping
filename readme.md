
  Using this dummy data and layout as a guide, modfy the following.
  Add code to the following two methods:
  
  1. App\HotelsMap\Hotels\Parsers\JsonFeed.ParseData() - Write a process to analyse the JSON data and parse it into a series
     of room names. For each room name find and create an array of rates using the inclusive.billable_currency.value
     value.  Add these to the array using the Feed.AddRoom() method.
  
  2. App\HotelMap\Hotels\Parsers\Feed.SortRooms() - Write a process to take the array of rooms and sort the rates in ascending order before printing out.
  
  The expected output is:
  
  Apartment, 1 Bedroom - 1067.21
  Apartment, 1 Bedroom - 1067.21, 1283.22
  Family Room - 974.05, 1067.21, 1283.22
  Family Room - 974.05, 1067.21, 1184.05, 1283.22
  Family Room, Terrace - 974.05, 1058.75, 1067.21, 1184.05, 1283.22
  Family Room, Terrace - 974.05, 1058.75, 1067.21, 1184.05, 1268.75, 1283.22
  
  You can run the test by running the following command:
  
  If you have PHP installed locally: php runner.php
  To run via docker: make test
 