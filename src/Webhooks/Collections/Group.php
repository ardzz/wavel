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
    function getId(): array|string|null
    {
        return $this->getData('id');
    }

    /**
     * @return array|string|null
     */
    function getOwner(): array|string|null
    {
        return $this->getData('owner');
    }

    /**
     * @return array|string|null
     */
    function getDescription(): array|string|null
    {
        return $this->getData('desc');
    }

    /**
     * @return array|string|null
     */
    function getParticipants(): array|string|null
    {
        return $this->getData('participants');
    }

    /**
     * @param bool $createCarbon
     * @return Carbon|string
     */
    function getCreateAt(bool $createCarbon = false): Carbon|string
    {
        $carbon = Carbon::createFromTimestamp($this->getData('creation'));
        return $createCarbon ? $carbon : $carbon->toDateTimeString();
    }
}
