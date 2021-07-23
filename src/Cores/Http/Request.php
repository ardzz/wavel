<?php


namespace Ardzz\Wavel\Cores\Http;


use Ardzz\Wavel\Cores\Exception\WavelHostIsEmpty;
use GuzzleHttp\Client;
use Ardzz\Wavel\Cores\Handler\Response;

class Request
{
    protected static ?string $host, $proxy, $apiKey = null;

    /**
     * @throws WavelHostIsEmpty
     */
    static function create(String $endpoint, Array $data = []): string
    {
        if(is_null(self::getHost()) === false){
            if (is_null(self::getProxy()) == false){
                if (is_null(self::getApiKey()) === false){
                    return Response::create(function () use ($endpoint, $data){
                        return ( new Client([ "base_uri" => self::getHost() ]) )->post($endpoint, [
                            "json" => [
                                "args" => $data
                            ],
                            'headers' => [
                                'api_key' => self::getApiKey()
                            ],
                            'proxy' => self::getProxy(),
                            'verify' => false
                        ]);
                    });
                }
                return Response::create(function () use ($endpoint, $data){
                    return ( new Client([ "base_uri" => self::getHost() ]) )->post($endpoint, [
                        "json" => [
                            "args" => $data
                        ],
                        'proxy' => self::getProxy(),
                        'verify' => false
                    ]);
                });
            }

            if (is_null(self::getApiKey()) === false){
                return Response::create(function () use ($endpoint, $data){
                    return ( new Client([ "base_uri" => self::getHost() ]) )->post($endpoint, [
                        "json" => [
                            "args" => $data
                        ],
                        'headers' => [
                            'api_key' => self::getApiKey()
                        ]
                    ]);
                });
            }

            return Response::create(function () use ($endpoint, $data){
                return ( new Client([ "base_uri" => self::getHost() ]) )->post($endpoint, [
                    "json" => [
                        "args" => $data
                    ]
                ]);
            });
        }
        throw new WavelHostIsEmpty('environment WAVEL_HOST is empty!');
    }

    /**
     * @return string|null
     */
    public static function getHost(): ?string
    {
        return self::$host;
    }

    /**
     * @param string|null $host
     */
    public static function setHost(?string $host): void
    {
        self::$host = $host;
    }

    /**
     * @return string|null
     */
    public static function getProxy(): ?string
    {
        return self::$proxy;
    }

    /**
     * @param string|null $proxy
     */
    public static function setProxy(?string $proxy): void
    {
        self::$proxy = $proxy;
    }

    /**
     * @return string|null
     */
    public static function getApiKey(): ?string
    {
        return self::$apiKey;
    }

    /**
     * @param string|null $apiKey
     */
    public static function setApiKey(?string $apiKey): void
    {
        self::$apiKey = $apiKey;
    }

    static function init(string $wavelHost, string $wavelApiKey = null, string $wavelProxy = null){
        self::setHost($wavelHost);
        self::setApiKey($wavelApiKey);
        self::setProxy($wavelProxy);
    }

}
