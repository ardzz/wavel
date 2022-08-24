<?php

namespace Ardzz\Wavel\Utility;

use Ardzz\Wavel\Webhooks\Webhook;

/**
 *
 */
class Event
{
    /**
     * @var Webhook
     */
    protected static Webhook $webhook;

    /**
     * @return Webhook
     */
    static function getWebhook(): Webhook
    {
        return self::$webhook;
    }

    /**
     * @param Webhook $webhook
     */
    static function setWebhook(Webhook $webhook): void
    {
        self::$webhook = $webhook;
    }

    /**
     * @param Webhook $webhook
     * @return bool
     */
    function isValid(Webhook $webhook): bool
    {
        self::setWebhook($webhook);
        match ($webhook->getEvents()){
            "onMessage" => $onMessage = $webhook->getEvents() == 'onMessage' && !$webhook->AmISender() && !$webhook->isGroupMessage(),
            "onAnyMessage" => $onAnyMessage = $webhook->getEvents() == 'onAnyMessage' && $webhook->AmISender() || $webhook->isGroupMessage(),
            default => null
        };
        if (isset($onMessage)){
            return $onMessage;
        }elseif (isset($onAnyMessage)){
            return $onAnyMessage;
        }else{
            return false;
        }
    }

    /**
     * @param callable $callback
     * @return bool
     */
    function onIncomingCall(callable $callback): bool
    {
        if (self::getWebhook()->getEvents() == "onIncomingCall"){
            return $callback($this->getWebhook()->getData()['peerJid']);
        }else{
            return false;
        }
    }
}