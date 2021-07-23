<?php


namespace Ardzz\Wavel\Cores\Handler;


use GuzzleHttp\Exception\BadResponseException;
use GuzzleHttp\Exception\GuzzleException;
use Psr\Http\Message\ResponseInterface;

class Response
{
    static ResponseInterface $ResponseInterface;
    static function create(callable $callback): string
    {
        try {
            self::$ResponseInterface = $callback();
            return self::getResponseInterface()->getBody()->getContents();
        }
        catch (BadResponseException $throwable){
            return $throwable->getResponse()->getBody()->getContents();
        }
        catch (GuzzleException $exception){
            return $exception->getMessage();
        }
    }

    static function getResponseInterface(): ResponseInterface
    {
        return self::$ResponseInterface;
    }
}
