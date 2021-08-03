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
     * @param String|Int $latitude Latitude coordinate
     * @param String|Int $longitude Longitude coordinate
     * @param String $locationName Location name
     * @param String|Int $receiverNumber Receiver number
     * @param bool $isGroup
     * @return Output
     * @throws WavelError
     * @throws WavelHostIsEmpty
     */
    function location(String|Int $latitude, String|Int $longitude, String $locationName, String|Int $receiverNumber, bool $isGroup = false): Output
    {
        return $this->process('sendLocation', [
            'to' => Format::number($receiverNumber, $isGroup),
            'lat' => $latitude,
            'lng' => $longitude,
            'loc' => $locationName
        ]);
    }
}
