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
     * Returns a list of contact with whom the host number has an existing chat who are also not contacts.
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
     * @return Output
     * @throws WavelError
     * @throws WavelHostIsEmpty
     */
    function archiveChat(string $chatId, bool $archive = true): Output
    {
        return $this->process('archiveChat', [
            'chatId' => Format::number($chatId),
            'archive' => $archive
        ]);
    }

    /**
     * unarchive chat by id
     * @param string|int $chatId
     * @return Output
     * @throws WavelError
     * @throws WavelHostIsEmpty
     */
    function unArchiveChat(string $chatId): Output
    {
        return $this->archiveChat($chatId, false);
    }

    /**
     * Checks if a chat is muted
     * @param string|int $chatId
     * @return Output
     * @throws WavelError
     * @throws WavelHostIsEmpty
     */
    function isChatMuted(string $chatId): Output
    {
        return $this->process('isChatMuted', [
            'chatId' => Format::number($chatId)
        ]);
    }

    /**
     * Retrieves all chats
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
     * retrieves all Chat Ids
     * @return Output
     * @throws WavelError
     * @throws WavelHostIsEmpty
     */
    function getAllChatIds(): Output
    {
        return $this->process('getAllChatIds');
    }

    /**
     * Retrieves all chats with messages
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
     * Retrieves chat object of given contact id
     * @param string|int $chatId
     * @return Output
     * @throws WavelError
     * @throws WavelHostIsEmpty
     */
    function getChatById(string $chatId): Output
    {
        return $this->process('getChatById', [
            'contactId' => Format::number($chatId)
        ]);
    }

    /**
     * Checks if a chat contact is online. Not entirely sure if this works with groups.
     * It will return true if the chat is online, false if the chat is offline, PRIVATE if the privacy settings of the contact do not allow you to see their status and NO_CHAT if you do not currently have a chat with that contact.
     * @param string|int $chatId
     * @return Output
     * @throws WavelError
     * @throws WavelHostIsEmpty
     */
    function isChatOnline(string $chatId): Output
    {
        return $this->process('isChatOnline', [
            'chatId' => Format::number($chatId)
        ]);
    }

    /**
     * Delete the conversation from your WA
     * @param string|int $chatId
     * @return Output
     * @throws WavelError
     * @throws WavelHostIsEmpty
     */
    function deleteChat(string $chatId): Output
    {
        return $this->process('deleteChat', [
            'chatId' => Format::number($chatId)
        ]);
    }

    /**
     * Delete all messages from the chat.
     * @param string|int $chatId
     * @return Output
     * @throws WavelError
     * @throws WavelHostIsEmpty
     */
    function clearChat(string $chatId): Output
    {
        return $this->process('clearChat', [
            'chatId' => Format::number($chatId)
        ]);
    }

    /**
     * Retrieves all Messages in a chat that have been loaded within the WA web instance.
     * This does not load every single message in the chat history.
     * @param string|int $chatId
     * @param bool $includeMe
     * @param bool $includeNotifications
     * @return Output
     * @throws WavelError
     * @throws WavelHostIsEmpty
     */
    function getAllMessagesInChat(string $chatId, bool $includeMe = true, bool $includeNotifications = true): Output
    {
        return $this->process('getAllMessagesInChat', [
            'chatId' => $chatId,
            'includeMe' => $includeMe,
            'includeNotifications' => $includeNotifications
        ]);
    }

    /**
     * Clears all chats of all messages. This does not delete chats.
     * Please be careful with this as it will remove all messages from whatsapp web and the host device.
     * This feature is great for privacy focussed bots.
     * @return Output
     * @throws WavelError
     * @throws WavelHostIsEmpty
     */
    function clearAllChats(): Output
    {
        return $this->process('clearAllChats');
    }

    /**
     * This simple function halves the amount of chats in your session message cache.
     * This does not delete messages off your phone.
     * If over a day you've processed 4000 messages this will possibly result in 4000 messages being present in your session.
     * @return Output
     * @throws WavelError
     * @throws WavelHostIsEmpty
     */
    function cutChatCache(): Output
    {
        return $this->process('cutChatCache');
    }

    /**
     * Retrieves the epoch timestamp of the time the contact was last seen
     * @param string|int $chatId
     * @return Output
     * @throws WavelError
     * @throws WavelHostIsEmpty
     */
    function getLastSeen(string $chatId): Output
    {
        return $this->process('getLastSeen', [
            'chatId' => Format::number($chatId)
        ]);
    }
}
