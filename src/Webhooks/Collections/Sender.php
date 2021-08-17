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
    function getName()
    {
        return $this->getData('name');
    }

    /**
     * @return array|string|null
     */
    function getShortName()
    {
        return $this->getData('shortName');
    }

    /**
     * @return array|string|null
     */
    function getPushName()
    {
        return $this->getData('pushname');
    }

    /**
     * @return array|string|null
     */
    function getFormattedName()
    {
        return $this->getData('formattedName');
    }

    /**
     * @return array|string|null
     */
    function isBusiness()
    {
        return $this->getData('isBusiness');
    }

    /**
     * @return array|string|null
     */
    function isEnterprise()
    {
        return $this->getData('isEnterprise');
    }

    /**
     * @return array|string|null
     */
    function isMyContact()
    {
        return $this->getData('isMyContact');
    }

    /**
     * @return array|string|null
     */
    function getId()
    {
        return $this->getData('id');
    }

    /**
     * @return mixed
     */
    function getProfileImageURL()
    {
        return array_key_exists('eurl', $this->getData()['profilePicThumbObj']) ? $this->getData()['profilePicThumbObj']['eurl'] : null;
    }
}
