<?php


namespace Ardzz\Wavel\Cores\Handler;

use Ardzz\Wavel\Cores\Exception\WavelError;
use Psr\Http\Message\ResponseInterface;

class Output
{
    private mixed $response;

    /**
     * @throws WavelError
     */
    public function __construct($response)
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

    private function isConnectionError(): bool
    {
        return is_null($this->getResponse());
    }

    private function getResponse()
    {
        return $this->response;
    }

    function getResponseBody(){
        return $this->hasResponse() ? $this->getResponse()["response"] : null;
    }

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

    private function keyExist(String $key): bool
    {
        if (!$this->isConnectionError()){
            return array_key_exists($key, $this->getResponse());
        }else{
            return false;
        }
    }

    function hasError(): bool
    {
        return $this->keyExist("error");
    }

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

    private function isJsonValid(): bool
    {
        return !json_last_error() && $this->hasResponse();
    }

    private function hasResponse(): bool
    {
        return $this->keyExist("response");
    }
}
