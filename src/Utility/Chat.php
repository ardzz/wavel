<?php


namespace Ardzz\Wavel\Utility;


use Ardzz\Wavel\Cores\Exception\WavelError;
use Ardzz\Wavel\Cores\Exception\WavelHostIsEmpty;
use Ardzz\Wavel\Cores\Format;
use Ardzz\Wavel\Cores\Handler\Output;
use Ardzz\Wavel\Cores\Http\RequestTrait;

/**
 * Class Chat
 * @package Ardzz\Wavel\Utility
 */
class Chat
{
    use RequestTrait;

    /**
     * @return Output
     * @throws WavelError
     * @throws WavelHostIsEmpty
     */
    function getChatWithNonContacts(): Output
    {
        return $this->process('getChatWithNonContacts');
    }

    /**
     * @param string|int $chatId
     * @param bool $archive
     * @param bool $isGroup
     * @return Output
     * @throws WavelError
     * @throws WavelHostIsEmpty
     */
    function archiveChat(string|int $chatId, bool $archive = true, bool $isGroup = false): Output
    {
        return $this->process('archiveChat', [
            'chatId' => Format::number($chatId, $isGroup),
            'archive' => $archive
        ]);
    }

    /**
     * @param string|int $chatId
     * @param bool $isGroup
     * @return Output
     * @throws WavelError
     * @throws WavelHostIsEmpty
     */
    function unArchiveChat(string|int $chatId, bool $isGroup = false): Output
    {
        return $this->archiveChat($chatId, false, $isGroup);
    }

    /**
     * @param string|int $chatId
     * @param bool $isGroup
     * @return Output
     * @throws WavelError
     * @throws WavelHostIsEmpty
     */
    function isChatMuted(string|int $chatId, bool $isGroup = false): Output
    {
        return $this->process('isChatMuted', [
            'chatId' => Format::number($chatId, $isGroup)
        ]);
    }

    /**
     * @param bool $withNewMessageOnly
     * @return Output
     * @throws WavelError
     * @throws WavelHostIsEmpty
     */
    function getAllChats(bool $withNewMessageOnly = false): Output
    {
        return $this->process('getAllChats', [
            'withNewMessageOnly' => $withNewMessageOnly
        ]);
    }

    /**
     * @return Output
     * @throws WavelError
     * @throws WavelHostIsEmpty
     */
    function getAllChatIds(): Output
    {
        return $this->process('getAllChatIds');
    }

    /**
     * @param bool $withNewMessageOnly
     * @return Output
     * @throws WavelError
     * @throws WavelHostIsEmpty
     */
    function getAllChatsWithMessages(bool $withNewMessageOnly = false): Output
    {
        return $this->process('getAllChatsWithMessages', [
            'withNewMessageOnly' => $withNewMessageOnly
        ]);
    }

    /**
     * @param string|int $chatId
     * @param bool $isGroup
     * @return Output
     * @throws WavelError
     * @throws WavelHostIsEmpty
     */
    function getChatById(string|int $chatId, bool $isGroup = false): Output
    {
        return $this->process('getChatById', [
            'contactId' => Format::number($chatId, $isGroup)
        ]);
    }

    /**
     * @param string|int $chatId
     * @param bool $isGroup
     * @return Output
     * @throws WavelError
     * @throws WavelHostIsEmpty
     */
    function isChatOnline(string|int $chatId, bool $isGroup = false): Output
    {
        return $this->process('isChatOnline', [
            'chatId' => Format::number($chatId, $isGroup)
        ]);
    }

    /**
     * @param string|int $chatId
     * @param bool $isGroup
     * @return Output
     * @throws WavelError
     * @throws WavelHostIsEmpty
     */
    function deleteChat(string|int $chatId, bool $isGroup = false): Output
    {
        return $this->process('deleteChat', [
            'chatId' => Format::number($chatId, $isGroup)
        ]);
    }

    /**
     * @param string|int $chatId
     * @param bool $isGroup
     * @return Output
     * @throws WavelError
     * @throws WavelHostIsEmpty
     */
    function clearChat(string|int $chatId, bool $isGroup = false): Output
    {
        return $this->process('clearChat', [
            'chatId' => Format::number($chatId, $isGroup)
        ]);
    }

    /**
     * @param string|int $chatId
     * @param bool $isGroup
     * @param bool $includeMe
     * @param bool $includeNotifications
     * @return Output
     * @throws WavelError
     * @throws WavelHostIsEmpty
     */
    function getAllMessagesInChat(string|int $chatId, bool $isGroup = false, bool $includeMe = true, bool $includeNotifications = true): Output
    {
        return $this->process('getAllMessagesInChat', [
            'chatId' => $chatId,
            'includeMe' => $includeMe,
            'includeNotifications' => $includeNotifications
        ]);
    }

    /**
     * @return Output
     * @throws WavelError
     * @throws WavelHostIsEmpty
     */
    function clearAllChats(): Output
    {
        return $this->process('clearAllChats');
    }

    /**
     * @return Output
     * @throws WavelError
     * @throws WavelHostIsEmpty
     */
    function cutChatCache(): Output
    {
        return $this->process('cutChatCache');
    }
}
