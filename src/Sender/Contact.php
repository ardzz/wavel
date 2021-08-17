<?php


namespace Ardzz\Wavel\Sender;


use Ardzz\Wavel\Cores\Exception\VCardException;
use Ardzz\Wavel\Cores\Exception\WavelError;
use Ardzz\Wavel\Cores\Exception\WavelHostIsEmpty;
use Ardzz\Wavel\Cores\Format;
use Ardzz\Wavel\Cores\Handler\Output;
use Ardzz\Wavel\Cores\Http\RequestTrait;
use Ardzz\Wavel\Cores\Plugins\VCard;

/**
 * Class Others
 * @package Ardzz\Wavel\Sender
 */
class Contact
{
    use RequestTrait;

    /**
     * @param String $fullName
     * @param String|Int $phoneNumber
     * @param String|Int $receiverNumber
     * @return Output
     * @throws VCardException
     * @throws WavelError
     * @throws WavelHostIsEmpty
     */
    function sendVCard(String $fullName, String $phoneNumber, String $receiverNumber): Output
    {
        $vcard = new VCard();
        $vcard->addName($fullName);
        $vcard->addPhoneNumber($phoneNumber);

        return $this->process("sendVCard", [
            "chatId"=> Format::number($receiverNumber),
            "vcard" => $vcard->getOutput(),
            "contactName" => $fullName,
            "contactNumber" => $phoneNumber
        ]);
    }

    /**
     * @param String|Int $contactNumber
     * @param String|Int $receiverNumber
     * @return Output
     * @throws WavelError
     * @throws WavelHostIsEmpty
     */
    function sendContact(String $contactNumber, String $receiverNumber): Output
    {
        return $this->process("sendContact", [
            "to" => Format::number($receiverNumber),
            "contactId" => Format::number($contactNumber)
        ]);
    }

    /**
     * @param string|int $contactNumber
     * @return Output
     * @throws WavelError
     * @throws WavelHostIsEmpty
     */
    function contactBlock(string $contactNumber): Output
    {
        return $this->process('contactBlock', [
            'id' => Format::number($contactNumber)
        ]);
    }


    /**
     * @param string|int $contactNumber
     * @return Output
     * @throws WavelError
     * @throws WavelHostIsEmpty
     */
    function contactUnblock(string $contactNumber): Output
    {
        return $this->process('contactUnblock', [
            'id' => Format::number($contactNumber)
        ]);
    }

    /**
     * @return Output
     * @throws WavelError
     * @throws WavelHostIsEmpty
     */
    function getBlockedIds(): Output
    {
        return $this->process('getBlockedIds');
    }

    /**
     * @return Output
     * @throws WavelError
     * @throws WavelHostIsEmpty
     */
    function getAllContacts(): Output
    {
        return $this->process('getAllContacts');
    }

    /**
     * @param string|int $contactId
     * @return Output
     * @throws WavelError
     * @throws WavelHostIsEmpty
     */
    function getContact(string $contactId): Output
    {
        return $this->process('getContact', [
            'contactId' => Format::number($contactId)
        ]);
    }
}
