<?php


namespace Ardzz\Wavel\Webhooks\Collections;


/**
 * Class Sender
 * @package Ardzz\Wavel\Webhooks\Collections
 */
class Sender extends AbstractCollections
{
    /**
     * @return int
     */
    function getNumber(): int
    {
        return (int) $this->getData('id');
    }

    /**
     * @return array|string|null
     */
    function getName(): array|string|null
    {
        return $this->getData('name');
    }

    /**
     * @return array|string|null
     */
    function getShortName(): array|string|null
    {
        return $this->getData('shortName');
    }

    /**
     * @return array|string|null
     */
    function getPushName(): array|string|null
    {
        return $this->getData('pushname');
    }

    /**
     * @return array|string|null
     */
    function getFormattedName(): array|string|null
    {
        return $this->getData('formattedName');
    }

    /**
     * @return array|string|null
     */
    function isBusiness(): array|string|null
    {
        return $this->getData('isBusiness');
    }

    /**
     * @return array|string|null
     */
    function isEnterprise(): array|string|null
    {
        return $this->getData('isEnterprise');
    }

    /**
     * @return array|string|null
     */
    function isMyContact(): array|string|null
    {
        return $this->getData('isMyContact');
    }

    /**
     * @return array|string|null
     */
    function getId(): array|string|null
    {
        return $this->getData('id');
    }

    /**
     * @return mixed
     */
    function getProfileImageURL(): mixed
    {
        return array_key_exists('eurl', $this->getData()['profilePicThumbObj']) ? $this->getData()['profilePicThumbObj']['eurl'] : null;
    }
}
