<?php


namespace Ardzz\Wavel\Sender;


use Ardzz\Wavel\Cores\Exception\WavelError;
use Ardzz\Wavel\Cores\Exception\WavelHostIsEmpty;
use Ardzz\Wavel\Cores\Format;
use Ardzz\Wavel\Cores\Handler\Output;
use Ardzz\Wavel\Cores\Http\RequestTrait;

/**
 * Class Text
 * @package Ardzz\Wavel\Sender
 */
class Text
{
    use RequestTrait;

    /**
     * @param String $message
     * @param String|Int $receiverNumber
     * @param bool $isGroup
     * @return Output
     * @throws WavelError
     * @throws WavelHostIsEmpty
     */
    function message(String $message, String|Int $receiverNumber, bool $isGroup = false): Output
    {
        return $this->process("sendText", [
            "to" => Format::number($receiverNumber, $isGroup),
            "content" => $message
        ]);
    }

    /**
     * @param String $message
     * @param String|Int $receiverNumber
     * @param bool $isGroup
     * @return Output
     * @throws WavelError
     * @throws WavelHostIsEmpty
     */
    function messageWithMention(String $message, String|Int $receiverNumber, bool $isGroup = false): Output
    {
        return $this->process("sendTextWithMentions", [
            "to" => Format::number($receiverNumber, $isGroup),
            "content" => $message
        ]);
    }

    /**
     * @param String $message
     * @param String|Int $receiverNumber
     * @param String $youtubeLink
     * @param bool $isGroup
     * @return Output
     * @throws WavelError
     * @throws WavelHostIsEmpty
     */
    function youtubeLink(String $message, String|Int $receiverNumber, String $youtubeLink, bool $isGroup = false): Output
    {
        return $this->process("sendYoutubeLink", [
            "to" => Format::number($receiverNumber, $isGroup),
            "url" => $youtubeLink,
            "text" => $message
        ]);
    }

    /**
     * @param String $message
     * @param String|Int $receiverNumber
     * @param String $messageId
     * @param bool $isGroup
     * @param bool $sendSeen
     * @return Output
     * @throws WavelError
     * @throws WavelHostIsEmpty
     */
    function reply(String $message, String|Int $receiverNumber, String $messageId, bool $isGroup = false, bool $sendSeen = false): Output
    {
        return $this->process('reply', [
            'to' => Format::number($receiverNumber, $isGroup),
            'content' => $message,
            'quotedMsgId' => $messageId,
            'sendSeen' => var_export($sendSeen, true)
        ]);
    }

    /**
     * @param String $message
     * @param String|Int $receiverNumber
     * @param String $link
     * @param bool $isGroup
     * @return Output
     * @throws WavelError
     * @throws WavelHostIsEmpty
     */
    function link(String $message, String|Int $receiverNumber, String $link, bool $isGroup = false): Output
    {
        return $this->process("sendLinkWithAutoPreview", [
            "to" => Format::number($receiverNumber, $isGroup),
            "url" => $link,
            "text" => $message
        ]);
    }
}
