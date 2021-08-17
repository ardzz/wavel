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
    function getLastMessageId()
    {
        return $this->getData()['lastReceivedKey']['_serialized'];
    }

    /**
     * @return array|string|null
     */
    function isArchived()
    {
        return $this->getData('archive');
    }

    /**
     * @return array|string|null
     */
    function isReadOnly()
    {
        return $this->getData('isReadOnly');
    }

    /**
     * @return array|string|null
     */
    function isGroup()
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
    function getFormattedTitle()
    {
        return $this->getData('formattedTitle');
    }
}
