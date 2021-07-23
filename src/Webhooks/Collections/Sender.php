<?php


namespace Ardzz\Wavel\Webhooks\Collections;


class Sender extends AbstractCollections
{
    function getNumber(): int
    {
        return (int) $this->getData('id');
    }

    function getName(): array|string|null
    {
        return $this->getData('name');
    }

    function getShortName(): array|string|null
    {
        return $this->getData('shortName');
    }

    function getPushName(): array|string|null
    {
        return $this->getData('pushname');
    }

    function getFormattedName(): array|string|null
    {
        return $this->getData('formattedName');
    }

    function isBusiness(): array|string|null
    {
        return $this->getData('isBusiness');
    }

    function isEnterprise(): array|string|null
    {
        return $this->getData('isEnterprise');
    }

    function isMyContact(): array|string|null
    {
        return $this->getData('isMyContact');
    }

    function getId(): array|string|null
    {
        return $this->getData('id');
    }

    function getProfileImageURL(){
        return array_key_exists('eurl', $this->getData()['profilePicThumbObj']) ? $this->getData()['profilePicThumbObj']['eurl'] : null;
    }
}
