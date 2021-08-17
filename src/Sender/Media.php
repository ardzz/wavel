<?php


namespace Ardzz\Wavel\Sender;

use Ardzz\Wavel\Cores\Exception\WavelError;
use Ardzz\Wavel\Cores\Exception\WavelHostIsEmpty;
use Ardzz\Wavel\Cores\Format;
use Ardzz\Wavel\Cores\Handler\Output;
use Ardzz\Wavel\Cores\Http\RequestTrait;

/**
 * Class Media
 * @package Ardzz\Wavel\Sender
 */
class Media
{
    use RequestTrait;

    /**
     * @param String $message
     * @param String $receiverNumber
     * @param String $file
     * @return Output
     * @throws WavelError
     * @throws WavelHostIsEmpty
     */
    function document(String $message, String $receiverNumber, String $file): Output
    {
        return $this->process("sendFile", [
            "to" => Format::number($receiverNumber),
            "file" => Format::document($file),
            "filename" => $file,
            "caption" => $message
        ]);
    }

    /**
     * @param String $message
     * @param String $receiverNumber
     * @param String $file
     * @return Output
     * @throws WavelError
     * @throws WavelHostIsEmpty
     */
    function image(String $message, String $receiverNumber, String $file): Output
    {
        return $this->process("sendImage", [
            "to" => Format::number($receiverNumber),
            "file" => Format::image($file),
            "filename" => $file,
            "caption" => $message
        ]);
    }

    /**
     * @param String $receiverNumber
     * @param String $file
     * @return Output
     * @throws WavelError
     * @throws WavelHostIsEmpty
     */
    function imageAsSticker(String $receiverNumber, String $file): Output
    {
        return $this->process("sendImageAsSticker", [
            "to" => Format::number($receiverNumber),
            "image" => Format::image($file)
        ]);
    }

    /**
     * @param String $receiverNumber
     * @param String $file
     * @return Output
     * @throws WavelError
     * @throws WavelHostIsEmpty
     */
    function rawWebpAsSticker(String $receiverNumber, String $file): Output
    {
        return $this->process("sendRawWebpAsSticker", [
            "to" => Format::number($receiverNumber),
            "webpBase64" => Format::document($file)
        ]);
    }

    /**
     * @param String $receiverNumber
     * @param String $url
     * @param String $message
     * @return Output
     * @throws WavelError
     * @throws WavelHostIsEmpty
     */
    function fileFromURL(String $receiverNumber, String $url, String $message): Output
    {
        $file = explode('/', $url);
        return $this->process('sendFileFromUrl', [
            'to' => Format::number($receiverNumber),
            "url" => $url,
            "filename" => end($file),
            "caption" => $message
        ]);
    }

    /**
     * @param string $messageId
     * @return Output
     * @throws WavelError
     * @throws WavelHostIsEmpty
     */
    function decryptMedia(string $messageId): Output
    {
        return $this->process('decryptMedia', [
            'message' => $messageId
        ]);
    }
}
