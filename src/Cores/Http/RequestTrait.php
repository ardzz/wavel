<?php


namespace Ardzz\Wavel\Cores\Http;


use Ardzz\Wavel\Cores\Exception\WavelError;
use Ardzz\Wavel\Cores\Exception\WavelHostIsEmpty;
use Ardzz\Wavel\Cores\Handler\Output;
use Ardzz\Wavel\Cores\Handler\Response;
use Ardzz\Wavel\Cores\Http\Request;

trait RequestTrait
{
    /**
     * @throws WavelHostIsEmpty
     * @throws WavelError
     */
    protected function process(String $endpoint, Array $data = []): Output
    {
        return new Output(Request::create($endpoint, $data));
    }
}
