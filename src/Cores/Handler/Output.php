<?php


namespace Ardzz\Wavel\Cores\Handler;

use Ardzz\Wavel\Cores\Exception\WavelError;
use Psr\Http\Message\ResponseInterface;

/**
 * Class Output
 * @package Ardzz\Wavel\Cores\Handler
 */
class Output
{
    /**
     * @param string $response Response request from Openwa server
     * @throws WavelError
     */
    public function __construct(private string $response)
    {
        $this->response = json_decode($response, true);
        if (!is_null($this->getErrorMessage())){
            if ($this->getErrorMessage() == 'unauthorised'){
                throw new WavelError('Api Key is invalid, error: ' . $this->getErrorMessage());
            }
            elseif ($this->isConnectionError()){
                throw new WavelError($this->getErrorMessage());
            }
        }
    }

    /**
     * Check connection to openwa server is error or not
     * @return bool
     */
    private function isConnectionError(): bool
    {
        return is_null($this->getResponse());
    }

    /**
     * Get response
     * @return mixed
     */
    private function getResponse()
    {
        return $this->response;
    }

    /**
     * Get response body
     * @return mixed|null
     */
    function getResponseBody(){
        return $this->hasResponse() ? $this->getResponse()["response"] : null;
    }

    /**
     * @return bool
     */
    function isSuccess(): bool
    {
        return (
            $this->isJsonValid() &&
            !$this->hasError()   &&

                $this->hasResponse() &&
                $this->getResponseBody() !== false &&

            !$this->isConnectionError()
        );
    }

    /**
     * @param String $key
     * @return bool
     */
    private function keyExist(String $key): bool
    {
        if (!$this->isConnectionError()){
            return array_key_exists($key, $this->getResponse());
        }else{
            return false;
        }
    }

    /**
     * @return bool
     */
    function hasError(): bool
    {
        return $this->keyExist("error");
    }

    /**
     * @return mixed|string|null
     */
    function getErrorMessage(){

        if ($this->isJsonValid()){
            return "invalid data json, " . json_last_error_msg();
        }
        elseif($this->isConnectionError()){
            return "connection error, openwa server might be offline";
        }
        elseif ($this->hasError()){
            return !is_array( $this->getResponse()["error"] ) ? $this->getResponse()['error'] : $this->getResponse()['error']['message'];
        }else{
            return null;
        }
    }

    /**
     * @return bool
     */
    private function isJsonValid(): bool
    {
        return !json_last_error() && $this->hasResponse();
    }

    /**
     * @return bool
     */
    private function hasResponse(): bool
    {
        return $this->keyExist("response");
    }
}
