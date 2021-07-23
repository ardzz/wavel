<?php


namespace Ardzz\Wavel\Webhooks\Collections;


use Ardzz\Wavel\Webhooks\Collections\AbstractCollections;
use Illuminate\Support\Carbon;

class Group extends AbstractCollections
{
    function getId(): array|string|null
    {
        return $this->getData('id');
    }

    function getOwner(): array|string|null
    {
        return $this->getData('owner');
    }

    function getDescription(): array|string|null
    {
        return $this->getData('desc');
    }

    function getParticipants(): array|string|null
    {
        return $this->getData('participants');
    }

    function getCreateAt(bool $createCarbon = false): Carbon|string
    {
        $carbon = Carbon::createFromTimestamp($this->getData('creation'));
        return $createCarbon ? $carbon : $carbon->toDateTimeString();
    }
}
