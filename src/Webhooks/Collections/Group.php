<?php


namespace Ardzz\Wavel\Webhooks\Collections;


use Ardzz\Wavel\Webhooks\Collections\AbstractCollections;
use Illuminate\Support\Carbon;

/**
 * Class Group
 * @package Ardzz\Wavel\Webhooks\Collections
 */
class Group extends AbstractCollections
{
    /**
     * @return array|string|null
     */
    function getId()
    {
        return $this->getData('id');
    }

    /**
     * @return array|string|null
     */
    function getOwner()
    {
        return $this->getData('owner');
    }

    /**
     * @return array|string|null
     */
    function getDescription()
    {
        return $this->getData('desc');
    }

    /**
     * @return array|string|null
     */
    function getParticipants()
    {
        return $this->getData('participants');
    }

    /**
     * @param bool $createCarbon
     * @return Carbon|string
     */
    function getCreateAt(bool $createCarbon = false)
    {
        $carbon = Carbon::createFromTimestamp($this->getData('creation'));
        return $createCarbon ? $carbon : $carbon->toDateTimeString();
    }
}
