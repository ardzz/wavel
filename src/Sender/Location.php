<?php


namespace Ardzz\Wavel\Sender;


use Ardzz\Wavel\Cores\Exception\WavelError;
use Ardzz\Wavel\Cores\Exception\WavelHostIsEmpty;
use Ardzz\Wavel\Cores\Format;
use Ardzz\Wavel\Cores\Handler\Output;
use Ardzz\Wavel\Cores\Http\RequestTrait;

class Location
{
    use RequestTrait;

    /**
     * @param Int $latitude Latitude coordinate
     * @param Int $longitude Longitude coordinate
     * @param String $locationName Location name
     * @param Int $receiverNumber Receiver number
     * @return Output
     * @throws WavelError
     * @throws WavelHostIsEmpty
     */
    function location(Int $latitude, Int $longitude, String $locationName, Int $receiverNumber): Output
    {
        return $this->process('sendLocation', [
            'to' => Format::number($receiverNumber),
            'lat' => $latitude,
            'lng' => $longitude,
            'loc' => $locationName
        ]);
    }
}
