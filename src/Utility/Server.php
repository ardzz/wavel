<?php


namespace Ardzz\Wavel\Utility;



use Ardzz\Wavel\Cores\Exception\WavelError;
use Ardzz\Wavel\Cores\Exception\WavelHostIsEmpty;
use Ardzz\Wavel\Cores\Handler\Output;
use Ardzz\Wavel\Cores\Http\RequestTrait;

/**
 * Class Server
 * @package Ardzz\Wavel\Utility
 */
class Server
{
    use RequestTrait;

    /**
     * @return Output
     * @throws WavelError
     * @throws WavelHostIsEmpty
     */
    function getBatteryLevel(): Output
    {
        return $this->process('getBatteryLevel');
    }

    /**
     * @return Output
     * @throws WavelError
     * @throws WavelHostIsEmpty
     */
    function getHostNumber(): Output
    {
        return $this->process('getHostNumber');
    }

    /**
     * @return Output
     * @throws WavelError
     * @throws WavelHostIsEmpty
     */
    function getConfig(): Output
    {
        return $this->process('getConfig');
    }

    /**
     * @return Output
     * @throws WavelError
     * @throws WavelHostIsEmpty
     */
    function getConnectionState(): Output
    {
        return $this->process('getConnectionState');
    }

    /**
     * @return Output
     * @throws WavelError
     * @throws WavelHostIsEmpty
     */
    function isConnected(): Output
    {
        return $this->process('isConnected');
    }

    /**
     * @return Output
     * @throws WavelError
     * @throws WavelHostIsEmpty
     */
    function healthCheck(): Output
    {
        return $this->process('healthCheck');
    }

    /**
     * @return Output
     * @throws WavelError
     * @throws WavelHostIsEmpty
     */
    function getWAVersion(): Output
    {
        return $this->process('getWAVersion');
    }
}
