<?php


namespace Ardzz\Wavel\Webhooks\Collections;


/**
 * Class Chat
 * @package Ardzz\Wavel\Webhooks\Collections
 */
class Chat extends AbstractCollections
{
    /**
     * @return mixed
     */
    function getLastMessageId(): mixed
    {
        return $this->getData()['lastReceivedKey']['_serialized'];
    }

    /**
     * @return array|string|null
     */
    function isArchived(): array|string|null
    {
        return $this->getData('archive');
    }

    /**
     * @return array|string|null
     */
    function isReadOnly(): array|string|null
    {
        return $this->getData('isReadOnly');
    }

    /**
     * @return array|string|null
     */
    function isGroup(): array|string|null
    {
        return $this->getData('isGroup');
    }

    /**
     * @return bool
     */
    function isReplyable(): bool
    {
        return (bool) $this->getData('canSend');
    }

    /**
     * @return array|string|null
     */
    function getFormattedTitle(): array|string|null
    {
        return $this->getData('formattedTitle');
    }
}
