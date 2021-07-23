<?php


namespace Ardzz\Wavel\Cores\Handler;


use GuzzleHttp\Exception\BadResponseException;
use GuzzleHttp\Exception\GuzzleException;
use Psr\Http\Message\ResponseInterface;

/**
 * Class Response
 * @package Ardzz\Wavel\Cores\Handler
 */
class Response
{
    /**
     * @var ResponseInterface
     */
    static ResponseInterface $ResponseInterface;

    /**
     * @param callable $callback
     * @return string
     */
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

    /**
     * @return ResponseInterface
     */
    static function getResponseInterface(): ResponseInterface
    {
        return self::$ResponseInterface;
    }
}
