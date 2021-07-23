<?php


namespace Ardzz\Wavel\Utility;


use Ardzz\Wavel\Cores\Exception\WavelError;
use Ardzz\Wavel\Cores\Exception\WavelHostIsEmpty;
use Ardzz\Wavel\Cores\Format;
use Ardzz\Wavel\Cores\Handler\Output;
use Ardzz\Wavel\Cores\Http\RequestTrait;

/**
 * Class User
 * @package Ardzz\Wavel\Utility
 */
class User
{
    use RequestTrait;

    /**
     * @param string $newStatus
     * @return Output
     * @throws WavelError
     * @throws WavelHostIsEmpty
     */
    function setMyStatus(string $newStatus): Output
    {
        return $this->process('setMyStatus', [
            'newStatus' => $newStatus
        ]);
    }

    /**
     * @param string $newName
     * @return Output
     * @throws WavelError
     * @throws WavelHostIsEmpty
     */
    function setMyName(string $newName): Output
    {
        return $this->process('setMyName', [
            'newName' => $newName
        ]);
    }

    /**
     * @param string $filename
     * @return Output
     * @throws WavelError
     * @throws WavelHostIsEmpty
     */
    function setProfilePic(string $filename): Output
    {
        return $this->process('setProfilePic', [
            'data' => Format::image($filename)
        ]);
    }

    /**
     * @return Output
     * @throws WavelError
     * @throws WavelHostIsEmpty
     */
    function getMe(): Output
    {
        return $this->process('getMe');
    }

}
